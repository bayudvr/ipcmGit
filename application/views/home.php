<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>IMANI Primary Care</title>

	<?php $this->load->view('layout/plugin.php'); ?>

	<style type="text/css">

		.dropdown-menu{

			width: 350px !important;
			height: auto !important;
			border-radius: 20px;
			background-color: rgb(202,202,202);
		}

		.dropdown-menu label, .dropdown-menu input{

			width: 100% !important;
		}

		.dropdown-menu input{

			border-radius: 20px;
		}

		.carousel img{

			height: 585px;
		}

		.carousel-control-prev, .carousel-control-next{

			background-color: rgba(0,0,0,.7);
			height: 100px;
			width: 100px;
			margin-top: 250px;
		}

		.carousel-caption{

			background: rgba(0,0,0,.5);
		}

		.modal-content{

			height: 550px;
		}

		.modal-content input{

			border-radius: 30px;
		}

		#logoPartner span{
			
			margin-right: 50px;
		}

		#topnav li{

			margin-right: 20px;
		}

		.slick-slide {
			margin: 0px 20px;
		}

		.slick-slide img {
			width: 100%;
		}

		.slick-slider
		{
			position: relative;
			display: block;
			box-sizing: border-box;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
					user-select: none;
			-webkit-touch-callout: none;
			-khtml-user-select: none;
			-ms-touch-action: pan-y;
				touch-action: pan-y;
			-webkit-tap-highlight-color: transparent;
		}

		.slick-list
		{
			position: relative;
			display: block;
			overflow: hidden;
			margin: 0;
			padding: 0;
		}
		.slick-list:focus
		{
			outline: none;
		}
		.slick-list.dragging
		{
			cursor: pointer;
			cursor: hand;
		}

		.slick-slider .slick-track,
		.slick-slider .slick-list
		{
			-webkit-transform: translate3d(0, 0, 0);
			-moz-transform: translate3d(0, 0, 0);
				-ms-transform: translate3d(0, 0, 0);
				-o-transform: translate3d(0, 0, 0);
					transform: translate3d(0, 0, 0);
		}

		.slick-track
		{
			position: relative;
			top: 0;
			left: 0;
			display: block;
		}
		.slick-track:before,
		.slick-track:after
		{
			display: table;
			content: '';
		}
		.slick-track:after
		{
			clear: both;
		}
		.slick-loading .slick-track
		{
			visibility: hidden;
		}

		.slick-slide
		{
			display: none;
			float: left;
			height: 100%;
			min-height: 1px;
		}
		[dir='rtl'] .slick-slide
		{
			float: right;
		}
		.slick-slide img
		{
			display: block;
		}
		.slick-slide.slick-loading img
		{
			display: none;
		}
		.slick-slide.dragging img
		{
			pointer-events: none;
		}
		.slick-initialized .slick-slide
		{
			display: block;
		}
		.slick-loading .slick-slide
		{
			visibility: hidden;
		}
		.slick-vertical .slick-slide
		{
			display: block;
			height: auto;
			border: 1px solid transparent;
		}
		.slick-arrow.slick-hidden {
			display: none;
		}

		.waMain{
			display:block;
			line-height:50px;
			position:fixed;
			right:30px;
			bottom:30px;
			z-index: 2;
		}

		.waMain img{			
			height: 60px;
			object-fit: contain;
		}

	</style>

