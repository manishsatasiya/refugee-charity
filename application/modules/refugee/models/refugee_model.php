<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class refugee_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_refugee($limit = 0, $offset = 0, $order_by = "date_of_data_entry", $sort_order = "asc", $search_data,$count = false) {
		if (!empty($search_data)) {
            !empty($search_data['date_of_data_entry']) ? $data['date_of_data_entry'] = $search_data['date_of_data_entry'] : "";
            !empty($search_data['name_of_association']) ? $data['name_of_association'] = str_replace(" ","",trim($search_data['name_of_association'])) : "";
            !empty($search_data['name_of_donator']) ? $data['name_of_donator'] = $search_data['name_of_donator'] : "";
            !empty($search_data['what_was_donated_please_specify']) ? $data['what_was_donated_please_specify'] = $search_data['what_was_donated_please_specify'] : "";
            !empty($search_data['name_aid_of_receiver_from']) ? $data['name_aid_of_receiver_from'] = $search_data['name_aid_of_receiver_from'] : "";
            !empty($search_data['month']) ? $data['month'] = $search_data['month'] : "";
            !empty($search_data['year']) ? $data['year'] = $search_data['year'] : "";
            
        }
      
        $this->session->set_userdata('export_var', $search_data);

    	$this->db->select('refugee.*
						 ',FALSE);
    	$this->db->from('refugee');
		
    	//!empty($data) ? $this->db->or_like($data) : "";
    	if(!empty($data))
        {
			$filter_selection = " AND ";
			if(isset($search_data["global_search"]) && $search_data["global_search"] == 1)
				$filter_selection = " OR ";
				
        	$str_data_or_like = "";
        	foreach($data AS $data_key=>$data_val)
        	{
				$str_data_or_like .= " $data_key LIKE '%$data_val%'".$filter_selection;	

        	}
        	$str_data_or_like = trim(trim($str_data_or_like),$filter_selection);
        	
        	if($str_data_or_like != "")
        		$this->db->where("(".$str_data_or_like.")", null, false);
        } 

		if($order_by != "")
			$this->db->order_by($order_by, $sort_order);
		
		
		if($count == false)
			$this->db->limit($limit, $offset);
    
    	$query = $this->db->get();
		
		if($count == true)
			return $query->num_rows();
		
		//echo $this->db->last_query();	
    	if($query->num_rows() > 0) {
    		return $query;
    	}
    }
	
    public function get_refugee_data($id) {
        $this->db->select('*');
        $this->db->from('refugee');
       
        $this->db->where('id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query->row(0);
        }

        return false;
    }
}

/* End of file list_user_model.php */
