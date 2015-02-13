$(document).ready( function () {
	$('#grid_list_all_user').bind('processing',function(e, oSettings, bShow){showHideDatatableProcessing(bShow)});
	dTable = $('#grid_list_all_user').dataTable({
		bJQueryUI:false,
		bProcessing:true,
		bServerSide: true,
		"oSearch": {"sSearch": globalsearchkwd},
		sAjaxSource: "list_all_user/index_json",
		"sDom": 'fCl<"clear">rt<"row"<"col-md-12"p i>>',
		"oColVis": {
			"aiExclude": [table_total_col-1]
        },
        "aoColumnDefs": [{
				"bVisible": false,
				'aTargets': edit_flag?[0,4,6,9,10,11,12,13,14]:[0,4,6,9,10,11,12,13,14]
			}
		],
		aoColumns: [
						null ,
						{"sName": "elsd_id"},
		            	{"sName": "staff_name"},
		            	{"sName": "email"},
		            	{"sName": "personal_email"},
		            	{"sName": "cell_phone"},
		            	{"sName": "contractor"},
						{"sName": "status"},
						{"sName": "user_roll_name"},
						{"sName": "department_name"},
						{"sName": "campus_name"},
						{"sName": "scanner_id"},
						{"sName": "returning"},
						{"sName": "created_date"},
						{"sName": "updated_date"},
		            	{"sName": "ID",
       						"bSearchable": false,
       						"bSortable": false,
       						"fnRender": function (oObj) {
								var actionstr = "";
								actionstr += '<div class="btn-group">';
								actionstr += '<button class="btn btn-mini dropdown-toggle btn-demo-space" data-toggle="dropdown">';
								actionstr += '<a class="fa fa-gear"></a>';
								actionstr += '</button>';
								actionstr += '<ul class="dropdown-menu">';
								actionstr += '<li><a href="list_user/add/'+oObj.aData[parseInt(0)]+'" data-target="#myModal" data-toggle="modal" class="modal-link">Edit</a></li>';
								if(edit_profile_flag == 1)
									actionstr += '<li><a href="list_user/edit_profile/'+oObj.aData[parseInt(table_total_col-1)]+'">View Profile</a></li>';
								//actionstr += '<li><a href="add_privilege/add_single_user_privilege/index/'+oObj.aData[parseInt(table_total_col-1)]+'">Rights</a></li>';
								actionstr += '<li class="divider"></li>';
								actionstr += '<li><a href="#" onclick=dt_delete("users","user_id",'+oObj.aData[parseInt(0)]+'); class="text-error bold">Delete Profile <i class="fa fa-times-circle"></i></a></li>';
								actionstr += '</ul>';
								actionstr += '</div>';
								
								return actionstr;
							}
						}
		            	
		           ],
		sPaginationType: "bootstrap"});
		dTable.fnSort([[2,'asc']]);	
		$('#grid_list_all_user_wrapper .dataTables_filter input').addClass("input-medium ");
		$('#grid_list_all_user_wrapper .dataTables_length select').addClass("select2-wrapper span12"); 
		dTable.columnFilter({
	        aoColumns: [    
	                 null,
					 { type: "text" },
					 { type: "text" },
	        		 { type: "text" },
	                 { type: "text" },
	                 null,
	                 { type: "text" },
	                 null,
	                 { type: "text" },
					 { type: "text" },
	                 { type: "text" },
	                 null,
					 null,
	                 null,
	                 null,
	                 null
	            ],
				bUseColVis: true
        });	
	if(edit_flag == 1)
	{
		dTable.makeEditable({
			sUpdateURL: function(value, settings)
			{
     			return(value); //Simulation of server-side response using a callback function
			},
			sUpdateURL: "list_user/update_user",
            sAddURL: 	"list_user/add_student",
            aoColumns: [
                        	null,
                        	null,
                        	null,
                        	null,
                        	null,
							null,
                        	null,
                        	null,
                        	null,
                        	null,
							null,
                        	null,
                        	null,
                        	null,
                        	null,
                        	null
                       ],
			fnShowError:function(message, action){
				switch (action) {
	                case "update":
	                	if(message != "success")
	                		jAlert(message, "Update failed");
	                	break;
	                case "add":
	                    $("#lblAddError").html(message);
	                    $("#lblAddError").show();
	                    break;
				}
			}, 
			fnStartProcessingMode: function () {
	               $("#processing_message").dialog();
	           },
	           fnEndProcessingMode: function () {
	               $("#processing_message").dialog("close");
	           },
				oAddNewRowButtonOptions: {	
								label: "Add...",
								icons: {primary:'ui-icon-plus'} 
						 }							

		});
	}
	
	
});
function fnShowHide( iCol )
{
	if($("#Col-"+iCol).is(':checked'))
		$("#Col-"+iCol).attr("checked", "checked");
	else
		$("#Col-"+iCol).removeAttr("checked");	
		
	/* Get the DataTables object again - this is not a recreation, just a get of the object */
	var dTable = $('#grid_list_all_user').dataTable();
	
	var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
	dTable.fnSetColumnVis( iCol, bVis ? false : true );
}