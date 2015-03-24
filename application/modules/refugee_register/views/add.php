<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script type="text/javascript" src="<?php print base_url(); ?>js/grid/association_name.js"></script>
<script type="text/javascript" src="<?php print base_url(); ?>js/grid/nationality.js"></script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
        	<div class="modal-header">
              <h2>Loading....</h2>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button><br />
            </div>
            <div class="modal-body"><div style="text-align:center;"><i class="fa fa-spinner fa fa-6x fa-spin" id="animate-icon"></i></div></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
		 </div>	
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->	

<div class="row">
	<div class="col-md-12">
    <div class="portlet light">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <i class="fa fa-th-list font-green-sharp"></i>
                <span class="caption-subject font-green-sharp bold uppercase"><?php echo $this->lang->line('refugee_register'); ?></span>
            </div>
            <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#tab_1_1" data-toggle="tab" data-tab-numb="0" class="tab_clicked"><?php print $this->lang->line('info'); ?></a>
                </li>
				<?php
                if($id) { ?>
				<li>
                  <a href="#tab_1_2" data-toggle="tab" data-tab-numb="1" class="tab_clicked"><?php print $this->lang->line('contact'); ?></a>
                </li>
                <li>
                  <a href="#tab_1_3" data-toggle="tab" data-tab-numb="2" class="tab_clicked"><?php print $this->lang->line('photos'); ?></a>
                </li>
                <li>
                  <a href="#tab_1_4" data-toggle="tab" data-tab-numb="3" class="tab_clicked"><?php print $this->lang->line('documents'); ?></a>
                </li>
                <li>
                  <a href="#tab_1_5" data-toggle="tab" data-tab-numb="4" class="tab_clicked"><?php print $this->lang->line('video'); ?></a>
                </li>
                <?php } ?>
            </ul>
            <!-- <div class="tools">
                <a href="javascript:;" class="collapse"></a>
            </div> -->
        </div>
        <div class="portlet-body form">
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1_1">
                	<?php print form_open_multipart('refugee_register/add/'.$id, array('id' => 'add_refugee','name'=>'add_refugee')) ."\r\n"; ?>
					<input type="hidden" name="timestamp" id="timestamp" value="<? echo $timestamp;?>">
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
                                <?php print form_label($this->lang->line('full_name'), 'full_name',array('class'=>'control-label')); ?>
                                <?php print form_input(array('name' => 'full_name', 'id' => 'full_name', 'value' => ($rowdata)?$rowdata->full_name:$this->session->flashdata('full_name'), 'class' => 'form-control ')); ?>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <?php print form_label($this->lang->line('association_name'), 'association_name',array('class'=>'control-label')); ?>
                                <?php print form_dropdown('association_name',$associatoin_name_list,($rowdata)?$rowdata->association_name:$this->session->flashdata('association_name'),'id="association_name" class="select2 form-control"'); ?>
                                 </div>
                            </div>
						</div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <?php print form_label($this->lang->line('age'), 'age',array('class'=>'control-label')); ?>
    								<?php print form_dropdown('age',$age_list,($rowdata)?$rowdata->age:$this->session->flashdata('age'),'id="age" class="select2 form-control"'); ?>
                                     </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <?php print form_label($this->lang->line('gender'), 'gender',array('class'=>'control-label')); ?>
    								<?php print form_dropdown('gender',$gender_list,($rowdata)?$rowdata->gender:$this->session->flashdata('gender'),'id="gender" class="select2 form-control"'); ?>
                                     </div>
                                </div>
                                </div>
                            </div>

                            <div class="col-md-6"> 
                                <div class="row"> 
                                <div class="col-md-6">
                                    <div class="row" id="refugee_sick_main">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <?php print form_label($this->lang->line('are_you_sick'), 'are_you_sick',array('class'=>'control-label')); ?>
                                            <?php print form_dropdown('are_you_sick',$sicklist,($rowdata)?$rowdata->are_you_sick:$this->session->flashdata('are_you_sick'),'id="are_you_sick" class="select2 form-control"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                            $are_you_sick = ($rowdata)?$rowdata->are_you_sick:0;
                                            $sick_reason_div_style = 'display:none;';
                                            if ($are_you_sick == 1) {
                                                $sick_reason_div_style = 'display:block;';
                                            }
                                            ?>
                                            <div class="form-group" id="sick_reason_div" style="<?=$sick_reason_div_style?>">
                                            <?php print form_label($this->lang->line('sick_reason'), 'sick_reason',array('class'=>'control-label')); ?>
                                            <?php print form_input(array('name' => 'sick_reason', 'id' => 'sick_reason', 'value' => ($rowdata)?$rowdata->sick_reason:$this->session->flashdata('sick_reason'), 'class' => 'form-control')); ?>
                                             </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                    <?php print form_label($this->lang->line('need_of_medicationequipment'), 'need_of_medicationequipment',array('class'=>'control-label')); ?>
                                    <?php print form_dropdown('need_of_medicationequipment',$medicationequipment_list,($rowdata)?$rowdata->need_of_medicationequipment:$this->session->flashdata('need_of_medicationequipment'),'id="need_of_medicationequipment" class="select2 form-control"'); ?>
                                     </div>
                                </div>  
                                </div>  
                            </div>
						</div>
                        <div class="row">	
                            <div class="col-md-6">	
                                <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <?php print form_label($this->lang->line('nationality'), 'nationality',array('class'=>'control-label')); ?>
    								<?php print form_dropdown('nationality',$nationality_list,($rowdata)?$rowdata->nationality:$this->session->flashdata('nationality'),'id="nationality" class="select2 form-control"'); ?>
                                     </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <?php print form_label($this->lang->line('nationality_id_no'), 'nationality_id_no',array('class'=>'control-label')); ?>
                                    <?php print form_input(array('name' => 'nationality_id_no', 'id' => 'nationality_id_no', 'value' => ($rowdata)?$rowdata->nationality_id_no:$this->session->flashdata('nationality_id_no'), 'class' => 'form-control ')); ?>
                                     </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <?php print form_label($this->lang->line('if_yes_please_specify'), 'if_yes_please_specify',array('class'=>'control-label')); ?>
                                <?php print form_input(array('name' => 'if_yes_please_specify', 'id' => 'if_yes_please_specify', 'value' => ($rowdata)?$rowdata->if_yes_please_specify:$this->session->flashdata('if_yes_please_specify'), 'class' => 'form-control ')); ?>
                                 </div>
                            </div>
						</div>
                        <div class="row">		
                            <div class="col-md-6">
                                <div class="form-group">
                                <?php print form_label($this->lang->line('un_id'), 'un_id',array('class'=>'control-label')); ?>
                                <?php print form_input(array('name' => 'un_id', 'id' => 'un_id', 'value' => ($rowdata)?$rowdata->un_id:$this->session->flashdata('un_id'), 'class' => 'form-control ')); ?>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <?php print form_label($this->lang->line('marital_status'), 'marital_status',array('class'=>'control-label')); ?>
    								<?php print form_dropdown('marital_status',$maritalstatus_list,($rowdata)?$rowdata->marital_status:$this->session->flashdata('marital_status'),'id="marital_status" class="select2 form-control"'); ?>
                                     </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                    <?php print form_label($this->lang->line('special_case'), 'special_case',array('class'=>'control-label')); ?>
                                    <?php print form_dropdown('special_case',$specia_case_list,($rowdata)?$rowdata->special_case:$this->session->flashdata('special_case'),'id="special_case" class="select2 form-control"'); ?>

                                     </div>
                                </div>
                                </div>
                            </div>
						</div>
                        <div class="row">
                            <div class="col-md-6">	
                                <div class="row"> 	
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
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                <?php print form_label($this->lang->line('special_case_more_info'), 'special_case_more_info',array('class'=>'control-label')); ?>
                                <textarea id="maxlength_textarea" name="special_case_more_info" class="form-control maxlength_textarea" maxlength="250" rows="2" placeholder="This textarea has a limit of 250 chars."><?= ($rowdata)?$rowdata->special_case_more_info:$this->session->flashdata('special_case_more_info')?></textarea>
                                 </div>
                            </div>
						</div>
                        <div class="row">		
                            <div class="col-md-6">
                                <div class="form-group">
                                <?php print form_label($this->lang->line('what_skills_do_you_have_for_working'), 'what_skills_do_you_have_for_working',array('class'=>'control-label')); ?>
                                <?php print form_input(array('name' => 'what_skills_do_you_have_for_working', 'id' => 'tags_1', 'value' => ($rowdata)?$rowdata->what_skills_do_you_have_for_working:$this->session->flashdata('what_skills_do_you_have_for_working'), 'class' => 'form-control tags')); ?>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">   
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <?php print form_label($this->lang->line('do_you_live_in_tent_house'), 'do_you_live_in_tent_house',array('class'=>'control-label')); ?>
                                    <?php print form_dropdown('do_you_live_in_tent_house',$livelist,($rowdata)?$rowdata->do_you_live_in_tent_house:$this->session->flashdata('do_you_live_in_tent_house'),'id="do_you_live_in_tent_house" class="select2 form-control"'); ?>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <?php print form_label($this->lang->line('total_number_of_people_in_house'), 'total_number_of_people_in_house',array('class'=>'control-label')); ?>
                                    <?php print form_dropdown('total_number_of_people_in_house',$housepeople_list,($rowdata)?$rowdata->total_number_of_people_in_house:$this->session->flashdata('total_number_of_people_in_house'),'id="total_number_of_people_in_house" class="select2 form-control"'); ?>
                                     </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                    <?php print form_label($this->lang->line('how_many_children_do_you_have'), 'how_many_children_do_you_have',array('class'=>'control-label')); ?>
                                    <?php print form_dropdown('how_many_children_do_you_have',$children_list,($rowdata)?$rowdata->how_many_children_do_you_have:$this->session->flashdata('how_many_children_do_you_have'),'id="how_many_children_do_you_have" class="select2 form-control"'); ?>
                                     </div>
                                </div>
                                </div>
                            </div>
						</div>
                        <div class="row">		
						    <div class="col-md-6">
                                <div class="form-group">
                                <?php print form_label($this->lang->line('where_do_you_live_location'), 'where_do_you_live_location',array('class'=>'control-label')); ?>
                                <?php print form_dropdown('where_do_you_live_location',$refugee_location_list,($rowdata)?$rowdata->where_do_you_live_location:$this->session->flashdata('where_do_you_live_location'),'id="where_do_you_live_location" class="select2 form-control"'); ?>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <?php print form_label($this->lang->line('what_is_it_that_you_need_most'), 'what_is_it_that_you_need_most',array('class'=>'control-label')); ?>
								<textarea id="maxlength_textarea" name="what_is_it_that_you_need_most" class="form-control maxlength_textarea" maxlength="250" rows="2" placeholder="This textarea has a limit of 250 chars."><?= ($rowdata)?$rowdata->what_is_it_that_you_need_most:$this->session->flashdata('what_is_it_that_you_need_most')?></textarea>
                                 </div>
                            </div>	
                            
						</div>
                        <div class="row">		
                            <div class="col-md-6">
                                <div class="form-group">
                                <?php print form_label($this->lang->line('any_other_information'), 'any_other_information',array('class'=>'control-label')); ?>
								<textarea id="maxlength_textarea" name="any_other_information" class="form-control maxlength_textarea" maxlength="250" rows="2" placeholder="This textarea has a limit of 250 chars."><?= ($rowdata)?$rowdata->any_other_information:$this->session->flashdata('any_other_information')?></textarea>
                                 </div>
                            </div>
                            
						</div>
                        <div class="row">		
						    
                            
                        </div>
                        <?php
                        if($id) { ?>    
						<div class="row ">
							<div class="col-md-6">
                                <div class="form-group">
                                <!-- BEGIN SAMPLE TABLE PORTLET-->
								<div class="portlet light">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-cogs font-green-sharp"></i>
											<span class="caption-subject font-green-sharp bold uppercase"><? echo $this->lang->line('what_qualifications_do_you_have');?></span>
										</div>
										<div class="tools">
											<a href="javascript:;" class="collapse"></a>
											<a href="<?php print site_url('refugee_register/add_qualifications/'.$id); ?>" data-target="#myModal" data-toggle="modal" class="add_refugee_qualifications"> <i class="fa fa-plus"></i></a>
                                            <a href="#" data-load="true" data-url="<?php print site_url('refugee_register/load_qualifications/'.$id); ?>" class="reload"></a>
											</a>

										</div>
									</div>
									<div class="portlet-body">
										
									</div>
								</div>
								<!-- END SAMPLE TABLE PORTLET-->
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <!-- BEGIN SAMPLE TABLE PORTLET-->
								<div class="portlet light">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-cogs font-green-sharp"></i>
											<span class="caption-subject font-green-sharp bold uppercase"><? echo $this->lang->line('other_family_members_names_ages_genders');?></span>
										</div>
										<div class="tools">
											<a href="javascript:;" class="collapse"></a>
                                            <a href="<?php print site_url('refugee_register/add_family_members/'.$id); ?>" data-target="#myModal" data-toggle="modal" class="add_refugee_family_members"> <i class="fa fa-plus"></i></a>
                                            <a href="#" data-load="true" data-url="<?php print site_url('refugee_register/load_family_members/'.$id); ?>" class="reload"></a>
                                            </a>
										</div>
									</div>
									<div class="portlet-body"></div>
								</div>
								<!-- END SAMPLE TABLE PORTLET-->
                                 </div>
                            </div>
                        </div>
                        <?php
                        }?>
                    </div>
                    <div class="form-actions right">
                        <input type="submit" name="submit" value="<?php echo $this->lang->line('submit');?>" class="btn blue">
                    </div>
                    <?php print form_close(); ?>
                </div>
				<?php
                if($id) { ?>
				<div class="tab-pane" id="tab_1_2">
					<?php print form_open_multipart('refugee_register/add_contact/'.$id, array('id' => 'add_refugee','name'=>'add_refugee')) ."\r\n"; ?>
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
								<?php print form_label($this->lang->line('telephone_no'), 'telephone_no',array('class'=>'control-label')); ?>
								<?php print form_input(array('name' => 'telephone_no', 'id' => 'telephone_no', 'value' => ($rowdata)?$rowdata->telephone_no:$this->session->flashdata('telephone_no'), 'class' => 'form-control ')); ?>
								 </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								<?php print form_label($this->lang->line('email'), 'email',array('class'=>'control-label')); ?>
								<?php print form_input(array('name' => 'email', 'id' => 'email', 'value' => ($rowdata)?$rowdata->email:$this->session->flashdata('email'), 'class' => 'form-control ')); ?>
								 </div>
							</div>
						</div>
						<div class="row ">
							<div class="col-md-6">
								<div class="form-group">
								<?php print form_label($this->lang->line('skype'), 'skype',array('class'=>'control-label')); ?>
								<?php print form_input(array('name' => 'skype', 'id' => 'skype', 'value' => ($rowdata)?$rowdata->skype:$this->session->flashdata('skype'), 'class' => 'form-control ')); ?>
								 </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								<?php print form_label($this->lang->line('whatsapp'), 'whatsapp',array('class'=>'control-label')); ?>
								<?php print form_input(array('name' => 'whatsapp', 'id' => 'whatsapp', 'value' => ($rowdata)?$rowdata->whatsapp:$this->session->flashdata('whatsapp'), 'class' => 'form-control ')); ?>
								 </div>
							</div>
						</div>
						<div class="row ">
							<div class="col-md-6">
								<div class="form-group">
								<?php print form_label($this->lang->line('other_contact'), 'other_contact',array('class'=>'control-label')); ?>
								<?php print form_input(array('name' => 'other_contact', 'id' => 'other_contact', 'value' => ($rowdata)?$rowdata->other_contact:$this->session->flashdata('other_contact'), 'class' => 'form-control ')); ?>
								 </div>
							</div>
						</div>
						
					</div>
					<div class="form-actions right">
						<input type="submit" name="submit" value="<?php echo $this->lang->line('submit');?>" class="btn blue">
					</div>
					<?php print form_close(); ?>
				</div>

                <div class="tab-pane " id="tab_1_3">
                    <link href="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
                    <link href="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
                    <link href="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>

                    <div class="row">
                        <div class="col-md-12">
                            <?php print form_open_multipart('refugee_register/upload_photos/photo/'.$id, array('id' => 'fileupload','name'=>'upload_photos')) ."\r\n"; ?>

                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                <div class="row fileupload-buttonbar">
                                    <div class="col-lg-7">
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                        <span class="btn green fileinput-button"><i class="fa fa-plus"></i> <span>Add files... </span>
                                            <input type="file" name="files[]" multiple="">
                                        </span>
                                        <button type="submit" class="btn blue start"> <i class="fa fa-upload"></i> <span>Start upload </span></button>
                                        <button type="reset" class="btn warning cancel"><i class="fa fa-ban-circle"></i><span>
                                        Cancel upload </span></button>
                                        <button type="button" class="btn red delete"><i class="fa fa-trash"></i><span>
                                        Delete </span></button>
                                        <input type="checkbox" class="toggle">
                                        <!-- The global file processing state -->
                                        <span class="fileupload-process"></span>
                                    </div>
                                    <!-- The global progress information -->
                                    <div class="col-lg-5 fileupload-progress fade">
                                        <!-- The global progress bar -->
                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                        </div>
                                        <!-- The extended global progress information -->
                                        <div class="progress-extended">&nbsp;</div>
                                    </div>
                                </div>
                                <!-- The table listing the files available for upload/download -->
                                <table role="presentation" class="table table-striped clearfix">
								<thead>
									<th>Thumb</th>
									<th>View</th>
									<th>Title</th>
									<th>Size</th>
									<th>Action</th>
								</thead>
								<tbody class="files"></tbody></table>
                            <?php print form_close() ."\r\n"; ?>
                        </div>
                    </div>

                    <!-- The blueimp Gallery widget -->
                    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                        <div class="slides"></div>
                        <h3 class="title"></h3>
                        <a class="prev">‹</a>
                        <a class="next">›</a>
                        <a class="close">×</a>
                        <a class="play-pause"></a>
                        <ol class="indicator"></ol>
                    </div>
                    <!-- The template to display files available for upload -->
                    <script id="template-upload" type="text/x-tmpl">
                    {% for (var i=0, file; file=o.files[i]; i++) { %}
                        <tr class="template-upload fade">
                            <td>
                                <span class="preview"></span>
                            </td>
                            <td>
                                <p class="name">{%=file.name%}</p>
                                <strong class="error text-danger"></strong>
                            </td>
                            <td>
                                <p class="size">Processing...</p>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                            </td>
                            <td>
                                {% if (!i && !o.options.autoUpload) { %}
                                    <button class="btn btn-primary start" disabled>
                                        <i class="glyphicon glyphicon-upload"></i>
                                        <span>Start</span>
                                    </button>
                                {% } %}
                                {% if (!i) { %}
                                    <button class="btn btn-warning cancel">
                                        <i class="glyphicon glyphicon-ban-circle"></i>
                                        <span>Cancel</span>
                                    </button>
                                {% } %}
                            </td>
                        </tr>
                    {% } %}
                    </script>
                    <!-- The template to display files available for download -->
                    <script id="template-download" type="text/x-tmpl">
                    {% for (var i=0, file; file=o.files[i]; i++) { %}
                        <tr class="template-download fade">
                            <td>
                                <span class="preview">
                                    {% if (file.thumbnailUrl && file.fileType == 'photo') { %}
                                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}" width="80"></a>
                                    {% }else if(file.videoPreview && file.fileType == 'video'){ %}
                                        <video src="{%=file.videoPreview%}" controls=""></video>
                                    {% } %}
                                </span>
                            </td>
                            <td>
                                <p class="name">
                                    {% if (file.url) { %}
                                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl && file.fileType == 'photo'?'data-gallery':''%}>{%=file.name%}</a>
                                    {% } else { %}
                                        <span>{%=file.name%}</span>
                                    {% } %}
                                </p>
                                {% if (file.error) { %}
                                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                                {% } %}
                            </td>
                            <td>
                                <div id="file_title_main">
									{% if (file.title) { %}
                                        <span class="title"><a id="file_title" class="editable-click">{%=file.title%}</a></span>
                                    {% } else { %}
                                        <span class="title"><a id="file_title" class="editable-empty editable-click">Enter Title</a></span>
                                    {% } %}
                                    
                                    <span class="title_form" style="display:none;">
                                        <div class="row">
                                        <div class="col-md-5"><input name="title" id="title" value="{%=file.title%}" data-id="{%=file.id%}" class = "form-control" /></div>
                                        <div class="col-md-4">
                                            <a href="javascript:;" id="save" class="btn btn-icon-only green"><i class="fa fa-check"></i> </a>
                                            <a href="javascript:;" id="cancel" class="btn btn-icon-only red"><i class="fa fa-times"></i> </a>
                                        </div>
                                        </div>
                                    </span>                                    
                                </div>
                            </td>
                            <td>
                                <span class="size">{%=o.formatFileSize(file.size)%}</span>
                            </td>
                            <td>
                                {% if (file.deleteUrl) { %}
                                    <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                                        <i class="glyphicon glyphicon-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                    <input type="checkbox" name="delete" value="1" class="toggle">
                                {% } else { %}
                                    <button class="btn btn-warning cancel">
                                        <i class="glyphicon glyphicon-ban-circle"></i>
                                        <span>Cancel</span>
                                    </button>
                                {% } %}
                            </td>
                        </tr>
                    {% } %}
                    </script>

                    <!-- BEGIN:File Upload Plugin JS files-->
                    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
                    <script src="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
                    <!-- The Templates plugin is included to render the upload/download listings -->
                    <script src="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js"></script>
                    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
                    <script src="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js"></script>
                    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
                    <script src="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"></script>
                    <!-- blueimp Gallery script -->
                    <script src="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js"></script>
                    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
                    <script src="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js"></script>
                    <!-- The basic File Upload plugin -->
                    <script src="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js"></script>
                    <!-- The File Upload processing plugin -->
                    <script src="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js"></script>
                    <!-- The File Upload image preview & resize plugin -->
                    <script src="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js"></script>
                    <!-- The File Upload audio preview plugin -->
                    <script src="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"></script>
                    <!-- The File Upload video preview plugin -->
                    <script src="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js"></script>
                    <!-- The File Upload validation plugin -->
                    <script src="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
                    <!-- The File Upload user interface plugin -->
                    <script src="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
                   
                    <script>
                        jQuery(document).ready(function() {
                            FormFileUpload.init();
                        });
                    </script>
                </div>

                <div class="tab-pane" id="tab_1_4">
                    <div class="row">
                        <div class="col-md-12">
                            <?php print form_open_multipart('refugee_register/upload_photos/document/'.$id, array('id' => 'fileupload2','name'=>'upload_document')) ."\r\n"; ?>

                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                <div class="row fileupload-buttonbar">
                                    <div class="col-lg-7">
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                        <span class="btn green fileinput-button"><i class="fa fa-plus"></i> <span>Add files... </span>
                                            <input type="file" name="files[]" multiple="">
                                        </span>
                                        <button type="submit" class="btn blue start"> <i class="fa fa-upload"></i> <span>Start upload </span></button>
                                        <button type="reset" class="btn warning cancel"><i class="fa fa-ban-circle"></i><span>
                                        Cancel upload </span></button>
                                        <button type="button" class="btn red delete"><i class="fa fa-trash"></i><span>
                                        Delete </span></button>
                                        <input type="checkbox" class="toggle">
                                        <!-- The global file processing state -->
                                        <span class="fileupload-process"></span>
                                    </div>
                                    <!-- The global progress information -->
                                    <div class="col-lg-5 fileupload-progress fade">
                                        <!-- The global progress bar -->
                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                        </div>
                                        <!-- The extended global progress information -->
                                        <div class="progress-extended">&nbsp;</div>
                                    </div>
                                </div>
                                <!-- The table listing the files available for upload/download -->
                                <table role="presentation" class="table table-striped clearfix">
								<thead>
									<th></th>
									<th>Download</th>
									<th>Title</th>
									<th>Size</th>
									<th>Action</th>
								</thead>
								<tbody class="files"></tbody></table>
                            <?php print form_close() ."\r\n"; ?>
                        </div>
                    </div>
                </div>

                <div class="tab-pane " id="tab_1_5">
                    <div class="row">
                        <div class="col-md-12">
                            <?php print form_open_multipart('refugee_register/upload_photos/video/'.$id, array('id' => 'fileupload3','name'=>'upload_video')) ."\r\n"; ?>

                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                <div class="row fileupload-buttonbar">
                                    <div class="col-lg-7">
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                        <span class="btn green fileinput-button"><i class="fa fa-plus"></i> <span>Add files... </span>
                                            <input type="file" name="files[]" multiple="">
                                        </span>
                                        <button type="submit" class="btn blue start"> <i class="fa fa-upload"></i> <span>Start upload </span></button>
                                        <button type="reset" class="btn warning cancel"><i class="fa fa-ban-circle"></i><span>
                                        Cancel upload </span></button>
                                        <button type="button" class="btn red delete"><i class="fa fa-trash"></i><span>
                                        Delete </span></button>
                                        <input type="checkbox" class="toggle">
                                        <!-- The global file processing state -->
                                        <span class="fileupload-process"></span>
                                    </div>
                                    <!-- The global progress information -->
                                    <div class="col-lg-5 fileupload-progress fade">
                                        <!-- The global progress bar -->
                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                        </div>
                                        <!-- The extended global progress information -->
                                        <div class="progress-extended">&nbsp;</div>
                                    </div>
                                </div>
                                <!-- The table listing the files available for upload/download -->
                                <table role="presentation" class="table table-striped clearfix">
								<thead>
									<th>Video</th>
									<th>Download</th>
									<th>Title</th>
									<th>Size</th>
									<th>Action</th>
								</thead>
								<tbody class="files"></tbody></table>
                            <?php print form_close() ."\r\n"; ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>  
	   </div>
    </div>
    </div>
</div>