<html>
<!-- <?php $lpd = $listpooldata[0]; ?> -->
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
	<!-- <h2>Pool Data</h2> -->
	<h2><?= $lpd->pd_nama_kategori; ?></h2>
</div>
<button id="exportBtn1">Export To Excel</button><br><br>

<table id="tab1" style="border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; font-size: 12px;">
	<thead>
		<tr>
			<th rowspan="2">No</th>
			<th rowspan="2">Nama Responden</th>
			<th rowspan="2">Nama Survey</th>
			<th rowspan="2">Waktu Survey</th>
			<?php foreach ($listpooldetail as $l) : ?>
				<?php if (isset($l->options_all) && !empty($l->options_all)) : ?>
					<th colspan="<?= count($l->options_all) ?>">
						<?= $l->pdd_nama_pertanyaan; ?>
					</th>
				<?php else : ?>
					<th rowspan="2"><?= $l->pdd_nama_pertanyaan; ?></th>
				<?php endif; ?>
			<?php endforeach; ?>
		</tr>
		<tr>
			<?php foreach ($listpooldetail as $l) : ?>
				<?php if (isset($l->options_all) && !empty($l->options_all)) : ?>
					<?php foreach ($l->options_all as $opt) : ?>
						<th><?= $opt; ?></th>
					<?php endforeach; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
			<?php
			$no = 1;
			foreach ($hasilsurvey as $hsl) :
				$jawaban_maps = [];
				$jwb_list = explode(';', rtrim($hsl->js_jawaban, ';'));
				foreach ($jwb_list as $jb) {
					$cj = explode(':', $jb, 2);
					if (count($cj) > 1) {
						$jawaban_maps[$cj[0]] = $cj[1];
					}
				}
			?>
			<tr>
				<td style="text-align: center;"><?= $no++; ?></td>
				<td><?= htmlspecialchars($hsl->js_nama_responden); ?></td>
				<td><?= htmlspecialchars($hsl->nama_survey); ?></td>
				<td><?= TglIndo($hsl->js_waktu); ?></td>
					<?php foreach ($listpooldetail as $q) : 
						//  ambil jawaban berdasarkan ps_id
						$psIds = array_unique(array_column(json_decode(json_encode($q->pertanyaans), true), 'ps_id'));
						$matchedAnswers = array_intersect_key($jawaban_maps,array_flip($psIds));
						$values = implode(array_values($matchedAnswers));

						// condition to check if the question has options (checkbox)
						if (!empty($q->options_all)):
							foreach($q->options_all as $c) :
								
								$options = array_filter(array_map('trim', explode(',', $values)));
								// echo '<pre>';
								// print_r($q->options_all);
								// echo '</pre>';
								// exit;
								if (in_array($c, $options)) {
									$valueOption = $c;
								}elseif ($c === 'Lainnya') {
									// cek apakah ada yang tidak cocok
									$diff = array_diff($options, $q->options_all);
									if (!empty($diff)) {
										$valueOption = $values;
									} else {
										$valueOption = '';
									}
								} else {
									$valueOption = '';
								}
					?>
							<td>
							<?php
								echo htmlspecialchars($valueOption);
							?>
							</td>
						<?php endforeach; ?>
					<?php else :?>
						<td>
						<?php
							echo htmlspecialchars($values);
						?>
						</td>
					<?php endif;?>
				<?php endforeach; ?>
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
				name: "Survey <?= htmlspecialchars($lpd->pd_nama_kategori, ENT_QUOTES); ?>.xlsx",
				sheet: {
					name: "PendapatKitaApps"
				}
			});
		});
	});
</script>
</html>