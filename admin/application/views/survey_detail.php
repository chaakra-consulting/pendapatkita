<style>
/* Default styles for all devices */
#device-wrapper {
    max-width: 950px; /* Default width when modal opens */
    margin: 0 auto;
    padding: 3px; /* Adjusted from p-3 for consistency */
}
#device-wrapper .row.mb-3.align-items-start {
    margin-bottom: 1.5rem;
}

#device-wrapper .col-12 .form-control-static.fw-bold {
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

#device-wrapper .fw-bold {
    font-size: 1rem;
    line-height: 1.4;
}

/* Specific styles for phone view */
#device-wrapper.device-phone {
    max-width: 370px;
    margin: 0 auto;
    padding: 1rem;
    font-size: 0.85rem; /* kecilkan semua font dalam wrapper */
}

#device-wrapper.device-phone .row.mb-3.align-items-start {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

#device-wrapper.device-phone .col-12 .form-control-static.fw-bold {
    width: 100%;
    margin-bottom: 0.75rem;
    font-size: 0.9rem;
}

#device-wrapper.device-phone .col-12 .fw-bold {
    width: 100%;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

#device-wrapper.device-phone .form-control,
#device-wrapper.device-phone textarea {
    width: 100%;
    font-size: 0.85rem; /* kecilkan input font */
}

/* Atur ulang form-group layout */
#device-wrapper.device-phone .form-group.row {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-bottom: 1rem;
    font-size: 0.85rem;
}

#device-wrapper.device-phone .form-group.row > label {
    margin-bottom: 0.25rem;
    /* font-weight: bold; */
    width: 100%;
    font-size: 0.8rem;
}

#device-wrapper.device-phone .form-group.row > .col-sm-9 {
    width: 100%;
}

#device-wrapper.device-phone .form-group.row > .col-sm-3 {
    display: none;
}

