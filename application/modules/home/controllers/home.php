<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Private_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('home_model');
		$this->load->model('list_role/list_role_model');
    }

    public function index() {
		$user_id = $this->session->userdata('user_id');
		$user_role = $this->session->userdata('role_id');
		
		$content_data = array();
        $this->template->set_theme(Settings_model::$db_config['default_theme']);
        $this->template->set_layout('school');
        $this->template->title('home page');
        $this->template->set_partial('header', 'header');
		$this->template->set_partial('sidebar', 'sidebar');
        $this->template->set_partial('footer', 'footer');
        
		$this->template->build('homepage', $content_data);
		
    }
    
	// no access view if user has no privilage
    function no_access(){
    	$content_data = array();
    	$this->template->set_theme(Settings_model::$db_config['default_theme']);
    	$this->template->set_layout('school');
    	$this->template->title('No Access');
    	$this->template->set_partial('header', 'header');
		$this->template->set_partial('sidebar', 'sidebar');
    	$this->template->set_partial('footer', 'footer');
    	$this->template->build('no_access', $content_data);
    }
}

/* End of file home.php */