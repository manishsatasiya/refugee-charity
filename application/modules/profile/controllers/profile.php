<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends Private_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->model('profile_model');
    }

    public function index($user_id = 0) {

        $user_id = encrypt_decrypt('d', $user_id);
        // set content data
        $user_data = $this->profile_model->get_profile($user_id);
        if(!$user_data)
            redirect('list_user');

        $profile_picture = get_profile_pic($user_id);
        $profile_picture = $profile_picture[150];

        $content_data['user_id'] = $user_id;
        $content_data['user_data'] = $user_data;
        $content_data['profile_picture'] = $profile_picture;

        $this->template->set_theme(Settings_model::$db_config['default_theme']);
        $this->template->set_layout('school');
        $this->template->title('profile');
        $this->template->set_partial('header', 'header');
        $this->template->set_partial('sidebar', 'sidebar');
        $this->template->set_partial('footer', 'footer');
        $this->template->build('profile', $content_data);
    }

    /**
     *
     * update_account: update member info
     *
     */

    public function update_account() {
        $user_id = $this->input->post('user_id');
        // form input validation
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('first_name', 'first name', 'trim|required|max_length[40]|min_length[2]');
        $this->form_validation->set_rules('last_name', 'last name', 'trim|required|max_length[40]|min_length[2]');
        //$this->form_validation->set_rules('email', 'email', 'trim|max_length[255]|is_valid_email|is_existing_unique_field[users.email]');
        //$this->form_validation->set_rules('password', 'password', 'trim|required|is_member_password');
        
        if (!$this->form_validation->run())
        {
            if (form_error('first_name')) {
                $this->session->set_flashdata('message', form_error('first_name'));
            }elseif (form_error('last_name')) {
                $this->session->set_flashdata('message', form_error('last_name'));
            }elseif (form_error('email')) {
                $this->session->set_flashdata('message', form_error('email'));
            }elseif (form_error('password')) {
                $this->session->set_flashdata('message', form_error('password'));
            }
			// redirect to profile on fail with error
            redirect('profile/'.encrypt_decrypt('e', $user_id));
            exit();
        }
        
        $data['first_name'] = $this->input->post('first_name');
        $data['last_name'] = $this->input->post('last_name');
        //$data['email'] = $this->input->post('email');
        $data['address1'] = $this->input->post('address1');
        $data['city'] = $this->input->post('city');
        $data['state'] = $this->input->post('state');
        $data['country'] = $this->input->post('country');
        $data['zip'] = $this->input->post('zip');
        $data['birth_date'] = make_db_date($this->input->post('birth_date'));
        $data['cell_phone'] = $this->input->post('cell_phone');
        //$data['username'] = $this->input->post('username');
        //$data['user_roll_id'] = $user_roll_id;
        $data['gender'] = $this->input->post('gender');            
        $data['updated_date'] = date('Y-m-d H:i:s');

        $table = 'users';
        $wher_column_name = 'user_id';
        grid_data_updates($data,$table,$wher_column_name,$user_id);

        $this->session->set_flashdata('message', $this->lang->line('account_updated'));
        redirect('profile/'.encrypt_decrypt('e', $user_id));
        exit();
    }

    /**
     *
     * update_password: change member password
     *
     *
     */

    public function update_password() {
        $user_id = $this->input->post('user_id');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('current_password', 'current password', 'trim|required|max_length[64]|is_member_password['.$user_id.']');
        $this->form_validation->set_rules('new_password', 'new password', 'trim|required|max_length[64]|min_length[6]|matches[new_password_again]');
        $this->form_validation->set_rules('new_password_again', 'confirm new password', 'trim|required|max_length[64]|min_length[6]');
        
        if (!$this->form_validation->run())
        {
            if (form_error('current_password')) {
                $this->session->set_flashdata('errormessage', form_error('current_password'));
            }elseif (form_error('new_password')) {
                $this->session->set_flashdata('errormessage', form_error('new_password'));
            }elseif (form_error('new_password_again')) {
                $this->session->set_flashdata('errormessage', form_error('new_password_again'));
            }

            redirect('profile/'.encrypt_decrypt('e', $user_id));
            exit();
        }

        if ($this->profile_model->set_password($this->input->post('new_password'))) {
            $this->session->set_flashdata('message', $this->lang->line('profile_success'));
        }
        redirect('profile/'.encrypt_decrypt('e', $user_id));
    }

    public function upload_profile_pic(){

    	if($_FILES['uploadpic']['error'] == 0){
    		$curr_dir = str_replace("\\","/",getcwd()).'/';
    		//upload and update the file
    		$config['upload_path'] = $curr_dir.'images/profile_picture/original/';
    		$config['allowed_types'] = 'gif|jpg|png';
    		$config['overwrite'] = false;
    		$config['remove_spaces'] = true;
    		//$config['max_size']	= '100';// in KB
    	
    		//load upload library
    		$this->load->library('upload', $config);
    		$this->load->library('image_lib');
    		if ( ! $this->upload->do_upload('uploadpic')){
    			$this->session->set_flashdata('message', $this->upload->display_errors('<p class="error">', '</p>'));
    		}
    		else
    		{
    			$data1 = array('upload_data' => $this->upload->data());
    			$image= $data1['upload_data']['file_name'];
    			
    			$configBig = array();
				
				$configBig['image_library'] = 'gd2';
				$configBig['source_image']    = $curr_dir.'images/profile_picture/original/'.$image;;
				$configBig['new_image'] = $curr_dir.'images/profile_picture/thumb7575/'.$image;;
				$configBig['maintain_ratio'] = TRUE;
				$configBig['width']     = 75;
				$configBig['height']    = 75;

				$this->image_lib->initialize($configBig); 

				if ( ! $this->image_lib->resize())
				{
					echo $this->image_lib->display_errors();
				}
				$this->image_lib->clear();
				unset($configBig);
				
				$configBig = array();
				
				$configBig['image_library'] = 'gd2';
				$configBig['source_image']    = $curr_dir.'images/profile_picture/original/'.$image;;
				$configBig['new_image'] = $curr_dir.'images/profile_picture/thumb150150/'.$image;;
				$configBig['maintain_ratio'] = TRUE;
				$configBig['width']     = 150;
				$configBig['height']    = 150;

				$this->image_lib->initialize($configBig); 

				if ( ! $this->image_lib->resize())
				{
					echo $this->image_lib->display_errors();
				}
				$this->image_lib->clear();
				unset($configBig);
				
				$user_id = $this->session->userdata('user_id');
				$data = array('profile_picture' => $image);
				$this->db->where('user_id', $user_id);
				$this->db->update('users', $data);
				 
				if($this->db->affected_rows() == 1) {
					echo "1";
				}
    			
    		}
    	}
    	 
    }
}

/* End of file profile.php */
