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
                                    <div class="col-sm-3">
                                        <p><button type="button" class="btn btn-default btn-block" onclick="extraPilGandaRadio()" style="margin-top:6px;"><i class="fa fa-plus"></i> Tambahkan</button></p>
                                    </div>
                                </div>
                                <div id="PilGandaRadioContainer"></div>
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
                                            <!--<button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#tambahSurvey<?= $lu->ps_id; ?>"><i class="fa fa-edit"></i> Edit</button> &nbsp;-->
                                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#duplikatSurvey<?= $lu->ps_id; ?>"><i class="fa fa-copy"></i> Duplikat</button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusSurvey<?= $lu->ps_id; ?>"><i class="fa fa-trash"></i> Hapus</button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="edit<?= $lu->ps_id; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title"> Edit Pertanyaan Survey</h6>
                                                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url(); ?>admin/edit_survey_seksi/<?= $lu->ps_id; ?>" method="POST">
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label for="KodeSurvey">Kode Seksi Survey :</label>
                                                                <input type="text" name="KodeSurvey" class="form-control" placeholder="Masukkan Kode Survey" value="<?= $lu->ps_kode; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="NamaSurvey">Judul Seksi Survey :</label>
                                                                <input type="text" name="nmSurvey" class="form-control" placeholder="Masukkan Nama Survey" value="<?= $infosurvey[0]->ss_judul; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="NamaSurvey">Keterangan Seksi Survey : (opsional)</label>
                                                                <input type="text" name="ketSurvey" class="form-control" placeholder="Masukkan Nama Survey" value="<?= $infosurvey[0]->ss_keterangan; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="box-footer">
                                                            <input type="hidden" name="idSurvey" value="<?= $lu->ps_id_survey ?>">
                                                            <button type="submit" class="btn btn-success">Update</button>
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
                                                                        <p><button type="button" class="btn btn-default btn-block" onclick="extraPilGandaRadio()" style="margin-top:6px;"><i class="fa fa-plus"></i> Tambahkan</button></p>
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


    })
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
</script>
