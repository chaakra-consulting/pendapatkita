          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
              
                <!-- View sales -->

                <div class="col-xl-4 mb-4 col-lg-5 col-12">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-7">
                        <div class="card-body text-wrap">
                          <h2 class="card-title mb-0"><?= $this->session->nama; ?></h2>
                          <p class="mb-2"><?= $this->session->nis; ?></p>
                          <br>
                          <br>
                          <a href="#" class="btn btn-primary waves-effect waves-light">Surveyor</a>
                          <br>
                          <br>
                          <h5 class="text-primary mb-1">Chaakra-Consulting</h5>
                        </div>
                      </div>
                      <div class="col-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="<?=base_url();?>assets/img/illustrations/card-advance-sale.png"
                            height="140"
                            alt="view sales"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- View sales -->

                <!-- Statistics -->
                <div class="col-lg-8 mb-4">
                  <div class="card h-100">
                    <div class="card-header pb-0 d-flex justify-content-between mb-lg-n4">
                      <div class="card-title mb-0">
                        <h2 class="mb-0">Statistik Survey</h2>
                        <medium class="text-muted"><?= date('d M y'); ?></medium>
                        <br>
                        <br>
                        <br>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12 col-md-8">
                          <div id="weeklyEarningReports"></div>
                        </div>
                      </div>
                      <div class="no-border rounded p-3 mt-2">
                        <div class="row gap-4 gap-sm-0">
                          <div class="col-12 col-sm-4">
                            <div class="d-flex gap-2 align-items-center">
                              <div class="badge rounded bg-label-primary p-1">
                              <i class="fa-solid fa-archway fa-2xl"></i>
                              </div>
                              <h3 class="mb-0">Keseluruhan</h3>
                            </div>
                            <h4 class="my-2 pt-1">2</h4>
                          </div>
                          <div class="col-12 col-sm-4">
                            <div class="d-flex gap-2 align-items-center">
                              <div class="badge rounded bg-label-info p-1">
                                <i class="fa-solid fa-eye fa-2xl"></i>
                            </div>
                              <h3 class="mb-0">Published</h3>
                            </div>
                            <h4 class="my-2 pt-1">3</h4>
                          </div>
                          <div class="col-12 col-sm-4">
                            <div class="d-flex gap-2 align-items-center">
                              <div class="badge rounded bg-label-danger p-1">
                              <i class="fa-sharp fa-solid fa-eye-slash fa-2xl"></i>
                              </div>
                              <h3 class="mb-0">Unpublished</h3>
                            </div>
                            <h4 class="my-2 pt-1">4</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Statistics -->

                

            


              </div>
            </div>
            <!-- / Content -->

            