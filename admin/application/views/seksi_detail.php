<br>
<br>

<div class="container">


<?php
function tipepertanyaan($idtipe)
{
    if ($idtipe == 1) {
        $teks = 'Pilihan Ganda - Radio';
    } elseif ($idtipe == 2) {
        $teks = 'Pilihan Ganda - Checkbox';
    } elseif ($idtipe == 3) {
        $teks = 'Jawaban Singkat';
    } elseif ($idtipe == 4) {
        $teks = 'Jawaban Panjang';
    } elseif ($idtipe == 5) {
        $teks = 'Skala Likert';
    }
    return $teks;
}
?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">

            <h2 class="content-title mb-0 my-auto">Detail Seksi Survey</h2>
            <h4 class="content-title mb-0 my-auto">"<?php echo $infosurvey[0]->nama_survey; ?>"</h4>
            <h5 class="content-title mb-0 my-auto">SEKSI <?php echo $infosurvey[0]->ss_kode; ?> : "<?php echo $infosurvey[0]->ss_judul; ?>"</h5>

        </div>
        <div class="main-dashboard-header-right">
            <a href="<?= base_url() ?>admin/survey_detail/<?php echo $infosurvey[0]->id_survey; ?>"><button style="height:30px;" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-arrow-left"></i> Back</button></a> &nbsp;
            <button class="btn btn-sm btn-flat btn-success" data-bs-toggle="modal" style="height:30px;" data-bs-target="#tambahSurvey"><i class="fa fa-plus"></i> Tambah Pertanyaan Survey</button>
        </div>
    </div>
    <br>
    <div class="modal fade" id="tambahSurvey">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"> Tambah Pertanyaan Survey</h6>
                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url(); ?>admin/tambah_pertanyaan" method="POST">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="KodePertanyaan">Kode Pertanyaan :</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><?= $infosurvey[0]->ss_kode ?></span>
                                    </div>
                                    <input type="text" name="KodePertanyaan" class="form-control" placeholder="Isi kode akhir">
                                </div>
                            </div>
                            <div class="form-group" style="align-items: center;">
                                <label for="kewajibanMengisi">Kewajiban Mengisi :</label>              
                                    <select name="kewajibanMengisi" id="kewajibanMengisi" class="form-control">
                                        <option value="">Tidak Wajib</option>    
                                        <option value="required">Wajib Diisi</option>
                                        <!-- <option value="required_if">Required dengan Logic</option> -->
                                    </select>

                                <!-- <div class="col-sm-4" id="logicPertanyaan" style="display: none;">
                                    <select name="soalLogika" id="soalLogika" class="form-control">
                                        <?php foreach ($listpertanyaanbysurvey as $pertanyaan): ?>
                                            <option value="<?= $pertanyaan->ps_id ?>">
                                                <?= $pertanyaan->ps_kode ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div> -->
                            </div>
                            <div class="form-group">
                                <label for="Pertanyaan">Pertanyaan :</label>
                                <input type="hidden" name="Pertanyaan" value="<?= set_value('Pertanyaan') ?>">
                                <div id="editor" style="min-height: 160px;"><?= set_value('Pertanyaan') ?></div>
                            </div>
                            <div class="form-group">
                                <label for="tipePertanyaan">Tipe Pertanyaan :</label>
                                <select name="tipePertanyaan" id="tipePertanyaan" onchange="showDiv('div',this)" class="form-control" required>
                                    <option value="1">Pilihan Ganda - Radio</option>
                                    <option value="2">Pilihan Ganda - Checkbox</option>
                                    <option value="3">Jawaban Singkat</option>
                                    <option value="4">Jawaban Panjang</option>
                                    <option value="5">Skala Likert</option>
                                </select>
                            </div>
                            <div id="div1" style="display:block;">
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Jawaban</label>
                                    <div class="col-sm-2">
                                        <p class="form-control-static">
                                        <select name="typeja[]" id="typeja" class="form-control" required>
                                            <option value="default">Default</option>
                                            <option value="essai">Essai</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <p class="form-control-static">
                                        <input type="text" class="form-control" id="pilja" name="pilja[]" placeholder="Pilihan Jawaban"></p>
                                        <!-- <select name="tipePertanyaan" id="tipePertanyaan" class="form-control" required>
                                            <option value="default">Default</option>
                                            <option value="essai">Essai</option>
                                        </select> -->
                                    </div>
                                    <div class="col-sm-2">
                                        <p class="form-control-static"><input type="text" class="form-control" id="logicja" name="logicja[]" placeholder="Logic"></p>
                                    </div>
                                    <!-- <div class="col-sm-3">
                                    </div> -->
                                </div>
                                <div id="PilGandaRadioContainer"></div>
                                <div style="text-align: center; margin-top: 1rem;">
                                    <p><button type="button" class="btn btn-default btn-block" onclick="extraPilGandaRadio()" style="margin-top:6px;"><i class="fa fa-plus"></i> Tambahkan</button></p>
                                </div>
                            </div>
                            <div id="div2" style="display:none;">
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Jawaban</label>
                                    <div class="col-sm-2">
                                        <p class="form-control-static">
                                        <select name="typeja[]" id="typeja" class="form-control" required>
                                            <option value="default">Default</option>
                                            <option value="essai">Essai</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <p class="form-control-static"><input type="text" class="form-control" id="pilja" name="pilja[]" placeholder="Pilihan Jawaban"></p>
                                    </div>
                                    <div class="col-sm-2">
                                        <p class="form-control-static"><input type="text" class="form-control" id="logicja" name="logicja[]" placeholder="Logic"></p>
                                    </div>
                                    <!-- <div class="col-sm-3">
                                    </div> -->
                                </div>
                                <div id="PilGandaCheckContainer"></div>
                                <div style="text-align: center; margin-top: 1rem;">
                                    <p><button type="button" class="btn btn-default btn-block" onclick="extraPilGandaCheck()" style="margin-top:6px;"><i class="fa fa-plus"></i> Tambahkan</button></p>
                                </div>
                            </div>
                            <div id="div3" style="display:none;">
                                <div id="InpTextContainer"></div>
                                <div class="col-sm-3">
                                    <p><button type="button" class="btn btn-default btn-block" onclick="extraInpText()" style="margin-top:6px;"><i class="fa fa-plus"></i> Tambahkan Logic</button></p>
                                </div>
                            </div>
                            <div id="div4" style="display:none;">
                                <div id="InpTextAreaContainer"></div>
                                <div class="col-sm-3">
                                    <p><button type="button" class="btn btn-default btn-block" onclick="extraInpTextArea()" style="margin-top:6px;"><i class="fa fa-plus"></i> Tambahkan Logic</button></p>
                                </div>
                            </div>
                            <div id="div5" style="display:none;">
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Jawaban</label>

                                    <div class="form-group">
                                        <select name="pilja[]" id="pilja" class="form-control">
                                            <option value="">Pilih Tipe Likert</option>
                                            <option value="star">Star</option>
                                            <option value="love">Love</option>
                                            <option value="bar">Bar</option>
                                            <option value="opini">Opini</option>
                                            <option value="persegi">Persegi Rating</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="form-control-static"><input type="text" class="form-control" id="pilja" name="pilja[]" placeholder="Tulis Teks Range"></p>
                                    </div>
                                    <div class="col-sm-5">
                                        <p class="form-control-static"><input type="text" class="form-control" id="logicja" name="logicja[]" placeholder="Logic"></p>
                                    </div>
                                </div>
                                <div id="PilLikertContainer"></div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="idSurvey" value="<?= $infosurvey[0]->id_survey ?>">
                            <input type="hidden" name="idSeksi" value="<?= $infosurvey[0]->id_seksi ?>">
                            <input type="hidden" name="kodeSeksi" value="<?= $infosurvey[0]->ss_kode ?>">

                            <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm row-deck">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <p class="tx-12 tx-gray-500 mb-2">"<?php echo $infosurvey[0]->nama_survey; ?>"</p>
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">
                            SEKSI <?php echo $infosurvey[0]->ss_kode; ?> : "<?php echo $infosurvey[0]->ss_judul; ?>"
                        </h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>

                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Pertanyaan</th>
                                    <th>Pertanyaan</th>
                                    <th>Tipe</th>
                                    <th>Kewajiban Mengisi</th>
                                    <th>Pilihan Jawaban</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($listpertanyaan as $lu) { ?>
                                    <tr>
                                        <td><?= $no++; ?>.</td>
                                        <td><?= $lu->ps_kode; ?></td>
                                        <td><?= $lu->ps_pertanyaan; ?></td>
                                        <td><?= tipepertanyaan($lu->ps_tipe_pertanyaan); ?></td>
                                        <td><?= $lu->must_answer ?? '-'; ?></td>
                                        <td><?php
                                            $tampil_sebagian = substr($lu->ps_pilihan_jawaban, 0, 50);
                                            echo $tampil_sebagian;
                                            if ($lu->ps_pilihan_jawaban != '' && strlen($lu->ps_pilihan_jawaban) > 50) {
                                                echo '...';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <!--<a href="<?= base_url() ?>admin/seksi_detail/<?= $lu->ps_id; ?>"><button class="btn btn-sm btn-success"><i class="fa fa-menu"></i> Detail Seksi</button></a> &nbsp;-->
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editSurvey<?= $lu->ps_id; ?>"><i class="fa fa-edit"></i> Edit</button> &nbsp;
                                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#duplikatSurvey<?= $lu->ps_id; ?>"><i class="fa fa-copy"></i> Duplikat</button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusSurvey<?= $lu->ps_id; ?>"><i class="fa fa-trash"></i> Hapus</button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editSurvey<?= $lu->ps_id; ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title"> Edit Pertanyaan Survey</h6>
                                                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="formEdit<?=$lu->ps_id?>" action="<?= base_url(); ?>admin/edit_pertanyaan/<?=$lu->ps_id?>" method="POST">
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label for="KodePertanyaan">Kode Pertanyaan :</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><?= $infosurvey[0]->ss_kode ?></span>
                                                                    </div>
                                                                    <input type="text" name="KodePertanyaan<?= $lu->ps_id ?>" value="<?= str_replace($infosurvey[0]->ss_kode, '', $lu->ps_kode); ?>" class="form-control" placeholder="Isi kode akhir">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="align-items: center;">
                                                                <label for="kewajibanMengisi">Kewajiban Mengisi :</label>              
                                                                <select name="kewajibanMengisi<?= $lu->ps_id ?>" id="kewajibanMengisi<?= $lu->ps_id ?>" class="form-control">
                                                                    <option value="" <?= $lu->must_answer == '' ? 'selected' : '' ?>>Tidak Wajib</option>    
                                                                    <option value="required" <?= $lu->must_answer == 'required' ? 'selected' : '' ?>>Wajib Diisi</option>
                                                                    <!-- <option value="required_if">Required dengan Logic</option> -->
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Pertanyaan">Pertanyaan :</label>
                                                                <input type="hidden" name="Pertanyaan<?= $lu->ps_id ?>" id="pertanyaanHidden<?= $lu->ps_id ?>" value="<?= set_value('Pertanyaan') ?>">
                                                                <div id="editor<?= $lu->ps_id ?>" style="min-height: 160px;"><?= $lu->ps_pertanyaan ?></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tipePertanyaan">Tipe Pertanyaan :</label>
                                                                <select name="tipePertanyaan<?= $lu->ps_id ?>" id="tipePertanyaan<?= $lu->ps_id ?>" onchange="showDivEdit('div', this, '<?= $lu->ps_id ?>')" class="form-control" <?= $is_jawaban == 1 ? 'disabled' : '' ?> required>
                                                                    <option value="1"<?= $lu->ps_tipe_pertanyaan == '1' ? 'selected' : '' ?>>Pilihan Ganda - Radio</option>
                                                                    <option value="2"<?= $lu->ps_tipe_pertanyaan == '2' ? 'selected' : '' ?>>Pilihan Ganda - Checkbox</option>
                                                                    <option value="3"<?= $lu->ps_tipe_pertanyaan == '3' ? 'selected' : '' ?>>Jawaban Singkat</option>
                                                                    <option value="4"<?= $lu->ps_tipe_pertanyaan == '4' ? 'selected' : '' ?>>Jawaban Panjang</option>
                                                                    <option value="5"<?= $lu->ps_tipe_pertanyaan == '5' ? 'selected' : '' ?>>Skala Likert</option>
                                                                </select>
                                                                <?php if ($is_jawaban == 1): ?>
                                                                <input type="hidden" name="tipePertanyaan<?= $lu->ps_id ?>" value="<?= $lu->ps_tipe_pertanyaan ?>">
                                                                <?php endif; ?>
                                                            </div>
                                                            <div id="div1<?= $lu->ps_id ?>" style="display:none;">
                                                                <?php
                                                                $piljas = explode(';', rtrim($lu->ps_pilihan_jawaban, ';'));
                                                                $count = false;
                                                                $index = 0;
                                                                foreach ($piljas as $pj) {
                                                                    $parts = explode(':', $pj);
                                                                    $isi   = $parts[0] ?? '';
                                                                    $logic = $parts[1] ?? '';
                                                                    $type  = $parts[2] ?? 'default';
                                                                    $rowId = "jawabanRadioRow{$lu->ps_id}_$index";
                                                                ?>
                                                                <div class="form-group row" id="<?= $rowId ?>">
                                                                    <?php if ($count == false) { ?>
                                                                        <label class="col-sm-2 control-label">Jawaban</label>
                                                                    <?php } else { ?>
                                                                        <label class="col-sm-2 control-label">&nbsp;</label>
                                                                    <?php } ?>
                                                                    <?php if ($is_jawaban == 1): ?>
                                                                    <div class="col-sm-2">
                                                                        <p class="form-control-static">
                                                                        <input type="text" class="form-control" name="typeja[]" value="<?= $type ?>" readonly>
                                                                        </p>
                                                                    </div>
                                                                    <?php else: ?>
                                                                    <div class="col-sm-2">
                                                                        <p class="form-control-static">
                                                                            <select name="typeja[]" class="form-control">
                                                                                <option value="default"<?= $type == 'default' ? ' selected' : '' ?>>Default</option>
                                                                                <option value="essai"<?= $type == 'essai' ? ' selected' : '' ?>>Essai</option>
                                                                            </select>
                                                                        </p>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                    <div class="col-sm-3">
                                                                        <p class="form-control-static">
                                                                            <input type="text" class="form-control" name="pilja[]" value="<?= $isi ?>" placeholder="Pilihan Jawaban" <?= $is_jawaban == 1 ? 'readonly' : '' ?>>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <p class="form-control-static">
                                                                            <input type="text" class="form-control" name="logicja[]" value="<?= $logic ?>" placeholder="Logic" <?= $is_jawaban == 1 ? 'readonly' : '' ?>>
                                                                        </p>
                                                                    </div>
                                                                    <?php if ($is_jawaban == 0): ?>
                                                                    <div class="col-sm-3">
                                                                        <button type="button" class="btn btn-danger btn-block" onclick="removeJawabanRow('<?= $rowId ?>')">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <?php 
                                                                    $count = true; 
                                                                    $index++;
                                                                } ?>
                                                                <div id="PilGandaRadioContainer<?= $lu->ps_id ?>"></div>
                                                                <!-- <div style="text-align: center; margin-top: 1rem;">
                                                                    <button type="button" class="btn btn-default btn-block" onclick="extraPilGandaRadioEdit('<?= $lu->ps_id ?>')">
                                                                        <i class="fa fa-plus"></i> Tambahkan
                                                                    </button>
                                                                </div> -->
                                                            </div>
                                                            <div id="div2<?= $lu->ps_id ?>" style="display:none;">
                                                                <?php
                                                                $piljas = explode(';', rtrim($lu->ps_pilihan_jawaban, ';'));
                                                                $count = false;
                                                                $index = 0;
                                                                foreach ($piljas as $pj) {
                                                                    $parts = explode(':', $pj);

                                                                    $isi   = $parts[0] ?? '';
                                                                    $logic = $parts[1] ?? '';
                                                                    $type  = $parts[2] ?? 'default'; ;
                                                                    $rowId = "jawabanCheckRow{$lu->ps_id}_$index";
                                                                ?>
                                                                <div class="form-group row" id="<?= $rowId ?>">
                                                                <?php if($count == false) { ?>
                                                                    <label class="col-sm-2 control-label">Jawaban</label>
                                                                    <?php } else {?>
                                                                        <label class="col-sm-2 control-label">&nbsp</label>
                                                                    <?php } ?>
                                                                    <?php if ($is_jawaban == 1): ?>
                                                                    <div class="col-sm-2">
                                                                        <p class="form-control-static">
                                                                        <input type="text" class="form-control" name="typeja[]" value="<?= $type ?>" readonly>
                                                                        </p>
                                                                    </div>
                                                                    <?php else: ?>
                                                                    <div class="col-sm-2">
                                                                        <p class="form-control-static">
                                                                            <select name="typeja[]" class="form-control">
                                                                                <option value="default"<?= $type == 'default' ? ' selected' : '' ?>>Default</option>
                                                                                <option value="essai"<?= $type == 'essai' ? ' selected' : '' ?>>Essai</option>
                                                                            </select>
                                                                        </p>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                    <div class="col-sm-3">
                                                                        <p class="form-control-static"><input type="text" class="form-control" id="pilja" name="pilja[]" value ="<?= $isi ?>" placeholder="Pilihan Jawaban" <?= $is_jawaban == 1 ? 'readonly' : '' ?>></p>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <p class="form-control-static"><input type="text" class="form-control" id="logicja" name="logicja[]" value ="<?= $logic ?>" placeholder="Logic" <?= $is_jawaban == 1 ? 'readonly' : '' ?>></p>
                                                                    </div>
                                                                    <?php if ($is_jawaban == 0): ?>
                                                                    <div class="col-sm-3">
                                                                        <button type="button" class="btn btn-danger btn-block" onclick="removeJawabanRow('<?= $rowId ?>')">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </div>   
                                                                    <?php endif;?>                                                             
                                                                </div>
                                                                <?php 
                                                                    $count = true; 
                                                                    $index++;
                                                                } ?>
                                                                <div id="PilGandaCheckContainer<?= $lu->ps_id ?>"></div>
                                                                <!-- <div style="text-align: center; margin-top: 1rem;">
                                                                    <p><button type="button" class="btn btn-default btn-block" onclick="extraPilGandaCheckEdit('<?= $lu->ps_id ?>')" style="margin-top:6px;"><i class="fa fa-plus"></i> Tambahkan</button></p>
                                                                </div> -->
                                                            </div>
                                                            <div id="div3<?= $lu->ps_id ?>" style="display:none;">
                                                                <div id="InpTextContainer<?= $lu->ps_id ?>"></div>
                                                                <br>
                                                                <!-- <div class="col-sm-3">
                                                                    <p><button type="button" class="btn btn-default btn-block" onclick="extraInpTextEdit('<?= $lu->ps_id ?>')" style="margin-top:6px;"><i class="fa fa-plus"></i> Tambahkan Logic</button></p>
                                                                </div> -->
                                                            </div>
                                                            <div id="div4<?= $lu->ps_id ?>" style="display:none;">
                                                                <div id="InpTextAreaContainer<?= $lu->ps_id ?>"></div>
                                                                <br>
                                                                <!-- <div class="col-sm-3">
                                                                    <p><button type="button" class="btn btn-default btn-block" onclick="extraInpTextAreaEdit('<?= $lu->ps_id ?>')" style="margin-top:6px;"><i class="fa fa-plus"></i> Tambahkan Logic</button></p>
                                                                </div> -->
                                                            </div>
                                                            <div id="div5<?= $lu->ps_id ?>" style="display:none;">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 control-label">Jawaban</label>
                                                                    <?php
                                                                    $piljas = explode(';', rtrim($lu->ps_pilihan_jawaban, ';'));
                                                                    $hasil = '';
                                                                    $logic = '';
                                                                    $range = '';

                                                                    foreach ($piljas as $key => $pj) {
                                                                        if (trim($pj) === '') continue;

                                                                        $parts = explode(':', $pj, 3);

                                                                        if ($key === 0) {
                                                                            $hasil = trim($parts[0] ?? '');
                                                                            $logic = trim($parts[1] ?? '');
                                                                        } elseif ($key === 1) {
                                                                            $range = trim($parts[0] ?? '');
                                                                        }
                                                                    }                                                                  
                                                                    ?>
                                                                    <div class="form-group">
                                                                        <select name="pilja[]" id="pilja" class="form-control" <?= $is_jawaban == 1 ? 'disabled' : '' ?>>
                                                                            <option value="">Pilih Tipe Likert</option>
                                                                            <option value="star" <?= ($hasil == 'star') ? 'selected' : '' ?>>Star</option>
                                                                            <option value="love" <?= ($hasil == 'love') ? 'selected' : '' ?>>Love</option>
                                                                            <option value="bar" <?= ($hasil == 'bar') ? 'selected' : '' ?>>Bar</option>
                                                                            <option value="opini" <?= ($hasil == 'opini') ? 'selected' : '' ?>>Opini</option>
                                                                            <option value="persegi" <?= ($hasil == 'persegi') ? 'selected' : '' ?>>Persegi Rating</option>
                                                                        </select>
                                                                    </div>
                                                                    <?php if ($is_jawaban == 1): ?>
                                                                    <input type="hidden" name="pilja[]" value="<?= $hasil ?>">
                                                                    <?php endif; ?>
                                                                    <div class="col-sm-4">
                                                                        <p class="form-control-static"><input type="text" class="form-control" id="pilja" name="pilja[]" value ="<?= $range ?>" placeholder="Tulis Teks Range" <?= $is_jawaban == 1 ? 'readonly' : '' ?>></p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static"><input type="text" class="form-control" id="logicja" name="logicja[]" value ="<?= $logic ?>" placeholder="Logic" <?= $is_jawaban == 1 ? 'readonly' : '' ?>></p>
                                                                    </div>
                                                                </div>
                                                                <div id="PilLikertContainer<?= $lu->ps_id ?>"></div>
                                                            </div>

                                                        </div>
                                                        <div class="box-footer">
                                                        <input type="hidden" name="idPertanyaan" value="<?= $lu->ps_id ?>">
                                                            <input type="hidden" name="idSurvey" value="<?= $infosurvey[0]->id_survey ?>">
                                                            <input type="hidden" name="idSeksi" value="<?= $infosurvey[0]->id_seksi ?>">
                                                            <input type="hidden" name="kodeSeksi" value="<?= $infosurvey[0]->ss_kode ?>">

                                                            <button type="submit" class="btn btn-success">Kirim</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="hapusSurvey<?= $lu->ps_id; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title"> Hapus Pertanyaan Survey</h6>
                                                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="box-body">
                                                        <h4>Anda yakin akan menghapus Pertanyaan <?= $lu->ps_pertanyaan; ?>?</h4>

                                                    </div>
                                                    <div class="box-footer">
                                                        <a href="<?= base_url('admin/hapus_pertanyaan/' . $lu->ps_id_seksi . '/' . $lu->ps_id); ?>" class="btn btn-danger">Ya</a> &nbsp;
                                                        <button class="btn btn-default" data-bs-dismiss="modal">Tidak</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="modal fade" id="duplikatSurvey<?= $lu->ps_id; ?>"> -->
                                    <div class="modal fade" id="duplikatSurvey<?= $lu->ps_id; ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title"> Tambah Pertanyaan Survey</h6>
                                                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url(); ?>admin/tambah_pertanyaan" method="POST">
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label for="KodePertanyaan">Kode Pertanyaan :</label>
                                                                <input type="text" name="KodePertanyaan" class="form-control" value="<?= $lu->ps_kode; ?>" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Pertanyaan">Pertanyaan :</label>
                                                                <div class="form-control-static">
                                                                <textarea class="form-control" name="Pertanyaan" rows="5" cols="85"><?= strip_tags($lu->ps_pertanyaan); ?></textarea>
                                                                    <div id="editor" style="min-height: 160px;"><?= set_value('Pertanyaan') ?></div>
                                                                </div>
                                                            </div>
                                                            
                                                            <?php
                                                            $selectedOption = $lu->ps_tipe_pertanyaan; // Example value retrieved from the database

                                                            $optionLabels = [
                                                                "1" => "Pilihan Ganda - Radio",
                                                                "2" => "Pilihan Ganda - Checkbox",
                                                                "3" => "Jawaban Singkat",
                                                                "4" => "Jawaban Panjang",
                                                                "5" => "Skala Likert"
                                                            ];
                                                            ?>

                                                            <div class="form-group">
                                                                <label for="tipePertanyaan">Tipe Pertanyaan :</label>
                                                                <select name="tipePertanyaan" id="tipePertanyaan" onchange="showDiv('div', this)" class="form-control" required>
                                                                    <?php
                                                                    // Loop through the optionLabels array to generate the <option> elements
                                                                    foreach ($optionLabels as $value => $label) {
                                                                        $selected = ($selectedOption == $value) ? "selected" : ""; // Check if the current option is selected
                                                                        echo "<option value=\"$value\" $selected>$label</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div id="div1" style="display:block;">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 control-label">Jawaban</label>
                                                                    <div class="col-sm-4">
                                                                        <p class="form-control-static"><input type="text" class="form-control" id="pilja" name="pilja[]" placeholder="Pilihan Jawaban"></p>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <p class="form-control-static"><input type="text" class="form-control" id="logicja" name="logicja[]" placeholder="Logic"></p>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <p><button type="button" class="btn btn-default btn-block" onclick="extraPilGandaRadioEdit()" style="margin-top:6px;"><i class="fa fa-plus"></i> Tambahkan</button></p>
                                                                    </div>
                                                                </div>
                                                                <div id="PilGandaRadioContainer"></div>
                                                            </div>
                                                            <div id="div2" style="display:none;">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 control-label">Jawaban</label>
                                                                    <div class="col-sm-4">
                                                                        <p class="form-control-static"><input type="text" class="form-control" id="pilja" name="pilja[]" placeholder="Pilihan Jawaban"></p>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <p class="form-control-static"><input type="text" class="form-control" id="logicja" name="logicja[]" placeholder="Logic"></p>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <p><button type="button" class="btn btn-default btn-block" onclick="extraPilGandaCheck()" style="margin-top:6px;"><i class="fa fa-plus"></i> Tambahkan</button></p>
                                                                    </div>
                                                                </div>
                                                                <div id="PilGandaCheckContainer"></div>
                                                            </div>
                                                            <div id="div3" style="display:none;">
                                                                <div id="InpTextContainer"></div>
                                                                <div class="col-sm-3">
                                                                    <p><button type="button" class="btn btn-default btn-block" onclick="extraInpText()" style="margin-top:6px;"><i class="fa fa-plus"></i> Tambahkan Logic</button></p>
                                                                </div>
                                                            </div>
                                                            <div id="div4" style="display:none;">
                                                                <div id="InpTextAreaContainer"></div>
                                                                <div class="col-sm-3">
                                                                    <p><button type="button" class="btn btn-default btn-block" onclick="extraInpTextArea()" style="margin-top:6px;"><i class="fa fa-plus"></i> Tambahkan Logic</button></p>
                                                                </div>
                                                            </div>
                                                            <div id="div5" style="display:none;">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 control-label">Jawaban</label>

                                                                    <div class="form-group">
                                                                        <select name="pilja[]" id="pilja" class="form-control">
                                                                            <option value="">Pilih Tipe Likert</option>
                                                                            <option value="star">Star</option>
                                                                            <option value="love">Love</option>
                                                                            <option value="bar">Bar</option>
                                                                            <option value="opini">Opini</option>
                                                                            <option value="persegi">Persegi Rating</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <p class="form-control-static"><input type="text" class="form-control" id="pilja" name="pilja[]" placeholder="Tulis Teks Range"></p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static"><input type="text" class="form-control" id="logicja" name="logicja[]" placeholder="Logic"></p>
                                                                    </div>
                                                                </div>
                                                                <div id="PilLikertContainer"></div>
                                                            </div>

                                                        </div>
                                                        <div class="box-footer">
                                                            <input type="hidden" name="idSurvey" value="<?= $infosurvey[0]->id_survey ?>">
                                                            <input type="hidden" name="idSeksi" value="<?= $infosurvey[0]->id_seksi ?>">

                                                            <button type="submit" class="btn btn-success">Duplikat</button>
                                                        </div>
                                                    </form>
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


<script>
    function showDiv(prefix, chooser) {
        for (var i = 0; i < chooser.options.length; i++) {
            var div = document.getElementById(prefix + chooser.options[i].value);
            div.style.display = 'none';
        }

        var selectedOption = (chooser.options[chooser.selectedIndex].value);

        if (selectedOption == "1") //Radio
        {
            displayDiv(prefix, "1");
        }
        if (selectedOption == "2") //Checkbox
        {
            displayDiv(prefix, "2");
        }
        if (selectedOption == "3") //Inpttext
        {
            displayDiv(prefix, "3");
        }
        if (selectedOption == "4") //textarea
        {
            displayDiv(prefix, "4");
        }
        if (selectedOption == "5") //Likert
        {
            displayDiv(prefix, "5");
        }
    }

    function displayDiv(prefix, suffix) {
        var div = document.getElementById(prefix + suffix);
        div.style.display = 'block';
    }

    function showDivEdit(prefix, chooser, ps_id) {
        for (var i = 1; i <= 5; i++) {
            var div = document.getElementById(prefix + i + ps_id);
            if (div) {
                div.style.display = 'none';
                Array.from(div.querySelectorAll("input, select, textarea")).forEach(function (el) {
                    el.disabled = true;
                });
            }
        }

        var selectedOption = chooser.value;
        if (["1", "2", "3", "4", "5"].includes(selectedOption)) {
            var targetDiv = document.getElementById(prefix + selectedOption + ps_id);
            if (targetDiv) {
                targetDiv.style.display = 'block';
                Array.from(targetDiv.querySelectorAll("input, select, textarea")).forEach(function (el) {
                    el.disabled = false;
                });
            }
        }
    }

    function displayDivEdit(prefix, suffix, ps_id) {
        var div = document.getElementById(prefix + suffix + ps_id);
        if (div) div.style.display = 'block';
    }
    
    document.addEventListener("DOMContentLoaded", function () {
        <?php foreach ($listpertanyaan as $lu): ?>
            var selectElement = document.getElementById("tipePertanyaan<?= $lu->ps_id ?>");
            if (selectElement) {
                showDivEdit('div', selectElement, '<?= $lu->ps_id ?>');
            }
        <?php endforeach; ?>
    });


    //PilihanGanda (satu dan banyak jawaban)
    //jawaban singkat dan panjang
    //skala llikerts
    //pemilihan gambar


    /*
    <div class="form-group row"><label class="col-sm-3 control-label">Pilihan Jawaban</label><div class="col-sm-6"><p class="form-control-static"><input type="text" class="form-control" id="pilja" name="pilja[]" placeholder="Pilihan Jawaban"></p></div> <div class="col-sm-3"></div></div>

    <div class="form-group row"><label class="col-sm-2 control-label">Jawaban</label><div class="col-sm-4"><p class="form-control-static"><input type="text" class="form-control" id="pilja" name="pilja[]" placeholder="Pilihan Jawaban"></p> </div>  <div class="col-sm-2"> <p class="form-control-static"><input type="text" class="form-control" id="logicja" name="logicja[]" placeholder="Logic"></p> </div>  <div class="col-sm-3"> <p><button type="button" class="btn btn-default btn-block" onclick="extraPilGandaRadio()" style="margin-top:6px;"><i class="fa fa-plus"></i> Tambahkan</button></p> </div> </div>
    */
    function extraPilSkalaLikert() {
        $("#PilLikertContainer").append('<div class="form-group row"><label class="col-sm-2 control-label">&nbsp</label><div class="col-sm-4"><p class="form-control-static"><input type="text" class="form-control" id="pilja" name="pilja[]" placeholder="Pilihan Jawaban"></p> </div>  <div class="col-sm-2"> <p class="form-control-static"><input type="text" class="form-control" id="logicja" name="logicja[]" placeholder="Logic"></p> </div>  <div class="col-sm-3"> </div> </div>');
    }

    function extraPilGandaRadio() {
        $("#PilGandaRadioContainer").append('<div class="form-group row"><label class="col-sm-2 control-label">&nbsp</label><div class="col-sm-2"><p class="form-control-static"><select name="typeja[]" id="typeja" class="form-control" required><option value="default">Default</option><option value="essai">Essai</option></select></div><div class="col-sm-3"><p class="form-control-static"><input type="text" class="form-control" id="pilja" name="pilja[]" placeholder="Pilihan Jawaban"></p> </div>  <div class="col-sm-2"> <p class="form-control-static"><input type="text" class="form-control" id="logicja" name="logicja[]" placeholder="Logic"></p> </div>  <div class="col-sm-3"> </div> </div>');
    }

    function extraPilGandaCheck() {
        $("#PilGandaCheckContainer").append('<div class="form-group row"><label class="col-sm-2 control-label">&nbsp</label><div class="col-sm-2"><p class="form-control-static"><select name="typeja[]" id="typeja" class="form-control" required><option value="default">Default</option><option value="essai">Essai</option></select></div><div class="col-sm-3"><p class="form-control-static"><input type="text" class="form-control" id="pilja" name="pilja[]" placeholder="Pilihan Jawaban"></p> </div>  <div class="col-sm-2"> <p class="form-control-static"><input type="text" class="form-control" id="logicja" name="logicja[]" placeholder="Logic"></p> </div>  <div class="col-sm-3"> </div> </div>');
    }

    function extraInpText() {
        $("#InpTextContainer").append('<input type="hidden" id="pilja" name="pilja[]" value="jawaban singkat"><div class="col-sm-2"><p class="form-control-static"><input type="text" class="form-control" id="logicja" name="logicja[]" placeholder="Logic"></p></div>');
        // $("#PilGandaCheckContainer").append('<div class="form-group row"><label class="col-sm-2 control-label">&nbsp</label><div class="col-sm-4"><p class="form-control-static"><input type="text" class="form-control" id="pilja" name="pilja[]" placeholder="Pilihan Jawaban"></p> </div>  <div class="col-sm-2"> <p class="form-control-static"><input type="text" class="form-control" id="logicja" name="logicja[]" placeholder="Logic"></p> </div>  <div class="col-sm-3"> </div> </div>');
    }

    function extraInpTextArea() {
        $("#InpTextAreaContainer").append('<input type="hidden" id="pilja" name="pilja[]" value="jawaban panjang"><div class="col-sm-2"><p class="form-control-static"><input type="text" class="form-control" id="logicja" name="logicja[]" placeholder="Logic"></p></div>');
    }

    function extraTicketAttachment() {
        $("#fileUploadsContainer").append('<div class="form-group row"><div class="col-sm-2"></div><div class="col-sm-4"><input type="file" name="filep[]" class="form-control" /></div></div>');
    }


    function extraPilSkalaLikertEdit(ps_id) {
        $("#PilLikertContainer" + ps_id).append(`
            <div class="form-group row">
                <label class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-4">
                    <p class="form-control-static">
                        <input type="text" class="form-control" name="pilja[]" placeholder="Pilihan Jawaban">
                    </p>
                </div>
                <div class="col-sm-2">
                    <p class="form-control-static">
                        <input type="text" class="form-control" name="logicja[]" placeholder="Logic">
                    </p>
                </div>
                <div class="col-sm-3"></div>
            </div>
        `);
    }

    function extraPilGandaRadioEdit(ps_id) {
        const uniqueId = 'jawabanRadioRow_' + ps_id + '_' + Date.now();
        $("#PilGandaRadioContainer" + ps_id).append(`
            <div class="form-group row" id="${uniqueId}">
                <label class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-2">
                    <p class="form-control-static">
                        <select name="typeja_new[]" class="form-control" required>
                            <option value="default">Default</option>
                            <option value="essai">Essai</option>
                        </select>
                    </p>
                </div>
                <div class="col-sm-3">
                    <p class="form-control-static">
                        <input type="text" class="form-control" name="pilja_new[]" placeholder="Pilihan Jawaban">
                    </p>
                </div>
                <div class="col-sm-2">
                    <p class="form-control-static">
                        <input type="text" class="form-control" name="logicja_new[]" placeholder="Logic">
                    </p>
                </div>
                <div class="col-sm-3">
                    <button type="button" class="btn btn-danger btn-block" onclick="removeJawabanRow('${uniqueId}')">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        `);
    }

    function extraPilGandaCheckEdit(ps_id) {
        const uniqueId = 'jawabanCheckRow_' + ps_id + '_' + Date.now();
        $("#PilGandaCheckContainer" + ps_id).append(`
            <div class="form-group row" id="${uniqueId}">
                <label class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-2">
                    <p class="form-control-static">
                        <select name="typeja[]" class="form-control" required>
                            <option value="default">Default</option>
                            <option value="essai">Essai</option>
                        </select>
                    </p>
                </div>
                <div class="col-sm-3">
                    <p class="form-control-static">
                        <input type="text" class="form-control" name="pilja[]" placeholder="Pilihan Jawaban">
                    </p>
                </div>
                <div class="col-sm-2">
                    <p class="form-control-static">
                        <input type="text" class="form-control" name="logicja[]" placeholder="Logic">
                    </p>
                </div>
                <div class="col-sm-3">
                    <button type="button" class="btn btn-danger btn-block" onclick="removeJawabanRow('${uniqueId}')">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        `);
    }

    function extraInpTextEdit(ps_id) {
        $("#InpTextContainer" + ps_id).append(`
            <input type="hidden" name="pilja[]" value="jawaban singkat">
            <div class="col-sm-2">
                <p class="form-control-static">
                    <input type="text" class="form-control" name="logicja[]" placeholder="Logic">
                </p>
            </div>
        `);
    }

    function extraInpTextAreaEdit(ps_id) {
        $("#InpTextAreaContainer" + ps_id).append(`
            <input type="hidden" name="pilja[]" value="jawaban panjang">
            <div class="col-sm-2">
                <p class="form-control-static">
                    <input type="text" class="form-control" name="logicja[]" placeholder="Logic">
                </p>
            </div>
        `);
    }

    function extraTicketAttachmentEdit(ps_id) {
        $("#fileUploadsContainer" + ps_id).append(`
            <div class="form-group row">
                <div class="col-sm-2"></div>
                <div class="col-sm-4">
                    <input type="file" name="filep[]" class="form-control" />
                </div>
            </div>
        `);
    }

    function removeJawabanRow(id) {
        const row = document.getElementById(id);
        if (row) {
            row.remove();
        }
    }
    $(document).ready(function() {
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


    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var kewajibanSelect = document.getElementById("kewajibanMengisi");
        var logicPertanyaanDiv = document.getElementById("logicPertanyaan");

        function toggleLogicPertanyaan() {
            if (kewajibanSelect.value === "required_if") {
                logicPertanyaanDiv.style.display = "block";
            } else {
                logicPertanyaanDiv.style.display = "none";
            }
        }

        toggleLogicPertanyaan();
        kewajibanSelect.addEventListener("change", toggleLogicPertanyaan);
    });
    <?php foreach ($listpertanyaan as $lu): ?>
        // const quill<?= $lu->ps_id ?> = new Quill("#editor<?= $lu->ps_id ?>", {
        //     theme: "snow"
        // });

        document.getElementById("formEdit<?= $lu->ps_id ?>").addEventListener("submit", function (e) {
            const editorWrapper = document.querySelector("#editor<?= $lu->ps_id ?>");
            const editorContent = editorWrapper?.querySelector(".ql-editor")?.innerHTML || "";

            document.getElementById("pertanyaanHidden<?= $lu->ps_id ?>").value = editorContent;
        });
    <?php endforeach; ?>
</script>