</head>
<body>
	<a href="https://linktr.ee/ipcnetwork" class="waMain" target="_blank">
		<img src="<?php echo base_url()?>assets/img/IconWa.png">
	</a>
	<div class="preloader_wrapper">
		<div class="preloader_inner">
			<img src="<?php echo base_url() ?>assets/img/logow.png" style="width: 300px; object-fit:contain;" alt="image" />
		</div>
	</div>
	<div class="clv_main_wrapper index_v3">
		<div class="header2_wrapper">
			<nav class="navbar navbar-expand-md bg-light navbar-light fixed-top">
				<!-- Brand -->
				<a class="navbar-brand ml-5" href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/img/logo.png" width="70" height="70" alt="Cultivation" /></a>

				<!-- Toggler/collapsibe Button -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- Navbar links -->
				<div class="collapse navbar-collapse" id="collapsibleNavbar">
					<ul class="navbar-nav ml-auto" id="topnav">
					  	<li class="py-2 mr-5"><a href="<?php echo base_url() ?>">Beranda</a></li>
						<li class="py-2 mr-5"><a href="#tentang">Tentang kami</a></li>
						<li class="py-2 mr-5"><a href="#pelatihan">Pelatihan</a></li>
						<li class="py-2 mr-5"><a href="#pelayanan">Pelayanan</a></li>
						<li class="py-2 mr-5"><a href="#galeri">Galeri</a></li>
						<li class="py-2 mr-5"><a href="<?php echo base_url() ?>#mtools">COVID-19</a></li>
						<li class="py-2 mr-5"><a href="<?php echo base_url() ?>#jejaring">Jejaring</a></li>
						<li class="py-2 mr-5"><a href="#blog">Artikel</a></li>
						<li class="py-2 mr-5"><a href="#kontak">Kontak</a></li>
					</ul>
					<button type="button" href="#" onclick="daftar();" class="btn btn-danger btn-lg">Member IPC <i class="fas fa-fw fa-login"></i></button>
				</div>
			</nav>
		</div>
		<div id="demo" class="carousel slide" data-ride="carousel" style="margin-top: 70px;">

			<!-- Indicators -->
			<ul class="carousel-indicators">
				<?php foreach($c_slider as $cs){ $jml = $cs->jumlah; }
					
					for($no=0;$no<$jml;$no++){ 
						if($no == 0) { ?>
							<li data-target="#demo" data-slide-to="<?php echo $no; ?>" class="active"></li>
						<?php }else{ ?>
							<li data-target="#demo" data-slide-to="<?php echo $no; ?>"></li>
						<?php } ?>

					<?php } ?>
			</ul>

			<!-- The slideshow -->
			<div class="carousel-inner">
				<?php foreach($slider1 as $s1){ $main = $s1->id;} foreach($slider as $s){ 
					if($s->id == $main){ ?>
				<div class="carousel-item active">
					<img src="<?php echo base_url() ?>assets/upload/slider/<?php echo $s->foto; ?>" style="object-fit: cover; width: 100%;" alt="">
					<?php if($s->judul != "" || $s->desc != "" || $s->link !=""){ ?>
					<div class="carousel-caption">
					<?php if($s->judul != ""){ ?>
						<h3><?php echo $s->judul; ?></h3>
					<?php } ?>
					<?php if($s->desc != ""){ ?>
						<p><?php echo $s->desc; ?></p>
					<?php } ?>	
					<?php if($s->link != ""){ ?>
						<a href="http://www.<?php echo $s->link; ?>" target="_blank" type="button" class="btn btn-info" title="">Read More</a>
					<?php } ?>
					</div>
					<?php } ?>
				</div>
					<?php }else{ ?>
				<div class="carousel-item">
					<img src="<?php echo base_url() ?>assets/upload/slider/<?php echo $s->foto; ?>" style="object-fit: cover; width: 100%;" alt="">
					<div class="carousel-caption">
						<h3><?php echo $s->judul; ?></h3>
						<p><?php echo $s->desc; ?></p>
					</div>
				</div>
					<?php } ?>

				<?php } ?>
			</div>

		</div>
		<!--About-->
		<div class="dairy_about_wrapper clv_section" id="tentang">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 col-md-6">
						<div class="clv_heading">
							<h3>selamat datang di website kami!</h3>
							<div class="clv_underline"><img src="<?php echo base_url() ?>assets/user/images/dairy_underline3.png" alt="image" /></div>
						</div>
					</div>
				</div>
				<div class="dairy_about_inner">
					<div class="row">
						<div class="col-md-6">
							<div class="about_img">
								<img src="<?php echo base_url() ?>assets/img/logo.png" alt="image" width="300" height="300" class="ml-3" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="about_content">
								<div class="about_heading">
									<h2>Tentang <span style="color: #FF3333;">IMANI Primary Care</span></h2>
									<div class="clv_underline"><img src="<?php echo base_url() ?>assets/user/images/dairy_underline2.png" alt="image" /></div>
								</div>
								<p style="font-size: 1.2rem;">
									<?php foreach($about as $ab){ echo $ab->konten;} ?>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="pelatihan" class="py-5" style="background: #E1E1E1; color: black;">
			<div class="clv_selection">
				<div class="container row">
					<div class="col-lg-6 col-md-6">
						<div class="service_content">
							<div class="service_heading">
								<h3 class="ml-3">Pelatihan</h3>
								<div class="clv_underline ml-3"><img src="<?php echo base_url() ?>assets/user/images/dairy_underline2.png" alt="image" /></div>
							</div>
						</div>
					</div>
					<section class="pelatihan slider mb-5 col-md-6 col-lg-6">
						<?php foreach($pelatihan as $ph){ ?>

						<div class="slide">
							<div>
								<img src="<?php echo base_url() ?>assets/upload/pelatihan/<?php echo $ph->foto; ?>" style="height: 150px; width: 150px; object-fit: cover; border-radius: 20px;" class="mb-1">
							</div>
							<div>
								<center>
									<h5 style="width: 100%;" class="mb-2"><?php echo $ph->nama; ?></h5>
									<p style="width: 100%;"><?= tanggal_indo($ph->waktu); ?></p>
									<a href="<?php echo base_url() ?>pelatihan/?k=<?php echo urlencode($ph->nama); ?>" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i></a>
								</center>
							</div>
						</div>

						<?php } ?>
					</section>
				</div>
			</div>
		</div>

		<div id="jejaring"  style="background:url('./assets/img/JejaringBG.jpg'); background-size:cover;">
			<div class="dairy_service_wrapper clv_section" style="background:rgba(0,0,0,.7);background-size:cover;">
				<div class="container row">
					<div class="col-lg-6 col-md-6">
						<div class="service_content">
							<div class="service_heading">
								<h3 style="color:white;" class="ml-3">Jejaring Klinik</h3>
								<div class="clv_underline ml-3"><img src="<?php echo base_url() ?>assets/user/images/dairy_underline2.png" alt="image" /></div>
								<p style="color:white;" class="ml-3">Jejaring IMANI PRIMARY CARE</p>
							</div>
						</div>
					</div>
				
					<section class="jejaring slider mb-5 col-md-6 col-lg-6">
						<?php foreach($jejaring as $jr){ ?>
						<div class="slide">
							<div>
								<img src="<?php echo base_url() ?>assets/upload/jejaring/<?php echo $jr->foto; ?>" style="height: 150px; width: 150px; object-fit: cover; border-radius: 20px;" class="mb-1">								
							</div>
							<div>
								<h5 style="width: 100%; color:white;" class="mb-2"><?php echo $jr->nama; ?></h5>
								<a href="<?php echo base_url() ?>jejaring/?k=<?php echo urlencode($jr->nama); ?>" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i></a>
								<a href="https://api.whatsapp.com/send?phone=<?php echo $jr->kontak; ?>&text=Assalamualaikum%2c%20Saya%20ingin%20bertanya%0aNama%20%3a%20%0aNo%20RM%20%3a%0aNo%20BPJS%20%3aKeluhan%20%3a&source=&data=&app_absent=" class="btn btn-success" target="_blank"><i class="fa fa-whatsapp"></i></a>
							</div>
						</div>			
						<?php } ?>
					</section>
				</div>
			</div>
		</div>
		<!--Dairy Products-->
		<div class="dairy_products_wrapper clv_section" id="pelayanan">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 col-md-6">
						<div class="clv_heading">
							<h3>Produk & Pelayanan IPC</h3>
							<div class="clv_underline"><img src="<?php echo base_url() ?>assets/user/images/dairy_underline3.png" alt="image" /></div>
						</div>
					</div>
				</div>
				<div class="dairy_product_inner">
					<div class="row">
						<?php foreach($produk as $pd){
						?>
						<div class="col-md-3 col-lg-3">
							<div class="dairy_product_block">
								<?php foreach($galeri_produk as $gp){
									if($pd->kode_produk == $gp->kode_produk){ ?>
								<div class="product_image">
									<img style="object-fit: cover; height: 200px;" src="<?php echo base_url() ?>assets/upload/produk/<?php echo $gp->foto; ?>" alt="">
								</div>
									<?php }
								} ?>
								<div class="product_content">
									<h3><?php echo $pd->nama_produk; ?></h3>
									<p><?php echo $pd->desc; ?></p>
									<a href="#" title=""></a>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="dairy_service_wrapper clv_section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="service_content">
							<div class="service_heading">
								<h3>kenapa harus kami?</h3>
								<div class="clv_underline"><img src="<?php echo base_url() ?>assets/user/images/dairy_underline2.png" alt="image" /></div>

								<div class="service_arrow_block">
									<span class="dairy_service_arrow dairy_service_left">
										<svg 
										 xmlns="http://www.w3.org/2000/svg"
										 xmlns:xlink="http://www.w3.org/1999/xlink"
										 width="10px" height="15px">
										<path fill-rule="evenodd"  fill="rgb(226, 226, 226)"
										 d="M0.324,8.222 L7.117,14.685 C7.549,15.097 8.249,15.097 8.681,14.685 C9.113,14.273 9.113,13.608 8.681,13.197 L2.670,7.478 L8.681,1.760 C9.113,1.348 9.113,0.682 8.681,0.270 C8.249,-0.139 7.548,-0.139 7.116,0.270 L0.323,6.735 C0.107,6.940 -0.000,7.209 -0.000,7.478 C-0.000,7.747 0.108,8.017 0.324,8.222 Z"/>
										</svg>
									</span>
									<span class="dairy_service_arrow dairy_service_right">
										<svg 
										 xmlns="http://www.w3.org/2000/svg"
										 xmlns:xlink="http://www.w3.org/1999/xlink"
										 width="19px" height="25px">
										<path fill-rule="evenodd" fill="rgb(226, 226, 226)"
										 d="M13.676,13.222 L6.883,19.685 C6.451,20.097 5.751,20.097 5.319,19.685 C4.887,19.273 4.887,18.608 5.319,18.197 L11.329,12.478 L5.319,6.760 C4.887,6.348 4.887,5.682 5.319,5.270 C5.751,4.861 6.451,4.861 6.884,5.270 L13.676,11.735 C13.892,11.940 14.000,12.209 14.000,12.478 C14.000,12.747 13.892,13.017 13.676,13.222 Z"/>
										</svg>
									</span>
								</div>
								<?php foreach($plus as $pp){ ?>
								<p><?php echo $pp->konten; ?></p>
								<?php } ?>
							</div>
						</div>
					</div>
				
					<div class="col-md-6 col-lg-6 carousel slide" id="demo1" data-ride="carousel">
					    <br> <br> <br> <br> <br>
					    <?php foreach($plus as $pp){ $link = $pp->link; } ?>
					    <iframe width="100%" height="315" src="<?php echo $link; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						<ul class="carousel-indicators">
							<li data-target="#demo1" data-slide-to="0" class="active"> 	</li>
						</ul>

						<div class="carousel-inner">
							<div class="carousel-item active">
								<img src="" alt="">
								<div class="carousel-caption">
									<h3></h3>
									<p></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="galeri" class="dairy_gallery_wrapper clv_section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 col-md-6">
						<div class="clv_heading">
							<h3>galeri</h3>
							<div class="clv_underline"><img src="<?php echo base_url() ?>assets/user/images/dairy_underline3.png" alt="image" /></div>
						</div>
					</div>
				</div>
			</div>
			<div class="dairy_gallery_inner">
				<div class="row">
					<div class="col-md-12">
						<div class="gallery_slider">
							<div class="swiper-container">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<div class="gallery_slide">
											<div class="gallery_grid">
												<?php foreach($galeri as $g){ ?>
												<div class="gallery_grid_item">
													<div class="gallery_image">
														<img src="<?php echo base_url() ?>assets/upload/galeri/<?php echo $g->foto; ?>" alt="image" />
													</div>
												</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Marketing Tools -->

		<div id="mtools" style="background: rgba(170,170,170,0.5);" class="clv_shop_wrapper clv_section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 col-md-6">
						<div class="clv_heading">
							<h3>COVID-19</h3>
							<div class="clv_underline"><img src="<?php echo base_url() ?>assets/user/images/dairy_underline3.png" alt="image" /></div>
						</div>
					</div>
				</div>
				<div class="container">
					<section class="mtools slider">
						<?php foreach($mtools as $mt){ ?>
							<div class="slide">
								<div class="shop_slider">
									<div class="swiper-container">
										<div class="shop_slide" style="background:url('./assets/upload/banner/<?php echo $mt->banner; ?>'); background-size:contain; height:250px;">
											<!-- <div class="item_image">
												<img src="<?php echo base_url() ?>assets/upload/banner/<?php echo $mt->banner; ?>" style="height: 250px; object-fit: contain;" alt="image" class="img-fluid" />
											</div> -->
											<div class="item_overlay">
												<h5 class="px-5"><?php echo $mt->nama; ?></h5>
												<a href="<?php echo base_url() ?>marketing/read?k=<?php echo urlencode($mt->nama);?>" class="shop_btn" target="_blank"><i class="fa fa-eye"></i></a>
												<a href="<?php echo base_url() ?>assets/upload/attach/<?php echo $mt->file; ?>" class="shop_btn" target="_blank"><i class="fa fa-download"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>				
					</section>
				</div>
				<center>
					<a href="<?php echo base_url() ?>marketing/list" target="_blank"><button type="" class="btn btn-lg btn-danger">Lihat Selengkapnya <span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span></button></a>
				</center>
			</div>
		</div>

		<!-- Blog -->
		<div class="dairy_blog_wrapper clv_section">
			<div class="container">
				<div  id="blog" class="row justify-content-center">
					<div class="col-lg-6 col-md-6">
						<div class="clv_heading">
							<h3>artikel</h3>
							<div class="clv_underline"><img src="<?php echo base_url() ?>assets/user/images/dairy_underline3.png" alt="image" /></div>
						</div>
					</div>
				</div>
				<div class="dairy_blog_section">
					<div class="row">
						<?php foreach($blog as $bl){ ?>
						<div class="col-lg-6 col-md-6">
							<div class="right_blog_section">
								<div class="right_blog_block">
									<div class="right_blog_image pl-2">
										<img src="<?php echo base_url() ?>assets/upload/artikel/<?php echo $bl->foto; ?>" style="object-fit:contain; height:285px;" alt="image" />
									</div>
									<div class="right_blog_content">
										<span class="agri_blog_date"><?php echo tanggal_indo($bl->tanggal); ?></span>
										<h3><a href="#"><?php echo word_limiter($bl->judul,5); ?></a></h3>
										<p><?php echo word_limiter($bl->desc,35); ?></p>
										<a href="<?php echo base_url() ?>artikel/read?k=<?php echo urlencode($bl->judul); ?>" target="_blank">read more <span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span></a>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					<center>
						<a href="<?php echo base_url() ?>artikel/list" target="_blank"><button type="" class="btn btn-lg btn-danger">Lihat Selengkapnya <span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span></button></a>
					</center>
				</div>
			</div>
		</div>	
		<!-- Team -->
		<div class="dairy_team_wrapper clv_section" id="tim">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 col-md-6">
						<div class="clv_heading">
							<h3>Tim Kami</h3>
							<div class="clv_underline"><img src="<?php echo base_url() ?>assets/user/images/dairy_underline3.png" alt="image" /></div>
							<p>Kami memiliki pengalaman sejak 2014 dan di dukung oleh tenaga profesional yang expert di bidang masing-masing dan tersertifikasi BNPS sebagai Konsultan Kesehatan.</p>
						</div>
					</div>
				</div>
				<section class="team slider">
					<?php foreach($tim as $td){ ?>
					
					<div class="slide">
						<div class="dairy_team_slider">
							<div class="swiper-container">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<div class="team_slide">
											<div class="team_image">
												<img src="<?php echo base_url() ?>assets/upload/fotoTim/<?php echo $td->foto; ?>" style="object-fit: cover; height: 340px; width: 270px;" alt="image" class="img-fluid" />
											</div>
											<div class="team_details">
												<div class="team_name_block">
													<div class="team_name">
														<h4><?php echo $td->nama; ?></h4>
														<span><?php echo $td->jabatan; ?></span>
													</div>
													<div class="team_social">
														<ul>
															<li><a class="facebook" href="javascript:;"><span><i class="fa fa-facebook" aria-hidden="true"></i></span></a></li>
															<li><a class="twitter" href="javascript:;"><span><i class="fa fa-twitter" aria-hidden="true"></i></span></a></li>
														</ul>
													</div>
												</div>
												<div class="team_message">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<?php } ?>

				</section>
			</div>
		</div>
		<!-- Footer -->
		<div class="clv_footer_wrapper clv_section" id="kontak" style="background:url('./assets/img/bgg.jpg');background-size:cover;">
			<div class="container">
				<div class="row" style="padding-top: 50px;">
					<div class="col-md-3 col-lg-3">
						<div class="footer_block">
							<div class="footer_logo"><a href="javascript:;"><img style="height: 50px; object-fit: cover;" src="<?php echo base_url() ?>assets/img/logow.png" alt="image" /></a></div>
								<h6>kontak kami</h6>
								<h3><a href="https://wa.me/6281317950909" title=""><i class="fas fa-fw fa-telephone"></i></a></h3>
								<p>Citragran Cibubur Cluster Brentwood RC 1, 21, Cibubur, Ciracas, RT.005/RW.011, Jatikarya, Kec. Jatisampurna, Kota Jakarta Timur, Jawa Barat 17435</p>
								<p><i class="fab fa-whatsapp"></i> (021) 21384751</p>
						</div>
					</div>
					<div class="col-md-3 col-lg-3">
						<div class="footer_block">
							<div class="footer_heading">
								<h4>latest news</h4>
								<img src="<?php echo base_url() ?>assets/user/images/dairy_underline4.png" alt="image" />
							</div>
							<div class="footer_post_section">
								<?php foreach($artikel as $ar){ ?>
								<div class="footer_post_slide">
									<div class="footer_post_image">
										<img src="<?php echo base_url() ?>assets/upload/artikel/<?php echo $ar->foto; ?>" style="width: 70px; object-fit: contain;" />
									</div>
									<div class="footer_post_content">
										<span><?php echo tanggal_indo($ar->tanggal); ?></span>
										<a href="<?php echo base_url() ?>artikel/?k=<?php echo urlencode($ar->judul); ?>"><p><?php echo $ar->judul; ?></p></a>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-lg-3">
						<div class="footer_block">
							<div class="footer_heading">
								<h4>products</h4>
								<img src="<?php echo base_url() ?>assets/user/images/dairy_underline4.png" alt="image" />
							</div>
							<?php foreach($produk as $pd){ ?>
								<ul class="useful_links">
									<li><a href="#"><span><i class="fa fa-angle-right" aria-hidden="true"></i></span><?php echo $pd->nama_produk; ?></a></li>
								</ul>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-3 col-lg-3">
						<div class="footer_block">
							<div class="footer_heading">
								<h4>information</h4>
								<img src="<?php echo base_url() ?>assets/user/images/dairy_underline4.png" alt="image" />
							</div>
							<ul class="useful_links">
								<li><a href="#tentang"><span><i class="fa fa-angle-right" aria-hidden="true"></i></span>About Us</a></li>
								<li>
									<h1 style="font-family: 'Lato', sans-serif; color: white; margin-bottom: 20px; font-size: 1rem;">Kunjungan Hari Ini</h1>
									<h1 style="font-family: 'Lato', sans-serif; color: white; font-size: 2rem;" id="visit"><?php foreach($visit as $v){ echo $v->qty; } ?></h1>
								</li>	
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!--Copyright-->
			<div class="clv_copyright_wrapper">
				<p>copyright &copy; 2020 <a href="javascript:;">imani primary care.</a> all right reserved.</p>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<div class="modal modal-info fade" id="registrasi" tabindex="1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12" style="background: linear-gradient(to bottom, #ff6e7f, #bfe9ff); border-top-left-radius: 30px; border-bottom-left-radius: 30px;">
			<div class="modal-body">
				<button type="button" class="close btn btn-outline-dark px-2 py-2" data-dismiss="modal" data-target="#registrasi">X</button>
				<center>
					<img src="<?php echo base_url() ?>assets/img/logo.png" width="150" height="150" style="margin-top: 100px;">
				</center>
			</div>
		</div>
		<div class="modal-content col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 p-5" id="form" style="border-top-right-radius: 30px; border-bottom-right-radius: 30px;">
		</div>		
	</div>
</div>
<script type="text/javascript">

	$(document).ready(function(){

		$('.carousel').carousel({
			interval: 5000
		});

		$(document).on('submit','#loginForm',function(e){

			e.preventDefault();

			$.ajax({
				url:'<?php echo base_url() ?>login/auth',
				type:'post',
				data: new FormData(this),
				contentType: false,
				processData: false,
				success:function(response){

					if(response == '"done"'){

						toastr.success('Assalamualaikum','Login Sukses');
						window.location  = '<?php echo base_url() ?>login/verifikasi';
					}else{

						toastr.warning('Informasi login yang dimasukkan salah');
					}
				}
			});
		});

		$(document).on('submit','#regisForm',function(e){

			e.preventDefault();

			$.ajax({
				url:'<?php echo base_url() ?>crud/regis',
				type:'post',
				data:new FormData(this),
				contentType: false,
				processData: false,
				success:function(response){

					if(response == '"email"'){
						swal('Ditolak','Email sudah digunakan oleh akun lain, coba login atau gunakan email yang berbeda','error');
					}else if(response == '"pass"'){
						swal('Password terlalu pendek','Minimal panjang password adalah 8 karakter','error');
					}else if(response == '"fail"'){
						swal('Error','Ada kesalahan sistem saat mendaftar, coba beberapa saaat lagi','error');
					}else if(response == '"done"'){
						toastr.success('Pendaftaran berhasil, silahkan cek email untuk verifikasi','Done..!');
						$('#registrasi').modal('hide');
					}
				}
			});
		});

		$('.mtools').slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 10000,
			arrows: false,
			dots: false,
			pauseOnHover: false,
			responsive: [{
				breakpoint: 768,
				settings: {
					slidesToShow: 2
				}
			}, {
				breakpoint: 520,
				settings: {
					slidesToShow: 1
				}
			}]
		});

		$('.team').slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 11000,
			arrows: false,
			dots: false,
			pauseOnHover: false,
			responsive: [{
				breakpoint: 768,
				settings: {
					slidesToShow: 2
				}
			}, {
				breakpoint: 520,
				settings: {
					slidesToShow: 1
				}
			}]
		});

		$('.jejaring').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 11000,
			arrows: false,
			dots: false,
			pauseOnHover: false,
			responsive: [{
				breakpoint: 768,
				settings: {
					slidesToShow: 2
				}
			}, {
				breakpoint: 520,
				settings: {
					slidesToShow: 1
				}
			}]
		});

		$('.pelatihan').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 11000,
			arrows: false,
			dots: false,
			pauseOnHover: false,
			responsive: [{
				breakpoint: 768,
				settings: {
					slidesToShow: 2
				}
			}, {
				breakpoint: 520,
				settings: {
					slidesToShow: 1
				}
			}]
		});
	});
	
	function daftar(){

		$('#registrasi').modal('show');
		login('login');
		
	}

	function lihatfile(id){

		$.confirm({
			title:'Banner',
			content:'url: <?php echo base_url() ?>data/bannerMarketing/'+id
		});
	}

	function login(arr){

		$.ajax({
			url:'<?php echo base_url() ?>form/auth/'+arr,
			type:'get',
			dataType:'json',
			success:function(data){

				$('#form').html(data);
			}
		});
	}
</script>
<?php
	function tanggal_indo($tanggal){
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);

		$pecahkan = explode('-', $tanggal);

		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}
?>