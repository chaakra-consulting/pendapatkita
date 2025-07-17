<div class="content-wrapper">
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<?php
			$dtJS2 = $this->m_user->data_jawaban_survey($kode_survey)->result_array();
			//kode_survey
			$hitDt = count($dtJS2);
			$pewawancara = $this->session->nama;
			$pemeriksa = '';
			$koderesponden = '';
			$namaresponden = '';
			$dtJS = $this->m_user->data_jawaban_survey($kode_survey)->row_array();
			if ($hitDt > 0) {
				$pewawancara = $dtJS['js_pewawancara'];
				$pemeriksa = $dtJS['js_pemeriksa'];
				$koderesponden = $dtJS['js_kode_responden'];
				$namaresponden = $dtJS['js_nama_responden'];
			}
			//print_r($dtJS);
			?>
			<div class="container">
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<center>
								<h4 class="content-title mb-0 my-auto">SURVEY : <?= $detil_survey->nama_survey; ?></h4>
							</center>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- <div class="col-lg-4 col-md-4">
					<div class="card overflow-hidden">
						<div class="card-header pb-0">
							<h3 class="card-title">LIST SEKSI SURVEY</h3>
							<p class="text-muted card-sub-title mb-0">
							</p>
						</div>
						<div class="card-body">
							<nav class="nav nav-pills flex-column">
								<a class="nav-link <?php if ($kdseksi == 'data' || $kdseksi == FALSE) {
														echo 'active';
													} ?>" href="<?= base_url(); ?>survey/<?= $id_survey; ?>/<?= $kode_survey; ?>/data">MULAI SURVEY
								</a>
								<?php
								$no = 0;
								$lds = '';
								/*
													<?php
														$a=array('a10','a20','a30','as10');
														$pa=array_keys($a,'as10',false);
														echo $ao=$pa[0];

														if(end($a)==$a[$ao]){
															echo "Benar";
														}
														//echo $a[$ao];
													?>
													*/
								$a = array(1 => 'one', 2 => 'two', 3 => 'three');
								$aplink = array();
								$aplink[] = 'data';
								foreach ($list_seksi as $ds) {
									$no++;
									$aplink[] = $ds->ss_kode;
									if ($kdseksi == $ds->ss_kode) {
										$lds = 'active';
									} else {
										$lds = '';
									}

									if ($hitDt > 0) {

								?>
										<a class="nav-link <?= $lds; ?>" href="<?= base_url(); ?>survey/<?= $id_survey; ?>/<?= $kode_survey; ?>/<?= $ds->ss_kode ?>">SEKSI <?= $ds->ss_kode ?> : <?= $ds->ss_judul ?></a>
									<?php
									}
								}
								$aplink[] = 'validasi';
								$aplink[] = 'upload';
								//CekForm Berikutnya
								$palink = array_keys($aplink, $kdseksi, false);
								$aplinkafter = $palink[0] + 1;

								if ($hitDt > 0) {

									?>
									<a class="nav-link <?php if ($kdseksi == 'validasi') {
															echo 'active';
														} ?>" href="<?= base_url(); ?>survey/<?= $id_survey; ?>/<?= $kode_survey; ?>/validasi">VALIDASI</a>

								<?php } ?>
							</nav>
							<?php //print_r($a); array_key_exists($a,);
							?>
						</div>
					</div>
				</div> -->
					<div class="col-lg-12 col-md-12">
						<?php
						// Progress bar logic
						$survey_pages = ['data'];
						foreach ($list_seksi as $ds) {
							$survey_pages[] = $ds->ss_kode;
						}
						if ($hitDt > 0) {
							$survey_pages[] = 'validasi';
						}
						$total_steps = count($survey_pages);
						$current_kdseksi = ($kdseksi === FALSE) ? 'data' : $kdseksi;
						$current_step_index = array_search($current_kdseksi, $survey_pages);
						$progress = ($current_step_index !== false) ? (($current_step_index / $total_steps) * 100) : 0;
						?>
						<div class="progress-container mb-4">
							<div class="progress-bar" style="width: <?= $progress ?>%;" role="progressbar" aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100">
								<?= round($progress) ?>% Selesai
							</div>
						</div>
						<form method="POST" name="surveying" id="surveying" action="<?= base_url() ?>user/survey_formsave/<?= $aplink[$aplinkafter]; ?>/<?= $detil_survey->id_survey; ?>" enctype="multipart/form-data">
							<div class="card overflow-hidden">
								<div class="card-header pb-0">
									<h3 class="card-title">ISIAN SURVEY</h3>
									<p class="text-muted card-sub-title mb-0"></p>
								</div>
								<div class="card-body">
									<input type="hidden" name="id_survey" value="<?= $id_survey ?>">
									<input type="hidden" name="kdseksi" value="<?= $kdseksi; ?>">
									<input type="hidden" name="kode_survey" value="<?= $kode_survey ?>">
									<input type="hidden" name="target_link" id="target_link" value="">
									<div class="panel-group1" id="accordion11">
										<?php
										if ($kdseksi == 'data' || $kdseksi == FALSE) {
										?>
											<div class="panel panel-default  mb-4">
												<div class="panel-heading1 bg-white ">
													<h4 class="panel-title1">
														<a class="accordion-toggle collapsed" data-bs-toggle="collapse" data-bs-parent="#accordion11" href="#collapseFour1" aria-expanded="false"><b>DATA SURVEY</b></a>
													</h4>
												</div>
												<div id="collapseFour1" class="panel-collapse collapse show" role="tabpanel" aria-expanded="false" style="">
													<div class="panel-body">
														<input type="hidden" name="id_survey" value="<?= $detil_survey->id_survey; ?>">
														<b>Silahkan isi data berikut :</b>
														<div class="row row-xs formgroup-wrapper">
															<div class="col-md-6 ">
																<div class="form-group">
																	<label>Pewawancara</label>
																	<input type="text" name="pewawancara" class="form-control" placeholder="Pewawancara ..." value="<?= $pewawancara; ?>" required>
																</div>
																<div class="form-group">
																	<label>Pemeriksa</label>
																	<input type="text" name="pemeriksa" class="form-control" placeholder="Pemeriksa ..." value="<?= $pemeriksa; ?>">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>Kode Responden</label>
																	<input type="text" name="koderesponden" class="form-control" placeholder="Kode Responden ..." value="<?= $koderesponden; ?>">
																</div>
																<div class="form-group">
																	<label>Nama Responden</label>
																	<input type="text" name="namaresponden" class="form-control" placeholder="Nama Responden ..." required value="<?= $namaresponden; ?>">
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
										<?php
										$lnk2 = '';
										$no = 0;
										foreach ($list_seksi as $ds) {
											$no++;
											if ($kdseksi == $ds->ss_kode) {
										?>
												<div class="panel panel-default mb-4 panel-seksi panel-seksi-<?= $ds->ss_kode ?>">
													<div class="panel-heading1 bg-white ">
														<h4 class="panel-title1">
															<a class="accordion-toggle collapsed" data-bs-toggle="collapse" id="<?= $ds->ss_kode ?>" data-bs-parent="#accordion11" href="#collapseSur<?= $no; ?>" aria-expanded="false"><b>SEKSI <?= $ds->ss_kode ?> : <?= $ds->ss_judul ?></b></a>
														</h4>
													</div>
													<div id="collapseSur<?= $no; ?>" class="panel-collapse collapse show" ...>
														<div class="panel-body border">
															<?php if ($ds->ss_keterangan != '') {
																echo '<p class="help-block">' . $ds->ss_keterangan . '</p>';
															} ?>
															<div class="row row-xs formgroup-wrapper">
																<div class="col-md-12 ">
																	<?php
																	$dt_pertanyaan = $this->m_user->list_pertanyaan_by_seksi($ds->id_seksi)->result();
																	$PilJabIsi = '';
																	foreach ($dt_pertanyaan as $ta) {
																		//Jawaban
																		$isianjawaban = $this->m_user->data_survey_temp($kode_survey, $kdseksi)->result();
																		$HitIsian = count($isianjawaban);
																		if ($HitIsian > 0) {
																			$dijab = $isianjawaban[0];
																			$jbIsi = $dijab->tjs_jawaban;
																			$dtJbEx = explode(';', $jbIsi);
																			$ctTanya = ''; //Cetak No Tanya
																			$ctJawab = '';
																			foreach ($dtJbEx as $JbEx) {
																				$ExpJbExIsi = explode(':', $JbEx);
																				$NoTanya = $ExpJbExIsi[0];
																				if ($ta->ps_id == $NoTanya) {
																					$ctTanya = $NoTanya;
																					$ctJawab = $ExpJbExIsi[1];
																				}
																				//
																			}
																			//echo $ctTanya.'-';
																			//echo $ctJawab;
																			$PilJabIsi = $ctJawab;
																		}
																		//End Jawaban
																		$piljab = $ta->ps_pilihan_jawaban;
																		$paklo = '';
																		$pakwar = '';
																		$first = true;
																		if ($ta->ps_tipe_pertanyaan == 1) {
																			$pilja = explode(';', $piljab);
																			$radCheck = '';
																			foreach ($pilja as $pj) {
																				if ($pj != '') {
																					$pillo = explode(':', $pj);
																					if ($pillo[1] && $kdseksi) {
																						$isNotMatch = !str_contains($pillo[1], $kdseksi);
																					} else {
																						$isNotMatch = false;
																					}
																					//<a  data-counter="0" data-value="5" onclick="capture(this);">test</a>
																					if ($pillo[1] != '') {
																						//jejak1
																						//Link Data
																						$PgKar = $this->uri->segment(4); //Karakter Halaman
																						$dataPgKar = $pillo[1]; //DataLink
																						$wordsPGKar = trim($dataPgKar, "0..9");
																						if ($PgKar == $wordsPGKar) {
																							//echo 'tetap';
																							//$lnk = '<a href="#' . $pillo[1] . '">[ ' . $pillo[1] . ' ]</a>';
																							$lnk = '<h8 class="text-primary mb-1">[ ' . $pillo[1] . ' ]</h8>';
																						} else {
																							//echo 'beda';
																							// $lnk = '<a href="#' . $pillo[1] . '"  data-value="' . $pillo[1] . '"  onclick="capture(this);">[ ' . $pillo[1] . ' ]</a>';
																							$lnk = '<h8 class="text-primary mb-1">[ ' . $pillo[1] . ' ]</h8>';
																						}
																						//===================================
																					} else {
																						$lnk = '';
																					}
																					$radioId = $ta->ps_id . '_' . $pillo[0];
																					$extraInput = '';
																					$extraInputId = 'input_' . $radioId;
																					$isEssai = isset($pillo[2]) && strtolower(trim($pillo[2])) == 'essai';
																					$dataType = $isEssai ? 'essai' : 'default';
																					$displayStyle = ($isEssai && $PilJabIsi && strpos($PilJabIsi, $pillo[0]) == 0) ? 'block' : 'none';
																					if ($PilJabIsi == $pillo[0] && $HitIsian > 0 && $ctTanya == $ta->ps_id) {
																						$radCheck = 'checked';
																					} elseif (isset($pillo[2]) && $pillo[2] == 'essai' && $HitIsian > 0 && $ctTanya == $ta->ps_id) { //line 288
																						// $expPilJabIsi = explode(',', $PilJabIsi);
																						if (preg_match('/^(.+)\((.*)\)$/', $PilJabIsi, $matches)) {
																							$label = trim($matches[1]);
																							$isiEssai = isset($matches[2]) ? trim($matches[2]) : '';
																							$expPilJabIsi = [$label, $isiEssai];
																						} else {
																							$expPilJabIsi = [$PilJabIsi, ''];
																						}
																						if ($expPilJabIsi[0] == $pillo[0]) $radCheck = 'checked';
																						else $radCheck = '';
																					} else {
																						$radCheck = '';
																						$expPilJabIsi = '';
																					}
																					$value = (isset($pillo[2]) && $pillo[2] == 'essai' && $PilJabIsi == $pillo[0]) ? ($expPilJabIsi && $expPilJabIsi[1] ? $expPilJabIsi[1] : '') : $pillo[0]; // line 298
																					// print_r($expPilJabIsi);
																					// exit;
																					if ($isEssai) {
																						$extraInput = '<div id="' . $extraInputId . '" class="extra-input" data-psid="' . $ta->ps_id . '" style="display:' . $displayStyle . '; margin-top:5px;">																				<p class="form-control-static">
																					<input type="text" class="form-control" name="input_' . $ta->ps_id . '" value="' . htmlspecialchars($expPilJabIsi[1]  ?? $PilJabIsi) . '">
																				</p>
																			</div>';
																					}
																					$isRequired = ($ta->must_answer == 'required') ? 'true' : 'false';
																					$pakwar .= '<div class="radio">
																		<label>
																			<input type="radio"
																				name="' . $ta->ps_id . '"
																				id="' . $radioId . '"
																				value="' . $value . '"
																				' . $radCheck . '
																				data-psid="' . $ta->ps_id . '"
																				data-type="' . $dataType . '"
																				data-target="' . $extraInputId . '"
																				data-value="' . $pillo[1] . '"
																				data-required="' . $isRequired . '"
																				data-isnotmatch="' . $isNotMatch . '"
																				onclick="handleRadioEvent(this)"> ' . $pillo[0] . ' ' . $lnk . '
																		</label>
																		' . $extraInput . '
																		</div>';
																					// $pakwar .= '<div class="radio">
																					// <label>
																					// <input type="radio" 
																					// 	   onchange="if($(this).attr(\'data-value\') != \'\') { capture(this); }" 
																					// 	   data-value="' . $pillo[1] . '" 
																					// 	   name="' . $ta->ps_id . '" 
																					// 	   id="' . $ta->ps_id . '" 
																					// 	   value="' . $pillo[0] . '" ' . $radCheck . '> ' . $pillo[0] . ' ' . $lnk . '
																					// 	   </label>
																					// </div>';
																					$paklo = $pillo[1];
																					$first = false;
																				}
																			}
																		} elseif ($ta->ps_tipe_pertanyaan == 2) {
																			$pilja = explode(';', $piljab);
																			$PilJabIsiArray = explode(',', $PilJabIsi);
																			$chosenMap = [];
																			foreach ($PilJabIsiArray as $item) {
																				if (preg_match('/^(.+?)\((.*)\)$/', $item, $matches)) {
																					$label = trim($matches[1]);
																					$value = trim($matches[2]);
																					$chosenMap[$label] = $value;
																				} else {
																					$label = trim($item);
																					$chosenMap[$label] = '';
																				}
																			}
																			$PisKom = [];
																			foreach ($pilja as $pil) {
																				$parts = preg_split('/::|:/', $pil);
																				$label = trim($parts[0]);
																				$type  = isset($parts[1]) && $parts[1] !== '' ? trim($parts[1]) : 'default';
																				if (array_key_exists($label, $chosenMap)) {
																					$value = $chosenMap[$label];
																					$PisKom[] = ($type === 'essai') ? "$label($value)" : $label;
																				} else {
																					$PisKom[] = '';
																				}
																			}
																			foreach ($pilja as $key => $pj) {
																				if (trim($pj) === '') continue;
																				$pillo = explode(':', $pj);
																				$label = $pillo[0] ?? '';
																				$linkVal = $pillo[1] ?? '';
																				$type = strtolower(trim($pillo[2] ?? 'default'));
																				$checkboxId = $ta->ps_id . '_' . $label;
																				$extraInputId = 'input_' . $checkboxId;
																				$isEssai = $type == 'essai';
																				$isChecked = in_array($label, $PisKom) && $HitIsian > 0 && $ctTanya == $ta->ps_id ? 'checked' : '';
																				if ($isEssai) {
																					if (isset($PisKom[$key]) && preg_match('/^(.+)\((.*)\)$/', $PisKom[$key], $matches)) {
																						$label = trim($matches[1]);
																						$isiEssai = isset($matches[2]) ? trim($matches[2]) : '';
																						$expPilJabIsi = [$label, $isiEssai];
																						$isChecked = 'checked';
																					} else {
																						// $label = $PisKom[$key] ?? $PilJabIsi;
																						$expPilJabIsi = [$label, ''];
																						$isChecked = '';
																					}
																				} else {
																					$expPilJabIsi = explode(',', $PilJabIsi);
																				}
																				$essaiValue = ($expPilJabIsi[0] == $label && isset($expPilJabIsi[1])) ? $expPilJabIsi[1] : '';
																				// $finalValue = $isEssai && $essaiValue ? $label . ',' . $essaiValue : $label;
																				$displayStyle = ($isEssai && $isChecked) ? 'block' : 'none';
																				if (!empty($linkVal)) {
																					$PgKar = $this->uri->segment(4);
																					$wordsPGKar = trim($linkVal, "0..9");
																					// $lnk = ($PgKar == $wordsPGKar)
																					// 	? '<a href="#' . $linkVal . '">[ ' . $linkVal . ' ]</a>'
																					// 	: '<a href="#' . $linkVal . '" data-value="' . $linkVal . '" onclick="capture(this);">[ ' . $linkVal . ' ]</a>';
																					$lnk = ($PgKar == $wordsPGKar)
																						? '<h8 class="text-primary mb-1">[ ' . $linkVal . ' ]</h8>'
																						: '<h8 class="text-primary mb-1">[ ' . $linkVal . ' ]</h8>';
																				} else {
																					$lnk = '';
																				}
																				if ($pillo[1] && $kdseksi) {
																					$isNotMatch = !str_contains($pillo[1], $kdseksi);
																					// print_r($isNotMatch);exit;
																				} else {
																					$isNotMatch = false;
																				}
																				$extraInput = '';
																				$isRequired = ($ta->must_answer == 'required') ? 'true' : 'false';
																				$value = $isEssai ? $label.':'.htmlspecialchars($essaiValue) : $label;
																				if ($isEssai) {
																					$extraInput = '
																					<div id="' . $extraInputId . '" class="extra-input" data-psid="' . $ta->ps_id . '" style="display:' . $displayStyle . '; margin-top:5px;">
																						<p class="form-control-static">
																							<input type="text" class="form-control"
																								oninput="updateCheckboxValue(this)"
																								data-label="' . htmlspecialchars($label) . '"
																								data-target="' . $checkboxId . '"
																								value="' . htmlspecialchars($essaiValue) . '">
																						</p>
																					</div>';
																				}
																				$pakwar .= '
																				<div class="checkbox">
																					<label>
																						<input type="checkbox"
																							name="' . $ta->ps_id . '[]"
																							id="' . $checkboxId . '"
																							value="' . $value .'"
																							' . $isChecked . '
																							data-psid="' . $ta->ps_id . '"
																							data-type="' . $type . '"
																							data-target="' . $extraInputId . '"
																							data-value="' . $pillo[1] . '"
																							data-isnotmatch="' . $isNotMatch . '"
																							data-required="' . $isRequired . '"
																							onclick="handleCheckboxEvent(this)">
																						' . $label . ' ' . $lnk . '
																					</label>
																					' . $extraInput . '
																				</div>';
																				$first = false;
																			}
																		}
																		// elseif ($ta->ps_tipe_pertanyaan == 2) {
																		// 	$pilja = explode(';', $piljab);
																		// 	$boxCheck = 'checked';
																		// 	foreach ($pilja as $pj) {
																		// 		if ($pj != '') {
																		// 			$pillo = explode(':', $pj);
																		// 			if ($pillo[1] != '') {
																		// 				//$lnk='<a href="#'.$pillo[1].'">[ '.$pillo[1].' ]</a>';
																		// 				//Link Data
																		// 				$PgKar = $this->uri->segment(4); //Karakter Halaman
																		// 				$dataPgKar = $pillo[1]; //DataLink
																		// 				$wordsPGKar = trim($dataPgKar, "0..9");
																		// 				if ($PgKar == $wordsPGKar) {
																		// 					//echo 'tetap';
																		// 					$lnk = '<a href="#' . $pillo[1] . '">[ ' . $pillo[1] . ' ]</a>';
																		// 				} else {
																		// 					//echo 'beda';
																		// 					$lnk = '<a href="#' . $pillo[1] . '"  data-value="' . $pillo[1] . '"  onclick="capture(this);">[ ' . $pillo[1] . ' ]</a>';
																		// 				}
																		// 				//===================================
																		// 			} else {
																		// 				$lnk = '';
																		// 			}
																		// 			$PisKom = explode(',', $PilJabIsi);
																		// 			$boxCheck = '';
																		// 			foreach ($PisKom as $PK) {
																		// 				//$boxCheck=''; 
																		// 				if ($PK == $pillo[0] && $HitIsian > 0 && $ctTanya == $ta->ps_id) {
																		// 					//echo $PK.'(*)';
																		// 					$boxCheck = 'checked';
																		// 				}
																		// 			}
																		// 			$pakwar .= '<div class="checkbox"><label><input type="checkbox" name="' . $ta->ps_id . '[]" id="' . $ta->ps_id . '" value="' . $pillo[0] . '" ' . $boxCheck . '> ' . $pillo[0] . ' ' . $lnk . '</label></div>';
																		// 			$paklo = $pillo[1];
																		// 		}
																		// 	}
																		// } 
																		elseif ($ta->ps_tipe_pertanyaan == 3) {
																			$pilja = explode(';', $piljab);
																			foreach ($pilja as $pj) {
																				if ($pj != '') {
																					$pillo = explode(':', $pj);
																					if ($pillo[1] != '') {
																						//$lnk='<a href="#'.$pillo[1].'">[ '.$pillo[1].' ]</a>';
																						//Link Data
																						$PgKar = $this->uri->segment(4); //Karakter Halaman
																						$dataPgKar = $pillo[1]; //DataLink
																						$wordsPGKar = trim($dataPgKar, "0..9");
																						if ($PgKar == $wordsPGKar) {
																							//echo 'tetap';
																							$lnk = '<a href="#' . $pillo[1] . '">[ ' . $pillo[1] . ' ]</a>';
																						} else {
																							//echo 'beda';
																							$lnk = '<a href="#' . $pillo[1] . '"  data-value="' . $pillo[1] . '"  onclick="capture(this);">[ ' . $pillo[1] . ' ]</a>';
																						}
																						//===================================
																					} else {
																						$lnk = '';
																					}
																					$lnk2 = $lnk;
																				}
																			}
																			$isRequired = ($ta->must_answer == 'required') ? 'true' : 'false';
																			$paklo = '';
																			$pakwar = '<p class="form-control-static"><input type="text" class="form-control"  name="' . $ta->ps_id . '" value="' . $PilJabIsi . '" data-psid="' . $ta->ps_id . '" data-required="' . $isRequired . '"></p>';
																		} elseif ($ta->ps_tipe_pertanyaan == 4) {
																			$pilja = explode(';', $piljab);
																			foreach ($pilja as $pj) {
																				if ($pj != '') {
																					$pillo = explode(':', $pj);
																					if ($pillo[1] != '') {
																						//$lnk='<a href="#'.$pillo[1].'">[ '.$pillo[1].' ]</a>';
																						//Link Data
																						$PgKar = $this->uri->segment(4); //Karakter Halaman
																						$dataPgKar = $pillo[1]; //DataLink
																						$wordsPGKar = trim($dataPgKar, "0..9");
																						if ($PgKar == $wordsPGKar) {
																							//echo 'tetap';
																							$lnk = '<a href="#' . $pillo[1] . '">[ ' . $pillo[1] . ' ]</a>';
																						} else {
																							//echo 'beda';
																							$lnk = '<a href="#' . $pillo[1] . '"  data-value="' . $pillo[1] . '"  onclick="capture(this);">[ ' . $pillo[1] . ' ]</a>';
																						}
																						//===================================
																					} else {
																						$lnk = '';
																					}
																					$lnk2 = $lnk;
																				}
																			}
																			$isRequired = ($ta->must_answer == 'required') ? 'true' : 'false';
																			$paklo = '';
																			$pakwar = '<p class="form-control-static"><textarea class="form-control"  name="' . $ta->ps_id . '" rows="5" data-psid="' . $ta->ps_id . '" data-required="' . $isRequired . '">' . $PilJabIsi . '</textarea>';
																			// $lnk2 = $lnk;
																		} elseif ($ta->ps_tipe_pertanyaan == 5) {
																			$pilja = explode(';', $piljab);
																			// foreach ($pilja as $pj) {
																			$pj = $pilja[0];
																			if ($pj != '') {
																				$pillo = explode(':', $pj);
																				if ($pillo[1] != '') {
																					//Link Data
																					$PgKar = $this->uri->segment(4); //Karakter Halaman
																					$dataPgKar = $pillo[1]; //DataLink
																					$wordsPGKar = trim($dataPgKar, "0..9");
																					if ($PgKar == $wordsPGKar) {
																						$lnk = '<a href="#' . $pillo[1] . '">[ ' . $pillo[1] . ' ]</a>';
																					} else {
																						$lnk = '<a href="#' . $pillo[1] . '"  data-value="' . $pillo[1] . '"  onclick="capture(this);">[ ' . $pillo[1] . ' ]</a>';
																					}
																				} else {
																					$lnk = '';
																				}
																				$lnk2 = $lnk;
																			}
																			$range_text = explode(':', $pilja[1])[0];
																			// }
																			$paklo = '';
																			$jenis_likert = explode(':', explode(';', $piljab)[0])[0];
																			if ($jenis_likert == 'star') {
																				$pakwar = '
																	<div class="rating-stars block" id="rating">
																		<input type="hidden" class="rating-value" name="' . $ta->ps_id . '" id="rating-stars-value" value="' . $PilJabIsi . '"  data-psid="' . $ta->ps_id . '" data-required="' . $isRequired . '">
																		<div class="rating-stars-container">
																			<div class="rating-star">
																				<i class="fa fa-star"></i>
																			</div>
																			<div class="rating-star">
																				<i class="fa fa-star"></i>
																			</div>
																			<div class="rating-star">
																				<i class="fa fa-star"></i>
																			</div>
																			<div class="rating-star">
																				<i class="fa fa-star"></i>
																			</div>
																			<div class="rating-star">
																				<i class="fa fa-star"></i>
																			</div>
																		</div>
																		' . $range_text . '
																	</div>
																	';
																			} elseif ($jenis_likert == 'love') {
																				$pakwar = '
																	<div class="rating-stars block" id="rating">
																		<input type="hidden" class="rating-value" name="' . $ta->ps_id . '" id="another-rating-stars-value" value="' . $PilJabIsi . '"  data-psid="' . $ta->ps_id . '" data-required="' . $isRequired . '">
																		<div class="rating-stars-container">
																			<div class="rating-star">
																				<i class="fa fa-heart"></i>
																			</div>
																			<div class="rating-star">
																				<i class="fa fa-heart"></i>
																			</div>
																			<div class="rating-star">
																				<i class="fa fa-heart"></i>
																			</div>
																			<div class="rating-star">
																				<i class="fa fa-heart"></i>
																			</div>
																			<div class="rating-star">
																				<i class="fa fa-heart"></i>
																			</div>
																		</div>
																		' . $range_text . '
																	</div>
																	';
																			} elseif ($jenis_likert == 'bar') {
																				$se = [];
																				for ($i = 1; $i <= 10; $i++) {
																					if ($PilJabIsi == "$i") {
																						array_push($se, ' selected="selected"');
																					} else {
																						array_push($se, ' ');
																					}
																				}
																				$pakwar = '
																	<div class="box-example-1to10 mb-5">
																		<div class="body">
																			<select id="example-1to10" name="' . $ta->ps_id . '" autocomplete="off">
																				<option value="1"' . $se[0] . '>1</option>
																				<option value="2"' . $se[1] . '>2</option>
																				<option value="3"' . $se[2] . '>3</option>
																				<option value="4"' . $se[3] . '>4</option>
																				<option value="5"' . $se[4] . '>5</option>
																				<option value="6"' . $se[5] . '>6</option>
																				<option value="7"' . $se[6] . '>7</option>
																				<option value="8"' . $se[7] . '>8</option>
																				<option value="9"' . $se[8] . '>9</option>
																				<option value="10"' . $se[9] . '>10</option>
																			</select>
																		</div>
																	</div>';
																			} elseif ($jenis_likert == 'opini') {
																				$se = [];
																				if ($PilJabIsi == "buruk") {
																					array_push($se, ' selected="selected"');
																				} else {
																					array_push($se, ' ');
																				}
																				if ($PilJabIsi == "biasa") {
																					array_push($se, ' selected="selected"');
																				} else {
																					array_push($se, ' ');
																				}
																				if ($PilJabIsi == "bagus") {
																					array_push($se, ' selected="selected"');
																				} else {
																					array_push($se, ' ');
																				}
																				if ($PilJabIsi == "luar biasa") {
																					array_push($se, ' selected="selected"');
																				} else {
																					array_push($se, ' ');
																				}
																				$pakwar = '
																	<div class="border-0 p-0 box-example-movie mb-5">
																<div class="box-body">
																	<select id="example-movie" name="' . $ta->ps_id . '" autocomplete="off" data-psid="' . $ta->ps_id . '" data-required="' . $isRequired . '">
																		<option value="buruk"' . $se[0] . '>Buruk</option>
																		<option value="biasa"' . $se[1] . '>Biasa Saja</option>
																		<option value="bagus"' . $se[2] . '>Bagus</option>
																		<option value="luar biasa"' . $se[3] . '>Luar Biasa</option>
																	</select>
																									</div>
																								</div>';
																			} else {
																				$se = [];
																				for ($i = 1; $i <= 5; $i++) {
																					if ($PilJabIsi == "$i") {
																						array_push($se, ' selected="selected"');
																					} else {
																						array_push($se, ' ');
																					}
																				}
																				$pakwar = '
																<div class="border-0 p-0 box-example-square mb-5">
																	<div class="box-body">
																		<select id="example-square" name="' . $ta->ps_id . '" autocomplete="off" data-psid="' . $ta->ps_id . '" data-required="' . $isRequired . '">
																			<option value="1"' . $se[0] . '>1</option>
																			<option value="2"' . $se[1] . '>2</option>
																			<option value="3"' . $se[2] . '>3</option>
																			<option value="4"' . $se[3] . '>4</option>
																			<option value="5"' . $se[4] . '>5</option>
																		</select>
																	</div>
																</div>';
																			}
																			// $lnk2 = $lnk;
																		} elseif ($ta->ps_tipe_pertanyaan == 6) {
																			$pilja = explode(';', $piljab);
																			foreach ($pilja as $pj) {
																				if ($pj != '') {
																					$pillo = explode(':', $pj);
																					if ($pillo[1] != '') {
																						//$lnk='<a href="#'.$pillo[1].'">[ '.$pillo[1].' ]</a>';
																						//Link Data
																						$PgKar = $this->uri->segment(4); //Karakter Halaman
																						$dataPgKar = $pillo[1]; //DataLink
																						$wordsPGKar = trim($dataPgKar, "0..9");
																						if ($PgKar == $wordsPGKar) {
																							//echo 'tetap';
																							$lnk = '<a href="#' . $pillo[1] . '">[ ' . $pillo[1] . ' ]</a>';
																						} else {
																							//echo 'beda';
																							$lnk = '<a href="#' . $pillo[1] . '"  data-value="' . $pillo[1] . '"  onclick="capture(this);">[ ' . $pillo[1] . ' ]</a>';
																						}
																						//===================================
																					} else {
																						$lnk = '';
																					}
																					if ($PilJabIsi == $pillo[0] && $HitIsian > 0 && $ctTanya == $ta->ps_id) {
																						$radCheck = 'checked';
																					} else {
																						$radCheck = '';
																					}
																					$pakwar .= '<div class="radio"><label><input type="radio" name="' . $ta->ps_id . '" id="' . $ta->ps_id . '" value="' . $pillo[0] . '" data-psid="' . $ta->ps_id . '" data-required="' . $isRequired . '"> ' . $pillo[0] . ' ' . $lnk . '</label></div>';
																					$paklo = $pillo[1];
																				}
																			}
																		} else {
																		}
																		$label = '';
																		if ($ta->must_answer == 'required') {
																			$label .= ' <span class="text-danger">*</span>';
																		}
																		echo '<div class="form-group row" id="pertanyaan_' . $ta->ps_id . '" data-ps-kode="' . $ta->ps_kode . '"> 
															<label class="col-sm-2 form-control-static" id="' . $ta->ps_kode . '">' . $ta->ps_kode . ' ' . $lnk2 . '</label>
															<div class="col-sm-9">
																<b>'
																			. str_replace(['<p>', '</p>'], ['<span>', '</span>'], $ta->ps_pertanyaan) . $label .
																			'</b>
																' . $pakwar . '
																
															</div>
															<div class="col-sm-3">
																<!--<a href="#' . $paklo . '">' . $paklo . '</a>-->
															</div>												
														</div>';
																	}
																	?>
																</div>
															</div>
														</div>
													</div>
												</div>
										<?php
											}
										} ?>
										<?php
										if ($kdseksi == 'validasi') {
										?>
											<div class="panel-heading1 bg-white ">
												<h4 class="panel-title1">
													<a class="accordion-toggle collapsed" data-bs-toggle="collapse" data-bs-parent="#accordion11" href="#collapseFour1X" aria-expanded="false"><b>VALIDASI</b></a>
												</h4>
											</div>
											<div id="collapseFour1X" class="panel-collapse collapse show" role="tabpanel" aria-expanded="false" style="">
												<div class="panel-body border">
													<b>Upload Foto:</b>
													<div class="row row-xs formgroup-wrapper">
														<div class="col-md-5 ">
															<div class="form-group">
																<?php for ($i = 1; $i <= 5; $i++) :
																	if ($i == 1) { ?>
																		<input type="file" name="fotorespoden<?= $i ?>" class="form-control" size="50" placeholder="Foto Validasi ..." required>
																	<?php } else { ?>
																		<input type="file" name="fotorespoden<?= $i ?>" class="form-control" size="50" placeholder="Foto Validasi ...">
																<?php }
																endfor; ?>
																<span style="font-size:0.8em; color:#F00;">*) foto berukuran maksimal 5mb dan berformat png, jpg, jpeg</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php  } ?>
										
									</div>
							</div>
						</div>
						<div class="action-bar">
							<button type="button" class="btn btn-primary" onclick="disableButton(this)">Simpan & Lanjutkan</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script>
			const surveyKey = 'survey_' + <?= json_encode($id_survey) ?> + '_' + <?= json_encode($kode_survey) ?> + '_' + <?= json_encode($this->session->id) ?>;

			let isNavigatingAway = false;

			function showAndEnableAllBetween(sourceElement, targetKode) {
				const sourceQuestionDiv = sourceElement.closest('.form-group.row');
				const targetLabel = document.getElementById(targetKode);
				if (!sourceQuestionDiv || !targetLabel) return;
				const targetQuestionDiv = targetLabel.closest('.form-group.row');

				let currentElement = sourceQuestionDiv.nextElementSibling;
				while (currentElement && currentElement !== targetQuestionDiv) {
					if (currentElement.classList.contains('form-group')) {
						currentElement.style.display = '';
						currentElement.querySelectorAll('input, textarea, select').forEach(input => {
							input.disabled = false;
						});
					}
					currentElement = currentElement.nextElementSibling;
				}
			}

			function hideAndDisableBetween(sourceElement, targetKode) {
				const sourceQuestionDiv = sourceElement.closest('.form-group.row');
				const targetLabel = document.getElementById(targetKode);
				if (!sourceQuestionDiv || !targetLabel) return;
				const targetQuestionDiv = targetLabel.closest('.form-group.row');

				let currentElement = sourceQuestionDiv.nextElementSibling;
				while (currentElement && currentElement !== targetQuestionDiv) {
					if (currentElement.classList.contains('form-group')) {
						currentElement.style.display = 'none';
						currentElement.querySelectorAll('input, textarea, select').forEach(input => {
							input.disabled = true;
						});
					}
					currentElement = currentElement.nextElementSibling;
				}
			}

			function capture(element) {
				const targetKode = $(element).attr('data-value');
				if (!targetKode) return;

				const form = document.getElementById('surveying');
				const actionUrl = form.getAttribute('action');
				const targetElementOnPage = document.getElementById(targetKode);

				if (targetElementOnPage) {
					hideAndDisableBetween(element, targetKode);
					let formData = $(form).serialize();
					$.ajax({
						type: "POST",
						url: actionUrl,
						data: formData,
						dataType: "text",
						success: function(data) {
							try {
								const json = JSON.parse(data);
								$('#target_link').val('');
							} catch (e) {
								alert('Gagal menyimpan progres.');
							}
						},
						error: function(xhr, status, error) {
							alert('Gagal menyimpan progres.');
						}
					});
					$('html, body').animate({
						scrollTop: $(targetElementOnPage).closest('.form-group.row').offset().top - 120
					}, 0);

				} else {
					if (!confirm("Anda akan melompat ke seksi lain. Yakin untuk melanjutkan?")) {
						element.checked = false;
						return;
					}
					isNavigatingAway = true;
					localStorage.removeItem(surveyKey);
					$('#target_link').val(targetKode);
					form.submit();
				}
			}

			function handleRadioEvent(radio) {
				const allRadios = document.querySelectorAll(`input[name="${radio.name}"][data-value]`);
				allRadios.forEach(r => {
					if (r !== radio && r.dataset.value) {
						showAndEnableAllBetween(r, r.dataset.value);
					}
				})

				if (radio.dataset.value) {
					capture(radio);
				}

				const psId = radio.name;
				const relatedExtras = document.querySelectorAll(`.extra-input[data-psid="${psId}"]`);
				relatedExtras.forEach(el => {
					el.style.display = 'none';
					const input = el.querySelector('input');
					if (input) input.value = '';
				});

				if (radio.dataset.type === 'essai') {
					const targetId = radio.dataset.target;
					const targetEl = document.getElementById(targetId);
					if (targetEl) {
						targetEl.style.display = 'block';
					}
				}
			}

			function handleCheckboxEvent(checkbox) {
				if (checkbox.dataset.value && !checkbox.checked) {
					showAndEnableAllBetween(checkbox, checkbox.dataset.value);
				}

				if (checkbox.dataset.value && checkbox.checked) {
					capture(checkbox);
				}

				if (checkbox.dataset.type === 'essai') {
					const targetId = checkbox.dataset.target;
					const inputEl = document.getElementById(targetId);

					if (inputEl) {
						if (checkbox.checked) {
							inputEl.style.display = 'block';
						} else {
							inputEl.style.display = 'none';
							const input = inputEl.querySelector('input');
							if (input) {
								input.value = '';
								checkbox.value = input.dataset.label;
							}
						}
					}
				}
			}

			function updateCheckboxValue(input) {
				const label = input.dataset.label;
				const targetCheckbox = document.getElementById(input.dataset.target);
				if (targetCheckbox) {
					targetCheckbox.value = label + ':' + input.value;
				}
			}

			$(document).on('input', '.extra-input input', function () {
				updateCheckboxValue(this);
			});

			function disableButton(btn) {
				const form = btn.form;
				let isValid = true;

				document.querySelectorAll('.form-group.has-error').forEach(el => el.classList.remove('has-error'));

				const inputs = form.querySelectorAll('input[type=radio], input[type=checkbox]');
				const grouped = {};

				inputs.forEach(input => {
					const name = input.name;
					const psid = input.dataset.psid;
					const isRequired = input.dataset.required == 'true';

					if (!grouped[name]) {
						grouped[name] = {
							required: isRequired,
							psid: psid,
							elements: []
						};
					}
					grouped[name].elements.push(input);
				});

				for (const name in grouped) {
					const group = grouped[name];
					if (!group.required) continue;

					const isChecked = group.elements.some(i => i.checked);
					if (!isChecked) {
						isValid = false;
						const qDiv = document.getElementById('pertanyaan_' + group.psid);
						if (qDiv) qDiv.classList.add('has-error');
					}
				}

				form.querySelectorAll('[data-required="true"]').forEach(input => {
					const tag = input.tagName.toLowerCase();
					const type = input.type;
					const value = input.value?.trim() ?? '';

					if (
						(tag === 'input' && type === 'text' && value === '') ||
						(tag === 'textarea' && value === '') ||
						(tag === 'select' && value === '')
					) {
						isValid = false;
						const psid = input.dataset.psid;
						const qDiv = document.getElementById('pertanyaan_' + psid);
						if (qDiv) qDiv.classList.add('has-error');
					}
				});

				if (!isValid) {
					const firstError = document.querySelector('.has-error');
					if (firstError) {
						const y = firstError.getBoundingClientRect().top + window.pageYOffset - 120;
						window.scrollTo({
							top: y,
							behavior: 'smooth'
						});
						setTimeout(() => firstError.classList.remove('has-error'), 2500);
					}
					return false;
				}

				isNavigatingAway = true;
				localStorage.removeItem(surveyKey);
				btn.disabled = true;
				btn.innerText = 'Menyimpan...';
				btn.form.submit();
			}

			function saveSurveyProgress() {
				if (isNavigatingAway) return;

				const form = document.getElementById('surveying');
				if (!form) return;
				const data = {};
				new FormData(form).forEach((value, key) => {
					if (data[key]) {
						if (!Array.isArray(data[key])) {
							data[key] = [data[key]];
						}
						data[key].push(value);
					} else {
						data[key] = value;
					}
				});
				const kdseksiInput = form.querySelector('input[name="kdseksi"]');
				if (kdseksiInput) data['last_kdseksi'] = kdseksiInput.value;
				localStorage.setItem(surveyKey, JSON.stringify(data));
			}

			function restoreSurveyProgress() {
				const saved = localStorage.getItem(surveyKey);
				if (!saved) return;
				const data = JSON.parse(saved);

				if (data['last_kdseksi'] && data['last_kdseksi'] !== "<?= $kdseksi ?>") {
					window.location.href = "<?= base_url() ?>user/survey_form/<?= $id_survey ?>/<?= $kode_survey ?>/" + data['last_kdseksi'];
					return;
				}

				const form = document.getElementById('surveying');
				for (const key in data) {
					if (key === 'last_kdseksi' || !form.elements[key]) continue;
					const elements = form.elements[key];

					if (elements.length && elements[0].type) {
						if (elements[0].type === 'radio') {
							Array.from(elements).forEach(r => {
								if (r.value == data[key]) r.checked = true;
							});
						} else if (elements[0].type === 'checkbox') {
							const values = Array.isArray(data[key]) ? data[key] : [data[key]];
							Array.from(elements).forEach(c => {
								if (values.includes(c.value)) c.checked = true;
							});
						}
					} else {
						elements.value = data[key];
					}
				}
				const radios = form.querySelectorAll('input[type=radio][data-value]');
				radios.forEach(radio => {
					if (radio.checked && radio.dataset.value) {
						hideAndDisableBetween(radio, radio.dataset.value);
					}
				});
				const checkboxes = form.querySelectorAll('input[type=checkbox][data-value]');
				checkboxes.forEach(checkbox => {
					if (checkbox.checked && checkbox.dataset.value) {
						hideAndDisableBetween(checkbox, checkbox.dataset.value);
					}
				});
			}

			document.addEventListener('change', saveSurveyProgress);
			document.addEventListener('input', saveSurveyProgress);
			window.addEventListener('DOMContentLoaded', restoreSurveyProgress);
		</script>
	</div>
</div>