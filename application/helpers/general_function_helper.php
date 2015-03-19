<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_other_user_list')) {
	function age_dropdown($id = null)
	{
		$_arr = array();
		
		for($i=1;$i<=100;$i++)
		{
			$_arr[$i] = $i;
		}
		
		if($id){
			return (isset($_arr[$id])) ? $_arr[$id] : '';
		}
		return $_arr;
	}
	
	function children_dropdown($id = null)
	{
		$_arr = array();
		
		for($i=0;$i<=15;$i++)
		{
			$_arr[$i] = $i;
		}
		
		if($id){
			return (isset($_arr[$id])) ? $_arr[$id] : '';
		}
		return $_arr;
	}
	function housepeople_dropdown($id = null)
	{
		$_arr = array();
		
		for($i=1;$i<=20;$i++)
		{
			$_arr[$i] = $i;
		}
		
		if($id){
			return (isset($_arr[$id])) ? $_arr[$id] : '';
		}
		return $_arr;
	}
	
	function gender_dropdown($id = null)
	{
		$_arr = array('Male'=> 'Male','Female'=>'Female');
		if($id){
			return (isset($_arr[$id])) ? $_arr[$id] : '';
		}
		return $_arr;
	}
	
	function maritalstatus_dropdown($id = null)
	{
		$_arr = array('Single'=> 'Single','Married'=>'Married','Divorced'=>'Divorced','Widowed'=>'Widowed');
		if($id){
			return (isset($_arr[$id])) ? $_arr[$id] : '';
		}
		return $_arr;
	}
	
	function work_dropdown($id = null)
	{
		$_arr = array(''=>'Choose','1'=> 'Yes','2'=>'No');
		if($id){
			return (isset($_arr[$id])) ? $_arr[$id] : '';
		}
		return $_arr;
	}
	
	function sick_dropdown($id = null)
	{
		$_arr = array(''=>'Choose','1'=> 'Yes','2'=>'No');
		if($id){
			return (isset($_arr[$id])) ? $_arr[$id] : '';
		}
		return $_arr;
	}
	
	function medicationequipment_dropdown($id = null)
	{
		$_arr = array(''=>'Choose','1'=> 'Yes','2'=>'No');
		if($id){
			return (isset($_arr[$id])) ? $_arr[$id] : '';
		}
		return $_arr;
	}  
	
	function live_dropdown($id = null)
	{
		$_arr = array(''=>'Choose','1'=> 'Tent','2'=>'House');
		if($id){
			return (isset($_arr[$id])) ? $_arr[$id] : '';
		}
		return $_arr;
	}  
	
	function specia_case_dropdown($id = null)
	{
		$_arr = array(''=>'Choose','1'=> 'No','2'=>'Orphans','3'=>'Widow','4'=>'Disabled','5'=>'Other (please specify)');
		if($id){
			return (isset($_arr[$id])) ? $_arr[$id] : '';
		}
		return $_arr;
	} 

	function month_dropdown($id = null)
	{
		$_arr = array('0'=>'Choose',
					  'January'=>'January',
					  'February'=>'February',
					  'March'=>'March',
					  'April'=>'April',
					  'May'=>'May',
					  'June'=>'June',
					  'July'=>'July',
					  'August'=>'August',
					  'September'=>'September',
					  'October'=>'October',
					  'November'=>'November',
					  'December'=>'December'
					 );
		if($id){
			return (isset($_arr[$id])) ? $_arr[$id] : '';
		}
		return $_arr;
	}

	function year_dropdown($id = null)
	{
		$_arr = array('0'=>'Choose',
					  '2012'=>'2012',
					  '2013'=>'2013',
					  '2014'=>'2014',
					  '2015'=>'2015',
					  '2016'=>'2016',
					  '2017'=>'2017',
					  '2018'=>'2018'
					 );
		if($id){
			return (isset($_arr[$id])) ? $_arr[$id] : '';
		}
		return $_arr;
	} 	
		
	function pictures_video_taken_dropdown($id = null)
	{
		$_arr = array(''=>'Choose','1'=> 'Yes','2'=>'No');
		if($id){
			return (isset($_arr[$id])) ? $_arr[$id] : '';
		}
		return $_arr;
	} 
	
	function level_of_need_dropdown($id = null)
	{
		$_arr = array(''=>'Choose','1'=> 'Emergency','2'=>'Very needy','3'=>'Needy');
		if($id){
			return (isset($_arr[$id])) ? $_arr[$id] : '';
		}
		return $_arr;
	}

	function relation_dropdown($id = null)
	{
		$_arr = array(''=>'Choose',
					  '1'=>'Father',
					  '2'=>'Mother',
					  '3'=>'Son',
					  '4'=>'Daughter',
					  '5'=>'Wife',
					  '6'=>'Husbund',
					  '7'=>'Brother',
					  '8'=>'Sister',
					  '9'=>'Grand father',
					  '10'=>'Grand mother',
					  '11'=>'Grand son',
					  '12'=>'Grand daughter',
					  '13'=>'Uncle',
					  '14'=>'Aunt',
					  '15'=>'Nephew',
					  '16'=>'Niece',
					  '17'=>'Cousin'
					 );
		if($id){
			return (isset($_arr[$id])) ? $_arr[$id] : '';
		}
		return $_arr;
	} 
	 	
	/**
	 *
	 * get_teacher_list: it's used to get list of teacher
	 *
	 * @param
	 * @return array
	 *
	 */
	function get_other_user_list() {
		$ci =& get_instance();
		$ci->db->select('*,CONCAT_WS(" ",users.first_name,users.middle_name,users.middle_name2,users.last_name) AS staff_name',FALSE);
		$ci->db->from('users');
		$ci->db->where_not_in('users.user_roll_id',array('1','4'));
        $ci->db->where_in('users.status',array('12','13'));
		$ci->db->order_by('first_name', 'ASC');	
		$query = $ci->db->get();
		$student_data = $query->result_array();
		$student_arr = array();
		$student_arr[0] = '--Select--';
		foreach ($student_data as $_student_data){
			$student_arr[$_student_data['user_id']] = $_student_data['staff_name'].' - '.$_student_data['elsd_id'];
		}
		return $student_arr;
	}
}
if (!function_exists('callback_combobox_check')) {
    /**
     *
     * get_teacher_list: it's used to get list of teacher
     *
     * @param 
     * @return array
     *
     */
    function callback_combobox_check($value) {
		if($value == '0'){
			return FALSE;
		}else{
			return FALSE;
		}
    }
}

