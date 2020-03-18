<!DOCTYPE html>
<html>
<head>
	<title>Akun diverifikasi</title>

	<?php $this->load->view('layout/plugin'); ?>
</head>
<body>
	<script type="text/javascript">
		$(document).ready(function(){

			window.onload = $(document).ready(function(){

				swal('Welcome..!','Selamat, akun anda berhasil diverifikasi, segera lengkapi profil anda setelah melakukan login ^^','success').then(function(){

					window.location = '<?php echo base_url() ?>';
				});

			});
		});
	</script>

</body>
</html>