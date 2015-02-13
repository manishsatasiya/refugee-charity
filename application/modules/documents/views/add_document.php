<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-md-12">
    <div class="grid simple">
        <div class="grid-title">
            <h4>Add Document</h4>
        </div>
        <div class="grid-body ">
        	<?php print form_open_multipart('documents/add_document/'.$id, array('id' => 'add_document','name'=>'add_document')) ."\r\n"; ?>
        	<?php
			if ($this->session->flashdata('message')) {
				print "<br><div class=\"alert alert-error\">". $this->session->flashdata('message') ."</div>";
			}
			?>
            <div class="containerfdfdf"></div>
            <div class="row form-row">
                <div class="col-md-6">
                    <?php print form_label('Campus', 'campus_id',array('class'=>'form-label')); ?>
                    <?php //print form_dropdown('campus_id',$campus_list,($rowdata)?$rowdata->campus_id:$this->session->flashdata('campus_id'),'id="campus_id" class="select2 form-control"'); ?>
                    <?php print form_multiselect('campus_id[]',$campus_list,($rowdata)?$rowdata->campus_id:$this->session->flashdata('campus_id'),'id="multi" class="select2 form-control" placeholder="Select Campus"');  ?> 
                </div>
                <div class="col-md-6">
                    <?php print form_label('Document Type', 'document_type',array('class'=>'form-label')); ?>
                    <?php
                    $document_type = ($rowdata)?$rowdata->document_type:$user_department_id;
                    if ($this->session->userdata('role_id') != '1') {
                        //$document_type = $user_department_id; 
                        ?>
                        <script type="text/javascript">
                          $(document).ready(function(){
                            $('#document_type').prop('readonly', true);
                          });                      
                        </script>
                        <?php
                    }
                    ?>
                    <?php print form_dropdown('document_type',$document_types,($document_type)?$document_type:$this->session->flashdata('document_type'),'id="document_type" class="select2 form-control"'); ?>
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
            
            <div class="row form-row">
                <div class="col-md-12">               	
             		<input type="submit" name="submit" value="Submit" class="btn btn-success btn-cons">
                </div>
            </div>
            </div>	
		</div>
    </div>
</div>