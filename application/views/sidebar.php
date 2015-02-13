<?php 
$arrIcon = array("home" => "icon-custom-home",
				"my_profile" => "fa fa-user",
				"school" => "fa fa-shield",
				"student" => "fa fa-user",
				"teacher" => "fa fa-th-large",
				"course" => "fa fa-file-text",
				"attendance" => "fa fa-pencil-square-o",
				"grades" => "fa fa-plus-circle",
				"staff" => "fa fa-users",
				"company" => "fa fa-plus-square",
				"comments" => "fa fa-plus-square",
				"documents" => "fa fa-folder-open",
				"observations" => "fa fa-film",
				"workshop" => "fa fa-wrench",
				"privilege" => "fa fa-thumbs-up",
				"curriculum" => "fa fa-file-text-o",
				"staff_gallery" => "fa fa-camera",
				"pma_scores" => "fa fa-star",
				"management_directory" => "fa fa-sitemap",
				"resignations" => "fa fa-circle-o",
				"blacklisted" => "fa fa-ban",
				"logs" => "fa fa-columns");
$arrMenu = get_rolewise_priviledge();
$controller_name = "";
$controller_name = $this->router->fetch_class(); 
?>
<!-- BEGIN MENU -->

<div class="page-sidebar" id="main-menu">
  <div class="page-sidebar-wrapper" id="main-menu-wrapper">
    <!-- BEGIN MINI-PROFILE -->
    <div class="user-info-wrapper">
      <div class="profile-wrapper">
        <?php 
						$profile_picture = get_profile_pic();
						$profile_picture_75 = $profile_picture[75];
						?>
        <img src="<?php print $profile_picture_75; ?>" alt="" data-src="<?php print $profile_picture_75; ?>" data-src-retina="" width="69" height="69" /> </div>
      <div class="user-info">
        <div class="greeting"><?php echo $this->lang->line('welcome'); ?></div>
        <div class="username"> <?php echo $this->session->userdata('first_name');  ?>
          <?php //echo $this->session->userdata('username');  ?>
        </div>
        <div class="status">Status<a href="#">
          <div class="status-icon green"></div>
          Online</a></div>
        <!--       <div class="status">ELSD ID: <?=$profile_picture['elsd_id'];?></div>
                <div class="status">Job title: <?=$profile_picture['job_title_name'];?></div> -->
      </div>
    </div>
    <!-- END MINI-PROFILE -->
    <!-- BEGIN SIDEBAR MENU -->
    <ul id="nav1">
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
								$current = 'class="active open"';
								$current_open = 'open';
							}
						}
					}
			?>
      <li <?php echo $current; ?>> <a href="<?php if($arrMenu[$key]['parent_id'] == '0'){ print site_url($arrMenu[$key]['controller']); }else{ print '#'; } ?>"> <i class="<?php echo $iconclass;?>"></i> <span class="title"><?php print $this->lang->line($key);?></span>
        <?php 
							if(isset($arrMenu[$key]['sub_menu']) && $arrMenu[$key]['parent_id'] != '0'){ ?>
        <span class="arrow <?php echo $current_open;?>"></span>
        <?php
							} ?>
        </a>
        <?php 
						if(isset($arrMenu[$key]['sub_menu']) && $arrMenu[$key]['parent_id'] != '0'){ ?>
        <ul class="sub-menu">
          <?php
								foreach ($arrMenu[$key]['sub_menu'] as $key1 => $val1){ 
									foreach ($val1 as $key2 => $val2){ 
										$current = "";
										if($controller_name == $key2)
										{
											$current = 'class="active"';
										}										
									?>
          <li <?php echo $current;?>><a href="<?php print site_url($key2); ?>"><?php print $this->lang->line($val2);?></a></li>
          <?php
									} 
								} ?>
        </ul>
        <?php
						} ?>
      </li>
      <?php
				}
			} 
			?>
      <li> <a href="http://pyd.ksu.edu.sa/elsdblog/" target="_blank"> <i class="fa fa-list-ol"></i> <span class="title">EdTech Blog</span> </a> </li>
      <li> <a href="http://www.elsdportal.net/support" target="_blank"> <i class="fa fa-tags"></i> <span class="title">Support</span> </a> </li>
      <?
if($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 5 ||
	$this->session->userdata('role_id') == 6 || $this->session->userdata('role_id') == 7)
{	
?>
      <li> <a href="http://elsdportal.net/support/scp" target="_blank"> <i class="fa fa-tags"></i> <span class="title">Support Ticket Admin</span> </a> </li>
      <?
}
?>
    </ul>
    <div class="side-bar-widgets">
      <p class="menu-title"></p>
    </div>
    <div class="clearfix"></div>
    <!-- END SIDEBAR MENU -->
  </div>
</div>
<!-- BEGIN SCROLL UP HOVER -->
<a href="#" class="scrollup">Scroll</a>
<!-- END SCROLL UP HOVER -->
<!-- END MENU -->
<!-- BEGIN SIDEBAR FOOTER WIDGET -->
<div class="footer-widget">
  <div class="pull-right"> <a href="<?php print site_url('auth/logout'); ?>" title="<?php echo $this->lang->line('logout'); ?>"><i class="fa fa-power-off"></i></a> </div>
</div>
<!-- END SIDEBAR FOOTER WIDGET -->
