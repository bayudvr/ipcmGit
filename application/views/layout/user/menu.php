			
		
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
			 	<a href="<?php echo base_url() ?>user" class="nav-link">
			 		<i class="fas fa-fw fa-desktop"></i>
			 		<span>Home</span>
			 	</a>
			 </li>
			 <li class="nav-item active">
			 	<a href="<?php echo base_url() ?>user/profile" class="nav-link">
			 		<i class="fa fa-fw fa-user"></i>
			 		<span>Profile</span>
			 	</a>
			 </li>
			 <li class="nav-item active">
			 	<a href="#" onclick="validacc('vc');" class="nav-link">
			 		<i class="fa fa-fw fa-id-card"></i>
			 		<span>Virtual Card</span>
			 	</a>
			 </li>
			 <li class="nav-item active">
			 	<a href="#" onclick="validacc('mt');" class="nav-link">
			 		<i class="fa fa-fw fa-cogs"></i>
			 		<span>Marketing Tools</span>
			 	</a>
			 </li>
		</ul>