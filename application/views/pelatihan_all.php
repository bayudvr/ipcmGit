<!DOCTYPE html>
<html>
<head>
	<title>List Pelatihan</title>

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

		.modal-content{

			height: 550px;
		}

		.modal-content input{

			border-radius: 30px;
		}


		.clv_footerwrapper::before{
		    
		    background:url('../assets/img/bgg.jpg') no-repeat center;
		}

		#topnav li{

			margin-right: 20px;
		}
	</style>
</head>
<body>

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
					<li class="py-2 mr-5"><a href="<?php echo base_url() ?>#tentang">Tentang kami</a></li>
					<li class="py-2 mr-5"><a href="<?php echo base_url() ?>#pelayanan">Pelayanan</a></li>
					<li class="py-2 mr-5"><a href="<?php echo base_url() ?>#galeri">Galeri</a></li>
					<li class="py-2 mr-5"><a href="<?php echo base_url() ?>#mtools">COVID-19</a></li>
					<li class="py-2 mr-5"><a href="<?php echo base_url() ?>#blog">Artikel</a></li>
					<li class="py-2 mr-5"><a href="<?php echo base_url() ?>#kontak">Kontak</a></li>
				</ul>
				<button type="button" href="#" onclick="daftar();" class="btn btn-danger btn-lg">Member IPC <i class="fas fa-fw fa-login"></i></button>
			</div>
		</nav>
	</div>
	<div class="breadcrumb_wrapper" style="margin-top: 100px;">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div class="breadcrumb_inner">
						<h3>List Pelatihan</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="breadcrumb_block" style="background: #E52929">
			<ul>
				<li><a href="<?php echo base_url() ?>" title="">home</a></li>
				<li>List Pelatihan</li>
			</ul>
		</div>
	</div>
	<div class="dairy_blog_wrapper clv_section">
		<div class="container">
			<div class="dairy_blog_section">
				<?php foreach($pelatihan as $bl){ ?>
				
				<div class="right_blog_section">
					<div class="right_blog_block">
						<div class="right_blog_image pl-2">
							<img src="<?php echo base_url() ?>assets/upload/jejaring/<?php echo $bl->foto; ?>" style="object-fit:contain; width:300px; height: 200px;" alt="image" />
						</div>
						<div class="right_blog_content">
							<h3><a href="#"><?php echo ($bl->nama); ?></a></h3>
							<p><?php echo word_limiter($bl->desc,10); ?></p>
							<a href="<?php echo base_url() ?>jejaring/?k=<?php echo urlencode($bl->nama); ?>" target="_blank">read more <span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span></a>
						</div>
					</div>
				</div>

				<?php } ?>

				<div class="row">
					<div class="col">
						<?php echo $pagination; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clv_footer_wrapper clv_section" id="kontak">
		<div class="container">
			<div class="row" style="padding-top: 50px;">
				<div class="col-md-3 col-lg-3">
					<div class="footer_block">
						<div class="footer_logo"><a href="javascript:;"><img style="height: 50px; object-fit: cover;" src="<?php echo base_url() ?>assets/img/logow.png" alt="image" /></a></div>
							<h6>kontak kami</h6>
							<h3><a href="https://wa.me/6281317950909" title=""><i class="fas fa-fw fa-telephone"></i></a></h3>
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
									<span><?php echo $ar->tanggal; ?></span>
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

						swal('Welcome','','success').then(function(){
							window.location  = '<?php echo base_url() ?>login/verifikasi'
						});
					}else{

						alert('Informasi login yang dimasukkan salah');
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
	});
	
	function daftar(){

		$('#registrasi').modal('show');
		login('login');
		
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