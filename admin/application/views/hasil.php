<html>
<?php $lssu = $listsurvey[0]; ?>
<style>
	th,
	td {
		padding: 5px;
		text-align: center;
		vertical-align: middle;
		border: 1px solid black;
	}

	th {
		font-weight: bold;
		vertical-align: middle;
	}

	td {
		text-align: left;
	}
</style>

<div align="center">
	<h2>Hasil Survey</h2>
	<h4><?= $lssu->nama_survey; ?></h4>
</div>
<button id="exportBtn2">Export To Excel</button>
<button id="exportBtn1">Export To Excel (Dengan Foto)</button><br><br>

<table id="tab1" style="border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; font-size: 12px;">
	<thead>
		<tr>
			<th rowspan="3">No</th>
			<th rowspan="3">Pewawancara</th>
			<th rowspan="3">Pemeriksa</th>
			<th rowspan="3">Responden</th>
			<th rowspan="3">Waktu</th>
			<?php foreach ($listseksi as $l) : ?>
				<?php if ($l->jumlah > 0) : ?>
					<th colspan="<?= $l->jumlah ?>"><?= $l->ss_kode; ?></th>
				<?php endif; ?>
			<?php endforeach; ?>
			<th rowspan="3">Foto/Validasi</th>
		</tr>
		<tr>
			<?php foreach ($structured_questions as $q) : ?>
				<th colspan="<?= $q->colspan ?>" <?= !$q->is_checkbox ? 'rowspan="2"' : '' ?>>
					<?= $q->ps_kode ?>
				</th>
			<?php endforeach; ?>
		</tr>
		<tr>
			<?php foreach ($structured_questions as $q) : ?>
				<?php if ($q->is_checkbox) : ?>
					<?php foreach ($q->options as $option) : ?>
						<th><?= htmlspecialchars($option) ?></th>
					<?php endforeach; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		foreach ($hasilsurvey as $hsl) :
			$jawaban_map = [];
			$jwb_list = explode(';', rtrim($hsl->js_jawaban, ';'));
			foreach ($jwb_list as $jb) {
				$cj = explode(':', $jb, 2);
				if (count($cj) > 1) {
					$jawaban_map[$cj[0]] = $cj[1];
				}
			}
		?>
			<tr>
				<td style="text-align: center;"><?= $no++; ?></td>
				<td><?= htmlspecialchars($hsl->js_pewawancara); ?></td>
				<td><?= htmlspecialchars($hsl->js_pemeriksa); ?></td>
				<td><?= htmlspecialchars($hsl->js_kode_responden . '-' . $hsl->js_nama_responden); ?></td>
				<td><?= TglIndo($hsl->js_waktu); ?></td>

				<?php foreach ($structured_questions as $q) : ?>
					<?php if ($q->is_checkbox) : ?>
						<?php // Logika Final untuk Checkbox 
						?>
						<?php foreach ($q->options as $option) : ?>
							<td>
								<?php
								if (isset($jawaban_map[$q->ps_id])) {
									$jawaban_lengkap_checkbox = $jawaban_map[$q->ps_id];
									$selected_options = array_map('trim', explode(',', $jawaban_lengkap_checkbox));

									foreach ($selected_options as $item_jawaban) {
										if (strpos($item_jawaban, $option) === 0) {
											$esai_checkbox = '';
											if (strlen($item_jawaban) > strlen($option)) {
												$esai_checkbox = trim(substr($item_jawaban, strlen($option)));
												$esai_checkbox = ltrim($esai_checkbox, ', ');
											}

											if (!empty($esai_checkbox)) {
												// Jika ada esai, tampilkan HANYA esainya dengan tebal
												echo htmlspecialchars($esai_checkbox);
											} else {
												// Jika tidak ada esai, tampilkan pilihan dengan tanda centang
												echo htmlspecialchars($item_jawaban);
											}
											break;
										}
									}
								}
								?>
							</td>
						<?php endforeach; ?>
					<?php else : ?>
						<?php // Logika Final untuk Radio Button & Teks 
						?>
						<td>
							<?php
							if (isset($jawaban_map[$q->ps_id])) {
								$jawaban = $jawaban_map[$q->ps_id];
								if (strpos($jawaban, ',') !== false) {
									$parts = explode(',', $jawaban, 2);
									$pilihan = trim($parts[0]);
									$esai = trim($parts[1]);

									if (!empty($esai)) {
										// Jika ada esai, tampilkan HANYA esainya dengan tebal
										echo htmlspecialchars($esai);
									} else {
										echo htmlspecialchars($pilihan);
									}
								} else {
									echo htmlspecialchars($jawaban);
								}
							}
							?>
						</td>
					<?php endif; ?>
				<?php endforeach; ?>
				<td>
				<?php
					$array_foto = json_decode($hsl->js_foto, TRUE);
					// print_r($hsl->js_foto);exit;
					if (is_array($array_foto)) {
						if (count($array_foto) > 0) {
							for ($i = 0; $i < count($array_foto); $i++) { ?>
								<img data-src="<?= base_url(); ?>./../assets/validasi/<?= $array_foto[$i] ?>" class="lazyload" style="width:100px;">
						<?php }
						}
					}
					// echo (is_array($array_foto) && count($array_foto) > 0) ? implode('<br>', $array_foto) : htmlspecialchars($hsl->js_foto);
					?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<!-- tambahkan CDN ExcelJS sebelum script ekspor -->
<script src="https://cdn.jsdelivr.net/npm/exceljs@4.3.0/dist/exceljs.min.js"></script>

