<script type="text/javascript" src="<?php print base_url(); ?>js/jquery.form.js"></script>
<script type="text/javascript" src="<?php print base_url(); ?>js/validation.js"></script>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
print form_open('refugee_settings/add_nationality/'.$id, array('id' => 'add_nationality','name'=>'formmain')) ."\r\n";
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
			<div class="form_label2"><?php print form_label($this->lang->line('country'), 'country'); ?></div>
			<div class="input_box_thin"><?php print form_input(array('name' => 'country', 'id' => 'country', 'value' => ($rowdata)?$rowdata->country:$this->session->flashdata('country'), 'class' => 'form-control ')); ?></div>
		</div>
		<div class="col-md-6 form-group">
			<div class="form_label2"><?php print form_label($this->lang->line('nationality'), 'nationality'); ?></div>
			<div class="input_box_thin"><?php print form_input(array('name' => 'nationality', 'id' => 'nationality', 'value' => ($rowdata)?$rowdata->nationality:$this->session->flashdata('nationality'), 'class' => 'form-control ')); ?></div>
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