<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class register extends Private_Controller {
    public function __construct()
    {
        parent::__construct();
        // pre-load
        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->helper('general_function');
		$this->load->model('register_model');
    }
    
	public function index() {
    	$content_data = array();

    	
    	$user_department_id = getTableField('user_profile', 'department_id', 'user_id',$this->session->userdata('user_id'));
    	$arrCampusPrivilages = get_user_campus_privilages();

    	$this->session->set_userdata("globalsearchkwd",$this->input->post('globalsearchkwd'));
    	$globalsearchkwd = $this->input->post('globalsearchkwd');
		
		$human_resources = $this->documents_model->get_documents('2',$globalsearchkwd);
		$assessment = $this->documents_model->get_documents('4',$globalsearchkwd);
		$professional_development = $this->documents_model->get_documents('8',$globalsearchkwd);
		$curriculum = $this->documents_model->get_documents('5',$globalsearchkwd);
		//$curriculum_quarter_2 = $this->documents_model->get_documents('13',$globalsearchkwd);
		//$curriculum_quarter_4 = $this->documents_model->get_documents('14',$globalsearchkwd);

		$all_documents = array(
							'human_resources'=>$human_resources,
							'assessment'=>$assessment,
							'professional_development'=>$professional_development,
							'curriculum'=>$curriculum,
							//'curriculum_quarter_2'=>$curriculum_quarter_2,
							//'curriculum_quarter_4'=>$curriculum_quarter_4,
						 );
		$content_data['campus_list'] = get_campus_list(0,1);
		$content_data['all_documents'] = $all_documents;
		$content_data['user_department_id'] = $user_department_id;
		$content_data['arrCampusPrivilages'] = $arrCampusPrivilages;
		
        // set layout data
        $this->template->set_theme(Settings_model::$db_config['default_theme']);
        $this->template->set_layout('school');
        
        $this->template->title('All Staff Documents');
        $this->template->set_partial('header', 'header');
		$this->template->set_partial('sidebar', 'sidebar');
        $this->template->set_partial('footer', 'footer');
        $this->template->build('documents', $content_data);
    }
	
	public function add($id = null) {
		$user_department_id = 0;
    	$content_data = array();
		
		//$document_types = array('human_resources'=>'Human Resources','assessment'=>'Assessment','professional_development'=>'Professional Development','curriculum'=>'Curriculum','curriculum_quarter_2'=>'Curriculum Quarter 2','curriculum_quarter_4'=>'Curriculum Quarter 4');
		$document_types = array(2,4,8,5);
		$campus_list = array(0,1);

		$errors = "";
		$curr_dir = str_replace("\\","/",getcwd()).'/';
		if($this->input->post()){

			$campus_id = $this->input->post('campus_id');
			if(!empty($campus_id)){
				$campus_id = implode(',',$campus_id);
			}
			$document_type = $this->input->post('document_type');
			$name = $this->input->post('name');
			
			$table = 'documents';		
			$wher_column_name = 'document_id';
			
			$data_document['campus_id'] = $campus_id;
			$data_document['document_type'] = $document_type;
			$data_document['name'] = $name;
			
			if($id){
				grid_data_updates($data_document,$table,$wher_column_name,$id);    
			}else{
				$id = grid_add_data($data_document,$table);
			}
			
			//upload and update the file
			$config['upload_path'] = $curr_dir.'downloads/docs/';
			$config['allowed_types'] = 'jpg|jpeg|pdf|png|xlsx|xls|doc|zip|rar|docx|csv';
			$config['overwrite'] = true;
			$config['remove_spaces'] = true;
			$config['max_size']	= '250999';// in KB
			
			//load upload library
			$this->load->library('upload', $config);
			
			// flag for checking the directory exist or not
			if(!is_dir($curr_dir.'downloads/docs/'))
			{
				mkdir($curr_dir.'downloads/docs/', 0777, true);
			}
			$data = array();		
			
			foreach($_FILES as $field => $file)
			{
				// No problems with the file
				if($file['error'] == 0)
				{
					$config['file_name'] = $id.'_'.$file["name"];
					$this->upload->initialize($config);
					// So lets upload
					if($this->upload->do_upload($field))
					{
						$data[$field] = $this->upload->data();
					}
					else
					{
						$errors .= ''.$this->upload->display_errors()."<br>";
					}
				}
			}
		
			if(isset($data) && is_array($data) && count($data) > 0)
			{
				$data_document = array();
				$doc_file = 'downloads/docs/'.$data['file']["file_name"];
				$data_document['file'] = $doc_file;
				
				if($id){
					$old_file = getTableField($table, 'file', $wher_column_name,$id);
					if(!empty($old_file) && file_exists($old_file)){
						@unlink($old_file);
					}
					grid_data_updates($data_document,$table,$wher_column_name,$id);    
				}
			}
			
			$this->session->set_flashdata('message', 'Document added sucessfully.');
			redirect('documents');
		}
		
		$rowdata= array();
		if($id){
			$rowdata = $this->documents_model->get_document_by_id($id);
			$rowdata->campus_id = (!empty($rowdata->campus_id))?explode(',',$rowdata->campus_id):array();
		}
		$content_data['other_user_roll'] = array(2,4,8,5);
		$content_data['document_types'] = $document_types;
		$content_data['campus_list'] = $campus_list;
		$content_data['user_department_id'] = $user_department_id;
		$content_data['rowdata'] = $rowdata;
		$content_data['id'] = $id;
        // set layout data
        $this->template->set_theme(Settings_model::$db_config['default_theme']);
        $this->template->set_layout('school');
        
        $this->template->title('Add Documents');
        $this->template->set_partial('header', 'header');
		$this->template->set_partial('sidebar', 'sidebar');
        $this->template->set_partial('footer', 'footer');
        $this->template->build('add', $content_data);
    }
	
	public function add_document_model($id = null) {
    	$content_data = array();
		
		//$document_types = array('human_resources'=>'Human Resources','assessment'=>'Assessment','professional_development'=>'Professional Development','curriculum'=>'Curriculum','curriculum_quarter_2'=>'Curriculum Quarter 2','curriculum_quarter_4'=>'Curriculum Quarter 4');
		$document_types = get_department_list(array(2,4,8,5));
		
		$campus_list = get_campus_list(0,1);

		$errors = "";
		$curr_dir = str_replace("\\","/",getcwd()).'/';
		if($this->input->post()){

			$campus_id = $this->input->post('campus_id');
			if(!empty($campus_id)){
				$campus_id = implode(',',$campus_id);
			}
			$document_type = $this->input->post('document_type');
			$name = $this->input->post('name');
			
			$table = 'documents';		
			$wher_column_name = 'document_id';
			
			$data_document['campus_id'] = $campus_id;
			$data_document['document_type'] = $document_type;
			$data_document['name'] = $name;
			
			if($id){
				grid_data_updates($data_document,$table,$wher_column_name,$id);    
			}else{
				$id = grid_add_data($data_document,$table);
			}
			
			//upload and update the file
			$config['upload_path'] = $curr_dir.'downloads/docs/';
			$config['allowed_types'] = 'jpg|jpeg|pdf|png|xlsx|xls|doc|zip|rar|docx|csv';
			$config['overwrite'] = true;
			$config['remove_spaces'] = true;
			$config['max_size']	= '50999';// in KB
			
			//load upload library
			$this->load->library('upload', $config);
			
			// flag for checking the directory exist or not
			if(!is_dir($curr_dir.'downloads/docs/'))
			{
				mkdir($curr_dir.'downloads/docs/', 0777, true);
			}
			$data = array();		
			
			foreach($_FILES as $field => $file)
			{
				// No problems with the file
				if($file['error'] == 0)
				{
					$config['file_name'] = $id.'_'.$file["name"];
					$this->upload->initialize($config);
					// So lets upload
					if($this->upload->do_upload($field))
					{
						$data[$field] = $this->upload->data();
					}
					else
					{
						$errors .= ''.$this->upload->display_errors()."<br>";
					}
				}
			}
		
			if(isset($data) && is_array($data) && count($data) > 0)
			{
				$data_document = array();
				$doc_file = 'downloads/docs/'.$data['file']["file_name"];
				$data_document['file'] = $doc_file;
				
				if($id){
					$old_file = getTableField($table, 'file', $wher_column_name,$id);
					if(!empty($old_file) && file_exists($old_file)){
						@unlink($old_file);
					}
					grid_data_updates($data_document,$table,$wher_column_name,$id);    
				}
			}
			
			//$this->session->set_flashdata('message', 'Document added sucessfully.');
			//redirect('documents');
			exit;			
		}
		
		$rowdata= array();
		if($id){
			$rowdata = $this->documents_model->get_document_by_id($id);
			$rowdata->campus_id = (!empty($rowdata->campus_id))?explode(',',$rowdata->campus_id):array();
		}
		$content_data['other_user_roll'] = get_other_user_roll();
		$content_data['document_types'] = $document_types;
		$content_data['campus_list'] = $campus_list;
		$content_data['rowdata'] = $rowdata;
		$content_data['id'] = $id;
        
        $this->template->build('add_document_model', $content_data);
    }
	
   public function delete($id = null){
    	if($id){
			$table = 'documents';
			$wher_column_name = 'document_id';
			$file = getTableField($table, 'file', $wher_column_name,$id);
			if(!empty($file) && file_exists($file)){
				@unlink($file);
			}
    		$this->courses_model->delete_data($table,$wher_column_name,$id);
    	}
		redirect('/documents/');
        exit();
	}
	
}
/* End of file documents.php */