<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Jejaring</title>

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
						<h1 class="h3 mb-0 text-gray-800">Data Jejaring</h1>
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
        
   $(document).on('submit','#myForm',function(e){
        
        e.preventDefault();
        
        $.ajax({
            url:'<?php echo base_url() ?>crud/newTesti',
            type:'post',
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(response){
                
                if(response == '"done"'){
                    
                    swal('','Data jejaring berhasil dimasukkan','success').then(function(){
                        
                        loadData();
                        $('#form').modal('hide');
                    });
                }else{
                    
                    swal('','Ada kesalahan..!','error');
                }
            }
        });
    });
    
    $(document).on('submit','#formEdit',function(e){
        
        e.preventDefault();
        
        $.ajax({
            url:'<?php echo base_url() ?>crud/editTesti',
            type:'post',
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(response){
                
                if(response == '"done"'){
                    
                    swal('','Data jejaring berhasil diubah','success').then(function(){
                        
                        loadData();
                        $('#form').modal('hide');
                    });
                }else{
                    
                    swal('','Ada kesalahan..!','error');
                }
            }
        });
    });
    
    $(document).on('submit','#imgEdit',function(e){
        
        e.preventDefault();
        
        $.ajax({
            url:'<?php echo base_url() ?>crud/editTestiImg',
            type:'post',
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(response){
                
                if(response == '"done"'){
                    
                    swal('','Foto jejaring berhasil diubah','success').then(function(){
                        
                        loadData();
                        $('#form').modal('hide');
                    });
                }else{
                    
                    swal('','Ada kesalahan..!','error');
                }
            }
        });
    });
        
    
    loadData();
    
    
    function loadData(){
        
        $.ajax({
            url:'<?php echo base_url() ?>data/testimoni',
            type:'get',
            dataType:'json',
            success:function(data){
                
                $('#data').html(data);
                $('#tdata').DataTable();
            }
        });
    }
    
    function formCrud(id){
        url1 = '<?php echo base_url() ?>form/';
        if(id != 'baru'){
            
            url1 = url1 + 'editTesti/'+id;
        }else{
            
            url1 = url1 + 'newTesti';
        }
        
        $.ajax({
            url:url1,
            type:'get',
            dataType:'json',
            success:function(data){
                
                $('#form').modal('show');
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
    
    function editImg(id){
        
        $.ajax({
            url:'<?php echo base_url() ?>form/jejaringImg/'+id,
            type:'get',
            dataType:'json',
            success:function(data){
                
                $('#formCrud').html(data);
                
                $('#form').modal('show');
            }
        });
    }
    
    function show(id){
        
        $.confirm({
            title:'Tunjukkan konten?',
            content:'url:<?php echo base_url() ?>data/jejaringInfo/'+id,
            columnClass:'large',
            buttons:{
                
                yup:{
					text:'iya',
					btnClass:'btn-info',
					action:function(){

						$.ajax({
							url:'<?php echo base_url() ?>crud/jejaringStat/Show/'+id,
							type:'get',
							dataType:'json',
							success:function(response){

								if(response == 'done'){

									swal('','Konten berhasil ditampilkan','success').then(function(){

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
    
    function ngumpet(id){
        
        $.confirm({
            title:'Tunjukkan konten?',
            content:'url:<?php echo base_url() ?>data/jejaringInfo/'+id,
            columnClass:'large',
            buttons:{
                
                yup:{
					text:'iya',
					btnClass:'btn-info',
					action:function(){

						$.ajax({
							url:'<?php echo base_url() ?>crud/jejaringStat/Hidden/'+id,
							type:'get',
							dataType:'json',
							success:function(response){

								if(response == 'done'){

									swal('','Konten berhasil disembunyikan','success').then(function(){

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
</script>