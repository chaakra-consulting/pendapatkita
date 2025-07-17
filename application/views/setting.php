          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">

					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="my-auto">
							<div class="d-flex">
								<h4 class="content-title mb-3 my-auto">Pengaturan</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0"></span>
							</div>
						</div> 
					</div>
					<!-- breadcrumb -->

					<!-- row -->
					<div class="row row-sm"> 	
						<div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
							<div class="card  box-shadow-0 ">
								<div class="card-header">
									<h4 class="card-title mb-1">Ganti Password</h4>
									<p class="mb-2"></p>
								</div>
								<div class="card-body pt-0">
									
						<?php if ($ar['password'] == $this->session->nis): ?>
						<h4 class="text-center text-red">*Anda belum mengubah password !</h4>
						<?php endif ?>
						<?php if ($this->session->flashdata('repass')): ?>
							<script>
								//Swal.fire('Ganti Password', '<?=$this->session->flashdata("repass");?>', 'info');
								swal('Ganti Password','<?=$this->session->flashdata("repass");?>');
								//alert('');
							</script>
						<?php endif ?>
						<form action="<?=base_url('user/gantipass');?>" method="POST">
							<div class="form-group">
								<label for="PasswordLama">Password Lama :</label>
								<input class="form-control" type="password" name="passLama" placeholder="Masukkan Password Lama">
							</div>
							<div class="form-group">
								<label for="PasswordBaru">Password Baru :</label>
								<input type="password" name="passBaru" class="form-control" placeholder="Masukkan Password Baru">
							</div>
							<div class="form-group">
								<label for="KonfirmasiPassword">Konfirmasi Password :</label>
								<input type="password" name="konfirPass" class="form-control" placeholder="Masukkan Kembali Password">
							</div>
							<br>
							<button type="submit" class="btn btn-success">Ubah Password</button>
						</form>
								</div>
							</div>
						</div>
						
						<div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
							<div class="card  box-shadow-0 ">
								<div class="card-header">
									<h4 class="card-title mb-1">Ganti Pertanyaan</h4>
									<p class="mb-2"></p>
								</div>
								<div class="card-body pt-0">
									
						<?php if (empty($ar['pertanyaan']) && empty($ar['jawaban'])): ?>
						<h4 class="text-center text-red">*Anda belum membuat pertanyaan !</h4>
						<?php endif ?>
						<?php if ($this->session->flashdata('reper')): ?>
							<script>
								Swal.fire('Ganti Pertanyaan', '<?=$this->session->flashdata("reper");?>', 'info');
							</script>
						<?php endif ?>
						<form action="<?=base_url('user/gantiprtnyan');?>" method="POST">
							<div class="form-group">
								<label for="PasswordLama">Pertanyaan :</label>
								<input type="text" name="pertanyaan" class="form-control" placeholder="Masukkan Pertanyaan" value="<?=$ar['pertanyaan'];?>">
							</div>
							<div class="form-group">
								<label for="PasswordBaru">Jawaban :</label>
								<input type="text" name="jawaban" class="form-control" placeholder="Masukkan Jawaban">
							</div>
							<div class="form-group">
								<label for="KonfirmasiPassword">Konfirmasi Jawaban :</label>
								<input type="text" name="konfirJawaban" class="form-control" placeholder="Masukkan Kembali Jawaban">
							</div>
							<br>
							<button type="submit" class="btn btn-success">Ubah Pertanyaan</button>
						</form><br><br>
								<p>Pertanyaan dan jawaban yang telah dibuat digunakan untuk mereset password login.</p>	
								</div>
							</div>
						</div>
					</div>
					<!-- row --> 
				</div>
				</div>
				 