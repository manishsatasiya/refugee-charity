<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class refugee_settings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_location_refugee($limit = 0, $offset = 0, $order_by = "location", $sort_order = "asc", $search_data,$count = false) {
        
        if (!empty($search_data)) {
            !empty($search_data['location']) ? $data['location'] = $search_data['location'] : "";
            
            
        }
        $this->db->select('*');
        $this->db->from('refugee_location');        
        !empty($data) ? $this->db->or_like($data) : "";
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
	
    public function get_location_refugee_data($id){
        $this->db->select('*')->from('refugee_location')->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            $row = $query->row();
            return $row;
        }
        return false;
    }

    public function get_association_name($limit = 0, $offset = 0, $order_by = "name", $sort_order = "asc", $search_data,$count = false) {
        
        if (!empty($search_data)) {
            !empty($search_data['name']) ? $data['name'] = $search_data['name'] : "";
            !empty($search_data['location']) ? $data['location'] = $search_data['location'] : "";
        }
        $this->db->select('*');
        $this->db->from('association_name');        
        !empty($data) ? $this->db->or_like($data) : "";
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
    
    public function get_association_name_data($id){
        $this->db->select('*')->from('association_name')->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            $row = $query->row();
            return $row;
        }
        return false;
    }
	
	public function get_nationality($limit = 0, $offset = 0, $order_by = "name", $sort_order = "asc", $search_data,$count = false) {
        
        if (!empty($search_data)) {
            !empty($search_data['nationality']) ? $data['nationality'] = $search_data['nationality'] : "";
        }
		
        $this->db->select('*');
        $this->db->from('countries');        
        !empty($data) ? $this->db->or_like($data) : "";
        $this->db->order_by($order_by, $sort_order);
        
        if($count == false)
            $this->db->limit($limit, $offset);
    
        $query = $this->db->get();
        if($count == true)
            return $query->num_rows();
        
        if($query->num_rows() > 0) {
            return $query;
        }
    }
    
    public function get_nationality_data($id){
        $this->db->select('*')->from('countries')->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            $row = $query->row();
            return $row;
        }
        return false;
    }
}

/* End of file list_user_model.php */
