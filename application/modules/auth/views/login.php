<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- BEGIN MANDATORY STYLE -->
<link href="<?php print base_url(); ?>assets/pages/css/login.css" rel="stylesheet" type="text/css" />
<!-- END  MANDATORY STYLE -->
<!-- BEGIN LOGO -->
<div class="logo">
	<!-- <a href="index.html">
	<img src="../../assets/admin/layout3/img/logo-big.png" alt=""/>
	</a> -->
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<?php print form_open('auth/login/validate', 'id="" class="login-form"') ."\r\n"; ?>
	<h3 class="form-title">Sign In</h3>
    <div class="row">
    	<?php
    	if (Settings_model::$db_config['login_enabled'] == 0) { ?>
            <div class="alert alert-danger"><span><?php print $this->lang->line('login_disabled') ?></span></div><?php
        }else{
			$this->load->view('generic/flash_error');
        } ?>
    </div>
    <div class="alert alert-danger display-hide">
		<button class="close" data-close="alert"></button>
		<span>
		Enter any username and password. </span>
	</div>
    <div class="form-group">
    	<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
    	<label class="control-label visible-ie8 visible-ie9">Username</label>
    	<?php print form_input(array('name' => 'username', 'placeholder'=> 'Username', 'id' => 'login_username', 'class' => 'form-control form-control-solid placeholder-no-fix')); ?>
    </div>
    <div class="form-group">
    	<label class="control-label visible-ie8 visible-ie9">Password</label>
		<?php print form_password(array('name' => 'password', 'placeholder'=> 'Password', 'id' => 'login_password', 'class' => 'form-control form-control-solid placeholder-no-fix')); ?>
	</div>
	<div class="form-group">
	  <div class="col-md-10">
		<?php
			if ($this->session->userdata('login_attempts') > 5) {
				print $this->recaptcha->get_html();
			}
			?>
	  </div>
	</div>
	<div class="form-actions">
	  <?php print form_submit(array('name' => 'submit', 'value' => $this->lang->line('login'), 'id' => 'submit', 'class' => 'btn btn-success uppercase')); ?>
	  <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
	</div>
	<div class="login-options"></div>
	
	<?php print form_close() ."\r\n"; ?>

	<!-- BEGIN FORGOT PASSWORD FORM -->
	<?php print form_open('auth/forgot_password/send_password', array('id' => 'password_form', 'class' => 'forget-form')) ."\r\n"; ?>
		<h3>Forget Password ?</h3>
		<p>
			 Enter your e-mail address below to reset your password.
		</p>
		<div class="form-group">
			<?php print form_input(array('name' => 'email', 'id' => 'email', 'class' => 'form-control placeholder-no-fix', 'placeholder' => $this->lang->line('your_email'))); ?>
		</div>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn btn-default">Back</button>
			<?php print form_submit(array('name' => 'forgot_password_submit', 'value' => $this->lang->line('send_password'), 'id' => 'forgot_password_submit1', 'class' => 'btn btn-success uppercase pull-right')); ?>
		</div>
	<?php print form_close() ."\r\n"; ?>
	<!-- END FORGOT PASSWORD FORM -->
</div>
<script src="<?php print base_url(); ?>assets/pages/scripts/login.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() { 
	Login.init();
});
</script>