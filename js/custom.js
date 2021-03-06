var table_total_col = $('table.table thead tr').children().length;
var handleTagsInput = function () {
	if (!jQuery().tagsInput) {
		return;
	}
	$('#tags_1').tagsInput({
		width: 'auto',
		'onAddTag': function () {
			var tags = $(this).closest("#tags_1").val();
		},
	});
}
var handleBootstrapMaxlength = function() {
	$('.maxlength_textarea').maxlength({
		limitReachedClass: "label label-danger",
		alwaysShow: true
	});
}		
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
function reload_datatable2(){
	TableAjax2.reload_dt();
}
function reload_datatable3(){
	TableAjax3.reload_dt();
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
	$('#popover2').live('mouseenter', function() {
		$(this).popover({ trigger: "focus click",template: '<div class="popover profile_change_log_pop"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',html:true });
		//$(this).popover('show');
	});

	var add_model_link_html = $("#add_model_link").html();
	$("div.dataTables_length").after(add_model_link_html);
	$("#add_model_link").remove();
	
	$('input').keyup(function(e){
	  if(e.which==40)
	   $(this).closest('tr').next().find('td:eq('+$(this).closest('td').index()+')').find('input').focus();
	  else if(e.which==38)
	   $(this).closest('tr').prev().find('td:eq('+$(this).closest('td').index()+')').find('input').focus();
	});

	$('#file_title_main .title #file_title').live('click',function(e){
		$(this).closest('.title').siblings('.title_form').show();
		$(this).closest('.title').hide();
	});

	$('#file_title_main .title_form #save').live('click',function(e){
		$(this).closest('.title_form').find('#title').parent('div').removeClass('has-error');

		var file_title = $(this).closest('.title_form').find('#title').val();
		var file_id = $(this).closest('.title_form').find('#title').data('id');
		if (file_title == '') {
			$(this).closest('.title_form').find('#title').parent('div').addClass('has-error');
			return false;
		};
		$.ajax({
			type: "POST",
			url: CI.base_url+"general/field_update",
			data: { t: 'refugee_documents', wc: 'id',wci:file_id, fc: 'title', fcv: file_title},
			success: function(data) {
			}
		});

		$(this).closest('.title_form').siblings('.title').find('a').text(file_title);
		$(this).closest('.title_form').siblings('.title').show();
		$(this).closest('.title_form').hide();
	});
	
	$('#file_title_main .title_form #cancel').live('click',function(e){
		$(this).closest('.title_form').find('#title').parent('div').removeClass('has-error');
		$(this).closest('.title_form').siblings('.title').show();
		$(this).closest('.title_form').hide();
	});

	$('#refugee_sick_main #are_you_sick').live('change',function(e){
		var are_you_sick = $(this).val();
		if (are_you_sick == 1) {
			$(this).closest('#refugee_sick_main').find('#sick_reason_div').show();
		}else{
			$(this).closest('#refugee_sick_main').find('#sick_reason_div').hide();
		}
	});

	$('.add_refugee_qualifications').tooltip({title:'Add a Qualifications'});
	$('.add_refugee_family_members').tooltip({title:'Add a Family Member',placement:'left'});

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
					.width(150)
					.height(150);
				uploadpicture();
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	function uploadpicture(){
		$("#uploadpic_form").ajaxForm(
		{
			success: function(data){
				if(data == '1'){
					location.reload();
				}else{
					alert('Sorry, Something went wrong!');
					location.reload();
				}
			},
			beforeSubmit: function(arr, $form, options) {
				 
			}
		}).submit();
	}
}
// Profile page end

if(CI.controller_name == 'add_privilege')
{
	
	function checked_action(role_id){
		$.ajax({
			type:'post',
  			url: CI.base_url+'add_privilege/get_existing_privilege',
			data: "role_id="+role_id,
  			success: function(data) {
  	  			var obj = $.parseJSON(data);
  	  			if(obj.length > 0){
  	  				var frmobj = document.add_privilege_form;
					for(var i=0; i < frmobj['action[]'].length; i++)
				    {
  	  	  				for(var j=0;j<obj.length;j++){
  	  	  	  				if(frmobj['action[]'][i].value == obj[j]){
  	  	  						$("#chkbox_"+obj[j]).attr('checked', true);
  	  	  						$.uniform.update("#chkbox_"+obj[j]);
  	  	  						//frmobj['action[]'][j].checked = true;
  	  	  						//$("#unchk_"+obj[j]).hide();
  	  	  	    				//$("#chk_"+obj[j]).show();
  	  	  	    				//$("#chkbox_"+obj[j]).iCheck('update');
  	  	  	  				}
  	  	  	  			}
				    }
  	  	  		}else{
					var frmobj = document.add_privilege_form;
					for(var i=0; i < frmobj['action[]'].length; i++)
				    {  	  	  				
				        frmobj['action[]'][i].checked = false;
				        $.uniform.update(frmobj['action[]'][i]);
				        //$("#unchk_"+frmobj['action[]'][i].value).show();
	  	    			//$("#chk_"+frmobj['action[]'][i].value).hide();
	  	    			//$(frmobj['action[]'][i]).iCheck('update');
				    } 
  	  	  	  	}
    			
  			}
		});
	}
}

