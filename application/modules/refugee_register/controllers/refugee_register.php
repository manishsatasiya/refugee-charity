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
    			$action_btn = '<div class="btn-group"><button class="btn btn-circle blue btn-sm dropdown-toggle" type="button" data-toggle="dropdown">'.$this->lang->line('action_btn').' <i class="fa fa-angle-down"></i></button><ul class="dropdown-menu pull-right" role="menu">';
    			if($this->session->userdata('role_id') == '1' || in_array("edit",$this->arrAction)) {
    				$action_btn .= '<li><a href="'.base_url('refugee_register/add/'.$result_row["id"]).'" class=""><i class="fa fa-edit"></i> '.$this->lang->line('edit').'</a></li>';
    			}

    			$action_btn .= '<li><a href="javascript:;" onclick=dt_delete("refugee","id",'.$result_row["id"].'); class=""><i class="fa fa-trash-o"></i> '.$this->lang->line('delete').'</a></li>';
    			$action_btn .= '<li><a href="'.base_url('refugee_register/view/'.$result_row["id"]).'" class=""><i class="fa fa-search"></i> '.$this->lang->line('view').'</a></li>';

    			$action_btn .= '</ul></div>';
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
			$data_document['created_by'] = $this->session->userdata('user_id');
			
			if($add_timestamp > 0){
				$id = "";
			}	
			
			$table = 'refugee';		
			$wher_column_name = 'id';
			if($id){
				//START For Log
				$user_new_data = array(
							'association_name' => $association_name,
							'location_of_association' => $location_of_association,
							'full_name' => $full_name,
							'age' => $age,
							'gender' => $gender,
							'nationality' => $nationality,
							'nationality_id_no' => $nationality_id_no,
							'un_id' => $un_id,
							'marital_status' => $marital_status,
							'previous_occupation' => $previous_occupation,
							'are_you_able_to_work' => $are_you_able_to_work,
							'what_skills_do_you_have_for_working' => $what_skills_do_you_have_for_working,
							'are_you_sick' => $are_you_sick,
							'sick_reason' => $sick_reason,
							'need_of_medicationequipment' => $need_of_medicationequipment,
							'if_yes_please_specify' => $if_yes_please_specify,
							'where_do_you_live_location' => $where_do_you_live_location,
							'do_you_live_in_tent_house' => $do_you_live_in_tent_house,
							'what_is_it_that_you_need_most' => $what_is_it_that_you_need_most,
							'how_many_children_do_you_have' => $how_many_children_do_you_have,
							'any_other_information' => $any_other_information,
							'special_case' => $special_case,
							'special_case_more_info' => $special_case_more_info,
							'total_number_of_people_in_house' => $total_number_of_people_in_house
						);						
				

				$arr_log_fields = get_user_log_fields();
				$log_field_data = array();

				if(count($arr_log_fields) > 0){
					$arr_user_new_data = $user_new_data;					
					$user_data = $this->refugee_model->get_refugee_data($id);	
					foreach ($arr_log_fields as $field_key => $value) {
						if (isset($arr_user_new_data[$field_key]) && isset($user_data->$field_key)) {
							if (($user_data->$field_key == '0000-00-00') && ($arr_user_new_data[$field_key] == '')) {
								continue;
							}
							if ($arr_user_new_data[$field_key] != $user_data->$field_key) {
								$log_field_data[$field_key] = array('old_value'=> $user_data->$field_key,
																	 'new_value'=> $arr_user_new_data[$field_key]);
							}
						}
					}
				}
				//END For Log

				//Update refugee DB table data from edit page
				grid_data_updates($data_document,$table,$wher_column_name,$id);    

				//START INSERT LOG DATA
				if((count($log_field_data) > 0)){
					$change_by = $this->session->userdata('user_id');
					$refugee_log_master = array(
						'refugee_id' => $id,
						'change_by' => $change_by,
						'change_date' => date('Y-m-d H:i:s'),
						'type' => 1
					);
					$refugee_log_master_id = grid_add_data($refugee_log_master,'refugee_log_master');

					if(count($log_field_data) > 0){					
						$log_data = array();
						foreach ($log_field_data as $field_key => $value) {
							$log_data[] = array('refugee_log_master_id'=> $refugee_log_master_id,
												'change_field'=> $field_key,
												'old_value'=> $value['old_value'],
												'new_value'=> $value['new_value']);
						}
						$this->db->insert_batch('refugee_log_data', $log_data);
					}
				}
				//END INSERT LOG DATA
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

				//START For Log
				$user_new_data = array(
							'email' => $email,
							'skype' => $skype,
							'whatsapp' => $whatsapp,
							'other_contact' => $other_contact,
							'telephone_no' => $telephone_no
						);						
				

				$arr_log_fields = get_user_log_fields();
				$log_field_data = array();

				if(count($arr_log_fields) > 0){
					$arr_user_new_data = $user_new_data;					
					$user_data = $this->refugee_model->get_refugee_data($id);	
					foreach ($arr_log_fields as $field_key => $value) {
						if (isset($arr_user_new_data[$field_key]) && isset($user_data->$field_key)) {
							if (($user_data->$field_key == '0000-00-00') && ($arr_user_new_data[$field_key] == '')) {
								continue;
							}
							if ($arr_user_new_data[$field_key] != $user_data->$field_key) {
								$log_field_data[$field_key] = array('old_value'=> $user_data->$field_key,
																	 'new_value'=> $arr_user_new_data[$field_key]);
							}
						}
					}
				}
				//END For Log

				//Update refugee DB table data from edit page contact tab
				grid_data_updates($data_document,$table,$wher_column_name,$id);      

				//START INSERT LOG DATA
				if((count($log_field_data) > 0)){
					$change_by = $this->session->userdata('user_id');
					$refugee_log_master = array(
						'refugee_id' => $id,
						'change_by' => $change_by,
						'change_date' => date('Y-m-d H:i:s'),
						'type' => 1
					);
					$refugee_log_master_id = grid_add_data($refugee_log_master,'refugee_log_master');

					if(count($log_field_data) > 0){					
						$log_data = array();
						foreach ($log_field_data as $field_key => $value) {
							$log_data[] = array('refugee_log_master_id'=> $refugee_log_master_id,
												'change_field'=> $field_key,
												'old_value'=> $value['old_value'],
												'new_value'=> $value['new_value']);
						}
						$this->db->insert_batch('refugee_log_data', $log_data);
					}
				}
				//END INSERT LOG DATA
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
                        //$this->list_user_model->delete_user_document($user_id,$arrDocumentType[$certificate_type]);
                        foreach($arrFiles as $file_data) {
                            $file = 'uploads/'.$user_id.'/'.$file_data["file_name"];
                            $file_url = base_url().$file;
                            $data_document['type'] = $type;
                            $data_document['user_id'] = $user_id;
                            $data_document['title'] = $file_data["file_name"];                            
                            $data_document['file'] = $file;  

                            //START For Log
							$user_new_data = array(
										'type' => $type,
			                          	'user_id' => $user_id,
			                            'title' => $file_data["file_name"],                            
			                            'file' => $file 
									);					
							

							$arr_log_fields = get_user_log_fields();
							$log_field_data = array();
							$arr_doc_data = array();
							$doc_type = "";

							if(count($arr_log_fields) > 0){
								$arr_user_new_data = $user_new_data;					
								foreach ($arr_log_fields as $field_key => $value) {
									if (isset($arr_user_new_data[$field_key])) {
										$doc_type = $type;
										$arr_doc_data[$field_key] = $arr_user_new_data[$field_key];
									}
								}
								$log_field_data[$doc_type] = array('old_value'=> '',
																	'new_value'=> serialize($arr_doc_data));
							}
							//END For Log

							//Add refugee Doc DB table data from edit page photo,video,document tab
							$id = grid_add_data($data_document,$table);     

							//START INSERT LOG DATA
							if((count($log_field_data) > 0)){
								$change_by = $this->session->userdata('user_id');
								$refugee_log_master = array(
									'refugee_id' => $user_id,
									'change_by' => $change_by,
									'change_date' => date('Y-m-d H:i:s'),
									'type' => 1
								);
								$refugee_log_master_id = grid_add_data($refugee_log_master,'refugee_log_master');

								if(count($log_field_data) > 0){					
									$log_data = array();
									foreach ($log_field_data as $field_key => $value) {
										$log_data[] = array('refugee_log_master_id'=> $refugee_log_master_id,
															'change_field'=> $field_key,
															'old_value'=> $value['old_value'],
															'new_value'=> $value['new_value']);
									}
									$this->db->insert_batch('refugee_log_data', $log_data);
								}
							}
							//END INSERT LOG DATA                          
                            

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

			//START For Log
			$user_new_data = array(
						'type' => 'set',
                      	'user_id' => 'set',
                        'title' => 'set',                            
                        'file' => 'set' 
					);					
			

			$arr_log_fields = get_user_log_fields();
			$log_field_data = array();
			$doc_type = '';
			$refugee_id = 0;
			$arr_doc_data = array();
			if(count($arr_log_fields) > 0){
				$arr_user_new_data = $user_new_data;	
				$user_data = $this->refugee_model->get_refugee_doc_by_id($id);

				foreach ($arr_log_fields as $field_key => $value) {
					if (isset($arr_user_new_data[$field_key]) && isset($user_data->$field_key)) {
						$refugee_id = $user_data->user_id;
						$doc_type = $user_data->type;
						$arr_doc_data[$field_key] = $user_data->$field_key;
					}
				}

				$log_field_data[$doc_type] = array('old_value'=> serialize($arr_doc_data),
													'new_value'=> 'Deleted');
			}
			//END For Log
			
			//DELETE refugee Doc from edit page photo,video,document tab
			grid_delete($table,$wher_column_name,$id);     

			//START INSERT LOG DATA
			if((count($log_field_data) > 0)){
				$change_by = $this->session->userdata('user_id');
				$refugee_log_master = array(
					'refugee_id' => $refugee_id,
					'change_by' => $change_by,
					'change_date' => date('Y-m-d H:i:s'),
					'type' => 1
				);
				$refugee_log_master_id = grid_add_data($refugee_log_master,'refugee_log_master');

				if(count($log_field_data) > 0){					
					$log_data = array();
					foreach ($log_field_data as $field_key => $value) {
						$log_data[] = array('refugee_log_master_id'=> $refugee_log_master_id,
											'change_field'=> $field_key,
											'old_value'=> $value['old_value'],
											'new_value'=> $value['new_value']);
					}
					$this->db->insert_batch('refugee_log_data', $log_data);
				}
			}
			//END INSERT LOG DATA 

	        $info->sucess = $success;
	        $info->path = $file;
	        $info->file = $is_file;
    	}
		echo json_encode(array($info));
        exit();
	}

	public function load_qualifications($refugee_id,$view_only = 0) {    	

        $order_by = "title";
        $sort_order = "asc";
    	
    	$data = $this->refugee_model->get_qualifications($refugee_id,$order_by, $sort_order);    	
    	$output = '<div class="table-scrollable table-scrollable-borderless">
					<table class="table table-hover table-light" id="grid_qualifications">
					<thead>
					<tr class="uppercase">
						<th>'.$this->lang->line('title').'</th>
						<th>'.$this->lang->line('institute').'</th>
						<!--<th>'.$this->lang->line('grade').'</th>-->
						<th>'.$this->lang->line('year').'</th>';
		$output .= ($view_only == 0)?'<th></th>': '';
		$output .= '</tr>
					</thead>
					<tbody>';
    	if($data){
    		foreach($data->result_array() AS $result_row){

                $action_btn = '';
                if($view_only == 0){
                $action_btn .= '<a href="'.base_url('refugee_register/add_qualifications/'.$result_row["refugee_id"].'/'.$result_row["id"]).'" class="btn default btn-xs blue" data-target="#myModal" data-toggle="modal"><i class="fa fa-edit"></i> </a>';
                $action_btn .= '<a href="javascript:;" onclick=table_delete("refugee_qualifications","id",'.$result_row["id"].'); class="btn default btn-xs red"><i class="fa fa-trash-o"></i></a>';
            	}
                $output .= '<tr>';
    			$output .= '<td>'.$result_row["title"].'</td>';
    			$output .= '<td>'.$result_row["institute"].'</td>';
    			//$output .= '<td>'.$result_row["grade"].'</td>';
    			$output .= '<td>'.$result_row["pass_year"].'</td>';
                $output .= ($view_only == 0)?'<td align="right">'.$action_btn.'</td>': '';
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
    		//$grade = $this->input->post('grade');
    		$pass_year = $this->input->post('pass_year');

    		$data = array();
			$data['refugee_id'] = $refugee_id;
			$data['title'] = $title;
			$data['institute'] = $institute;
			//$data['grade'] = $grade;
			$data['pass_year'] = $pass_year;
			$table = 'refugee_qualifications';
			$wher_column_name = 'id';
    		
    		if($id){
    			//START For Log
				$user_new_data = array(
							'title' => $title,
							'institute' => $institute,
							//'grade' => $grade,
							'pass_year' => $pass_year
						);						
				

				$arr_log_fields = get_user_qual_log_fields();
				$log_field_data = array();

				if(count($arr_log_fields) > 0){
					$arr_user_new_data = $user_new_data;					
					$user_data = $this->refugee_model->get_qualifications_data($id);	
					foreach ($arr_log_fields as $field_key => $value) {
						if (isset($arr_user_new_data[$field_key]) && isset($user_data->$field_key)) {
							if (($user_data->$field_key == '0000-00-00') && ($arr_user_new_data[$field_key] == '')) {
								continue;
							}
							if ($arr_user_new_data[$field_key] != $user_data->$field_key) {
								$log_field_data[$field_key] = array('old_value'=> $user_data->$field_key,
																	 'new_value'=> $arr_user_new_data[$field_key]);
							}
						}
					}
				}
				//END For Log

				//Update refugee_qualifications DB table data from edit page info tab
				grid_data_updates($data,$table,$wher_column_name,$id);     

				//START INSERT LOG DATA
				if((count($log_field_data) > 0)){
					$change_by = $this->session->userdata('user_id');
					$refugee_log_master = array(
						'refugee_id' => $refugee_id,
						'change_by' => $change_by,
						'change_date' => date('Y-m-d H:i:s'),
						'type' => 1
					);
					$refugee_log_master_id = grid_add_data($refugee_log_master,'refugee_log_master');

					if(count($log_field_data) > 0){					
						$log_data = array();
						foreach ($log_field_data as $field_key => $value) {
							$log_data[] = array('refugee_log_master_id'=> $refugee_log_master_id,
												'change_field'=> 'qual_'.$field_key,
												'old_value'=> $value['old_value'],
												'new_value'=> $value['new_value']);
						}
						$this->db->insert_batch('refugee_log_data', $log_data);
					}
				}
				//END INSERT LOG DATA
    			  			
    		}else{
    			//START For Log
				$user_new_data = array(
							'title' => $title,
							'institute' => $institute,
							//'grade' => $grade,
							'pass_year' => $pass_year
						);						
				

				$arr_log_fields = get_user_qual_log_fields();
				$log_field_data = array();

				if(count($arr_log_fields) > 0){
					$arr_user_new_data = $user_new_data;					
					$user_data = $this->refugee_model->get_qualifications_data($id);	
					foreach ($arr_log_fields as $field_key => $value) {
						if (isset($arr_user_new_data[$field_key])) {
								$log_field_data[$field_key] = array('old_value'=> '',
																	 'new_value'=> $arr_user_new_data[$field_key]);
						}
					}
				}
				//END For Log

				//Add refugee_qualifications DB table data from edit page info tab
				$lastinsertid = grid_add_data($data,$table);    

				//START INSERT LOG DATA
				if((count($log_field_data) > 0)){
					$change_by = $this->session->userdata('user_id');
					$refugee_log_master = array(
						'refugee_id' => $refugee_id,
						'change_by' => $change_by,
						'change_date' => date('Y-m-d H:i:s'),
						'type' => 1
					);
					$refugee_log_master_id = grid_add_data($refugee_log_master,'refugee_log_master');

					if(count($log_field_data) > 0){					
						$log_data = array();
						foreach ($log_field_data as $field_key => $value) {
							$log_data[] = array('refugee_log_master_id'=> $refugee_log_master_id,
												'change_field'=> 'qual_'.$field_key,
												'old_value'=> $value['old_value'],
												'new_value'=> $value['new_value']);
						}
						$this->db->insert_batch('refugee_log_data', $log_data);
					}
				}
				//END INSERT LOG DATA
    		}
    		exit;
    	}
    	$this->template->build('add_qualifications', $content_data);
    }

    public function load_family_members($refugee_id,$view_only = 0) {    	

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
						<th>'.$this->lang->line('age').'</th>';
		$output .= ($view_only == 0)?'<th></th>': '';
		$output .= '</tr>
					</thead>
					<tbody>';
    	if($data){
    		foreach($data->result_array() AS $result_row){

                $action_btn = '';
                if($view_only == 0){
                $action_btn .= '<a href="'.base_url('refugee_register/add_family_members/'.$result_row["refugee_id"].'/'.$result_row["id"]).'" class="btn default btn-xs blue" data-target="#myModal" data-toggle="modal"><i class="fa fa-edit"></i> </a>';
                $action_btn .= '<a href="javascript:;" onclick=table_delete("refugee_family_members","id",'.$result_row["id"].'); class="btn default btn-xs red"><i class="fa fa-trash-o"></i></a>';
            	}
                $output .= '<tr>';
    			$output .= '<td>'.$result_row["name"].'</td>';
    			$output .= '<td>'.relation_dropdown($result_row["relation"]).'</td>';
    			$output .= '<td>'.$result_row["gender"].'</td>';
    			$output .= '<td>'.$result_row["age"].'</td>';
                $output .= ($view_only == 0)?'<td align="right">'.$action_btn.'</td>': '';
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
    			//START For Log
				$user_new_data = array(
							'name' => $name,
							'relation' => $relation,
							'gender' => $gender,
							'age' => $age
						);						
				

				$arr_log_fields = get_user_family_membs_log_fields();
				$log_field_data = array();

				if(count($arr_log_fields) > 0){
					$arr_user_new_data = $user_new_data;					
					$user_data = $this->refugee_model->get_family_members_data($id);	
					foreach ($arr_log_fields as $field_key => $value) {
						if (isset($arr_user_new_data[$field_key]) && isset($user_data->$field_key)) {
							if (($user_data->$field_key == '0000-00-00') && ($arr_user_new_data[$field_key] == '')) {
								continue;
							}
							if ($arr_user_new_data[$field_key] != $user_data->$field_key) {
								$log_field_data[$field_key] = array('old_value'=> $user_data->$field_key,
																	 'new_value'=> $arr_user_new_data[$field_key]);
							}
						}
					}
				}
				//END For Log

				//Update refugee_family_members DB table data from edit page info tab
				grid_data_updates($data,$table,$wher_column_name,$id);    

				//START INSERT LOG DATA
				if((count($log_field_data) > 0)){
					$change_by = $this->session->userdata('user_id');
					$refugee_log_master = array(
						'refugee_id' => $refugee_id,
						'change_by' => $change_by,
						'change_date' => date('Y-m-d H:i:s'),
						'type' => 1
					);
					$refugee_log_master_id = grid_add_data($refugee_log_master,'refugee_log_master');

					if(count($log_field_data) > 0){					
						$log_data = array();
						foreach ($log_field_data as $field_key => $value) {
							$log_data[] = array('refugee_log_master_id'=> $refugee_log_master_id,
												'change_field'=> 'family_'.$field_key,
												'old_value'=> $value['old_value'],
												'new_value'=> $value['new_value']);
						}
						$this->db->insert_batch('refugee_log_data', $log_data);
					}
				}
				//END INSERT LOG DATA	    			
    		}else{
    			//START For Log
				$user_new_data = array(
							'name' => $name,
							'relation' => $relation,
							'gender' => $gender,
							'age' => $age
						);						
				

				$arr_log_fields = get_user_family_membs_log_fields();
				$log_field_data = array();

				if(count($arr_log_fields) > 0){
					$arr_user_new_data = $user_new_data;					
					$user_data = $this->refugee_model->get_qualifications_data($id);	
					foreach ($arr_log_fields as $field_key => $value) {
						if (isset($arr_user_new_data[$field_key])) {
								$log_field_data[$field_key] = array('old_value'=> '',
																	 'new_value'=> $arr_user_new_data[$field_key]);
						}
					}
				}
				//END For Log

				//Add refugee_family_members DB table data from edit page info tab
				$lastinsertid = grid_add_data($data,$table);    

				//START INSERT LOG DATA
				if((count($log_field_data) > 0)){
					$change_by = $this->session->userdata('user_id');
					$refugee_log_master = array(
						'refugee_id' => $refugee_id,
						'change_by' => $change_by,
						'change_date' => date('Y-m-d H:i:s'),
						'type' => 1
					);
					$refugee_log_master_id = grid_add_data($refugee_log_master,'refugee_log_master');

					if(count($log_field_data) > 0){					
						$log_data = array();
						foreach ($log_field_data as $field_key => $value) {
							$log_data[] = array('refugee_log_master_id'=> $refugee_log_master_id,
												'change_field'=> 'family_'.$field_key,
												'old_value'=> $value['old_value'],
												'new_value'=> $value['new_value']);
						}
						$this->db->insert_batch('refugee_log_data', $log_data);
					}
				}
				//END INSERT LOG DATA
    		}
    		exit;
    	}
    	$this->template->build('add_family_members', $content_data);
    }
	
	public function view($id) {

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
		
		$rowdata = array();
		$discussions = false;
		$content_data['timestamp'] = 0;
		if($id){
			$rowdata = $this->refugee_model->get_refugee_data($id);
			$discussions = $this->refugee_model->get_discussions($id);

			if(!$rowdata){
				redirect('refugee_register/');
			}
		}
		else{
			redirect('refugee_register/');
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
		$content_data['discussions'] = $discussions;
		
		$content_data['id'] = $id;
        // set layout data
        $this->template->set_theme(Settings_model::$db_config['default_theme']);
        $this->template->set_layout('school');
        
        $this->template->title($this->lang->line('refugee'));
        $this->template->set_partial('header', 'header');
		$this->template->set_partial('sidebar', 'sidebar');
        $this->template->set_partial('footer', 'footer');
        $this->template->build('view', $content_data);
    }

    public function add_discussion(){
        $data = array();
        if($this->input->post()){
            $refugee_id = $this->input->post('refugee_id');
            $comment = $this->input->post('comment');
            
            if ($refugee_id != '' || $refugee_id > 0) {

	            $data['refugee_id'] = $refugee_id;
	            $data['comment'] = $comment;    
	            $data['user_id'] = $this->session->userdata('user_id');
	            $data['created_at'] = date('Y-m-d H:i:s');

	            $table = 'refugee_discussions';
	            $wher_column_name = 'id';                 
	            
	            $lastinsertid = grid_add_data($data,$table);

	            $first_name = getTableField('users', 'first_name', 'user_id',$this->session->userdata('user_id'));
	            $last_name = getTableField('users', 'last_name', 'user_id',$this->session->userdata('user_id'));

	            $data['author_name'] = $first_name.' '.$last_name;
	            $data['created_at'] = date('m/d/y @ g:ia');
            }
        }
        echo json_encode($data);
        return false;
    }

    public function get_profile_changes_log_json($refugee_id=0,$order_by = "username", $sort_order = "asc", $search = "all", $offset = 0) {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        $aColumns = array('id',
                        'change_by_name',
                        'change_date');
        $grid_data = get_search_data($aColumns);
        $sort_order = $grid_data['sort_order'];
        $order_by = $grid_data['order_by'];
        /*
         * Paging
        */
        $per_page =  $grid_data['per_page'];
        $offset =  $grid_data['offset'];
    
        $data = $this->refugee_model->get_profile_changes_log($per_page, $offset, $order_by, $sort_order, $grid_data['search_data'],$refugee_id);
        $count = $this->refugee_model->get_profile_changes_log(0, 0, "", "", $grid_data['search_data'],$refugee_id);
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
                $id = $result_row['id'];
                               
                $log_data = $this->refugee_model->get_profile_changes_log_data($id);
                $DocumentType = getDocumentType(true);
                $arr_log_fields = get_user_log_fields();
                $strTooltip = '<div style="max-height:250px; overflow:scroll;">';
                $strTooltip .= '<table class="table no-more-tables prop-log-table">';
                $strTooltip .= '<tr><th>Field</th><th>Old Value</th><th>New Value</th></tr>';
                foreach($log_data->result_array() as $data1) {
                    $change_field = $data1["change_field"];
                    $change_field_label = (isset($arr_log_fields[$change_field]))?$arr_log_fields[$change_field]:$change_field;
                    $old_value = '';
                    $new_value = '';
                    $old_value_class = '';
                    $new_value_class = '';
                    if($change_field <> '' && $data1["change_field"] <> 'password'){
                        if($change_field == 'special_case')
						{
							if(is_numeric($data1["old_value"]))
								$old_value = $old_value_tmp = specia_case_dropdown($data1["old_value"]);
							else
								$old_value = $old_value_tmp = $data1["old_value"];
							if(is_numeric($data1["new_value"]))		
								$new_value = $new_value_tmp = specia_case_dropdown($data1["new_value"]);
							else
								$new_value = $new_value_tmp = $data1["new_value"];
						}
						else if($change_field == 'do_you_live_in_tent_house')
						{
							if(is_numeric($data1["old_value"]))
								$old_value = $old_value_tmp = live_dropdown($data1["old_value"]);
							else
								$old_value = $old_value_tmp = $data1["old_value"];
							if(is_numeric($data1["new_value"]))		
								$new_value = $new_value_tmp = live_dropdown($data1["new_value"]);
							else
								$new_value = $new_value_tmp = $data1["new_value"];
						}
						else if($change_field == 'where_do_you_live_location')
						{
							$arrOld = get_refugee_location($data1["old_value"]);
							$arrNew = get_refugee_location($data1["new_value"]);


							if(is_numeric($data1["old_value"]))
								$old_value = $old_value_tmp = $arrOld[$data1["old_value"]];
							else
								$old_value = $old_value_tmp = $data1["old_value"];
							if(is_numeric($data1["new_value"]))		
								$new_value = $new_value_tmp = $arrNew[$data1["new_value"]];
							else
								$new_value = $new_value_tmp = $data1["new_value"];
						}
						else if($change_field == 'need_of_medicationequipment')
						{
							if(is_numeric($data1["old_value"]))
								$old_value = $old_value_tmp = medicationequipment_dropdown($data1["old_value"]);
							else
								$old_value = $old_value_tmp = $data1["old_value"];
							if(is_numeric($data1["new_value"]))		
								$new_value = $new_value_tmp = medicationequipment_dropdown($data1["new_value"]);
							else
								$new_value = $new_value_tmp = $data1["new_value"];
						}
						else if($change_field == 'are_you_sick')
						{
							if(is_numeric($data1["old_value"]))
								$old_value = $old_value_tmp = sick_dropdown($data1["old_value"]);
							else
								$old_value = $old_value_tmp = $data1["old_value"];
							if(is_numeric($data1["new_value"]))		
								$new_value = $new_value_tmp = sick_dropdown($data1["new_value"]);
							else
								$new_value = $new_value_tmp = $data1["new_value"];
						}
						else if($change_field == 'are_you_able_to_work')
						{
							if(is_numeric($data1["old_value"]))
								$old_value = $old_value_tmp = work_dropdown($data1["old_value"]);
							else
								$old_value = $old_value_tmp = $data1["old_value"];
							if(is_numeric($data1["new_value"]))		
								$new_value = $new_value_tmp = work_dropdown($data1["new_value"]);
							else
								$new_value = $new_value_tmp = $data1["new_value"];
						}
						else if($change_field == 'nationality')
						{
							$arrOld = get_nationality_list($data1["old_value"]);
							$arrNew = get_nationality_list($data1["new_value"]);

							if(is_numeric($data1["old_value"]))
								$old_value = $old_value_tmp = $arrOld[$data1["old_value"]];
							else
								$old_value = $old_value_tmp = $data1["old_value"];
							if(is_numeric($data1["new_value"]))		
								$new_value = $new_value_tmp = $arrNew[$data1["new_value"]];
							else
								$new_value = $new_value_tmp = $data1["new_value"];
						}
						else if($change_field == 'association_name')
						{
							$arrOld = get_associatoin_name_list($data1["old_value"]);
							$arrNew = get_associatoin_name_list($data1["new_value"]);
							
							if(is_numeric($data1["old_value"]))
								$old_value = $old_value_tmp = $arrOld[$data1["old_value"]];
							else
								$old_value = $old_value_tmp = $data1["old_value"];
							if(is_numeric($data1["new_value"]))		
								$new_value = $new_value_tmp = $arrNew[$data1["new_value"]];
							else
								$new_value = $new_value_tmp = $data1["new_value"];
						}
						else if($change_field == 'family_relation')
						{
							if(is_numeric($data1["old_value"]))
								$old_value = $old_value_tmp = relation_dropdown($data1["old_value"]);
							else
								$old_value = $old_value_tmp = $data1["old_value"];
							if(is_numeric($data1["new_value"]))		
								$new_value = $new_value_tmp = relation_dropdown($data1["new_value"]);
							else
								$new_value = $new_value_tmp = $data1["new_value"];
						}
						else
						{
							$old_value = $old_value_tmp = $data1["old_value"];
						    $new_value = $new_value_tmp = $data1["new_value"];
						}
                        $old_value_tmp_str = '';
                        $new_value_tmp_str = '';

                        $old_value_tmp2 = @unserialize($old_value_tmp);                        
                        if ($old_value_tmp === 'b:0;' || $old_value_tmp2 !== false) {
                            $group_name = str_replace('', '', $change_field);
                            $arr_log_fields2 = get_user_log_fields_group($group_name);
                            if(is_array($old_value_tmp2) && count($old_value_tmp2) > 0 && count($arr_log_fields2) > 0){
                                $old_value_tmp_str .= '<table border="0" width="100%" class="table no-more-tables prop-log-tabl">';
                                $old_value_tmp_str .=  '<tr>';
                                foreach($arr_log_fields2 as $log_field_key=>$log_field_name) {
                                    $old_value_tmp_str .=  '<th>'.$log_field_name.'</th>';
                                }
                                $old_value_tmp_str .=  '</tr>';  

                                $old_value_tmp_str .=  '<tr>';
                                foreach($arr_log_fields2 as $log_field_key=>$log_field_name) {
                                    $old_value_tmp_str .= '<td>';
                                    $old_value_tmp_str .= (isset($old_value_tmp2[$log_field_key]))?basename($old_value_tmp2[$log_field_key]):'';
                                    $old_value_tmp_str .= '</td>';
                                }
                                $old_value_tmp_str .=  '</tr>';                              
                                
                                /*foreach($old_value_tmp2 as $_old_value_tmp2_key=>$_old_value_tmp2) {
                                    if(is_array($_old_value_tmp2) && count($_old_value_tmp2) > 0){
                                        
                                        if($change_field == 'user_document'){
                                            foreach($_old_value_tmp2 as $__old_value_tmp2_key=>$__old_value_tmp2_name) {
                                                $old_value_tmp_str .=  '<tr>';
                                                $old_value_tmp_str .= '<td>';
                                                $old_value_tmp_str .= (isset($DocumentType[$_old_value_tmp2_key]))?$DocumentType[$_old_value_tmp2_key]:$_old_value_tmp2_key;
                                                $old_value_tmp_str .= '</td>';

                                                $old_value_tmp_str .= '<td>';
                                                $old_value_tmp_str .= basename($__old_value_tmp2_name);
                                                $old_value_tmp_str .= '</td>';
                                                $old_value_tmp_str .=  '</tr>';
                                            }
                                        }else{
                                        	echo "fdfdf";
                                            $old_value_tmp_str .=  '<tr>oooo';
                                            foreach($arr_log_fields2 as $log_field_key=>$log_field_name) {
                                                $old_value_tmp_str .= '<td>';
                                                $old_value_tmp_str .= (isset($_old_value_tmp2[$log_field_key]))?$_old_value_tmp2[$log_field_key]:'';
                                                $old_value_tmp_str .= '</td>';
                                            }
                                            $old_value_tmp_str .=  '</tr>';
                                        }
                                        
                                    }
                                }*/
                                $old_value_tmp_str .=  '</table>';
                            }
                            $old_value = $old_value_tmp_str;
                            $old_value_class = 'in-table';
                        }else{
                            $old_value = addslashes($old_value);
                        }

                        $new_value_tmp2 = @unserialize($new_value_tmp);
                        if ($new_value_tmp === 'b:0;' || $new_value_tmp2 !== false) {
                            $group_name = str_replace('', '', $change_field);
                            $arr_log_fields2 = get_user_log_fields_group($group_name);
                            if(is_array($new_value_tmp2) && count($new_value_tmp2) > 0 && count($arr_log_fields2) > 0){
                                $new_value_tmp_str .= '<table border="0" width="100%" class="table no-more-tables prop-log-tabl">';
                                $new_value_tmp_str .=  '<tr>';
                                foreach($arr_log_fields2 as $log_field_key=>$log_field_name) {
                                    $new_value_tmp_str .=  '<th>'.$log_field_name.'</th>';
                                }
                                $new_value_tmp_str .=  '</tr>';

                                $new_value_tmp_str .=  '<tr>';
                                foreach($arr_log_fields2 as $log_field_key=>$log_field_name) {
                                    $new_value_tmp_str .= '<td>';
                                    $new_value_tmp_str .= (isset($new_value_tmp2[$log_field_key]))?basename($new_value_tmp2[$log_field_key]):'';
                                    $new_value_tmp_str .= '</td>';
                                }
                                $new_value_tmp_str .=  '</tr>';  

                                /*foreach($new_value_tmp2 as $_new_value_tmp2_key=>$_new_value_tmp2) {
                                    if(is_array($_new_value_tmp2) && count($_new_value_tmp2) > 0){
                                        
                                        if($change_field == 'user_document'){
                                            foreach($_new_value_tmp2 as $__new_value_tmp2_key=>$__new_value_tmp2_name) {
                                                $new_value_tmp_str .=  '<tr>';
                                                $new_value_tmp_str .= '<td>';
                                                $new_value_tmp_str .= (isset($DocumentType[$_new_value_tmp2_key]))?$DocumentType[$_new_value_tmp2_key]:$_new_value_tmp2_key;
                                                $new_value_tmp_str .= '</td>';

                                                $new_value_tmp_str .= '<td>';
                                                $new_value_tmp_str .= basename($__new_value_tmp2_name);
                                                $new_value_tmp_str .= '</td>';
                                                $new_value_tmp_str .=  '</tr>';
                                            }
                                        }else{
                                            $new_value_tmp_str .=  '<tr>';
                                            foreach($arr_log_fields2 as $log_field_key=>$log_field_name) {
                                                $new_value_tmp_str .= '<td>';
                                                $new_value_tmp_str .= (isset($_new_value_tmp2[$log_field_key]))?$_new_value_tmp2[$log_field_key]:'';
                                                $new_value_tmp_str .= '</td>';
                                            }
                                            $new_value_tmp_str .=  '</tr>';
                                        }
                                        
                                    }
                                }*/
                                $new_value_tmp_str .=  '</table>';
                            }
                            $new_value = $new_value_tmp_str;
                            $new_value_class = 'in-table';
                        }else{
                            $new_value = addslashes($new_value);
                        }

                    }
                    $strTooltip .= "<tr><td width=\"170px;\">".addslashes($change_field_label)."</td>";
                    $strTooltip .= "<td class=".$old_value_class." style=\"vertical-align:top\">".($old_value)."</td>";
                    $strTooltip .= "<td class=".$new_value_class." style=\"vertical-align:top\">".($new_value)."</td>";
                    $strTooltip .= "</tr>";
                }
                $strTooltip .= '</table>';
                $strTooltip .= '</div>';

                $log_html =  "<a onmouseover='' id=\"popover2\" data-content='".$strTooltip."' data-placement=\"left\" data-toggle=\"popover\" class=\"btn default btn-xs purple\"><i class=\"fa fa-search\"></i></a>";

                $row[] = $id;
                $row[] = $result_row['change_by_name'];  
                $row[] = $result_row['change_date'];
                $row[] = $log_html;
                $output['data'][] = $row;
            }
        }
    
        echo json_encode( $output );
    }
}
/* End of file documents.php */