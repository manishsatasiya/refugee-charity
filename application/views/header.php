<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
?>
<!-- BEGIN HEADER -->
<div class="page-header">
	<!-- BEGIN HEADER TOP -->
	<div class="page-header-top">
		<div class="container-fluid">
			<!-- BEGIN LOGO -->
			<div class="page-logo">
				<a href="<?php print base_url(); ?>"><img src="<?php print base_url(); ?>assets/img/logo-default.png" alt="logo" class="logo-default"></a>
			</div>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="menu-toggler"></a>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<?php 
						$profile_picture = get_profile_pic();
						$profile_picture_40 = $profile_picture[40];
						?>

						<img alt="" class="img-circle" src="<?php print $profile_picture_40; ?>">
						<span class="username username-hide-mobile"><?php echo $this->session->userdata('first_name');  ?></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a href="<?php print site_url('profile/'.encrypt_decrypt('e', $this->session->userdata('user_id'))); ?>">
								<i class="icon-user"></i> My Profile </a>
							</li>
							<li>
								<a href="<?php print site_url('auth/logout'); ?>">
								<i class="icon-key"></i> <?php echo $this->lang->line('logout'); ?> </a>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
	</div>
	<!-- END HEADER TOP -->
	<!-- BEGIN HEADER MENU -->
	<div class="page-header-menu">
		<div class="container-fluid">
			<!-- BEGIN HEADER SEARCH BOX -->
			<!-- <form class="search-form" action="extra_search.html" method="GET">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search" name="query">
					<span class="input-group-btn">
					<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
					</span>
				</div>
			</form> -->
			<!-- END HEADER SEARCH BOX -->
			<!-- BEGIN MEGA MENU -->
			<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
			<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
			<?php 
			$arrIcon = array("home" => "fa fa-home",
							"my_profile" => "fa fa-user");
			$arrMenu = get_rolewise_priviledge();
			$controller_name = "";
			$controller_name = $this->router->fetch_class(); 
			?>
			<div class="hor-menu ">
				<ul class="nav navbar-nav">
		      		<?php 
					if($arrMenu){
						foreach ($arrMenu as $key => $val){
						$iconclass = "";
							if(array_key_exists($key,$arrIcon))
								$iconclass = $arrIcon[$key];
							$current = '';
							$current_open = '';
							foreach ($arrMenu[$key]['sub_menu'] as $key1 => $val1){
								foreach ($val1 as $key2 => $val2){
									if($controller_name == $key2){
										$current = 'class="active"';
										$current_open = 'open';
									}
								}
							}
					?>
						    <li <?php echo $current; ?>>
						    	<a href="<?php if($arrMenu[$key]['parent_id'] == '0'){ print site_url($arrMenu[$key]['controller']); }else{ print 'javascript:;'; } ?>" <?php if($arrMenu[$key]['parent_id'] != '0'){ echo 'data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown"'; }?>> <i class="<?php echo $iconclass;?>"></i> <?php print $this->lang->line($key);?>
						        <?php if(isset($arrMenu[$key]['sub_menu']) && $arrMenu[$key]['parent_id'] != '0'){ ?>
						        	<i class="fa fa-angle-down"></i>
						        <?php } ?>
						        </a>
						        <?php 
						        if(isset($arrMenu[$key]['sub_menu']) && $arrMenu[$key]['parent_id'] != '0'){ ?>
						        <ul class="dropdown-menu pull-left">
						          <?php
									foreach ($arrMenu[$key]['sub_menu'] as $key1 => $val1){ 
										foreach ($val1 as $key2 => $val2){ 
											$current = "";
											if($controller_name == $key2)
											{
												$current = 'class="active"';
											}										
										?>
							          	<li <?php echo $current;?>><a href="<?php print site_url($key2); ?>"><i class="<?php echo $iconclass;?>"></i><?php print $this->lang->line($val2);?></a></li>
							          <?php
										} 
									} ?>
						        </ul>
						        <?php
								} ?>
						      </li>
						      <?php
						}
					}?>
				</ul>
			</div>
			<!-- END MEGA MENU -->
		</div>
	</div>
	<!-- END HEADER MENU -->
</div>
<!-- END HEADER -->