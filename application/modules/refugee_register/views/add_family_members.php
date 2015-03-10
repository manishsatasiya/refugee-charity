<script type="text/javascript" src="<?php print base_url(); ?>js/jquery.form.js"></script>
<script type="text/javascript" src="<?php print base_url(); ?>js/validation.js"></script>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
print form_open('refugee_register/add_family_members/'.$refugee_id.'/'.$id, array('id' => 'add_refugee_family_members','name'=>'formmain')) ."\r\n";
?>
<div class="modal-header">
  <h2><?php if(!$id){ echo $this->lang->line('add'); }else{ echo $this->lang->line('edit'); } ?></h2>
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button><br />
</div>
<div class="modal-body">
	<?php $this->load->view('generic/flash_error'); ?>

	<div class="containerfdfdf"></div>
	<div class="row form-row">
		<div class="col-md-6 form-group">
			<div class="form_label2"><?php print form_label($this->lang->line('name'), 'name'); ?></div>
			<div class="input_box_thin"><?php print form_input(array('name' => 'name', 'id' => 'name', 'value' => ($rowdata)?$rowdata->name:$this->session->flashdata('name'), 'class' => 'form-control')); ?></div>
		</div>

		<div class="col-md-6 form-group">
			<div class="form_label2"><?php print form_label($this->lang->line('relation'), 'relation'); ?></div>
			<div class="input_box_thin"><?php print form_dropdown('relation',$relation_list,($rowdata)?$rowdata->relation:$this->session->flashdata('relation'),'id="relation" class="select2 form-control"'); ?></div>
		</div>
	</div>
	<div class="row form-row">
		<div class="col-md-6 form-group">
			<div class="form_label2"><?php print form_label($this->lang->line('gender'), 'gender'); ?></div>
			<div class="input_box_thin"><?php print form_dropdown('gender',$gender_list,($rowdata)?$rowdata->gender:$this->session->flashdata('gender'),'id="gender" class="select2 form-control"'); ?></div>
		</div>

		<div class="col-md-6 form-group">
			<div class="form_label2"><?php print form_label($this->lang->line('age'), 'age'); ?></div>
			<div class="input_box_thin"><?php print form_dropdown('age',$age_list,($rowdata)?$rowdata->age:$this->session->flashdata('age'),'id="age" class="select2 form-control"'); ?></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<input type="submit" name="submit" value="<?php echo $this->lang->line('submit');?>" class="btn green">
</div>
<?php	
print form_close() ."\r\n";
?>