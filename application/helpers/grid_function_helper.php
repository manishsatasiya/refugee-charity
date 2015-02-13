<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_search_data')) {
    /**
     *
     * get_grid_data: it's used to get list of teacher
     *
     * @param 
     * @return array
     *
     */
    function get_search_data($aColumns = array()) {
    	/*echo "<pre>";
        print_r($_POST);
        echo "</pre>";*/
    	/*
    	 * Paging
    	 */
    	$per_page =  10;
    	$offset = 0;
    	$global_search = 0;
		
    	if ( isset( $_POST['start'] ) && $_POST['length'] != '-1' )
    	{
    		$per_page =  $_POST['length'];
    		$offset = $_POST['start'];
    	}
    	
    	/*
    	 * Ordering
    	 */
    	$order_by = ""; 
    	$sort_order = "";
    	if ( isset( $_POST['order'] ) )
    	{    		
    		for ( $i=0 ; $i<count($_POST['order']) ; $i++ )
    		{
                $column = intval($_POST['order'][$i]['column']);
    			if ( isset($_POST['columns'][$column]['orderable']) && $_POST['columns'][$column]['orderable'] == "true" )
    			{
    				$order_by = isset($aColumns[$column]) ? $aColumns[$column] : '';
    				$sort_order = $_POST['order'][$i]['dir'];
    			}
    		}
    	}
    	
    	/*
    	 * Filtering
    	 * NOTE this does not match the built-in DataTables filtering which does it
    	 * word by word on any field. It's possible to do here, but concerned about efficiency
    	 * on very large tables, and MySQL's regex functionality is very limited
    	 */
    	$search_data = array();
    	if ( isset($_POST['search']) && is_array($_POST['search']) && count($_POST['search']) > 0)
    	{
			$global_search = 1;
    		for ( $i=0 ; $i<count($aColumns) ; $i++ )
    		{
                if ( isset($_POST['columns'][$i]['searchable']) && $_POST['columns'][$i]['searchable'] == "true" )
                {
    			    $search_data[$aColumns[$i]] = trim($_POST['search']['value']);
                }
    		}
    	}
    	
    	/* Individual column filtering */
    	for ( $i=0 ; $i<count($aColumns) ; $i++ )
    	{
            if ( isset($_POST['columns'][$i]['searchable']) && $_POST['columns'][$i]['searchable'] == "true" && trim($_POST['columns'][$i]['search']['value']) != '' )
            {
    			$search_data[$aColumns[$i]] = $_POST['columns'][$i]['search']['value'];
    		}
    	}
    	$data = array();
    	
    	$data['order_by'] = $order_by;
    	$data['sort_order'] = $sort_order;
    	$data['search_data'] = $search_data;
    	$data['search_data']['global_search'] = $global_search;
    	$data['per_page'] = $per_page;
    	$data['offset'] = $offset;

        /*echo "<pre>";
        print_r($data);
        echo "</pre>";*/
    	return $data;
    }
    
    function grid_update_data($whrid_column,$id,$columnName,$value,$table){
    	$ci =& get_instance();
    	$data = array();
    	if ($columnName == 'password'){
    		$nonce = md5(uniqid(mt_rand(), true));
    		$data = array(
    				'password' => hash_password($value, $nonce),
    				'nonce' => $nonce
    		);
    		
    	}
		else if($columnName == 'academic_status'){
		
			$query = "SELECT week_id FROM `enable_school_week` where last_date >= '".DATE('Y-m-d')."' order by last_date limit 1 ";
			$query_res = $ci->db->query($query);
			$arrWeek = $query_res->result_array();
			$week_id = 0;
			foreach($arrWeek AS $row)
				$week_id = $row["week_id"];
				
    		$data = array(
    				$columnName    => $value,'discontinue_date' => DATE('Y-m-d'),'discontinue_week_id'=>$week_id);
    	}
		else{
    		$data = array(
    				$columnName    => $value);
    	}
    	
    	$ci->db->where($whrid_column, $id);
    	$ci->db->update($table, $data);
		
		if ($columnName == 'academic_status' && $value == "Withdrawn")
			return "update_weekly_attendance";
		if($columnName != 'campus_id' && $columnName != 'campus')	
			echo "success";
    }
    
    function grid_add_data($data = array(),$table){
    	$ci =& get_instance();
    	 
    	$ci->db->insert($table, $data);
    	
    	$lastinsertid = $ci->db->insert_id();
    	if ($ci->db->affected_rows() == 1) {
    		return $lastinsertid;
    	}
    	return false;
    	
    }
    
    function grid_data_updates($data = array(),$table,$wher_column_name,$id){
    	$ci =& get_instance();
    	$ci->db->where($wher_column_name, $id);
    	$ci->db->update($table, $data);
    }
	
	function grid_delete($table,$where_col,$where_col_id){
    	$ci =& get_instance();
    	$ci->db->where($where_col, $where_col_id);
		$ci->db->delete($table);
        if($ci->db->affected_rows() > 0) {
            return true;
        }
        return false;
		
    }
	
}

/* End of file grid_function_helper.php */
/* Location: ./application/helpers/grid_function_helper.php */