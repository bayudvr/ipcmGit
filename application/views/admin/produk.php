<!DOCTYPE html>
<html>
<head>
	<title>Product Data</title>

	<?php $this->load->view('layout/pluginAdmin'); ?>
</head>
<body id="page-top">
	<div id="wrapper">
		<?php $this->load->view('layout/admin/menu'); ?>

		<div id="content-wrapper" class="d-flex flex-column">
			
			<div id="content" style="background-image: linear-gradient(to right top, #000000, #2e2e2e, #585858, #878787, #b9b9b9, #c8c8c8, #d7d7d7, #e7e7e7, #d5d5d5, #c3c3c3, #b2b2b2, #a1a1a1);">
				
				<?php $this->load->view('layout/admin/navbar'); ?>

				<div class="container-fluid">
					
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800">Data Produk</h1>
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
		<div class="modal-content col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 p-5" id="formCrud"></div>		
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){

		window.onload = $(document).ready(function(){

			loadData();
		});

		$(document).on('submit','#myForm',function(e){

			e.preventDefault();

			$('#submitBtn').attr('disabled', 'true');

			$.ajax({
				url:'<?php echo base_url() ?>crud/newProduk',
				type:'post',
				data: new FormData(this),
				contentType:false,
				processData:false,
				success:function(response){

					if(response == '"done"'){

						swal('','Data produk berhasil dimasukkan','success').then(function(){

							$('#form').modal('hide');
							loadData();
						});
					}else{

						$('#submitBtn').attr('disabled', 'false');

						swal('','Ada kesalahan','error');
					}
				}
			});
		});

		$(document).on('submit','#editForm',function(e){

			e.preventDefault();

			$('#submitBtn').attr('disabled', 'true');

			$.ajax({
				url:'<?php echo base_url() ?>crud/produkEdit',
				type:'post',
				data: new FormData(this),
				contentType:false,
				processData:false,
				success:function(response){

					if(response == '"done"'){

						swal('','Info produk berhasil diubah','success').then(function(){

							$('#form').modal('hide');
							loadData();
						});
					}else{

						$('#submitBtn').attr('disabled', 'false');

						swal('','Ada kesalahan','error');
					}
				}
			});
		});
	});

	function loadData(){

		$.ajax({
			url:'<?php echo base_url() ?>data/produk',
			type:'get',
			dataType:'json',
			success:function(data){

				$('#data').html(data);
				$('#tdata').DataTable();
			}
		});
	}

	function formCrud(id){

		$('#form').modal('show');

		var url1 = '<?php echo base_url() ?>';
		if(id != 'baru'){
			url1 = url1+'form/produkEdit/'+id;
		}else{
			url1 = url1+'form/newProduk';
		}

		$.ajax({
			url:url1,
			type:'get',
			dataType:'json',
			success:function(data){
				$('#formCrud').html(data);

				ClassicEditor
				    .create( document.querySelector( '#desc' ) )
				    .then( editor => {
				        console.log( editor );
				    } )
				    .catch( error => {
				        console.error( error );
				    } );
			}

		});
	}

	function show(id){

		$.confirm({
			title:'Tampilan konten dibawah?',
			content:'url:<?php echo base_url() ?>data/produkInfo/'+id,
			columnClass:'large',
			buttons:{
				yup:{
					text:'Iya',
					btnClass:'btn-primary',
					action:function(){

						$.ajax({
							url:'<?php echo base_url() ?>crud/produkStat/Ready/'+id,
							type:'post',
							contentType:false,
							processData:false,
							success:function(response){

								if(response == '"done"'){

									swal('','Konten ditampilkan','success').then(function(){

										loadData();
									});
								}else{

									$('#submitBtn').attr('disabled', 'false');

									swal('','Ada kesalahan','error');
								}
							}
						});
					}
				},
				nope:{
					text:'tidak',
					btnClass:'btn-warning'
				}
			}
		});
	}

	function ngumpet(id){

		$.confirm({
			title:'Sembunyikan konten dibawah?',
			content:'url:<?php echo base_url() ?>data/produkInfo/'+id,
			columnClass:'large',
			buttons:{
				yup:{
					text:'Iya',
					btnClass:'btn-primary',
					action:function(){

						$.ajax({
							url:'<?php echo base_url() ?>crud/produkStat/Hidden/'+id,
							type:'post',
							contentType:false,
							processData:false,
							success:function(response){

								if(response == '"done"'){

									swal('','Konten disembunyikan','success').then(function(){

										loadData();
									});
								}else{

									$('#submitBtn').attr('disabled', 'false');

									swal('','Ada kesalahan','error');
								}
							}
						});
					}
				},
				nope:{
					text:'tidak',
					btnClass:'btn-warning'
				}
			}
		});
	}
</script>