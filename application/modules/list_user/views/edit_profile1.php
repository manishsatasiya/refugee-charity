<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Loading....</h2>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <br />
      </div>
      <div class="modal-body">
        <div style="text-align:center;"><i class="fa fa-spinner fa fa-6x fa-spin" id="animate-icon"></i></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.form.js"></script>
<div id="p_info45">
  <h4><strong>Profile: <?php echo $user_data->first_name.' '.$user_data->last_name; ?> | <?php echo $user_data->elsd_id; ?></strong></h4>
</div>
<!-- Tab start -->
<div class="editprofile-pg">
  <div class="row">
    <div class="col-md-12">
      <div class="tabbable tabs-left">
        <input type="hidden" id="tab_id" value="<?=$tab_id?>" />
        <ul class="nav nav-tabs left-tab" id="tab-2">
          <li class="active"> <a href="#tab2Personal"><i class="fa fa-table"></i> My Personal Details</a></li>
          <li><a href="#tab2Contact"><i class="fa fa-tablet"></i> My Contact Details </a></li>
          <li><a href="#tab2Medical"><i class="fa fa-plus-square"></i> My Medical Details </a></li>
          <li><a href="#tab2Emergency"><i class="fa fa-fire-extinguisher"></i> My Emergency Contacts </a></li>
          <li><a href="#tab2CV"><i class="fa fa-file-o"></i> My Qualifications & Employment </a></li>
          <?php 
		if($this->session->userdata('role_id') == '1' || in_array("my_workshops",$this->arrAction))
		{
		?>
          <li><a href="#tab2Workshops"><i class="fa fa-wrench"></i> My Workshops </a></li>
          <?php 
		}
		if($this->session->userdata('role_id') == '1' || in_array("my_observations",$this->arrAction))
		{
		?>
          <li><a href="#tab2Observations"><i class="fa fa-lightbulb-o"></i> My Observations </a></li>
          <?php 
		}
		//if($this->session->userdata('role_id') == '1' || in_array("my_add_privilege",$this->arrAction))
		if($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '100')
		{
		?>
          <li><a href="#tab2Privilege"><i class="fa fa-credit-card"></i> Add Privilege </a></li>
          <?php 
		}
		if($this->session->userdata('role_id') == '1' || in_array("view_status_log",$this->arrAction))
		{
		?>
          <li><a href="#tab2ViewStatusLog"><i class="fa fa-chain"></i> View Status Log </a></li>
          <?php 
		}
		if($this->session->userdata('role_id') == '1' || in_array("my_pma",$this->arrAction))
		{
		?>
          <li><a href="#tab2mypma"><i class="fa fa-chain"></i> My PMA </a></li>
          <?php 
		}
		if($this->session->userdata('role_id') == '1' || in_array("my_attendance",$this->arrAction))
		{
		?>
          <li><a href="#tab2myattendance"><i class="fa fa-chain"></i> My Attendance </a></li>
          <?php 
		}
		if($this->session->userdata('role_id') == '1' || in_array("my_induction",$this->arrAction))
		{
		?>
          <li><a href="#tab2myinductions"><i class="fa fa-chain"></i> My Induction </a></li>
          <?php 
		}
		if($this->session->userdata('role_id') == '1' || in_array("my_timetable",$this->arrAction))
		{
		?>
          <li><a href="#tab2mytimetable"><i class="fa fa-chain"></i> My Timetable </a></li>
          <?php 
		}
		if($this->session->userdata('role_id') == '1' || in_array("my_cover",$this->arrAction))
		{
		?>
          <li><a href="#tab2mycover"><i class="fa fa-chain"></i> My Cover </a></li>
          <?php 
		}
		if($this->session->userdata('role_id') == '1' || in_array("my_requests",$this->arrAction))
		{
		?>
          <li><a href="#tab2myrequests"><i class="fa fa-chain"></i> My Requests </a></li>
          <?php 
		}
		if($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '3' || $isLineManager == 1){
	    ?>
          <li><a href="#tab2comments"><i class="fa fa-chain"></i> Comments </a></li>
          <?php 
		} ?>
          <?php 
        if(($this->session->userdata('user_id') && $this->session->userdata('user_id') == $user_id )) { ?>
          <li> <a href="#tab2mylessions"><i class="fa fa-chain"></i> My Lesson Observations </a> </li>
          <!-- li>
            <a href="#tab2lessonObservation"><i class="fa fa-chain"></i> Lesson Observations </a>
        </li-->
          <?php } ?>
          <li> <a href="#tab2My_Line_Management_Attendance"><i class="fa fa-chain"></i> My Line Management Attendance </a> </li>
          <?php
		if($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '100' || ($this->session->userdata('user_id') && $this->session->userdata('user_id') == $user_id )) { 
		?>
          <li style="background:none;">
            <div class="edit-profile-tab"><a href="#tab2Edit" class="btn btn-info">Edit Profile </a></div>
          </li>
          <?
		}
		?>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active generaltab" id="tab2Personal">
            <h3 class="userinfo-ttl">Personal Information</h3>
            <div class="basic-info info-box">
              <div class="row">
                <div class="col-md-3">
                  <div class="user-avtar">
                    <div class="avtar-in"> <img src="<?php echo $profile_picture;?>" id="previewimg" width="198" height="197" />
                      <?php
                    if($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '100'):
                    ?>
                      <a href="javascript:void(0)" class="chng-pic hashtags transparent" onclick="changepic();">
                      <?php  print $this->lang->line('pro_p_change_pic'); ?>
                      </a>
                      <?php endif; ?>
                    </div>
                  </div>
                  <?php
				print form_open('list_user/upload_profile_pic', array('id' => 'uploadpic_form')) ."\r\n";
					print form_upload(array('name' => 'uploadpic', 'id' => 'uploadpic', 'value' => '', 'onchange'=>'previewUploadImg(this)', 'style'=>'display:none;'));
					print form_hidden('user_id', ($user_data)?$user_data->user_unique_id:0);
				print form_close(); ?>
                </div>
                <div class="col-md-9 personal-info">
                  <div class="sub-title"> Personal Details </div>
                  <ul>
                    <li>Full name: <?php echo $user_data->first_name.' '.$user_data->middle_name.' '.$user_data->last_name; ?></li>
                    <li>
                      <div class="row">
                        <div class="col-md-4">Dob:<?php echo $user_data->birth_date; ?></div>
                        <div class="col-md-8">Gender:
                          <?php if($user_data->gender == 'M') { echo 'Male'; }elseif($user_data->gender == 'F') { echo 'Female'; } ?>
                        </div>
                      </div>
                    </li>
                    <li>Nationality: <?php echo $user_data->nationality_name; ?></li>
                    <li>Marital Status: <?php echo $user_data->marital_status; ?></li>
                    <li>Languages: <?php echo $user_data->language_known; ?></li>
                    <li>Last Login: <?php echo date("l, d M Y - H:i:s",strtotime($user_data->last_login_date)); ?></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="info-box emply-info">
              <div class="row">
                <div class="col-md-12">
                  <div class="sub-title"> Employment Information </div>
                  <ul>
                    <li class="emply-info1"> Job Title: <?php echo $user_data->job_title_name; ?> </li>
                    <li>
                      <div class="col-md-6">Current Year Joining Date: <?php echo $user_data->cy_joining_date; ?></div>
                      <div class="col-md-6">Original Joining Date: <?php echo $user_data->original_start_date; ?></div>
                    </li>
                    <li>Returning Employee:
                      <?php if($user_data->returning == '2') { echo 'No'; }elseif($user_data->returning == '1') { echo 'Yes'; } ?>
                    </li>
                    </li>
                    <li>
                      <div class="col-md-6">Department:
                        <?php if(isset($department_list[$user_data->department_id]) && $user_data->department_id > 0) { echo $department_list[$user_data->department_id]; } ?>
                      </div>
                      <div class="col-md-6">Hand Scan ID: <?php echo $user_data->scanner_id; ?></div>
                    </li>
                    <li>
                      <div class="col-md-6">Contractor: <?php echo $user_data->contractor_name; ?></div>
                      <div class="col-md-6">Campus: <?php echo $user_data->campus_name; ?></div>
                    </li>
                    <li class="line-mangr">Line Manager: <?php echo $user_data->line_manager; ?></li>
                  </ul>
                </div>
              </div>
            </div>
            <?php /*?><div class="info-box duty-info">
            <div class="row">
              <div class="col-md-12">
                <div class="sub-title">Duties</div>
                <ul>
                  <li class="duty-info1"> General duties: <?php echo $user_data->duties; ?> </li>
                </ul>
              </div>
            </div>
          </div><?php */?>
            <?php /*?><?php if(!empty($user_data->last_day_of_work)) { ?>
          <div class="info-box depart-info">
            <div class="row">
              <div class="col-md-12">
                <div class="sub-title">Departure Details: </div>
                <ul>
                  <li>Last day of Work:
                    <?php if( $user_data->last_day_of_work == NULL || empty($user_data->last_day_of_work) || $user_data->last_day_of_work=='0000-00-00')
                                        echo 'n/a';
                                    else 
                                        echo date("l, d F Y",strtotime($user_data->last_day_of_work));
                                    ?>
                  </li>
                  <li>Reason for leaving: &nbsp; &nbsp; <?php echo $user_data->resignation_resons; ?> </li>
                  <li>Departure Notes: &nbsp; &nbsp; <?php echo $user_data->departure_notes; ?> </li>
                  <li>Final Exit approved: &nbsp; &nbsp;
                    <?php if( empty($user_data->exit_cleared )) 
                                        echo 'n/a';
                                    elseif( $user_data->exit_cleared == 1 )
                                        echo 'Yes';
                                    else
                                        echo 'No';
                                    ?>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <?php } ?><?php */?>
            <div class="info-box other-info">
              <div class="row">
                <div class="col-md-12">
                  <div class="sub-title">Other Information</div>
                  <ul>
                    <li>
                      <?php 
				  if($user_data->created_date != '0000-00-00' && $user_data->created_date != '' && $user_data->created_date != NULL)
				  {
				  ?>
                      Date Added:
                      <?	echo date("l, d-M-Y",strtotime($user_data->created_date)); ?>
                      <br />
                      <?
				  }
				   
				  if($user_data->updated_date != '0000-00-00' && $user_data->updated_date != '' && $user_data->updated_date != NULL)
				  {
				  ?>
                      Personal Details Updated: <?php echo date("l, d-M-Y",strtotime($user_data->updated_date)); ?>
                      <?
				  }
				  if($user_data->change_by_name != "")
				  {
				  ?>
                      | by: <?php echo $user_data->change_by_name; ?> <br />
                      <?
				  }	
				  ?>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!--
        *****************************************************************
                              MANISH LOOK AT THIS
        *****************************************************************
        -->
          <div class="tab-pane generaltab" id="tab2mypma">
            <h3 class="userinfo-ttl"> My PMA
              <div class="pull-right">
                <input type="button" value="Print" class="btn btn-white btn-sm btn-small" onclick="PrintDiv('divToPrint');" />
              </div>
            </h3>
            <div class="row" id="divToPrint" >
              <div class="col-md-12 ">
                <div class="sub-title"> Teacher Info
                  <div class="pull-right">Your status is: <?php echo $user_profile_status[$user_data->status]; ?></div>
                </div>
                <table class="table table-bordered no-more-tables">
                  <thead>
                    <tr>
                      <th>Teacher's Name</th>
                      <th>ELSD ID</th>
                      <th>Company</th>
                      <th>Line Manager</th>
                      <th>Academic Joining Date</th>
                      <th>Nationality</th>
                      <th>Relevant Exp</th>
                      <th>Original joining date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $user_data->first_name.' '.$user_data->middle_name.' '.$user_data->last_name; ?></td>
                      <td><?php echo $user_data->elsd_id; ?></td>
                      <td><?php echo $user_data->contractor_name; ?></td>
                      <td><?php echo $user_data->line_manager; ?></td>
                      <td><?php echo make_dp_date($user_data->cy_joining_date); ?></td>
                      <td><?php echo $user_data->nationality_name; ?></td>
                      <td><?php echo $user_data->teaching_experience; ?></td>
                      <td><?php echo make_dp_date($user_data->original_start_date); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="clear"></div>
              <p></p>
              <div class="col-md-12 ">
                <div class="sub-title"> Qualification & Certificate Information </div>
                <table class="table table-bordered no-more-tables">
                  <thead>
                    <tr>
                      <th>Qualification</th>
                      <th>Subject</th>
                      <th>Verified</th>
                      <th>Requirements</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                  if(!empty($user_data->user_qualification))
                  { 
                    foreach($user_data->user_qualification as $qualification)
                    { 
                      $Requirements = '';
                      if($qualification['accredited'] == 1 && $qualification['in_class'] == 1){
                        $Requirements = 'Meets Requirements';
                      }else{
                        $Requirements = 'Does Not Meets Requirements';
                      }

                      ?>
                    <tr>
                      <td><?php echo $qualification['qualification']; ?></td>
                      <td><?php echo $qualification['subject']; ?></td>
                      <td><?php echo $qualification['verified']; ?> </td>
                      <td><?php echo $Requirements; ?></td>
                    </tr>
                    <?php
                      }
                  }?>
                    <?php
                    if(!empty($user_data->user_certificate))
                    { 
                      foreach($user_data->user_certificate as $certificate)
                      { 
                        $Requirements = '';
                        if($certificate['accredited'] == 1 && $certificate['in_class'] == 1 && $certificate['hours'] == 1 && $certificate['hours_teaching'] == 1){
                          $Requirements = 'Meets Requirements';
                        }else{
                          $Requirements = 'Does Not Meets Requirements';
                        }
                        ?>
                    <tr>
                      <td><?php echo $certificate['qualification']; ?></td>
                      <td>-</td>
                      <td><?php echo $certificate['verified']; ?> </td>
                      <td><?php echo $Requirements; ?></td>
                    </tr>
                    <?php
                        }
                    } ?>
                  </tbody>
                </table>
              </div>
              <div class="clear"></div>
              <p></p>
              <div class="col-md-12 ">
                <div class="sub-title"> Unit KPI Data
                  <div class="clear"></div>
                  <div class="col-md-4">1 = Below Expectation</div>
                  <div class="col-md-4">2 = Meets Expectation</div>
                  <div class="col-md-4">3 = Above Expectation</div>
                </div>
                <table class="table table-bordered no-more-tables">
                  <tbody>
                    <tr>
                      <td width="16.66%">Curriculum</td>
                      <td width="16.66%"><?php echo (isset($user_data->user_pma_data->curr_curr)) ? '<span class="unit_kpi_'.$user_data->user_pma_data->curr_curr .'">'.$user_data->user_pma_data->curr_curr.'</span>' : '';  ?> </td>
                      <td width="16.66%">Continuous Assessment</td>
                      <td width="16.66%"><?php echo (isset($user_data->user_pma_data->ass_ca)) ? '<span class="unit_kpi_'.$user_data->user_pma_data->ass_ca .'">'.$user_data->user_pma_data->ass_ca.'</span>' : '';  ?> </td>
                      <td width="16.66%">Student attendance</td>
                      <td width="16.66%"><?php echo (isset($user_data->user_pma_data->aa_sas)) ? '<span class="unit_kpi_'.$user_data->user_pma_data->aa_sas .'">'.$user_data->user_pma_data->aa_sas.'</span>' : '';  ?></td>
                    </tr>
                  <td>PD Contribution and Participation</td>
                    <td><?php echo (isset($user_data->user_pma_data->pd_con)) ? '<span class="unit_kpi_'.$user_data->user_pma_data->pd_con .'">'.$user_data->user_pma_data->pd_con.'</span>' : '';  ?></td>
                    <td>Assessment</td>
                    <td><?php echo (isset($user_data->user_pma_data->ass_ass)) ? '<span class="unit_kpi_'.$user_data->user_pma_data->ass_ass .'">'.$user_data->user_pma_data->ass_ass.'</span>' : '';  ?> </td>
                    <td>Cover Duty</td>
                    <td><?php echo (isset($user_data->user_pma_data->aa_cd)) ? '<span class="unit_kpi_'.$user_data->user_pma_data->aa_cd .'">'.$user_data->user_pma_data->aa_cd.'</span>': '';  ?> </td>
                  </tr>
                  <td>PD Full Lesson Observation</td>
                    <td><?php if(isset($user_data->user_pma_data->observation_1)) {
                          $observation_max =  max($user_data->user_pma_data->observation_1,$user_data->user_pma_data->observation_2);
                          if ($observation_max <> '') {
                            echo 'OB '.$observation_max.' | ';
                          }
                          echo 'ET '.max($user_data->user_pma_data->ed_tech_score_1,$user_data->user_pma_data->ed_tech_score_2);
                        }  ?>
                    </td>
                    <td>Educational Technology</td>
                    <td><?php echo (isset($user_data->user_pma_data->et_et)) ? '<span class="unit_kpi_'.$user_data->user_pma_data->et_et .'">'.$user_data->user_pma_data->et_et.'</span>' : '';  ?></td>
                    <td>Cross-Departmental Invigilation</td>
                    <td><?php echo (isset($user_data->user_pma_data->aa_cdi)) ? '<span class="unit_kpi_'.$user_data->user_pma_data->aa_cdi .'">'.$user_data->user_pma_data->aa_cdi.'</span>' : '';  ?></td>
                  </tr>
                  <td>Approved</td>
                    <td><div style="width:45%;margin: 0 5% 0 0;float: left;text-align: center;border-right: solid 1px;">%</div></td>
                    <td>Lateness</td>
                    <td><div style="width:55%;margin: 0 5% 0 0;float: left;text-align: center;border-right: solid 1px;">% <?php echo (isset($user_data->user_pma_data->ahr_lt_per)) ? $user_data->user_pma_data->ahr_lt_per : '';  ?></div>
                      <?php echo (isset($user_data->user_pma_data->ahr_lt)) ? $user_data->user_pma_data->ahr_lt : '';  ?></td>
                    <td>Absence Rate</td>
                    <td><div style="width:55%;margin: 0 5% 0 0;float: left;text-align: center;border-right: solid 1px;">% <?php echo (isset($user_data->user_pma_data->ahr_abs_per)) ? $user_data->user_pma_data->ahr_abs_per : '';  ?></div>
                      <?php echo (isset($user_data->user_pma_data->aa_sas)) ? $user_data->user_pma_data->ahr_abs : '';  ?></td>
                  </tr>
                  <td>Maintenance of Data</td>
                    <td><?php echo (isset($user_data->user_pma_data->miu_md)) ? '<span class="unit_kpi_'.$user_data->user_pma_data->miu_md .'">'.$user_data->user_pma_data->miu_md.'</span>' : '';  ?></td>
                    <td>Induction</td>
                    <td><?php echo (isset($user_data->user_pma_data->ahr_ind)) ? $user_data->user_pma_data->ahr_ind : '';  ?></td>
                    <td>Disciplinary Action</td>
                    <td><?php echo (isset($user_data->user_pma_data->ahr_dis)) ? $user_data->user_pma_data->ahr_dis : '';  ?></td>
                  </tr>
                  <td>Use of Support System</td>
                    <td><?php echo (isset($user_data->user_pma_data->miu_uss)) ? '<span class="unit_kpi_'.$user_data->user_pma_data->miu_uss .'">'.$user_data->user_pma_data->miu_uss.'</span>' : '';  ?> </td>
                    <td>Valid Student Complaint</td>
                    <td><?php echo (isset($user_data->user_pma_data->sa_vsc)) ? $user_data->user_pma_data->sa_vsc : '';  ?></td>
                    <td>Concerns | Praise</td>
                    <td><?php echo (isset($user_data->pma_comment_count['valid_count'])) ? $user_data->pma_comment_count['valid_count'] : '0';  ?> | <?php echo (isset($user_data->pma_comment_count['praise'])) ? $user_data->pma_comment_count['praise'] : '0';  ?></td>
                  </tr>
                  <tr>
                    <td>Line Managers Meeting</td>
                    <td><?php echo (isset($user_data->user_pma_data->ahr_lmm)) ? $user_data->user_pma_data->ahr_lmm : '';  ?> </td>
                    <td>Absent: <?php echo (isset($user_data->pma_att_count['absent'])) ? $user_data->pma_att_count['absent'] : '';  ?></td>
                    <td>Late: <?php echo (isset($user_data->pma_att_count['late'])) ? $user_data->pma_att_count['late'] : '';  ?></td>
                    <td>Off Campus: <?php echo (isset($user_data->pma_att_count['not_on_campus'])) ? $user_data->pma_att_count['not_on_campus'] : '';  ?></td>
                    <td>Other Duties: <?php echo (isset($user_data->pma_att_count['other_duties'])) ? $user_data->pma_att_count['other_duties'] : '';  ?></td>
                  </tr>
                  </tbody>
                  
                </table>
              </div>
              <div class="clear"></div>
              <p></p>
              <div class="col-md-12 ">
                <div class="sub-title"> Appraisal meeting </div>
                <table class="table table-bordered no-more-tables">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Venue</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($user_data->user_appraisals)
                    { 
                      foreach($user_data->user_appraisals->result_array() as $_user_appraisals_data)
                      { 
                        ?>
                      <tr>
                        <td><?php echo make_dp_date($_user_appraisals_data['datetime']); ?></td>
                        <td><?php echo date("H:i",strtotime($_user_appraisals_data['datetime'])); ?></td>
                        <td><?php echo $_user_appraisals_data['venue']; ?></td>
                      </tr>
                      <?php
                      }
                    }else{?>
                      <tr>
                        <td colspan="3" align="center">No data found.</td>
                      </tr>
                    <?php
                    } ?>
                  </tbody>
                </table>
              </div>
              <div class="clear"></div>
              <p></p>
              <div class="col-md-12 ">
                <div class="sub-title"> Previous Concerns </div>
                <div style="min-height:100px; border:solid 1px;">
                  <?php 
                  if(isset($user_data->user_pma_data->previous_concerns)) { ?>
                  <?php echo '<span id="current_previous_concerns"><p style="margin: 5px;">'.$user_data->user_pma_data->previous_concerns.'</p></span>'; ?>
                  <?php } ?>
                </div>
              </div>
              <div class="clear"></div>
              <p></p>
              <div class="col-md-12 ">
                <div class="sub-title"> Previous PMA Score </div>
                <table class="table table-bordered no-more-tables pma_score_grade">
                  <thead>
                    <tr>
                      <th>Year</th>
                      <th>Semester</th>
                      <th>Grade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                  if($user_data->user_previous_pma_score)
                  { 
                    foreach($user_data->user_previous_pma_score->result_array() as $_user_previous_pma_score_data)
                    { 
                      ?>
                    <tr>
                      <td><?php echo $_user_previous_pma_score_data['pma_year']; ?></td>
                      <td><?php echo $_user_previous_pma_score_data['pma_semester']; ?></td>
                      <td><span class="pma_score_grade_<?php echo $_user_previous_pma_score_data['pma_grade']; ?>"><?php echo $_user_previous_pma_score_data['pma_grade']; ?> </span></td>
                    </tr>
                    <?php
                    }
                  }?>
                  </tbody>
                </table>
              </div>
              <div class="clear"></div>
              <p></p>
              
              <div class="col-md-12 " id="teacher_comment_main">
                <div class="sub-title"> Teacher's Comment
                  <?php 
                if(isset($user_data->user_pma_data->teacher_comment_editable) && $user_data->user_pma_data->teacher_comment_editable == 1 && in_array("add_pma_comment",$this->arrAction)) { ?>
                  <div class="pull-right"><a href="javascript:void(0);" class="btn btn-small btn-white" id="add_teacher_comment">Add Your Comment</a> </div><?php
                } ?>
                </div>
                <div style="min-height: 60px; border:solid 1px;float: left;width: 100%;">
                  <?php echo '<span id="current_teacher_comment"><p style="margin: 5px;">'.$user_data->user_pma_data->teacher_comment.'</p></span>'; ?> 
                  <span id="current_teacher_comment_edit" style="display:none;float: left;width: 100%;margin: 5px;"> 
                    <?php print form_open('list_user/save_teacher_comment/teacher_comment/'.encrypt_decrypt('e', $user_data->user_unique_id).'', array('id' => '','name'=>'')) ."\r\n"; ?>
                      <textarea style="width: 614px;" name="teacher_comment"><?=$user_data->user_pma_data->teacher_comment; ?>
