<div class="container">

    <!-- Modal Tambah Koordinator -->
    <div class="modal fade" id="tambah-Surveyor">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"> Tambah Surveyor</h6>
                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">
                    <form action="<?= base_url('admin/m_add_surv'); ?>" method="post" role="form">
                        <div class="box-body">
                            <input type="hidden" name="id_koor" value="<?= $id_koor ?>">
                            <div class="form-group">
                                <label for="Koordinator">Surveyor</label>
                                <select name="id_surveyor" class="form-control">
                                    <?php
                                    foreach ($belum as $ls) {
                                    ?>
                                        <option value="<?= $ls->id_surveyor; ?>"><?= $ls->nis; ?> - <?= $ls->nama; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="NamaSiswa">Jumlah Survey</label>
                                <input type="text" name="jumlah" class="form-control" placeholder="0" required>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div> <!-- End Modal Tambah Koordinator -->
    <?php ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <h4 class="content-title mb-0 my-auto">Manajemen Surveyor</h4>
        </div>
        <div class="main-dashboard-header-right">
            <a href="<?= base_url() ?>"><button class="btn btn-sm btn-flat btn-danger"><i class="fa fa-arrow-left"></i> Back</button></a> &nbsp;
            <button type="button" data-bs-toggle="modal" data-bs-target="#tambah-Surveyor" class="btn btn-sm btn-flat btn-success"><i class="fa fa-user-plus"></i> Tambah Surveyor</button>

        </div>
    </div>
    <div class="row row-sm row-deck">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0"><?= $nama_koordinator; ?></h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2"><?= '(' . $kode_survey . ') ' . $nama_survey ?></p>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>

                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Jumlah Survey</th>
                                    <th>Survey Selesai</th>
                                    <th>Survey Belum Selesai</th>
                                    <th>Persentase Survey Selesai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data as $s) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $s->nis; ?> - <?= $s->namyor; ?></td>
                                        <td><?= $s->jumlah_survey; ?></td>
                                        <td>
                                            <?php $jumlah_valid = $this->db->query("SELECT COUNT(js_id) AS jumlah FROM jawaban_survey WHERE js_survey_id=$id_survey AND js_valid=1 AND js_surveyor=$s->id_surveyor")->result()[0]->jumlah;
                                            echo $jumlah_valid ?>
                                        </td>
                                        <td><?= $s->jumlah_survey - $jumlah_valid; ?></td>
                                        <td><?= ($jumlah_valid / $s->jumlah_survey) * 100; ?>%</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-4">
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#editSurveyor<?= $s->id_surveyor; ?>" class="btn btn-sm btn-warning" href="#"><i class="fa fa-edit"></i> Edit</button>
                                                </div>
                                                <div class="col-4">
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#hapusSurveyor<?= $s->id_surveyor; ?>" class="btn btn-sm btn-danger" href="#"><i class="fa fa-user-times"></i> Hapus</button>
                                                </div>
                                                <div class="col-4">
                                                    <?php
                                                    if ($jumlah_valid > 0) {
                                                    ?>
                                                        <a href="<?= base_url() ?>hasilsurvey/detail/<?= $id_survey; ?>/<?= $s->id_surveyor ?>"><button class="btn btn-sm btn-success"><i class="fa fa-menu"></i> Lihat Hasil</button></a> &nbsp;
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit Siswa -->
                                    <div class="modal fade" id="editSurveyor<?= $s->id_surveyor; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title"> <i class="fa fa-user"></i> Edit Jumlah Survey</h6>
                                                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                                </div>

                                                <div class="modal-body">
                                                    <form action="<?= base_url('admin/m_edit_surv/' . $s->id_surveyor); ?>" method="post">
                                                        <div class="box-body">
                                                            <input type="hidden" name="id_koor" value="<?= $id_koor ?>">
                                                            <div class="form-group">
                                                                <label for="NamaSiswa">Jumlah Survey</label>
                                                                <input type="text" name="jumlah" class="form-control" placeholder="0" required value="<?= $s->jumlah_survey ?>">
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

                                    <!-- Modal Hapus Siswa -->
                                    <div class="modal fade" id="hapusSurveyor<?= $s->id_surveyor; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title"> <i class="fa fa-user"></i> Hapus Surveyor dari Survey</h6>
                                                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="box-body">
                                                        <h4>Anda yakin untuk menghapus Surveyor <b><?= $s->namyor; ?> dari survey</b> ?</h4>
                                                    </div>
                                                    <div class="box-footer">
                                                        <a href="<?= base_url('admin/m_delete_surv/' . $s->id_surveyor); ?>" class="btn btn-danger">Ya</a> &nbsp;
                                                        <button class="btn btn-default" data-bs-dismiss="modal">Tidak</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- End Modal -->
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
