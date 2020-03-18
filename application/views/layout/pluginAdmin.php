	<meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="kamleshyadav">
    <meta name="MobileOptimized" content="320">

	<link rel="shortcut icon" type="text/css" href="<?php echo base_url() ?>assets/img/logo.png">
	
	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url() ?>assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

	<!-- Custom styles for this template-->
	<link href="<?php echo base_url() ?>assets/admin/css/sb-admin-2.min.css" rel="stylesheet">

	<link href="<?php echo base_url() ?>assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	<!-- Include Editor style. -->
	<link href='https://cdn.jsdelivr.net/npm/froala-editor@3.1.0/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/admin/css/toastr.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/admin/css/flatpickr.min.css">
	<link href='https://api.mapbox.com/mapbox-gl-js/v1.8.0/mapbox-gl.css' rel='stylesheet' />

	<style type="text/css" media="screen">
		body{

			color:#000000;
		}
	</style>

	<!-- Bootstrap core JavaScript-->
	<script src="<?php echo base_url() ?>assets/admin/vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?php echo base_url() ?>assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?php echo base_url() ?>assets/admin/js/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="<?php echo base_url() ?>assets/admin/vendor/chart.js/Chart.min.js"></script>

	<!-- Page level plugins -->
	<script src="<?php echo base_url() ?>assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url() ?>assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

	<!-- Page level custom scripts -->
	<script src="<?php echo base_url() ?>assets/admin/js/demo/datatables-demo.js"></script>
	<script src="<?php echo base_url() ?>assets/admin/js/html2canvas.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
	<!-- Include JS file. -->
	<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@3.1.0/js/froala_editor.pkgd.min.js'></script>
	<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/toastr.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/flatpickr.js"></script>
	<script src='https://api.mapbox.com/mapbox-gl-js/v1.8.0/mapbox-gl.js'></script>

	<script type="text/javascript">
		
		function logout(){

			$.confirm({
				title:'Tunggu Dulu...!',
				content:'Ingin Log Out?',
				autoClose:'nope|5000',
				buttons:{
					yakin:{
						btnClass:'btn btn-danger',
						action:function(){

							window.location = '<?php echo base_url() ?>login/done';
						}
					},
					nope:{
						text:'tidak',
						btnClass:'btn btn-success'
					}
				}
			});
		}

		function validacc(id){

			$.ajax({
				url:'<?php echo base_url() ?>crud/cek_akun',
				type:'post',
				contentType:false,
				processData:false,
				success:function(response){

					if(response == '"done"'){

						if(id == 'vc'){

							window.location = '<?php echo base_url() ?>user/virtual_card';
						}else if(id == 'mt'){

							window.location = '<?php echo base_url() ?>user/marketing_tools';
						}
					}else{

						swal('STOP!','Akun anda belum diapprove oleh admin, pastikan profil anda sudah diisi dengan benar, dan tunggu email approve dari admin','error');
					}
				}
			});
		}
	</script>