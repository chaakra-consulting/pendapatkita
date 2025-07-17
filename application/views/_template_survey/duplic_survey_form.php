<?php
$dtJS=$this->m_user->data_jawaban_survey($kode_survey)->row_array();
//kode_survey
$hitDt=count($dtJS);

$pewawancara=$this->session->nama;
$pemeriksa='';
$koderesponden='';
$namaresponden='';

if($hitDt>0){
	
	$pewawancara=$dtJS['js_pewawancara'];
	$pemeriksa=$dtJS['js_pemeriksa'];
	$koderesponden=$dtJS['js_kode_responden'];
	$namaresponden=$dtJS['js_nama_responden'];
}
//print_r($dtJS);


?>
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
						<div class="col-lg-4 col-md-4">
							<div class="card overflow-hidden">
								<div class="card-header pb-0">
									<h3 class="card-title">LIST SEKSI SURVEY</h3>
									<p class="text-muted card-sub-title mb-0"></p>
								</div>
								<div class="card-body"> 
									<nav class="nav nav-pills flex-column">
											<a class="nav-link <?php if($kdseksi=='data'||$kdseksi==FALSE){ echo 'active';}?>" href="<?=base_url();?>survey/<?=$id_survey;?>/<?=$kode_survey;?>/data">DATA SURVEY</a>
										<?php
											$no=0;
											$lds='';
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
											//$a = array(1 => 'one', 2 => 'two', 3 => 'three');  
											$aplink = array();  
											$aplink[]='data';
											foreach($list_seksi as $ds){
												$no++;
												$aplink[]=$ds->ss_kode;
												if($kdseksi==$ds->ss_kode){ 
													$lds='active';
												}else{
													$lds='';
												}
												
												if($hitDt>0){
												
										?>
												<a class="nav-link <?=$lds;?>" href="<?=base_url();?>survey/<?=$id_survey;?>/<?=$kode_survey;?>/<?=$ds->ss_kode?>">SEKSI <?=$ds->ss_kode?> : <?=$ds->ss_judul?></a>
										<?php
												}
											}
											$aplink[]='validasi';
											$aplink[]='upload';
											//CekForm Berikutnya
											$palink=array_keys($aplink,$kdseksi,false);
											$aplinkafter=$palink[0]+1;
											
											if($hitDt>0){
												 
										?> 
											<a class="nav-link <?php if($kdseksi=='validasi'){ echo 'active';}?>" href="<?=base_url();?>survey/<?=$id_survey;?>/<?=$kode_survey;?>/validasi">VALIDASI</a>
											
											<?php } ?>
									</nav>
									<?php //print_r($a); array_key_exists($a,);?>
								</div>
							</div>
						</div>
						<div class="col-lg-8 col-md-8">
							<div class="card overflow-hidden">
								<div class="card-header pb-0">
									<h3 class="card-title">ISIAN SURVEY</h3>
									<p class="text-muted card-sub-title mb-0"></p>
								</div>
								<div class="card-body">
									<form method="POST" name="surveying" id="surveying" action="<?=base_url()?>user/survey_formsave/<?=$aplink[$aplinkafter];?>/<?=$detil_survey->id_survey;?>" enctype="multipart/form-data">
									<input type="hidden" name="id_survey" value="<?=$id_survey?>">
									<input type="hidden" name="kdseksi" value="<?=$kdseksi;?>">
									<input type="hidden" name="kode_survey" value="<?=$kode_survey?>">
									<div class="panel-group1" id="accordion11">
									
									
											<?php 
												if($kdseksi=='data'||$kdseksi==FALSE){ 
											?>
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
															
															<input type="text" name="pewawancara" class="form-control" placeholder="Pewawancara ..." value="<?=$pewawancara;?>" required>
														</div>
														<div class="form-group">
															<label>Pemeriksa</label>
															<input type="text" name="pemeriksa" class="form-control" placeholder="Pemeriksa ..." value="<?=$pemeriksa;?>">
														</div>
														</div>
														<div class="col-md-6">
																
														
														
														<div class="form-group">
															<label>Kode Responden</label>
															<input type="text" name="koderesponden" class="form-control" placeholder="Kode Responden ..." value="<?=$koderesponden;?>">
														</div>
														<div class="form-group">
															<label>Nama Responden</label>
															<input type="text" name="namaresponden" class="form-control" placeholder="Nama Responden ..." required  value="<?=$namaresponden;?>">
														</div>
														</div>
													</div>
												</div>
											</div>
											
										</div>
										<?php } ?>
										<?php
											$no=0;
											foreach($list_seksi as $ds){
												$no++;
												
												
											
												if($kdseksi==$ds->ss_kode){ 
											
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
				$PilJabIsi='';
				
								
				foreach($dt_pertanyaan as $ta){ 
				
					//Jawaban
					$isianjawaban=$this->m_user->data_survey_temp($kode_survey,$kdseksi)->result();
					$HitIsian=count($isianjawaban);
					if($HitIsian>0){
						$dijab=$isianjawaban[0];
						$jbIsi=$dijab->tjs_jawaban;
						$dtJbEx=explode(';',$jbIsi);
						//print_r($dtJbEx);
						
						$ctTanya='';//Cetak No Tanya
						$ctJawab='';
						foreach($dtJbEx as $JbEx){
							$ExpJbExIsi=explode(':',$JbEx);
							
							$NoTanya=$ExpJbExIsi[0];
							if($ta->ps_id==$NoTanya){
								$ctTanya=$NoTanya;
								$ctJawab=$ExpJbExIsi[1];
							}
							//
						}
						//echo $ctTanya.'-';
						//echo $ctJawab;
						
						$PilJabIsi=$ctJawab;
					}
					//End Jawaban
					$piljab=$ta->ps_pilihan_jawaban;
					$paklo='';
					$pakwar='';
					
					if($ta->ps_tipe_pertanyaan==1){
						$pilja = explode(';', $piljab);
						
						 $radCheck='';		
						foreach($pilja as $pj){
							if($pj!=''){
								$pillo = explode(':', $pj);
								
								if($pillo[1]!=''){
								    $lnk='<a href="#'.$pillo[1].'">[ '.$pillo[1].' ]</a>';
								}else{
								    $lnk='';
								}
								
								if($PilJabIsi==$pillo[0]&&$HitIsian>0&&$ctTanya==$ta->ps_id)
								{
									$radCheck='checked';
								}else{
									$radCheck=''; 
								}
								
								$pakwar.='<div class="radio"><label><input type="radio" name="'.$ta->ps_id.'" id="'.$ta->ps_id.'" value="'.$pillo[0].'" '.$radCheck.'> '.$pillo[0].' '.$lnk.'</label></div>'; 
								$paklo=$pillo[1];
							
							}
							
						}
						
					}elseif($ta->ps_tipe_pertanyaan==2){
						$pilja = explode(';', $piljab);
						$boxCheck='checked'; 
						foreach($pilja as $pj){
							if($pj!=''){
								$pillo = explode(':', $pj);
								
								
								if($pillo[1]!=''){
								    $lnk='<a href="#'.$pillo[1].'">[ '.$pillo[1].' ]</a>';
								}else{
								    $lnk='';
								}
								
								$PisKom=explode(',',$PilJabIsi);
								$boxCheck=''; 
								foreach($PisKom as $PK){
									//$boxCheck=''; 
									if($PK==$pillo[0]&&$HitIsian>0&&$ctTanya==$ta->ps_id)
									{
										//echo $PK.'(*)';
										$boxCheck='checked';
									}
								}
								
								$pakwar.='<div class="checkbox"><label><input type="checkbox" name="'.$ta->ps_id.'[]" id="'.$ta->ps_id.'" value="'.$pillo[0].'" '.$boxCheck.'> '.$pillo[0].' '.$lnk.'</label></div>'; 
								$paklo=$pillo[1];
							
							}
							
						}
					}elseif($ta->ps_tipe_pertanyaan==3){
						$paklo=''; 
						$pakwar='<p class="form-control-static"><input type="text" class="form-control"  name="'.$ta->ps_id.'"  placeholder="'.$ta->ps_pertanyaan.'" value="'.$PilJabIsi.'"></p>';
					}elseif($ta->ps_tipe_pertanyaan==4){
						$paklo=''; 
						$pakwar='<p class="form-control-static"><textarea class="form-control"  name="'.$ta->ps_id.'" rows="5" placeholder="'.$ta->ps_pertanyaan.'">'.$PilJabIsi.'</textarea>';
					}elseif($ta->ps_tipe_pertanyaan==5){
						$pilja = explode(';', $piljab);
						
						foreach($pilja as $pj){
							if($pj!=''){
								$pillo = explode(':', $pj);
								
								if($pillo[1]!=''){
								    $lnk='<a href="#'.$pillo[1].'">[ '.$pillo[1].' ]</a>';
								}else{
								    $lnk='';
								}
								
								if($PilJabIsi==$pillo[0]&&$HitIsian>0&&$ctTanya==$ta->ps_id)
								{
									$radCheck='checked';
								}else{
									$radCheck=''; 
								}
								
								$pakwar.='<div class="radio"><label><input type="radio" name="'.$ta->ps_id.'" id="'.$ta->ps_id.'" value="'.$pillo[0].'"> '.$pillo[0].' '.$lnk.'</label></div>'; 
								$paklo=$pillo[1];
							
							}
							
						}
						
					}else{
						
					}
					
					
					echo '<div class="form-group row"> 
								<label class="col-sm-2 form-control-static" id="'.$ta->ps_kode.'">'.$ta->ps_kode.'</label>
								
								<div class="col-sm-7">
									<b>'.$ta->ps_pertanyaan.'</b>
									'.$pakwar.'
									
								</div> 
								 
								<div class="col-sm-3">
								    <!--<a href="#'.$paklo.'">'.$paklo.'</a>-->
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
												if($kdseksi=='validasi'){ 
											?>
											<div class="panel-heading1 bg-primary ">
												<h4 class="panel-title1">
													<a class="accordion-toggle collapsed" data-bs-toggle="collapse" data-bs-parent="#accordion11" href="#collapseFour1X" aria-expanded="false"><i class="fe fe-arrow-right me-2"></i><b>VALIDASI</b></a>
												</h4>
											</div>
											
											<div id="collapseFour1X" class="panel-collapse collapse show" role="tabpanel" aria-expanded="false" style="">
												<div class="panel-body border"> 
													<b>Upload Foto:</b> <br><br>
													<div class="row row-xs formgroup-wrapper">
														
														<div class="col-md-5 ">
																
														<div class="form-group">
															 
															
															<input type="file" name="fotorespoden" class="form-control" placeholder="Foto Validasi ..." required>
															<span style="font-size:0.8em; color:#F00;">*) foto berukuran maksimal 2mb dan berformat png, jpg, jpeg</span>
														</div> 
														</div> 
													</div>
												</div>
											</div>
												<?php  } ?>
										</div>
										
										  
									</div>
								</div>
								
								<center><button type="submit" class="btn btn-primary">Simpan & Lanjutkan</button></center>
								<br>
								</form>
							</div>
							
						</div>
					</div>
				</div>
					
