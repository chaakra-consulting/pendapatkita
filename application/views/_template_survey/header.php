<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?=base_url();?>assets/"
  data-template="vertical-menu-template-starter"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Page 1 - Starter Kit | Vuexy - Bootstrap Admin Template</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?=base_url();?>assets2/images/chaakra.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/css/demo.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/css/survey_modern.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Page CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.js"></script>

    <style>

    .slider-wrapper {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
      margin: 0;
      padding: 0;
      gap: 0;
    }

    .slider-label {
      width: 20%;
      font-size: 13px;
      line-height: 1.4;
      color: #333;
    }

    .slider-label-left {
      text-align: left;
      margin-right: 15px;
    }

    .slider-label-right {
      text-align: right;
      margin-left: 15px;
      /* margin-right: 0; */
    }

    .slider-box {
      width: 50%;
      text-align: center;
      margin: 0;
      padding: 0;
    }

    .slider-bar {
      margin: 1px 0;
    }
		.slider-label strong {
			/* display: block; */
			font-size: 15px;
			color: #007bff;
		}

		#slider-combined-options {
			margin: 20px 0;
		}

    @media (max-width: 768px) {
      .slider-wrapper {
        /* flex-wrap: wrap;
        gap: 4px; */
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: space-between;
        gap: 4px;
        margin-bottom: 1rem;
      }

      .slider-label {
        width: 42%;
        font-size: 12px;
      }

      .slider-box {
        width: 100%;
        margin-bottom: 15px;
        order: 3; /* biar slider di baris bawah, penuh */
      }
    }

		.noUi-tooltip {
			background: #007bff;
			color: #fff;
			border-radius: 5px;
			padding: 3px 8px;
			font-size: 13px;
		}
    /* Semua angka pips diperbesar */
    .noUi-value {
        font-size: 16px !important;
        font-weight: 600;
        color: #333;
    }

    /* Opsi tambahan: kalau kamu ingin angka 9 tetap sedikit lebih kecil */
    /* .noUi-value:contains("9") {
        font-size: 14px !important;
        opacity: 0.8;
    } */

    /* Atur jarak antar pips biar rapi */
    .noUi-pips-horizontal {
        padding-top: 10px;
    }

	</style>
    <!-- Helpers -->
    <script src="<?=base_url();?>assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="<?=base_url();?>assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?=base_url();?>assets/js/config.js"></script>
  </head>