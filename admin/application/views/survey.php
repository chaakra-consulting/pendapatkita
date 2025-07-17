  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">List Survey</h4> -->

             <br> 
			 <?php if ($this->session->status == 'admin') { ?>
			  	<div class="main-dashboard-header-right">
					<a href="<?=base_url()?>"><button class="btn btn-large btn-flat btn-danger"><i class="fa fa-arrow-left"></i> Back</button></a> &nbsp; 
					<a href="<?=base_url()?>survey/tambah"><button class="btn btn-large btn-flat btn-success"><i class="fa fa-plus"></i> Tambah Survey</button></a>				 
				</div>
            <br>
			<?php } ?>

              <!-- Hoverable Table rows -->
              <div class="card">
                <!-- <h5 class="card-header">List Survey</h5> -->
                <div class="table-responsive text-wrap">

                <?php 
	if($page=='tambah'||$page=='edit'){
		 
		 $idSurvey='';
		 $kodeSurvey='';
		 $namaSurvey='';
		 $tglSurvey='';
		 $tglSelSurvey='';
		 $buton='Tambah';
		 //DBtoJS
		 
		if($page=='edit'&&$id!=''){	
		$idSurvey=$dtsurvey[0]->id_survey;
			 $kodeSurvey=$dtsurvey[0]->kode_survey;
		 $namaSurvey=$dtsurvey[0]->nama_survey;
		 $tglSurvey=DBtoJS($dtsurvey[0]->tanggal);
		 $tglSelSurvey=DBtoJS($dtsurvey[0]->tanggal_selesai);
		 $buton='Update';
		}
		
		
?>						
					<div class="row row-sm row-deck">
						 <div class="breadcrumb-header justify-content-between">
						<div class="left-content">
							 <h4 class="content-title mb-0 my-auto"> <i class="fa fa-list"></i>  <?=$buton;?> Survey</h4>
						</div>
						<div class="main-dashboard-header-right">
							
						</div>
					</div>
						<div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
							<div class="card">
								<div class="card-body">
								<form action="<?=base_url();?>admin/tambah_survey" method="POST">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="KodeSurvey">Kode Survey :</label>
                                            <input type="hidden" name="idSurvey" value="<?=$idSurvey;?>">
                                            <input type="text" name="KodeSurvey" class="form-control" placeholder="Masukkan Kode Survey" value="<?=$kodeSurvey?>" required>
                                        </div>  
                                        <div class="form-group">
                                            <label for="nmSurvey">Nama Survey :</label>
                                            <input type="text" name="nmSurvey" class="form-control" placeholder="Masukkan Nama Survey"  value="<?=$namaSurvey?>" required>
                                        </div>  
										
										<div class="row row-sm mg-b-20">
										<div class="input-group col-md-4">
											
										</div>
									</div>
									
                                        <div class="form-group">
                                            <label for="Tanggal">Tanggal :</label> 
                                            <div class="input-group date"> 
                                                 <div class="input-group-text">
												<div class="input-group-text">
													<i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
												</div>
											</div><input class="form-control fc-datepicker"  name="tanggal" placeholder="MM/DD/YYYY" value="<?=$tglSurvey?>"  type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Tanggal">Sampai Tanggal :</label>
											<div class="input-group date"> 
                                                 <div class="input-group-text">
												<div class="input-group-text">
													<i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
												</div>
											</div><input class="form-control fc-datepicker"  name="tanggal_selesai" placeholder="MM/DD/YYYY" value="<?=$tglSelSurvey?>"  type="text">
                                            </div> 
                                        </div>
                                    </div>
                                    <br>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-success"><?=$buton;?></button>
                                    </div>
                                </form>
									 
								</div>
							</div>
						</div>
					</div>

	<?php } ?>
					<!-- breadcrumb -->
					<!-- <div class="breadcrumb-header justify-content-between">
						<div class="left-content">
							 <h4 class="content-title mb-0 my-auto">Data Survey</h4>
						</div>
						<div class="main-dashboard-header-right">
							<a href="<?=base_url()?>"><button class="btn btn-sm btn-flat btn-danger"><i class="fa fa-arrow-left"></i> Back</button></a> &nbsp; 
							 <a href="<?=base_url()?>survey/tambah"><button class="btn btn-sm btn-flat btn-success"><i class="fa fa-plus"></i> Tambah Survey</button></a>
							 
						</div>
					</div>  -->
					<div class="row row-sm row-deck">
						<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<!-- <h4 class="card-title mg-b-0">Survey</h4> -->
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">Data Survey</p>
							</div>
							<div class="card-body">
							
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
											<tr> 									
												<th class="border-bottom-0">No.</th>
												<th class="border-bottom-0">Kode Survey</th>  
												<th class="border-bottom-0">Nama Survey</th>  
												<th class="border-bottom-0">Tanggal Pelaksanaan	</th>
												<th class="border-bottom-0">Token Survey</th>  
												<th class="border-bottom-0">Generate Token</th>
												<th class="border-bottom-0">Aksi</th>
											</tr>
										</thead>
										<tbody> 
										<?php 
											$no = 1;
											foreach ($listsurvey as $lu) { ?>
											<tr>
												<td><?=$no++;?>.</td>
												<td><?=$lu->kode_survey;?></td>  
												<td><?=$lu->nama_survey;?></td>  
												<td><?=TglIndo($lu->tanggal);?> - <?=TglIndo($lu->tanggal_selesai);?></td>
												<td><?=$lu->token_survey;?></td>
													<td>
														<a href="<?=base_url()?>admin/generate_token/<?=$lu->id_survey;?>"><button class="btn btn-sm btn-success"><i class="fa fa-menu"></i> Generate Token</button></a>
													</td>
													<td>
													<a href="<?=base_url()?>admin/survey_detail/<?=$lu->id_survey;?>"><button class="btn btn-sm btn-success"><i class="fa fa-menu"></i> Detail</button></a>
													<a href="<?=base_url()?>survey/edit/<?=$lu->id_survey;?>"><button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</button></a>
													<button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusSurvey<?=$lu->id_survey;?>"><i class="fa fa-trash"></i> Hapus</button>
												</td>
											</tr>
											
											<div class="modal fade" id="hapusSurvey<?=$lu->id_survey;?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
								<div class="modal-header">
									<h6 class="modal-title"><i class="fa fa-trash"></i>  Hapus Survey</h6><button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
						</div> 
                                    <div class="modal-body">
                                        <div class="box-body">
                                            <h4>Anda yakin akan menghapus Survey <?=$lu->nama_survey;?>?</h4>
                                            
                                        </div>
                                        <div class="box-footer">
                                            <a href="<?= base_url('admin/hapus_survey/'.$lu->id_survey);?>" class="btn btn-danger">Ya</a> &nbsp;
                                            <button class="btn btn-default" data-bs-dismiss="modal">Tidak</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
										<?php } ?> 
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->
					</div>
					
					
</div> 
              <!--/ Hoverable Table rows -->
              
            </div>
            <!-- / Content -->