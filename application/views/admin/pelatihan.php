<!DOCTYPE html>
<html>
<head>
	<title>Pelatihan</title>

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
						<h1 class="h3 mb-0 text-gray-800">Data Pelatihan</h1>
					</div>

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="card shadow py-2" style="border-radius: 30px;">
							<div class="card-body">
								<button type="button" class="btn btn-primary mb-3" onclick="formCrud('baru');"><i class="fas fa-fw fa-plus"></i> Tambah Data</button>
								<div class="py-5 collapse" id="formPel"></div>
								<div class="table-responsive">
									<table class="table table-condensed" id="tdata">
										<thead>
											<tr>
												<th>No</th>
												<th>Foto</th>
												<th>ID</th>
												<th>Nama</th>
												<th>Lokasi</th>
												<th>Waktu</th>
												<th>Harga</th>
												<th>Kuota</th>
												<th>Keterangan</th>
												<th>Stat</th>
												<th>Opsi</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
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
	
	loadData();

	$(document).on('submit','#myForm',function(e){
		e.preventDefault();
		$.ajax({
			url:'<?php echo base_url() ?>crud/newPelatihan',
			type:'post',
			data: new FormData(this),
			contentType:false,
			processData:false,
			success:function(response){

				if(response == '"done"'){

					$('.collapse').collapse('hide');
					toastr.success('Pelatihan baru berhasil diinput');
					loadData();
				}else{
					toastr.error('Ada Kesalahan..!');
				}
			}
		});
	});

	$(document).on('submit','#editPelatihan',function(e){
		e.preventDefault();
		$.ajax({
			url:'<?php echo base_url() ?>crud/editPelatihan',
			type:'post',
			data: new FormData(this),
			contentType:false,
			processData:false,
			success:function(response){

				if(response == '"done"'){

					$('.collapse').collapse('hide');
					toastr.success('Data pelatihan berhasil diubah');
					loadData();
				}else{
					toastr.error('Ada Kesalahan..!');
				}
			}
		});
	});

	function loadData()
	{
		$.ajax(
		{
			url:'<?php echo base_url() ?>data/pelatihan',
			type:'get',
			dataType:'json',
			success:function(data)
			{
				$('tbody').html(data);
				$('#tdata').DataTable();
				toastr.success('Data berhasil ditampilkan');
			}
		});
	}

	function formCrud(id)
	{
		url1 = '<?php echo base_url() ?>form/';

		if(id != 'baru')
		{
			url1 = url1+'editPelatihan/'+id;
		}
		else
		{
			url1 = url1+'newPelatihan';
		}

		$.ajax(
			{
				url:url1,
				type:'get',
				dataType:'json',
				success:function(data)
				{
					$('#formPel').html(data);
					$('.collapse').collapse('show');

					ClassicEditor
				    .create( document.querySelector( '#desc' ) )
				    .then( editor => {
				        console.log( editor );
				    } )
				    .catch( error => {
				        console.error( error );
				    } );

				flatpickr('#waktu',
					{
						altInput: true,
						altFormat: "F j, Y",
						dateFormat: "Y-m-d",
					});
				}
			});
	}

	function show(id, nama)
	{
		$.confirm({
			title:'Tunggu Dulu',
			content:'Tampilkan data '+nama+', di halaman depan?',
			autoClose:'nope|5000',
			buttons:{
				yup:{
					text:'iya',
					btnClass:'btn-primary',
					action:function(){

						$.ajax({
							url:'<?php echo base_url() ?>crud/pelatihanStat/Show/'+id,
							type:'post',
							contentType:false,
							processData:false,
							success:function(response){

								if(response == '"done"'){

									loadData();
									toastr.success(nama+' berhasil ditampilkan');
								}else{

									toastr.error('Ada kesalahan');
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

	function ngumpet(id, nama)
	{
		$.confirm({
			title:'Tunggu Dulu',
			content:'Sembunyikan data '+nama+', di halaman depan?',
			autoClose:'nope|5000',
			buttons:{
				yup:{
					text:'iya',
					btnClass:'btn-warning',
					action:function(){

						$.ajax({
							url:'<?php echo base_url() ?>crud/pelatihanStat/Hidden/'+id,
							dataType:'post',
							contentType:false,
							processData:false,
							success:function(response){

								if(response == '"done"'){

									loadData();
									
									toastr.success(nama+' berhasil disembunyikan');
								}else{

									toastr.error('Ada kesalahan');
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

	function tutupForm()
	{
		$('.collapse').collapse('hide');
	}
</script>