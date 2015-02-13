var table_total_col = $('table.table thead tr').children().length;
$('body').on('hidden.bs.modal','#myModal', function() {
	$(this).removeData('bs.modal');
	$(this).find('.modal-header').html('<h2>Loading....</h2><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button><br />');
	$(this).find('.modal-body').html('<div style="text-align:center;"><i class="fa fa-spinner fa fa-6x fa-spin" id="animate-icon"></i></div>');
	$(this).find('.modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
});

$('body').on('hidden.bs.modal','#mysearchModal', function() {
	$(this).removeData('bs.modal');
	$(this).find('.modal-header').html('<h2>Loading....</h2><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button><br />');
	$(this).find('.modal-body').html('<div style="text-align:center;"><i class="fa fa-spinner fa fa-6x fa-spin" id="animate-icon"></i></div>');
	$(this).find('.modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
});
function reload_datatable(){
	TableAjax.reload_dt();
	//Datatable.dataTable.fnStandingRedraw();
	//Datatable.ajax.reload();
	//Datatable.reloadDatatable1();
	//TableAjax.ajax.reload();
}
function deleterecord(url,id)
{
	var conf = confirm("Are you sure you want to delete this record?");
	if(conf == true){
		document.formmain.action = url+'/delete/'+id;
		document.formmain.submit();
	}
}

$(document).ready(function(){
	var add_model_link_html = $("#add_model_link").html();
	$("div.dataTables_length").after(add_model_link_html);
	$("#add_model_link").remove();
	
	$('input').keyup(function(e){
	  if(e.which==40)
	   $(this).closest('tr').next().find('td:eq('+$(this).closest('td').index()+')').find('input').focus();
	  else if(e.which==38)
	   $(this).closest('tr').prev().find('td:eq('+$(this).closest('td').index()+')').find('input').focus();
	});
	
});
// Profile page start
if(CI.controller_name == 'profile' || CI.controller_name == 'list_user')
{

	function changepic(){
		$("#uploadpic").trigger('click');		
	}
	function previewUploadImg(input) {
		
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function (e) {
				
				$('#previewimg')
					.attr('src', e.target.result)
					.width(198)
					.height(197);
				uploadpicture();
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	function uploadpicture(){
		$("#uploadpic_form").ajaxForm(
		{
			success: function(data){
				if(data != ''){
					
				}
			},
			beforeSubmit: function(arr, $form, options) {
				 
			}
		}).submit();
	}
}
// Profile page end

//list_school START
if(CI.controller_name == 'list_school')
{
	$('.grid .clickable').on('click', function () {
          var el = jQuery(this).parents(".grid").children(".grid-body");
		  el.slideToggle(200);
    });
	/*$(function() {
		//$( "#accordion" ).accordion();
		$("#accordion").accordion({			
            active: -1,
            change: function (event, ui) {
                var activeIndex = $("#accordion").accordion("option", "active");
				//$("#accordian").val(activeIndex);
                //alert(activeIndex);
            },
			collapsible: true
        });
		
	});
	var cal = Calendar.setup({
	  onSelect: function(cal) { cal.hide() }
	});*/
}
// list_school END
//list_enable_week START
if(CI.controller_name == 'list_enable_week')
{
	$(function() {
		//$( "#accordion" ).accordion();
		/*$("#accordion").accordion({			
			active: -1,
			change: function (event, ui) {
				var activeIndex = $("#accordion").accordion("option", "active");
			},
			collapsible: true
		});*/
		
	});
	$(function() {
		$('#am').timepicker({
			showLeadingZero: true,
			onHourShow: OnHourShowCallbackAM
		});
		$('#pm').timepicker({
			
			showLeadingZero: true,
			onHourShow: OnHourShowCallbackPM
		});
		$('#am_start').timepicker({
			
			showLeadingZero: true,
			onHourShow: OnHourShowCallbackAM
		});
		$('#pm_start').timepicker({
			
			showLeadingZero: true,
			onHourShow: OnHourShowCallbackPM
		});
		$('#activation_time').timepicker({
			
			showLeadingZero: true,
			onHourShow: OnHourShowCallbackAM
		});
	});
	function OnHourShowCallbackAM(hour) {
		if ((hour > 20)) {
			return false; // not valid
		}
		return true; // valid
	}
	function OnHourShowCallbackPM(hour) {
		if ((hour <= 11)) {
			return false; // not valid
		}
		return true; // valid
	}
	
	function enabledatepick(id){
		
		if(document.getElementById("weekid"+id).checked == true){
			$("#reg_last_date"+id).removeAttr('disabled');
			$("#reg_last_date"+id).attr('readonly','readonly');
			$("#reg_time"+id).removeAttr('disabled');
			$("#reg_time"+id).attr('readonly','readonly');		
		}else{
			$("#reg_last_date"+id).removeAttr('readonly');
			$("#reg_last_date"+id).attr('disabled','disabled');
			$("#reg_time"+id).removeAttr('readonly');
			$("#reg_time"+id).attr('disabled','disabled');
			$("#errortime"+id).hide();
			$("#errordate"+id).hide();
		}
	}

}
//list_enable_week END

// List school campus js start

// List school campus js end

//list_student START
if(CI.controller_name == 'list_student')
{
	
}
//list_student END

//list_teacher START
if(CI.controller_name == 'list_teacher')
{
	$('#teacher_email_export').click(function(){
		var campus = $('form#export_file').find('select#campus').val();
		$('#myModal').modal({
		  remote: CI.base_url+'list_teacher/email_export/'+campus
		});
	});
}
//list_teacher END

//list_active_staff START
if(CI.controller_name == 'list_active_staff')
{
	$('#list_active_staff_email_export').click(function(){
		var campus = $('form#export_file').find('select#campus').val();
		$('#myModal').modal({
		  remote: CI.base_url+'list_active_staff/email_export/'+campus
		});
	});
}
//list_active_staff END

//line_managers_list START
if(CI.controller_name == 'line_managers_list')
{
	$('#line_managers_list_email_export').click(function(){
		$('#myModal').modal({
		  remote: CI.base_url+'line_managers_list/email_export/'
		});
	});
}
//line_managers_list END

//list_section START
if(CI.controller_name == 'list_section')
{
	
}
//list_section END

if(CI.controller_name == 'list_section')
{
	
}

if(CI.controller_name == 'list_course_class')
{
	$('#export_file').submit( function() {
		var sData = $('input:text').val();
		 $("#search_section").val(sData);
		 $("#search_section").val(sData);
		 $("#export_file").submit();
		 return false;
	});
	
	function getCampusBasedData(campus_id){
		$.ajax({
			type:'post',
				url: CI.base_url+'list_course_class/get_listbox/section/'+campus_id,
				data: "campus_id="+campus_id,
				success: function(data) {
					//alert(data);
					//var obj = $.parseJSON(data);
					$('select#reg_section_id').html('');
					$('select#reg_section_id').html(data);
				}
		});
		
		$.ajax({
			type:'post',
				url: CI.base_url+'list_course_class/get_listbox/class_room/'+campus_id,
				data: "campus_id="+campus_id,
				success: function(data) {
					//alert(data);
					//var obj = $.parseJSON(data);
					$('select#reg_class_room_id').html('');
					$('select#reg_class_room_id').html(data);
				}
		});
		
		$.ajax({
			type:'post',
				url: CI.base_url+'list_course_class/get_listbox/primary_teacher/'+campus_id,
				data: "campus_id="+campus_id,
				success: function(data) {
					//alert(data);
					//var obj = $.parseJSON(data);
					$('select#reg_primary_teacher_id').html('');
					$('select#reg_primary_teacher_id').html(data);
				}
		});
		
		$.ajax({
			type:'post',
				url: CI.base_url+'list_course_class/get_listbox/secondary_teacher/'+campus_id,
				data: "campus_id="+campus_id,
				success: function(data) {
					//alert(data);
					//var obj = $.parseJSON(data);
					$('select#reg_secondary_teacher_id').html('');
					$('select#reg_secondary_teacher_id').html(data);
				}
		});
	}

}

$('#accordion input[type=submit],#accordion input[type=checkbox]').click(function (event) {
	event.stopPropagation();
});

if(CI.controller_name == 'attendance')
{
	function getSubmitWeekNo(val){
		$("#submitweekno").val(val);
	}
		
	function stop_keypress_numaric_att(evt)
	{
		 evt = (evt) ? evt : ((window.event) ? event : null);
			if (evt) {
			   var elem = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
			   if (elem) {
				   var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
				   if (evt.which == 13)
				   {
					  return false;
				   }
					
					if ((charCode < 32 ) || (charCode == 46 ) ||  (charCode > 47 && charCode < 58)) {
					   return true;
				   } else {
					  alert("Please enter number only, no special characters allowed!");
					   return false;
				   }
			   }
			}
			
			return false;
	}
	
}

if(CI.controller_name == 'get_pdf')
{
	$(function() {
		$( "#day1" ).datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: 'c-50:c+0'
		});
		$( "#day2" ).datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: 'c-50:c+0'
		});
		$( "#day3" ).datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: 'c-50:c+0'
		});
		$( "#day4" ).datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: 'c-50:c+0'
		});
		$( "#day5" ).datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: 'c-50:c+0'
		});
		$( "#day6" ).datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: 'c-50:c+0'
		});
	});
	function gen_pdf(id,name) {
		document.form_main.target="_blank";
		document.form_main.action=CI.base_url+"get_pdf/createpdf/index/"+id+'/'+name;
		document.form_main.submit();
	}
	
	$(document).ready(function() {
	  $('#exporttype').change(function() {
		 if($('#exporttype').val() == "black")
		 {
		 	$('#d1').hide();
			$('#d2').hide();
			$('#d3').hide();
			$('#d4').hide();
			$('#d5').hide();
		 }
		 else{
		 	$('#d1').show();
			$('#d2').show();
			$('#d3').show();
			$('#d4').show();
			$('#d5').show();
		 }
	  });
	});
	
	function getSection(campus_id){
		$.ajax({
			type:'post',
  			url: CI.base_url+'get_pdf/get_campus_section/'+campus_id,
			data: "campus_id="+campus_id,
  			success: function(data) {
				if(campus_id == 0){
					$('div.pdf_box').show();
				} else {
					$('div.pdf_box').hide();
					$('div#'+campus_id+'').show();
				}
  			}
		});
		getCourse(campus_id);
	}

	function getCourse(campus_id){
		$.ajax({
			type:'post',

  			url: CI.base_url+'get_pdf/get_campus_course/'+campus_id,
			data: "campus_id="+campus_id,
  			success: function(data) {
				if(campus_id > 0){
					$('#course_box').show();
					$('#course_box select#multi').html(data);
				} else {
					$('#course_box').hide();
				}
  			}
		});
	}
}