#device-wrapper.device-phone .form-group.row input.form-control {
    width: 100%;
    font-size: 0.85rem;
    margin-top: 0.25rem;
    padding: 0.4rem 0.6rem;
}
</style>
                <div class="container">
					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="left-content">
                            <br>
                            <br>
											 
							 <h1 class="content-title mb-0 my-auto">Detail Survey</h1>
							 <h4 class="content-title mb-0 my-auto">"<?php echo $infosurvey[0]->nama_survey; ?>"</h4>
						</div>
						<div class="main-dashboard-header-right">
							<a href="<?=base_url()?>survey"><button style="height:30px;" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-arrow-left"></i> Back</button></a> &nbsp; 
							  <button class="btn btn-sm btn-flat btn-success" data-bs-toggle="modal" style="height:30px;" data-bs-target="#tambahSurvey"><i class="fa fa-plus"></i> Tambah Seksi Survey</button>
						</div>
					</div>
                    <br>
					<div class="modal fade" id="tambahSurvey">
                    <div class="modal-dialog">
                        <div class="modal-content">
						<div class="modal-header">
							<h6 class="modal-title"> Tambah Seksi Survey</h6>
							<button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
						</div> 
                            <div class="modal-body">
                                <form action="<?=base_url();?>admin/tambah_survey_seksi" method="POST">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="KodeSurvey">Kode Seksi Survey :</label>
                                            <input type="text" name="KodeSurvey" class="form-control" placeholder="Masukkan Kode Seksi Survey" required>
                                        </div>  
                                        <div class="form-group">
                                            <label for="nmSurvey">Judul Seksi Survey :</label>
                                            <input type="text" name="nmSurvey" class="form-control" placeholder="Judul Seksi Survey" required>
                                        </div>  
                                        <div class="form-group">
                                            <label for="nmSurvey">Keterangan Seksi Survey (opsional):</label>
                                            <input type="text" name="ketSurvey" class="form-control" placeholder="Masukkan Keterangan Seksi Survey">
                                        </div>   
                                    </div>
                                    <div class="box-footer">
										<input type="hidden" name="idSurvey" value="<?=$infosurvey[0]->id_survey?>">
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
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Detail Survey</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">"<?php echo $infosurvey[0]->nama_survey; ?>"</p>
							</div>
							<div class="card-body">
							
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
											<tr> 									
												<th>No.</th>
												<th>Kode Seksi Survey</th>  
												<th>Judul Seksi Survey</th>  
												<th>Keterangan</th>
												<th>#</th>
											</tr>
										</thead>
										<tbody> 
										<?php 
											$no = 1;
											foreach ($listsurvey as $lu) { ?>
											<tr>
                            <td><?=$no++;?>.</td>
                            <td><?=$lu->ss_kode;?></td>  
                            <td><?=$lu->ss_judul;?></td>  
                            <td><?php 
								$tampil_sebagian=substr($lu->ss_keterangan, 0, 50);
								echo $tampil_sebagian;
								if($lu->ss_keterangan!=''&&strlen($lu->ss_keterangan)>50){
									echo '...';
								}
								?>
							</td>  
                             <td>
                                <a href="<?=base_url()?>admin/seksi_detail/<?=$lu->id_seksi;?>/<?=$lu->ss_id_survey;?>"><button class="btn btn-sm btn-success"><i class="fa fa-bars"></i> List Pertanyaan</button></a> 
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$lu->id_seksi;?>"><i class="fa fa-edit"></i> Edit</button>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#duplikat<?=$lu->id_seksi;?>"><i class="fa fa-edit"></i> Duplikat</button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusSurvey<?=$lu->id_seksi;?>"><i class="fa fa-trash"></i> Hapus</button>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#pratinjau<?=$lu->id_seksi;?>"><i class="fa fa-eye"></i> Pratinjau</button>
                            </td>
                        </tr>

                        <div class="modal fade" id="pratinjau<?=$lu->id_seksi;?>">
                            <div class="modal-dialog modal-fullscreen">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Pratinjau Survey</h6>
                                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-center mb-3">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-outline-primary" onclick="setDeviceWidth('laptop', this)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-laptop"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 19l18 0" /><path d="M5 6m0 1a1 1 0 0 1 1 -1h12a1 1 0 0 1 1 1v8a1 1 0 0 1 -1 1h-12a1 1 0 0 1 -1 -1z" /></svg>
                                                </button>
                                                <button type="button" class="btn btn-outline-success" onclick="setDeviceWidth('tablet', this)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-tablet"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4a1 1 0 0 1 1 -1h12a1 1 0 0 1 1 1v16a1 1 0 0 1 -1 1h-12a1 1 0 0 1 -1 -1v-16z" /><path d="M11 17a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /></svg>
                                                </button>
                                                <button type="button" class="btn btn-outline-info" onclick="setDeviceWidth('phone', this)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-mobile"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 5a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-14z" /><path d="M11 4h2" /><path d="M12 17v.01" /></svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="device-wrapper" class="device-laptop mx-auto border p-3">
                                            <div class="container-fluid">
                                                <div class="breadcrumb-header justify-content-between">
                                                    <div class="my-auto">
                                                        <div class="d-flex">
                                                            <center>
                                                                <h4 class="content-title mb-0 my-auto">SURVEY : <?= $lu->ss_judul; ?></h4>
                                                            </center>
                                                            <br>
                                                            <br>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="progress-container mb-4">
                                                            <div class="progress-bar" style="width: 50%;" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                50% Selesai
                                                            </div>
                                                        </div>
                                                        <div class="card overflow-hidden">
                                                            <div class="card-header pb-0">
                                                                <h3 class="card-title">ISIAN SURVEY</h3>
                                                                <p class="text-muted card-sub-title mb-0"></p>
                                                            </div>
                                                            <div class="card-body">
                                                                <form method="POST" name="surveying" id="surveying" action="#" enctype="multipart/form-data">
                                                                <div class="panel-group1" id="accordion11">
                                                                    <div class="panel panel-default mb-4 panel-seksi panel-seksi-<?= $lu->ss_kode ?>">
                                                                        <div class="panel-heading1 bg-white ">
                                                                            <h4 class="panel-title1">
                                                                                <a class="accordion-toggle collapsed" data-bs-toggle="collapse" id="<?= $lu->ss_kode ?>" data-bs-parent="#accordion11" href="#collapseSur<?= $no; ?>" aria-expanded="false"><b>SEKSI <?= $lu->ss_kode ?> : <?= $lu->ss_judul ?></b></a>
                                                                            </h4>
                                                                        </div>                                                                        
                                                                        <div class="panel-body border">
                                                                            <div class="row row-xs formgroup-wrapper">
                                                                                <div class="col-12">
                                                                                    <?php
                                                                                        $lnk2 = ''; 
                                                                                        foreach ($lu->pertanyaan as $ta){
                                                                                        $piljab = $ta->ps_pilihan_jawaban;
                                                                                        $paklo = '';
                                                                                        $pakwar = '';
                                                                                        $first = true;
                                                                                        if ($ta->ps_tipe_pertanyaan == 1) {
                                                                                            $pilja = explode(';', $piljab);
                            
                                                                                            $radCheck = '';
                                                                                            $lnk2 = '';
                                                                                            foreach ($pilja as $pj) {
                                                                                                if ($pj != '') {
                                                                                                    $pillo = explode(':', $pj);
                                                                                                    $isNotMatch = false;
                                                                                                    
                                                                                                    if ($pillo[1] != '') {
                                                                                                        //jejak1
                            
                                                                                                        //Link Data
                                                                                                        $PgKar = $this->uri->segment(4); //Karakter Halaman
                                                                                                        $dataPgKar = $pillo[1]; //DataLink
                                                                                                        $wordsPGKar = trim($dataPgKar, "0..9");
                            
                                                                                                        if ($PgKar == $wordsPGKar) {
                                                                                                            //echo 'tetap';
                                                                                                            //$lnk = '<a href="#' . $pillo[1] . '">[ ' . $pillo[1] . ' ]</a>';
                                                                                                            $lnk = '<h8 class="text-primary mb-1">[ ' . $pillo[1] . ' ]</h8>';
                                                                                                        } 
                                                                                                        else {
                                                                                                            //echo 'beda';
                                                                                                            // $lnk = '<a href="#' . $pillo[1] . '"  data-value="' . $pillo[1] . '"  onclick="capture(this);">[ ' . $pillo[1] . ' ]</a>';
                                                                                                            $lnk = '<h8 class="text-primary mb-1">[ ' . $pillo[1] . ' ]</h8>';
                                                                                                        }
                                                                                                        //===================================
                                                                                                    } else {
                                                                                                        $lnk = '';
                                                                                                    }
                            
                                                                                                    $radioId = $ta->ps_id . '_' . $pillo[0];
                                                                                                    $extraInput = '';
                                                                                                    $extraInputId = 'input_' . $radioId;
                            
                                                                                                    $isEssai = isset($pillo[2]) && strtolower(trim($pillo[2])) == 'essai';
                                                                                                    $dataType = $isEssai ? 'essai' : 'default';
                                                                                                    $displayStyle = 'none';
                                                                                                    if ($isEssai) {
                                                                                                        $extraInput = '<div id="' . $extraInputId . '" class="extra-input" data-psid="' . $ta->ps_id . '" style="display:' . $displayStyle . '; margin-top:5px;">																				<p class="form-control-static">
                                                                                                                <input type="text" class="form-control" name="input_' . $ta->ps_id . '" value="">
                                                                                                            </p>
                                                                                                        </div>';
                                                                                                    }
                                                                                                    $isRequired = ($ta->must_answer == 'required') ? 'true' : 'false';
                                                                                                    
                                                                                                    $pakwar .= '<div class="radio">
                                                                                                    <label>
                                                                                                        <input type="radio"
                                                                                                            name="' . $ta->ps_id . '"
                                                                                                            id="' . $radioId . '"
                                                                                                            data-psid="' . $ta->ps_id . '"
                                                                                                            data-type="' . $dataType . '"
                                                                                                            data-target="' . $extraInputId . '"
                                                                                                            data-value="' . $pillo[1] . '"
                                                                                                            data-required="' . $isRequired . '"
                                                                                                            data-isnotmatch="' . $isNotMatch . '"
                                                                                                            onclick="handleRadioEvent(this)"> ' . $pillo[0] . ' ' . $lnk . '
                                                                                                    </label>
                                                                                                    ' . $extraInput . '
                                                                                                    </div>';																		                                                        
                                                                                                $paklo = $pillo[1];
                                                                                                $first = false;
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        elseif ($ta->ps_tipe_pertanyaan == 2) {
                                                                                            $pilja = explode(';', $piljab);
                                                                                            
                                                                                            foreach ($pilja as $key => $pj) {
                                                                                                if (trim($pj) === '') continue;
                                                                                            
                                                                                                $pillo = explode(':', $pj);
                                                                                                $label = $pillo[0] ?? '';
                                                                                                $linkVal = $pillo[1] ?? '';
                                                                                                $type = strtolower(trim($pillo[2] ?? 'default'));
                                                                                        
                                                                                                $checkboxId = $ta->ps_id . '_' . $label;
                                                                                                $extraInputId = 'input_' . $checkboxId;
                                                                                        
                                                                                                $isEssai = $type == 'essai';
                                                                                        
                                                                                                $isChecked = '';

                                                                                                $essaiValue ='';
                                                                                        
                                                                                                $displayStyle = 'none';
                            
                                                                                                if (!empty($linkVal)) {
                                                                                                    $PgKar = $this->uri->segment(4);
                                                                                                    $wordsPGKar = trim($linkVal, "0..9");
                            
                                                                                                    // $lnk = ($PgKar == $wordsPGKar)
                                                                                                    // 	? '<a href="#' . $linkVal . '">[ ' . $linkVal . ' ]</a>'
                                                                                                    // 	: '<a href="#' . $linkVal . '" data-value="' . $linkVal . '" onclick="capture(this);">[ ' . $linkVal . ' ]</a>';
                                                                                                    $lnk = ($PgKar == $wordsPGKar)
                                                                                                    ? '<h8 class="text-primary mb-1">[ ' . $linkVal . ' ]</h8>'
                                                                                                    : '<h8 class="text-primary mb-1">[ ' . $linkVal . ' ]</h8>';
                                                                                                } else {
                                                                                                    $lnk = '';
                                                                                                }
                                                                                                    
                                                                                                $isNotMatch = false;

                                                                                                $extraInput = '';
                            
                                                                                                $isRequired = ($ta->must_answer == 'required') ? 'true' : 'false';
                            
                                                                                                if ($isEssai) {
                                                                                                    $extraInput = '
                                                                                                    <div id="' . $extraInputId . '" class="extra-input" data-psid="' . $ta->ps_id . '" style="display:' . $displayStyle . '; margin-top:5px;">
                                                                                                        <p class="form-control-static">
                                                                                                            <input type="text" class="form-control"
                                                                                                                oninput="updateCheckboxValue(this)"
                                                                                                                data-label="' . htmlspecialchars($label) . '"
                                                                                                                data-target="' . $checkboxId . '"
                                                                                                                value="' . htmlspecialchars($essaiValue) . '">
                                                                                                        </p>
                                                                                                    </div>';																	
                                                                                                }
                                                                                        
                                                                                                $pakwar .= '
                                                                                                <div class="checkbox">
                                                                                                    <label>
                                                                                                        <input type="checkbox"
                                                                                                            name="' . $ta->ps_id . '[]"
                                                                                                            id="' . $checkboxId . '"
                                                                                                            value="' . $label . '"
                                                                                                            ' . $isChecked . '
                                                                                                            data-psid="' . $ta->ps_id . '"
                                                                                                            data-type="' . $type . '"
                                                                                                            data-target="' . $extraInputId . '"
                                                                                                            data-value="' . $pillo[1] . '"
                                                                                                            data-isnotmatch="' . $isNotMatch . '"
                                                                                                            data-required="' . $isRequired . '"
                                                                                                            onclick="handleCheckboxEvent(this)">
                                                                                                        ' . $label . ' ' . $lnk . '
                                                                                                    </label>
                                                                                                    ' . $extraInput . '
                                                                                                </div>';	
                                                                                                $first = false;																																	
                                                                                            }
                                                                                        }
                                                                                        elseif ($ta->ps_tipe_pertanyaan == 3) {
                                                                                            $pilja = explode(';', $piljab);
                                                                                            // print_r($pilja);exit;
                                                                                            foreach ($pilja as $pj) {
                                                                                                if ($pj != '') {
                                                                                                    $pillo = explode(':', $pj);
                            
                                                                                                    if ($pillo[1] != '') {
                                                                                                        //$lnk='<a href="#'.$pillo[1].'">[ '.$pillo[1].' ]</a>';
                            
                                                                                                        //Link Data
                                                                                                        $PgKar = $this->uri->segment(4); //Karakter Halaman
                                                                                                        $dataPgKar = $pillo[1]; //DataLink
                                                                                                        $wordsPGKar = trim($dataPgKar, "0..9");
                                                                                                        if ($PgKar == $wordsPGKar) {
                                                                                                            //echo 'tetap';
                                                                                                            $lnk = '<a href="#' . $pillo[1] . '">[ ' . $pillo[1] . ' ]</a>';
                                                                                                        } else {
                                                                                                            //echo 'beda';
                                                                                                            $lnk = '<a href="#' . $pillo[1] . '"  data-value="' . $pillo[1] . '"  onclick="capture(this);">[ ' . $pillo[1] . ' ]</a>';
                                                                                                        }
                                                                                                        //===================================
                            
                                                                                                    } else {
                                                                                                        $lnk = '';
                                                                                                    }
                                                                                                    $lnk2 = $lnk;
                                                                                                }
                                                                                            }
                                                                                            $isRequired = ($ta->must_answer == 'required') ? 'true' : 'false';
                                                                                            $paklo = '';
                                                                                            $pakwar = '<p class="form-control-static"><input type="text" class="form-control"  name="' . $ta->ps_id . '" data-psid="' . $ta->ps_id . '" data-required="' . $isRequired . '"></p>';
                                                                                        }	
                                                                                        elseif ($ta->ps_tipe_pertanyaan == 4) {
                                                                                            $pilja = explode(';', $piljab);
                                                                                            foreach ($pilja as $pj) {
                                                                                                if ($pj != '') {
                                                                                                    $pillo = explode(':', $pj);
                            
                                                                                                    if ($pillo[1] != '') {
                                                                                                        //$lnk='<a href="#'.$pillo[1].'">[ '.$pillo[1].' ]</a>';
                            
                                                                                                        //Link Data
                                                                                                        $PgKar = $this->uri->segment(4); //Karakter Halaman
                                                                                                        $dataPgKar = $pillo[1]; //DataLink
                                                                                                        $wordsPGKar = trim($dataPgKar, "0..9");
                                                                                                        if ($PgKar == $wordsPGKar) {
                                                                                                            //echo 'tetap';
                                                                                                            $lnk = '<a href="#' . $pillo[1] . '">[ ' . $pillo[1] . ' ]</a>';
                                                                                                        } else {
                                                                                                            //echo 'beda';
                                                                                                            $lnk = '<a href="#' . $pillo[1] . '"  data-value="' . $pillo[1] . '"  onclick="capture(this);">[ ' . $pillo[1] . ' ]</a>';
                                                                                                        }
                                                                                                        //===================================
                            
                                                                                                    } else {
                                                                                                        $lnk = '';
                                                                                                    }
                                                                                                    $lnk2 = $lnk;
                                                                                                }
                                                                                            }
                                                                                            $isRequired = ($ta->must_answer == 'required') ? 'true' : 'false';
                                                                                            $paklo = '';
                                                                                            $pakwar = '<p class="form-control-static"><textarea class="form-control"  name="' . $ta->ps_id . '" rows="5" data-psid="' . $ta->ps_id . '" data-required="' . $isRequired . '"></textarea>';
                                                                                            // $lnk2 = $lnk;
                                                                                        } 
                                                                                        elseif ($ta->ps_tipe_pertanyaan == 5) {
                                                                                            $pilja = explode(';', $piljab);
                                                                                            // foreach ($pilja as $pj) {
                                                                                            $pj = $pilja[0];
                                                                                            if ($pj != '') {
                                                                                                $pillo = explode(':', $pj);
                                                                                                if ($pillo[1] != '') {
                                                                                                    //Link Data
                                                                                                    $PgKar = $this->uri->segment(4); //Karakter Halaman
                                                                                                    $dataPgKar = $pillo[1]; //DataLink
                                                                                                    $wordsPGKar = trim($dataPgKar, "0..9");
                                                                                                    if ($PgKar == $wordsPGKar) {
                                                                                                        $lnk = '<a href="#' . $pillo[1] . '">[ ' . $pillo[1] . ' ]</a>';
                                                                                                    } else {
                                                                                                        $lnk = '<a href="#' . $pillo[1] . '"  data-value="' . $pillo[1] . '"  onclick="capture(this);">[ ' . $pillo[1] . ' ]</a>';
                                                                                                    }
                                                                                                } else {
                                                                                                    $lnk = '';
                                                                                                }
                                                                                                $lnk2 = $lnk;
                                                                                            }
                                                                                            $range_text = explode(':', $pilja[1])[0];
                                                                                            // }
                                                                                            $paklo = '';
                                                                                            $jenis_likert = explode(':', explode(';', $piljab)[0])[0];
                                                                                            if ($jenis_likert == 'star') {
                                                                                                $pakwar = '
                                                                                                <div class="rating-stars block" id="rating">
                                                                                                    <input type="hidden" class="rating-value" name="' . $ta->ps_id . '" id="rating-stars-value" value=""  data-psid="'.$ta->ps_id.'" data-required="' . $isRequired . '">
                                                                                                    <div class="rating-stars-container">
                                                                                                        <div class="rating-star">
                                                                                                            <i class="fa fa-star"></i>
                                                                                                        </div>
                                                                                                        <div class="rating-star">
                                                                                                            <i class="fa fa-star"></i>
                                                                                                        </div>
                                                                                                        <div class="rating-star">
                                                                                                            <i class="fa fa-star"></i>
                                                                                                        </div>
                                                                                                        <div class="rating-star">
                                                                                                            <i class="fa fa-star"></i>
                                                                                                        </div>
                                                                                                        <div class="rating-star">
                                                                                                            <i class="fa fa-star"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    ' . $range_text . '
                                                                                                </div>
                                                                                                ';
                                                                                            } elseif ($jenis_likert == 'love') {
                                                                                                $pakwar = '
                                                                                                <div class="rating-stars block" id="rating">
                                                                                                    <input type="hidden" class="rating-value" name="' . $ta->ps_id . '" id="another-rating-stars-value" value=""  data-psid="'.$ta->ps_id.'" data-required="' . $isRequired . '">
                                                                                                    <div class="rating-stars-container">
                                                                                                        <div class="rating-star">
                                                                                                            <i class="fa fa-heart"></i>
                                                                                                        </div>
                                                                                                        <div class="rating-star">
                                                                                                            <i class="fa fa-heart"></i>
                                                                                                        </div>
                                                                                                        <div class="rating-star">
                                                                                                            <i class="fa fa-heart"></i>
                                                                                                        </div>
                                                                                                        <div class="rating-star">
                                                                                                            <i class="fa fa-heart"></i>
                                                                                                        </div>
                                                                                                        <div class="rating-star">
                                                                                                            <i class="fa fa-heart"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    ' . $range_text . '
                                                                                                </div>
                                                                                                ';
                                                                                            } elseif ($jenis_likert == 'bar') {
                                                                                                $se = [];
                                                                                                for ($i = 1; $i <= 10; $i++) {
                                                                                                    array_push($se, ' ');
                                                                                                }
                                                                                                $pakwar = '
                                                                                                <div class="box-example-1to10 mb-5">
                                                                                                    <div class="body">
                                                                                                        <select id="example-1to10" name="' . $ta->ps_id . '" autocomplete="off">
                                                                                                            <option value="1"' . $se[0] . '>1</option>
                                                                                                            <option value="2"' . $se[1] . '>2</option>
                                                                                                            <option value="3"' . $se[2] . '>3</option>
                                                                                                            <option value="4"' . $se[3] . '>4</option>
                                                                                                            <option value="5"' . $se[4] . '>5</option>
                                                                                                            <option value="6"' . $se[5] . '>6</option>
                                                                                                            <option value="7"' . $se[6] . '>7</option>
                                                                                                            <option value="8"' . $se[7] . '>8</option>
                                                                                                            <option value="9"' . $se[8] . '>9</option>
                                                                                                            <option value="10"' . $se[9] . '>10</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>';
                                                                                            } elseif ($jenis_likert == 'opini') {
                                                                                                $se = [];
                                                                                                array_push($se, ' ');
                                                                                                $pakwar = '
                                                                                                <div class="border-0 p-0 box-example-movie mb-5">
                                                                                            <div class="box-body">
                                                                                                <select id="example-movie" name="' . $ta->ps_id . '" autocomplete="off" data-psid="'.$ta->ps_id.'" data-required="' . $isRequired . '">
                                                                                                    <option value="buruk"' . $se[0] . '>Buruk</option>
                                                                                                    <option value="biasa"' . $se[1] . '>Biasa Saja</option>
                                                                                                    <option value="bagus"' . $se[2] . '>Bagus</option>
                                                                                                    <option value="luar biasa"' . $se[3] . '>Luar Biasa</option>
                                                                                                </select>
                                                                                                                                </div>
                                                                                                                            </div>';
                                                                                                                        } else {
                                                                                                                            $se = [];
                                                                                                                            for ($i = 1; $i <= 5; $i++) {
                                                                                                                                array_push($se, ' ');
                                                                                                                            }
                                                                                                                            $pakwar = '
                                                                                            <div class="border-0 p-0 box-example-square mb-5">
                                                                                                <div class="box-body">
                                                                                                    <select id="example-square" name="' . $ta->ps_id . '" autocomplete="off" data-psid="'.$ta->ps_id.'" data-required="' . $isRequired . '">
                                                                                                        <option value="1"' . $se[0] . '>1</option>
                                                                                                        <option value="2"' . $se[1] . '>2</option>
                                                                                                        <option value="3"' . $se[2] . '>3</option>
                                                                                                        <option value="4"' . $se[3] . '>4</option>
                                                                                                        <option value="5"' . $se[4] . '>5</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>';
                                                                                            }
                                                                                            // $lnk2 = $lnk;
                                                                                        }
                                                                                        else {
                                                                                        }
                            
                                                                                        $label = '';
                                                                                        if ($ta->must_answer == 'required') {
                                                                                            $label .= ' <span class="text-danger">*</span>';
                                                                                        }
                            
                                                                                        echo '<div class="form-group row" id="pertanyaan_' . $ta->ps_id . '" data-ps-kode="' . $ta->ps_kode . '"> 
                                                                                        <label class="col-sm-2 form-control-static" id="' . $ta->ps_kode . '">' . $ta->ps_kode . ' ' . $lnk2 . '</label>
                                                                                        <div class="col-sm-9">
                                                                                            <b>'
                                                                                                        . str_replace(['<p>', '</p>'], ['<span>', '</span>'], $ta->ps_pertanyaan) . $label .
                                                                                                        '</b>
                                                                                            ' . $pakwar . '
                                                                                            
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            <!--<a href="#' . $paklo . '">' . $paklo . '</a>-->
                                                                                        </div>												
                                                                                    </div>';                                                                           
                                                                                    }?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>    
                                                        </div>
                                                        <div class="action-bar">
                                                            <button type="button" class="btn btn-primary" onclick="disableButton(this)">Simpan & Lanjutkan</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="edit<?=$lu->id_seksi;?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
									<h6 class="modal-title"> Edit Seksi Survey</h6>
							        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button> 
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?=base_url();?>admin/edit_survey_seksi/<?=$lu->id_seksi;?>" method="POST">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="KodeSurvey">Kode Seksi Survey :</label>
                                                    <input type="text" name="KodeSurvey" class="form-control" placeholder="Masukkan Kode Survey" value="<?=$lu->ss_kode;?>" required>
                                                </div>  
                                                <div class="form-group">
                                                    <label for="NamaSurvey">Judul Seksi Survey :</label>
                                                    <input type="text" name="nmSurvey" class="form-control" placeholder="Masukkan Nama Survey" value="<?=$lu->ss_judul;?>" required>
                                                </div>  
                                                <div class="form-group">
                                                    <label for="NamaSurvey">Keterangan Seksi Survey : (opsional)</label>
                                                    <input type="text" name="ketSurvey" class="form-control" placeholder="Masukkan Nama Survey" value="<?=$lu->ss_keterangan;?>">
                                                </div>   
                                            </div>
                                            <div class="box-footer">
											<input type="hidden" name="idSurvey" value="<?=$lu->ss_id_survey?>">
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="duplikat<?=$lu->id_seksi;?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
									<h6 class="modal-title"> Duplikat Seksi Survey</h6>
							        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button> 
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?=base_url();?>admin/duplikat_survey_seksi/<?=$lu->id_seksi;?>" method="POST">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="KodeSurvey">Kode Seksi Survey :</label>
                                                    <input type="text" name="KodeSurvey" class="form-control" placeholder="Masukkan Kode Survey" value="<?=$lu->ss_kode;?>" required>
                                                </div>  
                                                <div class="form-group">
                                                    <label for="NamaSurvey">Judul Seksi Survey :</label>
                                                    <input type="text" name="nmSurvey" class="form-control" placeholder="Masukkan Nama Survey" value="<?=$lu->ss_judul;?>" required>
                                                </div>  
                                                <div class="form-group">
                                                    <label for="NamaSurvey">Keterangan Seksi Survey : (opsional)</label>
                                                    <input type="text" name="ketSurvey" class="form-control" placeholder="Masukkan Nama Survey" value="<?=$lu->ss_keterangan;?>">
                                                </div>  

                                            </div>

                                            <div class="box-footer">
                                            <input type="hidden" name="idSurvey" value="<?=$infosurvey[0]->id_survey?>">
											<input type="hidden" name="idSurvey" value="<?=$lu->ss_id_survey?>">
                                                <button type="submit" class="btn btn-success">Duplikat</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="hapusSurvey<?=$lu->id_seksi;?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
									<h6 class="modal-title"> Hapus Seksi Survey</h6>
							        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                         
                                    </div>
                                    <div class="modal-body">
                                        <div class="box-body">
                                            <h4>Anda yakin akan menghapus Seksi Survey <?=$lu->ss_judul;?>?</h4>
                                            
                                        </div>
                                        <div class="box-footer">
                                            <a href="<?= base_url('admin/hapus_survey_seksi/'.$lu->id_seksi);?>" class="btn btn-danger">Ya</a> &nbsp;
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
<script>
    function capture(element) {
		const value = $(element).attr('data-value');
		const isNotMatch = $(element).attr('data-isnotmatch') == '1';

		if (value) {
			if (isNotMatch) {
				const confirmRedirect = confirm("Apakah Anda yakin memilih pilihan ini?");
				if (!confirmRedirect) {
					element.checked = false;
					return;
				}
			}

			$('#target_link').val(value);
			document.getElementById("surveying").submit();
		}
	}
	
	function handleRadioEvent(radio) {
		console.log("Radio clicked:", radio.value);

		if (radio.dataset.value !== '') {
			console.log("Captured value:", radio.dataset.value);
			if (typeof capture === "function") {
				capture(radio);
			}
		}

		const psId = radio.name;
		const relatedExtras = document.querySelectorAll(`.extra-input[data-psid="${psId}"]`);
		relatedExtras.forEach(el => {
			el.style.display = 'none';
			const input = el.querySelector('input');
			if (input) input.value = '';
		});

		if (radio.dataset.type === 'essai') {
			const targetId = radio.dataset.target;
			const targetEl = document.getElementById(targetId);
			if (targetEl) {
				targetEl.style.display = 'block';
			}
		}
	}
    
	function handleCheckboxEvent(checkbox) {
		if (checkbox.dataset.value !== '') {
			if (typeof capture === 'function') {
				capture(checkbox);
			}
		}

		if (checkbox.dataset.type === 'essai') {
			const targetId = checkbox.dataset.target;
			const inputEl = document.getElementById(targetId);

			if (inputEl) {
				if (checkbox.checked) {
					inputEl.style.display = 'block';
				} else {
					inputEl.style.display = 'none';
					const input = inputEl.querySelector('input');
					if (input) {
						input.value = '';
						checkbox.value = input.dataset.label;
					}
				}
			}
		}
	}

	function updateCheckboxValue(input) {
		const label = input.dataset.label;
		const targetCheckbox = document.getElementById(input.dataset.target);
		if (targetCheckbox) {
			targetCheckbox.value = label + ':' + input.value;
		}
	}

	function syncAllCheckboxEssaiValues() {
		const inputs = document.querySelectorAll('.extra-input input');
		inputs.forEach(input => {
			const label = input.dataset.label;
			const targetCheckbox = document.getElementById(input.dataset.target);
			if (targetCheckbox && targetCheckbox.checked) {
				targetCheckbox.value = label + ':' + input.value;
			}
		});
	}

	window.addEventListener('DOMContentLoaded', () => {
		const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
		checkboxes.forEach(cb => {
			if (cb.dataset.type === 'essai') {
				const targetId = cb.dataset.target;
				const targetEl = document.getElementById(targetId);
				if (targetEl) {
					targetEl.style.display = 'block';
				}
			}
		});
		syncAllCheckboxEssaiValues();
	});

	$(document).on('input', '.extra-input input', function () {
		updateCheckboxValue(this);
	});

	$(document).ready(function () {
		$('a.nav-link').click(function (e) {
			e.preventDefault();
			var href = $(this).attr('href');
			if (href) {
				history.pushState(null, null, href);
				$('#surveying').load(href + ' #surveying > *', function () {
					const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
					checkboxes.forEach(cb => {
						handleCheckboxEvent(cb);
					});
					syncAllCheckboxEssaiValues();
				});
			}
		});

		window.onpopstate = function () {
			location.reload();
		};
	});
    function setDeviceWidth(device, button) {
        const wrapper = button.closest('.modal').querySelector('#device-wrapper');
        if (!wrapper) return; // Safety check if wrapper isn't found

        // Set default width first (equivalent to the else condition)
        wrapper.style.maxWidth = '950px'; // Default to laptop width
        wrapper.classList.remove('device-laptop', 'device-tablet', 'device-phone');
        wrapper.classList.add(`device-${device}`);

        // Override width based on device conditions
        if (device === 'phone') {
            wrapper.style.maxWidth = '370px'; // Typical phone width
        } else if (device === 'tablet') {
            wrapper.style.maxWidth = '768px'; // Typical tablet width
        }
        // No else needed, as default is already set
    }
</script>