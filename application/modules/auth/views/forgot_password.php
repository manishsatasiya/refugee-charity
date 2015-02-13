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
<!-- BEGIN PASSWORD BOX -->
<div class="content">
                   
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
            <?php print form_submit(array('name' => 'forgot_password_submit', 'value' => $this->lang->line('send_password'), 'id' => 'forgot_password_submit', 'class' => 'btn btn-success uppercase pull-right')); ?>
        </div>
    <?php print form_close() ."\r\n"; ?>
    <!-- END FORGOT PASSWORD FORM -->
    <div class="login-links">
        <a href="<?php print base_url(); ?>">Already have an account?  <strong><?php print $this->lang->line('login'); ?></strong></a>
    </div>
</div>
<!-- END PASSWORD BOX -->