if(CI.controller_name == 'view_attendance_weekly_report')
{
	function getWeek(id){
		$.ajax({
			type:'post',
  			url: CI.base_url+'view_attendance_weekly_report/getweek',
			data: "id="+id,
  			success: function(data) {
    			$('#tdweek').html(data);
  			}
		});
	}

	function export_excel(){
		var school_year_id = $("#reg_school_year_id").val();
		var week = $("#week").val();
		var campus_id = $("#reg_campus_id").val();
		window.location.href = CI.base_url+'view_attendance_weekly_report/export_to_excel/'+school_year_id+'/'+week+'/'+campus_id;
	}
	
	function generate_report()
	{
		window.location.href = CI.base_url+'view_attendance_weekly_report/generatereport';
	}

}

if(CI.controller_name == 'grade_report')
{
	function stop_keypress_numaric(evt)
	{
		 evt = (evt) ? evt : ((window.event) ? event : null);
			if (evt) {
			   var elem = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
			   if (elem) {
				   var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
				    if ((charCode < 32 ) || (charCode == 190 ) ||  (charCode > 47 && charCode < 58)) {
					   return true;
				   } else {
					  alert("Please enter number only, no special characters allowed!");
					   return false;
				   }
			   }
			}
	}
	
}

if(CI.controller_name == 'verify_grade')
{
	 
	function stop_keypress_numeric(evt)
	{
		 evt = (evt) ? evt : ((window.event) ? event : null);
			if (evt) {
			   var elem = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
			   if (elem) {
				   var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
					 if ((charCode < 32 ) || (charCode == 46 ) || (charCode == 190 ) ||  (charCode > 47 && charCode < 58)) {
					   return true;
				   } else {
					  alert("Please enter number only, no special characters allowed!");
					   return false;
				   }
			   }
			}
	}
	
}