</textarea>
                      <input type="submit" class="btn" name="submit" value="Save">
                  </form>
                  </span>
                </div>
              </div>
              <div class="clear"></div>
              <p></p>
              <div class="col-md-12 ">
                <div class="sub-title">Teacher's Review</div>
              </div>
              <div class="clear"></div>
              <p></p>
              <?php print form_open('list_user/save_teacher_review/'.encrypt_decrypt('e', $user_data->user_unique_id).'', array('id' => '','name'=>'')) ."\r\n"; ?>
              <div class="col-md-6 ">
                <div class="sub-title">1. Strengths </div>
                <div style="min-height:100px; border:solid 1px; padding:5px;">
                  <?php 
                  if(isset($user_data->user_pma_data->teacher_review_editable) && $user_data->user_pma_data->teacher_review_editable == 1 && in_array("add_pma_comment",$this->arrAction)) { ?>
                  <textarea style="width: 340px; height:50px;" name="teacher_strengths"><?=$user_data->user_pma_data->teacher_strengths; ?>
</textarea>
                  <?php
                  }else{
                    echo "<p>".$user_data->user_pma_data->teacher_strengths."</p>";
                  } ?>
                </div>
                <div class="clear"></div>
              </div>
              <div class="col-md-6 ">
                <div class="sub-title">2. Improvements </div>
                <div style="min-height:100px; border:solid 1px; padding:5px;">
                  <?php 
                  if(isset($user_data->user_pma_data->teacher_review_editable) && $user_data->user_pma_data->teacher_review_editable == 1 && in_array("add_pma_comment",$this->arrAction)) { ?>
                    <textarea style="width: 340px; height:50px;" name="teacher_improvements"><?=$user_data->user_pma_data->teacher_improvements; ?>
</textarea>
                    <?php
                  }else{
                    echo "<p>".$user_data->user_pma_data->teacher_improvements."</p>";
                  } ?>
                </div>
                <div class="clear"></div>
              </div>
              <div class="clear"></div>
              <p></p>
              <div class="col-md-12 text-center">
                  <?php 
                  if(isset($user_data->user_pma_data->teacher_review_editable) && $user_data->user_pma_data->teacher_review_editable == 1 && in_array("add_pma_comment",$this->arrAction)) { ?>
                    <input type="submit" class="btn" name="submit" value="Save">
                    <?php
                  } ?>
              </div>
              </form>
              <div class="clear"></div>
              <p></p>
              <div class="col-md-12 " id="line_manager_comment_main">
                <div class="sub-title"> Line Manager's Comment 
                  <?php 
                if(isset($user_data->user_pma_data->line_manager_comment_editable) && $user_data->user_pma_data->line_manager_comment_editable == 1 && in_array("add_line_manager_comment",$this->arrAction)) { ?>
                  <div class="pull-right"><a href="javascript:void(0);" class="btn btn-small btn-white" id="add_line_manager_comment">Add Your Comment</a> </div><?php
                } ?>
                </div>
                <div style="min-height:100px; border:solid 1px;">
                  <?php echo '<span id="current_line_manager_comment"><p style="margin: 5px;">'.$user_data->user_pma_data->line_manager_comment.'</p></span>'; ?> 
                  <span id="current_line_manager_comment_edit" style="display:none;float: left;width: 100%;margin: 5px;"> 
                    <?php print form_open('list_user/save_teacher_comment/line_manager_comment/'.encrypt_decrypt('e', $user_data->user_unique_id).'', array('id' => '','name'=>'')) ."\r\n"; ?>
                      <textarea style="width: 614px; height:50px;" name="line_manager_comment"><?=$user_data->user_pma_data->line_manager_comment; ?>
</textarea>
                      <input type="submit" class="btn" name="submit" value="Save">
                  </form>
                  </span>
                </div>
              </div>
              <div class="clear"></div>
              <p></p>
              <div class="col-md-12 " id="line_manager_targets_main">
                <div class="sub-title"> Agreed Targets 
                  <?php 
                if(isset($user_data->user_pma_data->line_manager_targets_editable) && $user_data->user_pma_data->line_manager_targets_editable == 1 && in_array("add_line_manager_targets",$this->arrAction)) { ?>
                  <div class="pull-right"><a href="javascript:void(0);" class="btn btn-small btn-white" id="add_line_manager_targets">Add Your Comment</a> </div><?php
                } ?>
                </div>
                <div style="min-height:100px; border:solid 1px;">
                  <?php echo '<span id="current_line_manager_targets"><p style="margin: 5px;">'.$user_data->user_pma_data->line_manager_targets.'</p></span>'; ?> 
                  <span id="current_line_manager_targets_edit" style="display:none;float: left;width: 100%;margin: 5px;"> 
                    <?php print form_open('list_user/save_teacher_comment/line_manager_targets/'.encrypt_decrypt('e', $user_data->user_unique_id).'', array('id' => '','name'=>'')) ."\r\n"; ?>
                      <textarea style="width: 614px; height:50px;" name="line_manager_targets"><?=$user_data->user_pma_data->line_manager_targets; ?>
