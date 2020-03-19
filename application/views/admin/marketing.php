<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Marketing Tools</title>

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
						<h1 class="h3 mb-0 text-gray-800">Marketing Tools</h1>
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

    loadData();
    
    $(document).on('submit','#myForm',function(e){
       
       e.preventDefault();
       
       $.ajax({
           url:'<?php echo base_url() ?>crud/newMarket',
           type:'post',
           data: new FormData(this),
           contentType:false,
           processData:false,
           success:function(response){
               
               if(response == '"done"'){
                   
                   swal('','Item berhasil ditambahkan','success').then(function(){
                        
                        loadData();
                        $('#form').modal('hide');
                   });
               }else{
                   
                   swal('','Ada kesalahan..!','error');
               }
           }
       });
    });
    
    $(document).on('submit','#editForm',function(e){
       
       e.preventDefault();
       
       $.ajax({
           url:'<?php echo base_url() ?>crud/editMarket',
           type:'post',
           data: new FormData(this),
           contentType:false,
           processData:false,
           success:function(response){
               
               if(response == '"done"'){
                   
                   swal('','Item berhasil diubah','success').then(function(){
                        
                        loadData();
                        $('#form').modal('hide');
                   });
               }else{
                   
                   swal('','Ada kesalahan..!','error');
               }
           }
       });
    });

    $(document).on('submit','#editBanner',function(e){

      e.preventDefault();

      $.ajax({
        url:'<?php echo base_url() ?>crud/editBanner',
        type:'post',
        data: new FormData(this),
        contentType:false,
        processData:false,
        success:function(response){

          if(response == '"done"'){

            swal('','Banner berhasil diubah','success').then(function(){

              loadData();
              $('#form').modal('hide');
            });
          }else{

            swal('','Ada kesalahan','error');

            $('#savebtn').attr('disabled',true);
            $('#banner').val('');
          }
        }
      });
    });

    $(document).on('submit','#editAttach',function(e){

      e.preventDefault();

      $('#savebtn').attr('disabled',true);

      $.ajax({
        url:'<?php echo base_url() ?>crud/editAttach',
        type:'post',
        data: new FormData(this),
        contentType:false,
        processData:false,
        success:function(response){

          if(response == '"done"'){

            swal('','Attachment berhasil diubah','success').then(function(){

              loadData();
              $('#form').modal('hide');
            });
          }else{

            swal('','Ada kesalahan','error');

            $('#savebtn').attr('disabled',true);
            $('#attach').val('');
          }
        }
      });
    });
    
    function loadData(){
        
        $.ajax({
           url:'<?php echo base_url() ?>data/marketing',
           type:'get',
           dataType:'json',
           success:function(data){
               
               $('#data').html(data);
               $('#tdata').DataTable();
               toastr.success('Data berhasil ditampilkan');
           }
        });
    }
    
    function formCrud(id){
        
        url1 = '<?php echo base_url() ?>form/';
        
        if(id != 'baru'){
            
            url1 = url1 + 'editMarket/'+id;
        }else{
            
            url1 = url1 + 'newMarket';
        }
        
        $.ajax({
            url:url1,
            data:'get',
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
				
                $('#form').modal('show');
            }
        });
    }

    function show(id){

      $.confirm({
        title:'Tunggu Dulu',
        content:'Tampilkan Data Marketing?',
        autoClose:'nope|5000',
        columnClass:'large',
        buttons:{
          yup:{
            text:'ok',
            btnClass:'btn-info',
            action:function(){
              $.ajax({
                url:'<?php echo base_url() ?>crud/marketingStat/Show/'+id,
                type:'post',
                contentType:false,
                processData:false,
                success:function(response){
                  if(response == '"done"'){
                    toastr.success('Data berhasil diaktifkan');
                    loadData();
                  }else{

                    swal('','Ada kesalahan','error');
                  }
                }
              });
            }
          },
          nope:{
            text:'tidak',
            btnClass:'btn-dark'
          }
        }
      });
    }

    function ngumpet(id){

      $.confirm({
        title:'Tunggu Dulu',
        content:'Sembunyikan Data Marketing?',
        autoClose:'nope|5000',
        columnClass:'large',
        buttons:{
          yup:{
            text:'ok',
            btnClass:'btn-info',
            action:function(){
              $.ajax({
                url:'<?php echo base_url() ?>crud/marketingStat/Hidden/'+id,
                type:'post',
                contentType:false,
                processData:false,
                success:function(response){
                  if(response == '"done"'){
                    toastr.success('Data berhasil disembunyikan');
                    loadData();
                  }else{

                    swal('','Ada kesalahan','error');
                  }
                }
              });
            }
          },
          nope:{
            text:'tidak',
            btnClass:'btn-dark'
          }
        }
      });
    }

    function ubahAttach(id){

      $.ajax({
        url:'<?php echo base_url() ?>form/attachEdit/'+id,
        type:'get',
        dataType:'json',
        success:function(data){

          $('#formCrud').html(data);
          $('#form').modal('show');
        }
      });
    }

    function ubahBanner(id){

      $.ajax({
        url:'<?php echo base_url() ?>form/bannerEdit/'+id,
        type:'get',
        dataType:'json',
        success:function(data){

          $('#formCrud').html(data);
          $('#form').modal('show');
        }
      });
    }

  function cekBanner(){

    var ext = $('#banner').val().split('.').pop().toLowerCase();

    if(jQuery.inArray(ext, ['jpg','png','jpeg']) == -1){
      swal('','Fomat Foto Harus JPG/PNG/JPEG','error');
      $('#banner').val('');

      $('#savebtn').attr('disabled',true);
    }else{

      $('#savebtn').attr('disabled',false);
    }
  }

  function cekAttach(){

    var ext = $('#attach').val().split('.').pop().toLowerCase();

    if(jQuery.inArray(ext, ['zip','rar','7z','cdr']) == -1){
      swal('','Fomat File Harus ZIP/RAR/7z/Cdr','error');
      $('#attach').val('');

      $('#savebtn').attr('disabled',true);
    }else{

      $('#savebtn').attr('disabled',false);
    }
  }
</script>