if(CI.controller_name == 'list_grade_type')
{
	
}

if(CI.controller_name == 'list_grade_type_exam')
{
	
}

if(CI.controller_name == 'list_role')
{
	
}


if(CI.controller_name == 'list_user')
{	
	$('#add_reference_div').click(function(){
		addReferenceBox();
	});
}

if(CI.controller_name == 'add_privilege')
{
	$(function() {
		$("#add_privilege_form").validate({
			submitHandler: function(form) {
				form.submit();
			},
			rules: {
				user_roll_id: {
					comboboxNotNone: true
				}
			}
		});
	});	
	
	function checked_action(role_id){
		$.ajax({
			type:'post',
  			url: CI.base_url+'add_privilege/get_existing_privilege',
			data: "role_id="+role_id,
  			success: function(data) {
  	  			var obj = $.parseJSON(data);
  	  			//alert(obj.length);return false;
  	  			if(obj.length > 1){
  	  				var frmobj = document.add_privilege_form;
					for(var i=0; i < frmobj['action[]'].length; i++)
				    {
  	  	  				for(var j=0;j<obj.length;j++){
  	  	  	  				if(frmobj['action[]'][i].value == obj[j]){
  	  	  						//alert(obj[j]);
  	  	  						frmobj['action[]'][i].checked = true;
  	  	  						$("#unchk_"+obj[j]).hide();
  	  	  	    				$("#chk_"+obj[j]).show();
  	  	  	  				}
  	  	  	  			}
				    }
  	  	  		}else{
					var frmobj = document.add_privilege_form;
					for(var i=0; i < frmobj['action[]'].length; i++)
				    {
				        frmobj['action[]'][i].checked = false;
				        $("#unchk_"+frmobj['action[]'][i].value).show();
	  	    			$("#chk_"+frmobj['action[]'][i].value).hide();
				    } 
  	  	  	  	}
    			
  			}
		});
	}
}

