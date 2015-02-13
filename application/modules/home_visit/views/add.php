<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-md-12">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i><?php echo $this->lang->line('home_visit');?>
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config">
                </a>
                <a href="javascript:;" class="reload">
                </a>
                <a href="javascript:;" class="remove">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
        	<?php print form_open_multipart('documents/add_document/'.$id, array('id' => 'add_document','name'=>'add_document')) ."\r\n"; ?>
            <div class="form-body">
        	<?php
			if ($this->session->flashdata('message')) {
				print "<br><div class=\"alert alert-error\">". $this->session->flashdata('message') ."</div>";
			}
			?>
            <div class="containerfdfdf"></div>
            
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('date_of_upload'), 'date_of_upload',array('class'=>'control-label')); ?>
                    <?php print form_input(array('date_of_upload' => 'date_of_upload', 'id' => 'date_of_upload', 'value' => ($rowdata)?$rowdata->date_of_upload:$this->session->flashdata('date_of_upload'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('date_of_visit'), 'date_of_visit',array('class'=>'control-label')); ?>
                    <?php print form_input(array('date_of_visit' => 'date_of_visit', 'id' => 'date_of_visit', 'value' => ($rowdata)?$rowdata->date_of_visit:$this->session->flashdata('date_of_visit'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('association_name'), 'association_name',array('class'=>'control-label')); ?>
                    <?php print form_input(array('association_name' => 'association_name', 'id' => 'association_name', 'value' => ($rowdata)?$rowdata->association_name:$this->session->flashdata('association_name'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('location_of_visit'), 'location_of_visit',array('class'=>'control-label')); ?>
                    <?php print form_input(array('location_of_visit' => 'location_of_visit', 'id' => 'location_of_visit', 'value' => ($rowdata)?$rowdata->location_of_visit:$this->session->flashdata('location_of_visit'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('id_no'), 'id_no',array('class'=>'control-label')); ?>
                    <?php print form_input(array('id_no' => 'id_no', 'id' => 'id_no', 'value' => ($rowdata)?$rowdata->id_no:$this->session->flashdata('id_no'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('full_name_of_family_visited'), 'full_name_of_family_visited',array('class'=>'control-label')); ?>
                    <?php print form_input(array('full_name_of_family_visited' => 'full_name_of_family_visited', 'id' => 'full_name_of_family_visited', 'value' => ($rowdata)?$rowdata->full_name_of_family_visited:$this->session->flashdata('full_name_of_family_visited'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('name_of_visitor_from_association'), 'name_of_visitor_from_association',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name_of_visitor_from_association' => 'name_of_visitor_from_association', 'id' => 'name_of_visitor_from_association', 'value' => ($rowdata)?$rowdata->name_of_visitor_from_association:$this->session->flashdata('name_of_visitor_from_association'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('was_help_given'), 'was_help_given',array('class'=>'control-label')); ?>
                    <?php print form_input(array('was_help_given' => 'was_help_given', 'id' => 'was_help_given', 'value' => ($rowdata)?$rowdata->was_help_given:$this->session->flashdata('was_help_given'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('another_visit_short_reason'), 'another_visit_short_reason',array('class'=>'control-label')); ?>
                    <?php print form_input(array('another_visit_short_reason' => 'another_visit_short_reason', 'id' => 'another_visit_short_reason', 'value' => ($rowdata)?$rowdata->another_visit_short_reason:$this->session->flashdata('another_visit_short_reason'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('pictures_video_taken'), 'pictures_video_taken',array('class'=>'control-label')); ?>
                    <?php print form_dropdown('document_type',$document_types,($rowdata)?$rowdata->document_type:$this->session->flashdata('document_type'),'id="document_type" class="select2 form-control"'); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('special_case'), 'special_case',array('class'=>'control-label')); ?>
                    <?php print form_dropdown('document_type',$document_types,($rowdata)?$rowdata->document_type:$this->session->flashdata('document_type'),'id="document_type" class="select2 form-control"'); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('special_case_more_info'), 'special_case_more_info',array('class'=>'control-label')); ?>
                    <?php print form_input(array('special_case_more_info' => 'special_case_more_info', 'id' => 'special_case_more_info', 'value' => ($rowdata)?$rowdata->special_case_more_info:$this->session->flashdata('special_case_more_info'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('level_of_need'), 'level_of_need',array('class'=>'control-label')); ?>
                    <?php print form_dropdown('document_type',$document_types,($rowdata)?$rowdata->document_type:$this->session->flashdata('document_type'),'id="document_type" class="select2 form-control"'); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('any_other_information'), 'any_other_information',array('class'=>'control-label')); ?>
                    <?php print form_input(array('any_other_information' => 'any_other_information', 'id' => 'any_other_information', 'value' => ($rowdata)?$rowdata->any_other_information:$this->session->flashdata('any_other_information'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('month'), 'month',array('class'=>'control-label')); ?>
                    <?php print form_dropdown('document_type',$document_types,($rowdata)?$rowdata->document_type:$this->session->flashdata('document_type'),'id="document_type" class="select2 form-control"'); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('year'), 'year',array('class'=>'control-label')); ?>
                    <?php print form_dropdown('document_type',$document_types,($rowdata)?$rowdata->document_type:$this->session->flashdata('document_type'),'id="document_type" class="select2 form-control"'); ?>
                     </div>
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