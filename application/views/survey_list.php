  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">List Survey</h4>

              <!-- Hoverable Table rows -->
              <div class="card">
                <!-- <h5 class="card-header">List Survey</h5> -->
                <div class="table-responsive text-wrap">
                  <?php if (count($survey) > 0) { ?>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nama Survey</th>
                        <th>Koordinator</th>
                        <th>Waktu</th>
                        <th>Valid Survey</th>
                        <th>Pending Survey</th>
                        <th>Persentase Survey Selesai</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php
                      $no = 1;
                      foreach ($survey as $ju) {
                        $idusere = $this->session->id;
                        $jum = $this->m_user->hitung_survey_byid($ju->id_survey, $idusere)->row_array();
                        $jumpending = $this->m_user->hitung_survey_byid_pending($ju->id_survey, $idusere)->row_array();
                      ?>
                      <tr>
                        <td><strong><?= $no++; ?>.</strong></td>
                        <td><?= $ju->nama_survey; ?></td>
                        <td><?= $ju->nama; ?></td>
                        <td><?= TglIndo($ju->tanggal); ?> sd <?= TglIndo($ju->tanggal_selesai); ?></td>
                        <td><a href="<?= base_url() ?>user/datasurvey/<?= $ju->id_survey; ?>/<?= $idusere; ?>"><?= $jum['jumsurvey']; ?></a> / <?= $ju->jumlah_survey; ?></td>
                      
                        <?php if ($jum['jumsurvey'] < $ju->jumlah_survey) { ?>
                        
                        <td style="text-align:center;">
                          <?php 
                          if ($jumpending['jumsurvey'] > 0) 
                          { ?>
                            <a href="<?= base_url() ?>user/datasurveypending/<?= $ju->id_survey; ?>/<?= $idusere; ?>"><?= $jumpending['jumsurvey']; ?></a> 
                          <?php } 
                          
                          else { echo '-'; } ?>
                          <?php } else { ; ?>

                        <td style="text-align:center;"><?php if ($jumpending['jumsurvey'] > 0) { ?><a><?= $jumpending['jumsurvey']; ?></a> 
                          <?php } 
                          
                          else {echo '-'; } ?>
                          <?php } ?></td>

                        <td><?= ($jum['jumsurvey'] / $ju->jumlah_survey) * 100; ?>%</td>
                          <?php if ($jum['jumsurvey'] < $ju->jumlah_survey) { ?>
												
                        <td>
													<a href="<?= base_url() ?>survey/<?= $ju->id_survey; ?>/<?= date("dmyHis"); ?>/<?= 'data'; ?>"><button class="btn btn-info" style="padding:2px;font-size:0.8em"><i class="fa fa-paper-plane"></i> Kerjakan Survey</button></a>
												</td>
											<?php } else { ?>
												<td>

                        <button class="btn btn-info" style="padding:2px;font-size:0.8em" disabled><i class="fa fa-paper-plane"></i> Kerjakan Survey</button></td>
						            <?php } ?>

                      </tr>

                      <!-- Modal -->
                      <div class="modal fade" id="modalUjian<?= $ju->id_survey; ?>">
										    <div class="modal-dialog">
											    <div class="modal-content">
                            <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            
                            <h4 class="modal-title"><?= $ju->nama_survey; ?></h4>
                            </div>

                            <div class="modal-body">
                              <h4>Anda akan melaksanakan survey <?= $ju->nama_survey; ?></h4>
                            </div>
												  <div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
													<a href="<?= base_url($ju->id_survey); ?>" class="btn btn-success">Mulai Mengerjakan</a>
												</div>
											</div>
										</div>
									</div>

                  <?php } ?>
                    </tbody>
                  </table>
                </div>
                <?php } ?>
              </div>
              <!--/ Hoverable Table rows -->
              
            </div>
            <!-- / Content -->