<script type="text/javascript">
async function loadAndCompressImage(imgUrl, maxSizeKB = 200) {
    return new Promise(async (resolve, reject) => {
        try {
            const response = await fetch(imgUrl);
            const blob = await response.blob();

            const img = new Image();
            img.crossOrigin = "anonymous";
            img.onload = () => {
                const canvas = document.createElement("canvas");
                const ctx = canvas.getContext("2d");

                const maxWidth = 400;
                let width = img.width;
                let height = img.height;

                if (width > maxWidth) {
                    height *= maxWidth / width;
                    width = maxWidth;
                }

                canvas.width = width;
                canvas.height = height;
                ctx.drawImage(img, 0, 0, width, height);

                let quality = 0.9;
                const tryCompress = () => {
                    canvas.toBlob(async (compressedBlob) => {
                        if (!compressedBlob) return reject("Gagal compress blob");
                        if (compressedBlob.size / 1024 <= maxSizeKB || quality < 0.3) {
                            const buffer = await compressedBlob.arrayBuffer();
                            resolve({ buffer, ext: "jpeg" });
                        } else {
                            quality -= 0.1;
                            canvas.toBlob(tryCompress, "image/jpeg", quality);
                        }
                    }, "image/jpeg", quality);
                };
                tryCompress();
            };
            img.onerror = reject;
            img.src = URL.createObjectURL(blob);
        } catch (err) {
            reject(err);
        }
    });
}

async function exportToExcel(includeFoto = true) {
    const filename = `Survey <?= htmlspecialchars($lssu->nama_survey, ENT_QUOTES); ?>${includeFoto ? '' : '-tanpa-foto'}.xlsx`;

    const workbook = new ExcelJS.Workbook();
    const worksheet = workbook.addWorksheet('PendapatKitaApps');

    const table = document.getElementById('tab1');
    const rows = Array.from(table.querySelectorAll('tr'));

    const occupied = {};
    let excelRow = 1;

    for (const tr of rows) {
        const cells = Array.from(tr.children).filter(c => c.tagName === 'TD' || c.tagName === 'TH');
        let col = 1;

        for (let idx = 0; idx < cells.length; idx++) {
            const cell = cells[idx];
            while (occupied[excelRow + ',' + col]) col++;

            const rowspan = parseInt(cell.getAttribute('rowspan') || 1, 10);
            const colspan = parseInt(cell.getAttribute('colspan') || 1, 10);

            const imgs = cell.querySelectorAll("img");
            if (imgs.length > 0 && includeFoto) {
                worksheet.getRow(excelRow).getCell(col).value = "";

                let imgIndex = 0;
                for (let img of imgs) {
                    const imgUrl = img.getAttribute("src") || img.getAttribute("data-src");
                    if (imgUrl) {
                        try {
                            const { buffer, ext } = await loadAndCompressImage(imgUrl, 500);

                            const imageId = workbook.addImage({
                                buffer: buffer,
                                extension: ext
                            });

                            worksheet.addImage(imageId, {
                                tl: { col: col - 1 + imgIndex, row: excelRow - 1 },
                                ext: { width: 80, height: 80 }
                            });

                            imgIndex++;
                        } catch (e) {
                            console.error("Gagal load/compress gambar:", imgUrl, e);
                        }
                    }
                }
                worksheet.getRow(excelRow).height = 65;
            } else {
                const a = cell.querySelector('a');
                if (a) {
                    const href = a.href;
                    const text = (a.textContent || href).trim();
                    worksheet.getRow(excelRow).getCell(col).value = { text: text, hyperlink: href };
                    worksheet.getRow(excelRow).getCell(col).font = { color: { argb: "FF0000FF" }, underline: true };
                } else {
                    let text = cell.innerText || '';
                    text = text.replace(/\u00A0/g, ' ').trim();
                    worksheet.getRow(excelRow).getCell(col).value = text;
                }
            }

            if (rowspan > 1 || colspan > 1) {
                const startRow = excelRow;
                const startCol = col;
                const endRow = excelRow + rowspan - 1;
                const endCol = col + colspan - 1;
                worksheet.mergeCells(startRow, startCol, endRow, endCol);

                for (let r = startRow; r <= endRow; r++) {
                    for (let c = startCol; c <= endCol; c++) {
                        occupied[r + ',' + c] = true;
                    }
                }
            } else {
                occupied[excelRow + ',' + col] = true;
            }

            col += colspan;
        }
        excelRow++;
    }

    const maxCol = Math.max(...Object.keys(occupied).map(k => parseInt(k.split(',')[1], 10)));
    for (let c = 1; c <= (isFinite(maxCol) ? maxCol : 1); c++) {
        let maxLen = 8;
        for (let r = 1; r < excelRow; r++) {
            const cell = worksheet.getRow(r).getCell(c);
            if (cell && cell.value) {
                let v = cell.value;
                let len = 0;
                if (typeof v === 'object' && v.text) len = v.text.length;
                else len = ('' + v).length;
                if (len > maxLen) maxLen = len;
            }
        }
        worksheet.getColumn(c).width = Math.min(60, maxLen + 2);
    }

    try {
        const buffer = await workbook.xlsx.writeBuffer();
        const blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = filename;
        document.body.appendChild(link);
        link.click();
        link.remove();
        URL.revokeObjectURL(link.href);
    } catch (err) {
        console.error('Export error', err);
        alert('Gagal men-generate file Excel di browser. Cek console untuk detail.');
    }
}

document.getElementById('exportBtn1').addEventListener('click', () => exportToExcel(true));
document.getElementById('exportBtn2').addEventListener('click', () => exportToExcel(false));
</script>


</html>