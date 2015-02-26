<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<link href="<?php print base_url(); ?>assets/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php print base_url(); ?>js/jquery.form.js"></script>
<div class="row">
  <div class="col-md-12"><?php $this->load->view('generic/flash_error'); ?></div>
</div>
<div class="row margin-top-10">
  <div class="col-md-12">
    <!-- BEGIN PROFILE SIDEBAR -->
    <div class="profile-sidebar" style="width: 250px;">
      <!-- PORTLET MAIN -->
      <div class="portlet light profile-sidebar-portlet">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
          <img src="<?php echo $profile_picture;?>" class="img-responsive" alt="">
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
          <div class="profile-usertitle-name">
             <?php echo $user_data->first_name.' '.$user_data->last_name; ?>
          </div>
          <div class="profile-usertitle-job"> </div>
        </div>
        <!-- END SIDEBAR USER TITLE -->
        <!-- SIDEBAR BUTTONS -->
       
        <!-- END SIDEBAR BUTTONS -->
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu"></div>
        <!-- END MENU -->
      </div>
      <!-- END PORTLET MAIN -->
      
    </div>
    <!-- END BEGIN PROFILE SIDEBAR -->
    <!-- BEGIN PROFILE CONTENT -->
    <div class="profile-content">
      <div class="row">
        <div class="col-md-12">
          <div class="portlet light">
            <div class="portlet-title tabbable-line">
              <div class="caption caption-md">
                <i class="icon-globe theme-font hide"></i>
                <span class="caption-subject font-blue-madison bold uppercase"><?php print $this->lang->line('profile_page_heading'); ?></span>
              </div>
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#tab_1_1" data-toggle="tab"><?php print $this->lang->line('personal_info'); ?></a>
                </li>
                <li>
                  <a href="#tab_1_2" data-toggle="tab"><?php print $this->lang->line('pro_p_change_pic'); ?></a>
                </li>
                <li>
                  <a href="#tab_1_3" data-toggle="tab"><?php print $this->lang->line('change_password'); ?></a>
                </li>
              </ul>
            </div>
            <div class="portlet-body">
              <div class="tab-content">
                <!-- PERSONAL INFO TAB -->
                <div class="tab-pane active" id="tab_1_1">
                  <?php print form_open('profile/update_account', array('id' => 'profile_form','class' => 'form-no-horizontal-spacing')) ."\r\n"; ?>
                  <div class="containerfdfdf"></div>                  
                  <div class="row form-row">
                    <div class="col-md-6 form-group">
                        <div class="form_label2">
                            <?php print form_label($this->lang->line('user_p_first_name'), 'reg_first_name'); ?>
                        </div>
                        <div class="input_box_thin"><?php print form_input(array('name' => 'first_name', 'id' => 'reg_first_name', 'value' => ($user_data) ? $user_data->first_name : $this->session->flashdata('first_name'), 'class' => 'form-control qtip_first_name')); ?></div>
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <div class="form_label2">
                            <?php print form_label($this->lang->line('user_p_last_name'), 'reg_last_name'); ?>
                        </div>
                        <div class="input_box_thin"><?php print form_input(array('name' => 'last_name', 'id' => 'reg_last_name', 'value' => ($user_data) ? $user_data->last_name : $this->session->flashdata('last_name'), 'class' => 'form-control qtip_first_name')); ?></div>
                    </div>
                    <div class="clear"></div>
                  </div>
                  
                  <div class="row form-row">
                    
                    <div class="col-md-6 form-group">
                      <div class="form_label2"><?php print form_label($this->lang->line('user_p_email_address'), 'reg_email'); ?></div>
                      <div class="input_box_thin"><?php print form_input(array('name' => 'email', 'id' => 'reg_email', 'value' => ($user_data)?$user_data->email:$this->session->flashdata('email'), 'class' => 'form-control qtip_email', 'readonly' => 'readonly')); ?></div>
                    </div>
                    <div class="col-md-6 form-group">
                      <div class="form_label2"><?php print form_label($this->lang->line('user_p_cell_phone'), 'reg_cell_phone'); ?></div>
                      <div class="input_box_thin"><?php print form_input(array('name' => 'cell_phone', 'id' => 'reg_cell_phone', 'value' => ($user_data)?$user_data->cell_phone:$this->session->flashdata('cell_phone'), 'class' => 'form-control qtip_cell_phone')); ?></div>
                    </div>
                            
                    <div class="clear"></div>
                  </div>

                  <div class="row form-row">
                    <div class="col-md-6 form-group">
                      <div class="form_label2"><?php print form_label('gender', 'gender'); ?></div>
                      <div class="input_box_thin"><?php  
                        print form_dropdown('gender',array('M'=>'Male','F'=>'Female'),($user_data)?$user_data->gender:'0','id="gender" class="form-control"');  ?>
                            </div>
                    </div>
                    
                    <div class="col-md-3 form-group">
                            <?php print form_label($this->lang->line('user_p_birth_date'), 'birth_date',array('class'=>'control-label')); ?>
                            <div class="input-group date date-picker" data-date="<?php echo ($user_data)?date("d-m-Y",strtotime($user_data->birth_date)):''?>" data-date-format="D, dd M yyyy" data-date-viewmode="">
                                <?php print form_input(array('name' => 'birth_date', 'id' => 'birth_date', 'value' => ($user_data)?make_dp_date($user_data->birth_date):$this->session->flashdata('birth_date'), 'class' => 'form-control', 'readonly' => 'readonly')); ?>
                                <span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                            </div>
                    </div>

                    <div class="clear"></div>
                  </div>

                  <div class="row form-row">
                    <div class="col-md-12 form-group">
                            <div class="form_label2"><?php print form_label('Address', 'address1'); ?></div>
                            <div class="">  
                                <?php print form_input(array('name' => 'address1', 'id' => 'address1', 'value' => ($user_data) ? $user_data->address1 : $this->session->flashdata('address1'), 'class' => 'form-control')); ?>

                            </div>
                        </div>
                    <div class="col-md-6 form-group">
                            <div class="form_label2"><?php print form_label('city', 'city'); ?></div>
                            <div class="">  
                                <?php print form_input(array('name' => 'city', 'id' => 'city', 'value' => ($user_data) ? $user_data->city : $this->session->flashdata('city'), 'class' => 'form-control')); ?>

                            </div>
                        </div>
                        
                        <div class="col-md-6 form-group">
                            <div class="form_label2"><?php print form_label('state', 'state'); ?></div>
                            <div class="">  
                                <?php print form_input(array('name' => 'state', 'id' => 'state', 'value' => ($user_data) ? $user_data->state : $this->session->flashdata('state'), 'class' => 'form-control')); ?>

                            </div>
                        </div>
                    <div class="clear"></div>
                  </div>
                  <div class="row form-row">
                    
                    <div class="col-md-6 form-group">
                            <div class="form_label2"><?php print form_label('country', 'country'); ?></div>
                            <div class="">  
                                <?php print form_input(array('name' => 'country', 'id' => 'country', 'value' => ($user_data) ? $user_data->country : $this->session->flashdata('country'), 'class' => 'form-control')); ?>

                            </div>
                        </div>
                        
                        <div class="col-md-6 form-group">
                            <div class="form_label2"><?php print form_label('zip', 'zip'); ?></div>
                            <div class="">  
                                <?php print form_input(array('name' => 'zip', 'id' => 'zip', 'value' => ($user_data) ? $user_data->zip : $this->session->flashdata('zip'), 'class' => 'form-control')); ?>

                            </div>
                        </div>
                    <div class="clear"></div>
                  </div>
                  
                  <div class="margiv-top-10">
                    <?php print form_hidden('user_id', $user_id); ?>
                    <input type="submit" name="submit" value="<?php echo $this->lang->line('submit');?>" class="btn green">
                  </div>
                  <?php print form_close(); ?>
                </div>
                <!-- END PERSONAL INFO TAB -->
                <!-- CHANGE AVATAR TAB -->
                <div class="tab-pane" id="tab_1_2">
                  <?php
                  print form_open('profile/upload_profile_pic', array('id' => 'uploadpic_form')) ."\r\n";
                    print form_upload(array('name' => 'uploadpic', 'id' => 'uploadpic', 'value' => '', 'onchange'=>'previewUploadImg(this)', 'style'=>'display:none;'));
                  print form_close(); ?>
                  <div class="form-group">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                        <img src="<?php echo $profile_picture; ?>" width="150" height="150" id="previewimg"/>
                      </div>
                      <a href="javascript:void(0)" class="btn default btn-file" onclick="changepic();"><?php print $this->lang->line('pro_p_change_pic'); ?></a>
                    </div>
                  </div>
                </div>
                <!-- END CHANGE AVATAR TAB -->
                <!-- CHANGE PASSWORD TAB -->
                <div class="tab-pane" id="tab_1_3">
                  <div class="row form-row">
                  <div class="col-md-6">
                  <?php print form_open('profile/update_password', array('id' => 'profile_pwd_form', 'class' => 'membership_form')) ."\r\n"; ?>
                    <div class="form-group">
                      <?php print form_label($this->lang->line('current_password'), 'form-label'); ?>
                      <?php print form_password(array('name' => 'current_password', 'id' => 'current_password', 'class' => 'form-control')); ?>
                    </div>
                    <div class="form-group">
                      <?php print form_label($this->lang->line('new_password'), 'profile_new_password'); ?>
                      <?php print form_password(array('name' => 'new_password', 'id' => 'profile_new_password', 'class' => 'form-control')); ?>
                    </div>
                    <div class="form-group">
                      <?php print form_label($this->lang->line('new_password_again'), 'new_password_again'); ?>
                      <?php print form_password(array('name' => 'new_password_again', 'id' => 'new_password_again', 'class' => 'form-control')); ?>
                    </div>
                    <div class="margin-top-10">
                      <?php print form_hidden('user_id', $user_id); ?>
                      <?php print form_submit(array('name' => 'submit', 'value' => $this->lang->line('update_password'), 'id' => 'submit', 'class' => 'btn btn-success btn-cons')); ?>
                    </div>
                   <?php print form_close() ."\r\n"; ?> 
                   </div>
                   </div>
                   <div class="clear"></div>
                </div>
                <!-- END CHANGE PASSWORD TAB -->
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END PROFILE CONTENT -->
  </div>
</div>