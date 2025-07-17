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
    <script src="<?=base_url();?>./../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?=base_url();?>./../assets/vendor/libs/popper/popper.js"></script>
    <script src="<?=base_url();?>./../assets/vendor/js/bootstrap.js"></script>
    <script src="<?=base_url();?>./../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?=base_url();?>./../assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="<?=base_url();?>./../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="<?=base_url();?>./../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="<?=base_url();?>./../assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="<?=base_url();?>./../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?=base_url();?>./../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="<?=base_url();?>./../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?=base_url();?>./../assets/js/dashboards-crm.js"></script>

    <!-- custom js -->
    <script src="<?=base_url();?>./../assets/theme/assets/js/custom.js"></script>

    <!--Internal quill js -->
    <script src="<?=base_url();?>./../assets/theme/assets/plugins/quill/quill.min.js"></script>
    
    <!-- Internal Form-editor js -->
    <script src="<?=base_url();?>./../assets/theme/assets/js/form-editor.js"></script>

    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
      var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
          toolbar: [
            [{
              header: [1, 2, 3, 4, 5, 6, false]
            }],
            [{
              font: []
            }],
            ["bold", "italic"],
            ["link", "blockquote", "code-block", "image"],
            [{
              list: "ordered"
            }, {
              list: "bullet"
            }],
            [{
              script: "sub"
            }, {
              script: "super"
            }],
            [{
              color: []
            }, {
              background: []
            }],
          ]
        },
      });
      quill.on('text-change', function(delta, oldDelta, source) {
        document.querySelector("input[name='Pertanyaan']").value = quill.root.innerHTML;
      });
</script>

  </body>
</html>