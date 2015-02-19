<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  ?>

<div class="row">
  <div class="col-md-12">
    <?php $this->load->view('generic/flash_error'); ?>
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-th-list font-green-sharp"></i>
          <span class="caption-subject font-green-sharp bold uppercase"><?php echo $this->lang->line('documents'); ?></span>
        </div>
        <div class="actions"></div>
      </div>
      <div class="portlet-body generaltab">      
        <form name="formmain"></form>
        <p>Click / Right click on the link to save the document you wish to download.</p>
        <div class="m-b-15">
          <div class="row">
            <div class="col-md-12">
              <div class="sub-title">Human Resources</div>
              <ul>
                <?php 
        if(count($all_documents['human_resources']) > 0 ) {
          foreach($all_documents['human_resources'] as $document) {             
        ?>
                 <li> <a href="<?php echo base_url().$document['file']; ?>" target="_blank"><?php echo $document['name']; ?></a>
                <?php if($this->session->userdata('role_id') == '1' || in_array("add_document",$this->arrAction)): ?>
                  <div class="pull-right"><a href="<?php echo base_url().'documents/add_document/'.$document['document_id']; ?>" class="btn btn-small btn-success ">Edit</a> <a href="#" onclick="javascript:deleterecord('documents',<?php echo $document['document_id']; ?>);" class="btn btn-small btn-danger ">Delete</a></div>
                <?php endif; ?>
                </li>
                <?php
          }
        }else {
        ?>
                <li> No document found. </li>
                <?php
        } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="m-b-15">
          <div class="row">
            <div class="col-md-12">
              <div class="sub-title">Assessment</div>
              <ul>
                <?php 
        if(count($all_documents['assessment']) > 0 ) {
          foreach($all_documents['assessment'] as $document) {
        ?>
                 <li> <a href="<?php echo base_url().$document['file']; ?>" target="_blank"><?php echo $document['name']; ?></a>
                <?php if($this->session->userdata('role_id') == '1' || in_array("add_document",$this->arrAction)): ?>
                  <div class="pull-right"><a href="<?php echo base_url().'documents/add_document/'.$document['document_id']; ?>" class="btn btn-small btn-success ">Edit</a> <a href="#" onclick="javascript:deleterecord('documents',<?php echo $document['document_id']; ?>);" class="btn btn-small btn-danger ">Delete</a></div>
                <?php endif; ?>
                </li>
                <?php
          }
        }else {
        ?>
                <li> No document found. </li>
                <?php
        } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="m-b-15">
          <div class="row">
            <div class="col-md-12">
              <div class="sub-title">Professional Development</div>
              <ul>
                <?php 
        if(count($all_documents['professional_development']) > 0 ) {
          foreach($all_documents['professional_development'] as $document) {
        ?>
                <li> <a href="<?php echo base_url().$document['file']; ?>" target="_blank"><?php echo $document['name']; ?></a>
                <?php if($this->session->userdata('role_id') == '1' || in_array("add_document",$this->arrAction)): ?>
                  <div class="pull-right"><a href="<?php echo base_url().'documents/add_document/'.$document['document_id']; ?>" class="btn btn-small btn-success ">Edit</a> <a href="#" onclick="javascript:deleterecord('documents',<?php echo $document['document_id']; ?>);" class="btn btn-small btn-danger ">Delete</a></div>
                <?php endif; ?>
                </li>
                <?php
          }
        }else {
        ?>
                <li> No document found. </li>
                <?php
        } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="m-b-15">
          <div class="row">
            <div class="col-md-12">
              <div class="sub-title">Curriculum</div>
              <ul>
                <?php 
        if(count($all_documents['curriculum']) > 0 ) {
          foreach($all_documents['curriculum'] as $document) {
        ?>
                <li> <a href="<?php echo base_url().$document['file']; ?>" target="_blank"><?php echo $document['name']; ?></a>
                <?php if($this->session->userdata('role_id') == '1' || in_array("add_document",$this->arrAction)): ?>
                  <div class="pull-right"><a href="<?php echo base_url().'documents/add_document/'.$document['document_id']; ?>" class="btn btn-small btn-success ">Edit</a> <a href="#" onclick="javascript:deleterecord('documents',<?php echo $document['document_id']; ?>);" class="btn btn-small btn-danger ">Delete</a></div>
                <?php endif; ?>
                </li>
                <?php
          }
        }else {
        ?>
                <li>No document found.</li>
                <?php
        } ?>
              </ul>
            </div>
          </div>
        </div>   
      </div>
    </div>
  </div>
</div>