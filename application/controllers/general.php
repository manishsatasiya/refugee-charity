<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General extends Private_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');        
        $this->load->library('form_validation');
        $this->load->helper('general_function');
		
		// load model
        //$this->load->model('list_bug/bug_model');
    }

    public function index() {
    	redirect('home');
    }

    public function delete() {    	
    	    
        $table = $this->input->post('table');
		$where_col = $this->input->post('where_col'); 
		$where_col_id = $this->input->post('where_col_id'); 
		if($where_col_id != '' && $where_col_id != 0)
            echo grid_delete($table,$where_col,$where_col_id);

        return;
    }

    public function field_update() {      
            
        $table = $this->input->post('t');
        $where_col = $this->input->post('wc'); 
        $where_col_id = $this->input->post('wci');

        $field_col = $this->input->post('fc'); 
        $field_col_val = $this->input->post('fcv');

        $data[$field_col] = $field_col_val;
        grid_data_updates($data,$table,$where_col,$where_col_id);
        return;
    }

}

/* End of file general.php */