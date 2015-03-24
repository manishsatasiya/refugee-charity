<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class refugee_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_refugee($limit = 0, $offset = 0, $order_by = "association_name", $sort_order = "asc", $search_data,$count = false) {
		if (!empty($search_data)) {
            !empty($search_data['association_name']) ? $data['association_name'] = $search_data['association_name'] : "";
            !empty($search_data['full_name']) ? $data['full_name'] = str_replace(" ","",trim($search_data['full_name'])) : "";
            !empty($search_data['age']) ? $data['age'] = $search_data['age'] : "";
            !empty($search_data['gender']) ? $data['gender'] = $search_data['gender'] : "";
            !empty($search_data['nationality']) ? $data['nationality'] = $search_data['nationality'] : "";
            !empty($search_data['month']) ? $data['month'] = $search_data['month'] : "";
            !empty($search_data['year']) ? $data['year'] = $search_data['year'] : "";
            
        }
      
        $this->session->set_userdata('export_var', $search_data);

    	$this->db->select('refugee.*,
                          countries.nationality as nationality,
                          association_name.name as association_name
						 ',FALSE);
    	$this->db->from('refugee');
        $this->db->join('countries', 'countries.id = refugee.nationality','left');
        $this->db->join('association_name', 'association_name.id = refugee.association_name','left');
		
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

    public function get_refugee_doc($type,$user_id) {
        $this->db->select('*');
        $this->db->from('refugee_documents');
       
        $this->db->where('type', $type);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        //echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query;
        }

        return false;
    }

    public function get_refugee_doc_by_id($id) {
        $this->db->select('*');
        $this->db->from('refugee_documents');
        $this->db->where('id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query->row(0);
        }

        return false;
    }

    public function get_qualifications($refugee_id,$order_by = "title", $sort_order = "asc", $count = false) {

        $this->db->select('*');
        $this->db->from('refugee_qualifications');
        $this->db->where('refugee_id', $refugee_id);

        $this->db->order_by($order_by, $sort_order);
        
        $query = $this->db->get();
        
        if($count == true)
            return $query->num_rows();

        if($query->num_rows() > 0) {
            return $query;
        }
    }

    public function get_qualifications_data($id){
        $this->db->select('*')->from('refugee_qualifications')->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            $row = $query->row();
            return $row;
        }
        return false;
    }

    public function get_family_members($refugee_id,$order_by = "name", $sort_order = "asc", $count = false) {

        $this->db->select('*');
        $this->db->from('refugee_family_members');
        $this->db->where('refugee_id', $refugee_id);

        $this->db->order_by($order_by, $sort_order);
        
        $query = $this->db->get();
        
        if($count == true)
            return $query->num_rows();

        if($query->num_rows() > 0) {
            return $query;
        }
    }

    public function get_family_members_data($id){
        $this->db->select('*')->from('refugee_family_members')->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            $row = $query->row();
            return $row;
        }
        return false;
    }

    public function get_profile_changes_log($limit = 0, $offset = 0, $order_by = "username", $sort_order = "asc", $search_data,$refugee_id=0) {
        if (!empty($search_data)) {
            !empty($search_data['full_name']) ? $data['full_name'] = $search_data['full_name'] : "";
            !empty($search_data['change_by_name']) ? $data['change_by_name'] = $search_data['change_by_name'] : "";
        }
        
        $user_id = $this->session->userdata('user_id');
        
        $this->db->select('refugee_log_master.*,
                          refugee.full_name AS full_name,
                          CONCAT_WS(" ",change_u.first_name,change_u.last_name) AS change_by_name,                  
                         ',FALSE);
        $this->db->from('refugee_log_master');
        $this->db->join('refugee', 'refugee.id = refugee_log_master.refugee_id','left');
        $this->db->join('users as change_u', 'change_u.user_id = refugee_log_master.change_by','left');

        $this->db->where('refugee_log_master.refugee_id',$refugee_id);
        
        !empty($data) ? $this->db->like($data) : "";
        
        if($order_by != "")
            $this->db->order_by($order_by, $sort_order);
        
        if($limit > 0)
            $this->db->limit($limit, $offset);
    
        $query = $this->db->get();
        //echo $this->db->last_query(); 
        
        if($limit == 0)
            return $query->num_rows();
            
        if($query->num_rows() > 0) {
            return $query;
        }
    }

    function get_profile_changes_log_data($refugee_log_master_id){
        $this->db->select('refugee_log_data.*',false);
        $this->db->from('refugee_log_data');
        $this->db->where('refugee_log_data.refugee_log_master_id', $refugee_log_master_id);
        $query = $this->db->get();
        //echo $this->db->last_query();     
        if($query->num_rows() > 0) {
            return $query;
        }
        return false;
    }

}

/* End of file list_user_model.php */
