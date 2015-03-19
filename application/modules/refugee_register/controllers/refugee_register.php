<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class refugee_register extends Private_Controller {
    public function __construct()
    {
        parent::__construct();
        // pre-load
        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->helper('general_function');
		$this->load->model('refugee_model');
    }
    
	public function index() {
    	//echo "dfdsf";exit();
        $content_data = array();

        // set layout data
        $this->template->set_theme(Settings_model::$db_config['default_theme']);
        $this->template->set_layout('school');
        
        $this->template->title($this->lang->line('refugee'));
        $this->template->set_partial('header', 'header');
        $this->template->set_partial('sidebar', 'sidebar');
        $this->template->set_partial('footer', 'footer');
        $this->template->build('refugee', $content_data);
    }
    
    public function index_json($order_by = "username", $sort_order = "asc", $search = "all", $offset = 0) {
    	/* Array of database columns which should be read and sent back to DataTables. Use a space where
    	 * you want to insert a non-database field (for example a counter or static image)
    	*/
    	$aColumns = array('id',
						'association_name',
						'full_name',
						'age',
						'gender',
						'nationality',
						'created_date');

    	$grid_data = get_search_data($aColumns);
    	$sort_order = $grid_data['sort_order'];
		$order_by = $grid_data['order_by'];
    	/*
    	 * Paging
    	*/
    	$per_page =  $grid_data['per_page'];
    	$offset =  $grid_data['offset'];
    
    	$data = $this->refugee_model->get_refugee($per_page, $offset, $order_by, $sort_order, $grid_data['search_data']);
    	$count = $this->refugee_model->get_refugee($per_page, $offset, $order_by, $sort_order, $grid_data['search_data'],true);
		/*
    	 * Output
    	*/
    	$output = array(
    			"sEcho" => intval($_POST['draw']),
    			"recordsTotal" => $count,
    			"recordsFiltered" => $count,
    			"data" => array()
    	);
    
    	if($data){
    		foreach($data->result_array() AS $result_row){
    			$row = array();
    			$action_btn = '';
    			if($this->session->userdata('role_id') == '1' || in_array("edit",$this->arrAction)) {
    				$action_btn .= '<a href="'.base_url('refugee_register/add/'.$result_row["id"]).'" class="btn default btn-xs blue"><i class="fa fa-edit"></i> </a>';
    			}
    			$action_btn .= '<a href="javascript:;" onclick=dt_delete("refugee","id",'.$result_row["id"].'); class="btn default btn-xs red"><i class="fa fa-trash-o"></i></a>';
				$row[] = $result_row['id'];
				$row[] = $result_row['association_name'];
				$row[] = $result_row['full_name'];
				$row[] = $result_row['age'];
				$row[] = $result_row['gender'];
				$row[] = $result_row['nationality'];
				$row[] = $result_row['created_date'];
                $row[] = $action_btn;
    			$output['data'][] = $row;
    		}
    	}
    
    	echo json_encode( $output );
    }
	
	public function add($id = null) {
    	$content_data = array();
    	$work_list = work_dropdown();
		$sicklist = sick_dropdown();
		$medicationequipment_list = medicationequipment_dropdown();
		$livelist = live_dropdown();
		$specia_case_list = specia_case_dropdown();
		$month_list = month_dropdown();
		$year_list = year_dropdown();
		$age_list = age_dropdown();
		$gender_list = gender_dropdown();
		$children_list = children_dropdown();
		$housepeople_list = housepeople_dropdown();
		$maritalstatus_list = maritalstatus_dropdown();
		$nationality_list = get_nationality_list();
		$countries_list = get_countries();
		$refugee_location_list = get_refugee_location();
		$associatoin_name_list = get_associatoin_name_list();

		$errors = "";
		if($this->input->post()){

			$association_name = $this->input->post('association_name');
			$location_of_association = $this->input->post('location_of_association');
			$full_name = $this->input->post('full_name');
			$age = $this->input->post('age');
			$gender = $this->input->post('gender');
			$nationality = $this->input->post('nationality');
			$nationality_id_no = $this->input->post('nationality_id_no');
			$un_id = $this->input->post('un_id');
			$marital_status = $this->input->post('marital_status');
			$previous_occupation = $this->input->post('previous_occupation');
			$are_you_able_to_work = $this->input->post('are_you_able_to_work');
			$what_skills_do_you_have_for_working = $this->input->post('what_skills_do_you_have_for_working');
			$are_you_sick = $this->input->post('are_you_sick');
			$sick_reason = $this->input->post('sick_reason');
			$need_of_medicationequipment = $this->input->post('need_of_medicationequipment');
			$if_yes_please_specify = $this->input->post('if_yes_please_specify');
			$where_do_you_live_location = $this->input->post('where_do_you_live_location');
			$do_you_live_in_tent_house = $this->input->post('do_you_live_in_tent_house');
			$what_is_it_that_you_need_most = $this->input->post('what_is_it_that_you_need_most');
			$how_many_children_do_you_have = $this->input->post('how_many_children_do_you_have');
			$any_other_information = $this->input->post('any_other_information');
			$special_case = $this->input->post('special_case');
			$special_case_more_info = $this->input->post('special_case_more_info');
			$total_number_of_people_in_house = $this->input->post('total_number_of_people_in_house');
			$month = $this->input->post('month');
			$year = $this->input->post('year');		
			$add_timestamp = $this->input->post('timestamp');	
			
			$data_document['association_name'] = $association_name;
			$data_document['location_of_association'] = $location_of_association;
			$data_document['full_name'] = $full_name;
			$data_document['age'] = $age;
			$data_document['gender'] = $gender;
			$data_document['nationality'] = $nationality;
			$data_document['nationality_id_no'] = $nationality_id_no;
			$data_document['un_id'] = $un_id;
			$data_document['marital_status'] = $marital_status;
			$data_document['previous_occupation'] = $previous_occupation;
			$data_document['are_you_able_to_work'] = $are_you_able_to_work;
			$data_document['what_skills_do_you_have_for_working'] = $what_skills_do_you_have_for_working;
			$data_document['are_you_sick'] = $are_you_sick;
			$data_document['sick_reason'] = $sick_reason;
			$data_document['need_of_medicationequipment'] = $need_of_medicationequipment;
			$data_document['if_yes_please_specify'] = $if_yes_please_specify;
			$data_document['where_do_you_live_location'] = $where_do_you_live_location;
			$data_document['do_you_live_in_tent_house'] = $do_you_live_in_tent_house;
			$data_document['what_is_it_that_you_need_most'] = $what_is_it_that_you_need_most;
			$data_document['how_many_children_do_you_have'] = $how_many_children_do_you_have;
			$data_document['any_other_information'] = $any_other_information;
			$data_document['special_case'] = $special_case;
			$data_document['special_case_more_info'] = $special_case_more_info;
			$data_document['total_number_of_people_in_house'] = $total_number_of_people_in_house;
			
			if($add_timestamp > 0){
				$id = "";
			}	
			
			$table = 'refugee';		
			$wher_column_name = 'id';
			if($id){
				grid_data_updates($data_document,$table,$wher_column_name,$id);    
			}else{
				$data_document['created_date'] = date("Y-m-d H:i:s");
				$id = grid_add_data($data_document,$table);
				
				//update refugee_id = user_id where refugee_id = timstamp in table refugee_family_members for add
				$data_family_members["refugee_id"] = $id;
				$table = 'refugee_family_members';		
				$wher_column_name = 'refugee_id';
				grid_data_updates($data_family_members,$table,$wher_column_name,$add_timestamp); 
				
				//update refugee_id = user_id where refugee_id = timstamp in table refugee_qualifications for add
				$data_qualifications["refugee_id"] = $id;
				$table = 'refugee_qualifications';		
				$wher_column_name = 'refugee_id';
				grid_data_updates($data_qualifications,$table,$wher_column_name,$add_timestamp); 
				
				redirect('refugee_register/add/'.$id);
			}
						
			$this->session->set_flashdata('message', $this->lang->line('save_success'));
			redirect('refugee_register');
		}
		
		$rowdata= array();
		$content_data['timestamp'] = 0;
		if($id){
			$rowdata = $this->refugee_model->get_refugee_data($id);
			
			if(!$rowdata){
				redirect('refugee_register/add/');
			}
		}
		else{
			$id = time().mt_rand(10,100);
			$content_data['timestamp'] = $id;
		}

		$content_data['work_list'] = $work_list;
		$content_data['age_list'] = $age_list;
		$content_data['gender_list'] = $gender_list;
		$content_data['children_list'] = $children_list;
		$content_data['housepeople_list'] = $housepeople_list;
		$content_data['maritalstatus_list'] = $maritalstatus_list;
		$content_data['nationality_list'] = $nationality_list;
		$content_data['countries_list'] = $countries_list;
		$content_data['refugee_location_list'] = $refugee_location_list;
		$content_data['associatoin_name_list'] = $associatoin_name_list;
		$content_data['sicklist'] = $sicklist;
		$content_data['medicationequipment_list'] = $medicationequipment_list;
		$content_data['livelist'] = $livelist;
		$content_data['specia_case_list'] = $specia_case_list;
		
		$content_data['rowdata'] = $rowdata;
		
		$content_data['id'] = $id;
        // set layout data
        $this->template->set_theme(Settings_model::$db_config['default_theme']);
        $this->template->set_layout('school');
        
        $this->template->title($this->lang->line('add_refugee'));
        $this->template->set_partial('header', 'header');
		$this->template->set_partial('sidebar', 'sidebar');
        $this->template->set_partial('footer', 'footer');
        $this->template->build('add', $content_data);
    }

	public function add_contact($id = null) {
    	$content_data = array();
    	$errors = "";
		if($this->input->post()){

			$email = $this->input->post('email');
			$skype = $this->input->post('skype');
			$whatsapp = $this->input->post('whatsapp');
			$other_contact = $this->input->post('other_contact');
			$telephone_no = $this->input->post('telephone_no');
			
			$data_document['email'] = $email;
			$data_document['skype'] = $skype;
			$data_document['whatsapp'] = $whatsapp;
			$data_document['other_contact'] = $other_contact;
			$data_document['telephone_no'] = $telephone_no;

			$table = 'refugee';		
			$wher_column_name = 'id';
			if($id){
				grid_data_updates($data_document,$table,$wher_column_name,$id);    
			}
						
			$this->session->set_flashdata('message', $this->lang->line('save_success'));
			redirect('refugee_register');
		}
		
		$rowdata= array();
		if($id){
			$rowdata = $this->refugee_model->get_refugee_data($id);
		}

		// set layout data
        $this->template->set_theme(Settings_model::$db_config['default_theme']);
        $this->template->set_layout('school');
        
        $this->template->title($this->lang->line('add_refugee'));
        $this->template->set_partial('header', 'header');
		$this->template->set_partial('sidebar', 'sidebar');
        $this->template->set_partial('footer', 'footer');
        $this->template->build('add', $content_data);
    }
	
    public function upload_photos($type = 'photo',$user_id = null) {
    	//print_r($_FILES);
    	
        $json_files = array();
    	//upload and update the file
        if(isset($_FILES) && is_array($_FILES) && count($_FILES) > 0) {
            $errors = '';

            $curr_dir = str_replace("\\","/",getcwd()).'/';
            $upload_path = $curr_dir.'uploads/'.$user_id.'/';
            // flag for checking the directory exist or not
            if(!is_dir($upload_path))
            {
                mkdir($upload_path, 0777, true);
            }
            //upload and update the file
            $config['upload_path'] = $upload_path;
            if ($type == 'photo') {
            	$config['allowed_types'] = 'jpg|jpeg|png';
            }elseif ($type == 'video') {
            	$config['allowed_types'] = 'mp4|avi|mpeg|3gp|mkv|wmv|mov|flv';
            }else{
            	$config['allowed_types'] = 'pdf|doc|docx|xlsx|xls|zip|csv|rtf';
            }

            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            $config['encrypt_name'] = false;
            $config['max_size'] = '250999';// in KB
            
            //load upload library
            $this->load->library('upload', $config);
            
            $data = array();
            
            foreach($_FILES as $field => $files)
            {
                if(count($files['name']) >0)
                {
                    $file_names = array();
                    foreach($files['name'] as $file_name) {
                        $file_ext = end(explode('.', $file_name));
      					$file_ext = strtolower($file_ext);
                        $file_names[] = $user_id.'_'.$type."_".md5(rand() * time()).'.'.$file_ext;
                    }
                    $config['file_name'] = $file_names;
                    $this->upload->initialize($config);
                    if($this->upload->do_multi_upload($field))
                    {
                        $data[$field] = $this->upload->get_multi_upload_data();
                    }else{
                        //$errors .= str_replace("_"," ",$field).': '.$this->upload->display_errors()."<br>";

                        //set the data for the json array
			            $info = new StdClass;
			            $info->name = $file_name;
			            $info->error = $this->upload->display_errors('','');
			            $json_files[] = $info;
                    }                    
                }
            }
            /*if ($errors <> '') {
            	$error = array('error' => $errors);
            	echo json_encode(array($error));
            	exit();
            }*/
            
            /*echo "<pre>";
            print_r($data);
            echo "</pre>";
            exit;*/
            if(isset($data) && is_array($data) && count($data) > 0)
            {
                $table = 'refugee_documents';
                    
                foreach($data AS $attachments=>$arrFiles)
                {
                    if(count($arrFiles) > 0)
                    {
                        //$this->list_user_model->delete_user_document($user_id,$arrCertificateType[$certificate_type]);
                        foreach($arrFiles as $file_data) {
                            $file = 'uploads/'.$user_id.'/'.$file_data["file_name"];
                            $file_url = base_url().$file;
                            $data_document['type'] = $type;
                            $data_document['user_id'] = $user_id;
                            $data_document['title'] = $file;                            
                            $data_document['file'] = $file;                            
                            $id = grid_add_data($data_document,$table);

                            //set the data for the json array
				            $info = new StdClass;
				            $info->name = "Click Here";
				            $info->size = $file_data['file_size'] * 1024;
				            $info->type = $file_data['file_type'];
				            $info->title = $file_data['file_name'];
				            $info->url = $file_url;
				            // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
				            if ($type == 'photo')
				            	$info->thumbnailUrl = $file_url;

				            if ($type == 'video' && pathinfo($file_url, PATHINFO_EXTENSION) == 'mp4')
				            	$info->videoPreview = $file_url;

				            $info->fileType = $type;
				            $info->deleteUrl = base_url() . 'refugee_register/delete_doc/' . $id;
				            $info->deleteType = 'POST';
				            $info->error = null;

				            $json_files[] = $info;
                        }
                    }
                }
            }
        }else{
        	$data = $this->refugee_model->get_refugee_doc($type,$user_id);
	    	    
	    	if($data){
	    		foreach($data->result_array() AS $result_row){
	    			
	    			$file = $result_row['file'];
	    			$id = $result_row['id'];
	    			$title = $result_row['title'];

	    			$file_url = base_url().$file;
	    			//set the data for the json array
		            $info = new StdClass;
		            $info->name = "Click Here";		            
		            $info->size = filesize($file);
		            //$info->type = $file_data['file_type'];
		            $info->url = $file_url;
		            // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
		            if ($type == 'photo')
		            	$info->thumbnailUrl = $file_url;

		            if ($type == 'video' && pathinfo($file_url, PATHINFO_EXTENSION) == 'mp4')
				        $info->videoPreview = $file_url;
		            
		            $info->fileType = $type;
		            $info->title = $title;
		            $info->id = $id;
		            $info->deleteUrl = base_url() . 'refugee_register/delete_doc/' . $id;
		            $info->deleteType = 'POST';
		            $info->error = null;

		            $json_files[] = $info;
	    		}
	    	}

        }
        echo json_encode(array("files" => $json_files));
    }

    public function delete_doc($id = null){
    	$info = new StdClass;
    	if($id){
			$table = 'refugee_documents';
			$wher_column_name = 'id';
			$file = getTableField($table, 'file', $wher_column_name,$id);

			$success = false;
			$is_file = false;
			if(!empty($file) && file_exists($file)){
				$is_file = true;
				$success = @unlink($file);
			}
			grid_delete($table,$wher_column_name,$id);

	        $info->sucess = $success;
	        $info->path = $file;
	        $info->file = $is_file;
    	}
		echo json_encode(array($info));
        exit();
	}

	public function load_qualifications($refugee_id) {    	

        $order_by = "title";
        $sort_order = "asc";
    	
    	$data = $this->refugee_model->get_qualifications($refugee_id,$order_by, $sort_order);    	
    	$output = '<div class="table-scrollable table-scrollable-borderless">
					<table class="table table-hover table-light" id="grid_qualifications">
					<thead>
					<tr class="uppercase">
						<th>'.$this->lang->line('title').'</th>
						<th>'.$this->lang->line('institute').'</th>
						<th>'.$this->lang->line('grade').'</th>
						<th>'.$this->lang->line('year').'</th>
						<th>'.$this->lang->line('action').'</th>
					</tr>
					</thead>
					<tbody>';
    	if($data){
    		foreach($data->result_array() AS $result_row){

                $action_btn = '';
                $action_btn .= '<a href="'.base_url('refugee_register/add_qualifications/'.$result_row["refugee_id"].'/'.$result_row["id"]).'" class="btn default btn-xs blue" data-target="#myModal" data-toggle="modal"><i class="fa fa-edit"></i> </a>';
                $action_btn .= '<a href="javascript:;" onclick=table_delete("refugee_qualifications","id",'.$result_row["id"].'); class="btn default btn-xs red"><i class="fa fa-trash-o"></i></a>';

                $output .= '<tr>';
    			$output .= '<td>'.$result_row["title"].'</td>';
    			$output .= '<td>'.$result_row["institute"].'</td>';
    			$output .= '<td>'.$result_row["grade"].'</td>';
    			$output .= '<td>'.$result_row["pass_year"].'</td>';
                $output .= '<td>'.$action_btn.'</td>';
                $output .= '</tr>';
    		}
    	}
    	$output .= '</tbody></table></div>';
    	echo ( $output );
    }

    public function add_qualifications($refugee_id,$id = null) {
    	$content_data['id'] = $id;
    	$content_data['refugee_id'] = $refugee_id;
    	$rowdata = array();
    	if($id){
    		$rowdata = $this->refugee_model->get_qualifications_data($id);
    	}
    
    	$content_data['rowdata'] = $rowdata;
    	if($this->input->post()){
    		$title = $this->input->post('title');
    		$institute = $this->input->post('institute');
    		$grade = $this->input->post('grade');
    		$pass_year = $this->input->post('pass_year');

    		$data = array();
			$data['refugee_id'] = $refugee_id;
			$data['title'] = $title;
			$data['institute'] = $institute;
			$data['grade'] = $grade;
			$data['pass_year'] = $pass_year;
			$table = 'refugee_qualifications';
			$wher_column_name = 'id';
    		
    		if($id){
    			grid_data_updates($data,$table,$wher_column_name,$id);    			
    		}else{
    			$lastinsertid = grid_add_data($data,$table);
    		}
    		exit;
    	}
    	$this->template->build('add_qualifications', $content_data);
    }

    public function load_family_members($refugee_id) {    	

        $order_by = "name";
        $sort_order = "asc";
    	
    	$data = $this->refugee_model->get_family_members($refugee_id,$order_by, $sort_order);    	
    	$output = '<div class="table-scrollable table-scrollable-borderless">
					<table class="table table-hover table-light" id="grid_family_members">
					<thead>
					<tr class="uppercase">
						<th>'.$this->lang->line('name').'</th>
						<th>'.$this->lang->line('relation').'</th>
						<th>'.$this->lang->line('gender').'</th>
						<th>'.$this->lang->line('age').'</th>
						<th>'.$this->lang->line('action').'</th>
					</tr>
					</thead>
					<tbody>';
    	if($data){
    		foreach($data->result_array() AS $result_row){

                $action_btn = '';
                $action_btn .= '<a href="'.base_url('refugee_register/add_family_members/'.$result_row["refugee_id"].'/'.$result_row["id"]).'" class="btn default btn-xs blue" data-target="#myModal" data-toggle="modal"><i class="fa fa-edit"></i> </a>';
                $action_btn .= '<a href="javascript:;" onclick=table_delete("refugee_family_members","id",'.$result_row["id"].'); class="btn default btn-xs red"><i class="fa fa-trash-o"></i></a>';

                $output .= '<tr>';
    			$output .= '<td>'.$result_row["name"].'</td>';
    			$output .= '<td>'.relation_dropdown($result_row["relation"]).'</td>';
    			$output .= '<td>'.$result_row["gender"].'</td>';
    			$output .= '<td>'.$result_row["age"].'</td>';
                $output .= '<td>'.$action_btn.'</td>';
                $output .= '</tr>';
    		}
    	}
    	$output .= '</tbody></table></div>';
    	echo ( $output );
    }

    public function add_family_members($refugee_id,$id = null) {
    	$content_data['id'] = $id;
    	$content_data['refugee_id'] = $refugee_id;
    	$rowdata = array();
    	if($id){
    		$rowdata = $this->refugee_model->get_family_members_data($id);
    	}
    
    	$content_data['rowdata'] = $rowdata;

    	$age_list = age_dropdown();
    	$gender_list = gender_dropdown();
    	$relation_list = relation_dropdown();
    	$content_data['age_list'] = $age_list;
    	$content_data['gender_list'] = $gender_list;
    	$content_data['relation_list'] = $relation_list;
    	if($this->input->post()){
    		$name = $this->input->post('name');
    		$relation = $this->input->post('relation');
    		$gender = $this->input->post('gender');
    		$age = $this->input->post('age');

    		$data = array();
			$data['refugee_id'] = $refugee_id;
			$data['name'] = $name;
			$data['relation'] = $relation;
			$data['gender'] = $gender;
			$data['age'] = $age;
			$table = 'refugee_family_members';
			$wher_column_name = 'id';
    		
    		if($id){
    			grid_data_updates($data,$table,$wher_column_name,$id);    			
    		}else{
    			$lastinsertid = grid_add_data($data,$table);
    		}
    		exit;
    	}
    	$this->template->build('add_family_members', $content_data);
    }
	
}
/* End of file documents.php */