<div class="container">
	<div class="main-header-left ">
		<a class="animated-arrow hor-toggle horizontal-navtoggle"><span></span></a><!-- sidebar-toggle-->
		<a class="header-brand" href="<?=base_url();?>">
			<img src="<?=base_url('./../assets/theme/assets/img/brand/logo-white.png');?>" class="desktop-dark">
			<img src="<?=base_url('./../assets/theme/assets/img/brand/logo.png');?>" class="desktop-logo">
			<img src="<?=base_url('./../assets/theme/assets/img/brand/favicon.png');?>" class="desktop-logo-1">
			<img src="<?=base_url('./../assets/theme/assets/img/brand/favicon-white.png');?>" class="desktop-logo-dark">
		</a>
		 
	</div><!-- search -->
	<div class="main-header-right">
		<ul class="nav nav-item  navbar-nav-right ms-auto">
			  
			<li class="nav-item full-screen fullscreen-button">
				<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
			</li>
			
			
			<li class="dropdown main-profile-menu nav nav-item nav-link">
				<a class="profile-user d-flex" href=""><img alt="" src="<?=base_url('./../assets/img/user1.png');?>"></a>
				<div class="dropdown-menu">
					<div class="main-header-profile bg-primary p-3">
						<div class="d-flex wd-100p">
							<div class="main-img-user"><img alt="" src="<?=base_url('./../assets/img/user1.png');?>" class=""></div>
							<div class="ms-3 my-auto">
								<h6><?=$this->session->nama;?></h6><span>Id Surveyor : <?=$this->session->nis;?></span>
							</div>
						</div>
					</div> 
					<a class="dropdown-item" href="<?=base_url('setting');?>"><i class="bx bx-cog"></i> Pengaturan</a>
					<a class="dropdown-item" href="<?=base_url('logout');?>"><i class="bx bx-log-out"></i> Keluar</a>
				</div>
			</li> 
		</ul>
	</div>
</div>
