<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class refugee_register extends Private_Controller {
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
    	//echo "dfdsf";exit();
        $content_data = array();

        // set layout data
        $this->template->set_theme(Settings_model::$db_config['default_theme']);
        $this->template->set_layout('school');
        
        $this->template->title($this->lang->line('refugee'));
        $this->template->set_partial('header', 'header');
        $this->template->set_partial('sidebar', 'sidebar');
        $this->template->set_partial('footer', 'footer');
        $this->template->build('refugee', $content_data);
    }
    
    public function index_json($order_by = "username", $sort_order = "asc", $search = "all", $offset = 0) {
    	/* Array of database columns which should be read and sent back to DataTables. Use a space where
    	 * you want to insert a non-database field (for example a counter or static image)
    	*/
    	$aColumns = array('id',
						'association_name',
						'full_name',
						'age',
						'gender',
						'nationality',
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
    
    	$data = $this->refugee_model->get_refugee($per_page, $offset, $order_by, $sort_order, $grid_data['search_data']);
    	$count = $this->refugee_model->get_refugee($per_page, $offset, $order_by, $sort_order, $grid_data['search_data'],true);
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
				$row[] = $result_row['association_name'];
				$row[] = $result_row['full_name'];
				$row[] = $result_row['age'];
				$row[] = $result_row['gender'];
				$row[] = $result_row['nationality'];
				$row[] = $result_row['month'];
				$row[] = $result_row['year'];
				$row[] = $result_row['created_date'];
                $row[] = '<a href="'.base_url('refugee_register/add/'.$result_row["id"]).'" class="btn default btn-xs purple"><i class="fa fa-edit"></i> </a>';

    			$output['data'][] = $row;
    		}
    	}
    
    	echo json_encode( $output );
    }
	
	public function add($id = null) {
    	$content_data = array();
    	$work_list = work_dropdown();
		$sicklist = sick_dropdown();
		$medicationequipment_list = medicationequipment_dropdown();
		$livelist = live_dropdown();
		$specia_case_list = specia_case_dropdown();
		$month_list = month_dropdown();
		$year_list = year_dropdown();

		$errors = "";
		if($this->input->post()){

			$date_of_data_entry = $this->input->post('date_of_data_entry');
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
			
			$data_document['date_of_data_entry'] = $date_of_data_entry;
			$data_document['association_name'] = $association_name;
			$data_document['location_of_association'] = $location_of_association;
			$data_document['full_name'] = $full_name;
			$data_document['age'] = $age;
			$data_document['gender'] = $gender;
			$data_document['nationality'] = $nationality;
			$data_document['nationality_id_no'] = $nationality_id_no;
			$data_document['un_id'] = $un_id;
			$data_document['marital_status'] = $marital_status;
			$data_document['previous_occupation'] = $previous_occupation;
			$data_document['are_you_able_to_work'] = $are_you_able_to_work;
			$data_document['what_skills_do_you_have_for_working'] = $what_skills_do_you_have_for_working;
			$data_document['what_qualifications_do_you_have'] = $what_qualifications_do_you_have;
			$data_document['are_you_sick'] = $are_you_sick;
			$data_document['need_of_medicationequipment'] = $need_of_medicationequipment;
			$data_document['if_yes_please_specify'] = $if_yes_please_specify;
			$data_document['where_do_you_live_location'] = $where_do_you_live_location;
			$data_document['do_you_live_in_tent_house'] = $do_you_live_in_tent_house;
			$data_document['what_is_it_that_you_need_most'] = $what_is_it_that_you_need_most;
			$data_document['how_many_children_do_you_have'] = $how_many_children_do_you_have;
			$data_document['childrens_names_ages_genders'] = $childrens_names_ages_genders;
			$data_document['other_family_members_names_ages_genders'] = $other_family_members_names_ages_genders;
			$data_document['contact_details_email_skype_whatsapp'] = $contact_details_email_skype_whatsapp;
			$data_document['name_administrator'] = $name_administrator;
			$data_document['any_other_information'] = $any_other_information;
			$data_document['special_case'] = $special_case;
			$data_document['special_case_more_info'] = $special_case_more_info;
			$data_document['total_number_of_people_in_house'] = $total_number_of_people_in_house;
			$data_document['telephone_no'] = $telephone_no;
			$data_document['month'] = $month;
			$data_document['year'] = $year;

			$table = 'refugee';		
			$wher_column_name = 'id';
			if($id){
				grid_data_updates($data_document,$table,$wher_column_name,$id);    
			}else{
				$data_document['created_date'] = date("Y-m-d H:i:s");
				$id = grid_add_data($data_document,$table);
			}
						
			$this->session->set_flashdata('message', $this->lang->line('refugee_add_success'));
			redirect('refugee_register');
		}
		
		$rowdata= array();
		if($id){
			$rowdata = $this->refugee_model->get_refugee_data($id);
		}

		$content_data['work_list'] = $work_list;
		$content_data['sicklist'] = $sicklist;
		$content_data['medicationequipment_list'] = $medicationequipment_list;
		$content_data['livelist'] = $livelist;
		$content_data['specia_case_list'] = $specia_case_list;
		$content_data['month_list'] = $month_list;
		$content_data['year_list'] = $year_list;

		$content_data['rowdata'] = $rowdata;
		$content_data['id'] = $id;
        // set layout data
        $this->template->set_theme(Settings_model::$db_config['default_theme']);
        $this->template->set_layout('school');
        
        $this->template->title($this->lang->line('add_refugee'));
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