</textarea>
                      <input type="submit" class="btn" name="submit" value="Save">
                  </form>
                  </span>
                </div>
              </div>
              <div class="clear"></div>
              <p></p>
            </div>
          </div>
          <div class="tab-pane generaltab" id="tab2mytimetable">
            <h3 class="userinfo-ttl"> My Timetable</h3>
            <div class="info-box private-info">
              <div class="row">
                <div class="col-md-12">
                  <div class="sub-title">Teacher Shift Time:</div>
                  <strong>Teacher Shift Time:</strong> <?php echo $teacher_timetable['teacher_shift_time'];?> </div>
              </div>
            </div>
            <?
            if(isset($teacher_timetable['teacher_course_time']) && count($teacher_timetable['teacher_course_time']) > 0) 
            {
              $count_class = 0;
              foreach ($teacher_timetable['teacher_course_time'] as $teacher_course_time) 
              {
              	$count_class++;
            ?>
            <div class="info-box class-info">
              <div class="row">
                <div class="col-md-12">
                  <div class="sub-title">Class <?echo $count_class;?></div>
                  <ul>
                    <li>Section_title : <? echo $teacher_course_time['section_title'];?></li>
                    <li>Course title : <? echo $teacher_course_time['course_title'];?></li>
                    <li>Class room title : <? echo $teacher_course_time['class_room_title'];?></li>
                    <li>Section time : <? echo $teacher_course_time['section_shift_time'];?></li>
                    <li>Secondary teacher : <? echo $teacher_course_time['secondary_teacher'];?></li>
                  </ul>
                </div>
              </div>
            </div>
            <?	
              }
            }
            ?>
          </div>
          <div class="tab-pane generaltab" id="tab2mycover">
            <h3 class="userinfo-ttl"> My Cover</h3>
          </div>
          <div class="tab-pane generaltab" id="tab2myrequests">
            <h3 class="userinfo-ttl"> My Requests</h3>
          </div>
          <div class="tab-pane generaltab" id="tab2Contact">
            <h3 class="userinfo-ttl">Contact Details</h3>
            <div class="info-box address-info">
              <div class="row">
                <div class="col-md-12">
                  <div class="sub-title">Address:</div>
                  <ul class="">
                    <?php 
          if( $user_data->address1 ){ ?>
                    <li>
                      <?php ucwords($user_data->address1) ?>
                    </li>
                    <li>
                      <?php ucwords($user_data->address2) ?>
                      ,
                      <?php ucwords($user_data->city) ?>
                    </li>
                    <li>
                      <?php strtoupper($user_data->zip) ?>
                      ,
                      <?php ucwords($user_data->country) ?>
                    </li>
                    <?php  
          }else{
               echo '<li><em>No address listed please add an address.</em></li>';
          }
          ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="info-box private-info">
              <div class="row">
                <div class="col-md-12">
                  <div class="sub-title">Private Details:</div>
                  <ul>
                    <li><i class="fa fa-pencil-square-o"></i> T: <?php echo $user_data->home_phone; ?> </li>
                    <li><i class="fa fa-pencil-square-o"></i> M: <?php echo $user_data->cell_phone; ?></li>
                    <li><i class="fa fa-pencil-square-o"></i> Email: <?php echo $user_data->personal_email; ?></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="info-box work-info">
              <div class="row">
                <div class="col-md-12">
                  <div class="sub-title">Work Details:</div>
                  <ul>
                    <li><i class="fa fa-pencil-square-o"></i> Office #:<?php echo $user_data->office_no; ?></li>
                    <li><i class="fa fa-pencil-square-o"></i> T: <?php echo $user_data->work_phone; ?></li>
                    <li><i class="fa fa-pencil-square-o"></i> M: <?php echo $user_data->work_mobile; ?> </li>
                    <li><i class="fa fa-pencil-square-o"></i> Email: <?php echo $user_data->email; ?> </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane generaltab" id="tab2Medical">
            <div class="info-box medical-info">
              <div class="row">
                <div class="col-md-12">
                  <div class="sub-title">Medical Information </div>
                  <ul>
                    <li>Blood type:<?php echo $user_data->blood_type; ?></li>
                    <li>Conditions:<?php echo $user_data->medical_condition; ?></li>
                    <li>Alergies: <?php echo $user_data->medical_allergies; ?></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane generaltab" id="tab2Emergency">
            <h3 class="userinfo-ttl"> Emergency Contacts <a href="<?php echo base_url(); ?>list_user/add_emergency_contact/<?php echo $user_data->user_unique_id; ?>" class="btn btn-sm btn-small btn-primary pull-right" data-target="#myModal" data-toggle="modal"> Add Contact <i class="fa fa-plus"></i> </a> </h3>
            <div class="info-box emergency-info">
              <div class="row">
                <div class="col-md-12">
                  <?php
		  if(!empty($user_data->emergency_contacts))
		  { 
		  	foreach($user_data->emergency_contacts as $contact)
			{ ?>
                  <div class="emrgncycon-grp">
                    <div class="sub-title"><?php echo $contact['name']; ?>
                      <div class="btn-group pull-right"><a class="btn btn-sm btn-small btn-primary" href="<?php echo base_url(); ?>list_user/add_emergency_contact/<?php echo $user_data->user_unique_id; ?>/<?php echo $contact['emergency_contact_id']; ?>" data-target="#myModal" data-toggle="modal">Edit <i class="fa fa-edit"></i></a> <a class="btn btn-sm btn-small btn-primary" href="#" onclick="javascript:_delete('emergency_contacts','emergency_contact_id',<?php echo $contact['emergency_contact_id']; ?>);">Delete <i class="fa fa-trash-o"></i></a></div>
                    </div>
                    <ul>
                      <li>Relationship: <?php echo $contact['relation']; ?></li>
                      <li>Contact Number: <?php echo $contact['contact_number']; ?></li>
                      <li>Email address: <?php echo $contact['alternate_contact']; ?> </li>
                      <li>Country: <?php echo $contact['country_name']; ?></li>
                    </ul>
                  </div>
                  <?php
		  	}
		  } ?>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane generaltab" id="tab2CV">
            <h3 class="userinfo-ttl">Qualifications & Employment History</h3>
            <div class="info-box educatn-info">
              <div class="row">
                <div class="col-md-12">
                  <div class="sub-title">Qualifications:
                    <?php 
					if($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '100' || in_array("add_qualifications",$this->arrAction))
					{ ?>
                    <a href="<?php echo base_url(); ?>list_user/add_qualifications/<?php echo $user_data->user_unique_id; ?>" class="btn btn-sm btn-small btn-primary pull-right" data-target="#myModal" data-toggle="modal">Qualifications <i class="fa fa-plus"></i> </a>
                    <?php
					} ?>
                  </div>
                  <ul>
                    <?php
            if(!empty($user_data->user_qualification))
            { 
				foreach($user_data->user_qualification as $qualification)
				{ 
          $Requirements = '';
          if($qualification['accredited'] == 1 && $qualification['in_class'] == 1){
            $Requirements = 'Meets Requirements';
          }else{
            $Requirements = 'Does Not Meets Requirements';
          }

          ?>
                    <li><?php echo $qualification['qualification']; ?> <?php echo $qualification['date']; ?> , <?php echo $qualification['subject']; ?>, Verified: <?php echo $qualification['verified']; ?> <?php echo ( $qualification['verified'] == 'Yes' ? '| ' .$Requirements : '' ); ?>
                      <div class="btn-group pull-right">
                        <?php 
					if($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '100' || in_array("edit_qualifications",$this->arrAction))
					{ ?>
                        <a class="btn btn-sm btn-small btn-primary" href="<?php echo base_url(); ?>list_user/add_qualifications/<?php echo $user_data->user_unique_id; ?>/<?php echo $qualification['user_qualification_id']; ?>" data-target="#myModal" data-toggle="modal">Edit <i class="fa fa-edit"></i></a>
                        <?php
					} ?>
                        <?php 
					if($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '100' || in_array("delete_qualifications",$this->arrAction))
					{ ?>
                        <a class="btn btn-sm btn-small btn-primary" href="#" onclick="javascript:_delete('user_qualification','user_qualification_id',<?php echo $qualification['user_qualification_id']; ?>);">Delete <i class="fa fa-trash-o"></i></a>
                        <?php
					} ?>
                      </div>
                    </li>
                    <?php
		  		}
		  	} ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="info-box certi-info">
              <div class="row">
                <div class="col-md-12">
                  <div class="sub-title">Certificates:
                    <?php 
					if($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '100' || in_array("add_certificate",$this->arrAction))
					{ ?>
                    <a href="<?php echo base_url(); ?>list_user/add_certificate/<?php echo $user_data->user_unique_id; ?>" class="btn btn-sm btn-small btn-primary pull-right" data-target="#myModal" data-toggle="modal">Certificate <i class="fa fa-plus"></i> </a >
                    <?php
					} ?>
                  </div>
                  <ul>
                    <?php
            if(!empty($user_data->user_certificate))
            { 
				foreach($user_data->user_certificate as $certificate)
				{ 
          $Requirements = '';
          if($certificate['accredited'] == 1 && $certificate['in_class'] == 1 && $certificate['hours'] == 1 && $certificate['hours_teaching'] == 1){
            $Requirements = 'Meets Requirements';
          }else{
            $Requirements = 'Does Not Meets Requirements';
          }
          ?>
                    <li><?php echo $certificate['qualification']; ?> <?php echo $certificate['date']; ?> , Verified: <?php echo $certificate['verified']; ?> <?php echo ( $certificate['verified'] == 'Yes' ? '| ' .$Requirements : '' ); ?>
                      <div class="btn-group pull-right">
                        <?php 
					if($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '100' || in_array("edit_certificates",$this->arrAction))
					{ ?>
                        <a class="btn btn-sm btn-small btn-primary" href="<?php echo base_url(); ?>list_user/add_certificate/<?php echo $user_data->user_unique_id; ?>/<?php echo $certificate['user_qualification_id']; ?>" data-target="#myModal" data-toggle="modal">Edit <i class="fa fa-edit"></i></a>
                        <?php
					} ?>
                        <?php 
					if($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '100' || in_array("delete_certificates",$this->arrAction))
					{ ?>
                        <a class="btn btn-sm btn-small btn-primary" href="#" onclick="javascript:_delete('user_qualification','user_qualification_id',<?php echo $certificate['user_qualification_id']; ?>);">Delete <i class="fa fa-trash-o"></i></a>
                        <?php
					} ?>
                      </div>
                    </li>
                    <?php
		  		}
		  	} ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="info-box emply-info">
              <div class="row">
                <div class="col-md-12">
                  <div class="sub-title">Employment History: (Experience :<?php echo $user_data->teaching_experience; ?>)
                    <?php 
					if($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '100' || in_array("add_experience",$this->arrAction))
					{ ?>
                    <a href="<?php echo base_url(); ?>list_user/add_experience/<?php echo $user_data->user_unique_id; ?>" class="btn btn-sm btn-small btn-primary pull-right" data-target="#myModal" data-toggle="modal">Experience <i class="fa fa-plus"></i> </a>
                    <?php
					} ?>
                  </div>
                  <ul>
                    <?php
            if(!empty($user_data->user_experience))
            { 
				foreach($user_data->user_experience as $experience)
				{ ?>
                    <li> Company: <?php echo $experience['company']; ?>, Position: <?php echo $experience['position']; ?> <br />
                      From: <?php echo $experience['start_date']; ?> To: <?php echo $experience['end_date']; ?> <br />
                      Reason for leaving: <?php echo $experience['departure_reason']; ?>
                      <div class="btn-group pull-right">
                        <?php 
					if($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '100' || in_array("edit_employment_history",$this->arrAction))
					{ ?>
                        <a class="btn btn-sm btn-small btn-primary" href="<?php echo base_url(); ?>list_user/add_experience/<?php echo $user_data->user_unique_id; ?>/<?php echo $experience['user_workhistory_id']; ?>" data-target="#myModal" data-toggle="modal">Edit <i class="fa fa-edit"></i></a>
                        <?php
					} ?>
                        <?php 
					if($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '100' || in_array("delete_employment_history",$this->arrAction))
					{ ?>
                        <a class="btn btn-sm btn-small btn-primary" href="#" onclick="javascript:_delete('user_workhistory','user_workhistory_id',<?php echo $experience['user_workhistory_id']; ?>);">Delete <i class="fa fa-trash-o"></i></a>
                        <?php
					} ?>
                      </div>
                    </li>
                    <?php
		  		}
		  	} ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="info-box emply-info">
              <div class="row">
                <div class="col-md-12">
                  <div class="sub-title">Reference:
                    <?php 
					if($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '100' || in_array("add_reference",$this->arrAction))
					{ ?>
                    <a href="<?php echo base_url(); ?>list_user/add_reference/<?php echo $user_data->user_unique_id; ?>" class="btn btn-sm btn-small btn-primary pull-right" data-target="#myModal" data-toggle="modal">Reference <i class="fa fa-plus"></i> </a>
                    <?php
					} ?>
                  </div>
                  <ul>
                    <?php
            if(!empty($user_data->cv_reference))
            { 
				foreach($user_data->cv_reference as $cv_reference)
				{ ?>
                    <li> Company: <?php echo $cv_reference['company_name']; ?><br />
                      Referee Name: <?php echo $cv_reference['name']; ?><br />
                      Email: <?php echo $cv_reference['email']; ?>
                      <div class="btn-group pull-right">
                        <?php 
					if($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '100' || in_array("edit_reference",$this->arrAction))
					{ ?>
                        <a class="btn btn-sm btn-small btn-primary" href="<?php echo base_url(); ?>list_user/add_reference/<?php echo $user_data->user_unique_id; ?>/<?php echo $cv_reference['referance_id']; ?>" data-target="#myModal" data-toggle="modal">Edit <i class="fa fa-edit"></i></a>
                        <?php
					} ?>
                        <?php 
					if($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '100' || in_array("delete_reference",$this->arrAction))
					{ ?>
                        <a class="btn btn-sm btn-small btn-primary" href="#" onclick="javascript:_delete('user_cv_reference','referance_id',<?php echo $cv_reference['referance_id']; ?>);">Delete <i class="fa fa-trash-o"></i></a>
                        <?php
					} ?>
                      </div>
                    </li>
                    <?php
		  		}
		  	} ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane generaltab" id="tab2Workshops">
            <div class="info-box educatn-info">
              <div class="row">
                <div class="col-md-12">
                  <div class="sub-title">PD Workshops: <?php echo count($user_data->user_workshop); ?>
                    <div class="pull-right"></div>
                  </div>
                  <table class="table  table-bordered">
                    <tbody>
                      <?php
                    if(!empty($user_data->user_workshop))
                    { 
                      foreach($user_data->user_workshop as $workshop)
                    { ?>
                      <tr>
                        <td>Workshop: <?php echo $workshop['title']; ?></td>
                        <td>Topic: <?php echo $workshop['topic']; ?></td>
                        <td>Presenter: <?php echo $workshop['presenter_name']; ?></td>
                        <td>Date: <?php echo $workshop['start_date']; ?> </td>
                        <td>Department: <?php echo $workshop['type']; ?> </td>
                      </tr>
                      <?php
                      }
                    } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab2Observations">
            <div class="grid">
              <h3 class="userinfo-ttl">Please note that comments must be entered before observation scores.</h3>
              <div class="grid-body ">
                <script type="text/javascript" src="<?php print base_url(); ?>js/grid/observations.js"></script>
                <table class="table" id="grid_observations">
                  <thead>
                    <tr>
                      <th>Score</th>
                      <th><?php echo $this->lang->line('teacher_p_full_name'); ?></th>
                      <th><?php echo $this->lang->line('elsid'); ?></th>
                      <th>Comment</th>
                      <th>Date</th>
                      <th>Class</th>
                      <th><?php echo $this->lang->line('teacher_p_action'); ?></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Score</th>
                      <th><?php echo $this->lang->line('teacher_p_full_name'); ?></th>
                      <th><?php echo $this->lang->line('elsid'); ?></th>
                      <th>Comment</th>
                      <th>Date</th>
                      <th>Class</th>
                      <th><?php echo $this->lang->line('teacher_p_action'); ?></th>
                    </tr>
                  </tfoot>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane generaltab" id="tab2Privilege">
            <div class="info-box privilege-info">
              <div class="row">
                <div class="col-md-12">
                  <?php $this->load->view('generic/flash_error');?>
                  <div class="sub-title"><?php echo $this->lang->line('privi_p_heading'); ?>
                    <div class="pull-right">
                      <?php 
