<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <?php $this->load->view('generic/flash_error'); ?>
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-th-list font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase"><?php echo $this->lang->line('add_document'); ?></span>
                </div>
                 <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
            	<?php print form_open_multipart('documents/add_document/'.$id, array('id' => 'add_document','name'=>'add_document')) ."\r\n"; ?>
                <div class="form-body">
                    <div class="containerfdfdf"></div>
                    <div class="row form-row">                
                        <div class="col-md-6 form-group">
                            <?php print form_label('Document Type', 'document_type',array('class'=>'form-label')); ?>
                            <?php print form_dropdown('document_type',$document_types,($rowdata)?$rowdata->document_type:$this->session->flashdata('document_type'),'id="document_type" class="select2 form-control"'); ?>
                        </div>
                    </div>                
                    
                    <div class="row form-row">
                        <div class="col-md-6 form-group">
                            <?php print form_label('Name', 'name',array('class'=>'form-label')); ?>
                            <?php print form_input(array('name' => 'name', 'id' => 'name', 'value' => ($rowdata)?$rowdata->name:$this->session->flashdata('name'), 'class' => 'form-control ','placeholder' => 'Name')); ?>
                        </div>
                        <div class="col-md-6 form-group">
                            <?php print form_label('Select file', 'file',array('class'=>'form-label')); ?>
                            <input type="file" name="file" id="file" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf">
                        </div>
                    </div>
                </div>
                <div class="form-actions right">
                    <input type="submit" name="submit" value="<?php echo $this->lang->line('submit');?>" class="btn blue">
                </div>
            </div>	
		</div>
    </div>
</div>