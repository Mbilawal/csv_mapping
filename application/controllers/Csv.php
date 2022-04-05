<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Csv extends CI_Controller {
	public function __construct() {

		// error_reporting(E_ALL);
		// ini_set('display_errors', E_ALL);

		parent::__construct();
		//load main template
		$this->stencil->layout('layout'); //Layout
		//load required slices
		$this->stencil->slice('header_script');
		$this->stencil->slice('header');
		$this->stencil->slice('footer');
		$this->stencil->slice('footer_script');
		$this->stencil->slice('custom_script');
		// Load Modal
		$this->load->model('mod_dashboard');
		
		verify_login();
		// END Mod Common for Menus... 
	}
	
	public function index() {

		$this->stencil->title('Csv');
        
        $data['PAGES_ALLOWED'][] = 'CAMPAIGN';

        $csv_arr =  $this->db->get('cc_csv_names')->result_array(); 
        $data['csv_arr'] = $csv_arr;

		$this->stencil->paint('csv/manage_csv', $data);

	}//index

	public function delete($id)
	{
		if($id){
			$this->db->where(array('id'=>$id));
			$this->db->delete('cc_csv_names');

			$this->db->where(array('csv_id'=>$id));
			$this->db->delete('cc_contacts');

			redirect(SURL.'csv');
		}
	}


	public function view($id)
	{
		
	}


	public function export($id)
	{
		if($id){
			
			$this->load->helper('file');
			$this->load->helper('download');

			$this->db->where(array('csv_id'=>$id));
			$lead_csv_report = $this->db->get('cc_contacts')->result_array();

			//First generate the Custom headings
			$list_fields = array('ID','First Name','Last Name','Email','Mobile','Status','Rating','Available');
			
			$data_arr = array();
			for($i=0; $i<count($lead_csv_report); $i++){ 
				
				$data_arr[$i]['id'] 			= $lead_csv_report[$i]['id'];
				$data_arr[$i]['first_name'] 	= $lead_csv_report[$i]['first_name'];
				$data_arr[$i]['last_name'] 		= $lead_csv_report[$i]['last_name'];
				$data_arr[$i]['email'] 			= $lead_csv_report[$i]['email'];
				$data_arr[$i]['mobile'] 		= $lead_csv_report[$i]['home_phone'];
				$data_arr[$i]['status'] 		= $lead_csv_report[$i]['status'];
				$data_arr[$i]['rating'] 		= $lead_csv_report[$i]['rating'];
				$data_arr[$i]['available'] 		= $lead_csv_report[$i]['available'];
			}

			$uniquename = time();
			$csv_name = $uniquename.'.csv';
		
			$delimiter = ",";
			$newline = "\r\n";

			$data = download_clients_campaign_list_report($data_arr, $delimiter, $newline,$list_fields);
			force_download($csv_name, $data);

		}
	}

	
	
}
