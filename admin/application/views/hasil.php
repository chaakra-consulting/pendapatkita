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
<button id="exportBtn1">Export To Excel</button><br><br>

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
					echo (is_array($array_foto) && count($array_foto) > 0) ? implode('<br>', $array_foto) : htmlspecialchars($hsl->js_foto);
					?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 

<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#exportBtn1").click(function() {
			TableToExcel.convert(document.getElementById("tab1"), {
				name: "Survey <?= htmlspecialchars($lssu->nama_survey, ENT_QUOTES); ?>.xlsx",
				sheet: {
					name: "PendapatKitaApps"
				}
			});
		});
	});
</script>
</html>