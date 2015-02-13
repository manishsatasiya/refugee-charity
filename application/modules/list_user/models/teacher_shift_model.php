<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of teacher_shift_model
 *
 * @author LuongTran
 */
class Teacher_shift_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_teacher_shifts() {
        $this->db->select('*');
    	$this->db->from('teacher_shift');
        $query = $this->db->get();
        $results = $query->result();
        $shifts = array();
        if(is_array($results)) {
            foreach ($results as $v) {
                $shifts[$v->teacher_shift_id] = $v->In_Time.'-'.$v->Out_Time;
            }
        }
        return $shifts;
    }
}

?>
