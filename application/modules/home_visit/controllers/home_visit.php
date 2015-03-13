<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class home_visit extends Private_Controller {
    public function __construct()
    {
        parent::__construct();
        // pre-load
        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->helper('general_function');
		$this->load->model('home_visit_model');
    }
    
	public function index() {
    	
        $content_data = array();

        // set layout data
        $this->template->set_theme(Settings_model::$db_config['default_theme']);
        $this->template->set_layout('school');
        
        $this->template->title($this->lang->line('home_visit'));
        $this->template->set_partial('header', 'header');
        $this->template->set_partial('sidebar', 'sidebar');
        $this->template->set_partial('footer', 'footer');
        $this->template->build('home_visit', $content_data);
    }
    
    public function index_json($order_by = "username", $sort_order = "asc", $search = "all", $offset = 0) {
    	/* Array of database columns which should be read and sent back to DataTables. Use a space where
    	 * you want to insert a non-database field (for example a counter or static image)
    	*/
    	$aColumns = array('id',
						'date_of_visit',
						'location_of_visit',
						'id_no',
						'full_name_of_family_visited',
						'name_of_visitor_from_association',
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
    
    	$data = $this->home_visit_model->get_home_visit($per_page, $offset, $order_by, $sort_order, $grid_data['search_data']);
    	$count = $this->home_visit_model->get_home_visit($per_page, $offset, $order_by, $sort_order, $grid_data['search_data'],true);
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
    			$action_btn = '';
    			if($this->session->userdata('role_id') == '1' || in_array("edit",$this->arrAction)) {
    				$action_btn = '<a href="'.base_url('home_visit/add/'.$result_row["id"]).'" class="btn default btn-xs blue"><i class="fa fa-edit"></i> </a>';
    			}
    			$action_btn .= '<a href="javascript:;" onclick=dt_delete("home_visit","id",'.$result_row["id"].'); class="btn default btn-xs red"><i class="fa fa-trash-o"></i></a>';
				$row[] = $result_row['id'];
				$row[] = $result_row['date_of_visit'];
				$row[] = $result_row['location_of_visit'];
				$row[] = $result_row['id_no'];
				$row[] = $result_row['full_name_of_family_visited'];
				$row[] = $result_row['name_of_visitor_from_association'];
				$row[] = $result_row['created_date'];
                $row[] = $action_btn;

    			$output['data'][] = $row;
    		}
    	}
    
    	echo json_encode( $output );
    }
	
	public function add($id = null) {
    	$content_data = array();

		$pictures_video_taken_list = pictures_video_taken_dropdown();
		$specia_case_list = specia_case_dropdown();
		$level_of_need_list = level_of_need_dropdown();
		$month_list = month_dropdown();
		$year_list = year_dropdown();
		$associatoin_name_list = get_associatoin_name_list();
		$errors = "";
		if($this->input->post()){

			$date_of_visit = $this->input->post('date_of_visit');
			$association_name = $this->input->post('association_name');
			$location_of_visit = $this->input->post('location_of_visit');
			$id_no = $this->input->post('id_no');
			$full_name_of_family_visited = $this->input->post('full_name_of_family_visited');
			$name_of_visitor_from_association = $this->input->post('name_of_visitor_from_association');
			$was_help_given = $this->input->post('was_help_given');
			$another_visit_short_reason = $this->input->post('another_visit_short_reason');
			$pictures_video_taken = $this->input->post('pictures_video_taken');
			$special_case = $this->input->post('special_case');
			$special_case_more_info = $this->input->post('special_case_more_info');
			$level_of_need = $this->input->post('level_of_need');
			$any_other_information = $this->input->post('any_other_information');
			
			
			$data_document['date_of_visit'] = make_db_date($date_of_visit);
			$data_document['association_name'] = $association_name;
			$data_document['location_of_visit'] = $location_of_visit;
			$data_document['id_no'] = $id_no;
			$data_document['full_name_of_family_visited'] = $full_name_of_family_visited;
			$data_document['name_of_visitor_from_association'] = $name_of_visitor_from_association;
			$data_document['was_help_given'] = $was_help_given;
			$data_document['another_visit_short_reason'] = $another_visit_short_reason;
			$data_document['pictures_video_taken'] = $pictures_video_taken;
			$data_document['special_case'] = $special_case;
			$data_document['special_case_more_info'] = $special_case_more_info;
			$data_document['level_of_need'] = $level_of_need;
			$data_document['any_other_information'] = $any_other_information;

			$table = 'home_visit';		
			$wher_column_name = 'id';
			if($id){
				grid_data_updates($data_document,$table,$wher_column_name,$id);    
			}else{
				$data_document['created_date'] = date("Y-m-d H:i:s");
				$id = grid_add_data($data_document,$table);
			}
						
			$this->session->set_flashdata('message', $this->lang->line('save_success'));
			redirect('home_visit');
		}
		
		$rowdata= array();
		if($id){
			$rowdata = $this->home_visit_model->get_donation_data($id);
		}

		$content_data['pictures_video_taken_list'] = $pictures_video_taken_list;
		$content_data['specia_case_list'] = $specia_case_list;
		$content_data['level_of_need_list'] = $level_of_need_list;
		$content_data['month_list'] = $month_list;
		$content_data['year_list'] = $year_list;
		$content_data['associatoin_name_list'] = $associatoin_name_list;

		$content_data['rowdata'] = $rowdata;
		$content_data['id'] = $id;
        // set layout data
        $this->template->set_theme(Settings_model::$db_config['default_theme']);
        $this->template->set_layout('school');
        
        $this->template->title($this->lang->line('add_home_visit'));
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