function checked_unchecked(val,id){
		
		if(val == 0){
			
			var mySplitResult = id.split("_");
			var checkbox = document.getElementById("chkbox_"+mySplitResult[0]+"_3");
			var checkbox_viewown = document.getElementById("chkbox_"+mySplitResult[0]+"_7");
			var checkbox_viewdept = document.getElementById("chkbox_"+mySplitResult[0]+"_12");
			
			if(checkbox_viewown)
			{
				if((checkbox && mySplitResult[0]+"_3" != id) && (checkbox_viewown && mySplitResult[0]+"_7" != id) && (checkbox_viewdept && mySplitResult[0]+"_12" != id)){
					if(checkbox.checked == false && checkbox_viewown.checked == false && checkbox_viewdept.checked == false){
						alert("You should give view right.");
					}else{
						$("#unchk_"+id).hide();
						$("#chk_"+id).show();
						document.getElementById("chkbox_"+id).checked = true;
					}
				}else{
					$("#unchk_"+id).hide();
					$("#chk_"+id).show();
					document.getElementById("chkbox_"+id).checked = true;
				}
			}
			else if(checkbox_viewdept)
			{
				if((checkbox && mySplitResult[0]+"_3" != id) && (checkbox_viewown && mySplitResult[0]+"_7" != id) && (checkbox_viewdept && mySplitResult[0]+"_12" != id)){
					if(checkbox.checked == false && checkbox_viewown.checked == false && checkbox_viewdept.checked == false){
						alert("You should give view right.");
					}else{
						$("#unchk_"+id).hide();
						$("#chk_"+id).show();
						document.getElementById("chkbox_"+id).checked = true;
					}
				}else{
					$("#unchk_"+id).hide();
					$("#chk_"+id).show();
					document.getElementById("chkbox_"+id).checked = true;
				}
			}
			else
			{
				if(checkbox && mySplitResult[0]+"_3" != id){
					if(checkbox.checked == false){
						alert("You should give view right.");
					}else{
						$("#unchk_"+id).hide();
						$("#chk_"+id).show();
						document.getElementById("chkbox_"+id).checked = true;
					}
				}else{
					$("#unchk_"+id).hide();
					$("#chk_"+id).show();
					document.getElementById("chkbox_"+id).checked = true;
				}
			}	
		}
		if(val == 1){
			$("#unchk_"+id).show();
			$("#chk_"+id).hide();
			document.getElementById("chkbox_"+id).checked = false;
		}
	}

