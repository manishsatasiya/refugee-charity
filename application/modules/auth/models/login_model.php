<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    /**
     *
     * validate_login: check login data against database information
     *
     * @param string $username the username to be validated
     * @param string $password the password to be validated
     * @return mixed
     *
     */

    public function validate_login($username, $password) {
		
        $this->load->helper('password');

        $this->db->select('users.user_id,username, first_name, password, nonce, user_roll_id,active');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1) {
           $row = $query->row();
           // check for password match based on password_helper.php
           if($row->active == 0) {
               return "deactive";
           }else
		   if (hash_password($password, $row->nonce) == $row->password) {
               $array['user_id'] = $row->user_id;
               $array['username'] = $row->username;
               $array['first_name'] = $row->first_name;
               $array['user_roll_id'] = $row->user_roll_id;
               $array['active'] = $row->active;
               $array['nonce'] = $row->nonce;
               // update last login on successful login
               $this->_update_last_login($username);
               return $array;
           }else{
               // login attempts +1 because login failed
               //$this->_increase_login_attempts($username);
               //return ($row->login_attempts + 1);
           }
        }
        return false;
    }

    /**
     *
     * _update_last_login: update the last time the member logged in
     *
     * @param string $username the username to be validated
     * @return boolean
     *
     */

    private function _update_last_login($username) {
        $this->db->set('last_login_date', 'NOW()', FALSE);
        $this->db->where('username', $username);
        $this->db->update('users');

        if ($this->db->affected_rows() == 1) {
            return true;
        }
        return false;
    }

    /**
     *
     * _increase_login_attempts: add +1 to login attempts for member
     *
     * @param string $username the username to be validated
     * @return boolean
     *
     */

    private function _increase_login_attempts($username) {
        $this->db->set('login_attempts', 'login_attempts + 1', FALSE);
        $this->db->where('username', $username);
        $this->db->update('users');

        if ($this->db->affected_rows() == 1) {
            return true;
        }
        return false;
    }

    /**
     *
     * reset_login_attempts: bring login attempts back to 0
     *
     * @param string $username the username to be validated
     * @return boolean
     *
     */

    public function reset_login_attempts($username) {
        $this->db->where('username', $username);
        $this->db->update('users', array('login_attempts' => 0));
    }
}

/* End of file login_model.php */
