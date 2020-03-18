			
		
		<ul class="navbar-nav bg-gradient-light sidebar sidebar-light shadow accordion" id="accordionSidebar">
			
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url() ?>admin">
				<div class="sidebar-brand-text">
					<img src="<?php echo base_url() ?>assets/img/logo.png" width="65" height="65" alt="">
				</div>
			 </a>

			 <hr class="sidebar-divider my-0">

			 <hr class="sidebar-divider">

			 <div class="sidebar-heading">Menu</div>

			 <li class="nav-item active">
			 	<a href="<?php echo base_url() ?>admin" class="nav-link">
			 		<i class="fas fa-fw fa-desktop"></i>
			 		<span>Dashboard</span>
			 	</a>
			 </li>
			 <li class="nav-item active">
			 	<a href="#" class="nav-link collapsed" data-toggle="collapse" data-target="#menu-regis">
			 		<i class="fa fa-fw fa-database"></i>
			 		<span>Data User</span>
			 	</a>
			 	<div id="menu-regis" class="collapse" data-parent="#accordionSidebar">
			 		<div class="bg-white py-2 collapse-inner rounded">
			 			<h6 class="collapse-header">Menu Data</h6>
			 			<a href="<?php echo base_url() ?>admin/anggota" class="collapse-item">Calon Anggota IPC</a>
			 			<a href="<?php echo base_url() ?>admin/member" class="collapse-item">Anggota IPC</a>
			 		</div>
			 	</div>
			 </li>
			 <li class="nav-item active">
			 	<a href="#" class="nav-link collapsed" data-toggle="collapse" data-target="#manage">
			 		<i class="fa fa-fw fa-cog"></i>
			 		<span>Manage</span>
			 	</a>
			 	<div id="manage" class="collapse" data-parent="#accordionSidebar">
			 		<div class="bg-white py-2 collapse-inner rounded">
			 			<h6 class="collapse-header">Menu Manage</h6>
			 			<a href="<?php echo base_url() ?>admin/profil" class="collapse-item">Profil</a>
			 			<a href="<?php echo base_url() ?>admin/marketing_tools" class="collapse-item">Marketing Tools</a>
			 		</div>
			 	</div>
			 </li>
			 <li class="nav-item active">
			 	<a href="#" class="nav-link collapsed" data-toggle="collapse" data-target="#fe">
			 		<i class="fa fa-fw fa-columns"></i>
			 		<span>Front End</span>
			 	</a>
			 	<div id="fe" class="collapse" data-parent="#accordionSidebar">
			 		<div class="bg-white py-2 collapse-inner rounded">
			 			<h6 class="collapse-header">Menu Manage</h6>
			 			<a href="<?php echo base_url() ?>admin/slider" class="collapse-item">Slider</a>
			 			<a href="<?php echo base_url() ?>admin/about" class="collapse-item">IPC Profile</a>
			 			<a href="<?php echo base_url() ?>admin/produk" class="collapse-item">Produk</a>
			 			<a href="<?php echo base_url() ?>admin/keunggulan" class="collapse-item">Keunggulan</a>
			 			<a href="<?php echo base_url() ?>admin/pelatihan" class="collapse-item">Pelatihan</a>
			 			<a href="<?php echo base_url() ?>admin/galeri" class="collapse-item">Galeri</a>
			 			<a href="<?php echo base_url() ?>admin/jejaring" class="collapse-item">Jejaring</a>
			 			<a href="<?php echo base_url() ?>admin/artikel" class="collapse-item">Artikel</a>
			 			<a href="<?php echo base_url() ?>admin/tim" class="collapse-item">Tim</a>
			 			<a href="<?php echo base_url() ?>admin/partner" class="collapse-item">Partner</a>
			 			<a href="<?php echo base_url() ?>admin/footer" class="collapse-item">Footer</a>
			 		</div>
			 	</div>
			 </li>
		</ul>