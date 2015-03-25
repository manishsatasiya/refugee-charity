<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class List_user extends Private_Controller {

    public function __construct()
    {
        parent::__construct();
        // pre-load
        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->model('list_user_model');
		$this->load->helper('general_function');
		$this->load->model('add_privilege/privilege_model');
    }

    /*
     *
     * index
     *
     * @param int $order_by order by this data column
     * @param string $sort_order asc or desc
     * @param string $search search type, used in index to determine what to display
     * @param int $offset the offset to be used for selecting data
     *
     */

    public function index($id = 0) {
        $content_data = array();

        // set layout data
        $this->template->set_theme(Settings_model::$db_config['default_theme']);
        $this->template->set_layout('school');
        
        $this->template->title('List User');
        $this->template->set_partial('header', 'header');
        $this->template->set_partial('sidebar', 'sidebar');
        $this->template->set_partial('footer', 'footer');
        $this->template->build('list_user', $content_data);
    }
    
    public function index_json($order_by = "username", $sort_order = "asc", $search = "all", $offset = 0) {
    	/* Array of database columns which should be read and sent back to DataTables. Use a space where
    	 * you want to insert a non-database field (for example a counter or static image)
    	*/
    	$aColumns = array('users.user_id',
						'user_roll_name',
						'name',
						'email',
						'birth_date',
						'gender',
						'cell_phone',
						'active',
						'users.created_date',
						'users.updated_date');

    	$grid_data = get_search_data($aColumns);
    	$sort_order = $grid_data['sort_order'];
		$order_by = $grid_data['order_by'];
    	/*
    	 * Paging
    	*/
    	$per_page =  $grid_data['per_page'];
    	$offset =  $grid_data['offset'];
    
    	$data = $this->list_user_model->get_users($per_page, $offset, $order_by, $sort_order, $grid_data['search_data']);
    	$count = $this->list_user_model->get_users($per_page, $offset, $order_by, $sort_order, $grid_data['search_data'],true);
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
                    $action_btn .= '<li><a href="'.base_url('list_user/add/'.$result_row["user_id"]).'" class="" data-target="#myModal" data-toggle="modal"><i class="fa fa-edit"></i> '.$this->lang->line('edit').'</a></li>';
                }
                $action_btn .= '<li><a href="javascript:;" onclick=dt_delete("users","user_id",'.$result_row["user_id"].'); class=""><i class="fa fa-trash-o"></i> '.$this->lang->line('delete').'</a></li>';
                $action_btn .= '</ul></div>';

                $active = ($result_row['active'] == 1)? $this->lang->line('active') : $this->lang->line('inactive');
                
				$row[] = $result_row['user_id'];
				$row[] = $result_row['user_roll_name'];
				$row[] = $result_row['name'];
				$row[] = $result_row['email'];
				$row[] = $result_row['birth_date'];
				$row[] = $result_row['gender'];
				$row[] = $result_row['cell_phone'];
				$row[] = $active;
				$row[] = $result_row['created_date'];
				$row[] = $result_row['updated_date'];
                $row[] = $action_btn;
    			$output['data'][] = $row;
    		}
    	}
    
    	echo json_encode( $output );
    }
    
    public function add($id = null){
    	$content_data['other_user_roll'] = get_user_roll();
        
    	$content_data['id'] = $id;
    	$rowdata = array();
    	if($id){
    		$rowdata = $this->list_user_model->get_user_by_id($id);
    	}
    	 
    	$content_data['rowdata'] = $rowdata;
    	if($this->input->post()){
    		$nonce = md5(uniqid(mt_rand(), true));
            $user_roll_id = $this->input->post('user_roll_id');
            $password = $this->input->post('password');
                
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['email'] = $this->input->post('email');
            $data['address1'] = $this->input->post('address1');
            $data['city'] = $this->input->post('city');
            $data['state'] = $this->input->post('state');
            $data['country'] = $this->input->post('country');
            $data['zip'] = $this->input->post('zip');
            $data['birth_date'] = make_db_date($this->input->post('birth_date'));
            $data['cell_phone'] = $this->input->post('cell_phone');
            $data['username'] = $this->input->post('username');
            $data['user_roll_id'] = $user_roll_id;
            $data['gender'] = $this->input->post('gender');            
            $data['updated_date'] = date('Y-m-d H:i:s');

    		$error = "";
    		$error_seperator = "\n";
    		if($id){
    			 
    			$this->form_validation->set_rules('first_name', 'first name', 'trim|required|max_length[40]|min_length[2]');
                $this->form_validation->set_rules('last_name', 'last name', 'trim|required|max_length[40]|min_length[2]');
		        $this->form_validation->set_rules('email', 'email', 'trim|required|max_length[255]|is_valid_email|is_existing_field[users.email^users.user_id !=^'.$id.']');
				if ($password <> '') {
                    $this->form_validation->set_rules('password', 'password', 'trim|required|max_length[64]|min_length[6]|matches[password_confirm]');
                    $this->form_validation->set_rules('password_confirm', 'repeat password', 'trim|required|max_length[64]');
                }
		       	if (!$this->form_validation->run()) {
    				if (form_error('first_name')) {
    					$error .= form_error('first_name').$error_seperator;
    				}elseif (form_error('last_name')) {
                        $error .= form_error('last_name').$error_seperator;
                    }elseif (form_error('email')) {
    					$error .= form_error('email').$error_seperator;
    				}elseif (form_error('password')) {
                        $error .= form_error('password').$error_seperator;
                    }elseif (form_error('password_confirm')) {
                        $error .= form_error('password_confirm').$error_seperator;
                    }
    				echo $error;
    				exit();
    			}
    			
    			if ($password <> '') {
                    $data['password'] = hash_password($password, $nonce);
                    $data['nonce'] = $nonce;
                }    			
				
                        
    			$old_roll_id = $this->list_user_model->get_user_roll($id);
				if($old_roll_id != $user_roll_id && $user_roll_id > 0) {
					$roll_privilege = array();
					$this->list_user_model->create_single_user_privilege($id, $roll_privilege);
				}
				
    			$table = 'users';
    			$wher_column_name = 'user_id';
    			set_activity_data_log($id,'Update','Role & User > List User','List User',$table,$wher_column_name,$user_id='');
    			grid_data_updates($data,$table,$wher_column_name,$id);
    			
    		}else{
    			 
    			$this->form_validation->set_rules('first_name', 'first name', 'trim|required|max_length[40]|min_length[2]');
                $this->form_validation->set_rules('last_name', 'last name', 'trim|required|max_length[40]|min_length[2]');
		        $this->form_validation->set_rules('email', 'e-mail', 'trim|required|max_length[255]|is_valid_email|is_existing_unique_field[users.email]');
		        $this->form_validation->set_rules('password', 'password', 'trim|required|max_length[64]|min_length[6]|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', 'repeat password', 'trim|required|max_length[64]|min_length[6]');

		       	if (!$this->form_validation->run()) {
    				if (form_error('first_mame')) {
    					$error .= form_error('first_mame').$error_seperator;
    				}elseif (form_error('last_name')) {
                        $error .= form_error('last_name').$error_seperator;
                    }elseif (form_error('email')) {
    					$error .= form_error('email').$error_seperator;
    				}elseif (form_error('username')) {
    					$error .= form_error('username').$error_seperator;
    				}elseif (form_error('password')) {
    					$error .= form_error('password').$error_seperator;
    				}elseif (form_error('password_confirm')) {
    					$error .= form_error('password_confirm').$error_seperator;
    				}
    				echo $error;
    				exit();
    			}
    			$data['password'] = hash_password($password, $nonce);

    			$data['active'] = '1';
    			$data['nonce'] = $nonce;
    			$data['created_date'] = date('Y-m-d H:i:s');
    			$table = 'users';
    			$wher_column_name = 'user_id';
    			$lastinsertid = grid_add_data($data,$table);
    			set_activity_data_log($lastinsertid,'Add','Role & User > List User','List User',$table,$wher_column_name,$user_id='');
    		}
    		exit;
    	}
    	$this->template->build('add_user_datatable', $content_data);
    }
    	
	public function delete($id = null){
    	if($id){
			$table = 'users';
			$wher_column_name = 'user_id';
			set_activity_data_log($id,'Delete','Role & User > List User','List User',$table,$wher_column_name,$user_id='');
			grid_delete($table,$wher_column_name,$id);
    	}
		redirect('/list_user/');
        exit();
	}
}

/* End of file list_user.php */