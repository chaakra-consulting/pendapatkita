                <div class="container">
                    <div class="modal fade" id="tambahSurvey" tabindex="-1" aria-labelledby="tambahSurveyLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="tambahSurveyLabel"> Tambah Pool Data</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div> 
                                <form action="<?= base_url(); ?>admin/tambah_pool_data" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="NamaData">Nama Data:</label>
                                            <input type="text" name="NamaData" class="form-control" placeholder="Masukkan Nama Data" required>
                                        </div>   
                                        <div class="form-group">
                                            <label for="Keterangan">Keterangan:</label>
                                            <textarea name="Keterangan" class="form-control" placeholder="Masukkan keterangan data" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="left-content">
                            <br>
                            <br>
							 <h1 class="content-title mb-0 my-auto">Pool Data</h1>
						</div>
						<div class="main-dashboard-header-right">
							<!-- <a href="<?=base_url()?>survey"><button style="height:30px;" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-arrow-left"></i> Back</button></a> &nbsp;  -->
							<button class="btn btn-sm btn-flat btn-success" data-bs-toggle="modal" style="height:30px;" data-bs-target="#tambahSurvey"><i class="fa fa-plus"></i> Tambah Pool Data</button>
						</div>
					</div>
                    <br>
					<div class="row row-sm row-deck">
						<div class="col-xl-12">
                            <div class="card mg-b-20">
                                <div class="card-header pb-0">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title mg-b-0">Pool Data</h4>
                                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                                    </div>
                                </div>
                                <div class="card-body">		

                                    <div class="table-responsive">
                                        <table id="example" class="table key-buttons text-md-nowrap">
                                            <thead>
                                                <tr> 									
                                                    <th>No.</th>
                                                    <th>Nama Data</th> 
                                                    <th>Keterangan</th>  
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                            <?php 
                                                $no = 1;
                                                foreach ($listpooldata as $lu) { ?>
                                                <tr>
                                                    <td><?=$no++;?>.</td>
                                                    <td><?=$lu->pd_nama_kategori;?></td>  
                                                    <td><?=$lu->pd_keterangan ?? '-';?></td>  
                                                    <td>
                                                        <a href="<?=base_url()?>admin/hasil_pool_data/<?=$lu->id_pool_data;?>"><button class="btn btn-sm btn-success"><i class="fa fa-bars"></i>Lihat Data</button></a> 
                                                        <a href="<?=base_url()?>admin/pool_data_detail/<?=$lu->id_pool_data;?>"><button class="btn btn-sm btn-info"><i class="fa fa-network-wired"></i>Atur Relasi</button></a> 
                                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$lu->id_pool_data;?>"><i class="fa fa-edit"></i> Edit</button>
                                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusPoolData<?=$lu->id_pool_data;?>"><i class="fa fa-trash"></i> Hapus</button>
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="edit<?=$lu->id_pool_data;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h6 class="modal-title"> Edit Seksi Survey</h6>
                                                            <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button> 
                                                            </div>
                                                            <form action="<?=base_url();?>admin/edit_pool_data/<?=$lu->id_pool_data;?>" method="POST">
                                                            <div class="modal-body">
                                                                <div class="box-body">
                                                                    <div class="form-group">
                                                                        <label for="NamaData">Nama Data:</label>
                                                                        <input type="text" name="NamaData" class="form-control" placeholder="Masukkan Nama Data" value="<?=$lu->pd_nama_kategori;?>" required>
                                                                    </div>  
                                                                    <div class="form-group">
                                                                        <label for="Keterangan">Keterangan:</label>
                                                                        <textarea name="Keterangan" class="form-control" placeholder="Masukkan keterangan data" rows="3"><?= $lu->pd_keterangan; ?></textarea>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="hapusPoolData<?=$lu->id_pool_data;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h6 class="modal-title"> Hapus Pool Data</h6>
                                                            <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                                                
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="box-body">
                                                                    <h4>Anda yakin akan menghapus <?=$lu->pd_nama_kategori;?>?</h4>
                                                                    
                                                                </div>
                                                                <div class="box-footer">
                                                                    <a href="<?= base_url('admin/hapus_pool_data/'.$lu->id_pool_data);?>" class="btn btn-danger">Ya</a> &nbsp;
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