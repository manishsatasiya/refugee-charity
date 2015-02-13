<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home_visit_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
	
	public function delete_document($document_id) {
        $this->db->where('document_id', $document_id);
        $this->db->delete('documents');
        if($this->db->affected_rows() == 1) {
            return true;
        }
        return false;
    }

	public function get_documents($document_type,$globalsearchkwd = '') {
		 $arrCampusPrivilages = get_user_campus_privilages();
		//$campus_id = 0;
		$_like = array();
		if($globalsearchkwd <> ''){
			$_like['name'] = $globalsearchkwd;
		}
		$query_where = '';
        $this->db->select('documents.*',FALSE);
        $this->db->from('documents');
		$this->db->where('document_type', $document_type);
		!empty($_like) ? $this->db->like($_like) : "";
		if(count($arrCampusPrivilages) > 0)
		{	
			foreach($arrCampusPrivilages as $cmp_id){
				$query_where .= ' campus_id LIKE "%'.$cmp_id.'j%" OR ';
			}
		}
		$query_where = trim(trim($query_where),'OR');
		if($query_where <> '') {
			$this->db->where($query_where);
		}
		$query = $this->db->get();
	
		$data = array();
		if($query->num_rows() > 0) {
            if($query){
				foreach($query->result_array() AS $result_row){
					$campus_id = $result_row['campus_id'];
					$campus_arr = (!empty($campus_id))?explode(',',str_replace('j','',$campus_id)):array();

					$row = array();
					$row['document_id'] = $result_row['document_id'];
					$row['campus_id'] = $campus_id;
					$row['document_type'] = $result_row['document_type'];
					$row['name'] = $result_row['name'];
					$row['file'] = $result_row['file'];
					$row['campus_arr'] = $campus_arr;
					$data[] = $row;
				}
			}
        }
		return $data;
    }
	
	public function get_document_by_id($id){
    	
		$this->db->select('documents.*',FALSE);
        $this->db->from('documents');
		$this->db->where('documents.document_id', $id);
		
    	$query = $this->db->get();
    	if($query->num_rows() == 1) {
    		$row = $query->row();
    		return $row;
    	}
    	return false;
    }

}

/* End of file contractors_model.php */