if (!function_exists('download_file')) {
	function download_file($document_path,$file_name) {
		// place this code inside a php file and call it f.e. "download.php"
		$path = $document_path; // change the path to fit your websites document structure
		$fullPath = $path.$file_name;
		if ($fd = fopen ($fullPath, "r")) {
			$fsize = filesize($fullPath);
			$path_parts = pathinfo($fullPath);
			$ext = strtolower($path_parts["extension"]);
			switch ($ext) {
				case "pdf":
					header("Content-type: application/pdf"); // add here more headers for diff. extensions
					header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
					break;
				default;
				header("Content-type: application/octet-stream");
				header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
			}
			header("Content-length: $fsize");
			header("Cache-control: private"); //use this to open files directly
			while(!feof($fd)) {
				$buffer = fread($fd, 2048);
				echo $buffer;
			}
		}
		fclose ($fd);
		exit;
	}
}
if (!function_exists('set_activity_log')) {
	/**
	 *
	 * get_section: it's used to get list of teacher
	 *
	 * @param
	 * @return array
	 *
	 */
	function set_activity_log($datd_id,$action,$parent_menu,$sub_menu,$user_id='') {
		/*$ci =& get_instance();
		if($user_id != ''){
			$user_id = $user_id;
		}else{
			$user_id = $ci->session->userdata('user_id');
		}
		$session_ID = $ci->session->userdata('session_id');
		$data = array(
				'session_id' => $session_ID,
				'user_id' => $user_id,
				'data_id' => $datd_id,
				'parent_menu' => $parent_menu,
				'sub_menu' => $sub_menu,
				'action' => $action,
				'user_ip' => $_SERVER['REMOTE_ADDR'],
				'created_date' => date('Y-m-d H:i:s')
		);
		$ci->db->insert('user_activity_log', $data);*/
		return true;
	}
}
if (!function_exists('set_activity_data_log')) {
	/**
	 *
	 * get_section: it's used to get list of teacher
	 *
	 * @param
	 * @return array
	 *
	 */
	function set_activity_data_log($datd_id,$action,$parent_menu,$sub_menu,$tablename,$whrid_column,$user_id='') {
		/*$ci =& get_instance();
		
		//Get Array data
		$ci->db->select('*');
		$ci->db->from($tablename);
		$ci->db->where($whrid_column,$datd_id);
		$query = $ci->db->get();
		$data_array = $query->result_array();
		
		if($user_id != ''){
			$user_id = $user_id;
		}else{
			$user_id = $ci->session->userdata('user_id');
		}
		$session_ID = $ci->session->userdata('session_id');
		$data = array(
				'session_id' => $session_ID,
				'user_id' => $user_id,
				'data_id' => $datd_id,
				'parent_menu' => $parent_menu,
				'sub_menu' => $sub_menu,
				'action' => $action,
				'user_ip' => $_SERVER['REMOTE_ADDR'],
				'data_array' => serialize($data_array),
				'tablename' => $tablename,
				'primary_field' => $whrid_column,
				'created_date' => date('Y-m-d H:i:s')
		);
		$ci->db->insert('user_activity_log', $data);*/
		return true;
	}
}
if (!function_exists('time_ago')) {
	/**
	 *
	 * get_section: it's used to get list of teacher
	 *
	 * @param
	 * @return array
	 *
	 */
	function time_ago($date)
 	{
 		if(empty($date)) {
 			return "No date provided";
 		}
		$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
 		$lengths = array("60","60","24","7","4.35","12","10");
 		$now = time();
 		$unix_date = strtotime($date);
 		// check validity of date
 		if(empty($unix_date)) {
 			return "Bad date";
		}
		// is it future date or past date
		if($now > $unix_date) {
			$difference = $now - $unix_date;
			$tense = "ago";
		} else {
			$difference = $unix_date - $now;
			$tense = "from now";
		}
		for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
			$difference /= $lengths[$j];
		}
		$difference = round($difference);
		if($difference != 1) {
			$periods[$j].= "s";
		}
		return "$difference $periods[$j] {$tense}";
 
	}
}
if (!function_exists('get_user_roll')) {
	/**
	 *
	 * get_section: it's used to get list of teacher
	 *
	 * @param
	 * @return array
	 *
	 */
	function get_user_roll() {
		$ci =& get_instance();
		$ci->db->select('user_roll.*');
    	$ci->db->from('user_roll');    	
		$ci->db->where_not_in('user_roll.user_roll_id',array('1'));
		$query = $ci->db->get();
    	$user_roll_data = $query->result_array();
    	$user_roll_arr = array();
    	$user_roll_arr[0] = '--Select--';
    	foreach ($user_roll_data as $user_roll_datas){
    		$user_roll_arr[$user_roll_datas['user_roll_id']] = $user_roll_datas['user_roll_name'];    		
    	}
        return $user_roll_arr;
	}
}
if (!function_exists('check_access')) {
	/**
	 *
	 * check_access: it's used to get list of teacher
	 *
	 * @param
	 * @return array
	 *
	 */
	function check_access() {
		$arrController = array();
		$ci =& get_instance();
		$usr_role = $ci->session->userdata('role_id');
		$cotroller = $ci->router->fetch_class();
		$action = $ci->router->fetch_method();
		
		if($action != "no_access" && $usr_role != '1' && $cotroller != "login" && $cotroller != "logout" && 
			$cotroller != "profile" && $cotroller != "reset_password" && $cotroller != "forgot_password" 
			&& $cotroller != "forgot_username" && $action != "update_account" && $action != "update_password" 
			&& $action != "upload_profile_pic" && $action != "reset" && $action != "index_json" && 
			$action != "getdata" && $action != "show_comment" && $action != "export_to_excel" 
			&& $action != "get_existing_privilege"
			&& $action != "delete" &&
			$cotroller != "home" &&	
            $cotroller != "list_all_user" &&	
			$action != "get_user_existing_privilege"  &&
			$action != "edit_partial_profile" &&
			$action != "save_user_status" &&
			$action != "email_export"
			)
		{
			if(get_priviledge_action($cotroller,$action)){
				return true;
			}else{
				redirect("/home/no_access");//return true;
			}
		}
	}
}
	

