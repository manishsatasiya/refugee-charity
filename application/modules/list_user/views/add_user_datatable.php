<script type="text/javascript" src="<?php print base_url(); ?>js/jquery.form.js"></script>
<script type="text/javascript" src="<?php print base_url(); ?>js/validation.js"></script>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
print form_open('list_user/add/'.$id, array('id' => 'add_user_form_datatable','name'=>'formmain')) ."\r\n";
?>
<div class="modal-header">
  <h2><?php if(!$id){ echo $this->lang->line('user_p_add_user'); }else{ echo $this->lang->line('user_p_edit_user'); } ?></h2>
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button><br />
</div>
<div class="modal-body">
	<?php $this->load->view('generic/flash_error'); ?>
	<div class="containerfdfdf"></div>
	
    <div class="row form-row">
        <div class="col-md-6 form-group">
            <div class="form_label2">
                <?php print form_label($this->lang->line('user_p_first_name'), 'reg_first_name'); ?>
            </div>
            <div class="input_box_thin"><?php print form_input(array('name' => 'first_name', 'id' => 'reg_first_name', 'value' => ($rowdata) ? $rowdata->first_name : $this->session->flashdata('first_name'), 'class' => 'form-control qtip_first_name')); ?></div>
        </div>
        
        <div class="col-md-6 form-group">
            <div class="form_label2">
                <?php print form_label($this->lang->line('user_p_last_name'), 'reg_last_name'); ?>
            </div>
            <div class="input_box_thin"><?php print form_input(array('name' => 'last_name', 'id' => 'reg_last_name', 'value' => ($rowdata) ? $rowdata->last_name : $this->session->flashdata('last_name'), 'class' => 'form-control qtip_first_name')); ?></div>
        </div>
        <div class="clear"></div>
    </div>
	
	<div class="row form-row">
		
		<div class="col-md-6 form-group">
			<div class="form_label2"><?php print form_label($this->lang->line('user_p_email_address'), 'reg_email'); ?></div>
			<div class="input_box_thin"><?php print form_input(array('name' => 'email', 'id' => 'reg_email', 'value' => ($rowdata)?$rowdata->email:$this->session->flashdata('email'), 'class' => 'form-control qtip_email')); ?></div>
		</div>
		<div class="col-md-6 form-group">
			<div class="form_label2"><?php print form_label($this->lang->line('user_p_cell_phone'), 'reg_cell_phone'); ?></div>
			<div class="input_box_thin"><?php print form_input(array('name' => 'cell_phone', 'id' => 'reg_cell_phone', 'value' => ($rowdata)?$rowdata->cell_phone:$this->session->flashdata('cell_phone'), 'class' => 'form-control qtip_cell_phone')); ?></div>
		</div>
            
		<div class="clear"></div>
	</div>

	<div class="row form-row">
		<div class="col-md-4 form-group">
			<div class="form_label2"><?php print form_label($this->lang->line('user_p_role'), 'reg_user_roll_id'); ?></div>
			<div class="input_box_thin"><?php  
				print form_dropdown('user_roll_id',$other_user_roll,($rowdata)?$rowdata->user_roll_id:'0','id="reg_user_roll_id" class="form-control"');	?>
            </div>
		</div>

		<div class="col-md-3 form-group">
			<div class="form_label2"><?php print form_label('gender', 'gender'); ?></div>
			<div class="input_box_thin"><?php  
				print form_dropdown('gender',array('M'=>'Male','F'=>'Female'),($rowdata)?$rowdata->gender:'0','id="gender" class="form-control"');	?>
            </div>
		</div>
		
		<div class="col-md-5 form-group">
            <?php print form_label($this->lang->line('user_p_birth_date'), 'birth_date',array('class'=>'control-label')); ?>
            <div class="input-group date date-picker" data-date="<?php echo ($rowdata)?date("d-m-Y",strtotime($rowdata->birth_date)):''?>" data-date-format="D, dd M yyyy" data-date-viewmode="">
                <?php print form_input(array('name' => 'birth_date', 'id' => 'birth_date', 'value' => ($rowdata)?make_dp_date($rowdata->birth_date):$this->session->flashdata('birth_date'), 'class' => 'form-control', 'readonly' => 'readonly')); ?>
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
                <?php print form_input(array('name' => 'address1', 'id' => 'address1', 'value' => ($rowdata) ? $rowdata->address1 : $this->session->flashdata('address1'), 'class' => 'form-control')); ?>

            </div>
        </div>
		<div class="col-md-6 form-group">
            <div class="form_label2"><?php print form_label('city', 'city'); ?></div>
            <div class="">	
                <?php print form_input(array('name' => 'city', 'id' => 'city', 'value' => ($rowdata) ? $rowdata->city : $this->session->flashdata('city'), 'class' => 'form-control')); ?>

            </div>
        </div>
        
        <div class="col-md-6 form-group">
            <div class="form_label2"><?php print form_label('state', 'state'); ?></div>
            <div class="">	
                <?php print form_input(array('name' => 'state', 'id' => 'state', 'value' => ($rowdata) ? $rowdata->state : $this->session->flashdata('state'), 'class' => 'form-control')); ?>

            </div>
        </div>
		<div class="clear"></div>
	</div>
	<div class="row form-row">
		
		<div class="col-md-6 form-group">
            <div class="form_label2"><?php print form_label('country', 'country'); ?></div>
            <div class="">	
                <?php print form_input(array('name' => 'country', 'id' => 'country', 'value' => ($rowdata) ? $rowdata->country : $this->session->flashdata('country'), 'class' => 'form-control')); ?>

            </div>
        </div>
        
        <div class="col-md-6 form-group">
            <div class="form_label2"><?php print form_label('zip', 'zip'); ?></div>
            <div class="">	
                <?php print form_input(array('name' => 'zip', 'id' => 'zip', 'value' => ($rowdata) ? $rowdata->zip : $this->session->flashdata('zip'), 'class' => 'form-control')); ?>

            </div>
        </div>
		<div class="clear"></div>
	</div>
	
	<div class="row form-row">
		<div class="col-md-4 form-group">
			<div class="form_label2"><?php print form_label($this->lang->line('user_p_username'), 'reg_username'); ?></div>
			<div class="input_box_thin"><?php print form_input(array('name' => 'username', 'id' => 'reg_username', 'value' => ($rowdata)?$rowdata->username:$this->session->flashdata('username'), 'class' => 'form-control qtip_username', 'readonly' => 'readonly')); ?></div>
		</div>
		<div class="col-md-4 form-group">
			<div class="form_label2"><?php print form_label($this->lang->line('user_p_password'), 'reg_password'); ?></div>
			<div class="input_box_thin"><?php print form_password(array('name' => 'password', 'id' => 'reg_password', 'class' => 'form-control qtip_password')); ?></div>
		</div>
		<div class="col-md-4 form-group">
			<div class="form_label2"><?php print form_label($this->lang->line('user_p_confirm_password'), 'password_confirm'); ?></div>
			<div class="input_box_thin"><?php print form_password(array('name' => 'password_confirm', 'id' => 'password_confirm', 'class' => 'form-control')); ?></div>
		</div>	
		<div class="clear"></div>
	</div>
	
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<input type="submit" name="student_submit" id="student_submit" value="<?php if(!$id){ echo 'Add User'; }else{ echo 'Update User'; } ?>" class="btn green"/>
</div>	
<?php	
print form_close() ."\r\n";
?>