<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div id="overlayer"></div>

  <div class="loader">

    <div class="spinner-border text-primary" role="status">

      <span class="sr-only">Loading...</span>

    </div>

  </div>



  <div class="site-wrap" id="home-section">



    <div class="site-mobile-menu site-navbar-target">

      <div class="site-mobile-menu-header">

        <div class="site-mobile-menu-close mt-3">

          <span class="icon-close2 js-menu-toggle"></span>

        </div>

      </div>

      <div class="site-mobile-menu-body"></div>

    </div>





    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">



      <div class="container">

        <div class="row align-items-center">



          <div class="col-6 col-md-6 col-xl-4 d-block">

            <h1 class="mb-0 site-logo"><img src="<?php echo base_url('assets2/images/logobaru.png') ?>" alt=""></h1>

            <!-- <h1 class="mb-0 site-logo"><a href="index.html" class="text-black h2 mb-0">imagine<span class="text-primary">.</span> </a></h1> -->

          </div>



          <div class="col-12 col-md-6 col-xl-8 main-menu">

            <nav class="site-navigation position-relative text-right" role="navigation">

              <!-- <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block"> -->

              <ul class="nav justify-content-end site-menu main-menu">

                <li style="margin-left: -1000px;"><a href="#home-section" class="nav-link">Beranda</a></li>

                <li><a href="#flow-section" class="nav-link">Alur Survey</a></li>

                <li><a href="#survey-section" class="nav-link">Survey</a></li>

                <!-- <li><a href="<?php echo base_url('home/survey') ?>" class="nav-link">SURVEY</a></li> -->

                <li><a href="<?php echo base_url('login') ?>" class="nav-link">Masuk</a></li>


              </ul>

            </nav>

          </div>





          <div class="col-6 col-md-9 d-inline-block d-lg-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>

        </div>

      </div>

    </header>

    <br>

    <br>

    <br>

    <br>
    <div class="site-blocks-cover" style="overflow: hidden;">

      <div class="container">

        <br>

        <div id="notifikasi">

          <?php if ($this->session->flashdata('msg_home')) : ?>

            <div class="alert alert-primary">

              <?php echo $this->session->flashdata('msg_home');

              $this->session->set_flashdata('msg_home');  ?>

            </div>

          <?php endif; ?>

        </div>

        <div class="row align-items-center justify-content-center">

          <div class="col-md-12" style="position: relative;" data-aos="fade-up" data-aos-delay="200">

            <img src="<?php echo base_url('assets2/images/survey4.png') ?>" alt="Image" class="img-fluid img-absolute">

            <div class="row mb-4" data-aos="fade-up" data-aos-delay="200">

              <div class="col-lg-6 mr-auto">

                <h1>PENDAPAT KITA</h1>

                <p class="mb-5">Aplikasi Survey Online Chaakra Consulting.</p>

                <div>

                  <!--<a href="<?php echo base_url('login') ?>" class="btn btn-primary mr-2 mb-2">Masuk</a>-->

                  <!-- <a href="<?php echo base_url('Daftar') ?>" class="btn btn-primary mr-2 mb-2">Daftar Sekarang</a> -->

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>
</div>

    <div class="site-section" id="flow-section">



<div class="container">



  <div class="row justify-content-center text-center" data-aos="fade-up">



    <div class="col-7 text-center mb-4">



      <h2 class="section-title">Alur Survey</h2>



    </div>



  </div>



  <div class="row justify-content-center">




    <div class="col-md-6 col-lg-3 mb-3 mb-lg-3" data-aos="fade-up" data-aos-delay="100">



      <div class="text-center">



        <div class="card-img-block">



          <img class="card-img-top" src="<?php echo base_url('assets2/images/submit_1.png') ?>" style="width:50%;" alt="Card image cap">



        </div><br>



        <h3>1.</h3>



        <p>Masukkan ID Survey</p>



      </div>



    </div>
    <div class="col-md-6 col-lg-3 mb-3 mb-lg-3" data-aos="fade-up" data-aos-delay="200">



            <div class="text-center">



              <div class="card-img-block">



                <img class="card-img-top" src="<?php echo base_url('assets2/images/apply.png') ?>" style="width:50%;" alt="Card image cap">



              </div><br>



              <h3>2.</h3>



              <p>Cek Survey</p>



            </div>



          </div>



    <div class="col-md-6 col-lg-3 mb-3 mb-lg-3" data-aos="fade-up" data-aos-delay="300">



      <div class="text-center">



        <div class="card-img-block">



          <img class="card-img-top" src="<?php echo base_url('assets2/images/submit_2.png') ?>" style="width:50%;" alt="Card image cap">



        </div><br>



        <h3>3.</h3>



        <p>Kerjakan survey</p>



      </div>



    </div>



    


    <!-- <div class="col-md-6 col-lg-3 mb-3 mb-lg-3" data-aos="fade-up" data-aos-delay="200">



      <div class="text-center">



        <div class="card-img-block">



          <img class="card-img-top" src="images/login.png" style="width:50%;" alt="Card image cap">



        </div><br>



        <h3>1.</h3>



        <p>Pendaftaran baru, pilih menu registrasi di pojok kanan atas.</p>



      </div>



    </div> -->



  </div>



</div>



</div>

<div class="site-section" id="survey-section">

<div class="container">

  <div class="row justify-content-center text-center" data-aos="fade-up">

    <div class="col-7 text-center">

      <h2 class="section-title">SURVEY</h2>

    </div>

  </div>

  <form id="search" class="mb-3" action="" method="GET">
  <form action="" method="get" style="flex-direction: row; align-items:center">
      <div class="form-group" >
        <label for="tokeninput"><h3>Masukkan ID</h3></label>
        <input type="search" class="form-control" aria-describedby="text" name="keyword" required maxlength="6">
      </div>
      <div class="form-group form-check">
      </div>
      <button type="submit" class="btn btn-primary">Cek Survey</button>
    </form>

    <!-- <form action="" method="get" class="mb-3">
			<div>
				<input type="search" name="keyword" style="width: 360px;" placeholder="Keyword.." value="<?= html_escape($keyword) ?>" required maxlength="32" />
			</div>

			<div>
				<input type="submit" class="button button-primary" value="Cari">
			</div>
		</form> -->

          <!--- END COL -->

        </div>

        <!--- END ROW -->

      </div>

    </div>







  </div>
