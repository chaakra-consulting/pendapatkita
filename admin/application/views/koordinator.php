    <div class="container">

        <!-- Modal Tambah Koordinator -->
        <div class="modal fade" id="tambah-Koordinator">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title"> Tambah Koordinator</h6>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('admin/tambah_koordinator'); ?>" method="post" role="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="NamaKoordinator">Nama Koordinator :</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Koordinator...">
                                </div>
                                <div class="form-group">
                                    <label for="User">User :</label>
                                    <input type="text" name="username" class="form-control" placeholder="Masukkan Username Koordinator...">
                                </div>
                                <div class="form-group">
                                    <label for="Password">Password :</label>
                                    <input type="password" name="password" id="" class="form-control" placeholder="Masukkan Password Koordinator...">
                                </div>
                                <div class="form-group">
                                    <label for="Survey">Survey</label>
                                    <select name="survey" class="form-control">
                                        <?php
                                        foreach ($listsurvey as $ls) {
                                        ?>
                                            <option value="<?= $ls->id_survey; ?>"><?= $ls->kode_survey; ?> - <?= $ls->nama_survey; ?></option>
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

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                                        </br>
                                        </br>
                <!-- <h4 class="content-title mb-0 my-auto">Data Koordinator</h4> -->
            </div>
            <div class="main-dashboard-header-right">
                <a href="<?= base_url() ?>"><button class="btn btn-large btn-flat btn-danger"><i class="fa fa-arrow-left"></i> Back</button></a> &nbsp;
                <button type="button" data-bs-toggle="modal" data-bs-target="#tambah-Koordinator" class="btn btn-large btn-flat btn-success"><i class="fa fa-user-plus"></i> Tambah Koordinator</button>

            </div>
            <br>
        </div>
        <div class="row row-sm row-deck">
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">Koordinator</h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        <!-- <p class="tx-12 tx-gray-500 mb-2">Data Koordinator</p> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Survey Aktif</th>
                                        <th colspan="2">Login</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($koordinator as $g) { ?>
                                        <tr>
                                            <td><?= $no++; ?>.</td>
                                            <td><?= $g->nama; ?></td>
                                            <td><?= $g->nama_survey; ?></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#lihatLogin<?= $g->id_koordinator; ?>"><i class="fa fa-eye"></i> Lihat</button>
                                                    </div>
                                                    <div class="col-6">
                                                        <a class="btn btn-sm btn-success" href="<?= base_url('admin/surveyor_to_koor/' . $g->id_koordinator) ?>"><i class="fa fa-eye"></i> Lihat Surveyor</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-6"> <button type="button" data-bs-toggle="modal" data-bs-target="#editKoordinator<?= $g->id_koordinator; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</button>
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#hapusKoordinator<?= $g->id_koordinator; ?>" class="btn btn-sm btn-danger"><i class="fa fa-user-times"></i> Hapus</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Lihat Login Koordinator -->
                                        <div class="modal fade" id="lihatLogin<?= $g->id_koordinator; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title"> Informasi Login</h6>
                                                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="Username">Username :</label>
                                                            <input type="text" value="<?= $g->username; ?>" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Password">Password :</label>
                                                            <input type="text" value="<?= $g->password; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Edit Data Koordinator -->
                                        <div id="editKoordinator<?= $g->id_koordinator; ?>" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title"> Edit Data Koordinator</h6>
                                                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url('admin/edit_koordinator/' . $g->id_koordinator); ?>" method="post" role="form">
                                                            <div class="box-body">
                                                                <div class="form-group">
                                                                    <label for="NamaKoordinator">Nama :</label>
                                                                    <input type="text" name="nama" id="" class="form-control" value="<?= $g->nama; ?>" placeholder="Masukkan Nama Koordinator...">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="User">User :</label>
                                                                    <input type="text" name="username" value="<?= $g->username; ?>" class="form-control" placeholder="Masukkan Username Koordinator...">
                                                                </div>
                                                                <div class="form-grou">
                                                                    <label for="Password">Password :</label>
                                                                    <input type="password" name="password" value="<?= $g->password; ?>" class="form-control" placeholder="Masukkan Password Koordinator...">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="Survey">Survey</label>
                                                                    <select name="survey" class="form-control">
                                                                        <?php
                                                                        foreach ($listsurvey as $ls) {
                                                                            $seles = '';
                                                                            if ($ls->id_survey == $g->survey_aktif) {
                                                                                $seles = 'selected';
                                                                            }
                                                                        ?>
                                                                            <option value="<?= $ls->id_survey; ?>" <?= $seles; ?>><?= $ls->kode_survey; ?> - <?= $ls->nama_survey; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="box-footer">
                                                                <button type="submit" class="btn btn-success">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- End Modal -->
                                        <!-- Modal Hapus Data Koordinator -->
                                        <div class="modal fade" id="hapusKoordinator<?= $g->id_koordinator; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title"> Hapus Data Koordinator</h6>
                                                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="box-body">
                                                            <h4>Anda yakin akan menghapus <b><?= $g->nama; ?></b> ?</h4>
                                                            <p class="text-danger">*Menghapus data terpilih dapat menghapus semua data lainnya...</p>
                                                        </div>
                                                        <div class="box-footer">
                                                            <a href="<?= base_url('admin/hapus_koordinator/' . $g->id_koordinator); ?>" class="btn btn-danger">Ya</a> &nbsp;
                                                            <button class="btn btn-default" data-bs-dismiss="modal">Tidak</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- End Modal-->
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