if(CI.controller_name == 'list_bug')
{
	function submitpost(system_bug_id){
		var formdata = $("#frmcomment").serialize();
		 $.ajax({
			    type: "POST",
			    url: CI.base_url+"list_bug/ajaxpostcomment",
			    data: formdata+"&id="+system_bug_id,
			    success: function(data) {
				    
				    var obj = jQuery.parseJSON(data);
				    
				    if(data){
					    $("#post-content").append(obj[0]);
					    $("#cntcomm").html('Comments ('+obj[1]+')');
					    $("#comment").val('');
				    }  	
			    }
		    });	
	}	

}



$(document).ready(function(){
	
	//$('#popover1').popover({ trigger: "hover focus" });
	$('#popover').live('mouseenter', function() {
		$(this).popover({ trigger: "hover focus",html:true });
		$(this).popover('show');
	});
	/*$('#popover1').live('mouseleave', function() {
		$(this).popover("hide");
	});*/
		
	//$('#status').select2('readonly', true);
	
	$('.comment').hide();
	$('.button-save').hide();
	$('.button-cancle').hide();
	
	//attach click event to buttons
	$('.button-show').click(function(){
		
		/**
		 * when show button is clicked we call the show plugin
		 * which scales the box to default size
		 * You can try other effects from here: http://jqueryui.com/effect/
		 */
		$("#box").show("scale", 500); 

	});

	$('.button-change-status').click(function(){
		//$("#status").removeAttr("disabled");
		$('#status').select2('readonly', false);
	});
	
	$('#status').change(function(){
		if($(this).val() != $("#orig_status").val())
		{
			$('.button-change-status').hide("scale", 300);
			$('.comment').show("scale", 350);
			$('#iderror').show("scale", 355);
			$('.button-save').show("scale", 360);
			$('.button-cancle').show("scale", 370);
		}
	});
	
	$('.button-cancle').click(function(){
		$('.comment').hide("scale", 200);
		$('#iderror').html("");
		$('#iderror').hide("scale", 200);
		$('.button-save').hide("scale", 210);
		$('.button-cancle').hide("scale", 220);
		$('.button-change-status').show("scale",250);
		
		//$('#status').val($("#orig_status").val());
		$("#status").select2().select2("val", $("#orig_status").val());
		//$("#status").attr("disabled", "true");
		$('#status').select2('readonly', true);
	});
	
	/*$('.button-save').click(function(){
		if($('.comment').val() == "")
		{
			alert("Please Enter Reason To Update Status");
			return false;
		}
		else
		{
			
		}
	});*/
	
	if(CI.controller_name == 'add_employee')
	{
		$('#add_reference_div').click(function(){
			addReferenceBox();
		});
		
		$('#add_experience_div').click(function(){
			addExperienceBox();
		});
		
		$('#add_certificate_div').click(function(){
			addCertificateBox();
		});
		
		$('#add_qualification_div').click(function(){
			addQualificationBox();
		});
		
		if(add_default_box){
			addReferenceBox();
			addExperienceBox();
			addCertificateBox();
			addQualificationBox();
		}
	}

	$('#complaint_filters ul.dropdown-menu li a').click(function(){
		var parent_li = $(this).parents('li');
		var parent_ul = $(this).parents('ul');
		parent_ul.find('li').removeClass('active');
		parent_li.addClass('active');
		$('form#complaint_filters').find('#'+parent_li.attr('data-dimension')).val(parent_li.attr('data-filter'));

		$('form#complaint_filters').submit();


	});
	var s_c_complaint_type = $('form#complaint_filters #complaint_type').val();
	var s_c_validity = $('form#complaint_filters #validity').val();
	var s_c_status = $('form#complaint_filters #status').val();
	var s_c_priority = $('form#complaint_filters #priority').val();
	$('#complaint_filters ul.dropdown-menu li').each(function(){
		if($(this).attr('data-filter') == s_c_complaint_type && $(this).attr('data-dimension') == 'complaint_type'){
			$(this).addClass('active');
		}
		if($(this).attr('data-filter') == s_c_validity && $(this).attr('data-dimension') == 'validity'){
			$(this).addClass('active');
		}
		if($(this).attr('data-filter') == s_c_status && $(this).attr('data-dimension') == 'status'){
			$(this).addClass('active');
		}
		if($(this).attr('data-filter') == s_c_priority && $(this).attr('data-dimension') == 'priority'){
			$(this).addClass('active');
		}
	});
	
	$('.head_top_search_box').on('focus',function(){
		$('#head_top_search_options').show();
	});
	
	
	$('#user-add-options').on('click',function(){
		$('#head_top_search_options').hide();
	});
	
	$(document).on('click', function (e) {
	    if ($(e.target).closest("li#head_top_search_holder").length === 0) {
	    	$("#head_top_search_options").hide();
	    }
	});

	$('#staff_gallery_filter input[name="photo"]:radio').change(
	    function(){
	        //alert($(this).val());   
	        /*var show_gal = $(this).val();
	        $('#staff_gallery_wrapper ul').hide();
	        $('#staff_gallery_wrapper ul.staff_gallery_'+show_gal).show();*/
	        var campus_id = $('#staff_gallery_filter select#campus_id').val();
	        var photo = $(this).val();
	        var offset = $('#staff_gallery_main #offset').val();
	        $.ajax({
				type: "POST",
				url: CI.base_url+"staff_gallery/index/ajax/"+offset,
				data: { campus_id: campus_id,photo: photo},
				success: function(data) {
					var staff_gallery_main = $(data).find('#staff_gallery_main').html();
					//alert(pp);
					$('.page-content .content #staff_gallery_main').html(staff_gallery_main);
				}
			});
	    }
	);

	$('#staff_gallery_filter select#campus_id').change(
	    function(){
	        
	        var campus_id = $(this).val();
	        var photo = $('#staff_gallery_filter input[name="photo"]:radio:checked').val();
	        $.ajax({
				type: "POST",
				url: CI.base_url+"staff_gallery/index/ajax",
				data: { campus_id: campus_id,photo: photo},
				success: function(data) {
					var staff_gallery_main = $(data).find('#staff_gallery_main').html();
					//alert(pp);
					$('.page-content .content #staff_gallery_main').html(staff_gallery_main);
				}
			});
	    }
	);

	$('#teacher_comment_main #add_teacher_comment').click(function(){
		$('#teacher_comment_main #current_teacher_comment').hide();
		$('#teacher_comment_main #current_teacher_comment_edit').show();
	});

	$('#line_manager_comment_main #add_line_manager_comment').click(function(){
		$('#line_manager_comment_main #current_line_manager_comment').hide();
		$('#line_manager_comment_main #current_line_manager_comment_edit').show();
	});

	$('#line_manager_targets_main #add_line_manager_targets').click(function(){
		$('#line_manager_targets_main #current_line_manager_targets').hide();
		$('#line_manager_targets_main #current_line_manager_targets_edit').show();
	});
});

