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
                    <form action="<?= base_url('admin/tambah_surveyor'); ?>" method="post" role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="NamaSiswa">Nama Surveyor :</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Surveyor...">
                            </div>
                            <div class="form-group">
                                <label for="NamaSiswa">Kode Surveyor :</label>
                                <input type="text" name="nis" class="form-control" placeholder="Masukkan Kode Surveyor...">
                            </div>
                            <div class="form-group">
                                <label for="NoHP">No. HP :</label>
                                <input type="text" name="nohp" class="form-control" placeholder="Masukkan Nomor HP...">
                            </div>
                            <div class="form-group">
                                <label for="NoHP">Kuota :</label>
                                <input type="text" name="kuota" class="form-control" placeholder="Masukkan jumlah survey ...">
                            </div>
                            <div class="form-group">
                                <label for="Koordinator">Koordinator</label>
                                <select name="koordinator" class="form-control">
                                    <option value="">Tidak Ada</option>
                                    <?php
                                    foreach ($koordinator as $ls) {
                                    ?>
                                        <option value="<?= $ls->id_koordinator; ?>"><?= $ls->nama; ?> - <?= $ls->nama_survey; ?></option>
                                    <?php } ?>
                                </select>
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
            <!-- <h4 class="content-title mb-0 my-auto">Data Surveyor</h4> -->
        </div>
        <br>
        <br>
        <div class="main-dashboard-header-right">
            <a href="<?= base_url() ?>"><button class="btn btn-large btn-flat btn-danger"><i class="fa fa-arrow-left"></i> Back</button></a> &nbsp;
            <button type="button" data-bs-toggle="modal" data-bs-target="#tambah-Surveyor" class="btn btn-large btn-flat btn-success"><i class="fa fa-user-plus"></i> Tambah Surveyor</button>

        </div>
        <br>
    </div>
    <div class="row row-sm row-deck">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Surveyor</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">Data Surveyor</p>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>

                                    <th>No.</th>
                                    <th width="200px;">Nama</th>
                                    <th width="200px;">Koordinator</th>
                                    <th>Survey</th>
                                    <th>No HP</th>
                                    <th width="100px">Info</th>
                                    <th width="100px">Kuota</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($surveyor as $s) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $s->nis; ?> - <?= $s->namyor; ?></td>
                                        <td><?= $s->namkod ?></td>
                                        <td><?= '(' . $s->kode_survey . ') ' . $s->nama_survey ?></td>
                                        <td><?= $s->nohp; ?></td>
                                        <td><?= $s->jumlah_survey; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#lihatPassword<?= $s->id_surveyor; ?>"><i class="fa fa-eye"></i> Lihat</button>
                                        </td>
                                        <td>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#editSurveyor<?= $s->id_surveyor; ?>" class="btn btn-sm btn-warning" href="#"><i class="fa fa-edit"></i> Edit</button> &nbsp;
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#hapusSurveyor<?= $s->id_surveyor; ?>" class="btn btn-sm btn-danger" href="#"><i class="fa fa-user-times"></i> Hapus</button>
                                        </td>
                                    </tr>
                                    <!-- Modal Lihat Password Siswa -->
                                    <div class="modal fade" id="lihatPassword<?= $s->id_surveyor; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title"> <i class="fa fa-user"></i> <?= $s->namyor; ?></h6>
                                                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="password">Password :</label>
                                                        <input value="<?= $s->passyor; ?>" type="text" class="form-control" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Pertanyaan">Pertanyaan :</label>
                                                        <input type="text" value="<?= $s->pertanyaan; ?>" class="form-control" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Jawaban">Jawaban :</label>
                                                        <input type="text" value="<?= $s->jawaban; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- End Modal -->
                                    <!-- Modal Edit Siswa -->
                                    <div class="modal fade" id="editSurveyor<?= $s->id_surveyor; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title"> <i class="fa fa-user"></i> Edit Data Surveyor</h6>
                                                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                                </div>

                                                <div class="modal-body">
                                                    <form action="<?= base_url('admin/edit_surveyor/' . $s->id_surveyor); ?>" method="post">
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label for="Nama">Nama :</label>
                                                                <input type="text" name="nama" value="<?= $s->namyor; ?>" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Nama">Kode Surveyor :</label>
                                                                <input type="text" name="nis" value="<?= $s->nis; ?>" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="NoHP">No. HP :</label>
                                                                <input type="text" name="nohp" value="<?= $s->nohp; ?>" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="NoHP">Kuota :</label>
                                                                <input type="text" name="kuota" class="form-control" value="<?= $s->jumlah_survey; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Koordinator">Koordinator</label>
                                                                <select name="koordinator" class="form-control">
                                                                    <option value="">Tidak Ada</option>
                                                                    <?php
                                                                    foreach ($koordinator as $ls) {
                                                                        $eleSurv = '';
                                                                        if ($ls->id_koordinator == $s->koordinator) {
                                                                            $eleSurv = 'selected';
                                                                        }
                                                                    ?>
                                                                        <option value="<?= $ls->id_koordinator; ?>" <?= $eleSurv; ?>><?= $ls->nama; ?> - <?= $ls->nama_survey; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="password">Password :</label>
                                                                <input type="text" name="password" value="<?= $s->passyor; ?>" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pertanyaan">Pertanyaan :</label>
                                                                <input type="text" name="pertanyaan" value="<?= $s->pertanyaan; ?>" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Jawaban">Jawaban :</label>
                                                                <input type="text" name="jawaban" value="<?= $s->jawaban; ?>" class="form-control">
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
                                                    <h6 class="modal-title"> <i class="fa fa-user"></i> Hapus Data Surveyor</h6>
                                                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="box-body">
                                                        <h4>Anda yakin untuk menghapus Surveyor <b><?= $s->nama; ?></b> ?</h4>
                                                        <p class="text-danger">*Menghapus data surveyor terpilih akan menghapus semua data yang lainnya...</p>
                                                    </div>
                                                    <div class="box-footer">
                                                        <a href="<?= base_url('admin/hapus_surveyor/' . $s->id_surveyor); ?>" class="btn btn-danger">Ya</a> &nbsp;
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
