<script type="text/javascript" src="<?php print base_url(); ?>js/jquery.form.js"></script>
<script type="text/javascript" src="<?php print base_url(); ?>js/validation.js"></script>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
print form_open_multipart('documents/add_document_model/'.$id, array('id' => 'add_document_model','name'=>'add_document_model')) ."\r\n";
?>
<div class="modal-header">
  <h2><?php if(!$id){ echo 'Add Document'; }else{ echo 'Edit Document'; } ?></h2>
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button><br />
</div>
<div class="modal-body">
	<?php $this->load->view('generic/flash_error'); ?>
	<div class="containerfdfdf"></div>
    <div class="row form-row">		
        <div class="col-md-12">
            <div class="row form-row">
                <div class="col-md-6">
                    <?php print form_label('Campus', 'campus_id',array('class'=>'form-label')); ?>
                    <?php //print form_dropdown('campus_id',$campus_list,($rowdata)?$rowdata->campus_id:$this->session->flashdata('campus_id'),'id="campus_id" class="select2 form-control"'); ?>
                    <?php print form_multiselect('campus_id[]',$campus_list,($rowdata)?$rowdata->campus_id:$this->session->flashdata('campus_id'),'id="multi" class="select2 form-control" placeholder="Select Campus"');  ?> 
                </div>
                <div class="col-md-6">
                    <?php print form_label('Document Type', 'document_type',array('class'=>'form-label')); ?>
                    <?php print form_dropdown('document_type',$document_types,($rowdata)?$rowdata->document_type:$this->session->flashdata('document_type'),'id="document_type" class="select2 form-control"'); ?>
                </div>
            </div>
            
            <div class="row form-row">
                <div class="col-md-6">
                    <?php print form_label('Name', 'name',array('class'=>'form-label')); ?>
                    <?php print form_input(array('name' => 'name', 'id' => 'name', 'value' => ($rowdata)?$rowdata->name:$this->session->flashdata('name'), 'class' => 'form-control ','placeholder' => 'Name')); ?>
                </div>
                <div class="col-md-6">
                    <?php print form_label('Select file', 'file',array('class'=>'form-label')); ?>
                    <input type="file" name="file" id="file" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <input type="submit" name="submit" value="Submit" class="btn btn-primary">
</div>