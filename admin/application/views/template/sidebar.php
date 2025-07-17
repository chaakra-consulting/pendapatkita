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
              src="<?=base_url();?>images/chaakra.png"
              height="50"
              width="50"/>
              </span>
              <span class="app-brand-text demo menu-text fw-bold">Pendapat Kita</span>
            </a>

            <a href="#" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
              <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item">
              <a href="<?=base_url();?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-checkbox"></i>
                <div data-i18n="Dashboard">Dashboard</div>
              </a>
            </li>

            <!-- Layouts -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-file"></i>
                <div data-i18n="Survey">Survey</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<?=base_url();?>admin/survey" class="menu-link">
                    <div data-i18n="Data Survey">Data Survey</div>
                  </a>
                  <a href="<?=base_url();?>admin/hasilsurvey" class="menu-link">
                    <div data-i18n="Hasil Survey">Hasil Survey</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Layouts -->
            <?php if ($this->session->status == 'admin') { ?>
            <li class="menu-item">
              <a href="<?=base_url();?>admin/koordinator" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Koordinator">Koordinator</div>
              </a>
            </li>
            <?php } ?>

            <!-- Layouts -->
            <?php if ($this->session->status == 'admin') { ?>
            <li class="menu-item">
              <a href="<?=base_url();?>admin/surveyor" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Surveyor">Surveyor</div>
              </a>
            </li>
            <?php } ?>

            <!-- Layouts -->
            <?php if ($this->session->status == 'koordinator') { ?>
            <li class="menu-item">
              <a href="<?=base_url();?>admin/surveyor_to_koor/<?=$this->session->id;?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Daftar Surveyor">Daftar Surveyor</div>
              </a>
            </li>
            <?php } ?>
            
            <li class="menu-item">
            <a href="<?= base_url(); ?>admin/sync_login_sso" class="menu-link">
              <i class="menu-icon tf-icons fa fa-arrows-rotate"></i>
              <div data-i18n="Sync Login SSO">Sync Login SSO</div>
            </a>
          </li>

          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item navbar-search-wrapper mb-0">
                  <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
                    <i class="ti ti-search ti-md me-2"></i>
                    <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                  </a>
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Language -->
                <!--/ Language -->

                <!-- Style Switcher -->
                <li class="nav-item me-2 me-xl-0">
                  <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                    <i class="ti ti-md"></i>
                  </a>
                </li>
                <!--/ Style Switcher -->

                <!-- Quick links  -->
                
                <!-- Quick links -->

                <!-- Notification -->
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                  <a
                    class="nav-link dropdown-toggle hide-arrow"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown"
                    data-bs-auto-close="outside"
                    aria-expanded="false"
                  >
                    <i class="ti ti-bell ti-md"></i>
                    <span class="badge bg-danger rounded-pill badge-notifications">0</span>
                  </a>
                  
                </li>
                <!--/ Notification -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../../assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="pages-account-settings-account.html">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../../assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?= $this->session->nama; ?></span>
                            <small class="text-muted"><?= $this->session->nis; ?></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="<?=base_url();?>admin/setting">
                        <i class="ti ti-lifebuoy me-2 ti-sm"></i>
                        <span class="align-middle">Pengaturan</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="<?=base_url();?>admin/logout">
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