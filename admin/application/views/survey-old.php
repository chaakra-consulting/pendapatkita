<div class="content-wrapper">
    <section class="content-header">
        <h1 class="text-center">Survey</h1>
    </section>
    <section class="content">
        <div class="box box-warning">
            <div class="box-header with-border">
                <button class="btn btn-sm btn-flat btn-success" data-toggle="modal" data-target="#tambahSurvey"><i class="fa fa-plus"></i> Tambah Survey</button>

                <div class="modal fade" id="tambahSurvey">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><i class="fa fa-list"></i> Tambah Survey</h4>
                            </div>
                            <div class="modal-body">
                                <form action="admin/tambah_survey" method="POST">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="KodeSurvey">Kode Survey :</label>
                                            <input type="text" name="KodeSurvey" class="form-control" placeholder="Masukkan Kode Survey" required>
                                        </div>  
                                        <div class="form-group">
                                            <label for="nmSurvey">Nama Survey :</label>
                                            <input type="text" name="nmSurvey" class="form-control" placeholder="Masukkan Nama Survey" required>
                                        </div>  
                                        <div class="form-group">
                                            <label for="Tanggal">Tanggal :</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                <input type="text" name="tanggal" class="form-control pull-right" id="tanggalSurvey" placeholder="Pilih Tanggal" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Tanggal">Sampai Tanggal :</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                <input type="text" name="tanggal_selesai" class="form-control pull-right" id="tanggalselesaiSurvey" placeholder="Pilih Tanggal" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-success">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body">

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Survey</th>  
                            <th>Nama Survey</th>  
                            <th>Tanggal Pelaksanaan	</th>
                            <th>#</th>
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
                            <td>
                                <a href="<?=base_url()?>admin/survey_detail/<?=$lu->id_survey;?>"><button class="btn btn-xs btn-success"><i class="fa fa-menu"></i> Detail</button></a> &nbsp;
                                <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#edit<?=$lu->id_survey;?>"><i class="fa fa-edit"></i> Edit</button> &nbsp;
                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hapusSurvey<?=$lu->id_survey;?>"><i class="fa fa-trash"></i> Hapus</button>
                            </td>
                        </tr>
                        <div class="modal fade" id="edit<?=$lu->id_survey;?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><i class="fa fa-list"></i> Edit Survey</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="admin/edit_survey/<?=$lu->id_survey;?>" method="POST">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="KodeSurvey">Kode Survey :</label>
                                                    <input type="text" name="KodeSurvey" class="form-control" placeholder="Masukkan Kode Survey" value="<?=$lu->kode_survey;?>" required>
                                                </div>  
                                                <div class="form-group">
                                                    <label for="NamaSurvey">Nama Survey :</label>
                                                    <input type="text" name="nmSurvey" class="form-control" placeholder="Masukkan Nama Survey" value="<?=$lu->nama_survey;?>" required>
                                                </div>  
                                                <div class="form-group">
                                                    <label for="Tanggal">Tanggal :</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                        <input type="text" name="tanggal" class="form-control pull-right" id="tanggalSurveyedit<?=$lu->id_survey;?>" placeholder="Pilih Tanggal" value="<?=$lu->tanggal;?>" required>
                                                    </div>
                                                    <script>
                                                        $(document).ready(function(){
                                                            $('#tanggalSurveyedit<?=$lu->id_survey;?>').datepicker({
                                                                autoclose: true,
                                                                todayHighlight: true,
                                                                format: 'yyyy-mm-dd'
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Tanggal">Tanggal Selesai:</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                        <input type="text" name="tanggal_selesai" class="form-control pull-right tanggalselesaiSurvey" id="tanggalselesaiSurveyedit<?=$lu->id_survey;?>" placeholder="Pilih Tanggal" value="<?=$lu->tanggal_selesai;?>" required>
                                                    </div>
                                                    <script>
                                                        $(document).ready(function(){
                                                            $('#tanggalSurveyedit<?=$lu->id_survey;?>').datepicker({
                                                                autoclose: true,
                                                                todayHighlight: true,
                                                                format: 'yyyy-mm-dd'
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="hapusSurvey<?=$lu->id_survey;?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Survey</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="box-body">
                                            <h4>Anda yakin akan menghapus Survey <?=$lu->nama_survey;?>?</h4>
                                            
                                        </div>
                                        <div class="box-footer">
                                            <a href="<?= base_url('admin/hapus_survey/'.$lu->id_survey);?>" class="btn btn-danger">Ya</a> &nbsp;
                                            <button class="btn btn-default" data-dismiss="modal">Tidak</button>
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

    </section>
</div>

<script>
$(document).ready(function(){
     $('#tanggalSurvey').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });
    $('#tanggalselesaiSurvey').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });
    $('.tanggalselesaiSurvey').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });
    $('.table').DataTable();
})
</script>