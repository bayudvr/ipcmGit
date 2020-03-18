<!DOCTYPE html>
<html>
<head>
	<title>Data Calon Anggota</title>

	<?php $this->load->view('layout/pluginAdmin'); ?>

	<style type="text/css">
		.modal-content{

			border-radius: 20px;
		}
	</style>
</head>
<body id="page-top">
	<div id="wrapper">
		<?php $this->load->view('layout/admin/menu'); ?>

		<div id="content-wrapper" class="d-flex flex-column">
			
			<div id="content" style="background-image: linear-gradient(to right top, #000000, #2e2e2e, #585858, #878787, #b9b9b9, #c8c8c8, #d7d7d7, #e7e7e7, #d5d5d5, #c3c3c3, #b2b2b2, #a1a1a1);">
				
				<?php $this->load->view('layout/admin/navbar'); ?>

				<div class="container-fluid">
					
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						 <h1 class="h3 mb-0 text-gray-800">Data Calon Anggota</h1>
					</div>

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="card shadow py-2" style="border-radius: 30px;">
							<div class="card-body">
								<div id="data" class="table-responsive">
									<p>Sedang Load Data Harap Tunggu <i class="fas fa-fw fa-cog fa-spin"></i></p>
								</div>
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
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 p-5" id="formEdit"></div>		
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){

			window.onload = $(document).ready(function(){

				loadData();
			});

			$(document).on('submit','#penolakan',function(e){

				e.preventDefault();

				$.ajax({
					url:'<?php echo base_url() ?>crud/alasanTolak',
					type:'post',
					data: new FormData(this),
					contentType:false,
					processData:false,
					success:function(response){

						if(response == '"done"'){

							swal('','Alasan penolakan sudah dikirim ke email User, akun user di sembunyikan','success').then(function(){

								$('#form').modal('hide');
								loadData();
							});
						}else{

							swal('','Ada kesalahan','error');
						}
					}
				});
			});
	});

	function loadData(){

		$.ajax({
			url:'<?php echo base_url() ?>data/anggota',
			type:'get',
			dataType:'json',
			success:function(data){

				$('#data').html(data);
				$('#tdata').DataTable();
			}
		});
	}

	function editProfil(id){

		$('#form').modal('show');
		
		$.ajax({
			url:'<?php echo base_url() ?>form/editProfil/'+id,
			type:'get',
			dataType:'json',
			success:function(data){

				$('#formEdit').html(data);
				
			}
		});		
	}

	function tolak(id){

		$.confirm({
			title:'Penolakan Biodata',
			content:'Yakin ingin menolak biodata user?',
			autoClose:'nope|5000',
			buttons:{
				nope:{
					text:'tidak',
					btnClass:'btn-primary'
				},
				yup:{
					text:'iya',
					btnClass:'btn-danger',
					action:function(){

						penolakan(id);
					}
				}
			}
		});
	}

	function penolakan(id){

		$('#form').modal('show');

		$.ajax({
			url:'<?php echo base_url() ?>form/penolakan/'+id,
			type:'get',
			dataType:'json',
			success:function(data){
				$('#formEdit').html(data);
			}
		});
	}

	function infoProfil(id){

		$.confirm({
			title:'Biodata',
			content:'url:<?php echo base_url() ?>data/profil1/'+id,
			columnClass:'large',
			buttons:{
				tutup:{
					text:'tutup',
					btnClass:'btn-primary'
				}
			}
		});
	}

	function terima(id,nama){

		$.confirm({
			title:'Approve Member?',
			content:'Ingin approve biodata dari '+nama+'?',
			autoClose:'nope|5000',
			buttons:{
				yup:{
					text:'iya',
					btnClass:'btn-primary',
					action:function(){

						$.ajax({
							url:'<?php echo base_url() ?>crud/approve/'+id,
							type:'get',
							dataType:'json',
							success:function(response){

								if(response == 'done'){

									swal('',nama+', berhasil diapprove, email sudah dikirimkan','success').then(function(){

										loadData();
									});
								}else{

									swal('','Ada kesalahan','error');
								}
							}
						});
					}
				},
				nope:{
					text:'tidak',
					btnClass:'btn-danger'
				}
			}
		});
	}

	function sembunyikan(id,nama){

		$.confirm({
			title:'Sembunyikan Akun?',
			content:'Yakin ingin menyembunyikan akun '+nama+'?',
			autoClose:'nope|5000',
			buttons:{
				yup:{
					text:'Iya',
					btnClass:'btn-warning',
					action:function(){

						$.ajax({

							url:'<?php echo base_url() ?>crud/sembunyikan/'+id,
							type:'get',
							dataType:'json',
							success:function(response){

								if(response == 'done'){

									loadData();
								}else{

									alert('Ada kesalahan');
								}
							}
						});
					}
				},
				nope:{
					text:'tidak',
					btnClass:'btn-info'
				}
			}
		});
	}
</script>