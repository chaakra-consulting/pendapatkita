            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column"
                >
                  <div>
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , Copyright &copy; <a href="https://pixinvent.com" target="_blank" class="fw-semibold">Pendapat Kita</a>. All rights reserved.
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <script>
          $(document).ready(function() {
               setInterval(function() {
                    var date = new Date();
                    var h = date.getHours(),
                         m = date.getMinutes(),
                         s = date.getSeconds();
                    h = ("0" + h).slice(-2);
                    m = ("0" + m).slice(-2);
                    s = ("0" + s).slice(-2);

                    var time = h + ":" + m + ":" + s;
                    $('.live-clock').html(time);
               }, 1000);
          })
     </script>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?=base_url();?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?=base_url();?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?=base_url();?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?=base_url();?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?=base_url();?>assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="<?=base_url();?>assets/vendor/libs/hammer/hammer.js"></script>
    <script src="<?=base_url();?>assets/vendor/libs/i18n/i18n.js"></script>
    <script src="<?=base_url();?>assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="<?=base_url();?>assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?=base_url();?>assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="<?=base_url();?>assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?=base_url();?>assets/js/dashboards-crm.js"></script>
  </body>
</html>