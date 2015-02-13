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

}

/* End of file general.php */