if(isset($user_data->user_roll_id) && $user_data->user_roll_id > 0) {
	print form_open('list_user/reset_user_privilege/', array('id' => 'reset_user_privilege','name'=>'reset_user_privilege')) ."\r\n";
		print form_hidden('user_id', $user_data->user_unique_id);
		print form_hidden('user_roll_id', $user_data->user_roll_id);
		if($this->session->userdata('role_id') == '1' || in_array("my_edit_privilege",$this->arrAction))
		{
			print form_submit(array('name' => 'reset_user_privilege', 'id' => 'reset_user_privilege', 'value' => 'Reset To Roll', 'class' => 'input_submit btn btn-danger btn-small')) ."\r\n";
		}
	print form_close() ."\r\n";
}
?>
                    </div>
                  </div>
                  <?php 
print form_open('add_privilege/add_single_user_privilege/add', array('id' => 'add_single_user_privilege_form','name'=>'add_single_user_privilege_form')) ."\r\n";

print form_hidden('user_id', $user_data->user_unique_id);
//echo "<pre>";print_r($roll_privilege); echo "</pre>";//exit;
?>
                  <ul>
                    <li>
                      <div class="row">
                        <div class="col-md-2 menu-hd"><?php echo $this->lang->line('privi_p_list_hd_menu'); ?></div>
                        <div class="col-md-10 menu-hd"><?php echo $this->lang->line('privi_p_list_hd_action'); ?></div>
                      </div>
                    </li>
                    <?php 
        if($previlage_action){
			for($i=0;$i<count($previlage_action);$i++){
        ?>
                    <li>
                      <div class="row">
                        <div class="col-md-2 menu-name"><?php echo $this->lang->line($previlage_action[$i]['lang_menu_name']); ?></div>
                        <div class="col-md-10">
                          <?php
			if($previlage_action[$i]['menu_action']){
			?>
                          <div class="row">
                            <div class="action">
                              <div class="col-md-4">&nbsp;&ndash;&nbsp;</div>
                              <?php
                for($j=0;$j<count($previlage_action[$i]['menu_action']);$j++){
            ?>
                              <div class="col-md-2">
                                <div class="checkbox check-success">
                                  <?php 
			$menu_act_id = $previlage_action[$i]['menu_action'][$j]['menu_id'].'_'.$previlage_action[$i]['menu_action'][$j]['value'];
			$label_class = 'label'; 
			if(in_array($menu_act_id,$roll_privilege))
				$label_class = 'label label-inverse';
			echo form_checkbox('privilege_action[]', $menu_act_id, FALSE,'id="chkbox_'.$menu_act_id.'""');
			//echo '<label for="chkbox_'.$menu_act_id.'">'.$previlage_action[$i]['menu_action'][$j]['name'].'</label>'; 			
			?>
                                  <span class="<?=$label_class?>" id="unchk_<?php echo $menu_act_id; ?>" onclick="checked_unchecked('0','<?php echo $menu_act_id;?>')"><?php echo $previlage_action[$i]['menu_action'][$j]['name']; ?></span> <span class="check <?=$label_class?>" id="chk_<?php echo $menu_act_id; ?>" style="display:none;" onclick="checked_unchecked('1','<?php echo $menu_act_id;?>')"><?php echo $previlage_action[$i]['menu_action'][$j]['name']; ?></span> </div>
                              </div>
                              <?php 	
				} 
			?>
                            </div>
                          </div>
                          <?php 
    			
    		}else{
				if($previlage_action[$i]['sub_menu']){ 
					$total_row = count($previlage_action[$i]['sub_menu']) - 1;
					for($j=0;$j<count($previlage_action[$i]['sub_menu']);$j++){
					$border_style = '';
					if($j < $total_row) {
						$border_style = 'style="border-bottom:solid 1px;"';
					}	
    		?>
                          <div class="row">
                            <div class="action">
                              <div class="col-md-4"><?php echo $this->lang->line($previlage_action[$i]['sub_menu'][$j]['lang_menu_name']); ?></div>
                              <?php
			$menu_action = $previlage_action[$i]['sub_menu'][$j]['menu_action'];
			if($menu_action){
			for($k=0;$k<count($menu_action);$k++){
		?>
                              <div class="col-md-2">
                                <div class="checkbox check-success">
                                  <?php 
		$menu_act_id =$menu_action[$k]['menu_id'].'_'.$menu_action[$k]['value'];
		$label_class = 'label'; 
		if(in_array($menu_act_id,$roll_privilege))
			$label_class = 'label label-inverse';
		echo form_checkbox('privilege_action[]', $menu_act_id, FALSE,'id="chkbox_'.$menu_act_id.'""');
		//echo '<label for="chkbox_'.$menu_act_id.'">'.$menu_action[$k]['name'].'</label>';
		?>
                                  <span class="<?=$label_class?>" id="unchk_<?php echo $menu_act_id; ?>" onclick="checked_unchecked('0','<?php echo $menu_act_id;?>')"><?php echo $menu_action[$k]['name']; ?></span> <span class="check <?=$label_class?>" id="chk_<?php echo $menu_act_id; ?>" style="display:none;" onclick="checked_unchecked('1','<?php echo $menu_act_id;?>')"><?php echo $menu_action[$k]['name']; ?></span> </div>
                              </div>
                              <?php 	
				}
			} 
		?>
                            </div>
                          </div>
                          <?php
					}
				}
			} 
			?>
                        </div>
                      </div>
                    </li>
                    <?php
    	}
    }

				if($this->session->userdata('role_id') == '1' || in_array("my_edit_privilege",$this->arrAction))
				{
				?>
                    <li> <?php print form_submit(array('name' => 'add_single_user_privilege_submit', 'id' => 'add_single_user_privilege_submit', 'value' => $this->lang->line('privi_p_btn'), 'class' => 'input_submit btn btn-success btn-cons')) ."\r\n"; ?> </li>
                    <?php 
				}
				?>
                  </ul>
                  <?php print form_close() ."\r\n";?>
                  <script>
	function checked_privilege_action(user_id){
		$.ajax({
			type:'post',
  			url: '<?php echo site_url("add_privilege/add_single_user_privilege/get_user_existing_privilege"); ?>',
			data: "user_id="+user_id,
  			success: function(data) {
  	  			var obj = $.parseJSON(data);
  	  			//alert(obj.length);return false;
  	  			if(obj.length > 1){
  	  				var frmobj = document.add_single_user_privilege_form;
					for(var i=0; i < frmobj['privilege_action[]'].length; i++)
				    {
  	  	  				for(var j=0;j<obj.length;j++){
  	  	  	  				if(frmobj['privilege_action[]'][i].value == obj[j]){
  	  	  						//alert(obj[j]);
  	  	  						frmobj['privilege_action[]'][i].checked = true;
  	  	  						$("#unchk_"+obj[j]).hide();
  	  	  	    				$("#chk_"+obj[j]).show();
  	  	  	  				}
  	  	  	  			}
				    }
  	  	  		}else{
					var frmobj = document.add_single_user_privilege_form;
					for(var i=0; i < frmobj['privilege_action[]'].length; i++)
				    {
				        frmobj['privilege_action[]'][i].checked = false;
				        $("#unchk_"+frmobj['privilege_action[]'][i].value).show();
	  	    			$("#chk_"+frmobj['privilege_action[]'][i].value).hide();
				    } 
  	  	  	  	}
    			
  			}
		});
	}

	$(document).ready(function(){
		checked_privilege_action(<?=$user_data->user_unique_id?>);
	});
