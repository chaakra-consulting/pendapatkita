<div class="container">
    <?php
    if ($page == 'tambah' || $page == 'edit') {

        $idSurvey = '';
        $kodeSurvey = '';
        $namaSurvey = '';
        $tglSurvey = '';
        $tglSelSurvey = '';
        $buton = 'Tambah';
        //DBtoJS

        if ($page == 'edit' && $id != '') {
            $idSurvey = $dtsurvey[0]->id_survey;
            $kodeSurvey = $dtsurvey[0]->kode_survey;
            $namaSurvey = $dtsurvey[0]->nama_survey;
            $tglSurvey = DBtoJS($dtsurvey[0]->tanggal);
            $tglSelSurvey = DBtoJS($dtsurvey[0]->tanggal_selesai);
            $buton = 'Update';
        }


    ?>
        <div class="row row-sm row-deck">
            <div class="breadcrumb-header justify-content-between">
                <div class="left-content">
                    <h4 class="content-title mb-0 my-auto"> <i class="fa fa-list"></i> <?= $buton; ?> Hasil Survey</h4>
                </div>
                <div class="main-dashboard-header-right">

                </div>
            </div>
            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url(); ?>admin/tambah_survey" method="POST">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="KodeSurvey">Kode Survey :</label>
                                    <input type="hidden" name="idSurvey" value="<?= $idSurvey; ?>">
                                    <input type="text" name="KodeSurvey" class="form-control" placeholder="Masukkan Kode Survey" value="<?= $kodeSurvey ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="nmSurvey">Nama Survey :</label>
                                    <input type="text" name="nmSurvey" class="form-control" placeholder="Masukkan Nama Survey" value="<?= $namaSurvey ?>" required>
                                </div>

                                <div class="row row-sm mg-b-20">
                                    <div class="input-group col-md-4">

                                    </div>
                                </div><!-- wd-200 -->

                                <div class="form-group">
                                    <label for="Tanggal">Tanggal :</label>
                                    <div class="input-group date">
                                        <div class="input-group-text">
                                            <div class="input-group-text">
                                                <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                            </div>
                                        </div><input class="form-control fc-datepicker" name="tanggal" placeholder="MM/DD/YYYY" value="<?= $tglSurvey ?>" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Tanggal">Sampai Tanggal :</label>
                                    <div class="input-group date">
                                        <div class="input-group-text">
                                            <div class="input-group-text">
                                                <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                            </div>
                                        </div><input class="form-control fc-datepicker" name="tanggal_selesai" placeholder="MM/DD/YYYY" value="<?= $tglSelSurvey ?>" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success"><?= $buton; ?></button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <!-- <div class="left-content">
            <h4 class="content-title mb-0 my-auto">Hasil Survey</h4>
        </div> -->
        <br>
        <br>
        <div class="main-dashboard-header-right">
            <a href="<?= base_url() ?>"><button class="btn btn-large btn-flat btn-danger"><i class="fa fa-arrow-left"></i> Back</button></a> &nbsp;

        </div>
    </div>
    <br>
    <div class="row row-sm row-deck">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Hasil Survey</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <!-- <p class="tx-12 tx-gray-500 mb-2">Data Hasil Survey</p> -->
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0" width="70px">No.</th>
                                    <th class="border-bottom-0">Kode Survey</th>
                                    <th class="border-bottom-0">Nama Survey</th>
                                    <th class="border-bottom-0">Jumlah Data Masuk</th>
                                    <th class="border-bottom-0">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($listsurvey as $lu) {
                                    $jumRespon = $this->m_admin->hitung_survey_byid($lu->id_survey)->result();
                                    $dtRespo = $jumRespon[0]->jumsurvey;
                                ?>
                                    <tr>
                                        <td><?= $no++; ?>.</td>
                                        <td><?= $lu->kode_survey; ?></td>
                                        <td><?= $lu->nama_survey; ?></td>
                                        <td>
                                            <center><?= $dtRespo; ?></center>
                                        </td>
                                        <td>
                                            <?php
                                            if ($dtRespo > 0) {
                                            ?>
                                                <a href="<?= base_url() ?>hasilsurvey/detail/<?= $lu->id_survey; ?>"><button class="btn btn-sm btn-success"><i class="fa fa-menu"></i> Lihat Hasil</button></a> &nbsp;
                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="hapusSurvey<?= $lu->id_survey; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title"><i class="fa fa-trash"></i> Hapus Survey</h6><button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="box-body">
                                                        <h4>Anda yakin akan menghapus Survey <?= $lu->nama_survey; ?>?</h4>

                                                    </div>
                                                    <div class="box-footer">
                                                        <a href="<?= base_url('admin/hapus_survey/' . $lu->id_survey); ?>" class="btn btn-danger">Ya</a> &nbsp;
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
            <!-- / Content -->