if (!function_exists('get_master_menu')) {
	/**
	 *
	 * get_course_class: it's used to get list of teacher
	 *
	 * @param
	 * @return array
	 *
	 */
	function get_master_menu() {
		$ci =& get_instance();
		$ci->db->select('*');
		$ci->db->where('parent_id','0');
		$ci->db->from('menu_master');
		$query = $ci->db->get();
		$menu_parent = $query->result_array();
		$menu_master_arr = array();
		$menu_master_arr[0] = '--Select--';
		foreach ($menu_parent as $menu_parentes){
			$menu_master_arr[$menu_parentes['menu_id']] = $menu_parentes['name'];
		}
		return $menu_master_arr;
	}
}
if (!function_exists('get_master_all_menu')) {
	/**
	 *
	 * get_course_class: it's used to get list of teacher
	 *
	 * @param
	 * @return array
	 *
	 */
	function get_master_all_menu() {
		$ci =& get_instance();
		$ci->db->select('*');
		$ci->db->where('parent_id','0');
		$ci->db->from('menu_master');
		$query = $ci->db->get();
		$menu_parent = $query->result_array();
		$menu_master_arr = array();
		$menu_master_arr[0] = '--Select--';
		foreach ($menu_parent as $menu_parentes){
			$ci->db->select('*');
			$ci->db->where('parent_id',$menu_parentes['menu_id']);
			$ci->db->from('menu_master');
			$subquery = $ci->db->get();
			$menu_sub = $subquery->result_array();
			
			$menu_master_arr[$menu_parentes['menu_id']] = $menu_parentes['name'];
			
			foreach ($menu_sub as $menu_subs){
				$menu_master_arr[$menu_subs['menu_id']] = '---'.$menu_subs['name'];
			}
		}
		return $menu_master_arr;
	}
}
if (!function_exists('get_previlege_action')) {
	/**
	 *
	 * get_course_class: it's used to get list of teacher
	 *
	 * @param
	 * @return array
	 *
	 */
	function get_previlege_action() {
		$ci =& get_instance();
		$ci->db->select('*');
		$ci->db->from('menu_master');
		$ci->db->where('parent_id','0');
		$query = $ci->db->get();
		$menu_parent = $query->result_array();
		$i =0; 
		foreach ($menu_parent as $menu_parentes){
			$ci->db->select('*');
			$ci->db->where('menu_id',$menu_parentes['menu_id']);
			$ci->db->from('actions');
			$actquery = $ci->db->get();
			$menu_act = $actquery->result_array();
			$menu_parent[$i]['menu_action'] = $menu_act;
			
			$j=0;
			
			$ci->db->select('*');
			$ci->db->from('menu_master');
			$ci->db->where('parent_id',$menu_parentes['menu_id']);
			$query = $ci->db->get();
			$sub_menu_parent = $query->result_array();
			
			foreach ($sub_menu_parent as $sub_menu_parentes)
			{
				$ci->db->select('*');
				$ci->db->where('menu_id',$sub_menu_parentes['menu_id']);
				$ci->db->from('actions');
				$actquery = $ci->db->get();
				$menu_act = $actquery->result_array();
				
					$sub_menu_parent[$j]['menu_action'] = $menu_act;
				
				$j++;
			}
			
			$menu_parent[$i]['sub_menu'] = $sub_menu_parent;
			$i++;
		}
		return $menu_parent;
	}
}
function get_rolewise_priviledge(){
	$arrMenu = array();
	$ci =& get_instance();
	$usr_role = $ci->session->userdata('role_id');
	$user_id = $ci->session->userdata('user_id');
	$ci->db->select('*');
	$ci->db->from('user_custom_privilege');
	$ci->db->where('user_id',$user_id);
	$query_users = $ci->db->get();
	
		$query_custom = "";
		$query = "
				SELECT 
			        IF(M2.menu_id IS NOT NULL,M2.menu_id,M1.menu_id) AS parent_menu_id,
			        IF(M2.name IS NOT NULL,M2.name,M1.name) AS parent_menu_name,
					IF(M2.lang_menu_name IS NOT NULL,M2.lang_menu_name,M1.lang_menu_name) AS parent_lang_menu_name,
					M1.menu_id,
					M1.name AS menu_master,
					M1.lang_menu_name AS menu_master_lan, 
					M1.parent_id AS parent_id, 
					menu_action.controller AS controller,
					menu_action.menu_action_id,
					menu_action.is_display,
					menu_action.lang_name AS menu_action_lan, 
					menu_action.action AS action, 
					menu_action.theme	";
					
			if($usr_role == '1'){		
				$query .= " FROM menu_action ";
			}else{
				if($query_users->num_rows() > 0)
				{
					$query_custom = $query." FROM user_custom_privilege
							LEFT JOIN menu_action ON (user_custom_privilege.menu_action_id = menu_action.menu_action_id) ";
				}
				//else
				//{
					$query .= " FROM user_privilege
							LEFT JOIN menu_action ON (user_privilege.menu_action_id = menu_action.menu_action_id) ";
				//}			
			}					
			
			if($query_custom != "")
			{
				$query_custom .= " 		
					LEFT JOIN menu_master AS M1 ON (menu_action.menu_id = M1.menu_id) 
					LEFT JOIN menu_master AS M2 ON (M1.parent_id = M2.menu_id) 
					";
					
				$query_custom .= " WHERE menu_action.is_display = '1' ";
			}
			
			$query .= " 		
				LEFT JOIN menu_master AS M1 ON (menu_action.menu_id = M1.menu_id) 
				LEFT JOIN menu_master AS M2 ON (M1.parent_id = M2.menu_id) 
				";
				
			$query .= " WHERE menu_action.is_display = '1' ";
			
			if($usr_role != '1') {	
				if($query_users->num_rows() > 0)
				{
					$query_custom .= " AND user_custom_privilege.user_id = '$user_id' ";		
				}
				//else
				//{
					$query .= " AND user_privilege.user_roll_id = '$usr_role' ";
				//}
			}	
			
			if($query_custom != "")
			{
				$query_custom .= " ORDER BY menu_action.display_order";	
			}
			
			$query .= " ORDER BY menu_action.display_order";	
	$query_res = $ci->db->query($query);
	$arrResMenu = $query_res->result_array();
	$i = 0;
	foreach($arrResMenu AS $row)
	{
		$arrMenu[$row["parent_lang_menu_name"]]['lang_name'] = $row["parent_lang_menu_name"];
		$arrMenu[$row["parent_lang_menu_name"]]['menu_name'] = $row["parent_menu_name"];
		$arrMenu[$row["parent_lang_menu_name"]]['controller'] = $row["controller"];
		$arrMenu[$row["parent_lang_menu_name"]]['parent_id'] = $row["parent_id"];
		
		if($row["action"] == "inactive" || $row["action"] == "add_document")
			$row["controller"] = $row["controller"].'/'.$row["action"];
		
		$arrMenu[$row["parent_lang_menu_name"]]['sub_menu'][$row["menu_master_lan"]][$row["controller"]] = $row["menu_action_lan"];
		//$arrMenu[$row["parent_lang_menu_name"]][$row["menu_master_lan"]][$row["controller"]][$row["action"]] = $row["menu_action_lan"];
		$i++;
	}
	
	if($query_custom != "")
	{
		$query_res = $ci->db->query($query_custom);
		$arrResMenu = $query_res->result_array();
		$i = 0;
		foreach($arrResMenu AS $row)
		{
			$arrMenu[$row["parent_lang_menu_name"]]['lang_name'] = $row["parent_lang_menu_name"];
			$arrMenu[$row["parent_lang_menu_name"]]['menu_name'] = $row["parent_menu_name"];
			$arrMenu[$row["parent_lang_menu_name"]]['controller'] = $row["controller"];
			$arrMenu[$row["parent_lang_menu_name"]]['parent_id'] = $row["parent_id"];
			
			if($row["action"] == "inactive" || $row["action"] == "add_document")
				$row["controller"] = $row["controller"].'/'.$row["action"];
			
			$arrMenu[$row["parent_lang_menu_name"]]['sub_menu'][$row["menu_master_lan"]][$row["controller"]] = $row["menu_action_lan"];
			//$arrMenu[$row["parent_lang_menu_name"]][$row["menu_master_lan"]][$row["controller"]][$row["action"]] = $row["menu_action_lan"];
			$i++;
		}
	}
	
	return $arrMenu;
}
function get_priviledge_action($controller_name,$action=""){
	
	if($controller_name == "") return array();
	
	$arrMenu = array();
	$ci =& get_instance();
	$usr_role = $ci->session->userdata('role_id');
	$user_id = $ci->session->userdata('user_id');
	$ci->db->select('*');
	$ci->db->from('user_custom_privilege');
	$ci->db->where('user_id',$user_id);
	$query_users = $ci->db->get();
	
	$query = "
	SELECT
	IF(M2.menu_id IS NOT NULL,M2.menu_id,M1.menu_id) AS parent_menu_id,
	IF(M2.name IS NOT NULL,M2.name,M1.name) AS parent_menu_name,
	IF(M2.lang_menu_name IS NOT NULL,M2.lang_menu_name,M1.lang_menu_name) AS parent_lang_menu_name,
	M1.menu_id,
	M1.name AS menu_master,
	M1.lang_menu_name AS menu_master_lan,
	M1.parent_id AS parent_id,
	menu_action.controller AS controller,
	menu_action.menu_action_id,
	menu_action.is_display,
	menu_action.lang_name AS menu_action_lan,
	menu_action.action AS action,
	controller_action,
	menu_action.theme
	FROM user_privilege
	LEFT JOIN menu_action ON (user_privilege.menu_action_id = menu_action.menu_action_id)
	LEFT JOIN menu_master AS M1 ON (menu_action.menu_id = M1.menu_id)
	LEFT JOIN menu_master AS M2 ON (M1.parent_id = M2.menu_id)
	WHERE user_privilege.user_roll_id = '$usr_role'
	";
	
	//if($query_users->num_rows() > 0)
	//{
		$query_custom = "
			SELECT
			IF(M2.menu_id IS NOT NULL,M2.menu_id,M1.menu_id) AS parent_menu_id,
			IF(M2.name IS NOT NULL,M2.name,M1.name) AS parent_menu_name,
			IF(M2.lang_menu_name IS NOT NULL,M2.lang_menu_name,M1.lang_menu_name) AS parent_lang_menu_name,
			M1.menu_id,
			M1.name AS menu_master,
			M1.lang_menu_name AS menu_master_lan,
			M1.parent_id AS parent_id,
			menu_action.controller AS controller,
			menu_action.menu_action_id,
			menu_action.is_display,
			menu_action.lang_name AS menu_action_lan,
			menu_action.action AS action,
			controller_action,
			menu_action.theme
			FROM user_custom_privilege
			LEFT JOIN menu_action ON (user_custom_privilege.menu_action_id = menu_action.menu_action_id)
			LEFT JOIN menu_master AS M1 ON (menu_action.menu_id = M1.menu_id)
			LEFT JOIN menu_master AS M2 ON (M1.parent_id = M2.menu_id)
			WHERE user_custom_privilege.user_id = '$user_id'
			";	
	//}	
	
	$arrDefinedController = array("list_teacher",
								  "list_student",	
								  "list_course_class",
								  "documents",	
								  "attendance",	
								  "grade_report",	
								  "complaint"
								 );	
	$query .= " AND (menu_action.controller = '$controller_name') ";
	$query_custom .= " AND (menu_action.controller = '$controller_name') ";
		
	if($action != ""){
		$query .= " AND (menu_action.action = '$action' OR controller_action = '$action') ";
		$query_custom .= " AND (menu_action.action = '$action' OR controller_action = '$action') ";
	}
	
	$query_res = $ci->db->query($query);
	//echo $ci->db->last_query();
	$query_custom_res = $ci->db->query($query_custom);
	//echo $ci->db->last_query();
	$arrResMenu = $query_res->result_array();	
	foreach($arrResMenu AS $row)
	{
		$arrMenu[]= $row["action"];
		
		if($row["controller_action"] != "")
			$arrMenu[]= $row["controller_action"];
	}
	
	$arrResMenu = $query_custom_res->result_array();	
	foreach($arrResMenu AS $row)
	{
		$arrMenu[]= $row["action"];
		
		if($row["controller_action"] != "")
			$arrMenu[]= $row["controller_action"];
	}
	
	//echo "<pre>";
	//print_r($arrMenu);
	if($action != "" && count($arrMenu) > 0)
	  return true;
	if($action != "" && count($arrMenu) == 0)
		return false;
	else
		return $arrMenu;
}


