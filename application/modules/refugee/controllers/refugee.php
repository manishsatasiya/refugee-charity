<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class refugee extends Private_Controller {
    public function __construct()
    {
        parent::__construct();
        // pre-load
        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->helper('general_function');
		$this->load->model('refugee_model');
    }
    
	public function index() {
    	
        $content_data = array();

        // set layout data
        $this->template->set_theme(Settings_model::$db_config['default_theme']);
        $this->template->set_layout('school');
        
        $this->template->title($this->lang->line('donations'));
        $this->template->set_partial('header', 'header');
        $this->template->set_partial('sidebar', 'sidebar');
        $this->template->set_partial('footer', 'footer');
        $this->template->build('donations', $content_data);
    }
    
    public function index_json($order_by = "username", $sort_order = "asc", $search = "all", $offset = 0) {
    	/* Array of database columns which should be read and sent back to DataTables. Use a space where
    	 * you want to insert a non-database field (for example a counter or static image)
    	*/
    	$aColumns = array('id',
						'date_of_donation',
						'name_of_association',
						'name_of_donator',
						'what_was_donated_please_specify',
						'name_aid_of_receiver_from',
						'month',
						'year',
						'created_date');

    	$grid_data = get_search_data($aColumns);
    	$sort_order = $grid_data['sort_order'];
		$order_by = $grid_data['order_by'];
    	/*
    	 * Paging
    	*/
    	$per_page =  $grid_data['per_page'];
    	$offset =  $grid_data['offset'];
    
    	$data = $this->donations_model->get_donations($per_page, $offset, $order_by, $sort_order, $grid_data['search_data']);
    	$count = $this->donations_model->get_donations($per_page, $offset, $order_by, $sort_order, $grid_data['search_data'],true);
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

				$row[] = $result_row['id'];
				$row[] = $result_row['date_of_donation'];
				$row[] = $result_row['name_of_association'];
				$row[] = $result_row['name_of_donator'];
				$row[] = $result_row['what_was_donated_please_specify'];
				$row[] = $result_row['name_aid_of_receiver_from'];
				$row[] = $result_row['month'];
				$row[] = $result_row['year'];
				$row[] = $result_row['created_date'];
                $row[] = '<a href="'.base_url('donations/add/'.$result_row["id"]).'" class="btn default btn-xs purple"><i class="fa fa-edit"></i> </a>';

    			$output['data'][] = $row;
    		}
    	}
    
    	echo json_encode( $output );
    }
	
	public function add($id = null) {
    	$content_data = array();

		$month_list = month_dropdown();
		$year_list = year_dropdown();

		$errors = "";
		if($this->input->post()){

			$date_of_donation = $this->input->post('date_of_data_entry');
			$association_name = $this->input->post('association_name');
			$location_of_association = $this->input->post('location_of_association');
			$full_name = $this->input->post('full_name');
			$age = $this->input->post('age');
			$gender = $this->input->post('gender');
			$nationality = $this->input->post('nationality');
			$nationality_id_no = $this->input->post('nationality_id_no');
			$un_id = $this->input->post('un_id');
			$marital_status = $this->input->post('marital_status');
			$previous_occupation = $this->input->post('previous_occupation');
			$are_you_able_to_work = $this->input->post('are_you_able_to_work');
			$what_skills_do_you_have_for_working = $this->input->post('what_skills_do_you_have_for_working');
			$what_qualifications_do_you_have = $this->input->post('what_qualifications_do_you_have');
			$are_you_sick = $this->input->post('are_you_sick');
			$need_of_medicationequipment = $this->input->post('need_of_medicationequipment');
			$if_yes_please_specify = $this->input->post('if_yes_please_specify');
			$where_do_you_live_location = $this->input->post('where_do_you_live_location');
			$do_you_live_in_tent_house = $this->input->post('do_you_live_in_tent_house');
			$what_is_it_that_you_need_most = $this->input->post('what_is_it_that_you_need_most');
			$how_many_children_do_you_have = $this->input->post('how_many_children_do_you_have');
			$childrens_names_ages_genders = $this->input->post('childrens_names_ages_genders');
			$other_family_members_names_ages_genders = $this->input->post('other_family_members_names_ages_genders');
			$contact_details_email_skype_whatsapp = $this->input->post('contact_details_email_skype_whatsapp');
			$name_administrator = $this->input->post('name_administrator');
			$any_other_information = $this->input->post('any_other_information');
			$special_case = $this->input->post('special_case');
			$special_case_more_info = $this->input->post('special_case_more_info');
			$total_number_of_people_in_house = $this->input->post('total_number_of_people_in_house');
			$telephone_no = $this->input->post('telephone_no');
			$month = $this->input->post('month');
			$year = $this->input->post('year');
			$created_by = $this->input->post('created_by');
			$created_date = $this->input->post('created_date');

			
			
			$data_document['date_of_donation'] = $date_of_donation;
			$data_document['name_of_association'] = $name_of_association;
			$data_document['name_of_donator'] = $name_of_donator;
			$data_document['what_was_donated_please_specify'] = $what_was_donated_please_specify;
			$data_document['name_aid_of_receiver_from'] = $name_aid_of_receiver_from;
			$data_document['any_other_info'] = $any_other_info;
			$data_document['month'] = $month;
			$data_document['year'] = $year;

			$table = 'donations';		
			$wher_column_name = 'id';
			if($id){
				grid_data_updates($data_document,$table,$wher_column_name,$id);    
			}else{
				$data_document['created_date'] = date("Y-m-d H:i:s");
				$id = grid_add_data($data_document,$table);
			}
						
			$this->session->set_flashdata('message', $this->lang->line('donations_add_success'));
			redirect('donations');
		}
		
		$rowdata= array();
		if($id){
			$rowdata = $this->donations_model->get_donation_data($id);
		}

		$content_data['month_list'] = $month_list;
		$content_data['year_list'] = $year_list;

		$content_data['rowdata'] = $rowdata;
		$content_data['id'] = $id;
        // set layout data
        $this->template->set_theme(Settings_model::$db_config['default_theme']);
        $this->template->set_layout('school');
        
        $this->template->title($this->lang->line('add_donations'));
        $this->template->set_partial('header', 'header');
		$this->template->set_partial('sidebar', 'sidebar');
        $this->template->set_partial('footer', 'footer');
        $this->template->build('add', $content_data);
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