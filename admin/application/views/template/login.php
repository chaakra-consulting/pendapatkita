<!DOCTYPE html>

<html lang="en">
	
  <head>
  	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="Description" content="Pendapat Kita Apps">
	<meta name="Author" content="Syamsiar">
	<meta name="Keywords" content="pendapat,kita,apps,chaakra,consulting" />

    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Pendapat Kita</title>

    <meta name="description" content="" />

    <!-- Favicon -->
     <link rel="icon" type="image/x-icon" href="<?=base_url();?>images/chaakra.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="<?=base_url();?>./../assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="<?=base_url();?>./../assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="<?=base_url();?>./../assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?=base_url();?>./../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?=base_url();?>./../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?=base_url();?>./../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?=base_url();?>./../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?=base_url();?>./../assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="<?=base_url();?>./../assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="<?=base_url();?>./../assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?=base_url();?>./../assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="<?=base_url();?>./../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="<?=base_url();?>./../assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <!-- <script src="<?=base_url();?>./../assets/js/config.js"></script> -->
  </head>

  <body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover authentication-bg">
      <div class="authentication-inner row">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 p-0">
          <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
            <img
              src="<?=base_url();?>./../assets/img/illustrations/auth-login-illustration-light.png"
              alt="auth-login-cover"
              class="img-fluid my-5 auth-illustration"
              data-app-light-img="illustrations/auth-login-illustration-light.png"
              data-app-dark-img="illustrations/auth-login-illustration-dark.png"
            />

            <img
              src="<?=base_url();?>./../assets/img/illustrations/bg-shape-image-light.png"
              alt="auth-login-cover"
              class="platform-bg"
              data-app-light-img="illustrations/bg-shape-image-light.png"
              data-app-dark-img="illustrations/bg-shape-image-dark.png"
            />
          </div>
        </div>
        <!-- /Left Text -->

        <!-- Login -->
        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
          <div class="w-px-400 mx-auto">
            <!-- Logo -->
            <div class="app-brand mb-4">
              <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <img
              src="<?=base_url();?>images/chaakra2.png"
              height="90"
              width="190
              "/>
                </span>
              </a>
            </div>
            <!-- /Logo -->
            <h3 class="mb-1 fw-bold">Welcome to Pendapat Kita</h3>

            <form class="mb-3" action="<?=base_url('Login/actlogin');?>" method="POST">
              <div class="mb-3">
                <label for="email" class="form-label">Username</label>
                <input
                  type="text"
                  class="form-control"
                  id="username"
                  name="username"
                  placeholder="Enter your username"
                  autofocus
                />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                </div>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                  />
                  <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>

              </div>
			  
			  <div>	
			  	<label class="form-label" for="password">Login Sebagai</label>													
				<select name="akses" id="" class="form-control" required>
				<option value="">Login sebagai . . .</option>
				<option value="admin">Admin</option>
				<option value="koordinator">Kordinator</option>
				</select>
				</div>

              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
              </div>
              <button class="btn btn-primary d-grid w-100">Sign in</button>
            </form>
            <button type="button" class="btn btn-outline-primary d-grid w-100 mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Login SSO Chaakra
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Login SSO Chaakra</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= base_url('Login/sso_login'); ?>" method="post" id="formLoginSso">
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="modal-password" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" id="btnLoginSso">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- /Login -->
      </div>
    </div>

    <!-- / Content -->

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
    <script src="<?=base_url();?>./../assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="<?=base_url();?>./../assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="<?=base_url();?>./../assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>

    <!-- Main JS -->
    <script src="<?=base_url();?>./../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?=base_url();?>./../assets/js/pages-auth.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
          $("#formLoginSso").submit(function(e) {
            e.preventDefault();
            $.ajax({
              type: "POST",
              url: $(this).attr('action'),
              data: $(this).serialize(),
              dataType: "json",
              beforeSend: function() {
                $("#btnLoginSso").html('<i class="fa fa-spinner fa-spin"></i>');
              },
              success: function(data) {
                if (data.success == true) {
                  Swal.fire({
                    title: "Success!",
                    text: "Login Berhasil",
                    icon: "success"
                  });
                  window.location.href = data.redirect;
                } else {
                  Swal.fire({
                    title: "Error!",
                    text: data.message || "Akun belum di sinkronisasi.",
                    icon: "error"
                  });
                }
                $("#btnLoginSso").html('Login');
              },
              error: function(xhr, status, error) {
                Swal.fire({
                  title: "Error!",
                  text: "Terjadi kesalahan pada server.",
                  icon: "error"
                });
                $("#btnLoginSso").html('Login');
              }
            });
          })
        })
    </script>
  </body>
</html>
