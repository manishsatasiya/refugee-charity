var TableAjax = function () {
    var grid;
    var ajax_dt;
    var handleRecords = function () {
        grid = new Datatable();
        grid.init({
            src: $("#grid_location_association"),            
            dataTable: {
                "ajax": {
                    "url": "refugee_settings/index_json", // ajax source
                },
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