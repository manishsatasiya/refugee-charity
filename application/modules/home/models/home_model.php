<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
	
    public function get_staff_count() {
		
		$this->db->from('users');
		$this->db->where_not_in('users.user_roll_id',array('1','4'));
		//$this->db->where_in('active',array(2,1));
		return $this->db->count_all_results();
    }
	
	public function get_pending_count() {
		
		$this->db->from('users');
		$this->db->where_not_in('users.user_roll_id',array('1','4'));
		//$this->db->where('active',3);
		return $this->db->count_all_results();
    }
	
	public function get_block_count() {
		
		$this->db->from('users');
		$this->db->where_not_in('users.user_roll_id',array('1','4'));
		//$this->db->where('active',2);
		return $this->db->count_all_results();
    }
	
	public function get_users_count($role,$except=0) 
	{
		$this->db->select('gender,count(*) AS cnt',FALSE);
		$this->db->from('users');
		
		if($except == 1)
			$this->db->where_not_in('users.user_roll_id',$role);
		else	
			$this->db->where_in('users.user_roll_id',$role);
			
		$this->db->group_by('gender');
		
		$query = $this->db->get();
    	if($query->num_rows() > 0) 
    	{
    		return $query;
    	}
    }
	
	public function departure_stats() 
    {
		$this->db->select('COUNT(DISTINCT(users.user_id)) as count, contractors.contractor as contractor_name,user_profile.resignation_resons',FALSE);
		$this->db->from('users');
		$this->db->join('user_profile','users.user_id=user_profile.user_id','left');
		$this->db->join('contractors','user_profile.contractor=contractors.id','left');
		$this->db->where_not_in('users.user_roll_id',array('1','4'));
		//$this->db->where('users.active','0');
		$this->db->group_by('user_profile.contractor, user_profile.resignation_resons');
		
        $query = $this->db->get();
    	if($query->num_rows() > 0) {
    		return $query;
    	}
    }
	
	public function new_users() 
    {
		$this->db->select('users.user_id,users.elsd_id,users.first_name,users.last_name,users.gender,school_campus.campus_name',FALSE);
		$this->db->join('school_campus','users.campus_id=school_campus.campus_id','left');
		//$this->db->where_in('active',array(1,2));
		$this->db->order_by('users.created_date', 'desc');
		$this->db->limit(7, 0);
		$this->db->from('users');
		
		$query = $this->db->get();
    	if($query->num_rows() > 0) {
    		return $query;
    	}
		
	}
	
	public function get_nationality() 
    {
		$query = "SELECT 
						'UK' as nationality, 
						'730, 240' as coords, 
						SUM(IF(gender='M', 1, 0)) as male_count, 
						SUM(IF(gender='F', 1, 0)) as female_count, 
						COUNT(*) as total 
				 FROM `users` 
				 LEFT JOIN `user_profile` ON `user_profile`.`user_id`=`users`.`user_id` 
				 LEFT JOIN `countries` ON `user_profile`.`nationality`=`countries`.`id` 
				 WHERE `countries`.`nationality` = 'British'
				 UNION
				 SELECT 
						'Ireland' as nationality, 
						'710, 280' as coords, 
						SUM(IF(gender='M', 1, 0)) as male_count, 
						SUM(IF(gender='F', 1, 0)) as female_count, 
						COUNT(*) as total 
				 FROM `users` 
				 LEFT JOIN `user_profile` ON `user_profile`.`user_id`=`users`.`user_id` 
				 LEFT JOIN `countries` ON `user_profile`.`nationality`=`countries`.`id` 
				 WHERE `countries`.`nationality` = 'Irish'
				 UNION
				 SELECT 
						'America' as nationality, 
						'260, 232' as coords, 
						SUM(IF(gender='M', 1, 0)) as male_count, 
						SUM(IF(gender='F', 1, 0)) as female_count, 
						COUNT(*) as total 
				 FROM `users` 
				 LEFT JOIN `user_profile` ON `user_profile`.`user_id`=`users`.`user_id` 
				 LEFT JOIN `countries` ON `user_profile`.`nationality`=`countries`.`id` 
				 WHERE `countries`.`nationality` = 'American'
				 UNION
				 SELECT 
						'Canada' as nationality, 
						'360, 300' as coords, 
						SUM(IF(gender='M', 1, 0)) as male_count, 
						SUM(IF(gender='F', 1, 0)) as female_count, 
						COUNT(*) as total 
				 FROM `users` 
				 LEFT JOIN `user_profile` ON `user_profile`.`user_id`=`users`.`user_id` 
				 LEFT JOIN `countries` ON `user_profile`.`nationality`=`countries`.`id` 
				 WHERE `countries`.`nationality` = 'Canadian'
				 UNION
				 SELECT 
						'Australia' as nationality, 
						'1320, 640' as coords, 
						SUM(IF(gender='M', 1, 0)) as male_count, 
						SUM(IF(gender='F', 1, 0)) as female_count, 
						COUNT(*) as total 
				 FROM `users` 
				 LEFT JOIN `user_profile` ON `user_profile`.`user_id`=`users`.`user_id` 
				 LEFT JOIN `countries` ON `user_profile`.`nationality`=`countries`.`id` 
				 WHERE `countries`.`nationality` = 'Australian'
				 UNION
				 SELECT 
						'New Zealand' as nationality, 
						'1500, 710' as coords, 
						SUM(IF(gender='M', 1, 0)) as male_count, 
						SUM(IF(gender='F', 1, 0)) as female_count, 
						COUNT(*) as total 
				 FROM `users` 
				 LEFT JOIN `user_profile` ON `user_profile`.`user_id`=`users`.`user_id` 
				 LEFT JOIN `countries` ON `user_profile`.`nationality`=`countries`.`id` 
				 WHERE `countries`.`nationality` = 'New Zealander'
				 UNION
				 SELECT 
						'Saudi Arabia' as nationality, 
						'950, 440' as coords, 
						SUM(IF(gender='M', 1, 0)) as male_count, 
						SUM(IF(gender='F', 1, 0)) as female_count, 
						COUNT(*) as total 
				 FROM `users` 
				 LEFT JOIN `user_profile` ON `user_profile`.`user_id`=`users`.`user_id` 
				 LEFT JOIN `countries` ON `user_profile`.`nationality`=`countries`.`id` 
				 WHERE `countries`.`nationality` = 'Saudi Arabian'
				 UNION
				 SELECT 
						'Native Total' as nationality, 
						'90, 600' as coords, 
						SUM(IF(gender='M', 1, 0)) as male_count, 
						SUM(IF(gender='F', 1, 0)) as female_count, 
						COUNT(*) as total 
				 FROM `users` 
				 LEFT JOIN `user_profile` ON `user_profile`.`user_id`=`users`.`user_id` 
				 LEFT JOIN `countries` ON `user_profile`.`nationality`=`countries`.`id` 
				 WHERE `countries`.`nationality` IN('British','Irish','American','Canadian','Australian','New Zealander')
				 UNION
				 SELECT 
						'Non native Total' as nationality, 
						'90, 650' as coords, 
						SUM(IF(gender='M', 1, 0)) as male_count, 
						SUM(IF(gender='F', 1, 0)) as female_count, 
						COUNT(*) as total 
				 FROM `users` 
				 LEFT JOIN `user_profile` ON `user_profile`.`user_id`=`users`.`user_id` 
				 LEFT JOIN `countries` ON `user_profile`.`nationality`=`countries`.`id` 
				 WHERE `countries`.`nationality` NOT IN('British','Irish','American','Canadian','Australian','New Zealander')
				 UNION
				 SELECT 
						'Unknown' as nationality, 
						'90, 700' as coords, 
						SUM(IF(gender='M', 1, 0)) as male_count, 
						SUM(IF(gender='F', 1, 0)) as female_count, 
						COUNT(*) as total 
				 FROM `users` 
				 LEFT JOIN `user_profile` ON `user_profile`.`user_id`=`users`.`user_id` 
				 WHERE `user_profile`.`nationality` = ''
				 ";
		
		$query = $this->db->query($query);
		
    	//echo $this->db->last_query();
		//exit;
		if($query->num_rows() > 0) {
    		return $query;
    	}
		
	}
	
	public function count_all_student_of_teacher($user_id)
    {		
    	$this->db->from('users');
		$this->db->join('course_class','users.section_id=course_class.section_id','left'); 
		$this->db->join('course_section', 'course_section.section_id = users.section_id','left');
    	$this->db->where('users.user_roll_id','4');
		$this->db->where('course_class.primary_teacher_id',$user_id);        
				
    	return $this->db->count_all_results();
    }
	
	public function count_all_course_class_of_teacher($user_id)
    {
		$this->db->select('`course_section`.`section_title`');
    	$this->db->from('course_class');
		$this->db->where('primary_teacher_id',$user_id);
		$this->db->join('course_section', 'course_section.section_id = course_class.section_id','left');
		//$this->db->join('users', 'users.user_id = course_class.primary_teacher_id','left');
		//$this->db->where('is_active = 1');
       	$query = $this->db->get();
        
        if($query->num_rows() > 0) {
            return $query;
        }
		return false;
    }
	
	public function get_employee_state($by_month = true) {
		$query = "SELECT COUNT(*) as cnt
				  FROM users
				  WHERE ";
		if($by_month)		  
			$query .= "created_date >= '".date("Y-m-d",mktime(0,0,0,date("m")-1,date("d"),date("Y")))."' AND created_date <= '".date("Y-m-d")."' ";
		else	
			$query .= "created_date >= '".date("Y-m-d",mktime(0,0,0,date("m"),date("d"),date("Y")-1))."' AND created_date <= '".date("Y-m-d")."' ";
			
		$query .= "AND `users`.`user_roll_id`NOT IN ('1', '4')";
		$query = $this->db->query($query);
			
		if($query->num_rows() > 0) {
    		return $query->row();
    	}
	}
	
	public function get_student_count($campus,$gender = 'M') {
		
		$this->db->from('users');
		//$this->db->join('user_profile','users.user_id=user_profile.user_id','left');
		//$this->db->where_in('active',array(1,2));
		
		if($campus!=false)
			$this->db->where('campus_id',$campus);
			
		$this->db->where('users.user_roll_id',4);
		if($gender!=false)
			$this->db->where('gender',$gender);
		
		$count = $this->db->count_all_results();
		//echo $this->db->last_query();	
		//exit;
		return $count;
    }
	
	public function get_latest_student($order_by = 'created_date') {
		$this->db->select('users.*');
		$this->db->from('users');
		$this->db->where('users.user_roll_id',4);
		$this->db->order_by('users.'.$order_by, 'desc');
		if($order_by == 'updated_date'){
			$this->db->where('users.updated_date != "0000-00-00 00:00:00"');
			$this->db->where('users.updated_date != NULL');
			$this->db->where('users.updated_date != ""');
		}	
		$this->db->limit(3, 0);
		$query = $this->db->get();
		//echo $this->db->last_query();	
		if($query->num_rows() > 0) {
    		return $query;
    	}
	}
	
	public function get_course_class_count()
	{
		$this->db->select('camps_id,count(*) AS cnt',FALSE);
		$this->db->from('course_class');
		$this->db->group_by('camps_id');
		
		$query = $this->db->get();
    	if($query->num_rows() > 0) 
    	{
    		return $query;
    	}
    }
}

/* End of file home_model.php */
