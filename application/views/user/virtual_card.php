<!DOCTYPE html>
<html>
<head>
	<title>Virtual Card</title>

	<?php $this->load->view('layout/pluginAdmin'); ?>
	
	<style type="text/css">
		#kartu{
			width:720px;
			height:400px;
		}
		.info{

			position: absolute;
			top:71%;
			left:20%;
			transform: translate(0%, -100%);
			font-size: 1.5rem;
			font-family: 'calibri', sans-serif;
		}

		.logo{
			
			position: absolute;
			top:42%;
			left:20%;
			transform: translate(0%,-100%);
			object-fit: cover;
			height: 100px;
		}

		.foto{

			position: absolute;
			top:50%;
			left:60%;
			transform: translate(0%,-100%);
			object-fit: cover;
			height: 150px;
		}

		.qr{
			
			position: absolute;
			top:82%;
			left:60%;
			transform: translate(0%,-100%);
			object-fit: cover;
			height: 150px;

		}
	</style>
</head>
<body id="page-top">
	<div id="wrapper">
		<?php $this->load->view('layout/user/menu'); ?>

		<div id="content-wrapper" class="d-flex flex-column">
			
			<div id="content" style="background-image: linear-gradient(to right top, #000000, #2e2e2e, #585858, #878787, #b9b9b9, #c8c8c8, #d7d7d7, #e7e7e7, #d5d5d5, #c3c3c3, #b2b2b2, #a1a1a1);">
				
				<?php $this->load->view('layout/admin/navbar'); ?>

				<div class="container-fluid">
					
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800">Virtual Card</h1>
					</div>
					<div id="kartu">
						<img src="<?php echo base_url() ?>assets/img/kartu2.jpg" width="720" height="400" alt="">
						<img src="<?php echo base_url() ?>assets/upload/fotoDiri/<?php foreach($user as $u){echo $u->pas_foto;} ?>" class="foto" alt="">
						<img src="<?php echo base_url() ?>assets/img/logow.png" alt="" class="logo">
						<div class="info">
							<table>
								<tr>
									<td><b>Nama Klinik</b></td>
									<td>:</td>
									<td><b><?php foreach($user as $u){echo $u->nama_klinik;} ?></b></td>
								</tr>
								<tr>
									<td><b>ID</b></td>
									<td>:</td>
									<td><b><?php foreach($user as $u){echo $u->no_anggota;} ?></b></td>
								</tr>
							</table>
						</div>
						<div class="qr">
							<img src="<?php echo site_url('data/qrcode'); ?>" alt="">
						</div>
					</div>
					<a href="#" onclick="cetak();" type="button" class="btn btn-info mt-4 ml-5">Download <i class="fas fa-fw fa-download" ></i></a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	function cetak(){

		html2canvas(document.getElementById("kartu")).then(canvas => {
		    // document.body.appendChild(canvas)
		    
		    var image = canvas.toDataURL("image/png",0.6);

		    $.ajax({
		    	url:'<?php echo base_url() ?>cetak/vcm/<?php echo $this->session->userdata("id"); ?>',
		    	type:'post',
		    	data:{'image':image},
		    	contentType:'application/x-www-form-urlencoded',
		    	success:function(response){

		    		if(response == '"done"'){

		    			swal('','File berhasil dikirim ke email','success');
		    		}else{
		    			swal('','Ada Kesalahan');
		    		}
		    	}

		    });
		});
	}
</script>