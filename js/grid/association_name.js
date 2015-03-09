var TableAjax2 = function () {
    var grid2;
    var ajax_dt2;
    var handleRecords = function () {
        grid2 = new Datatable();
        grid2.init({
            src: $("#grid_association_name"),            
            dataTable: {
                "ajax": {
                    "url": "refugee_settings/association_name_json", // ajax source
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
        ajax_dt2 = grid2.reloadDatatable();
    }

    return {
        //main function to initiate the module
        init: function () {
            handleRecords();
            //reloadDatatable();
        },
        reload_dt: function () {
            ajax_dt2.ajax.reload();
        }
    };

}();

jQuery(document).ready(function() {
	TableAjax2.init();
});