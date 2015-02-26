<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }

    /**
     *
     * get_profile: get the member pages
     *
     * @return array
     *
     */

    public function get_profile($user_id) {
        $this->db->select('*',FALSE);
        $this->db->from('users');
        $this->db->where('user_id', $user_id);
        $this->db->limit(1);
        
        $query = $this->db->get();

        if($query->num_rows() == 1) {            
            return $query->row();
        }
        return false;
    }

    /**
     *
     * set_password: update member password
     *
     * @param string $password
     * @return boolean
     *
     */

    public function set_password($password) {
        $this->load->helper('password');
        $new_nonce = md5(uniqid(mt_rand(), true));
        $data = array(
               'password' => hash_password($password, $new_nonce),
               'nonce' => $new_nonce
            );

        $this->db->where('user_id', $this->input->post('user_id'));
        $this->db->update('users', $data);

        if ($this->db->affected_rows() == 1) {
            return true;
        }
        return false;
    }
	
}

/* End of file profile_model.php */