function change_worked_at_ksu_before() {
	var worked_at_ksu_before = $('select#worked_at_ksu_before').val();
	if(worked_at_ksu_before == 'Yes'){
		$('div#worked_at_ksu_start_date').slideDown();
		$('div#worked_at_ksu_end_date').slideDown();
	}else {
		$('div#worked_at_ksu_start_date').slideUp();
		$('div#worked_at_ksu_end_date').slideUp();
	}
}

function addReferenceBox(){
	$('#references').append($('#reference_main_sample').html());
}
function addExperienceBox(){
	$('#experiences').append($('#experience_main_sample').html());
	$('#experiences #show_dp').each(function() {
		$(this).datepicker({format: 'D dd MM yyyy'});
	});
}
function addCertificateBox(){
	$('#certificates').append($('#certificate_main_sample').html());
	$('#certificates #show_dp').each(function() {
		$(this).datepicker({format: 'D dd MM yyyy'});
	});
	$('#certificates #date_year').each(function() {
		$(this).datepicker( {
			format: " yyyy",
			viewMode: "years", 
			minViewMode: "years"
		});
	});	
	$('#certificates .select2-container').each(function() {
		$(this).remove();
	});
	$('#certificates select').each(function() {
		$(this).select2();
	});
}
function addQualificationBox(){
	$('#qualifications').append($('#qualification_main_sample').html());
	$('#qualifications #show_dp').each(function() {
		$(this).datepicker({format: 'D dd MM yyyy'});
	});
	$('#qualifications #date_year').each(function() {
		$(this).datepicker( {
			format: " yyyy",
			viewMode: "years", 
			minViewMode: "years"
		});
	});	
	$('#qualifications .select2-container').each(function() {
		$(this).remove();
	});
	$('#qualifications select').each(function() {
		$(this).select2();
	});
}
function deleteMulBox(val)
{
	var this_item = $(val).parent();
	$(this_item).parent().parent().remove();
}
function dt_delete(table,where_col,where_col_id){
	if(confirm('Are you sure you want to delete this record?')) {
		$.ajax({
			type: "POST",
			url: CI.base_url+"general/delete",
			data: { table: table, where_col: where_col,where_col_id:where_col_id},
			success: function(data) {
				parent.reload_datatable();
				if(data == 1) {
					showSuccessMsg('Record sucessfully deleted.');
				}else {
					showErrorMsg('Ops! Something went wrong');
				}
			}
		});
	}
	return false;
}
function _delete(table,where_col,where_col_id){
	if(confirm('Are you sure you want to delete this record?')) {
		$.ajax({
			type: "POST",
			url: CI.base_url+"general/delete",
			data: { table: table, where_col: where_col,where_col_id:where_col_id},
			success: function(data) {
				location.reload();
			}
		});
	}
	return false;
}
function dt_login(id){
	$.ajax({
		type: "POST",
		url: CI.base_url+"list_active_staff/do_login/"+id,
		data: { },
		success: function(data) {
			if(data == 1) {
				//alert('gdds');
				window.location.href = CI.base_url;
			}else {
				showErrorMsg('Ops! Something went wrong');
			}
		}
	});
	return false;
}
function showSuccessMsg(msg){
	Messenger().post({
		message: msg,
		showCloseButton: true
	});
}
function showErrorMsg(msg){
	Messenger().post({
		message: msg,
		type: 'error',
		showCloseButton: true
	});
}
function showHideDatatableProcessing(showhide)
{
	if(showhide == true){
		$(".dataTable tbody").html('<div style="text-align: center;width: auto;position: absolute;margin-left: 500px;"><i style="display:inline-block;" class="fa fa-spinner fa fa-6x fa-spin" id="animate-icon"></i></div>');
		$(".dataTables_processing").html('');
	}
}
function add_complaint_comment(complaint_id){
	$('#add_complaint_comment_'+complaint_id+' textarea[name=comment]').removeClass('error');
	if($('#add_complaint_comment_'+complaint_id+' textarea[name=comment]').val() == ''){
		$('#add_complaint_comment_'+complaint_id+' textarea[name=comment]').addClass('error');
		return false;
	}
	$.ajax({
		type: "POST",
		url: CI.base_url+"complaint/add_comment",
		data: $('#add_complaint_comment_'+complaint_id).serialize(),
		success: function(data) {
			if (data != '') {
			var display_comment = $('#add_complaint_comment_'+complaint_id).parents('#add_complaint_comment_main').find('.user-profile-pic-wrapper').html();
			
			//var complaint_id = $("#add_complaint_comment input[name=complaint_id]").val();
			
			$('div#complaint_comments_'+complaint_id).append('<div class="post col-md-12"><div class="user-profile-pic-wrapper">'+display_comment+'</div><div class="info-wrapper"></div><div class="clearfix"></div></div>');
			$('div#complaint_comments_'+complaint_id+' .post').last().find('div.info-wrapper').html(data);
			};
		}
	});
	//$('#add_complaint_comment_'+complaint_id+' textarea[name=comment]').val('');
	$('#add_complaint_comment_'+complaint_id+'')[0].reset();
	return false;
}
function getGradetypeComponent(grade_type_id,comptype){
	$.ajax({
		type:'post',
		url: CI.base_url+'complaint/get_grade_type_component/'+grade_type_id+'/'+comptype,
		data: [],
			success: function(data) {
				$('#add_complaint_form_datatable #component').html(data);
				$('#add_complaint_form_datatable #component').select2();	
			}
	});
}

