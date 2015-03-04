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

		$errors = "";
		if($this->input->post()){

			$date_of_data_entry = $this->input->post('date_of_data_entry');
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
			$what_qualifications_do_you_have = $this->input->post('what_qualifications_do_you_have');
			$are_you_sick = $this->input->post('are_you_sick');
			$need_of_medicationequipment = $this->input->post('need_of_medicationequipment');
			$if_yes_please_specify = $this->input->post('if_yes_please_specify');
			$where_do_you_live_location = $this->input->post('where_do_you_live_location');
			$do_you_live_in_tent_house = $this->input->post('do_you_live_in_tent_house');
			$what_is_it_that_you_need_most = $this->input->post('what_is_it_that_you_need_most');
			$how_many_children_do_you_have = $this->input->post('how_many_children_do_you_have');
			$childrens_names_ages_genders = $this->input->post('childrens_names_ages_genders');
			$other_family_members_names_ages_genders = $this->input->post('other_family_members_names_ages_genders');
			$name_administrator = $this->input->post('name_administrator');
			$any_other_information = $this->input->post('any_other_information');
			$special_case = $this->input->post('special_case');
			$special_case_more_info = $this->input->post('special_case_more_info');
			$total_number_of_people_in_house = $this->input->post('total_number_of_people_in_house');
			$month = $this->input->post('month');
			$year = $this->input->post('year');			
			
			$data_document['date_of_data_entry'] = $date_of_data_entry;
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
			$data_document['what_qualifications_do_you_have'] = $what_qualifications_do_you_have;
			$data_document['are_you_sick'] = $are_you_sick;
			$data_document['need_of_medicationequipment'] = $need_of_medicationequipment;
			$data_document['if_yes_please_specify'] = $if_yes_please_specify;
			$data_document['where_do_you_live_location'] = $where_do_you_live_location;
			$data_document['do_you_live_in_tent_house'] = $do_you_live_in_tent_house;
			$data_document['what_is_it_that_you_need_most'] = $what_is_it_that_you_need_most;
			$data_document['how_many_children_do_you_have'] = $how_many_children_do_you_have;
			$data_document['childrens_names_ages_genders'] = $childrens_names_ages_genders;
			$data_document['other_family_members_names_ages_genders'] = $other_family_members_names_ages_genders;
			$data_document['name_administrator'] = $name_administrator;
			$data_document['any_other_information'] = $any_other_information;
			$data_document['special_case'] = $special_case;
			$data_document['special_case_more_info'] = $special_case_more_info;
			$data_document['total_number_of_people_in_house'] = $total_number_of_people_in_house;
			$data_document['month'] = $month;
			$data_document['year'] = $year;

			$table = 'refugee';		
			$wher_column_name = 'id';
			if($id){
				grid_data_updates($data_document,$table,$wher_column_name,$id);    
			}else{
				$data_document['created_date'] = date("Y-m-d H:i:s");
				$id = grid_add_data($data_document,$table);
			}
						
			$this->session->set_flashdata('message', $this->lang->line('save_success'));
			redirect('refugee_register');
		}
		
		$rowdata= array();
		if($id){
			$rowdata = $this->refugee_model->get_refugee_data($id);
		}

		$content_data['work_list'] = $work_list;
		$content_data['age_list'] = $age_list;
		$content_data['gender_list'] = $gender_list;
		$content_data['children_list'] = $children_list;
		$content_data['housepeople_list'] = $housepeople_list;
		$content_data['maritalstatus_list'] = $maritalstatus_list;
		$content_data['nationality_list'] = $nationality_list;
		$content_data['sicklist'] = $sicklist;
		$content_data['medicationequipment_list'] = $medicationequipment_list;
		$content_data['livelist'] = $livelist;
		$content_data['specia_case_list'] = $specia_case_list;
		$content_data['month_list'] = $month_list;
		$content_data['year_list'] = $year_list;

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
            $config['encrypt_name'] = TRUE;
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
                        $file_names[] = $field.'_'.$file_name;
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
                            $data_document['file'] = $file;                            
                            $id = grid_add_data($data_document,$table);

                            //set the data for the json array
				            $info = new StdClass;
				            $info->name = $file_data['file_name'];
				            $info->size = $file_data['file_size'] * 1024;
				            $info->type = $file_data['file_type'];
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

	    			$file_url = base_url().$file;
	    			//set the data for the json array
		            $info = new StdClass;
		            $info->name = basename($file);
		            $info->size = filesize($file);
		            //$info->type = $file_data['file_type'];
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
	
}
/* End of file documents.php */