if (!function_exists('hash_password')) {
    /**
     *
     * hash_password: obscure password with specially designed salt - site_key combo in sha512
     *
     * @param string $password the password to be validated
     * @param string $nonce the nonce that is unique to this member
     * @return string
     *
     */
    function hash_password($password, $nonce) {
    	return hash_hmac('sha512', $password . $nonce, SITE_KEY);
    }
}

function get_countries() {
	$ci =& get_instance();
	$ci->db->select('countries.*');
	$ci->db->from('countries');
	$query = $ci->db->get();
	$countries_data = $query->result_array();
	$countries_arr = array();
	$countries_arr[''] = '--Select--';
	foreach ($countries_data as $countries_datas){
		$countries_arr[$countries_datas['id']] = $countries_datas['country'];
	}
	return $countries_arr;
}

function get_profile_pic($user_id = 0,$profile_picture = '',$show_from_id = true) {
	$ci =& get_instance();
	$profile_pic = array('150'=> base_url()."images/noimage.jpg",'75'=> base_url()."images/noimage.jpg");
	
	if($user_id == 0 && $show_from_id == true)
		$user_id = $ci->session->userdata('user_id');

    if ($user_id > 0) {
        $ci->db->select('profile_picture');
        $ci->db->from('users');
        $ci->db->where('users.user_id', $user_id);
        $ci->db->limit(1);
        $query = $ci->db->get();
        if($query->num_rows() == 1) {
            $row = $query->row();            
            $profile_picture = $row->profile_picture;
        }
    }	
	
	$curr_dir = str_replace("\\","/",getcwd()).'/';
	$filepath = $curr_dir.'images/profile_picture/thumb7575/'.$profile_picture;
	if( file_exists($filepath) && $profile_picture != ''){
		$profile_picture_150 = base_url()."images/profile_picture/thumb150150/".$profile_picture;
		$profile_picture_75 = base_url()."images/profile_picture/thumb7575/".$profile_picture;
		$profile_pic[150] = $profile_picture_150;
		$profile_pic[75] = $profile_picture_75;
	}
		
	return $profile_pic;	   
}

