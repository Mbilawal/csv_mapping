<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
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
	
	public function index($month = '') {

		$this->stencil->title('Dashboard');
        
        $data['report_month'] = $month;
		$data['PAGES_ALLOWED'][] = 'DASHBOARD';
		
		//totalcampaign		
		$get_sent = $this->db->query("SELECT id,home_phone, email, COUNT(*) FROM cc_contacts GROUP BY home_phone, email HAVING COUNT(*) > 1  ");
        $total_duplicate=$get_sent->result_array();
		$data['total_duplicate'] = count($total_duplicate);

		//totalcsv
		$data['totalcsv'] = $this->db->get('cc_csv_names')->num_rows();

		//
		$data['total_pending'] = $this->db->where(array('record_processed' => 0))->get('cc_temp_csv_data')->num_rows();	

		//Total Leads
		$data['totalUsers'] = $this->db->get('cc_contacts')->num_rows();

		$this->stencil->paint('dashboard', $data);
	}//index
	
	//get_product_graphs
	public function get_product_graphs(){

		//Get product graphs
		$analysis_arr = $this->mod_dashboard->get_products_graphs($this->input->post());
		
		$analysis 	= $analysis_arr['data'];
		$dates 		= $analysis_arr['date'];
		
		echo json_encode($analysis).'||'.json_encode($dates);
		exit;
		
	}//End get_product_graphs

}
