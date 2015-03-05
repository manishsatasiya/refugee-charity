<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class refugee_settings extends Private_Controller {
    public function __construct()
    {
        parent::__construct();
        // pre-load
        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->helper('general_function');
		$this->load->model('refugee_settings_model');
    }
    
	public function index() {
    	//echo "dfdsf";exit();
        $content_data = array();

        // set layout data
        $this->template->set_theme(Settings_model::$db_config['default_theme']);
        $this->template->set_layout('school');
        
        $this->template->title($this->lang->line('Refugee settings'));
        $this->template->set_partial('header', 'header');
        $this->template->set_partial('sidebar', 'sidebar');
        $this->template->set_partial('footer', 'footer');
        $this->template->build('refugee_settings', $content_data);
    }
    
    public function index_json() {
    	/* Array of database columns which should be read and sent back to DataTables. Use a space where
    	 * you want to insert a non-database field (for example a counter or static image)
    	*/
    	$aColumns = array( 'id','name' );
    	$grid_data = get_search_data($aColumns);
    	$sort_order = $grid_data['sort_order'];
    	$order_by = $grid_data['order_by'];

        if($order_by == '')
            $order_by = "name";
        if($sort_order == '')
            $sort_order = "asc";
    	/*
    	 * Paging
    	*/
    	$per_page =  $grid_data['per_page'];
    	$offset =  $grid_data['offset'];
    	
    	$data = $this->refugee_settings_model->get_location_association($per_page, $offset, $order_by, $sort_order, $grid_data['search_data']);
    	$count = $this->refugee_settings_model->get_location_association($per_page, $offset, $order_by, $sort_order, $grid_data['search_data'],true);
    	 
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
                    $action_btn .= '<a href="'.base_url('refugee_settings/add/'.$result_row["id"]).'" class="btn default btn-xs blue" data-target="#myModal" data-toggle="modal"><i class="fa fa-edit"></i> </a>';
                }
                $action_btn .= '<a href="javascript:;" onclick=dt_delete("location_association","id",'.$result_row["id"].'); class="btn default btn-xs red"><i class="fa fa-trash-o"></i></a>';

    			$row[] = $result_row["id"];
    			$row[] = $result_row["name"];
                $row[] = $action_btn;
    			$output['data'][] = $row;
    		}
    	}
    	
    	echo json_encode( $output );
    }
	
	public function add($id = null) {
    	$content_data['id'] = $id;
    	$rowdata = array();
    	if($id){
    		$rowdata = $this->refugee_settings_model->get_location_association_data($id);
    	}
    
    	$content_data['rowdata'] = $rowdata;
    	if($this->input->post()){
    		$name = $this->input->post('name');

    		$data = array();
			$data['name'] = $name;
			$table = 'location_association';
			$wher_column_name = 'id';
    		
    		if($id){
    			grid_data_updates($data,$table,$wher_column_name,$id);
    			
    		}else{
    			$lastinsertid = grid_add_data($data,$table);
    		}
    		exit;
    	}
    	$this->template->build('add_location_association', $content_data);
    }


    public function association_name_json() {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        $aColumns = array( 'id','name' );
        $grid_data = get_search_data($aColumns);
        $sort_order = $grid_data['sort_order'];
        $order_by = $grid_data['order_by'];

        if($order_by == '')
            $order_by = "name";
        if($sort_order == '')
            $sort_order = "asc";
        /*
         * Paging
        */
        $per_page =  $grid_data['per_page'];
        $offset =  $grid_data['offset'];
        
        $data = $this->refugee_settings_model->get_association_name($per_page, $offset, $order_by, $sort_order, $grid_data['search_data']);
        $count = $this->refugee_settings_model->get_association_name($per_page, $offset, $order_by, $sort_order, $grid_data['search_data'],true);
         
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
                    $action_btn .= '<a href="'.base_url('refugee_settings/add_association_name/'.$result_row["id"]).'" class="btn default btn-xs blue" data-target="#myModal" data-toggle="modal"><i class="fa fa-edit"></i> </a>';
                }
                $action_btn .= '<a href="javascript:;" onclick=dt_delete("association_name","id",'.$result_row["id"].'); class="btn default btn-xs red"><i class="fa fa-trash-o"></i></a>';

                $row[] = $result_row["id"];
                $row[] = $result_row["name"];
                $row[] = $action_btn;
                $output['data'][] = $row;
            }
        }
        
        echo json_encode( $output );
    }
    
    public function add_association_name($id = null) {
        $content_data['id'] = $id;
        $rowdata = array();
        if($id){
            $rowdata = $this->refugee_settings_model->get_association_name_data($id);
        }
    
        $content_data['rowdata'] = $rowdata;
        if($this->input->post()){
            $name = $this->input->post('name');

            $data = array();
            $data['name'] = $name;
            $table = 'association_name';
            $wher_column_name = 'id';
            
            if($id){
                grid_data_updates($data,$table,$wher_column_name,$id);
                
            }else{
                $lastinsertid = grid_add_data($data,$table);
            }
            exit;
        }
        $this->template->build('add_association_name', $content_data);
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
        	$data = $this->refugee_settings_model->get_refugee_doc($type,$user_id);
	    	    
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