<style>
label {font-weight:bold;}
</style>
				<div class="container">
					<div class="breadcrumb-header justify-content-between">
						<div class="my-auto">
							<div class="d-flex">
								<center><h4 class="content-title mb-0 my-auto">SURVEY : <?=$detil_survey->nama_survey;?></h4> </center>
							</div> 
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="card overflow-hidden">
								<div class="card-header pb-0">
									<h3 class="card-title"></h3>
									<p class="text-muted card-sub-title mb-0"></p>
								</div>
								<div class="card-body">
									<form method="POST" name="surveying" id="surveying" action="<?=base_url()?>user/surveysave/<?=$detil_survey->id_survey;?>" enctype="multipart/form-data">
									<div class="panel-group1" id="accordion11">
									
										<div class="panel panel-default  mb-4">
											
											<div class="panel-heading1 bg-primary ">
												<h4 class="panel-title1">
													<a class="accordion-toggle collapsed" data-bs-toggle="collapse" data-bs-parent="#accordion11" href="#collapseFour1" aria-expanded="false"><i class="fe fe-arrow-right me-2"></i><b>DATA SURVEY</b></a>
												</h4>
											</div>
											
											<div id="collapseFour1" class="panel-collapse collapse show" role="tabpanel" aria-expanded="false" style="">
												<div class="panel-body border">
													<input type="hidden" name="id_survey" value="<?=$detil_survey->id_survey;?>">
													<b>Silahkan isi data berikut :</b> <br><br>
													<div class="row row-xs formgroup-wrapper">
														
														<div class="col-md-6 ">
																
														<div class="form-group">
															<label>Pewawancara</label>
															
															<input type="text" name="pewawancara" class="form-control" placeholder="Pewawancara ..." value="<?=$this->session->nama;?>">
														</div>
														<div class="form-group">
															<label>Pemeriksa</label>
															<input type="text" name="pemeriksa" class="form-control" placeholder="Pemeriksa ...">
														</div>
														</div>
														<div class="col-md-6">
																
														
														
														<div class="form-group">
															<label>Kode Responden</label>
															<input type="text" name="koderesponden" class="form-control" placeholder="Kode Responden ...">
														</div>
														<div class="form-group">
															<label>Nama Responden</label>
															<input type="text" name="namaresponden" class="form-control" placeholder="Nama Responden ...">
														</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<?php
											$no=0;
											foreach($list_seksi as $ds){
												$no++;
										?>
										<div class="panel panel-default  mb-4">
											<div class="panel-heading1 bg-primary ">
												<h4 class="panel-title1">
													<a class="accordion-toggle collapsed" data-bs-toggle="collapse" id="<?=$ds->ss_kode?>" data-bs-parent="#accordion11" href="#collapseSur<?=$no;?>" aria-expanded="false"><i class="fe fe-arrow-right me-2"></i><b>SEKSI <?=$ds->ss_kode?> : <?=$ds->ss_judul?></b></a>
												</h4>
											</div>
											
											<div id="collapseSur<?=$no;?>" class="panel-collapse collapse show" id="" role="tabpanel" aria-expanded="false" style="">
												<div class="panel-body border">
													<?php if($ds->ss_keterangan!=''){ echo '<p class="help-block">'.$ds->ss_keterangan.'</p>';} ?>
													 
													<div class="row row-xs formgroup-wrapper">
														
														
														
														<div class="col-md-12 ">
														
<?php 
				$dt_pertanyaan=$this->m_user->list_pertanyaan_by_seksi($ds->id_seksi)->result();
				
				foreach($dt_pertanyaan as $ta){
					
					$piljab=$ta->ps_pilihan_jawaban;
					$paklo='';
					$pakwar='';
					
					if($ta->ps_tipe_pertanyaan==1){
						$pilja = explode(';', $piljab);
						
						foreach($pilja as $pj){
							if($pj!=''){
								$pillo = explode(':', $pj);
								$pakwar.='<div class="radio"><label><input type="radio" name="'.$ta->ps_id.'" id="'.$ta->ps_id.'" value="'.$pillo[0].'"> '.$pillo[0].'</label></div>'; 
								$paklo=$pillo[1];
							
							}
							
						}
						
					}elseif($ta->ps_tipe_pertanyaan==2){
						$pilja = explode(';', $piljab);
						
						foreach($pilja as $pj){
							if($pj!=''){
								$pillo = explode(':', $pj);
								$pakwar.='<div class="checkbox"><label><input type="checkbox" name="'.$ta->ps_id.'[]" id="'.$ta->ps_id.'" value="'.$pillo[0].'"> '.$pillo[0].'</label></div>'; 
								$paklo=$pillo[1];
							
							}
							
						}
					}elseif($ta->ps_tipe_pertanyaan==3){
						$paklo=''; 
						$pakwar='<p class="form-control-static"><input type="text" class="form-control"  name="'.$ta->ps_id.'"  placeholder="'.$ta->ps_pertanyaan.'"></p>';
					}elseif($ta->ps_tipe_pertanyaan==4){
						$paklo=''; 
						$pakwar='<p class="form-control-static"><textarea class="form-control"  name="'.$ta->ps_id.'" rows="5" placeholder="'.$ta->ps_pertanyaan.'"></textarea>';
					}else{
						
					}
					
					
					echo '<div class="form-group row"> 
								<label class="col-sm-1 form-control-static">'.$ta->ps_kode.'</label>
								
								<div class="col-sm-4">
									<b>'.$ta->ps_pertanyaan.'</b>
									'.$pakwar.'
									
								</div> 
								 
								<div class="col-sm-3">
									<a href="#'.$paklo.'">'.$paklo.'</a>
								</div>												
							</div>';
					 
				}
				
			?>														
														 
														</div>
													</div>
												</div>
											</div>
										</div>
										<?php } ?>
										
										
											<div class="panel-heading1 bg-primary ">
												<h4 class="panel-title1">
													<a class="accordion-toggle collapsed" data-bs-toggle="collapse" data-bs-parent="#accordion11" href="#collapseFour1X" aria-expanded="false"><i class="fe fe-arrow-right me-2"></i><b>VALIDASI</b></a>
												</h4>
											</div>
											
											<div id="collapseFour1X" class="panel-collapse collapse show" role="tabpanel" aria-expanded="false" style="">
												<div class="panel-body border"> 
													<b>Upload Foto:</b> <br><br>
													<div class="row row-xs formgroup-wrapper">
														
														<div class="col-md-3 ">
																
														<div class="form-group">
															 
															
															<input type="file" name="fotorespoden" class="form-control" placeholder="Foto Validasi ..." >
														</div> 
														</div> 
													</div>
												</div>
											</div>
										</div>
										
										  
									</div>
								</div>
								
								<center><button type="submit" class="btn btn-primary">Submit</button></center>
								<br>
								</form>
							</div>
							
						</div>
					</div>
				</div>
					
