<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-md-12">
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-th-list font-green-sharp"></i>
                <span class="caption-subject font-green-sharp bold uppercase"><?php echo $this->lang->line('home_visit'); ?></span>
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
            </div>
        </div>
        <div class="portlet-body form">
        	<?php print form_open_multipart('home_visit/add/'.$id, array('id' => 'add_home_visit','name'=>'add_home_visit')) ."\r\n"; ?>
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
                    <?php print form_label($this->lang->line('date_of_upload'), 'date_of_upload',array('class'=>'control-label')); ?> : <?php print ($rowdata)? date("d-m-Y",strtotime($rowdata->created_date)): date("d-m-Y"); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('date_of_visit'), 'date_of_visit',array('class'=>'control-label')); ?>
                    <div class="input-group date date-picker" data-date="<?php echo ($rowdata)?date("d-m-Y",strtotime($rowdata->date_of_visit)):''?>" data-date-format="D, dd M yyyy" data-date-viewmode="">
                        <?php print form_input(array('name' => 'date_of_visit', 'id' => 'date_of_visit', 'value' => ($rowdata)?make_dp_date($rowdata->date_of_visit):$this->session->flashdata('date_of_visit'), 'class' => 'form-control', 'readonly' => 'readonly')); ?>
                        <span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>                    
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('association_name'), 'association_name',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'association_name', 'id' => 'association_name', 'value' => ($rowdata)?$rowdata->association_name:$this->session->flashdata('association_name'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('location_of_visit'), 'location_of_visit',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'location_of_visit', 'id' => 'location_of_visit', 'value' => ($rowdata)?$rowdata->location_of_visit:$this->session->flashdata('location_of_visit'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('id_no'), 'id_no',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'id_no', 'id' => 'id_no', 'value' => ($rowdata)?$rowdata->id_no:$this->session->flashdata('id_no'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('full_name_of_family_visited'), 'full_name_of_family_visited',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'full_name_of_family_visited', 'id' => 'full_name_of_family_visited', 'value' => ($rowdata)?$rowdata->full_name_of_family_visited:$this->session->flashdata('full_name_of_family_visited'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('name_of_visitor_from_association'), 'name_of_visitor_from_association',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'name_of_visitor_from_association', 'id' => 'name_of_visitor_from_association', 'value' => ($rowdata)?$rowdata->name_of_visitor_from_association:$this->session->flashdata('name_of_visitor_from_association'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('was_help_given'), 'was_help_given',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'was_help_given', 'id' => 'was_help_given', 'value' => ($rowdata)?$rowdata->was_help_given:$this->session->flashdata('was_help_given'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('another_visit_short_reason'), 'another_visit_short_reason',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'another_visit_short_reason', 'id' => 'another_visit_short_reason', 'value' => ($rowdata)?$rowdata->another_visit_short_reason:$this->session->flashdata('another_visit_short_reason'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('pictures_video_taken'), 'pictures_video_taken',array('class'=>'control-label')); ?>
                    <?php print form_dropdown('pictures_video_taken',$pictures_video_taken_list,($rowdata)?$rowdata->pictures_video_taken:$this->session->flashdata('pictures_video_taken'),'id="pictures_video_taken" class="select2 form-control"'); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('special_case'), 'special_case',array('class'=>'control-label')); ?>
                    <?php print form_dropdown('special_case',$specia_case_list,($rowdata)?$rowdata->special_case:$this->session->flashdata('special_case'),'id="special_case" class="select2 form-control"'); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('special_case_more_info'), 'special_case_more_info',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'special_case_more_info', 'id' => 'special_case_more_info', 'value' => ($rowdata)?$rowdata->special_case_more_info:$this->session->flashdata('special_case_more_info'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('level_of_need'), 'level_of_need',array('class'=>'control-label')); ?>
                    <?php print form_dropdown('level_of_need',$level_of_need_list,($rowdata)?$rowdata->level_of_need:$this->session->flashdata('level_of_need'),'id="level_of_need" class="select2 form-control"'); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('any_other_information'), 'any_other_information',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'any_other_information', 'id' => 'any_other_information', 'value' => ($rowdata)?$rowdata->any_other_information:$this->session->flashdata('any_other_information'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('month'), 'month',array('class'=>'control-label')); ?>
                    <?php print form_dropdown('month',$month_list,($rowdata)?$rowdata->month:$this->session->flashdata('month'),'id="month" class="select2 form-control"'); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('year'), 'year',array('class'=>'control-label')); ?>
                    <?php print form_dropdown('year',$year_list,($rowdata)?$rowdata->year:$this->session->flashdata('year'),'id="year" class="select2 form-control"'); ?>
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