function checked_unchecked(id){	
	var checkbox = $("#chkbox_"+id);
	if(checkbox.prop('checked')) {
	    var mySplitResult = id.split("_");
	    var checkbox_view = document.getElementById("chkbox_"+mySplitResult[0]+"_3");
	    if(checkbox_view && mySplitResult[0]+"_3" != id){
			if(checkbox_view.checked == false){
				alert("You should give view right.");
				checkbox.prop('checked', false);
			}
		}
	} else {
		//alert('fff');
	    
	}
	return;
	/*if(val == 0){			
		var mySplitResult = id.split("_");
		var checkbox = document.getElementById("chkbox_"+mySplitResult[0]+"_3");
		alert(mySplitResult[0]);
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
	if(val == 1){
		$("#unchk_"+id).show();
		$("#chk_"+id).hide();
		document.getElementById("chkbox_"+id).checked = false;
	}*/
}

$(document).ready(function(){

	//$('#popover1').popover({ trigger: "hover focus" });
	$('#popover').live('mouseenter', function() {
		$(this).popover({ trigger: "hover focus",html:true });
		$(this).popover('show');
	});
	handleTagsInput();
	handleBootstrapMaxlength();
});

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
function table_delete(table,where_col,where_col_id){
	if(confirm('Are you sure you want to delete this record?')) {
		$.ajax({
			type: "POST",
			url: CI.base_url+"general/delete",
			data: { table: table, where_col: where_col,where_col_id:where_col_id},
			success: function(data) {
				$('.portlet .portlet-title a.reload[data-load="true"]').click();
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
	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "positionClass": "toast-top-right",
	  "onclick": null,
	  "showDuration": "1000",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}
	toastr.success(msg);
}
function showErrorMsg(msg){
	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "positionClass": "toast-top-full-width",
	  "onclick": null,
	  "showDuration": "1000",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}
	toastr.error(msg);
}
function showHideDatatableProcessing(showhide)
{
	if(showhide == true){
		$(".dataTable tbody").html('<div style="text-align: center;width: auto;position: absolute;margin-left: 500px;"><i style="display:inline-block;" class="fa fa-spinner fa fa-6x fa-spin" id="animate-icon"></i></div>');
		$(".dataTables_processing").html('');
	}
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

function add_refugee_discussion(refugee_id){
	$('#add_refugee_discussion textarea[name=comment]').removeClass('error');
	if($('#add_refugee_discussion textarea[name=comment]').val() == ''){
		$('#add_refugee_discussion textarea[name=comment]').addClass('error');
		return false;
	}
	$.ajax({
		type: "POST",
		url: CI.base_url+"refugee_register/add_discussion",
		data: $('#add_refugee_discussion').serialize(),
		success: function(data) {
			if (data != '') {
				var obj = jQuery.parseJSON(data);
				var display_user_img = $('#add_refugee_discussion').find('.todo-userpic').attr('src');
						
				$('div#refugee_discussion').append('<div class="media"><a class="pull-left" href="javascript:;"><img class="todo-userpic media-object" src="'+display_user_img+'" width="27px" height="27px"></a><div class="media-body" style="width: 10000px;"><h4 class="media-heading">'+obj['author_name']+' <span class="todo-comment-date">'+obj['created_at']+'</span></h4><p class="todo-text-color">'+obj['comment']+'<br></p></div></div><hr>');
			};
		}
	});
	//$('#add_refugee_discussion textarea[name=comment]').val('');
	$('#add_refugee_discussion')[0].reset();
	return false;
}

$(".tab_clicked").on('click', function(e){
	var timestamp_add = $("#timestamp").val();
	var tab_numb = $(this).attr('data-tab-numb');
	e.preventDefault();
	
	if(timestamp_add > 0 && tab_numb > 0)
	{
		var msg = "Please Submit Info(Tab) Data first. Before adding contacts, photos, documents or video ";
		showErrorMsg(msg);
		return false;
	}
});