/********  LOGIN LOGOUT PAGE ********************/
$(function(){

	if($('#loginpg').attr('data-page') == 'login' || $('#loginpg').attr('data-page') == 'signup' || $('#loginpg').attr('data-page') == 'password'){
		
		/*  For icon rotation on input box foxus  */ 	
		$('.input-field').focus(function() {
				$('.page-icon img').addClass('rotate-icon');
		});

		/*  For icon rotation on input box blur  */ 	
		$('.input-field').blur(function() {
				$('.page-icon img').removeClass('rotate-icon');
		});
	};
});

function getSubmitGradeVerify(verify_type,examid){
	$("input:hidden[name=verify_type]").val(verify_type);
	$("input:hidden[name=examid]").val(examid);
}

$("#submitGlobalSearch").click(function() {
	var globalsearchkwd = $('#globalsearchkwd').val();
	var globalsearch_option = $("input[name=search_option]:checked").val();
	var globalsearchsubmimtted = $("#globalsearchsubmimtted").val('1');
	
	document.form_globalsearch.action=CI.base_url+globalsearch_option;
	document.form_globalsearch.submit();
});

$("input:radio[name=search_option]").click(function() {
    //$('#globalsearchkwd').val('');
});

function stop_keypress_enter_sbt(evt)
{
	evt = (evt) ? evt : ((window.event) ? event : null);
		if (evt) {
		   var elem = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
		   if (elem) {
			   var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
			   if (evt.which == 13)
			   {
					$("#submitGlobalSearch").trigger("click");
			   }
				
				if ((charCode < 32 ) || (charCode == 46 ) ||  (charCode > 47 && charCode < 58)) {
				   return true;
			   }
		   }
		}
}

function PrintDiv(d_id) { 
	$('div.header').hide();
	$('div.page-sidebar').hide();
	$('div.footer-widget').hide();
	$('div#p_info45').hide();
	$('div.editprofile-pg .tabbable.tabs-left .nav-tabs').hide();
	$('div.editprofile-pg .tabbable.tabs-left .tab-content #tab2mypma h3.userinfo-ttl').hide();
	$('.page-content .content').css('padding','0px');
	window.print();

	$('div.header').show();
	$('div.page-sidebar').show();
	$('div.footer-widget').show();
	$('div#p_info45').show();
	$('div.editprofile-pg .tabbable.tabs-left .nav-tabs').show();
	$('div.editprofile-pg .tabbable.tabs-left .tab-content #tab2mypma h3.userinfo-ttl').show();
	$('.page-content .content').removeAttr('style');
}