</script>
                  <!-- privilege forn end-->
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab2ViewStatusLog">
            <div class="grid">
              <h3 class="userinfo-ttl">View Changed Status Log.</h3>
              <div class="grid-body ">
                <script type="text/javascript">
			  var user_unique_id = <?=($user_data)?$user_data->user_unique_id:0?>;
			  var edit_flag = 1;
			  </script>
                <script type="text/javascript" src="<?php print base_url(); ?>js/grid/viewstatuslog.js"></script>
                <table class="table" id="grid_viewstatuslog">
                  <thead>
                    <tr>
                      <th>User ID</th>
                      <th>ELSD ID</th>
                      <th>Staff Name</th>
                      <th>OLD Status</th>
                      <th>New Status</th>
                      <th>Updated By</th>
                      <th>Comment</th>
                      <th>Date/Time</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>User ID</th>
                      <th>ELSD ID</th>
                      <th>Staff Name</th>
                      <th>Status</th>
                      <th>Updated By</th>
                      <th>Comment</th>
                      <th>Date/Time</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- My Ateendance-->
          <div class="tab-pane" id="tab2myattendance">
            <div class="grid">
              <h3 class="userinfo-ttl">My Attendance</h3>
              <div class="grid-body ">
                <script type="text/javascript" src="<?php print base_url(); ?>js/grid/my_attendance.js"></script>
                <script type="text/javascript">
        var my_att_add_comment = 1;
        var my_att_edit_comment = 1;
        var my_att_change_status = 1;
        <?php 
        if($this->session->userdata('role_id') != '1' && in_array("my_attendance",$this->arrAction) && !in_array("add",$this->arrAction))
        {
        ?>
            my_att_add_comment = 0;
        <?php 
        }
        ?>
        <?php 
        if($this->session->userdata('role_id') != '1' && in_array("my_attendance",$this->arrAction) && !in_array("edit",$this->arrAction))
        {
        ?>
            my_att_edit_comment = 0;
        <?php 
        }
        ?>
        <?php 
        if($this->session->userdata('role_id') != '1' && !in_array("change_approve",$this->arrAction))
        {
        ?>
            my_att_change_status = 0;
        <?php 
        }
        ?>
        </script>
                <table class="table" id="grid_my_attendance">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Scan ID</th>
                      <th>Log Date</th>
                      <th>In Time</th>
                      <th>Out Time</th>
                      <th>Total Hours</th>
                      <th>Late</th>
                      <th>Approved</th>
                      <th>StartTime</th>
                      <th>EndTime</th>
                      <th></th>
                      <th><?php echo $this->lang->line('late_att_p_flag3'); ?></th>
                      <th><?php echo $this->lang->line('late_att_p_flag1'); ?></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Scan ID</th>
                      <th>Log Date</th>
                      <th>In Time</th>
                      <th>Out Time</th>
                      <th>Total Hours</th>
                      <th>Late</th>
                      <th>Approved</th>
                      <th>StartTime</th>
                      <th>EndTime</th>
                      <th></th>
                      <th><?php echo $this->lang->line('late_att_p_flag3'); ?></th>
                      <th><?php echo $this->lang->line('late_att_p_flag1'); ?></th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- My Indicuctions-->
          <div class="tab-pane" id="tab2myinductions">
            <div class="grid">
              <h3 class="userinfo-ttl">My Induction</h3>
              <div class="grid-body ">
                <div class="row form-row">
                  <div class="col-md-3"> <?php print form_label('Curriculum Framework', 'Curriculum_Framework',array('class'=>'form-label')); ?> </div>
                  <div class="col-md-1">
                    <?php (isset($myinductiondata))?print $myinductiondata["Curriculum_Framework"]:"" ?>
                  </div>
                  <div class="col-md-3"> <?php print form_label('Oxford iTools & Smart Board', 'Oxford_iTools_Smart_Board',array('class'=>'form-label')); ?> </div>
                  <div class="col-md-1">
                    <?php (isset($myinductiondata))?print $myinductiondata["Oxford_iTools_Smart_Board"]:"" ?>
                  </div>
                </div>
                <div class="row form-row">
                  <div class="col-md-3"> <?php print form_label('Educational Technology', 'Educational_Technology',array('class'=>'form-label')); ?> </div>
                  <div class="col-md-1">
                    <?php (isset($myinductiondata))?print $myinductiondata["Educational_Technology"]:"" ?>
                  </div>
                  <div class="col-md-3"> <?php print form_label('The Saudi Learner', 'The_Saudi_Learner',array('class'=>'form-label')); ?> </div>
                  <div class="col-md-1">
                    <?php (isset($myinductiondata))?print $myinductiondata["The_Saudi_Learner"]:"" ?>
                  </div>
                </div>
                <div class="row form-row">
                  <div class="col-md-3"> <?php print form_label('Professional Development', 'Professional_Development',array('class'=>'form-label')); ?> </div>
                  <div class="col-md-1">
                    <?php (isset($myinductiondata))?print $myinductiondata["Professional_Development"]:"" ?>
                  </div>
                  <div class="col-md-3"> <?php print form_label('Classroom Management', 'Classroom_Management',array('class'=>'form-label')); ?> </div>
                  <div class="col-md-1">
                    <?php (isset($myinductiondata))?print $myinductiondata["Classroom_Management"]:"" ?>
                  </div>
                </div>
                <div class="row form-row">
                  <div class="col-md-3"> <?php print form_label('Students Affairs', 'Students_Affairs',array('class'=>'form-label')); ?> </div>
                  <div class="col-md-1">
                    <?php (isset($myinductiondata))?print $myinductiondata["Students_Affairs"]:"" ?>
                  </div>
                  <div class="col-md-3"> <?php print form_label('Lesson Planning', 'Lesson_Planning',array('class'=>'form-label')); ?> </div>
                  <div class="col-md-1">
                    <?php (isset($myinductiondata))?print $myinductiondata["Lesson_Planning"]:"" ?>
                  </div>
                </div>
                <div class="row form-row">
                  <div class="col-md-3"> <?php print form_label('Academic Administration & Quality', 'Academic_Administration_Quality',array('class'=>'form-label')); ?> </div>
                  <div class="col-md-1">
                    <?php (isset($myinductiondata))?print $myinductiondata["Academic_Administration_Quality"]:"" ?>
                  </div>
                  <div class="col-md-3"> <?php print form_label('New ELSD Portal Training', 'New_ELSD_Portal_Training',array('class'=>'form-label')); ?> </div>
                  <div class="col-md-1">
                    <?php (isset($myinductiondata))?print $myinductiondata["New_ELSD_Portal_Training"]:"" ?>
                  </div>
                </div>
                <div class="row form-row">
                  <div class="col-md-3"> <?php print form_label('Academic HR', 'Academic_HR',array('class'=>'form-label')); ?> </div>
                  <div class="col-md-1">
                    <?php (isset($myinductiondata))?print $myinductiondata["Academic_HR"]:"" ?>
                  </div>
                  <div class="col-md-3"> <?php print form_label('New Headway Plus', 'New_Headway_Plus',array('class'=>'form-label')); ?> </div>
                  <div class="col-md-1">
                    <?php (isset($myinductiondata))?print $myinductiondata["New_Headway_Plus"]:"" ?>
                  </div>
                </div>
                <div class="row form-row">
                  <div class="col-md-3"> <?php print form_label('Assessment', 'Assessment',array('class'=>'form-label')); ?> </div>
                  <div class="col-md-1">
                    <?php (isset($myinductiondata))?print $myinductiondata["Assessment"]:"" ?>
                  </div>
                  <div class="col-md-3"> <?php print form_label('Headway Academic Skills', 'Headway_Academic_Skills',array('class'=>'form-label')); ?> </div>
                  <div class="col-md-1">
                    <?php (isset($myinductiondata))?print $myinductiondata["Headway_Academic_Skills"]:"" ?>
                  </div>
                </div>
                <div class="row form-row">
                  <div class="col-md-3"> <?php print form_label('Management Information', 'Management_Information',array('class'=>'form-label')); ?> </div>
                  <div class="col-md-1"> <?php print (isset($myinductiondata))?$myinductiondata["Management_Information"]:"" ?> </div>
                  <div class="col-md-3"> <?php print form_label('Qskills Orientation', 'Qskills_Orientation',array('class'=>'form-label')); ?> </div>
                  <div class="col-md-1"> <?php print (isset($myinductiondata))?$myinductiondata["Qskills_Orientation"]:"" ?> </div>
                </div>
                <div class="row form-row">
                  <div class="col-md-3"> <?php print form_label('Academic Admin Policies', 'Academic_Admin_Policies',array('class'=>'form-label')); ?> </div>
                  <div class="col-md-1"> <?php print (isset($myinductiondata))?$myinductiondata["Academic_Admin_Policies"]:"" ?> </div>
                </div>
              </div>
            </div>
          </div>
          <div class="edit-page tab-pane" id="tab2Edit">
            <ul class="nav nav-tabs" id="tab-01">
              <li class="active"><a href="#tab2Edit2"><i class="fa fa-user"></i> Profile</a></li>
              <?php if( $this->session->userdata('role_id') == '100' || $this->session->userdata('role_id') == '1' ){ ?>
              <li><a href="#tab2Departure"><i class="fa fa-tachometer"></i> Departure </a></li>
              <li><a href="#tab2Documents"><i class="fa fa-file-text-o"></i> Documents</a></li>
              <?php } ?>
              <li><a href="#tab2ChangePassword"><i class="fa fa-key"></i> Change Password</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab2Edit2">
                <?php if( $this->session->userdata('role_id') == '100' || $this->session->userdata('role_id') == '1'){ ?>
                <!--***********************************************
                  IF ADMIN SHOW FULL FORM OTHER WISE SHOW PARTIAL
                  *********************************************** -->
                <div class="grid info-box">
                  <h3 class="userinfo-ttl"><?php echo $user_data->first_name.' '.$user_data->last_name; ?> <span class="semi-bold"><?php echo $user_data->elsd_id; ?></span></h3>
                  <div class="grid-body ">
                    <div class="info-box">
                      <div class="row"> <?php print form_open('list_user/edit_profile/'.encrypt_decrypt('e', $user_data->user_unique_id).'/6', array('id' => 'edit_profile','name'=>'edit_profile')) ."\r\n"; ?>
                        <div id="edit_rootwizard" class="col-md-12">
                          <?php
						if ($this->session->flashdata('message')) {
							print "<br><div class=\"alert alert-error\">". $this->session->flashdata('message') ."</div>";
						}
						?>
                          <div class="form-wizard-steps">
                            <ul class="wizard-steps">
                              <li class="active" data-target="#step1"> <a href="#tab1" data-toggle="tab"> <span class="step">1</span> <span class="title">Personal & Contact Details</span> </a> </li>
                              <li data-target="#step2" class=""> <a href="#tab2" data-toggle="tab"> <span class="step">2</span> <span class="title">Job Details</span> </a> </li>
                              <li data-target="#step3" class=""> <a href="#tab3" data-toggle="tab"> <span class="step">3</span> <span class="title">Medical</span> </a> </li>
                              <li data-target="#step4" class=""> <a href="#tab4" data-toggle="tab"> <span class="step">4</span> <span class="title">Interview Details <br>
                                </span> </a> </li>
                            </ul>
                            <div class="clearfix"></div>
                          </div>
                          <div class="tab-content">
                            <div class="tab-pane active" id="tab1"> <br>
                              <h4 class="semi-bold">Step 1 - <span class="light">Personal & Contact Details</span></h4>
                              <br>
                              <div class="row form-row">
                                <div class="col-md-3"> <?php print form_label('Name Title', 'title',array('class'=>'form-label')); ?> <?php print form_dropdown('title',$name_title_list,($user_data)?$user_data->title:$this->session->flashdata('title'),'id="title" class="select2 form-control"'); ?> </div>
                              </div>
                              <div class="row form-row">
                                <div class="col-md-3"> <?php print form_label('First Names', 'names',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'first_name', 'id' => 'first_name', 'value' => ($user_data)?$user_data->first_name:$this->session->flashdata('first_name'), 'class' => 'form-control ','placeholder' => 'First Name')); ?> </div>
                                <div class="col-md-3"> <?php print form_label('Middle Name 1', 'names',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'middle_name', 'id' => 'middle_name', 'value' => ($user_data)?$user_data->middle_name:$this->session->flashdata('middle_name'), 'class' => 'form-control ','placeholder' => 'Middle Name')); ?> </div>
                                <div class="col-md-3"> <?php print form_label('Middle Name 2', 'names',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'middle_name2', 'id' => 'middle_name2', 'value' => ($user_data)?$user_data->middle_name2:$this->session->flashdata('middle_name2'), 'class' => 'form-control ','placeholder' => 'Middle Name 2')); ?> </div>
                                <div class="col-md-3"> <?php print form_label('Last Name', 'names',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'last_name', 'id' => 'last_name', 'value' => ($user_data)?$user_data->last_name:$this->session->flashdata('last_name'), 'class' => 'form-control ','placeholder' => 'Last Name')); ?> </div>
                              </div>
                              <!--row 1 end-->
                              <!--row 2 start-->
                              <div class="row form-row">
                                <div class="col-md-3"> <?php print form_label('Gender', 'gender',array('class'=>'form-label')); ?> <?php print form_dropdown('gender',array(''=> 'Select Gender','M'=> 'Male','F'=>'Female'),($user_data)?$user_data->gender:$this->session->flashdata('gender'),'id="gender" class="select2 form-control"'); ?> </div>
                                <div class="col-md-3"> <?php print form_label('Nationality', 'nationality',array('class'=>'form-label')); ?> <?php print form_dropdown('nationality',$nationality_list,($user_data)?$user_data->nationality:$this->session->flashdata('nationality'),'id="nationality" class="select2 form-control"'); ?> </div>
                                <div class="col-md-3"> <?php print form_label('Marital status', 'marital_status',array('class'=>'form-label')); ?> <?php print form_dropdown('marital_status',array(''=> 'Select Marital status','Married'=> 'Married','Single'=>'Single'),($user_data)?$user_data->marital_status:$this->session->flashdata('marital_status'),'id="marital_status" class="select2 form-control"'); ?> </div>
                                <div class="col-md-3"> <?php print form_label('DOB', 'birth_date',array('class'=>'form-label')); ?>
                                  <div class="input-append success date col-md-10 col-lg-10 no-padding"> <?php print form_input(array('name' => 'birth_date', 'id' => 'show_dp', 'value' => ($user_data)?make_dp_date($user_data->birth_date):$this->session->flashdata('birth_date'), 'class' => 'form-control ','placeholder' => 'Dob')); ?> <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span> </div>
                                </div>
                              </div>
                              <hr />
                              <div class="row form-row">
                                <div class="col-md-3"> <?php print form_label('ELSD ID', 'elsd_id',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'elsd_id', 'id' => 'elsd_id', 'value' => ($user_data)?$user_data->elsd_id:$this->session->flashdata('elsd_id'), 'class' => 'form-control ','placeholder' => 'ELSD ID','readonly'=>'readonly')); ?> </div>
                                <div class="col-md-3"> <?php print form_label('DB ID', 'db_id',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'db_id', 'id' => 'db_id', 'value' => ($user_data)?$user_data->user_unique_id:$this->session->flashdata('db_id'), 'class' => 'form-control ','placeholder' => 'DB ID','readonly'=>'readonly')); ?> </div>
                                <!--</div>-->
                                <!--row 1 start-->
                                <?php //print form_open('list_user/save_user_status/', array('id' => 'save_user_status','name'=>'save_user_status')) ."\r\n"; ?>
                                <!--<div class="row form-row">-->
                                <div class="col-md-3"> <?php print form_label('Status', 'status',array('class'=>'form-label')); ?> <?php print form_dropdown('status',$user_profile_status,($user_data)?$user_data->status:$this->session->flashdata('status'),'id="status" class="select2 form-control"'); ?>
                                  <?php 
						  //if($user_data->status == 20){ ?>
                                  <script>
							  $(document).ready(function(){
								$('#status').prop('readonly', true);
							  });
							  </script>
                                  <?php //} ?>
                                </div>
                                <div class="col-md-3">
                                  <label>&nbsp;</label>
                                  <input type="button" id="change_status_button" class="button-change-status btn btn-primary" value="Change Status" />
                                </div>
                              </div>
                              <hr />
                              <div class="row form-row" id="status_comment_box">
                                <div class="col-md-8"> <?php print form_input(array('name' => 'comment', 'id' => 'comment', 'value' => '', 'class' => 'form-control comment','placeholder' => 'Why you want to change the status?')); ?>
                                  <div id="iderror"></div>
                                </div>
                                <div class="col-md-4"> <?php print form_hidden('ori_user_id', ($user_data)?$user_data->user_unique_id:0); ?>
                                  <input type="hidden" name="orig_status" id="orig_status" value="<?php echo ($user_data)?$user_data->status:0; ?>" />
                                  <input type="button" id="save_status" class="button-save btn btn-primary" value="Save" />
                                  <input type="button" id="cancel_status_button" class="button-cancle btn btn-primary" value="Cancel" />
                                </div>
                              </div>
                              <?php //print form_close() ."\r\n"; ?>
                              <div class="row form-row">
                                <div class="col-md-3"> <?php print form_label('User Name', 'username',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'username', 'id' => 'username', 'value' => ($user_data)?$user_data->username:$this->session->flashdata('username'), 'class' => 'form-control ','placeholder' => 'email@example.com')); ?> </div>
                                <div class="col-md-3"> <?php print form_label('KSU Email', 'email',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'email', 'id' => 'email', 'value' => ($user_data)?$user_data->email:$this->session->flashdata('email'), 'class' => 'form-control','placeholder' => 'KSU Email')); ?> </div>
                                <div class="col-md-3"> <?php print form_label('Personal Email', 'personal_email',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'personal_email', 'id' => 'personal_email', 'value' => ($user_data)?$user_data->personal_email:$this->session->flashdata('personal_email'), 'class' => 'form-control','placeholder' => 'Personal Email')); ?> </div>
                                <div class="col-md-3"> <?php print form_label('Mobile Phone', 'cell_phone',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'cell_phone', 'id' => 'cell_phone', 'value' => ($user_data)?$user_data->cell_phone:$this->session->flashdata('cell_phone'), 'class' => 'form-control ','placeholder' => 'Mobile Phone')); ?> </div>
                                <div class="col-md-3"> <?php print form_label('Skype ID', 'skype_id',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'skype_id', 'id' => 'skype_id', 'value' => ($user_data)?$user_data->skype_id:$this->session->flashdata('skype_id'), 'class' => 'form-control')); ?> </div>
                              </div>
                              <hr />
                              <!--row 3 end-->
                              <!--row 3.1 start-->
                              <div class="row form-row">
                                <div class="col-md-4"> <?php print form_label('Change Password', 'password',array('class'=>'form-label')); ?> <?php print form_password(array('name' => 'password', 'id' => 'password', 'value' => '', 'class' => 'form-control','placeholder' => 'Password')); ?> </div>
                                <div class="col-md-4"> <?php print form_label('Confirm Password', 'confirm_password',array('class'=>'form-label')); ?> <?php print form_password(array('name' => 'confirm_password', 'id' => 'confirm_password', 'value' => '', 'class' => 'form-control','placeholder' => 'Password')); ?> </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="tab2"> <br>
                              <h4 class="semi-bold">Step 2 - <span class="light">Job Details</span></h4>
                              <br>
                              <div class="row form-row">
                                <div class="col-md-2"> <?php print form_label('Contractor', 'contractor',array('class'=>'form-label')); ?>
                                  <?php 
                                  print form_dropdown('contractor', $contractors,($user_data)?$user_data->contractor:$this->session->flashdata('contractor'),'id="contractor" class="select2 form-control"'); 
                                  ?>
                                </div>
                                <div class="col-md-2"> <?php print form_label('Campus Privilages', 'campus_privilages_id',array('class'=>'form-label')); ?>
                                  <?php
							  print form_multiselect('campus_privilages[]',$campus_list,$campus_privilages,'id="multi" class="select2 form-control" placeholder="Select Campus"'); 
                              ?>
                                </div>
                                <div class="col-md-2"> <?php print form_label('Campus Location', 'campus_id',array('class'=>'form-label')); ?> <?php print form_dropdown('campus_id',$campus_list,($user_data)?$user_data->campus_id.'j':$this->session->flashdata('campus_id'),'id="campus_id" class="select2 form-control"'); ?> </div>
                                <div class="col-md-2"> <?php print form_label('Buildings', 'buildings',array('class'=>'form-label')); ?> <?php print form_dropdown('buildings',$buildings_list,($user_data)?$user_data->buildings:$this->session->flashdata('buildings'),'id="buildings" class="select2 form-control"'); ?> </div>
                                <div class="col-md-2"> <?php print form_label('Line Manager', 'coordinator',array('class'=>'form-label')); ?> <?php print form_dropdown('coordinator',$line_manager_list,($user_data)?$user_data->coordinator:$this->session->flashdata('coordinator'),'id="coordinator" class="select2 form-control"'); ?> </div>
                                <div class="col-md-2"> <?php print form_label('Shift Times', 'teacher_shift_id',array('class'=>'form-label')); ?> <?php print form_dropdown('teacher_shift_id',$teacher_shifts,($user_data)?$user_data->teacher_shift_id:$this->session->flashdata('teacher_shift_id'),'id="teacher_shift_id" class="select2 form-control"'); ?> </div>
                              </div>
                              <div class="row form-row">
                                <div class="col-md-4"> <?php print form_label('Department', 'department_id',array('class'=>'form-label')); ?> <?php print form_dropdown('department_id',$department_list,($user_data)?$user_data->department_id:$this->session->flashdata('department_id'),'id="department_id" class="select2 form-control"'); ?> </div>
                                <div class="col-md-4"> <?php print form_label('Revelant experience', 'teaching_experience',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'teaching_experience', 'id' => 'teaching_experience', 'value' => ($user_data)?$user_data->teaching_experience:$this->session->flashdata('teaching_experience'), 'class' => 'form-control ','placeholder' => 'Revelant experience')); ?> <span>(years)</span> </div>
                                <div class="col-md-4"> <?php print form_label('Returning Employee', 'returning',array('class'=>'form-label')); ?> <?php print form_dropdown('returning',array(''=>'Select Returning Teacher','1'=> 'Yes','2'=>'No'),($user_data)?$user_data->returning:$this->session->flashdata('returning'),'id="returning" class="select2 form-control"'); ?> </div>
                              </div>
                              <!--row 3.2 start-->
                              <div class="row form-row">
                                <div class="col-md-4"> <?php print form_label('ELSD System Role', 'user_roll_id',array('class'=>'form-label')); ?> <?php print form_dropdown('user_roll_id',$other_user_roll,($user_data)?$user_data->user_roll_id:$this->session->flashdata('user_roll_id'),'id="user_roll_id" class="select2 form-control"'); ?> </div>
                                <div class="col-md-4"> <?php print form_label('Job Title', 'job_title',array('class'=>'form-label')); ?> <?php print form_dropdown('job_title',$jobtitle_list,($user_data)?$user_data->job_title:$this->session->flashdata('job_title'),'id="department_id" class="select2 form-control"'); ?> </div>
                                <div class="col-md-4"> <?php print form_label('Scan ID', 'scanner_id',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'scanner_id', 'id' => 'scanner_id', 'value' => ($user_data)?$user_data->scanner_id:$this->session->flashdata('scanner_id'), 'class' => 'form-control ','placeholder' => 'Hand Scan ID')); ?> </div>
                              </div>
                              <div class="row form-row">
                                <div class="col-md-4"> <?php print form_label('Office / Room #', 'office_no',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'office_no', 'id' => 'office_no', 'value' => ($user_data)?$user_data->office_no:$this->session->flashdata('office_no'), 'class' => 'form-control','placeholder' => 'Office no')); ?> </div>
                                <div class="col-md-4"> <?php print form_label('Work Number', 'work_phone',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'work_phone', 'id' => 'work_phone', 'value' => ($user_data)?$user_data->work_phone:$this->session->flashdata('work_phone'), 'class' => 'form-control ','placeholder' => 'Work Number')); ?> </div>
                                <div class="col-md-4"> <?php print form_label('Ext', 'work_extention',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'work_extention', 'id' => 'work_extention', 'value' => ($user_data)?$user_data->work_extention:$this->session->flashdata('work_extention'), 'class' => 'form-control ','placeholder' => 'Ext')); ?> </div>
                              </div>
                              <div class="row form-row">
                                <div class="col-md-4"> <?php print form_label('Original Joining Date at KSU', 'original_start_date',array('class'=>'form-label')); ?>
                                  <div class="input-append success date col-md-10 col-lg-10 no-padding"> <?php print form_input(array('name' => 'original_start_date', 'id' => 'show_dp', 'value' => ($user_data)?make_dp_date($user_data->original_start_date):$this->session->flashdata('original_start_date'), 'class' => 'form-control')); ?> <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span> </div>
                                </div>
                                <div class="col-md-4"> <?php print form_label('Original Year Joined', 'original_start_year',array('class'=>'form-label')); ?>
                                  <div class="input-append success col-md-10 col-lg-10 no-padding"> <?php print form_dropdown('original_start_year',$original_start_year_list,($user_data)?$user_data->original_start_year:$this->session->flashdata('original_start_year'),'id="original_start_year" class="select2 form-control"'); ?> </div>
                                </div>
                                <div class="col-md-4"> <?php print form_label('Joining Date for academic year', 'cy_joining_date',array('class'=>'form-label')); ?>
                                  <div class="input-append success date col-md-10 col-lg-10 no-padding"> <?php print form_input(array('name' => 'cy_joining_date', 'id' => 'show_dp', 'value' => ($user_data)?make_dp_date($user_data->cy_joining_date):$this->session->flashdata('cy_joining_date'), 'class' => 'form-control','placeholder' => 'Joining Date')); ?> <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span> </div>
                                </div>
                              </div>
                              <div class="row form-row other-responsiblty">
                                <div class="col-md-12"> <?php print form_label('Other Responsibilities', 'other_responsibilities',array('class'=>'form-label')); ?> </div>
                                <div class="col-md-4">
                                  <?php $checked = (isset($user_data->mentor) && $user_data->mentor == '1') ? true:false; ?>
                                  <?php print form_checkbox(array('name' => 'mentor', 'id' => 'mentor', 'value' => '1', 'checked' => $checked)); ?> <?php print form_label('Mentor', 'mentor'); ?> </div>
                                <div class="col-md-4">
                                  <?php $checked = (isset($user_data->lesson_observer) && $user_data->lesson_observer == '1') ? true:false; ?>
                                  <?php print form_checkbox(array('name' => 'lesson_observer', 'id' => 'lesson_observer', 'value' => '1', 'checked' => $checked)); ?> <?php print form_label('Lesson Observer', 'lesson_observer'); ?> </div>
                                <div class="col-md-4">
                                  <?php $checked = (isset($user_data->buzz_observer) && $user_data->buzz_observer == '1') ? true:false; ?>
                                  <?php print form_checkbox(array('name' => 'buzz_observer', 'id' => 'buzz_observer', 'value' => '1', 'checked' => $checked)); ?> <?php print form_label('Buzz Observer', 'buzz_observer'); ?> </div>
                                <div class="col-md-4">
                                  <?php $checked = (isset($user_data->spot_checker) && $user_data->spot_checker == '1') ? true:false; ?>
                                  <?php print form_checkbox(array('name' => 'spot_checker', 'id' => 'spot_checker', 'value' => '1', 'checked' => $checked)); ?> <?php print form_label('Spot Checker', 'spot_checker'); ?> </div>
                                <div class="col-md-4">
                                  <?php $checked = (isset($user_data->is_line_manager) && $user_data->is_line_manager == '1') ? true:false; ?>
                                  <?php print form_checkbox(array('name' => 'is_line_manager', 'id' => 'is_line_manager', 'value' => '1', 'checked' => $checked)); ?> <?php print form_label('Line Manager', 'is_line_manager'); ?> </div>
                                <div class="col-md-4">
                                  <?php $checked = (isset($user_data->interviewer) && $user_data->interviewer == '1') ? true:false; ?>
                                  <?php print form_checkbox(array('name' => 'interviewer', 'id' => 'interviewer', 'value' => '1', 'checked' => $checked)); ?> <?php print form_label('Interviewer', 'interviewer'); ?> </div>
                              </div>
                              <div class="row form-row">
                                <div class="col-md-4"> <?php print form_label('Worked at KSU before', 'worked_at_ksu_before',array('class'=>'form-label')); ?> <?php print form_dropdown('worked_at_ksu_before',array('Yes'=>'Yes','No'=>'No'),($user_data)?$user_data->worked_at_ksu_before:$this->session->flashdata('worked_at_ksu_before'),'id="worked_at_ksu_before" class="select2 form-control" onchange="change_worked_at_ksu_before();"'); ?> </div>
                                <div id="worked_at_ksu_date">
                                  <div class="col-md-4"> <?php print form_label('Worked at KSU start date', 'worked_ksu_start_date',array('class'=>'form-label')); ?>
                                    <div class="input-append success date col-md-10 col-lg-10 no-padding"> <?php print form_input(array('name' => 'worked_ksu_start_date', 'id' => 'show_dp', 'value' => ($user_data)?make_dp_date($user_data->worked_ksu_start_date):$this->session->flashdata('worked_ksu_start_date'), 'class' => 'form-control')); ?> <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span> </div>
                                  </div>
                                  <div class="col-md-4"> <?php print form_label('Worked at KSU end date', 'worked_ksu_end_date',array('class'=>'form-label')); ?>
                                    <div class="input-append success date col-md-10 col-lg-10 no-padding"> <?php print form_input(array('name' => 'worked_ksu_end_date', 'id' => 'show_dp', 'value' => ($user_data)?make_dp_date($user_data->worked_ksu_end_date):$this->session->flashdata('worked_ksu_end_date'), 'class' => 'form-control')); ?> <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span> </div>
                                  </div>
                                  <div class="col-md-12"> <?php print form_label('Details of previous KSU experience', 'worked_ksu_job_detail',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'worked_ksu_job_detail', 'id' => 'worked_ksu_job_detail', 'value' => ($user_data)?$user_data->worked_ksu_job_detail:$this->session->flashdata('worked_ksu_job_detail'), 'class' => 'form-control')); ?> </div>
                                </div>
                              </div>
                              <script>
						  $(document).ready(function(){
							change_worked_at_ksu_before();
						  });
					    </script>
                            </div>
                            <div class="tab-pane" id="tab3"> <br>
                              <h4 class="semi-bold">Step 3 - <span class="light">Medical</span></h4>
                              <br>
                              <!--row 4.1 start-->
                              <div class="row form-row">
                                <div class="col-md-6"> <?php print form_label('Blood type', 'blood_type',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'blood_type', 'id' => 'blood_type', 'value' => ($user_data)?$user_data->blood_type:$this->session->flashdata('blood_type'), 'class' => 'form-control','placeholder' => 'Blood type')); ?> </div>
                              </div>
                              <!--row 4.1 end-->
                              <!--row 4.2 start-->
                              <div class="row form-row">
                                <div class="col-md-6"> <?php print form_label('Medical conditions', 'medical_condition',array('class'=>'form-label')); ?> <?php print form_textarea(array('name' => 'medical_condition', 'id' => 'medical_condition', 'value' => ($user_data)?$user_data->medical_condition:$this->session->flashdata('medical_condition'), 'class' => 'form-control ')); ?> </div>
                                <div class="col-md-6"> <?php print form_label('Allergies', 'medical_allergies',array('class'=>'form-label')); ?> <?php print form_textarea(array('name' => 'medical_allergies', 'id' => 'medical_allergies', 'value' => ($user_data)?$user_data->medical_allergies:$this->session->flashdata('medical_allergies'), 'class' => 'form-control ')); ?> </div>
                              </div>
                              <!--row 4.2 end-->
                            </div>
                            <div class="tab-pane" id="tab4"> <br>
                              <h4 class="semi-bold">Step 4 - <span class="light">Interview Details</span></h4>
                              <br>
                              <div class="row form-row">
                                <div class="col-md-6"> <?php print form_label('a. Lesson plan submitted', 'lesson_plan_submitted',array('class'=>'form-label')); ?> <?php print form_dropdown('lesson_plan_submitted',array(''=>'Select','Yes'=> 'Yes','No'=>'No'),($user_data)?$user_data->lesson_plan_submitted:$this->session->flashdata('lesson_plan_submitted'),'id="lesson_plan_submitted" class=""'); ?> </div>
                                <div class="col-md-6"> <?php print form_label('d. Writing sample submitted', 'writing_sample_submitted',array('class'=>'form-label')); ?> <?php print form_dropdown('writing_sample_submitted',array(''=>'Select','Yes'=> 'Yes','No'=>'No'),($user_data)?$user_data->writing_sample_submitted:$this->session->flashdata('writing_sample_submitted'),'id="writing_sample_submitted" class=""'); ?> </div>
                              </div>
                              <div class="row form-row">
                                <div class="col-md-6"> <?php print form_label('b. Lesson plan suitable','lesson_plan_suitable',array('class'=>'form-label')); ?> <?php print form_dropdown('lesson_plan_suitable',array(''=>'Select','Yes'=> 'Yes','No'=>'No'),($user_data)?$user_data->lesson_plan_suitable:$this->session->flashdata('lesson_plan_suitable'),'id="lesson_plan_suitable" class=""'); ?> </div>
                                <div class="col-md-6"> <?php print form_label('e. Writing sample suitable', 'writing_sample_suitable',array('class'=>'form-label')); ?> <?php print form_dropdown('writing_sample_suitable',array(''=>'Select','Yes'=> 'Yes','No'=>'No'),($user_data)?$user_data->writing_sample_suitable:$this->session->flashdata('writing_sample_suitable'),'id="writing_sample_suitable" class=""'); ?> </div>
                              </div>
                              <div class="row form-row">
                                <div class="col-md-6"> <?php print form_label('c. Lesson plan comments', 'lesson_plan_comments',array('class'=>'form-label')); ?> <?php print form_textarea(array('name' => 'lesson_plan_comments', 'id' => 'lesson_plan_comments', 'value' => ($user_data)?$user_data->lesson_plan_comments:$this->session->flashdata('lesson_plan_comments'), 'class' => 'form-control ')); ?> </div>
                                <div class="col-md-6"> <?php print form_label('f. Writing sample comments', 'writing_sample_comments',array('class'=>'form-label')); ?> <?php print form_textarea(array('name' => 'writing_sample_comments', 'id' => 'writing_sample_comments', 'value' => ($user_data)?$user_data->writing_sample_comments:$this->session->flashdata('writing_sample_comments'), 'class' => 'form-control ')); ?> </div>
                              </div>
                              <div class="row form-row">
                                <div class="col-md-6"> <?php print form_label('g. Demo lesson recommended', 'demo_lesson_recommended',array('class'=>'form-label')); ?> <?php print form_dropdown('demo_lesson_recommended',array(''=>'Select','Yes'=> 'Yes','No'=>'No'),($user_data)?$user_data->demo_lesson_recommended:$this->session->flashdata('demo_lesson_recommended'),'id="demo_lesson_recommended" class=""'); ?> </div>
                              </div>
                              <!--row 6.5 start-->
                              <div class="row form-row">
                                <div class="col-md-12"> <?php print form_label('Interview Details', '',array('class'=>'form-label')); ?> </div>
                                <div class="col-md-6">
                                  <?php //print form_input(array('name' => 'interviewee1', 'id' => 'interviewee1', 'value' => ($user_data)?$user_data->interviewee1:$this->session->flashdata('interviewee1'), 'class' => 'form-control','placeholder' => 'Interview 1')); ?>
                                  <?php print form_label('Interviewer 1', 'interviewee1',array('class'=>'form-label')); ?> <?php print form_dropdown('interviewee1',$other_user_interviewer_list,($user_data)?$user_data->interviewee1:$this->session->flashdata('interviewee1'),'id="interviewee1" class=""'); ?> </div>
                                <div class="col-md-6">
                                  <?php //print form_input(array('name' => 'interviewee2', 'id' => 'interviewee2', 'value' => ($user_data)?$user_data->interviewee2:$this->session->flashdata('interviewee2'), 'class' => 'form-control','placeholder' => 'Interview 2')); ?>
                                  <?php print form_label('Interviewer 2', 'interviewee2',array('class'=>'form-label')); ?> <?php print form_dropdown('interviewee2',$other_user_interviewer_list,($user_data)?$user_data->interviewee2:$this->session->flashdata('interviewee2'),'id="interviewee2" class=""'); ?> </div>
                                <div class="col-md-4">
                                  <div class="input-append success date col-md-10 col-lg-10 no-padding"> <?php print form_input(array('name' => 'interview_date', 'id' => 'show_dp', 'value' => ($user_data)?make_dp_date($user_data->interview_date):$this->session->flashdata('interview_date'), 'class' => 'form-control','placeholder' => 'Interview date')); ?> <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span> </div>
                                </div>
                                <div class="col-md-4"> <?php print form_dropdown('interview_outcome',$interview_outcome_list,($user_data)?$user_data->interview_outcome:$this->session->flashdata('interview_outcome'),'id="interview_outcome" class=""'); ?> </div>
                                <div class="col-md-4"> <?php print form_dropdown('interview_type',$interview_type_list,($user_data)?$user_data->interview_type:$this->session->flashdata('interview_type'),'id="interview_type" class=""'); ?> </div>
                                <div class="col-md-12"> <?php print form_textarea(array('name' => 'interview_notes', 'id' => 'interview_notes', 'value' => ($user_data)?$user_data->interview_notes:$this->session->flashdata('interview_notes'), 'class' => 'form-control ')); ?> </div>
                              </div>
                              <!--row 6.5 end-->
                            </div>
                            <ul class=" wizard wizard-actions">
                              <li class="previous first" style="display:none;"><a href="javascript:;" class="btn">&nbsp;&nbsp;First&nbsp;&nbsp;</a></li>
                              <li class="previous"><a href="javascript:;" class="btn">&nbsp;&nbsp;Previous&nbsp;&nbsp;</a></li>
                              <li class="next last" style="display:none;"><a href="javascript:;" class="btn btn-primary">&nbsp;&nbsp;Last&nbsp;&nbsp;</a></li>
                              <li class="next"><a href="javascript:;" class="btn btn-primary">&nbsp;&nbsp;Next&nbsp;&nbsp;</a></li>
                              <li class=""> <?php print form_hidden('user_id', ($user_data)?$user_data->user_unique_id:0); ?>
                                <input type="submit" name="submit" id="submit" value="Save" class="btn btn-success"/>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <?php print form_close() ."\r\n"; ?> </div>
                    </div>
                  </div>
                </div>
                <?php } else { ?>
                <div class="grid info-box">
                  <h3 class="userinfo-ttl"><?php echo $user_data->first_name.' '.$user_data->last_name; ?> <span class="semi-bold"><?php echo $user_data->elsd_id; ?></span></h3>
                  <div class="grid-body">
                    <div class="info-box">
                      <?php
		if ($this->session->flashdata('message')) {
			print "<br><div class=\"alert alert-error\">". $this->session->flashdata('message') ."</div>";
		}
		?>
                      <div class="row"> <?php print form_open('list_user/edit_partial_profile/'.$user_data->user_unique_id.'/', array('id' => 'edit_profile','name'=>'edit_profile')) ."\r\n"; ?>
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-4"> <?php print form_label('DOB', 'birth_date',array('class'=>'form-label')); ?><?php print form_input(array('name' => 'birth_date', 'id' => 'show_dp', 'value' => ($user_data)?make_dp_date($user_data->birth_date):$this->session->flashdata('birth_date'), 'class' => 'form-control ','placeholder' => 'Dob')); ?> </div>
                            <div class="col-md-4"> <?php print form_label('Personal Email', 'personal_email',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'personal_email', 'id' => 'personal_email', 'value' => ($user_data)?$user_data->personal_email:$this->session->flashdata('personal_email'), 'class' => 'form-control','placeholder' => 'Personal Email')); ?> </div>
                            <div class="col-md-4"> <?php print form_label('Mobile Phone', 'cell_phone',array('class'=>'form-label')); ?> <?php print form_input(array('name' => 'cell_phone', 'id' => 'cell_phone', 'value' => ($user_data)?$user_data->cell_phone:$this->session->flashdata('cell_phone'), 'class' => 'form-control ','placeholder' => 'Mobile Phone')); ?> </div>
                          </div>
                        </div>
                        <div class="col-md-12"> <?php print form_hidden('user_id', ($user_data)?$user_data->user_unique_id:0); ?> <br>
                          <input type="submit" name="submit" id="submit" value="Save" class="btn btn-success"/>
                        </div>
                        <?php print form_close() ."\r\n"; ?> </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
              <!--***********************************************
    IF ADMIN SHOW FULL FORM OTHER WISE SHOW PARTIAL
    *********************************************** -->
              <div class="tab-pane generaltab" id="tab2Departure">
                <div class="info-box departure-info">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="sub-title">Departure Details</div>
                      <?php print form_open('list_user/edit_profile/'.encrypt_decrypt('e', $user_data->user_unique_id).'/7', array('id' => '','name'=>'')) ."\r\n"; ?>
                      <ul>
                        <li>
                          <div class="col-md-5"><?php print form_label('Reason for Leaving', 'resignation_resons',array('class'=>'form-label')); ?></div>
                          <div class="col-md-5"> <?php print form_dropdown('resignation_resons',array(''=>'N/A',
																		  'dismissed by sponsor'=>'Dismissed by sponsor',
																		  'dismissed by ksu'=>'Dismissed by KSU',
																		  'resigned'=>'Resigned',
																		  'end of contract'=>'End of contract',
																		  'left without notice'=>'Left without notice',
																		  'relocation by sponsor'=>'Relocation by sponsor',
																		  'other'=>'Other'),($user_data)?$user_data->resignation_resons:$this->session->flashdata('resignation_resons'),'id="resignation_resons" class="select2 form-control"'); ?> </div>
                        </li>
                        <li>
                          <div class="col-md-5"><?php print form_label('Departure Notes', 'departure_notes',array('class'=>'form-label')); ?></div>
                          <div class="col-md-5"> <?php print form_textarea(array('name' => 'departure_notes', 'id' => 'departure_notes', 'value' => ($user_data)?$user_data->departure_notes:$this->session->flashdata('departure_notes'), 'class' => 'form-control ')); ?> </div>
                        </li>
                        <li>
                          <div class="col-md-5"><?php print form_label('Final exit approved', 'exit_cleared',array('class'=>'form-label')); ?></div>
                          <div class="col-md-5"> <?php print form_dropdown('exit_cleared',array(''=>'N/A','1'=> 'Yes','0'=>'No'),($user_data)?$user_data->exit_cleared:$this->session->flashdata('exit_cleared'),'id="exit_cleared" class="select2 form-control"'); ?> </div>
                        </li>
                        <li>
                          <div class="col-md-5"><?php print form_label('Last day of work', 'last_day_of_work',array('class'=>'form-label')); ?></div>
                          <div class="col-md-5">
                            <div class="input-append success date col-md-10 col-lg-6 no-padding"> <?php print form_input(array('name' => 'last_day_of_work', 'id' => 'show_dp', 'value' => ($user_data)?make_dp_date($user_data->last_day_of_work):$this->session->flashdata('last_day_of_work'), 'class' => 'form-control ')); ?> <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span> </div>
                          </div>
                        </li>
                        <li>
                          <div class="col-md-5"><?php print form_hidden('user_id', ($user_data)?$user_data->user_unique_id:0); ?><?php print form_hidden('action', 'save_departure'); ?></div>
                          <div class="col-md-5">
                            <input type="submit" name="submit" id="submit" value="Save" class="btn btn-success"/>
                          </div>
                        </li>
                      </ul>
                      <?php print form_close() ."\r\n"; ?> </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane generaltab" id="tab2Documents">
                <div class="info-box Document-info">
                  <div class="row">
                    <div class="col-md-12">
                      <?php
                    if ($this->session->flashdata('message')) {
                        print "<div class=\"alert alert-error\">". $this->session->flashdata('message') ."</div>";
                    }
                    ?>
                      <div><b><em>Please note only the following file types are permitted: jpg,jpeg,pdf,png,doc,docx,xlsx,xls,zip,csv</em></b></div>
                      <div class="sub-title">
                        <div class="col-md-5">Upload / Replace Document</div>
                        <div class="col-md-7">Delete</div>
                      </div>
                      <?php print form_open_multipart('list_user/upload_profile_document/'.$user_data->user_unique_id, array('id' => 'upload_profile_document','name'=>'upload_profile_document')) ."\r\n"; ?>
                      <ul>
                        <li>
                          <div class="col-md-5">
                            <label>Photo</label>
                            <input type="file" name="photo[]" id="photo" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf" placeholder="Do you have a .ppt?">
                          </div>
                          <div class="col-md-7">
                            <?php
                        if(isset($user_documents["1"]) && count($user_documents["1"]) > 0)
                        {
							foreach($user_documents["1"] as $_document_id => $_document) {
                        ?>
                            <a href="<?php print base_url().$_document; ?>" target="_blank">
                            <!--<i class="fa fa-picture-o"></i>-->
                            <img src="<?php print base_url().$_document; ?>" width="100" /> </a> <a class="btn-delet" title="Delete" href="<?php print base_url()?>list_user/delete_profile_document/<?php echo $user_data->user_unique_id?>/1/<?php echo $_document_id; ?>"><i class="fa fa-trash-o"></i></a>
                            <?php
							}
                        }
                        ?>
                          </div>
                        </li>
                        <li>
                          <div class="col-md-5">
                            <label>Passport</label>
                            <input type="file" name="passport[]" id="passport" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf" multiple>
                          </div>
                          <div class="col-md-7">
                            <?php
                        if(isset($user_documents["2"]) && count($user_documents["2"]) > 0)
                        {
							foreach($user_documents["2"] as $_document_id => $_document) {
                        ?>
                            <div> <a href="<?php print base_url().$_document; ?>" target="_blank"> <i class="fa fa-book"></i></a> <a class="btn-delet" title="Delete" href="<?php print base_url()?>list_user/delete_profile_document/<?php echo $user_data->user_unique_id?>/2/<?php echo $_document_id; ?>"><i class="fa fa-trash-o"></i></a> </div>
                            <?php
							}
                        }
                        ?>
                          </div>
                        </li>
                        <li>
                          <div class="col-md-5">
                            <label>Personal CV</label>
                            <input type="file" name="cv[]" id="cv" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf" multiple>
                          </div>
                          <div class="col-md-7">
                            <?php
                        if(isset($user_documents["9"]) && count($user_documents["9"]) > 0)
                        {
              foreach($user_documents["9"] as $_document_id => $_document) {
                        ?>
                            <div> <a href="<?php print base_url().$_document; ?>" target="_blank"> <i class="fa fa-file-text"></i></a> <a class="btn-delet" title="Delete" href="<?php print base_url()?>list_user/delete_profile_document/<?php echo $user_data->user_unique_id?>/9/<?php echo $_document_id; ?>"><i class="fa fa-trash-o"></i></a> </div>
                            <?php
              }
                        }
                        ?>
                          </div>
                        </li>
                        <li>
                          <div class="col-md-5">
                            <label>Degree Certificate</label>
                            <input type="file" name="Degree_Certificate[]" id="Degree_Certificate" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf" multiple>
                          </div>
                          <div class="col-md-7">
                            <?php
                        if(isset($user_documents["3"]) && count($user_documents["3"]) > 0)
                        {
              foreach($user_documents["3"] as $_document_id => $_document) {
                        ?>
                            <div> <a href="<?php print base_url().$_document; ?>" target="_blank"> <i class="fa fa-file-text"></i></a> <a class="btn-delet" title="Delete" href="<?php print base_url()?>list_user/delete_profile_document/<?php echo $user_data->user_unique_id?>/3/<?php echo $_document_id; ?>"><i class="fa fa-trash-o"></i></a> </div>
                            <?php
              }
                        }
                        ?>
                          </div>
                        </li>
                        <li>
                          <div class="col-md-5">
                            <label>Add Transcript Degree</label>
                            <input type="file" name="Add_Transcript_Degree[]" id="Add_Transcript_Degree" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf" multiple>
                          </div>
                          <div class="col-md-7">
                            <?php
                        if(isset($user_documents["16"]) && count($user_documents["16"]) > 0)
                        {
              foreach($user_documents["16"] as $_document_id => $_document) {
                        ?>
                            <div> <a href="<?php print base_url().$_document; ?>" target="_blank"> <i class="fa fa-file-text"></i></a> <a class="btn-delet" title="Delete" href="<?php print base_url()?>list_user/delete_profile_document/<?php echo $user_data->user_unique_id?>/16/<?php echo $_document_id; ?>"><i class="fa fa-trash-o"></i></a> </div>
                            <?php
              }
                        }
                        ?>
                          </div>
                        </li>
                        <li>
                          <div class="col-md-5">
                            <label>Master Certificate</label>
                            <input type="file" name="Master_Certificate[]" id="Master_Certificate" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf" multiple>
                          </div>
                          <div class="col-md-7">
                            <?php
                        if(isset($user_documents["4"]) && count($user_documents["4"]) > 0)
                        {
              foreach($user_documents["4"] as $_document_id => $_document) {
                        ?>
                            <div> <a href="<?php print base_url().$_document; ?>" target="_blank"> <i class="fa fa-file-text"></i></a> <a class="btn-delet" title="Delete" href="<?php print base_url()?>list_user/delete_profile_document/<?php echo $user_data->user_unique_id?>/4/<?php echo $_document_id; ?>"><i class="fa fa-trash-o"></i></a> </div>
                            <?php
              }
                        }
                        ?>
                          </div>
                        </li>
                        <li>
                          <div class="col-md-5">
                            <label>Add Transcript Masters</label>
                            <input type="file" name="Add_Transcript_Masters[]" id="Add_Transcript_Masters" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf" multiple>
                          </div>
                          <div class="col-md-7">
                            <?php
                        if(isset($user_documents["17"]) && count($user_documents["17"]) > 0)
                        {
              foreach($user_documents["17"] as $_document_id => $_document) {
                        ?>
                            <div> <a href="<?php print base_url().$_document; ?>" target="_blank"> <i class="fa fa-file-text"></i></a> <a class="btn-delet" title="Delete" href="<?php print base_url()?>list_user/delete_profile_document/<?php echo $user_data->user_unique_id?>/17/<?php echo $_document_id; ?>"><i class="fa fa-trash-o"></i></a> </div>
                            <?php
              }
                        }
                        ?>
                          </div>
                        </li>
                        <li>
                          <div class="col-md-5">
                            <label>PHD Certificate</label>
                            <input type="file" name="Phd_Certificate[]" id="Phd_Certificate" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf" multiple>
                          </div>
                          <div class="col-md-7">
                            <?php
                        if(isset($user_documents["5"]) && count($user_documents["5"]) > 0)
                        {
              foreach($user_documents["5"] as $_document_id => $_document) {
                        ?>
                            <div> <a href="<?php print base_url().$_document; ?>" target="_blank"> <i class="fa fa-file-text"></i></a> <a class="btn-delet" title="Delete" href="<?php print base_url()?>list_user/delete_profile_document/<?php echo $user_data->user_unique_id?>/5/<?php echo $_document_id; ?>"><i class="fa fa-trash-o"></i></a> </div>
                            <?php
              }
                        }
                        ?>
                          </div>
                        </li>
                        <li>
                          <div class="col-md-5">
                            <label>Add Transcript PHD</label>
                            <input type="file" name="Add_Transcript_PHD[]" id="Add_Transcript_PHD" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf" multiple>
                          </div>
                          <div class="col-md-7">
                            <?php
                        if(isset($user_documents["20"]) && count($user_documents["20"]) > 0)
                        {
              foreach($user_documents["20"] as $_document_id => $_document) {
                        ?>
                            <div> <a href="<?php print base_url().$_document; ?>" target="_blank"> <i class="fa fa-file-text"></i></a> <a class="btn-delet" title="Delete" href="<?php print base_url()?>list_user/delete_profile_document/<?php echo $user_data->user_unique_id?>/20/<?php echo $_document_id; ?>"><i class="fa fa-trash-o"></i></a> </div>
                            <?php
              }
                        }
                        ?>
                          </div>
                        </li>
                        <li>
                          <div class="col-md-5">
                            <label>Teaching Certificate</label>
                            <input type="file" name="Teaching_Certificate[]" id="Teaching_Certificate" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf" multiple>
                          </div>
                          <div class="col-md-7">
                            <?php
                        if(isset($user_documents["6"]) && count($user_documents["6"]) > 0)
                        {
              foreach($user_documents["6"] as $_document_id => $_document) {
                        ?>
                            <div> <a href="<?php print base_url().$_document; ?>" target="_blank"> <i class="fa fa-file-text"></i></a> <a class="btn-delet" title="Delete" href="<?php print base_url()?>list_user/delete_profile_document/<?php echo $user_data->user_unique_id?>/6/<?php echo $_document_id; ?>"><i class="fa fa-trash-o"></i></a> </div>
                            <?php
              }
                        }
                        ?>
                          </div>
                        </li>
                        <li>
                          <div class="col-md-5">
                            <label>Other Certificate</label>
                            <input type="file" name="Other_Certificate[]" id="Other_Certificate" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf" multiple>
                          </div>
                          <div class="col-md-7">
                            <?php
                        if(isset($user_documents["8"]) && count($user_documents["8"]) > 0)
                        {
              foreach($user_documents["8"] as $_document_id => $_document) {
                        ?>
                            <div> <a href="<?php print base_url().$_document; ?>" target="_blank"> <i class="fa fa-file-text"></i></a> <a class="btn-delet" title="Delete" href="<?php print base_url()?>list_user/delete_profile_document/<?php echo $user_data->user_unique_id?>/8/<?php echo $_document_id; ?>"><i class="fa fa-trash-o"></i></a> </div>
                            <?php
              }
                        }
                        ?>
                          </div>
                        </li>
                        <li>
                          <div class="col-md-5">
                            <label>Reference 1</label>
                            <input type="file" name="Reference_1[]" id="Reference_1" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf" multiple>
                          </div>
                          <div class="col-md-7">
                            <?php
                        if(isset($user_documents["11"]) && count($user_documents["11"]) > 0)
                        {
              foreach($user_documents["11"] as $_document_id => $_document) {
                        ?>
                            <div> <a href="<?php print base_url().$_document; ?>" target="_blank"> <i class="fa fa-file-text"></i></a> <a class="btn-delet" title="Delete" href="<?php print base_url()?>list_user/delete_profile_document/<?php echo $user_data->user_unique_id?>/11/<?php echo $_document_id; ?>"><i class="fa fa-trash-o"></i></a> </div>
                            <?php
              }
                        }
                        ?>
                          </div>
                        </li>
                        <li>
                          <div class="col-md-5">
                            <label>Reference 2</label>
                            <input type="file" name="Reference_2[]" id="Reference_2" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf" multiple>
                          </div>
                          <div class="col-md-7">
                            <?php
                        if(isset($user_documents["12"]) && count($user_documents["12"]) > 0)
                        {
							foreach($user_documents["12"] as $_document_id => $_document) {
                        ?>
                            <div> <a href="<?php print base_url().$_document; ?>" target="_blank"> <i class="fa fa-file-text"></i></a> <a class="btn-delet" title="Delete" href="<?php print base_url()?>list_user/delete_profile_document/<?php echo $user_data->user_unique_id?>/12/<?php echo $_document_id; ?>"><i class="fa fa-trash-o"></i></a> </div>
                            <?php
							}
                        }
                        ?>
                          </div>
                        </li>
                        <li>
                          <div class="col-md-5">
                            <label>Add Other Document 1</label>
                            <input type="file" name="Add_Other_Document_1[]" id="Add_Other_Document_1" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf" multiple>
                          </div>
                          <div class="col-md-7">
                            <?php
                        if(isset($user_documents["18"]) && count($user_documents["18"]) > 0)
                        {
              foreach($user_documents["18"] as $_document_id => $_document) {
                        ?>
                            <div> <a href="<?php print base_url().$_document; ?>" target="_blank"> <i class="fa fa-file-text"></i></a> <a class="btn-delet" title="Delete" href="<?php print base_url()?>list_user/delete_profile_document/<?php echo $user_data->user_unique_id?>/18/<?php echo $_document_id; ?>"><i class="fa fa-trash-o"></i></a> </div>
                            <?php
              }
                        }
                        ?>
                          </div>
                        </li>
                        <li>
                          <div class="col-md-5">
                            <label>Add Other Document 2</label>
                            <input type="file" name="Add_Other_Document_2[]" id="Add_Other_Document_2" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf" multiple>
                          </div>
                          <div class="col-md-7">
                            <?php
                        if(isset($user_documents["19"]) && count($user_documents["19"]) > 0)
                        {
              foreach($user_documents["19"] as $_document_id => $_document) {
                        ?>
                            <div> <a href="<?php print base_url().$_document; ?>" target="_blank"> <i class="fa fa-file-text"></i></a> <a class="btn-delet" title="Delete" href="<?php print base_url()?>list_user/delete_profile_document/<?php echo $user_data->user_unique_id?>/19/<?php echo $_document_id; ?>"><i class="fa fa-trash-o"></i></a> </div>
                            <?php
              }
                        }
                        ?>
                          </div>
                        </li>
                        <li>
                          <div class="col-md-5">
                            <label>Lesson Plan</label>
                            <input type="file" name="Lesson_Plan[]" id="Lesson_Plan" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf" multiple>
                          </div>
                          <div class="col-md-7">
                            <?php
                        if(isset($user_documents["13"]) && count($user_documents["13"]) > 0)
                        {
							foreach($user_documents["13"] as $_document_id => $_document) {
                        ?>
                            <div> <a href="<?php print base_url().$_document; ?>" target="_blank"> <i class="fa fa-file-text"></i></a> <a class="btn-delet" title="Delete" href="<?php print base_url()?>list_user/delete_profile_document/<?php echo $user_data->user_unique_id?>/13/<?php echo $_document_id; ?>"><i class="fa fa-trash-o"></i></a> </div>
                            <?php
							}
                        }
                        ?>
                          </div>
                        </li>
                        <li>
                          <div class="col-md-5">
                            <label>Writing Sample</label>
                            <input type="file" name="Writing_Sample[]" id="Writing_Sample" class="form-control input-sm" accept="image/jpg|image/jpeg|image/png|application/pdf" multiple>
                          </div>
                          <div class="col-md-7">
                            <?php
                        if(isset($user_documents["14"]) && count($user_documents["14"]) > 0)
                        {
							foreach($user_documents["14"] as $_document_id => $_document) {
                        ?>
                            <div> <a href="<?php print base_url().$_document; ?>" target="_blank"> <i class="fa fa-file-text"></i></a> <a class="btn-delet" title="Delete" href="<?php print base_url()?>list_user/delete_profile_document/<?php echo $user_data->user_unique_id?>/14/<?php echo $_document_id; ?>"><i class="fa fa-trash-o"></i></a> </div>
                            <?php
							}
                        }
                        ?>
                          </div>
                        </li>
                      </ul>
                      <br />
                      <input type="submit" name="submit" value="Submit" class="btn btn-success btn-cons">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--***********************************************
                          END HIDE FOR NORMAL USERS
              *********************************************** -->
              <div class="tab-pane generaltab" id="tab2ChangePassword">
                <div class="info-box departure-info">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="grid simple">
                        <?php /*?><div class="grid-title">
                        <h4><?php print  $this->lang->line('edit_password'); ?></h4>
                      </div><?php */?>
                        <div class="grid-body "> <?php print form_open('list_user/update_password', array('id' => 'profile_pwd_form', 'class' => 'membership_form')) ."\r\n"; ?>
                          <?php
                        if ($this->session->flashdata('pwd_message')) {
                            print "<div class=\"alert alert-error\">". $this->session->flashdata('pwd_message') ."</div>";
                        }
                        ?>
                          <div class="row">
                            <div class="col-md-4"> <?php print form_label($this->lang->line('current_password'), 'form-label'); ?>
                              <div class="input-with-icon  right"> <i class=""></i> <?php print form_password(array('name' => 'current_password', 'id' => 'current_password', 'class' => 'form-control')); ?> </div>
                            </div>
                            <div class="col-md-4"> <?php print form_label($this->lang->line('new_password'), 'profile_new_password'); ?>
                              <div class="input-with-icon  right"> <i class=""></i> <?php print form_password(array('name' => 'new_password', 'id' => 'profile_new_password', 'class' => 'form-control')); ?> </div>
                            </div>
                            <div class="col-md-4"> <?php print form_label($this->lang->line('new_password_again'), 'new_password_again'); ?>
                              <div class="input-with-icon  right"> <i class=""></i> <?php print form_password(array('name' => 'new_password_again', 'id' => 'new_password_again', 'class' => 'form-control')); ?> </div>
                            </div>
                          </div>
                          <div class="form-actions"> <?php print form_hidden('user_id', ($user_data)?$user_data->user_unique_id:0); ?> <?php print form_submit(array('name' => 'submit', 'value' => $this->lang->line('update_password'), 'id' => '', 'class' => 'btn btn-success btn-cons')); ?> </div>
                          <?php print form_close() ."\r\n"; ?> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php
		if($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '3' || $isLineManager == 1){ ?>
          <div class="tab-pane" id="tab2comments">
            <div class="grid">
              <h3 class="userinfo-ttl">Comments</h3>
              <div class="grid-body ">
                <script type="text/javascript" src="<?php print base_url(); ?>js/grid/user_profile_comment.js"></script>
                <table class="table" id="grid_profile_comment">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Staff Name</th>
                      <th>Note type</th>
                      <th>Department</th>
                      <th>Category </th>
                      <th>Detail</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Staff Name</th>
                      <th>Note type</th>
                      <th>Department</th>
                      <th>Category </th>
                      <th>Detail</th>
                      <th>Date</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  </tbody>
                </table>
                <?php
				if($this->session->userdata('role_id') == '3'){ ?>
                <script type="application/javascript">
					$(document).ready( function () {
						comment_fnShowHide(1);
					});
					</script>
                <?php } ?>
              </div>
            </div>
          </div>
          <?php
		} ?>
          <?php if($this->session->userdata('user_id') && $this->session->userdata('user_id') == $user_id){
                    if($this->session->userdata('role_id') == '3'){ ?>
          <div class="tab-pane" id="tab2mylessions">
            <div class="grid">
              <h3 class="userinfo-ttl">My Lesson Observations</h3>
              <div class="grid-body ">
                <script type="text/javascript" src="<?php print base_url(); ?>js/grid/user_profile_mylession_teacher.js"></script>
                <table class="table" id="grid_profile_mylession">
                  <thead>
                    <tr>
                      <th>Semester</th>
                      <th>Week</th>
                      <th>Observation Date</th>
                      <th>Observation Time</th>
                      <th>Observer Name</th>
                      <th>Observer Email</th>
                      <th style="width:162px">Ob Score 1</th>
                      <th style="width:182px">Ed Tech Score 1</th>
                      <th style="width:162px">Ob Score 2</th>
                      <th style="width:182px">Ed Tech Score 2</th>
                      <th width="350px;"></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Semester</th>
                      <th>Week</th>
                      <th>Observation Date</th>
                      <th>Observation Time</th>
                      <th>Observer Name</th>
                      <th>Observer Email</th>
                      <th>Ob Score 1</th>
                      <th>Ed Tech Score 1</th>
                      <th>Ob Score 2</th>
                      <th>Ed Tech Score 2</th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php  } else  {?>
          <div class="tab-pane" id="tab2mylessions">
            <div class="grid">
              <h3 class="userinfo-ttl">My Lesson Observations</h3>
              <div class="grid-body ">
                <script type="text/javascript" src="<?php print base_url(); ?>js/grid/user_profile_mylession.js"></script>
                <table class="table" id="grid_profile_mylession">
                  <thead>
                    <tr>
                      <th>Semester</th>
                      <th>Week</th>
                      <th>Observation Date</th>
                      <th>Observation Time</th>
                      <th>Teacher Name</th>
                      <th>KSU Email</th>
                      <th>Personal Email</th>
                      <th>Teacher Mobile</th>
                      <th>Pre Observation Date</th>
                      <th>Pre Observation Time</th>
                      <th>Pre Observation Venue</th>
                      <th>Post Observation Date</th>
                      <th>Post Observation Time,</th>
                      <th>Post Observation Venue</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Semester</th>
                      <th>Week, </th>
                      <th>Observation Date</th>
                      <th>Observation Time</th>
                      <th>Teacher Name</th>
                      <th>KSU Email</th>
                      <th>Personal Email</th>
                      <th>Teacher Mobile</th>
                      <th>Pre Observation Date</th>
                      <th>Pre Observation Time</th>
                      <th>Pre Observation Venue</th>
                      <th>Post Observation Date</th>
                      <th>Post Observation Time,</th>
                      <th>Post Observation Venue</th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php } }?>
          <?php if($this->session->userdata('user_id') && $this->session->userdata('user_id') == $user_id){?>
          <!-- div class="tab-pane" id="tab2lessonObservation">
                    <div class="grid">
                        <h3 class="userinfo-ttl">Lesson Observations</h3>
                        <div class="grid-body ">
                            <script type="text/javascript" src="<?php print base_url(); ?>js/grid/user_profile_lesson_observation.js"></script>
                            <table class="table" id="grid_profile_lessonObservation">
                                <thead>
                                        <tr>
                                            <th>Semester</th>
                                            <th>Week</th>
                                            <th>Observation Date</th>
                                            <th>Observation Time</th>
                                            
                                            <th>Teacher Name</th>
                                            <th>Teacher Email</th>
                                            <th>Teacher Personal Email</th>                                            
                                            <th>Teacher Mobile</th>
                                            
                                            <th>Observer Name</th>
                                            <th>Observer Email</th>
                                            <th>Observer Personal Email</th>                                            
                                            <th>Observer Mobile</th>
                                                                                        
                                            <th>Pre Observation Date</th>
                                            <th>Pre Observation Time</th>
                                            <th>Pre Observation Venue</th>
                                            <th>Post Observation Date</th>
                                            <th>Post Observation Time,</th>
                                            <th>Post Observation Venue</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                          <th>Semester</th>
                                            <th>Week</th>
                                            <th>Observation Date</th>
                                            <th>Observation Time</th>
                                            
                                            <th>Teacher Name</th>
                                            <th>Teacher Email</th>
                                            <th>Teacher Personal Email</th>                                            
                                            <th>Teacher Mobile</th>
                                            
                                            <th>Observer Name</th>
                                            <th>Observer Email</th>
                                            <th>Observer Personal Email</th>                                            
                                            <th>Observer Mobile</th>
                                                                                        
                                            <th>Pre Observation Date</th>
                                            <th>Pre Observation Time</th>
                                            <th>Pre Observation Venue</th>
                                            <th>Post Observation Date</th>
                                            <th>Post Observation Time,</th>
                                            <th>Post Observation Venue</th>
                                        </tr>
                                    </tfoot>
                                    <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div-->
          <?php }?>
          <div class="tab-pane" id="tab2My_Line_Management_Attendance">
            <div class="grid">
              <h3 class="userinfo-ttl">My Line Management Attendance</h3>
              <div class="grid-body ">
                <script type="text/javascript" src="<?php print base_url(); ?>js/grid/user_profile_line_management_attendance.js"></script>
                <table class="table" id="grid_profile_line_management_attendance">
                  <thead>
                    <tr>
                      <th>Attendance</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Tab End -->
