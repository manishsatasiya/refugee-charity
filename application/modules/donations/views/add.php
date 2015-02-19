<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-md-12">
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-th-list font-green-sharp"></i>
                <span class="caption-subject font-green-sharp bold uppercase"><?php echo $this->lang->line('donations_info'); ?></span>
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
            </div>
        </div>
        <div class="portlet-body form">
        	<?php print form_open_multipart('donations/add/'.$id, array('id' => 'add_donations','name'=>'add_donations')) ."\r\n"; ?>
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
                    <?php print form_label($this->lang->line('date_of_upload'), 'date_of_upload',array('class'=>'control-label')); ?> : <?php print ($rowdata)? date("d-m-Y",strtotime($rowdata->created_date)): date("d-m-Y"); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('date_of_donation'), 'date_of_donation',array('class'=>'control-label')); ?>
                    <div class="input-group date date-picker" data-date="<?php echo ($rowdata)?date("d-m-Y",strtotime($rowdata->date_of_donation)):''?>" data-date-format="D, dd M yyyy" data-date-viewmode="">
                        <?php print form_input(array('name' => 'date_of_donation', 'id' => 'date_of_donation', 'value' => ($rowdata)?make_dp_date($rowdata->date_of_donation):$this->session->flashdata('birth_date'), 'class' => 'form-control', 'readonly' => 'readonly')); ?>
                        <span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>                    
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('name_of_association'), 'name_of_association',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'name_of_association', 'id' => 'name_of_association', 'value' => ($rowdata)?$rowdata->name_of_association:$this->session->flashdata('name_of_association'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('name_of_donator'), 'name_of_donator',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'name_of_donator', 'id' => 'name_of_donator', 'value' => ($rowdata)?$rowdata->name_of_donator:$this->session->flashdata('name_of_donator'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('what_was_donated_please_specify'), 'what_was_donated_please_specify',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'what_was_donated_please_specify', 'id' => 'what_was_donated_please_specify', 'value' => ($rowdata)?$rowdata->what_was_donated_please_specify:$this->session->flashdata('what_was_donated_please_specify'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('name_aid_of_receiver_from'), 'name_aid_of_receiver_from',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'name_aid_of_receiver_from', 'id' => 'name_aid_of_receiver_from', 'value' => ($rowdata)?$rowdata->name_aid_of_receiver_from:$this->session->flashdata('name_aid_of_receiver_from'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('any_other_info'), 'any_other_info',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'any_other_info', 'id' => 'any_other_info', 'value' => ($rowdata)?$rowdata->any_other_info:$this->session->flashdata('any_other_info'), 'class' => 'form-control ')); ?>
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