<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>

	<?php $this->load->view('layout/pluginAdmin'); ?>
</head>
<body id="page-top">
	<div id="wrapper">
		<?php $this->load->view('layout/user/menu'); ?>

		<div id="content-wrapper" class="d-flex flex-column">
			
			<div id="content" style="background-image: linear-gradient(to right top, #000000, #2e2e2e, #585858, #878787, #b9b9b9, #c8c8c8, #d7d7d7, #e7e7e7, #d5d5d5, #c3c3c3, #b2b2b2, #a1a1a1);">
				
				<?php $this->load->view('layout/admin/navbar'); ?>

				<div class="container-fluid">
					
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						 <h1 class="h3 mb-0 text-gray-800">Profile</h1>
					</div>

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-5">
						<div class="card shadow py-2" style="border-radius: 30px;">
							<div class="card-body">
								<div id="data" class="table-responsive"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<div class="modal modal-info fade" id="form" tabindex="1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 p-5" id="formEdit"></div>		
	</div>
</div>
<script type="text/javascript">

	$(document).ready(function(){

		window.onload = $(document).ready(function(){

			loadProfil();
		});

		$(document).on('submit','#editForm',function(e){

			e.preventDefault();

			$.ajax({
				url:'<?php echo base_url() ?>crud/profilEdit',
				type:'post',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(response){

					if(response == '"done"'){

						swal('','Update Profil Berhasil!','success').then(function(){

							loadProfil();
						});
					}else if(response == '"fail"' ){

						swal('','Ada kesalahan saat menginput','error');
					}
				}
			});
		});

		$(document).on('submit','#pasFoto',function(e){

			e.preventDefault();

			$.ajax({
				url:'<?php echo base_url() ?>crud/uploadFoto',
				type:'post',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(response){

					if(response == '"done"'){

						swal('','Foto berhasil diubah','success').then(function(){

							$('#form').modal('hide');
							loadProfil();
						});
					}else if(response == '"fail"'){

						swal('','Ada kesalahan saat mengupload','error');
					}
				}
			});
		});

		$(document).on('submit','#logoKlinik',function(e){

			e.preventDefault();

			$.ajax({
				url:'<?php echo base_url() ?>crud/uploadLogo',
				type:'post',
				data: new FormData(this),
				contentType:false,
				processData:false,
				success:function(response){

					if(response == '"done"'){

						swal('','Logo berhasil diubah','success').then(function(){

							$('#form').modal('hide');
							loadProfil();
						});
					}else if(response == '"fail"'){

						swal('','Ada kesalahan saat mengupload','error');
					}
				}
			});
		});

		$(document).on('submit','#formKontribusi',function(e){

			e.preventDefault();

			$.ajax({
				url:'<?php echo base_url() ?>crud/editKontribusi',
				type:'post',
				data: new FormData(this),
				contentType:false,
				processData:false,
				success:function(response){

					if(response == '"done"'){

						swal('','Nilai kontribusi berhasil diubah, cek email kamu untuk melakukan transaksi yang tertera pada invoice','success').then(function(){

							$('#form').modal('hide');
							loadProfil();
						});
					}else if(response == '"fail"'){

						swal('','Ada kesalahan saat mengubah','error');
					}
				}
			});
		});
	});
	
	function loadProfil(){

		var id = <?php echo $this->session->userdata('id'); ?>;

		$.ajax({
			url:'<?php echo base_url() ?>data/profil/'+id,
			type:'get',
			dataType:'json',
			success:function(data){

				$('#data').html(data);
			}
		});
	}

	function editProfil(){

		var id = <?php echo $this->session->userdata('id'); ?>;

		$.ajax({
			url:'<?php echo base_url() ?>form/profilEdit/'+id,
			type:'get',
			dataType:'json',
			success:function(data){

				$('#data').html(data);
				getKotkab();
			}
		});
	}

	function getKotkab(){

		var wil = $('#wilayah').val();

		if(wil != ''){

			$.ajax({
				url:'<?php echo base_url() ?>data/getKotkab/'+wil,
				type:'get',
				dataType:'json',
				success:function(data){

					$('#kotkab').html(data);
					getKec();
				}
			});
		}else{
			$('#kotkab').html('<option value="">PILIH</option>');
		}
	}

	function getKec(){

		var kotkab = $('#kotkab').val();

		$.ajax({
			url:'<?php echo base_url() ?>data/getKec/'+kotkab,
			type:'get',
			dataType:'json',
			success:function(data){

				$('#kecamatan').html(data);
			}
		});
	}

	function formFoto(){

		$('#form').modal('show');

		$.ajax({
			url:'<?php echo base_url() ?>form/pasFoto',
			type:'get',
			dataType:'json',
			success:function(data){
				$('#formEdit').html(data);
			}
		});
	}

	function formLogo(){

		$('#form').modal('show');

		$.ajax({
			url:'<?php echo base_url() ?>form/formLogo',
			type:'get',
			dataType:'json',
			success:function(data){
				$('#formEdit').html(data);
			}
		});
	}

	function cekFoto(){

		var ext = $('#foto').val().split('.').pop().toLowerCase();

		if(jQuery.inArray(ext, ['jpg','png','jpeg']) == -1){
			swal('','Fomat Foto Harus JPG/PNG/JPEG','error');
			$('#foto').val('');
		}
	}

	function kontribusi(){

		$('#form').modal('show');

		$.ajax({
			url:'<?php echo base_url() ?>form/formKontribusi',
			type:'get',
			dataType:'json',
			success:function(data){
				$('#formEdit').html(data);
			}
		});
	}

</script>