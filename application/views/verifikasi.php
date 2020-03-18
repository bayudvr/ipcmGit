<!DOCTYPE html>
<html>
<head>
	<title>Konfirmasi Pembayaran</title>

	<?php $this->load->view('layout/pluginAdmin.php'); ?>
</head>
<body id="page-top">
	<div id="wrapper">
		<?php $this->load->view('layout/menu'); ?>
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" style="background-image: linear-gradient(to right top, #000000, #2e2e2e, #585858, #878787, #b9b9b9, #c8c8c8, #d7d7d7, #e7e7e7, #d5d5d5, #c3c3c3, #b2b2b2, #a1a1a1);">
				<div class="container-fluid">
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1>Konfirmasi Pembayaran</h1>
					</div>

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="card shadow py-2" style="border-radius: 30px;">
							<div class="card-body">
								<center>
									<h3>Selamat Datang, <?php foreach($invoice as $d){echo $d->nama_payee;} ?></h3>

									<p class="pb-5">Lakukan pembayaran dengan mengupload bukti pembayaran pada form dibawah</p>
									<div class="my-3">
										<form id="myform" method="POST" enctype="multipart/form-data">
											<div class="form-group">
												<input type="hidden" name="kode" id="kode" readonly value="<?php foreach($invoice as $d){echo $d->id;} ?>">
											</div>
											<div class="form-group row">
												<label for="foto" class="label-control col-md-3">Bukti Pembayaran</label>
												<input type="file" name="foto" id="foto" onchange="cekFoto();" class="form-control col-md-9" autofocus required>
											</div>
											<div class="form-group">
												<button type="submit" class="btn btn-outline-success">Upload <i class="fas fa-fw fa-upload"></i></button>
											</div>
										</form>
									</div>
								</center>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">

	$(document).ready(function(){

		$(document).on('submit','#myform',function(e){

			e.preventDefault();

			$.ajax({
				url:'<?php echo base_url() ?>crud/invoice',
				type:'post',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(response){

					if(response == '"done"'){

						swal('','Bukti pembayaran berhasil diupload, anda akan menerima email apabila data sudah diapprove oleh admin','success').then(function(){

							window.location = '<?php echo base_url() ?>';
						});
					}else{

						swal('','Ada kesalahan','error');
					}
				}
			});
		});
	});
	
	function cekFoto(){

		var ext = $('#foto').val().split('.').pop().toLowerCase();

		if(jQuery.inArray(ext, ['jpg','png','jpeg']) == -1){
			swal('','Fomat Foto Harus JPG/PNG/JPEG','error');
			$('#foto').val('');
		}
	}
</script>