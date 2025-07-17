<?php
$dtJS2 = $this->m_user->data_jawaban_survey($kode_survey)->result_array();
//kode_survey
$hitDt = count($dtJS2);

$pewawancara = $this->session->nama;
$pemeriksa = '';
$koderesponden = '';
$namaresponden = '';

$dtJS = $this->m_user->data_jawaban_survey($kode_survey)->row_array();
if ($hitDt > 0) {

	$pewawancara = $dtJS['js_pewawancara'];
	$pemeriksa = $dtJS['js_pemeriksa'];
	$koderesponden = $dtJS['js_kode_responden'];
	$namaresponden = $dtJS['js_nama_responden'];
}
?>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                 <img
              src="<?=base_url();?>assets2/images/chaakra.png"
              height="50"
              width="50"/>
              </span>
              <span class="app-brand-text demo menu-text fw-bold">Pendapat Kita</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
              <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item">
              <nav class="nav nav-pills flex-column">
              <a class="nav-link <?php if ($kdseksi == 'data' || $kdseksi == FALSE) {
												echo 'active';
											} ?>" href="<?= base_url(); ?>survey/<?= $id_survey; ?>/<?= $kode_survey; ?>/data">MULAI SURVEY
					    </a>
              <?php
              $no = 0;
              $lds = '';
              $a = array(1 => 'one', 2 => 'two', 3 => 'three');  
              $aplink = array();
              $aplink[] = 'data';
              foreach ($list_seksi as $ds) {
                $no++;
                $aplink[] = $ds->ss_kode;
                if ($kdseksi == $ds->ss_kode) {
                  $lds = 'active';
                } else {
                  $lds = '';
                }

                if ($hitDt > 0) {

              ?>
                  <a class="nav-link <?= $lds; ?>" href="<?= base_url(); ?>survey/<?= $id_survey; ?>/<?= $kode_survey; ?>/<?= $ds->ss_kode ?>">SEKSI <?= $ds->ss_kode ?> : <?= $ds->ss_judul ?></a>
                <?php
                }
              }
              $aplink[] = 'validasi';
              $aplink[] = 'upload';
              //CekForm Berikutnya
              $palink = array_keys($aplink, $kdseksi, false);
              $aplinkafter = $palink[0] + 1;

              if ($hitDt > 0) {

                ?>
                <a class="nav-link <?php if ($kdseksi == 'validasi') {
                            echo 'active';
                          } ?>" href="<?= base_url(); ?>survey/<?= $id_survey; ?>/<?= $kode_survey; ?>/validasi">VALIDASI</a>

              <?php } ?>
            </nav>
            </li>
          </ul>  
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item navbar-search-wrapper mb-0">
                  <!-- <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
                    <i class="ti ti-search ti-md me-2"></i>
                    <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                  </a> -->
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Style Switcher -->
                <li class="nav-item me-2 me-xl-0">
                  <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                    <i class="ti ti-md"></i>
                  </a>
                </li>
                <!--/ Style Switcher -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="<?=base_url();?>assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="pages-account-settings-account.html">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="<?=base_url();?>assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">John Doe</span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="pages-profile-user.html">
                        <i class="ti ti-user-check me-2 ti-sm"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="pages-account-settings-account.html">
                        <i class="ti ti-settings me-2 ti-sm"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="<?=base_url('logout');?>" target="">
                        <i class="ti ti-logout me-2 ti-sm"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>

            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper d-none">
              <input
                type="text"
                class="form-control search-input container-xxl border-0"
                placeholder="Search..."
                aria-label="Search..."
              />
              <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->