function make_dp_date($date = ''){
	if($date == '' || $date == '0000-00-00'){
		return '';
	}
	return date('D, d M Y',strtotime($date));
}
function make_db_date($date = ''){
	if($date == ''){
		return '';
	}
	return date('Y-m-d',strtotime($date));
}

function getTableField($table, $select_col, $where_col,$where_col_val)
{
	$ci =& get_instance();
	
	$ci->db->select(''.$select_col.'',FALSE);
	$ci->db->from($table);
	
	if(isset($where_col) && $where_col_val!="")
		$ci->db->where($where_col,$where_col_val);
	
	$query = $ci->db->get();
	if($query->num_rows() > 0) {
		$row = $query->row();
		return $row->$select_col;
	}
	return "";
}

function save_users_log($id,$reason) {
	$ci =& get_instance();	
	$user_id = $ci->session->userdata('user_id');
	$change_date = date('Y-m-d H:i:s');
	
	$sql = "insert into users_log(`user_id`, `username`, `password`, `email`,`campus_id`,`cell_phone`,`coordinator`,`reason`,`change_by`, `change_date`)
		    SELECT `user_id`, `username`, `password`, `email`,`campus_id`,`cell_phone`,`coordinator`,'$reason',$user_id,'$change_date' FROM `users` WHERE user_id = '$id'";
	$ci->db->query($sql);
	$last_log_id =  $ci->db->insert_id();  
	
	$user_id = $ci->session->userdata('user_id');
	$data = array('change_by' => $user_id,'change_date' => date('Y-m-d H:i:s'));
	$ci->db->where('user_id', $id);
	$ci->db->update('users', $data);
	
	//if($ci->db->affected_rows() == 1) {
		//return $last_log_id;
	//}
	return $last_log_id;
}

