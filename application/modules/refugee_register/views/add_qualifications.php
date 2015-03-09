<script type="text/javascript" src="<?php print base_url(); ?>js/jquery.form.js"></script>
<script type="text/javascript" src="<?php print base_url(); ?>js/validation.js"></script>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
print form_open('refugee_register/add_qualifications/'.$refugee_id.'/'.$id, array('id' => 'add_refugee_qualifications','name'=>'formmain')) ."\r\n";
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
			<div class="form_label2"><?php print form_label($this->lang->line('title'), 'title'); ?></div>
			<div class="input_box_thin"><?php print form_input(array('name' => 'title', 'id' => 'title', 'value' => ($rowdata)?$rowdata->title:$this->session->flashdata('title'), 'class' => 'form-control')); ?></div>
		</div>

		<div class="col-md-6 form-group">
			<div class="form_label2"><?php print form_label($this->lang->line('institute'), 'institute'); ?></div>
			<div class="input_box_thin"><?php print form_input(array('name' => 'institute', 'id' => 'institute', 'value' => ($rowdata)?$rowdata->institute:$this->session->flashdata('institute'), 'class' => 'form-control')); ?></div>
		</div>
	</div>
	<div class="row form-row">
		<div class="col-md-6 form-group">
			<div class="form_label2"><?php print form_label($this->lang->line('grade'), 'grade'); ?></div>
			<div class="input_box_thin"><?php print form_input(array('name' => 'grade', 'id' => 'grade', 'value' => ($rowdata)?$rowdata->grade:$this->session->flashdata('grade'), 'class' => 'form-control')); ?></div>
		</div>

		<div class="col-md-6 form-group">
			<div class="form_label2"><?php print form_label($this->lang->line('year'), 'pass_year'); ?></div>
			<div class="input_box_thin"><?php print form_input(array('name' => 'pass_year', 'id' => 'pass_year', 'value' => ($rowdata)?$rowdata->pass_year:$this->session->flashdata('pass_year'), 'class' => 'form-control')); ?></div>
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