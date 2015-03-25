var TableAjax = function () {
    var grid;
    var ajax_dt;
    var handleRecords = function () {
        grid = new Datatable();
        grid.init({
            src: $("#grid_profile_changes_log"),            
            dataTable: {
                "ajax": {
                    "url": CI.base_url+"refugee_register/get_profile_changes_log_json/"+refugee_id,// ajax source
                },
				"oColVis": {
					"aiExclude": 3
				},
				"columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
					'orderable': false,
					'targets': 3
				}]
                /*"order": [
                    [1, "asc"]
                ]*/// set first column as a default sort by asc
            }
        });
        ajax_dt = grid.reloadDatatable();
    }

    return {
        //main function to initiate the module
        init: function () {
            handleRecords();
            //reloadDatatable();
        },
        reload_dt: function () {
            ajax_dt.ajax.reload();
        }
    };

}();

jQuery(document).ready(function() {
	TableAjax.init();
});