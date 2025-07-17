  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">List Survey</h4>

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


				<?php } ?>

                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Kode Survey</th>
                        <th>Nama Survey</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Token Survey</th>
                        <th>Generate Token</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

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
							<a href="<?=base_url()?>admin/survey_detail/<?=$lu->id_survey;?>"><button class="btn btn-sm btn-success"><i class="fa fa-menu"></i> Detail</button></a>&nbsp;<br>
							<a href="<?=base_url()?>survey/edit/<?=$lu->id_survey;?>"><button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</button></a>&nbsp;<br>
							<button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusSurvey<?=$lu->id_survey;?>"><i class="fa fa-trash"></i> Hapus</button>
						</td>
                      </tr>

					  <!-- Modal -->
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
              <!--/ Hoverable Table rows -->
              
            </div>
            <!-- / Content -->