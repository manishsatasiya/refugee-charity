<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class List_Teacher_Student_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     *
     * get_teacher: get the teacher data
     *
     * @param int $limit db limit (members per page)
     * @param int $offset db offset (current page)
     * @param int $order_by db sort order
     * @param string $sort_order asc or desc
     * @param array $search_data search input
     * @return mixed
     *
     */

    public function get_teacher($limit = 0, $offset = 0, $order_by = "username", $sort_order = "asc", $search_data,$campus_id=0,$count = false) {
        $arrCampusPrivilages = get_user_campus_privilages();
		//$isLineManager = isLineManager();
		$filter_job_title = 0;
        if (!empty($search_data)) {
            !empty($search_data['username']) ? $data['users.username'] = $search_data['username'] : "";
            !empty($search_data['staff_name']) ? $data['staff_name'] = str_replace(" ","",trim($search_data['staff_name'])) : "";
            !empty($search_data['coordinator']) ? $data['CONCAT_WS("",trim(l.first_name),trim(l.last_name))'] = str_replace(" ","",trim($search_data['coordinator'])) : "";
            !empty($search_data['ca_lead_teacher']) ? $data['ca_lead.first_name'] = $search_data['ca_lead_teacher'] : "";
            !empty($search_data['section_title']) ? $data['course_section.section_title'] = $search_data['section_title'] : "";
            !empty($search_data['elsd_id']) ? $data['users.elsd_id'] = $search_data['elsd_id'] : "";
            !empty($search_data['contractor']) ? $data['contractors.contractor'] = $search_data['contractor'] : "";
            !empty($search_data['user_roll_name']) ? $data['user_roll_name'] = $search_data['user_roll_name'] : "";
            !empty($search_data['email']) ? $data['users.email'] = $search_data['email'] : "";
            !empty($search_data['user_roll_name']) ? $data['user_roll_name'] = $search_data['user_roll_name'] : "";
            !empty($search_data['name_suffix']) ? $data['users.name_suffix'] = $search_data['name_suffix'] : "";
            !empty($search_data['address1']) ? $data['users.address1'] = $search_data['address1'] : "";
            !empty($search_data['city']) ? $data['users.city'] = $search_data['city'] : "";
            !empty($search_data['state']) ? $data['users.state'] = $search_data['state'] : "";
            !empty($search_data['zip']) ? $data['users.zip'] = $search_data['zip'] : "";
            !empty($search_data['cell_phone']) ? $data['users.cell_phone'] = $search_data['cell_phone'] : "";
            !empty($search_data['campus_name']) ? $data['campus_name'] = $search_data['campus_name'] : "";
           // !empty($search_data['job_title.job_title']) ? $data['job_title.job_title'] = $search_data['job_title.job_title'] : "";
            !empty($search_data['job_title']) ? $filter_job_title = $search_data['job_title'] : 0;
        }
      
        $this->session->set_userdata('export_var', $search_data);

    	$this->db->select('users.elsd_id,
						  CONCAT_WS(" ",users.first_name,users.middle_name,users.middle_name2,users.last_name) AS staff_name,
						  CONCAT_WS(" ",l.first_name,l.last_name) AS line_manager_name,
						  school_campus.campus_name,
						  users.username,
						  users.email,
						  users.user_id,
						  users.cell_phone,
						  users.buildings,
						  contractors.contractor,
						  user_roll.user_roll_name,
						  job_title.job_title as job_title,
						  users.change_by,
						  (select count(*) from users_log where users_log.user_id=users.user_id and profile_update = 0) as log_cnt
						 ',FALSE);
    	$this->db->from('users');
		$this->db->join('user_profile', 'user_profile.user_id = users.user_id','left');
		$this->db->join('school_campus', 'school_campus.campus_id = users.campus_id','left');
		$this->db->join('user_roll', 'user_roll.user_roll_id = users.user_roll_id','left');
		$this->db->join('contractors', 'contractors.id = user_profile.contractor','left');
		$this->db->join('users l', 'l.user_id = users.coordinator','left');
		//$this->db->where('(users.user_roll_id = 3 OR (users.user_roll_id = 5 AND user_profile.job_title = 5))');
		$this->db->join('job_title', 'job_title.job_title_id = user_profile.job_title','left');
		$this->db->where_in('users.status',array(13));
		$this->db->where_in('user_profile.job_title',array(1,5));

		if (is_numeric($filter_job_title) && $filter_job_title > 0) {
    		$this->db->where('user_profile.job_title',$filter_job_title);
    	}
		
		if(count($arrCampusPrivilages) > 0)
		{	
			$this->db->where_in('users.campus_id',$arrCampusPrivilages);
		}
		
    	//!empty($data) ? $this->db->or_like($data) : "";
    	if(!empty($data))
        {
			$filter_selection = " AND ";
			if(isset($search_data["global_search"]) && $search_data["global_search"] == 1)
				$filter_selection = " OR ";
				
        	$str_data_or_like = "";
        	foreach($data AS $data_key=>$data_val)
        	{
				if($data_key == "staff_name")
				{
					$str_data_or_like .= "(CONCAT_WS('',trim(users.first_name),trim(users.middle_name),trim(users.middle_name2),trim(users.last_name)) LIKE '%".$data_val."%' OR CONCAT_WS('',trim(users.first_name),trim(users.last_name)) LIKE '%".$data_val."%')".$filter_selection;
				}
				else if($data_key == "user_roll_name")
				{
					$str_data_or_like .= "user_roll_name = '".$data_val."'".$filter_selection;
				}
				else
				{
					$str_data_or_like .= " $data_key LIKE '%$data_val%'".$filter_selection;	
				}
        	}
        	$str_data_or_like = trim(trim($str_data_or_like),$filter_selection);
        	
        	if($str_data_or_like != "")
        		$this->db->where("(".$str_data_or_like.")", null, false);
        }
		
		/*if($this->session->userdata('role_id') != 1 && $isLineManager == 1){
			$this->db->where('users.coordinator',$this->session->userdata('user_id'));
		}*/
		/*
		if($this->session->userdata('role_id') > 4 && $this->session->userdata('contractor') > 1){
			$this->db->where('user_profile.contractor',$this->session->userdata('contractor'));
		}
		*/
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
    
    /**
     *
     * get_other_user: get the other user data
     *
     * @param int $limit db limit (members per page)
     * @param int $offset db offset (current page)
     * @param int $order_by db sort order
     * @param string $sort_order asc or desc
     * @param array $search_data search input
     * @return mixed
     *
     */
    
    public function get_other_user($limit = 0, $offset = 0, $order_by = "username", $sort_order = "asc", $search_data) {
    	if (!empty($search_data)) {
    		!empty($search_data['user_id']) ? $data['user_id'] = $search_data['user_id'] : "";
    		!empty($search_data['first_name']) ? $data['first_name'] = $search_data['first_name'] : "";
    		!empty($search_data['elsd_id']) ? $data['elsd_id'] = $search_data['elsd_id'] : "";
    		!empty($search_data['scanner_id']) ? $data['scanner_id'] = $search_data['scanner_id'] : "";
    		!empty($search_data['gender']) ? $data['gender'] = $search_data['gender'] : "";
    		!empty($search_data['email']) ? $data['email'] = $search_data['email'] : "";
    		!empty($search_data['mobile']) ? $data['mobile'] = $search_data['mobile'] : "";
    		!empty($search_data['user_roll_name']) ? $data['user_roll_name'] = $search_data['user_roll_name'] : "";
			!empty($search_data['co_ordinator']) ? $data['co_ordinator'] = $search_data['co_ordinator'] : "";
    		!empty($search_data['campus']) ? $data['campus'] = $search_data['campus'] : "";
    		!empty($search_data['contractor']) ? $data['contractor'] = $search_data['contractor'] : "";
			!empty($search_data['returning']) ? $data['returning'] = $search_data['returning'] : "";
    	}
    	$this->db->select('users.*,user_profile.scanner_id,user_profile.scanner_id,user_profile.co_ordinator,user_profile.contractor,user_profile.returning, user_roll.user_roll_name as role_name');
    	$this->db->from('users');
		$this->db->join('user_profile', 'user_profile.user_id = users.user_id','left');
		$this->db->join('user_verifications', 'user_verifications.user_id = users.user_id','left');
		$this->db->join('school_campus', 'school_campus.campus_id = users.campus_id','left');
		$this->db->join('user_roll', 'user_roll.user_roll_id = users.user_roll_id','left');
		$this->db->join('contractors', 'contractors.id = user_profile.contractor','left');
		$this->db->join('countries', 'countries.id = user_profile.nationality','left');
		$this->db->where_not_in('users.user_roll_id',array('1','3'));
    	$this->db->where_not_in('users.status',array('1'));
    	
    	!empty($data) ? $this->db->like($data) : "";
    	$this->db->order_by($order_by, $sort_order);
    	$this->db->limit($limit, $offset);
    
    	$query = $this->db->get();

    	if($query->num_rows() > 0) {
    		return $query;
    	}
    }

	public function get_staff_members($type="",$limit = 0, $offset = 0, $order_by = "username", $sort_order = "asc", $search_data,$exclude_student=0) {
		$arrCampusPrivilages = get_user_campus_privilages();
		$isLineManager = isLineManager();
		$filter_status = 0;
		$filter_job_title = 0;
    	if (!empty($search_data)) {
    		!empty($search_data['user_id']) ? $data['users.user_id'] = $search_data['user_id'] : "";
			!empty($search_data['elsd_id']) ? $data['users.elsd_id'] = $search_data['elsd_id'] : "";
    		!empty($search_data['staff_name']) ? $data['staff_name'] = str_replace(" ","",trim($search_data['staff_name'])) : "";
			!empty($search_data['coordinator']) ? $data['CONCAT_WS("",trim(l.first_name),trim(l.last_name))'] = str_replace(" ","",trim($search_data['coordinator'])) : "";
    		!empty($search_data['email']) ? $data['users.email'] = $search_data['email'] : "";
    		!empty($search_data['personal_email']) ? $data['users.personal_email'] = $search_data['personal_email'] : "";
    		!empty($search_data['user_roll_name']) ? $data['user_roll.user_roll_name'] = $search_data['user_roll_name'] : "";
    		!empty($search_data['users.cell_phone']) ? $data['users.cell_phone'] = $search_data['users.cell_phone'] : "";
    		!empty($search_data['campus_name']) ? $data['school_campus.campus_name'] = $search_data['campus_name'] : "";
    		!empty($search_data['contractor']) ? $data['contractors.contractor'] = $search_data['contractor'] : "";
			!empty($search_data['nationality']) ? $data['countries.nationality'] = $search_data['nationality'] : "";
    		!empty($search_data['department_name']) ? $data['department.department_name'] = $search_data['department_name'] : "";
    		//empty($search_data['job_title']) ? $data['job_title.job_title'] = $search_data['job_title'] : "";
    		!empty($search_data['scanner_id']) ? $data['scanner_id'] = $search_data['scanner_id'] : "";
			!empty($search_data['returning']) ? $data['returning'] = $search_data['returning'] : "";

			!empty($search_data['users.status']) ? $filter_status = $search_data['users.status'] : 0;

			!empty($search_data['job_title']) ? $filter_job_title = $search_data['job_title'] : 0;
    	}
		$this->session->set_userdata('export_var', $search_data);
		//print_r($search_data);
		$strQueryAllStatus = "";
		$strQueryIntType = "";
		$strQueryIntOutCome = "";
		$arrAllStatus = user_profile_status($type);
			
		$arrIntType = get_interview_type();
		$arrIntOutCome = get_interview_outcome();
		
		foreach($arrAllStatus AS $key=>$val)
		{
			if($key != "")
				$strQueryAllStatus .= " WHEN $key THEN '$val' ";
		}
		
		if($strQueryAllStatus != "")
		{
			$strQueryAllStatus = " CASE users.status $strQueryAllStatus  ELSE 'N/A' END ";
		}
		
		foreach($arrIntType AS $key=>$val)
		{
			if($key != "")
				$strQueryIntType .= " WHEN $key THEN '$val' ";
		}
		
		if($strQueryIntType != "")
		{
			$strQueryIntType = " CASE user_verifications.interview_type $strQueryIntType  ELSE 'N/A' END ";
		}
		
		foreach($arrIntOutCome AS $key=>$val)
		{
			if($key != "")
				$strQueryIntOutCome .= " WHEN $key THEN '$val' ";
		}
		
		if($strQueryIntOutCome != "")
		{
			$strQueryIntOutCome = " CASE user_verifications.interview_outcome $strQueryIntOutCome  ELSE 'N/A' END ";
		}
		
    	$this->db->select('users.user_id,
						  users.elsd_id,
						  CONCAT_WS(" ",users.first_name,users.middle_name,users.middle_name2,users.last_name) AS staff_name,
						  CONCAT_WS(" ",l.first_name,l.last_name) AS line_manager_name,
						  users.email,
						  users.personal_email,
						  users.cell_phone,
						  users.gender,
						  users.buildings,
						  users.birth_date,'.
						  $strQueryAllStatus.' AS status,
						  user_roll.user_roll_name,
						  school_campus.campus_name,
						  contractors.contractor,
						  countries.nationality,
						  department.department_name,
						  user_profile.scanner_id,
						  user_profile.expected_arrival_date,
						  job_title.job_title as job_title,
						  IF(user_profile.returning = 1,"Yes","No") AS returning,
						  CONCAT_WS(" ",intr1.first_name,intr1.middle_name,intr1.middle_name2,intr1.last_name) AS interviewer1,
						  CONCAT_WS(" ",intr2.first_name,intr2.middle_name,intr2.middle_name2,intr2.last_name) AS interviewer2,
						  user_verifications.interview_date,
						  user_verifications.interview_notes,'.
						  $strQueryIntOutCome.' AS interview_outcome,'.
						  $strQueryIntType.' AS interview_type,
						  (SELECT COUNT(*) FROM profile_certificate WHERE certificate_type = 10 AND user_id = users.user_id) AS interview_eva_found,
						  (SELECT GROUP_CONCAT(certificate_file) FROM profile_certificate WHERE certificate_type = 10 AND user_id = users.user_id) AS interview_eva_form_link,	
						  users.created_date,
						  users.updated_date
						 ',FALSE);
    	$this->db->from('users');
		$this->db->join('user_profile', 'user_profile.user_id = users.user_id','left');
		$this->db->join('user_verifications', 'user_verifications.user_id = users.user_id','left');
		$this->db->join('users AS intr1', 'user_verifications.interviewee1 = intr1.user_id','left');
		$this->db->join('users AS intr2', 'user_verifications.interviewee2 = intr2.user_id','left');
		$this->db->join('users l', 'l.user_id = users.coordinator','left');
		$this->db->join('school_campus', 'school_campus.campus_id = users.campus_id','left');
		$this->db->join('user_roll', 'user_roll.user_roll_id = users.user_roll_id','left');
		$this->db->join('department', 'department.id = user_profile.department_id','left');
		$this->db->join('contractors', 'contractors.id = user_profile.contractor','left');
		$this->db->join('countries', 'countries.id = user_profile.nationality','left');
		$this->db->join('job_title', 'job_title.job_title_id = user_profile.job_title','left');
		//$this->db->where_not_in('users.user_roll_id',array('1','3'));
		
		if(count($arrCampusPrivilages) > 0 && !in_array(99999,$arrCampusPrivilages))
		{	
			$this->db->where_in('users.campus_id',$arrCampusPrivilages);
		}
		
		if($type != "")
		{
			$arrStatus = array_keys($arrAllStatus);
			
			if(count($arrStatus) > 0)
				$this->db->where_in('users.status',$arrStatus);
    	}

    	if ($filter_status > 0) {
    		$this->db->where('users.status',$filter_status);
    	}

    	if (is_numeric($filter_job_title) && $filter_job_title > 0) {
    		$this->db->where('user_profile.job_title',$filter_job_title);
    	}
		
    	//!empty($data) ? $this->db->like($data) : "";
    	if(!empty($data))
        {
			$filter_selection = " AND ";
			if(isset($search_data["global_search"]) && $search_data["global_search"] == 1)
				$filter_selection = " OR ";
				
        	$str_data_or_like = "";
        	foreach($data AS $data_key=>$data_val)
        	{
				if($data_key == "staff_name")
				{
					$str_data_or_like .= "(CONCAT_WS('',trim(users.first_name),trim(users.middle_name),trim(users.middle_name2),trim(users.last_name)) LIKE '%".$data_val."%' OR CONCAT_WS('',trim(users.first_name),trim(users.last_name)) LIKE '%".$data_val."%')".$filter_selection;
				}
				else
				{
					$str_data_or_like .= " $data_key LIKE '%$data_val%'".$filter_selection;	
				}
        	}
        	$str_data_or_like = trim(trim($str_data_or_like),$filter_selection);
        	
        	if($str_data_or_like != "")
        		$this->db->where("(".$str_data_or_like.")", null, false);
        }
		
		if($type == "company_newemployee" || $type == "company_rejected" || $type == "company_activestaff" || $type == "company_inactivestaff")
		{
			if($this->session->userdata('role_id') != 1 && $isLineManager == 1){
				$this->db->where('users.coordinator',$this->session->userdata('user_id'));
			}
			
			if($this->session->userdata('role_id') > 4 && $this->session->userdata('contractor') > 1){
				$this->db->where('user_profile.contractor',$this->session->userdata('contractor'));
			}
		}
		
		if($exclude_student == 1)
		{
			$this->db->where('users.user_roll_id != 4');
		}
		
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


    public function get_staff_members_export($type="",$limit = 0, $offset = 0, $order_by = "username", $sort_order = "asc", $search_data, $campus_id) {
		$arrCampusPrivilages = get_user_campus_privilages();
		$search_data = $this->session->userdata('export_var');
		//$isLineManager = isLineManager();
    	if (!empty($search_data)) {
    		!empty($search_data['user_id']) ? $data['user_id'] = $search_data['user_id'] : "";
			!empty($search_data['elsd_id']) ? $data['elsd_id'] = $search_data['elsd_id'] : "";
    		!empty($search_data['staff_name']) ? $data['staff_name'] = str_replace(" ","",trim($search_data['staff_name'])) : "";
			!empty($search_data['coordinator']) ? $data['CONCAT_WS("",trim(l.first_name),trim(l.last_name))'] = str_replace(" ","",trim($search_data['coordinator'])) : "";
    		!empty($search_data['email']) ? $data['email'] = $search_data['email'] : "";
    		!empty($search_data['personal_email']) ? $data['personal_email'] = $search_data['personal_email'] : "";
    		!empty($search_data['users.cell_phone']) ? $data['users.cell_phone'] = $search_data['users.cell_phone'] : "";
    		!empty($search_data['user_roll_name']) ? $data['user_roll_name'] = $search_data['user_roll_name'] : "";
    		!empty($search_data['campus_name']) ? $data['campus_name'] = $search_data['campus_name'] : "";
    		!empty($search_data['contractor']) ? $data['contractors.contractor'] = $search_data['contractor'] : "";
			!empty($search_data['nationality']) ? $data['countries.nationality'] = $search_data['nationality'] : "";
    		!empty($search_data['department_name']) ? $data['department.department_name'] = $search_data['department_name'] : "";
    		!empty($search_data['scanner_id']) ? $data['scanner_id'] = $search_data['scanner_id'] : "";
			!empty($search_data['returning']) ? $data['returning'] = $search_data['returning'] : "";
    	}
		
		$strQueryAllStatus = "";
		$strQueryIntType = "";
		$strQueryIntOutCome = "";
		$arrAllStatus = user_profile_status($type);
			
		$arrIntType = get_interview_type();
		$arrIntOutCome = get_interview_outcome();
		
		foreach($arrAllStatus AS $key=>$val)
		{
			if($key != "")
				$strQueryAllStatus .= " WHEN $key THEN '$val' ";
		}
		
		if($strQueryAllStatus != "")
		{
			$strQueryAllStatus = " CASE users.status $strQueryAllStatus  ELSE 'N/A' END ";
		}
		
		foreach($arrIntType AS $key=>$val)
		{
			if($key != "")
				$strQueryIntType .= " WHEN $key THEN '$val' ";
		}
		
		if($strQueryIntType != "")
		{
			$strQueryIntType = " CASE user_verifications.interview_type $strQueryIntType  ELSE 'N/A' END ";
		}
		
		foreach($arrIntOutCome AS $key=>$val)
		{
			if($key != "")
				$strQueryIntOutCome .= " WHEN $key THEN '$val' ";
		}
		
		if($strQueryIntOutCome != "")
		{
			$strQueryIntOutCome = " CASE user_verifications.interview_outcome $strQueryIntOutCome  ELSE 'N/A' END ";
		}
		
    	$this->db->select('users.user_id,
						  users.elsd_id,
						  CONCAT_WS(" ",users.first_name,users.middle_name,users.middle_name2,users.last_name) AS staff_name,
						  CONCAT_WS(" ",l.first_name,l.last_name) AS line_manager_name,
						  users.email,
						  users.personal_email,
						  users.cell_phone,
						  users.birth_date,'.
						  $strQueryAllStatus.' AS status,
						  user_roll.user_roll_name,
						  school_campus.campus_name,
						  contractors.contractor,
						  countries.nationality,
						  department.department_name,
						  user_profile.scanner_id,
						  IF(user_profile.returning = 1,"Yes","No") AS returning,
						  CONCAT_WS(" ",intr1.first_name,intr1.middle_name,intr1.middle_name2,intr1.last_name) AS interviewer1,
						  CONCAT_WS(" ",intr2.first_name,intr2.middle_name,intr2.middle_name2,intr2.last_name) AS interviewer2,
						  user_verifications.interview_date,
						  user_verifications.interview_notes,'.
						  $strQueryIntOutCome.' AS interview_outcome,'.
						  $strQueryIntType.' AS interview_type,
						  (SELECT COUNT(*) FROM profile_certificate WHERE certificate_type = 10 AND user_id = users.user_id) AS interview_eva_found,
						  (SELECT GROUP_CONCAT(certificate_file) FROM profile_certificate WHERE certificate_type = 10 AND user_id = users.user_id) AS interview_eva_form_link,	
						  users.created_date,
						  users.updated_date
						 ',FALSE);
    	$this->db->from('users');
		$this->db->join('user_profile', 'user_profile.user_id = users.user_id','left');
		$this->db->join('user_verifications', 'user_verifications.user_id = users.user_id','left');
		$this->db->join('users AS intr1', 'user_verifications.interviewee1 = intr1.user_id','left');
		$this->db->join('users AS intr2', 'user_verifications.interviewee2 = intr2.user_id','left');
		$this->db->join('users l', 'l.user_id = users.coordinator','left');
		$this->db->join('school_campus', 'school_campus.campus_id = users.campus_id','left');
		$this->db->join('user_roll', 'user_roll.user_roll_id = users.user_roll_id','left');
		$this->db->join('department', 'department.id = user_profile.department_id','left');
		$this->db->join('contractors', 'contractors.id = user_profile.contractor','left');
		$this->db->join('countries', 'countries.id = user_profile.nationality','left');
		//$this->db->where_not_in('users.user_roll_id',array('1','3'));
		
		//if(count($arrCampusPrivilages) > 0 && !in_array(99999,$arrCampusPrivilages))
		if(count($arrCampusPrivilages) > 0)
		{	
			$this->db->where_in('users.campus_id',$arrCampusPrivilages);
		}

		if ($campus_id > 0) {
			$this->db->where_in('users.campus_id',$campus_id);
		}
		
		if($type != "")
		{
			$arrStatus = array_keys($arrAllStatus);
			
			if(count($arrStatus) > 0)
				$this->db->where_in('users.status',$arrStatus);
    	}
		
    	//!empty($data) ? $this->db->like($data) : "";
    	if(!empty($data))
        {
			$filter_selection = " AND ";
			if(isset($search_data["global_search"]) && $search_data["global_search"] == 1)
				$filter_selection = " OR ";
				
        	$str_data_or_like = "";
        	foreach($data AS $data_key=>$data_val)
        	{
				if($data_key == "staff_name")
				{
					$str_data_or_like .= "(CONCAT_WS('',trim(users.first_name),trim(users.middle_name),trim(users.middle_name2),trim(users.last_name)) LIKE '%".$data_val."%' OR CONCAT_WS('',trim(users.first_name),trim(users.last_name)) LIKE '%".$data_val."%')".$filter_selection;
				}
				else
				{
					$str_data_or_like .= " $data_key LIKE '%$data_val%'".$filter_selection;	
				}
        	}
        	$str_data_or_like = trim(trim($str_data_or_like),$filter_selection);
        	
        	if($str_data_or_like != "")
        		$this->db->where("(".$str_data_or_like.")", null, false);
        }
		
		/*if($this->session->userdata('role_id') != 1 && $isLineManager == 1){
			$this->db->where('users.coordinator',$this->session->userdata('user_id'));
		}
		
		if($this->session->userdata('role_id') > 4 && $this->session->userdata('contractor') > 1){
			$this->db->where('user_profile.contractor',$this->session->userdata('contractor'));
		}
		*/
		
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

    /**
     *
     * get_student: get the student data
     *
     * @param int $limit db limit (members per page)
     * @param int $offset db offset (current page)
     * @param int $order_by db sort order
     * @param string $sort_order asc or desc
     * @param array $search_data search input
     * @return mixed
     *
     */
	public function get_student($limit = 0, $offset = 0, $order_by = "campus,section_title", $sort_order = "asc", $search_data,$showall=0,$campus_id=0) {
		$arrCampusPrivilages = get_user_campus_privilages();
		//$isLineManager = isLineManager();
		$user_id = $this->session->userdata('user_id');
		$user_role = $this->session->userdata('role_id');
        $fields = $this->db->list_fields('users'); 

        if (!empty($search_data)) {
        	!empty($search_data['section_title']) ? $data['section_title'] = $search_data['section_title'] : "";
        	!empty($search_data['grade_section_title']) ? $data['grade_section_title'] = $search_data['grade_section_title'] : "";
            !empty($search_data['username']) ? $data['users.username'] = $search_data['username'] : "";
            !empty($search_data['student_uni_id']) ? $data['users.student_uni_id'] = $search_data['student_uni_id'] : "";
            !empty($search_data['grade_student_uni_id']) ? $data['grade_student_uni_id'] = $search_data['grade_student_uni_id'] : "";
            !empty($search_data['first_name']) ? $data['users.first_name'] = $search_data['first_name'] : "";
            !empty($search_data['campus']) ? $data['campus_name'] = $search_data['campus'] : "";
            !empty($search_data['email']) ? $data['users.email'] = $search_data['email'] : "";
            !empty($search_data['primary_teacher_id']) ? $data['primary_teacher_id'] = $search_data['primary_teacher_id'] : "";
            !empty($search_data['academic_status']) ? $data['users.academic_status'] = $search_data['academic_status'] : "";
			!empty($search_data['course_section.track']) ? $data['course_section.track'] = $search_data['course_section.track'] : "";
			!empty($search_data['course_section.buildings']) ? $data['course_section.buildings'] = $search_data['course_section.buildings'] : "";
        }
       
		$this->session->set_userdata('export_var', $search_data);
        $this->db->select('users.*,campus_name,CONCAT_WS(" ",users.first_name,users.middle_name,users.middle_name2,users.last_name) AS staff_name,DATE_FORMAT(users.student_schedule_date,"%a %D, %b, %Y ") AS stu_schedule_date, user_roll.user_roll_name as role_name,course_section.section_title,course_section.track AS section_track,course_section.buildings AS section_buildings,',FALSE);
        $this->db->from('users');  
        $this->db->join('school_campus','users.campus_id=school_campus.campus_id','left'); 
        $this->db->join('course_class','users.section_id=course_class.section_id','left');  
        
        $this->db->join('users AS p1','p1.user_id=course_class.primary_teacher_id','left');  
		$this->db->where('users.user_roll_id','4');        
		$this->db->where('users.discontinue != "inactive"');
		if($campus_id > 0) {
			$this->db->where('users.campus_id = '.$campus_id);
		}	
		if($this->session->userdata('ca_lead_teacher') > 0)
		{
			$this->db->where('course_section.ca_lead_teacher',$this->session->userdata('ca_lead_teacher'));
		}
		
		if(count($arrCampusPrivilages) > 0)
		{	
			$this->db->where_in('users.campus_id',$arrCampusPrivilages);
		}
		
        $this->db->join('user_roll', 'user_roll.user_roll_id = users.user_roll_id');
		
		if($showall == 1)
			$this->db->join('course_section', 'course_section.section_id = users.section_id','left');
		else	
			$this->db->join('course_section', 'course_section.section_id = users.section_id');
			
        if(!empty($data))
        {
			$filter_selection = " AND ";
			if(isset($search_data["global_search"]) && $search_data["global_search"] == 1)
				$filter_selection = " OR ";
				
        	$str_data_or_like = "";
        	foreach($data AS $data_key=>$data_val)
        	{
				if($data_key == "grade_student_uni_id")
				{
					$str_data_or_like .= " users.student_uni_id = '$data_val'".$filter_selection;	
				}
				else if($data_key == "grade_section_title")
				{
					$str_data_or_like .= " section_title = '$data_val'".$filter_selection;	
				}
				else
				{
					$str_data_or_like .= " $data_key LIKE '%$data_val%'".$filter_selection;	
				}	
        	}
        	$str_data_or_like = trim(trim($str_data_or_like),$filter_selection);
        	
        	if($str_data_or_like != "")
        		$this->db->where("(".$str_data_or_like.")", null, false);
        }
		if($user_role == '3'){
		
			$this->db->where('course_class.primary_teacher_id',$user_id);        
		}
        $this->db->order_by($order_by, $sort_order);
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0) {
            return $query;
        }
    }
    
    public function get_student_export($limit = 0, $offset = 0, $order_by = "campus,section_title", $sort_order = "asc", $search_data,$showall=0,$campus_id=0) {
		$arrCampusPrivilages = get_user_campus_privilages();
		$user_id = $this->session->userdata('user_id');
		$user_role = $this->session->userdata('role_id');
        $fields = $this->db->list_fields('users'); 
		$search_data = $this->session->userdata('export_var');
		
        if (!empty($search_data)) {
        	!empty($search_data['section_title']) ? $data['section_title'] = $search_data['section_title'] : "";
            !empty($search_data['username']) ? $data['users.username'] = $search_data['username'] : "";
            !empty($search_data['student_uni_id']) ? $data['users.student_uni_id'] = $search_data['student_uni_id'] : "";
            !empty($search_data['first_name']) ? $data['users.first_name'] = $search_data['first_name'] : ""; 
            !empty($search_data['campus']) ? $data['users.campus'] = $search_data['campus'] : "";
            !empty($search_data['email']) ? $data['users.email'] = $search_data['email'] : "";
            !empty($search_data['primary_teacher_id']) ? $data['primary_teacher_id'] = $search_data['primary_teacher_id'] : "";
			!empty($search_data['academic_status']) ? $data['users.academic_status'] = $search_data['academic_status'] : "";
			!empty($search_data['course_section.track']) ? $data['course_section.track'] = $search_data['course_section.track'] : "";
			!empty($search_data['course_section.buildings']) ? $data['course_section.buildings'] = $search_data['course_section.buildings'] : "";
        }
       
        $this->db->select('users.*,DATE_FORMAT(users.student_schedule_date,"%a %D, %b, %Y ") AS stu_schedule_date, user_roll.user_roll_name as role_name,course_section.section_title,course_section.track AS section_track,course_section.buildings AS section_buildings,class_room_title,courses.course_title,IF(course_class.shift = "AM",courses.start_time,courses.pm_start_time) AS start_time,IF(course_class.shift = "AM",courses.end_time,courses.pm_end_time) AS end_time,course_class.shift AS courses_shift,
						  campus_name,
						  CONCAT_WS(" ",p1.first_name,p1.middle_name,p1.middle_name2,p1.last_name) AS pname,
						  CONCAT_WS(" ",s1.first_name,s1.middle_name,s1.middle_name2,s1.last_name) AS sname,course_section.section_shift,course_section.section_time',FALSE);
        $this->db->from('users');  
        $this->db->join('school_campus','users.campus_id=school_campus.campus_id','left');  
        $this->db->join('course_class','users.section_id=course_class.section_id','left');  
		$this->db->join('courses','courses.course_id=course_class.course_id AND courses.camps_id=course_class.camps_id','left');  
		$this->db->join('course_class_room','course_class_room.class_room_id=course_class.class_room_id','left');  
        $this->db->join('users AS p1','p1.user_id=course_class.primary_teacher_id','left');  
        $this->db->join('users AS s1','s1.user_id=course_class.secondary_teacher_id','left');  
		$this->db->where('users.user_roll_id','4');        
		$this->db->where('users.discontinue != "inactive"');
		if($campus_id > 0) {
			$this->db->where('users.campus_id = '.$campus_id);
		}	
		if($this->session->userdata('ca_lead_teacher') > 0)
		{
			$this->db->where('course_section.ca_lead_teacher',$this->session->userdata('ca_lead_teacher'));
		}
		
		if(count($arrCampusPrivilages) > 0)
		{	
			$this->db->where_in('users.campus_id',$arrCampusPrivilages);
		}
		
        $this->db->join('user_roll', 'user_roll.user_roll_id = users.user_roll_id');
		
		if($showall == 1)
			$this->db->join('course_section', 'course_section.section_id = users.section_id','left');
		else	
			$this->db->join('course_section', 'course_section.section_id = users.section_id');
			
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
		if($user_role == '3'){
		
			$this->db->where('course_class.primary_teacher_id',$user_id);        
		}
        $this->db->order_by($order_by, $sort_order);
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
		if($query->num_rows() > 0) {
            return $query;
        }
    }
	
	public function get_sec_teacher_course_class_student($limit = 0, $offset = 0, $order_by = "username", $sort_order = "asc", $sec_teacher=0,$search_data) {
		$arrCampusPrivilages = get_user_campus_privilages();
        $fields = $this->db->list_fields('users'); 

        if (!empty($search_data)) {
        	!empty($search_data['section_title']) ? $data['section_title'] = $search_data['section_title'] : "";
            !empty($search_data['username']) ? $data['username'] = $search_data['username'] : "";
            !empty($search_data['student_uni_id']) ? $data['student_uni_id'] = $search_data['student_uni_id'] : "";
            !empty($search_data['first_name']) ? $data['first_name'] = $search_data['first_name'] : ""; 
            !empty($search_data['secondary_teacher_id']) ? $data['secondary_teacher_id'] = $search_data['secondary_teacher_id'] : "";
        }
       
        $this->db->select('users.*, user_roll.user_roll_name as role_name,course_section.section_title');
        $this->db->from('users');  
		$this->db->join('user_roll', 'user_roll.user_roll_id = users.user_roll_id');
        $this->db->join('course_section', 'course_section.section_id = users.section_id');
		$this->db->join('course_class', 'course_class.section_id = course_section.section_id');
		$this->db->where('users.user_roll_id','4');        
		$this->db->where('users.discontinue != "inactive"');
		
		if($this->session->userdata('ca_lead_teacher') > 0)
		{
			$this->db->where('course_section.ca_lead_teacher',$this->session->userdata('ca_lead_teacher'));
		}
		
		if(count($arrCampusPrivilages) > 0)
		{	
			$this->db->where_in('users.campus_id',$arrCampusPrivilages);
		}
		
		if($sec_teacher > 0)
			$this->db->where('secondary_teacher_id',$sec_teacher);     
			
		!empty($data) ? $this->db->or_like($data) : "";	
        $this->db->order_by($order_by, $sort_order);
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query;
        }
    }
    /**
     *
     * count_all_members: count all members in the table
     *
     *
     */
    
    public function count_all_teacher_members()
    {
		$arrCampusPrivilages = get_user_campus_privilages();
    	$this->db->from('users');     
		$this->db->join('course_class','users.user_id = course_class.primary_teacher_id','left');  
        $this->db->join('course_section','course_class.section_id = course_section.section_id','left');  
    	$this->db->where('users.user_roll_id','3');     
		
		if($this->session->userdata('ca_lead_teacher') > 0)
		{
			$this->db->where('course_section.ca_lead_teacher',$this->session->userdata('ca_lead_teacher'));
		}
		
		if(count($arrCampusPrivilages) > 0)
		{	
			$this->db->where_in('users.campus_id',$arrCampusPrivilages);
		}
		
        return $this->db->count_all_results();
    }
    
    public function count_all_teacher_mem($search_data)
    {
		//$isLineManager =  isLineManager();
		$arrCampusPrivilages = get_user_campus_privilages();
    	if (!empty($search_data)) {
            !empty($search_data['username']) ? $data['users.username'] = $search_data['username'] : "";
            !empty($search_data['staff_name']) ? $data['CONCAT_WS("",trim(users.first_name),trim(users.middle_name),trim(users.middle_name2),trim(users.last_name))'] = str_replace(" ","",trim($search_data['staff_name'])) : "";
			!empty($search_data['ca_lead_teacher']) ? $data['ca_lead.first_name'] = $search_data['ca_lead_teacher'] : "";
			!empty($search_data['section_title']) ? $data['course_section.section_title'] = $search_data['section_title'] : "";
            !empty($search_data['elsd_id']) ? $data['users.elsd_id'] = $search_data['elsd_id'] : "";
            !empty($search_data['email']) ? $data['users.email'] = $search_data['email'] : "";
            !empty($search_data['user_roll_name']) ? $data['user_roll_name'] = $search_data['user_roll_name'] : "";
            !empty($search_data['name_suffix']) ? $data['users.name_suffix'] = $search_data['name_suffix'] : "";
            !empty($search_data['address1']) ? $data['users.address1'] = $search_data['address1'] : "";
            !empty($search_data['city']) ? $data['users.city'] = $search_data['city'] : "";
            !empty($search_data['state']) ? $data['users.state'] = $search_data['state'] : "";
            !empty($search_data['zip']) ? $data['users.zip'] = $search_data['zip'] : "";
            !empty($search_data['cell_phone']) ? $data['users.cell_phone'] = $search_data['cell_phone'] : "";
            !empty($search_data['campus_name']) ? $data['campus_name'] = $search_data['campus_name'] : "";
        }
        $this->db->select('users.elsd_id,
						  CONCAT_WS(" ",users.first_name,users.middle_name,users.middle_name2,users.last_name) AS staff_name,
						  school_campus.campus_name,
						  users.username,
						  users.email,
						  users.user_id
						 ',FALSE);
    	$this->db->from('users');
		$this->db->join('user_profile', 'user_profile.user_id = users.user_id','left');
		$this->db->join('course_class','users.user_id = course_class.primary_teacher_id','left');  
        $this->db->join('course_section','course_class.section_id = course_section.section_id','left');
		$this->db->join('school_campus', 'school_campus.campus_id = users.campus_id','left');
		$this->db->join('user_roll', 'user_roll.user_roll_id = users.user_roll_id','left');
		$this->db->join('contractors', 'contractors.id = user_profile.contractor','left');
		$this->db->where('users.user_roll_id','3');
		
		if($this->session->userdata('ca_lead_teacher') > 0)
		{
			$this->db->where('course_section.ca_lead_teacher',$this->session->userdata('ca_lead_teacher'));
		}
		
		if(count($arrCampusPrivilages) > 0)
		{	
			$this->db->where_in('users.campus_id',$arrCampusPrivilages);
		}
		
    	!empty($data) ? $this->db->like($data) : "";
		
		/*if($this->session->userdata('role_id') != 1 && $isLineManager == 1){
			$this->db->where('users.coordinator',$this->session->userdata('user_id'));
		}*/
		
		if($this->session->userdata('role_id') > 4 && $this->session->userdata('contractor') > 1){
			$this->db->where('user_profile.contractor',$this->session->userdata('contractor'));
		}
		
		if(!empty($data))
        {
        	$str_data_or_like = "";
        	foreach($data AS $data_key=>$data_val)
        	{
        		$str_data_or_like .= " $data_key LIKE '%$data_val%' OR ";	
        	}
        	$str_data_or_like = trim(trim($str_data_or_like),"OR");
        	
        	if($str_data_or_like != "")
        		$this->db->where("(".$str_data_or_like.")", null, false);
        }
		$this->db->group_by(array("users.user_id"));
		$query = $this->db->get();
        
        return $query->num_rows();
    }
    
    public function count_all_other_mem($search_data)
    {
    	$this->db->from('users');
    	$this->db->join('user_roll', 'user_roll.user_roll_id = users.user_roll_id','left');
		$this->db->join('user_profile', 'user_profile.user_id = users.user_id','left');
    	$this->db->where_not_in('users.user_roll_id',array('1','2','3'));
    	$this->db->where_not_in('users.status',array('1'));
    	!empty($search_data) ? $this->db->like($search_data) : "";
    	return $this->db->count_all_results();
    }
    
    public function count_all_student_mem($search_data,$showall=0)
    {
		$arrCampusPrivilages = get_user_campus_privilages();
		$user_id = $this->session->userdata('user_id');
		$user_role = $this->session->userdata('role_id');
		
    	if (!empty($search_data)) {
        	!empty($search_data['section_title']) ? $data['section_title'] = $search_data['section_title'] : "";
        	!empty($search_data['grade_section_title']) ? $data['grade_section_title'] = $search_data['grade_section_title'] : "";
            !empty($search_data['username']) ? $data['users.username'] = $search_data['username'] : "";
            !empty($search_data['student_uni_id']) ? $data['users.student_uni_id'] = $search_data['student_uni_id'] : "";
            !empty($search_data['grade_student_uni_id']) ? $data['grade_student_uni_id'] = $search_data['grade_student_uni_id'] : "";
            !empty($search_data['first_name']) ? $data['users.first_name'] = $search_data['first_name'] : ""; 
            !empty($search_data['campus']) ? $data['campus_name'] = $search_data['campus'] : "";
            !empty($search_data['secondary_teacher_id']) ? $data['secondary_teacher_id'] = $search_data['secondary_teacher_id'] : "";
            !empty($search_data['primary_teacher_id']) ? $data['primary_teacher_id'] = $search_data['primary_teacher_id'] : "";
			!empty($search_data['academic_status']) ? $data['users.academic_status'] = $search_data['academic_status'] : "";
			!empty($search_data['course_section.track']) ? $data['course_section.track'] = $search_data['course_section.track'] : "";
			!empty($search_data['course_section.buildings']) ? $data['course_section.buildings'] = $search_data['course_section.buildings'] : "";
        }
       
    	$this->db->select('*, user_roll.user_roll_name as role_name,course_section.section_title');
    	$this->db->from('users');     
    	$this->db->join('user_roll', 'user_roll.user_roll_id = users.user_roll_id');
		if($showall == 1)
			$this->db->join('course_section', 'course_section.section_id = users.section_id','left');
		else	
			$this->db->join('course_section', 'course_section.section_id = users.section_id');
			
		$this->db->join('school_campus','users.campus_id=school_campus.campus_id','left'); 	
		$this->db->join('course_class','users.section_id=course_class.section_id','left');  
        $this->db->join('users AS p1','p1.user_id=course_class.primary_teacher_id','left');  
    	$this->db->where('users.user_roll_id','4');
		$this->db->where('users.discontinue != "inactive"');
		
		if($this->session->userdata('ca_lead_teacher') > 0)
		{
			$this->db->where('course_section.ca_lead_teacher',$this->session->userdata('ca_lead_teacher'));
		}
		
		if(count($arrCampusPrivilages) > 0)
		{	
			$this->db->where_in('users.campus_id',$arrCampusPrivilages);
		}
		
    	if(!empty($data))
        {
			$filter_selection = " AND ";
			if(isset($search_data["global_search"]) && $search_data["global_search"] == 1)
				$filter_selection = " OR ";
				
        	$str_data_or_like = "";
        	foreach($data AS $data_key=>$data_val)
        	{
				if($data_key == "grade_student_uni_id")
				{
					$str_data_or_like .= " users.student_uni_id = '$data_val'".$filter_selection;	
				}
				else if($data_key == "grade_section_title")
				{
					$str_data_or_like .= " section_title = '$data_val'".$filter_selection;	
				}
				else
				{
					$str_data_or_like .= " $data_key LIKE '%$data_val%'".$filter_selection;	
				}
        	}
        	$str_data_or_like = trim(trim($str_data_or_like),$filter_selection);
        	
        	if($str_data_or_like != "")
        		$this->db->where("(".$str_data_or_like.")", null, false);
        }
		if($user_role == '3'){
		
			$this->db->where('course_class.primary_teacher_id',$user_id);        
		}
    	return $this->db->count_all_results();
    }
	
	 public function count_all_sec_teacher_course_class_student($sec_teacher=0,$search_data)
    {
		$arrCampusPrivilages = get_user_campus_privilages();
    	$this->db->select('*, user_roll.user_roll_name as role_name,course_section.section_title');
    	$this->db->from('users');     
    	$this->db->join('user_roll', 'user_roll.user_roll_id = users.user_roll_id');
    	$this->db->join('course_section', 'course_section.section_id = users.section_id');
		$this->db->join('course_class', 'course_class.section_id = course_section.section_id');
    	$this->db->where('users.user_roll_id','4');
    	$this->db->where('users.discontinue != "inactive"');
		
		if($this->session->userdata('ca_lead_teacher') > 0)
		{
			$this->db->where('course_section.ca_lead_teacher',$this->session->userdata('ca_lead_teacher'));
		}
		
		if(count($arrCampusPrivilages) > 0)
		{	
			$this->db->where_in('users.campus_id',$arrCampusPrivilages);
		}
		
		if($sec_teacher > 0)
		{
			$this->db->where('secondary_teacher_id',$sec_teacher); 
		}
		!empty($search_data) ? $this->db->or_like($search_data) : "";
    	return $this->db->count_all_results();
    }
    
    public function count_all_student_members($search_data)
    {
		 if (!empty($search_data)) {
            !empty($search_data['username']) ? $data['username'] = $search_data['username'] : "";
            !empty($search_data['student_uni_id']) ? $data['student_uni_id'] = $search_data['student_uni_id'] : "";
            !empty($search_data['first_name']) ? $data['first_name'] = $search_data['first_name'] : "";
            !empty($search_data['email']) ? $data['email'] = $search_data['email'] : "";
        }
    	$this->db->from('users');     
    	$this->db->where('users.user_roll_id','4');   
		!empty($data) ? $this->db->or_like($data) : "";
        return $this->db->count_all_results();
    }

    /**
     *
     * update_member: update member data
     *
     * @param int $id the member id
     * @param string $username the member username
     * @param string $email the member e-mail address
     * @param string $first_name the member first name
     * @param bool $change_username do we want to change the username?
     * @param bool $change_email do we want to change the user e-mail?
     * @return mixed
     *
     */

	 public function update_member($id, $username, $email, $first_name, $middle_name, $name_suffix,$address1,$address2,$city,$state,$zip,$birth_date,$birth_place,$gender,$language_known,$work_phone,$home_phone,$cell_phone,$change_username = false, $change_email = false,$section_id=0,$student_uni_id=0) {
        // if there are more fields you can turn the data into an array. The reason I don't do this is because it's an extra array in controller List_members.

        $data = array(
                'user_id'       => $id,
                'first_name'    => $first_name,
				'middle_name'	=> $middle_name,
				'name_suffix'   => $name_suffix,
				'address1'      => $address1,
				'address2'      => $address2,
				'city'          => $city,
				'state'         => $state,
				'zip'           => $zip,
				'birth_date'    => $birth_date,
				'birth_place'   => $birth_place,
				'gender'        => $gender,
				'language_known'=> $language_known,
				'work_phone'    => $work_phone,
				'home_phone'    => $home_phone,
				'section_id'    => $section_id 	,
				'student_uni_id'=> $student_uni_id,
				'cell_phone'    => $cell_phone);

        if ($change_username) {
            $data['username'] = $username;
        }
        if ($change_email) {
            $data['email'] = $email;
        }
        $this->db->where('user_id', $id);
        $this->db->update('users', $data);

        
        //Get Course class id
        $this->db->select('course_class_id,primary_teacher_id');
        $this->db->from('course_class');
        $this->db->where('section_id',$section_id);
        $query_course_class = $this->db->get();
        //End here
        
        //Update attendance report table
        if($query_course_class){
        	foreach ($query_course_class->result() as $course_class ):
        		$course_class_id = $course_class->course_class_id;
        		$primary_teacher_id = $course_class->primary_teacher_id;
        		$data_attend = array(
        			'course_class_id' => $course_class_id,
        			'teacher_id' => $primary_teacher_id);
        		$this->db->where('student_id', $id);
        		$this->db->update('attendance_report', $data_attend);
        	endforeach;
        }
        //End here
        
        if($this->db->affected_rows() == 1) {
            return true;
        }
        return false;
    }

    /**
     *
     * delete_member: count all members in the table
     *
     * @param int $id the member id
     * @return boolean
     *
     */

    public function delete_member($id) {
        $this->db->where('user_id', $id);
        $this->db->delete('users');
        if($this->db->affected_rows() == 1) {
            return true;
        }
        return false;
    }

    /**
     *
     * get_username_by_id: return username by id
     *
     * @param int $id the member id
     * @return mixed
     *
     */

    public function get_username_by_id($id) {
        $this->db->select('username')->from('users')->where('user_id', $id);
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            $row = $query->row();
            return $row->username;
        }
        return "";
    }

    

    /**
     *
     * count_all_search_members: count all members when performing search
     *
     * @param string $username the member username
     * @param string $first_name the member first name
     * @param string $last_name the member last name
     * @param string $email the member e-mail address 
     * @return mixed
     *
     */

    public function count_all_teacher_search_members($search_data) {
		$arrCampusPrivilages = get_user_campus_privilages();
        $data = array();
        !empty($search_data['username']) ? $data['username'] = $search_data['username'] : "";
        !empty($search_data['first_name']) ? $data['first_name'] = $search_data['first_name'] : "";
        !empty($search_data['last_name']) ? $data['last_name'] = $search_data['last_name'] : "";
        !empty($search_data['email']) ? $data['email'] = $search_data['email'] : "";

        $this->db->select('users.user_id, users.username, users.email, users.first_name, users.last_name, user_roll.user_roll_name');
        $this->db->from('users');
		$this->db->join('course_class','users.user_id = course_class.primary_teacher_id','left');  
        $this->db->join('course_section','course_class.section_id = course_section.section_id','left'); 
        $this->db->where('users.user_roll_id','3'); 
		
		if($this->session->userdata('ca_lead_teacher') > 0)
		{
			$this->db->where('course_section.ca_lead_teacher',$this->session->userdata('ca_lead_teacher'));
		}
		
		if(count($arrCampusPrivilages) > 0)
		{	
			$this->db->where_in('users.campus_id',$arrCampusPrivilages);
		}
		
        $this->db->join('user_roll', 'user_roll.user_roll_id = users.user_roll_id');
        !empty($data) ? $this->db->or_like($data) : "";
        $this->db->order_by("users.user_id", "asc");
        return $this->db->count_all_results();
    }

    public function count_all_student_search_members($search_data) {
        $data = array();
        !empty($search_data['username']) ? $data['username'] = $search_data['username'] : "";
        !empty($search_data['first_name']) ? $data['first_name'] = $search_data['first_name'] : "";
        !empty($search_data['student_uni_id']) ? $data['student_uni_id'] = $search_data['student_uni_id'] : "";
        !empty($search_data['email']) ? $data['email'] = $search_data['email'] : "";

        $this->db->select('users.user_id, users.username, users.email, users.first_name, users.last_name, user_roll.user_roll_name');
        $this->db->from('users');
        $this->db->where('users.user_roll_id','4'); 
        $this->db->join('user_roll', 'user_roll.user_roll_id = users.user_roll_id');
        !empty($data) ? $this->db->or_like($data) : "";
        $this->db->order_by("users.user_id", "asc");
        return $this->db->count_all_results();
    }
    
    

    /**
     *
     * toggle_active: (de)activate member
     *
     * @param int $id the member id
     * @param string $active activate or deactivate?
     * @return boolean
     *
     */

    public function toggle_active($id, $active) {
        $data = array('active' => ($active ? '0' : '1'));
        $this->db->where('user_id', $id);
        $this->db->update('users', $data);                  
        if($this->db->affected_rows() == 1) {
            return true;
        }
        return false;

    }
    
    public function get_student_data($user_id){
    	
		$this->db->select('users.*,course_section.section_title,course_section.track AS section_track,course_section.buildings AS section_buildings,class_room_title,courses.course_title,course_class.shift AS courses_shift,course_class.shift,course_class.shift,course_class.start_time,course_class.end_time,course_section.section_shift,course_section.section_time',FALSE);
        $this->db->from('users');  
        $this->db->join('course_class','users.section_id=course_class.section_id','left');  
		$this->db->join('courses','courses.course_id=course_class.course_id','left');  
		$this->db->join('course_class_room','course_class_room.class_room_id=course_class.class_room_id','left');  
        $this->db->join('course_section', 'course_section.section_id = users.section_id','left');
		$this->db->where('users.user_id', $user_id);
		
    	$query = $this->db->get();
    	if($query->num_rows() == 1) {
    		$row = $query->row();
    		return $row;
    	}
    	return false;
    } 
	
	public function get_student_data_uni_id($student_uni_id){
    	$this->db->select('*')->from('users')->where('student_uni_id', $student_uni_id)->where('user_roll_id', 4)->limit('1');
    	$query = $this->db->get();
    	
    	if($query->num_rows() == 1) {
    		$row = $query->row();
    		return $row;
    	}
    	return false;
    } 
    
    public function get_teacher_data($user_id,$elsd_id=""){
		$this->db->select('*');
		$this->db->from('users');
		if($elsd_id != "")
			$this->db->where('users.elsd_id', $elsd_id);
		else
			$this->db->where('users.user_id', $user_id);
		
		$this->db->join('user_profile', 'user_profile.user_id = users.user_id','left');	
    	$query = $this->db->get();
		
    	if($query->num_rows() == 1) {
    		$row = $query->row();
    		return $row;
    	}
    	return false;
    }

	public function section_update_log($id) {
		
		$user_id = $this->session->userdata('user_id');
		$change_date = date('Y-m-d H:i:s');
		
		$sql = "insert into users_log(`user_id`, `user_roll_id`, `username`, `password`, `section_id`, `section_title_name`, `email`, `student_uni_id`, `track`, `schedule_date`, `academic_status`, `first_name`, `first_name_arabic`, `middle_name`, `last_name`, `name_suffix`, `address1`, `address2`, `city`, `state`, `zip`, `birth_date`, `birth_place`, `gender`, `language_known`, `work_phone`, `home_phone`, `cell_phone`, `last_login_date`, `login_attempts`, `profile_picture`, `nonce`, `elsd_id`, `coordinator`, `ca_lead_teacher`, `campus`, `campus_id`, `created_date`, `updated_date`, `active`, `discontinue`, `discontinue_date`, `discontinue_week_id`,`change_by`, `change_date`)

SELECT `user_id`, `user_roll_id`, `username`, `password`, `section_id`, `section_title_name`, `email`, `student_uni_id`, `track`, `schedule_date`, `academic_status`, `first_name`, `first_name_arabic`, `middle_name`, `last_name`, `name_suffix`, `address1`, `address2`, `city`, `state`, `zip`, `birth_date`, `birth_place`, `gender`, `language_known`, `work_phone`, `home_phone`, `cell_phone`, `last_login_date`, `login_attempts`, `profile_picture`, `nonce`, `elsd_id`, `coordinator`, `ca_lead_teacher`, `campus`, `campus_id`, `created_date`, `updated_date`, `active`, `discontinue`, `discontinue_date`, `discontinue_week_id`,$user_id,'$change_date' FROM `users` WHERE user_id =$id";
		$this->db->query($sql);
		$last_log_id =  $this->db->insert_id();  
		
		$user_id = $this->session->userdata('user_id');
        $data = array('change_by' => $user_id,'change_date' => date('Y-m-d H:i:s'));
        $this->db->where('user_id', $id);
        $this->db->update('users', $data);
        
        if($this->db->affected_rows() == 1) {
            return $last_log_id;
        }
        return false;

    }
	
	public function teacher_section_update_log($id,$section_id) {
		$user_id = $this->session->userdata('user_id');
		$change_date = date('Y-m-d H:i:s');
		$id = (int)$id;
		$sql = "insert into users_log(`user_id`, `user_roll_id`, `username`, `password`, `section_id`, `section_title_name`, `email`, `student_uni_id`, `track`, `schedule_date`, `academic_status`, `first_name`, `first_name_arabic`, `middle_name`, `last_name`, `name_suffix`, `address1`, `address2`, `city`, `state`, `zip`, `birth_date`, `birth_place`, `gender`, `language_known`, `work_phone`, `home_phone`, `cell_phone`, `last_login_date`, `login_attempts`, `profile_picture`, `nonce`, `elsd_id`, `coordinator`, `ca_lead_teacher`, `company`, `campus`, `campus_id`, `created_date`, `updated_date`, `active`, `discontinue`, `discontinue_date`, `discontinue_week_id`,`change_by`, `change_date`)

SELECT `user_id`, `user_roll_id`, `username`, `password`, $section_id, `section_title_name`, `email`, `student_uni_id`, `track`, `schedule_date`, `academic_status`, `first_name`, `first_name_arabic`, `middle_name`, `last_name`, `name_suffix`, `address1`, `address2`, `city`, `state`, `zip`, `birth_date`, `birth_place`, `gender`, `language_known`, `work_phone`, `home_phone`, `cell_phone`, `last_login_date`, `login_attempts`, `profile_picture`, `nonce`, `elsd_id`, `coordinator`, `ca_lead_teacher`, `company`, `campus`, `campus_id`, `created_date`, `updated_date`, `active`, `discontinue`, `discontinue_date`, `discontinue_week_id`,$user_id,'$change_date' FROM `users` WHERE user_id =$id";
		$this->db->query($sql);
		$last_log_id =  $this->db->insert_id();
		

		$user_id = $this->session->userdata('user_id');
        $data = array('change_by' => $user_id,'change_date' => date('Y-m-d H:i:s'));
        $this->db->where('user_id', $id);
        $this->db->update('users', $data);
        return $last_log_id;          
    }
	function get_user_log($user_id,$limit = 0){
		$this->db->select('section_title,users.first_name,users_log.reason,DATE_FORMAT(users_log.change_date,"%Y-%m-%d") as change_date',false);
		$this->db->from('users_log');
		$this->db->join('users', 'users.user_id = users_log.change_by','left');
		$this->db->join('course_section', 'course_section.section_id = users_log.section_id','left');
		$this->db->where('users_log.user_id', $user_id);
		$this->db->where('users_log.profile_update', 0);
		$this->db->order_by('users_log.change_date', 'DESC');
		if($limit > 0)
			$this->db->limit($limit);		
    	$query = $this->db->get();
    	//echo $this->db->last_query();
		
    	return $query;
	}
	function get_teacher_log($user_id,$limit = 0){
		$this->db->select('users_log.*,section_title,users.first_name,users_log.reason,DATE_FORMAT(users_log.change_date,"%Y-%m-%d") as change_date,old_campus_t.campus_name as campus_id,new_campus_t.campus_name as campus_id_new,CONCAT_WS(" ",old_coordinator_t.first_name,old_coordinator_t.last_name) AS coordinator,CONCAT_WS(" ",new_coordinator_t.first_name,new_coordinator_t.last_name) AS coordinator_new',false);
		$this->db->from('users_log');
		$this->db->join('users', 'users.user_id = users_log.change_by','left');
		$this->db->join('course_section', 'course_section.section_id = users_log.section_id','left');
		$this->db->join('school_campus old_campus_t', 'old_campus_t.campus_id = users_log.campus_id','left');
		$this->db->join('school_campus new_campus_t', 'new_campus_t.campus_id = users_log.campus_id_new','left');
		$this->db->join('users old_coordinator_t', 'old_coordinator_t.user_id = users_log.coordinator','left');
		$this->db->join('users new_coordinator_t', 'new_coordinator_t.user_id = users_log.coordinator_new','left');
		$this->db->where('users_log.user_id', $user_id);
		$this->db->where('users_log.profile_update', 0);
		$this->db->order_by('users_log.change_date', 'DESC');
		if($limit > 0)
			$this->db->limit($limit);		
    	$query = $this->db->get();
    	//echo $this->db->last_query();
		
    	return $query;
	}
	
	
	public function teacher_course_class_log($id,$value,$change_field) {
		$user_id = $this->session->userdata('user_id');
		$change_date = date('Y-m-d H:i:s');
		$id = (int)$id;
		
		$section_id = 0;
		$primary_teacher_id = 0;
		$secondary_teacher_id = 0;
		$class_room_id = 0;
		$course_id = 0;
		$shift = '';
		
		if($change_field == 'section_id'){
   			$section_id = $value;
		}
		else if($change_field == 'primary_teacher_id'){
			$primary_teacher_id = $value;
		}
		else if($change_field == 'secondary_teacher_id'){
			$secondary_teacher_id = $value;
		}
		else if($change_field == 'class_room_id'){
			$class_room_id = $value;
		}
		else if($change_field == 'course_id'){
			$course_id = $value;
		}
		else if($change_field == 'shift'){
			$shift = $value;
		}
		else if($change_field != "")
		{
			$arrChangedField = explode(",",$change_field);
			$arrChangedValue = explode(",",$value);
			
			foreach($arrChangedField AS $key=>$change_field_val)
			{
				if($change_field_val == 'section_id' && isset($arrChangedValue[$key])){
					$section_id = $arrChangedValue[$key];
				}
				if($change_field_val == 'primary_teacher_id' && isset($arrChangedValue[$key])){
					$primary_teacher_id = $arrChangedValue[$key];
				}
				if($change_field_val == 'secondary_teacher_id' && isset($arrChangedValue[$key])){
					$secondary_teacher_id = $arrChangedValue[$key];
				}
				if($change_field_val == 'class_room_id' && isset($arrChangedValue[$key])){
					$class_room_id = $arrChangedValue[$key];
				}
				if($change_field_val == 'course_id' && isset($arrChangedValue[$key])){
					$course_id = $arrChangedValue[$key];
				}
				if($change_field_val == 'shift' && isset($arrChangedValue[$key])){
					$shift = $arrChangedValue[$key];
				}
			}
		}
		else
		{
			return;
		}
		
		$sql = "INSERT INTO `course_class_log` (`course_class_id`, 
		`course_id`,`course_id_new`, `category_id`, `school_year_id`, `school_id`, 
		`primary_teacher_id`, 
		`primary_teacher_id_new`, 
		`secondary_teacher_id`, 
		`secondary_teacher_id_new`, 
		`class_room_id`, 
		`class_room_id_new`, 
		`section_id`,`section_id_new`, `start_time`, `end_time`, 
		`shift`,`shift_new`, `total_seats`, `registered_student`, `credits`, `restricted_hours`, `is_active`, `change_by`, `change_date`,change_field)

SELECT  `course_class_id`, `course_id`,'$course_id', `category_id`, `school_year_id`, `school_id`, `primary_teacher_id`,'$primary_teacher_id', `secondary_teacher_id`,'$secondary_teacher_id', `class_room_id`,'$class_room_id', `section_id`,'$section_id', `start_time`, `end_time`, `shift`,'$shift', `total_seats`, `registered_student`, `credits`, `restricted_hours`, `is_active` ,$user_id,'$change_date','$change_field' FROM `course_class` WHERE course_class_id =$id";
		$this->db->query($sql);
		$last_log_id =  $this->db->insert_id();
		return $last_log_id;
    }
	
	public function get_course_class_log($id,$limit=0){
		$this->db->select('course_class_log.reason,DATE_FORMAT(course_class_log.change_date,"%d-%b-%Y") as change_date,CONCAT_WS(" ",trim(ch1.first_name),trim(ch1.last_name)) AS cname,CONCAT_WS(" ",trim(p1.first_name),trim(p1.last_name)) AS pname,CONCAT_WS(" ",trim(pn1.first_name),trim(pn1.last_name)) AS pname_new,CONCAT_WS(" ",trim(p2.first_name),trim(p2.last_name)) AS sname,CONCAT_WS(" ",trim(pn2.first_name),trim(pn2.last_name)) AS sname_new,c1.course_title,cn1.course_title AS course_title_new,cs1.section_title,csn1.section_title AS section_title_new,course_class_log.shift,shift_new,cr1.class_room_title,crn1.class_room_title AS class_room_title_new,change_field',false);
		$this->db->from('course_class_log');
		$this->db->join('users AS ch1', 'ch1.user_id = course_class_log.change_by','left');
		$this->db->join('users AS p1', 'p1.user_id = course_class_log.primary_teacher_id','left');
		$this->db->join('users AS pn1', 'pn1.user_id = course_class_log.primary_teacher_id_new','left');
		$this->db->join('users AS pn2', 'pn2.user_id = course_class_log.secondary_teacher_id_new','left');
		$this->db->join('users AS p2', 'p2.user_id = course_class_log.secondary_teacher_id','left');
		$this->db->join('courses AS c1', 'c1.course_id = course_class_log.course_id','left');
		$this->db->join('courses AS cn1', 'cn1.course_id = course_class_log.course_id_new','left');
		$this->db->join('course_section AS cs1', 'cs1.section_id = course_class_log.section_id','left');
		$this->db->join('course_section AS csn1', 'csn1.section_id = course_class_log.section_id_new','left');
		$this->db->join('course_class_room AS cr1', 'cr1.class_room_id = course_class_log.class_room_id','left');
		$this->db->join('course_class_room AS crn1', 'crn1.class_room_id = course_class_log.class_room_id_new','left');
		$this->db->where('course_class_log.course_class_id', $id);
		$this->db->order_by('course_class_log.course_class_log_id', 'DESC');		
		if($limit > 0)
			$this->db->limit($limit);
			
    	$query = $this->db->get();
    			
    	return $query;
	}
	
	function set_campus_name(){
		$sql = "update users 
				join school_campus on (users.campus_id=school_campus.campus_id) 
				set campus = school_campus.campus_name 
				";
		$this->db->query($sql);
	}
	
	function set_student_log($reason,$last_log_id){
		$query = "UPDATE `users_log` SET `reason` = '$reason' WHERE `user_log_id` ='$last_log_id';";
		$this->db->query($query);
	}
	
	function get_week_activation_time(){
		$this->db->select('*');
		$this->db->from('attendance_week_activation_time');
		return $this->db->get();
	}
	
	function get_enable_week($activate_time){
		$this->db->select('*');
		$this->db->from('enable_school_week');
		$this->db->where('school_year_id',1);
		$this->db->where('CONCAT(last_date," '.$activate_time.'") <= NOW()');
		$this->db->order_by('week_id', 'ASC');
		$data_enableweek = $this->db->get();
		return $data_enableweek->result();
	}
	
	function get_grade_setting(){
		$query = "SELECT show_total_grade,show_grade_range FROM school";
		return $this->db->query($query);
	}
	
	function get_grade_range(){
		$query = "SELECT * FROM grade_range";
		return $this->db->query($query);
	}
	
	public function get_email_export($campus_id) {
		$arrCampusPrivilages = get_user_campus_privilages();
		$search_data = $this->session->userdata('export_var');
		
        if (!empty($search_data)) {
            !empty($search_data['username']) ? $data['users.username'] = $search_data['username'] : "";
            !empty($search_data['staff_name']) ? $data['staff_name'] = str_replace(" ","",trim($search_data['staff_name'])) : "";
			!empty($search_data['coordinator']) ? $data['CONCAT_WS("",trim(l.first_name),trim(l.last_name))'] = str_replace(" ","",trim($search_data['coordinator'])) : "";
            !empty($search_data['ca_lead_teacher']) ? $data['ca_lead.first_name'] = $search_data['ca_lead_teacher'] : "";
            !empty($search_data['section_title']) ? $data['course_section.section_title'] = $search_data['section_title'] : "";
            !empty($search_data['elsd_id']) ? $data['users.elsd_id'] = $search_data['elsd_id'] : "";
			!empty($search_data['contractor']) ? $data['contractors.contractor'] = $search_data['contractor'] : "";
            !empty($search_data['email']) ? $data['users.email'] = $search_data['email'] : "";
            !empty($search_data['user_roll_name']) ? $data['user_roll_name'] = $search_data['user_roll_name'] : "";
            !empty($search_data['name_suffix']) ? $data['users.name_suffix'] = $search_data['name_suffix'] : "";
            !empty($search_data['address1']) ? $data['users.address1'] = $search_data['address1'] : "";
            !empty($search_data['city']) ? $data['users.city'] = $search_data['city'] : "";
            !empty($search_data['state']) ? $data['users.state'] = $search_data['state'] : "";
            !empty($search_data['zip']) ? $data['users.zip'] = $search_data['zip'] : "";
            !empty($search_data['cell_phone']) ? $data['users.cell_phone'] = $search_data['cell_phone'] : "";
            !empty($search_data['campus_name']) ? $data['campus_name'] = $search_data['campus_name'] : "";
        }
		
    	$this->db->select('users.email',FALSE);
    	$this->db->from('users');
		$this->db->join('user_profile', 'user_profile.user_id = users.user_id','left');
		$this->db->join('school_campus', 'school_campus.campus_id = users.campus_id','left');
		$this->db->join('user_roll', 'user_roll.user_roll_id = users.user_roll_id','left');
		$this->db->join('contractors', 'contractors.id = user_profile.contractor','left');
		$this->db->join('users l', 'l.user_id = users.coordinator','left');
		$this->db->where('users.email != ""');
		$this->db->where('(users.user_roll_id = 3 OR (users.user_roll_id = 5 AND user_profile.job_title = 5))');
		$this->db->where_in('users.status',array(13));
		
		if(count($arrCampusPrivilages) > 0)
		{	
			$this->db->where_in('users.campus_id',$arrCampusPrivilages);
		}

		if(!empty($data))
        {
			$filter_selection = " AND ";
			if(isset($search_data["global_search"]) && $search_data["global_search"] == 1)
				$filter_selection = " OR ";
				
        	$str_data_or_like = "";
        	foreach($data AS $data_key=>$data_val)
        	{
				if($data_key == "staff_name")
				{
					$str_data_or_like .= "(CONCAT_WS('',trim(users.first_name),trim(users.middle_name),trim(users.middle_name2),trim(users.last_name)) LIKE '%".$data_val."%' OR CONCAT_WS('',trim(users.first_name),trim(users.last_name)) LIKE '%".$data_val."%')";
				}
				else if($data_key == "user_roll_name")
				{
					$str_data_or_like .= "user_roll_name = '".$data_val."'".$filter_selection;
				}
				else
				{
					$str_data_or_like .= " $data_key LIKE '%$data_val%'".$filter_selection;
				}
        	}
        	$str_data_or_like = trim(trim($str_data_or_like),$filter_selection);
        	
        	if($str_data_or_like != "")
        		$this->db->where("(".$str_data_or_like.")", null, false);
        }

		if($campus_id > 0)
		{	
			$this->db->where('users.campus_id',$campus_id);
		}
		
    	$query = $this->db->get();		
		
    	if($query->num_rows() > 0) {
    		return $query;
    	}
    }
}

/* End of file list_teacher_student_model.php */