function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = '9S2R492UI4';
    $secret_iv = '4D9H8';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'e' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

function get_nationality_list() {
	$ci =& get_instance();
	$ci->db->select('countries.*');
	$ci->db->from('countries');
	$ci->db->order_by("native", "asc");
	$ci->db->order_by("nationality", "asc");
	
	$query = $ci->db->get();
	$nationality_data = $query->result_array();
	$nationality_arr = array();
	$nationality_arr[0] = '--Select--';
	foreach ($nationality_data as $nationality_datas){
		$nationality_arr[$nationality_datas['id']] = $nationality_datas['nationality'];
	}
	return $nationality_arr;
}

function get_refugee_location() {
	$ci =& get_instance();
	$ci->db->select('refugee_location.*');
	$ci->db->from('refugee_location');
	$ci->db->order_by("location", "asc");
	
	$query = $ci->db->get();
	$data = $query->result_array();
	$arr = array();
	$arr[''] = '--Select--';
	foreach ($data as $datas){
		$arr[$datas['id']] = $datas['location'];
	}
	return $arr;
}

function get_associatoin_name_list() {
	$ci =& get_instance();
	$ci->db->select('association_name.*');
	$ci->db->from('association_name');
	$ci->db->order_by("name", "asc");
	
	$query = $ci->db->get();
	$data = $query->result_array();
	$arr = array();
	$arr[''] = '--Select--';
	foreach ($data as $datas){
		$arr[$datas['id']] = $datas['name'];
	}
	return $arr;
}
/* End of file general_function_helper.php */
/* Location: ./application/helpers/general_function_helper.php */ 