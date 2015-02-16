<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-md-12">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i><?php echo $this->lang->line('register');?>
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
        	<?php print form_open_multipart('refugee_register/add/'.$id, array('id' => 'add_refugee','name'=>'add_refugee')) ."\r\n"; ?>
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
                    <?php print form_label($this->lang->line('date_of_data_entry'), 'date_of_data_entry',array('class'=>'control-label')); ?> : <?php print ($rowdata)? date("d-m-Y",strtotime($rowdata->date_of_data_entry)): date("d-m-Y"); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('association_name'), 'association_name',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'association_name', 'id' => 'association_name', 'value' => ($rowdata)?$rowdata->association_name:$this->session->flashdata('association_name'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('location_of_association'), 'location_of_association',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'location_of_association', 'id' => 'location_of_association', 'value' => ($rowdata)?$rowdata->location_of_association:$this->session->flashdata('location_of_association'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('full_name'), 'full_name',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'full_name', 'id' => 'full_name', 'value' => ($rowdata)?$rowdata->full_name:$this->session->flashdata('full_name'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('age'), 'age',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'age', 'id' => 'age', 'value' => ($rowdata)?$rowdata->age:$this->session->flashdata('age'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('gender'), 'gender',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'gender', 'id' => 'gender', 'value' => ($rowdata)?$rowdata->gender:$this->session->flashdata('gender'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('nationality'), 'nationality',array('class'=>'control-label')); ?>
                    <?php print form_input(array('nationality' => 'nationality', 'id' => 'nationality', 'value' => ($rowdata)?$rowdata->nationality:$this->session->flashdata('nationality'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('nationality_id_no'), 'nationality_id_no',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'nationality_id_no', 'id' => 'nationality_id_no', 'value' => ($rowdata)?$rowdata->nationality_id_no:$this->session->flashdata('nationality_id_no'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('un_id'), 'un_id',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'un_id', 'id' => 'un_id', 'value' => ($rowdata)?$rowdata->un_id:$this->session->flashdata('un_id'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('marital_status'), 'marital_status',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'marital_status', 'id' => 'marital_status', 'value' => ($rowdata)?$rowdata->marital_status:$this->session->flashdata('marital_status'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('previous_occupation'), 'previous_occupation',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'previous_occupation', 'id' => 'previous_occupation', 'value' => ($rowdata)?$rowdata->previous_occupation:$this->session->flashdata('previous_occupation'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('are_you_able_to_work'), 'are_you_able_to_work',array('class'=>'control-label')); ?>
                    <?php print form_dropdown('are_you_able_to_work',$work_list,($rowdata)?$rowdata->are_you_able_to_work:$this->session->flashdata('are_you_able_to_work'),'id="are_you_able_to_work" class="select2 form-control"'); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('what_skills_do_you_have_for_working'), 'what_skills_do_you_have_for_working',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'what_skills_do_you_have_for_working', 'id' => 'what_skills_do_you_have_for_working', 'value' => ($rowdata)?$rowdata->what_skills_do_you_have_for_working:$this->session->flashdata('what_skills_do_you_have_for_working'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('what_qualifications_do_you_have'), 'what_qualifications_do_you_have',array('class'=>'control-label')); ?>
                    <?php print form_input(array('what_qualifications_do_you_have' => 'what_qualifications_do_you_have', 'id' => 'what_qualifications_do_you_have', 'value' => ($rowdata)?$rowdata->what_qualifications_do_you_have:$this->session->flashdata('what_qualifications_do_you_have'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('are_you_sick'), 'are_you_sick',array('class'=>'control-label')); ?>
                    <?php print form_dropdown('are_you_sick',$sicklist,($rowdata)?$rowdata->are_you_sick:$this->session->flashdata('are_you_sick'),'id="are_you_sick" class="select2 form-control"'); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('need_of_medicationequipment'), 'need_of_medicationequipment',array('class'=>'control-label')); ?>
                    <?php print form_dropdown('need_of_medicationequipment',$medicationequipment_list,($rowdata)?$rowdata->need_of_medicationequipment:$this->session->flashdata('need_of_medicationequipment'),'id="need_of_medicationequipment" class="select2 form-control"'); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('if_yes_please_specify'), 'if_yes_please_specify',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'if_yes_please_specify', 'id' => 'if_yes_please_specify', 'value' => ($rowdata)?$rowdata->if_yes_please_specify:$this->session->flashdata('if_yes_please_specify'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('where_do_you_live_location'), 'where_do_you_live_location',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'where_do_you_live_location', 'id' => 'where_do_you_live_location', 'value' => ($rowdata)?$rowdata->where_do_you_live_location:$this->session->flashdata('where_do_you_live_location'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('do_you_live_in_tent_house'), 'do_you_live_in_tent_house',array('class'=>'control-label')); ?>
                    <?php print form_dropdown('do_you_live_in_tent_house',$livelist,($rowdata)?$rowdata->do_you_live_in_tent_house:$this->session->flashdata('do_you_live_in_tent_house'),'id="do_you_live_in_tent_house" class="select2 form-control"'); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('what_is_it_that_you_need_most'), 'what_is_it_that_you_need_most',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'what_is_it_that_you_need_most', 'id' => 'what_is_it_that_you_need_most', 'value' => ($rowdata)?$rowdata->what_is_it_that_you_need_most:$this->session->flashdata('what_is_it_that_you_need_most'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('how_many_children_do_you_have'), 'how_many_children_do_you_have',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'how_many_children_do_you_have', 'id' => 'how_many_children_do_you_have', 'value' => ($rowdata)?$rowdata->how_many_children_do_you_have:$this->session->flashdata('how_many_children_do_you_have'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('childrens_names_ages_genders'), 'childrens_names_ages_genders',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'childrens_names_ages_genders', 'id' => 'childrens_names_ages_genders', 'value' => ($rowdata)?$rowdata->childrens_names_ages_genders:$this->session->flashdata('childrens_names_ages_genders'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('other_family_members_names_ages_genders'), 'other_family_members_names_ages_genders',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'other_family_members_names_ages_genders', 'id' => 'other_family_members_names_ages_genders', 'value' => ($rowdata)?$rowdata->other_family_members_names_ages_genders:$this->session->flashdata('other_family_members_names_ages_genders'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('contact_details_email_skype_whatsapp'), 'contact_details_email_skype_whatsapp',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'contact_details_email_skype_whatsapp', 'id' => 'contact_details_email_skype_whatsapp', 'value' => ($rowdata)?$rowdata->contact_details_email_skype_whatsapp:$this->session->flashdata('contact_details_email_skype_whatsapp'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('name_administrator'), 'name_administrator',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'name_administrator', 'id' => 'name_administrator', 'value' => ($rowdata)?$rowdata->name_administrator:$this->session->flashdata('name_administrator'), 'class' => 'form-control ')); ?>
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
                    <?php print form_label($this->lang->line('total_number_of_people_in_house'), 'total_number_of_people_in_house',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'total_number_of_people_in_house', 'id' => 'total_number_of_people_in_house', 'value' => ($rowdata)?$rowdata->total_number_of_people_in_house:$this->session->flashdata('total_number_of_people_in_house'), 'class' => 'form-control ')); ?>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <?php print form_label($this->lang->line('telephone_no'), 'telephone_no',array('class'=>'control-label')); ?>
                    <?php print form_input(array('name' => 'telephone_no', 'id' => 'telephone_no', 'value' => ($rowdata)?$rowdata->telephone_no:$this->session->flashdata('telephone_no'), 'class' => 'form-control ')); ?>
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