var TableAjax3 = function () {
    var grid3;
    var ajax_dt3;
    var handleRecords = function () {
        grid3 = new Datatable();
        grid3.init({
            src: $("#grid_nationality"),            
            dataTable: {
                "ajax": {
                    "url": "refugee_settings/nationality_json", // ajax source
                },
				"oColVis": {
					"aiExclude": 2
				},
				"columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
					'orderable': false,
					'targets': 2
				}]
                /*"order": [
                    [1, "asc"]
                ]*/// set first column as a default sort by asc
            }
        });
        ajax_dt3 = grid3.reloadDatatable();
    }

    return {
        //main function to initiate the module
        init: function () {
            handleRecords();
            //reloadDatatable();
        },
        reload_dt: function () {
            ajax_dt3.ajax.reload();
        }
    };

}();

jQuery(document).ready(function() {
	TableAjax3.init();
});