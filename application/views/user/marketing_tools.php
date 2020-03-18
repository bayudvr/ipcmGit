<!DOCTYPE html>
<html>
<head>
	<title>Marketing Tools</title>

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
						<h1 class="h3 mb-0 text-gray-800">Marketing Tools</h1>
					</div>

					<div class="mb-5">
						<form method="POST" id="myForm">
							<input type="text" name="cari" id="cari" placeholder="Input nama tool" class="form-control col-md-4" autofocus>
						</form>
					</div>

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div id="data"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	loadData();

	$(document).on('keyup','#cari',function(e){

		e.preventDefault();

		var key = $('#cari').val();

		if(key != ''){

			$.ajax({
				url:'<?php echo base_url() ?>data/search_marketing/'+key,
				type:'get',
				dataType:'json',
				success:function(data){

					$('#data').html(data);
				}
			});
		}else{

			loadData();
		}
	});

	function loadData(){

		$.ajax({
			url:'<?php echo base_url() ?>data/user_marketing',
			type:'get',
			dataType:'json',
			success:function(data){

				$('#data').html(data);
			}
		});
	}

	function lihat(id){

		$.confirm({
			title:'Banner',
			content:'url: <?php echo base_url() ?>data/bannerMarketing/'+id
		});
	}

	function unduh(id){

		$.ajax({
			url:'<?php echo base_url() ?>data/unduhan/'+id,
			type:'get',
			dataType:'json',
			success:function(data){

				window.open(data,'_blank');
			}
		});
	}
</script>