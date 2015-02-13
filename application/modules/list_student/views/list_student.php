<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$arrAttendanceAction = get_priviledge_action("attendance");
$arrGradeReportAction = get_priviledge_action("grade_report");
$arrComplaintAction = get_priviledge_action("complaint");
?>
<script>
var globalsearchkwd = "<?=$globalsearchkwd?>";
var showattandancelink = 0;
var showgradereportlink = 0;
var showcomplaintlink = 0;
var str_campus_list = [];
var str_track_list = [];
var str_building_list = [];
var str_academic_status_list = [];
<?php
if(is_array($campus_list) && count($campus_list) > 0)
{
	foreach($campus_list AS $keyid=>$valname)
	{
		if((int)$keyid > 0)
		{
		?>
			str_campus_list.push("<?echo $valname?>");
		<?
		}
	}
}
if(is_array($track) && count($track) > 0)
{
	foreach($track AS $keyid=>$valname)
	{
		if($keyid != "")
		{
		?>
			str_track_list.push("<?echo $valname?>");
		<?
		}
	}
}
if(is_array($buildings) && count($buildings) > 0)
{
	foreach($buildings AS $keyid=>$valname)
	{
		if($keyid != "")
		{
		?>
			str_building_list.push("<?echo $valname?>");
		<?
		}
	}
}
if(is_array($acadmic_status) && count($acadmic_status) > 0)
{
	foreach($acadmic_status AS $keyid=>$valname)
	{
		if($keyid != "")
		{
		?>
			str_academic_status_list.push("<?echo $valname?>");
		<?
		}
	}
}
if($this->session->userdata('role_id') == '1' || (is_array($arrAttendanceAction) && count($arrAttendanceAction) > 0 && in_array("add_attendance",$arrAttendanceAction)))
{
?>
	showattandancelink = 1;
<?php
}
if($this->session->userdata('role_id') == '1' || (is_array($arrGradeReportAction) && count($arrGradeReportAction) > 0 && in_array("add_grades",$arrGradeReportAction)))
{
?>
	showgradereportlink = 1;
<?php
}
if($this->session->userdata('role_id') == '1' || (is_array($arrComplaintAction) && count($arrComplaintAction) > 0 && in_array("add",$arrComplaintAction)))
{
?>
	showcomplaintlink = 1;
<?php
}
?>

</script>
<script type="text/javascript">
var edit_flag = 1;
<?php 
if($this->session->userdata('role_id') != '1' && !in_array("edit",$this->arrAction))
{
?>
	edit_flag = 0;
<?php 
}
?>
</script>
<script type="text/javascript" src="<?php print base_url(); ?>js/grid/list_student.js?t=newjsct"></script>

<?php 
if($this->session->userdata('role_id') == '1' || in_array("add",$this->arrAction))
{
?>

<div id="add_model_link">
	<a href="list_student/add" class="btn btn-success" data-target="#myModal" data-toggle="modal"><?php echo $this->lang->line('add_new'); ?> <i class="fa fa-plus"></i></a>
    </div>

<?php 
}
?>


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


<div class="row-fluid">
	<div class="span12">
		<div class="grid simple ">
			<div class="grid-title">
			  <h4><?php echo $this->lang->line('student_p_heading'); ?></h4>
                <div class="pull-right">
                    <form id="export_file" action="list_student/export_to_excel" target="download_iframe" method="POST">
                        <div class="col-md-7">&nbsp;&nbsp;
						</div>
                            <div class="col-md-5">
                            <input type="submit" name="submit" value="Export To XLS" class="btn btn-info pull-right">
                            </div>
                    </form>
                </div>
			</div>
			<div class="grid-body ">
			<div id="processing_message" class="hide" title="Processing">Please wait while your request is being processed...</div>
			<table class="table" id="grid_student">
				<thead>
					<tr>
						<th style="width:30px"></th>
						<th style="width:120px"><?php print $this->lang->line('student_p_stud_id'); ?></th>
						<th><?php print $this->lang->line('student_p_full_name'); ?></th>
						<th style="width:160px"><?php echo $this->lang->line('sch_date'); ?></th>	
						<th style="width:77px"><?php print $this->lang->line('student_p_section'); ?></th>
						<th style="width:77px"><?php echo $this->lang->line('campus'); ?></th>
						<th style="width:77px"><?php print $this->lang->line('sub_att_p_track'); ?></th>
						<th style="width:77px"><?php print $this->lang->line('student_p_building'); ?></th>
						<th style="width:77px"><?php print $this->lang->line('student_p_status'); ?></th>
						<th style="width:30px"></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th style="width:30px"></th>
						<th><?php print $this->lang->line('student_p_stud_id'); ?></th>
						<th><?php print $this->lang->line('student_p_full_name'); ?></th>
						<th><?php echo $this->lang->line('sch_date'); ?></th>	
						<th><?php print $this->lang->line('student_p_section'); ?></th>
						<th><?php echo $this->lang->line('campus'); ?></th>
						<th><?php print $this->lang->line('sub_att_p_track'); ?></th>
						<th><?php print $this->lang->line('student_p_building'); ?></th>
						<th><?php print $this->lang->line('student_p_status'); ?></th>
						<th></th>
					</tr>
				</tfoot>
				<tbody>
				
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>

<script language="javascript">
$(document).ready(function() {
	//fnShowHide(2);
	//fnShowHide(4);
	//fnShowHide(5);
	//fnShowHide(6);
	<?php 
	if($this->session->userdata('role_id') != '1' && !in_array("edit",$this->arrAction))
	{
	?>
		//fnShowHide(7);
	<?php 
	}
	?>
});
</script>  	  
