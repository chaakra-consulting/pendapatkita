<div class="container">


	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="left-content">
			<h3>SURVEY : <?= $titleoe; ?></h3>
		</div>
		<div class="main-dashboard-header-right">

		</div>
	</div>
	<!-- /breadcrumb -->

	<!-- row -->

	<!-- row opened -->
	<div class="row row-sm row-deck">

		<div class="col-md-12 col-lg-12 col-xl-12">
			<div class="card card-table-two">
				<div class="d-flex justify-content-between">
					<h4 class="card-title mb-1">List Survey yang sudah dilaksanakan</h4>
					<i class="mdi mdi-dots-horizontal text-gray"></i>
				</div>
				<?php if (count($survey) > 0) { ?>
					<span class="tx-12 tx-muted mb-3 ">Data Survey yang sudah dilaksanakan</span>
					<div class="table-responsive country-table">
						<table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
							<thead>
								<tr>
									<th>No.</th>
									<th>Nama Responden</th>
									<th>Waktu</th>
									<th>Foto</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($survey as $ju) {
									$idusere = $this->session->id;

								?>

									<tr>
										<td><?= $no++; ?>.</td>
										<td><?= $ju->js_nama_responden; ?></td>
										<td><?= TglIndo($ju->js_waktu); ?></td>
										<td>
											<?php
											$array_foto = json_decode($ju->js_foto, TRUE);
											if (is_array($array_foto)) {
												if (count($array_foto) > 0) {
													for ($i = 0; $i < count($array_foto); $i++) { ?>
														<img src="<?= base_url(); ?>./../assets/validasi/<?= $array_foto[$i] ?>" style="width:100px;">
												<?php }
												}
											} else { ?>
												<img src="<?= base_url(); ?>./../assets/validasi/<?= $ju->js_foto ?>" style="width:100px;">
											<?php
											}
											?>
										</td>

									</tr>

								<?php } ?>
							</tbody>
						</table>
					</div>

				<?php } ?>
			</div>
		</div>
	</div>
	<!-- /row -->
</div>

