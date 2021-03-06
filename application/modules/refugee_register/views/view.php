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
<script type="text/javascript">
var refugee_id = <?=$id?>;
</script>
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
                <li>
                  <a href="#tab_1_6" data-toggle="tab" data-tab-numb="5" class="tab_clicked"><?php print $this->lang->line('activity_report'); ?></a>
                </li>
                <li>
                  <a href="#tab_1_7" data-toggle="tab" data-tab-numb="6" class="tab_clicked"><?php print $this->lang->line('discussions'); ?></a>
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
                    <form class="form-horizontal" role="form">
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
                                    <?php print form_label($this->lang->line('association_name').':', 'association_name',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo getComboValue(($rowdata)?$rowdata->association_name:'',$associatoin_name_list); ?> </p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('full_name').':', 'full_name',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->full_name:'' ?> </p>
                                    </div>
                                 </div>
                            </div>
						</div>
                        <div class="row">		
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('age').':', 'age',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo getComboValue(($rowdata)?$rowdata->age:'',$age_list); ?> </p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('gender').':', 'gender',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->gender:''; ?> </p>
                                    </div>
                                 </div>
                            </div>
						</div>
                        <div class="row">		
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('nationality').':', 'nationality',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo getComboValue(($rowdata)?$rowdata->nationality:'',$nationality_list); ?> </p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('nationality_id_no').':', 'nationality_id_no',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->nationality_id_no:'' ?> </p>
                                    </div>
                                 </div>
                            </div>
						</div>
                        <div class="row">		
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('un_id').':', 'un_id',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->un_id:'' ?> </p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('marital_status').':', 'marital_status',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->marital_status:''; ?> </p>
                                    </div>
                                 </div>
                            </div>
						</div>
                        <div class="row">		
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('previous_occupation').':', 'previous_occupation',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->previous_occupation:'' ?> </p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('are_you_able_to_work').':', 'are_you_able_to_work',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo getComboValue(($rowdata)?$rowdata->are_you_able_to_work:'',$work_list); ?> </p>
                                    </div>
                                 </div>
                            </div>
						</div>
                        <div class="row">		
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('what_skills_do_you_have_for_working').':', 'what_skills_do_you_have_for_working',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->what_skills_do_you_have_for_working:'' ?> </p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row" id="refugee_sick_main">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php print form_label($this->lang->line('are_you_sick').':', 'are_you_sick',array('class'=>'control-label  col-md-9')); ?>
                                            <div class="col-md-3">
                                                <p class="form-control-static"><?php echo getComboValue(($rowdata)?$rowdata->are_you_sick:'',$sicklist); ?> </p>
                                            </div>
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
                                            <?php print form_label($this->lang->line('sick_reason').':', 'sick_reason',array('class'=>'control-label  col-md-3')); ?>
                                            <div class="col-md-9">
                                                <p class="form-control-static"><?php echo ($rowdata)?$rowdata->sick_reason:'' ?> </p>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                            </div>
						</div>
                        <div class="row">		
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('need_of_medicationequipment').':', 'need_of_medicationequipment',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo getComboValue(($rowdata)?$rowdata->need_of_medicationequipment:'',$medicationequipment_list); ?> </p>
                                    </div>
                                 </div>
                            </div>	
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('if_yes_please_specify').':', 'if_yes_please_specify',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->if_yes_please_specify:'' ?> </p>
                                    </div>
                                 </div>
                            </div>
						</div>
                        <div class="row">		
						    <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('where_do_you_live_location').':', 'where_do_you_live_location',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo getComboValue(($rowdata)?$rowdata->where_do_you_live_location:'',$refugee_location_list); ?> </p>
                                    </div>
                                 </div>
                            </div>	
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('do_you_live_in_tent_house').':', 'do_you_live_in_tent_house',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo getComboValue(($rowdata)?$rowdata->do_you_live_in_tent_house:'',$livelist); ?> </p>
                                    </div>
                                 </div>
                            </div>
						</div>
                        <div class="row">		
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('what_is_it_that_you_need_most').':', 'what_is_it_that_you_need_most',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->what_is_it_that_you_need_most:'' ?> </p>
                                    </div>
                                 </div>
                            </div>	
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('how_many_children_do_you_have').':', 'how_many_children_do_you_have',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->how_many_children_do_you_have:''; ?> </p>
                                    </div>
                                 </div>
                            </div>
						</div>
                        <div class="row">		
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('any_other_information').':', 'any_other_information',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->any_other_information:'' ?> </p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('special_case').':', 'special_case',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo getComboValue(($rowdata)?$rowdata->special_case:'',$specia_case_list); ?> </p>
                                    </div>
                                 </div>
                            </div>
						</div>
                        <div class="row">		
						    <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('special_case_more_info').':', 'special_case_more_info',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->special_case_more_info:'' ?> </p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php print form_label($this->lang->line('total_number_of_people_in_house').':', 'total_number_of_people_in_house',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->total_number_of_people_in_house:''; ?> </p>
                                    </div>
                                 </div>
                            </div>
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
                                            <a href="#" data-load="true" data-url="<?php print site_url('refugee_register/load_qualifications/'.$id.'/1'); ?>" class="reload"></a>
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
                                            <a href="#" data-load="true" data-url="<?php print site_url('refugee_register/load_family_members/'.$id.'/1'); ?>" class="reload"></a>
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
                    </form>
                </div>
				<?php
                if($id) { ?>
				<div class="tab-pane" id="tab_1_2">
                    <form class="form-horizontal" role="form">
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
    								<?php print form_label($this->lang->line('telephone_no').':', 'telephone_no',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->telephone_no:'' ?> </p>
                                    </div>
								 </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
    								<?php print form_label($this->lang->line('email').':', 'email',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->email:'' ?> </p>
                                    </div>
								 </div>
							</div>
						</div>
						<div class="row ">
							<div class="col-md-6">
								<div class="form-group">
    								<?php print form_label($this->lang->line('skype').':', 'skype',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->skype:'' ?> </p>
                                    </div>
								 </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
    								<?php print form_label($this->lang->line('whatsapp').':', 'whatsapp',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->whatsapp:'' ?> </p>
                                    </div>
								 </div>
							</div>
						</div>
						<div class="row ">
							<div class="col-md-6">
								<div class="form-group">
    								<?php print form_label($this->lang->line('other_contact').':', 'other_contact',array('class'=>'control-label  col-md-3')); ?>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo ($rowdata)?$rowdata->other_contact:'' ?> </p>
                                    </div>
								 </div>
							</div>
						</div>
					</div>
                    </form>
				</div>

                <div class="tab-pane " id="tab_1_3">
                    <link href="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
                    <link href="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
                    <link href="<?php print base_url(); ?>assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>

                    <div class="row">
                        <div class="col-md-12">
                            <?php print form_open_multipart('refugee_register/upload_photos/photo/'.$id, array('id' => 'fileupload','name'=>'upload_photos')) ."\r\n"; ?>
                                <!-- The table listing the files available for upload/download -->
                                <table role="presentation" class="table table-striped clearfix">
								<thead>
									<th>Thumb</th>
									<th>View</th>
									<th>Title</th>
									<th>Size</th>
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
                                <span class="title">{%=file.title%}</span>
                            </td>
                            <td>
                                <span class="size">{%=o.formatFileSize(file.size)%}</span>
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
                                <!-- The table listing the files available for upload/download -->
                                <table role="presentation" class="table table-striped clearfix">
								<thead>
									<th></th>
									<th>Download</th>
									<th>Title</th>
									<th>Size</th>
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
                                <!-- The table listing the files available for upload/download -->
                                <table role="presentation" class="table table-striped clearfix">
								<thead>
									<th>Video</th>
									<th>Download</th>
									<th>Title</th>
									<th>Size</th>
								</thead>
								<tbody class="files"></tbody></table>
                            <?php print form_close() ."\r\n"; ?>
                        </div>
                    </div>
                </div>

                <div class="tab-pane " id="tab_1_6">
                    <div class="row">
                        <div class="col-md-12">
                            <script type="text/javascript" src="<?php print base_url(); ?>js/grid/refugee_changes_log.js"></script>
                            <div class="table-container">
                                <table class="table table-striped table-bordered table-hover" id="grid_profile_changes_log">
                                    <thead>
                                        <tr>
                                            <th width="10%"><?php echo $this->lang->line('db_id'); ?></th>
                                            <th><?php echo $this->lang->line('change_by'); ?></th>
                                            <th><?php echo $this->lang->line('change_date'); ?></th>
                                            <th><?php echo $this->lang->line('view_log'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane " id="tab_1_7">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $profile_picture = get_profile_pic();
                            $profile_picture_40 = $profile_picture[40];
                            ?>
                            <!-- TASK COMMENTS -->
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="blog-page" id="refugee_discussion">
                                        <?php
                                        if ($discussions) {
                                          foreach ($discussions->result() as $discussion){ 
                                            $discussion_a_profile_picture = get_profile_pic($discussion->user_id);
                                            $discussion_a_profile_picture_40 = $discussion_a_profile_picture[40];
                                            ?>
                                            <div class="media">
                                                <a class="pull-left" href="javascript:;">
                                                    <img class="todo-userpic media-object" src="<?php print $discussion_a_profile_picture_40; ?>" width="27px" height="27px">
                                                </a>
                                                <div class="media-body" style="width: 10000px;">
                                                    <h4 class="media-heading"><?=$discussion->author_name?><span><?=date('m/d/y @ g:ia',strtotime($discussion->created_at))?></span></h4>
                                                    <p class="todo-text-color"><?=$discussion->comment?><br>
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                        <?php
                                          }
                                        } ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- END TASK COMMENTS -->
                            <!-- TASK COMMENT FORM -->
                            <div class="form-group">
                                <?php
                                print form_open('refugee_register/add_discussion/', array('id' => 'add_refugee_discussion','name'=>'formmain','onsubmit'=>'return add_refugee_discussion('.$id.');')) ."\r\n"; ?>
                                <div class="col-md-12">
                                    <div class="blog-page">
                                        <div class="media">
                                            <img class="todo-userpic pull-left media-object" src="<?php print $profile_picture_40; ?>" width="27px" height="27px">
                                            <div class="media-body">
                                                <?php print form_textarea(array('name' => 'comment', 'id' => 'comment', 'value' => '', 'class' => 'form-control todo-taskbody-taskdesc','cols'=>'150','rows'=>3)); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="pull-right btn btn-sm btn-circle green-haze" onclick="return add_refugee_discussion(<?=$id?>);"><i class="fa fa-reply"></i>&nbsp;<?php echo $this->lang->line('submit');?></button>
                                </div>
                                <?php 
                                print form_hidden('refugee_id',$id);
                                print form_close() ."\r\n"; ?>
                            </div>
                            <!-- END TASK COMMENT FORM -->
                        </div>
                    </div>
                </div>

                <?php } ?>
            </div>  
	   </div>
    </div>
    </div>
</div>