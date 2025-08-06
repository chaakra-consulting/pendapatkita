                <div class="container">
                    <div class="modal fade" id="tambahSurvey" tabindex="-1" aria-labelledby="tambahSurveyLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="tambahSurveyLabel"> Tambah Pertanyaan</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div> 
                                <form action="<?= base_url(); ?>admin/tambah_pool_data_detail" method="POST">
                                    <div class="modal-body">
                                    <div class="form-group">
                                            <label for="Kode">Kode:</label>
                                            <input type="text"  name="Kode" class="form-control" placeholder="Masukkan kode" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="NamaPernyataan">Nama Pernyataan:</label>
                                            <input type="text" name="NamaPernyataan" class="form-control" placeholder="Masukkan Nama Pertanyaan" required>
                                        </div>  
                                        <div class="form-group">
                                            <label for="PilihanPertanyaan">Pilihan Data:</label>
                                            <div id="pertanyaanWrapper">
                                                <div class="form-group row" id="jawabanRow0">
                                                    <div class="col-sm-3">
                                                        <select name="id_survey[]" id="id_survey_0" class="form-control id_survey" required>
                                                            <option value="">-- Pilih Survey --</option>
                                                            <?php foreach ($listsurvey as $survey): ?>
                                                                <option value="<?= $survey->id_survey; ?>">
                                                                    <?= $survey->nama_survey; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <select name="id_seksi[]" id="id_seksi_0" class="form-control id_seksi" required>
                                                            <option value="">-- Pilih Seksi --</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select name="id_pertanyaan[]" id="id_pertanyaan_0" class="form-control id_pertanyaan" required>
                                                            <option value="">-- Pilih Pertanyaan --</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button type="button" class="btn btn-danger btn-block" onclick="removeJawabanRow('jawabanRow0')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="text-align: center; margin-top: 1rem;">
                                                <button type="button" class="btn btn-default btn-block" onclick="extraPertanyaan()" style="margin-top:6px;">
                                                    <i class="fa fa-plus"></i> Tambahkan
                                                </button>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="id_pool_data" value="<?= $pooldata->id_pool_data ?>">
                                        <button type="submit" class="btn btn-success">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($listpooldatadetail as $lu) { ?>
                        <div class="modal fade" id="edit<?= $lu->id_pool_data_detail; ?>" tabindex="-1" aria-labelledby="editLabel<?= $lu->id_pool_data_detail; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="<?= base_url(); ?>admin/edit_pool_data_detail/<?=$lu->id_pool_data_detail?>" method="POST">
                                        <div class="modal-header">
                                            <h6 class="modal-title">Edit Pertanyaan</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Kode:</label>
                                                <input type="text" name="Kode" class="form-control" value="<?= $lu->pdd_kode; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Pernyataan:</label>
                                                <input type="text" name="NamaPernyataan" class="form-control" value="<?= $lu->pdd_nama_pertanyaan; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Pilihan Data:</label>
                                                <div id="pertanyaanWrapperEdit<?= $lu->id_pool_data_detail; ?>">
                                                    <?php if (!empty($lu->pertanyaan)): ?>
                                                        <?php foreach ($lu->pertanyaan as $index => $p): ?>
                                                            <div class="form-group row" id="jawabanRowEdit<?= $lu->id_pool_data_detail; ?>_<?= $index ?>">
                                                                <input type="hidden" name="id_pool_data_pertanyaan[]" value="<?= $p->id_pool_data_pertanyaan; ?>">
                                                                <div class="col-sm-3">
                                                                    <select name="id_survey_edit[]" class="form-control id_survey_edit" required>
                                                                        <option value="">-- Pilih Survey --</option>
                                                                        <?php foreach ($listsurvey as $survey): ?>
                                                                            <option value="<?= $survey->id_survey; ?>" 
                                                                                <?= $survey->id_survey == $p->ps_id_survey ? 'selected' : ''; ?>>
                                                                                <?= $survey->nama_survey; ?>
                                                                            </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <select name="id_seksi_edit[]" class="form-control id_seksi_edit" required>
                                                                        <option value="<?= $p->ps_id_seksi; ?>">
                                                                            <?= $p->ss_kode . ' - ' . $p->ss_judul; ?>
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <select name="id_pertanyaan_edit[]" class="form-control id_pertanyaan_edit" required>
                                                                        <option value="<?= $p->ps_id; ?>">
                                                                            <?= $p->ps_kode . ' - ' . $p->ps_pertanyaan; ?>
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <button type="button" class="btn btn-danger btn-block"
                                                                        onclick="removeJawabanRow('jawabanRowEdit<?= $lu->id_pool_data_detail; ?>_<?= $index ?>')">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <div class="form-group row" id="jawabanRowEdit<?= $lu->id_pool_data_detail; ?>_0">
                                                            <div class="col-sm-3">
                                                                <select name="id_survey_edit[]" class="form-control id_survey_edit" required>
                                                                    <option value="">-- Pilih Survey --</option>
                                                                    <?php foreach ($listsurvey as $survey): ?>
                                                                        <option value="<?= $survey->id_survey; ?>">
                                                                            <?= $survey->id_survey . ' - ' .$survey->nama_survey; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <select name="id_seksi_edit[]" class="form-control id_seksi_edit" required>
                                                                    <option value="">-- Pilih Seksi --</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <select name="id_pertanyaan_edit[]" class="form-control id_pertanyaan_edit" required>
                                                                    <option value="">-- Pilih Pertanyaan --</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <button type="button" class="btn btn-danger btn-block"
                                                                    onclick="removeJawabanRow('jawabanRowEdit<?= $lu->id_pool_data_detail; ?>_0')">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div style="text-align:center; margin-top:1rem;">
                                                    <button type="button" class="btn btn-default btn-block"
                                                        onclick="extraPertanyaanEdit(<?= $lu->id_pool_data_detail; ?>)" style="margin-top:6px;">
                                                        <i class="fa fa-plus"></i> Tambahkan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="id_pool_data_detail" value="<?= $lu->id_pool_data_detail; ?>">
                                            <input type="hidden" name="id_pool_data" value="<?= $pooldata->id_pool_data ?>">
                                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="hapusPoolData<?=$lu->id_pool_data_detail;?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Hapus Pool Data</h6>
                                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Anda yakin akan menghapus <?=$lu->pdd_nama_pertanyaan;?>?</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="<?= base_url('admin/hapus_pool_data_detail/'.$lu->id_pool_data_detail);?>" class="btn btn-danger">Ya</a>
                                        <button class="btn btn-default" data-bs-dismiss="modal">Tidak</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="left-content">
                            <br>
                            <br>
							 <h1 class="content-title mb-0 my-auto">Atur Relasi Data</h1>
						</div>
						<div class="main-dashboard-header-right">
							<a href="<?=base_url()?>admin/pool_data"><button style="height:30px;" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-arrow-left"></i> Back</button></a> &nbsp; 
							<button class="btn btn-sm btn-flat btn-success" data-bs-toggle="modal" style="height:30px;" data-bs-target="#tambahSurvey"><i class="fa fa-plus"></i> Tambah Pertanyaan</button>
						</div>
					</div>
                    <br>
					<div class="row row-sm row-deck">
						<div class="col-xl-12">
                            <div class="card mg-b-20">
                                <div class="card-header pb-0">
                                    <div class="d-flex justify-content-between">
                                        <!-- <h4 class="card-title mg-b-0">Pool Data</h4> -->
                                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                                    </div>
                                </div>
                                <div class="card-body">		

                                    <div class="table-responsive">
                                        <table id="example" class="table key-buttons text-md-nowrap">
                                            <thead>
                                                <tr> 									
                                                    <th>No.</th>
                                                    <th>Kode</th> 
                                                    <th>Nama Pertanyaan</th> 
                                                    <!-- <th>Keterangan</th>   -->
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                            <?php 
                                            $no = 1;
                                            foreach ($listpooldatadetail as $lu) { ?>
                                                <tr>
                                                    <td><?=$no++;?>.</td>
                                                    <td><?=$lu->pdd_kode;?></td>  
                                                    <td><?=$lu->pdd_nama_pertanyaan;?></td>  
                                                    <td>
                                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$lu->id_pool_data_detail;?>">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </button>
                                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusPoolData<?=$lu->id_pool_data_detail;?>">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </button>
                                                    </td>
                                                </tr>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let rowIndex = 1;

function extraPertanyaan() {
    let rowId = "jawabanRow" + rowIndex;
    let surveyId = "id_survey_" + rowIndex;
    let seksiId = "id_seksi_" + rowIndex;
    let pernyataanId = "id_pertanyaan_" + rowIndex;

    let newRow = `
        <div class="form-group row" id="${rowId}">
            <div class="col-sm-3">
                <select name="id_survey[]" class="form-control id_survey" required>
                    <option value="">-- Pilih Survey --</option>
                    <?php foreach ($listsurvey as $survey): ?>
                        <option value="<?= $survey->id_survey; ?>">
                            <?= $survey->nama_survey; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-sm-3">
                <select name="id_seksi[]" class="form-control id_seksi" required>
                    <option value="">-- Pilih Seksi --</option>
                </select>
            </div>
            <div class="col-sm-4">
                <select name="id_pertanyaan[]" class="form-control id_pertanyaan" required>
                    <option value="">-- Pilih Pertanyaan --</option>
                </select>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-danger btn-block" onclick="removeJawabanRow('${rowId}')">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </div>
    `;

    $("#pertanyaanWrapper").append(newRow);
    rowIndex++;
}

function removeJawabanRow(rowId) {
    $("#" + rowId).remove();
}

$(document).on('change', '.id_survey', function() {
    let surveyId = $(this).val();
    let row = $(this).closest('.form-group.row');
    let seksiDropdown = row.find('.id_seksi');

    if (surveyId) {
        $.ajax({
            url: "<?= base_url('admin/get_seksi_by_id_survey'); ?>",
            type: "GET",
            data: { survey_id: surveyId },
            dataType: "json",
            success: function(response) {
                seksiDropdown.empty();
                seksiDropdown.append('<option value="">-- Pilih Seksi --</option>');
                $.each(response, function(key, value) {
                    seksiDropdown.append('<option value="' + value.id_seksi + '">' + value.ss_kode + ' - '+ value.ss_judul + '</option>');
                });
            },
            error: function() {
                alert("Gagal mengambil data seksi!");
            }
        });
    } else {
        seksiDropdown.html('<option value="">-- Pilih Seksi --</option>');
    }
});

$(document).on('change', '.id_seksi', function() {
    let seksiId = $(this).val();
    let row = $(this).closest('.form-group.row');
    let pernyataanDropdown = row.find('.id_pertanyaan');

    if (seksiId) {
        $.ajax({
            url: "<?= base_url('admin/get_pernyataan_by_id_seksi'); ?>",
            type: "GET",
            data: { seksi_id: seksiId },
            dataType: "json",
            success: function(response) {
                console.log("Pernyataan Response:", response);
                pernyataanDropdown.empty().append('<option value="">-- Pilih Pertanyaan --</option>');

                if (Array.isArray(response) && response.length > 0) {
                    $.each(response, function(key, value) {
                        pernyataanDropdown.append('<option value="' + value.ps_id + '">' + value.ps_kode + ' - '+ value.ps_pertanyaan + '</option>');
                    });
                } else {
                    console.warn("Tidak ada pertanyaan ditemukan");
                }
            },
            error: function(xhr) {
                console.error("Error ambil pertanyaan:", xhr.responseText);
                alert("Gagal mengambil pertanyaan!");
            }
        });
    } else {
        pernyataanDropdown.html('<option value="">-- Pilih Pertanyaan --</option>');
    }
});

let rowIndexEdit = {};

function extraPertanyaanEdit(detailId) {
    let wrapper = $("#pertanyaanWrapperEdit" + detailId);
    let rowCount = wrapper.find('.form-group.row').length;
    let rowId = "jawabanRowEdit" + detailId + "_" + rowCount;

    let newRow = `
        <div class="form-group row" id="${rowId}">
            <div class="col-sm-3">
                <select name="id_survey_edit[]" class="form-control id_survey_edit" required>
                    <option value="">-- Pilih Survey --</option>
                    <?php foreach ($listsurvey as $survey): ?>
                        <option value="<?= $survey->id_survey; ?>">
                            <?= $survey->nama_survey; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-sm-3">
                <select name="id_seksi_edit[]" class="form-control id_seksi_edit" required>
                    <option value="">-- Pilih Seksi --</option>
                </select>
            </div>
            <div class="col-sm-4">
                <select name="id_pertanyaan_edit[]" class="form-control id_pertanyaan_edit" required>
                    <option value="">-- Pilih Pertanyaan --</option>
                </select>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-danger btn-block" onclick="removeJawabanRow('${rowId}')">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </div>`;
    wrapper.append(newRow);
}

function removeJawabanRow(rowId) {
    $("#" + rowId).remove();
}

$(document).on('change', '.id_survey_edit', function() {
    let surveyId = $(this).val();
    let row = $(this).closest('.form-group.row');
    let seksiDropdown = row.find('.id_seksi_edit');
    let pernyataanDropdown = row.find('.id_pertanyaan_edit');

    if (surveyId) {
        $.ajax({
            url: "<?= base_url('admin/get_seksi_by_id_survey'); ?>",
            type: "GET",
            data: { survey_id: surveyId },
            dataType: "json",
            success: function(response) {
                seksiDropdown.empty().append('<option value="">-- Pilih Seksi --</option>');
                $.each(response, function(key, value) {
                    seksiDropdown.append('<option value="' + value.id_seksi + '">' + value.ss_kode + ' - ' + value.ss_judul + '</option>');
                });
                pernyataanDropdown.empty().append('<option value="">-- Pilih Pertanyaan --</option>');
            }
        });
    }
});

$(document).on('change', '.id_seksi_edit', function() {
    let seksiId = $(this).val();
    let row = $(this).closest('.form-group.row'); // ambil row yg sama
    let pernyataanDropdown = row.find('.id_pertanyaan_edit');

    if (seksiId) {
        $.ajax({
            url: "<?= base_url('admin/get_pernyataan_by_id_seksi'); ?>",
            type: "GET",
            data: { seksi_id: seksiId },
            dataType: "json",
            success: function(response) {
                pernyataanDropdown.empty().append('<option value="">-- Pilih Pertanyaan --</option>');
                $.each(response, function(key, value) {
                    pernyataanDropdown.append('<option value="' + value.ps_id + '">' + value.ps_kode + ' - ' + value.ps_pertanyaan + '</option>');
                });
            }
        });
    }
});

</script>