<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Campaign extends CI_Controller {
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

		$this->stencil->title('Campaign');
        
        $data['PAGES_ALLOWED'][] = 'CAMPAIGN';

        $data['campaign_arr'] = $this->db->get('campaign')->result_array();

		$this->stencil->paint('campaign/manage_campaign', $data);

	}//index

	public function add_campaign()
	{
		$data['PAGES_ALLOWED'][] = 'CAMPAIGN';
		$this->stencil->title('Add Campaign');

		$this->stencil->paint('campaign/add_campaign', $data);
	}

	public function upload_csv()
	{
		$data['PAGES_ALLOWED'][] = 'CAMPAIGN';
		$this->stencil->title('Upload CSV');

		$this->stencil->paint('campaign/upload_csv', $data);
	}

	public function get_total_participant()
	{
		$csv_id = $this->input->post('csv_id');
		$sending_type = $this->input->post('sending_type');

		if($sending_type == 'email'){
			// $this->db->where(array('id' => $csv_id));
		}

		$this->db->where(array('id' => $csv_id));
		$csv_arr = $this->db->get('cc_csv_names')->row_array();
		
		echo $csv_arr['total_csv_records'];
		exit;
	}

	public function campaign_stats($id)
	{
		if($id){
			$this->stencil->title('Campaign Stats');
			
			$data['PAGES_ALLOWED'][] = 'CAMPAIGN';
			$data['PAGES_ALLOWED'][] = 'CAMPAIGN_LOGS';

			$data['campaign_id'] = $id;
			$data['analysis_arr'] = [];

			$this->stencil->paint('campaign/campaign_logs', $data);
		}
	}


	//get_client_campaigns_graphs
	public function get_client_campaigns_graphs(){

		//Get client campaigns graphs
		$analysis_arr = $this->mod_dashboard->get_client_campaigns_graphs($this->input->post());
		
		$analysis = $analysis_arr['data'];
		$dates = $analysis_arr['date'];
		
		echo json_encode($analysis).'||'.json_encode($dates);
		exit;
		
	}//End get_client_campaigns_graphs


	//get_client_campaigns_analysis
	public function get_client_campaigns_analysis(){

		if($this->input->post('campaign_id')!=""){
			$campaign_id = $this->input->post('campaign_id');

			$campaign_arr = $this->db->where(array('id' => $campaign_id))->get('campaign')->row_array();

			if($campaign_arr['type'] == 'email'){
				// //Get client campaigns analysis
				$analysis_arr = $this->mod_dashboard->get_client_email_campaigns_analysis($campaign_id);
				$notsent = $analysis_arr['recipients'] - $analysis_arr['sent'];
			}else{

				$curl = curl_init();
				$postData = array(
				    'message_id' => $campaign_arr['message_id']
				);

				curl_setopt_array($curl, array(
				  CURLOPT_URL => 'https://api.transmitsms.com/get-sms.json',
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => '',
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => 'POST',
				  CURLOPT_POSTFIELDS => $postData,
				  CURLOPT_HTTPHEADER => array(
				    	// "Content-Type: application/json",
				    	'Authorization: Basic '. base64_encode("e8d08f651b5664aaecdc2dbe7f443ba8:Goodday8*")
				  	),
				));

				$response = curl_exec($curl);
				curl_close($curl);

				$delivery_stats = $res_arr['delivery_stats'];
				$res_arr = json_decode($response,true);

				$delivery_stats = $res_arr['delivery_stats'];

				$upd_arr = array(
				    'delivered'		 => $delivery_stats['delivered'],
				    'pending'		 => $delivery_stats['pending'],
				    'bounced'		 => $delivery_stats['bounced'],
				    // 'responses'		 => $delivery_stats['responses'],
				    'optouts'		 => $delivery_stats['optouts'],
				);			

				$this->db->where(array('id' => $campaign_id));
				$this->db->set($upd_arr);
				$this->db->update('campaign');

				$campaign_arr = [];
				$campaign_arr = $this->db->where(array('id' => $campaign_id))->get('campaign')->row_array();

			}

		}
		
		$response ='
		<div class="statusXbox_v">
            <h2>Total Sent</h2>
            <a href="#" target="_blank">
            <p>'.number_format(round($campaign_arr['total_recipant'],2)).'</p>
            <!--<small>'.round(($analysis_arr['sent']/$analysis_arr['recipients'])*100,2).'%</small>-->
            </a>
        </div>
		<div class="statusXbox_v">
            <h2>Pending</h2>
            <a href="#" target="_blank">
            <p>'.number_format(round($campaign_arr['pending'],2)).'</p>
            <!--<small>'.round(($analysis_arr['sent']/$analysis_arr['recipients'])*100,2).'%</small>-->
            </a>
        </div>
        <div class="statusXbox_v">
            <h2>DELIVERED</h2>
            <a href="#" target="_blank">
            <p>'.number_format(round($campaign_arr['delivered'],2)).'</p>
            <!--<small>'.round(($analysis_arr['delivered']/$analysis_arr['sent'])*100,2).'%</small>-->
            </a>
        </div>
        <div class="statusXbox_v">
            <h2>Bounced</h2>
            <a href="#" target="_blank">
            <p>'.number_format(round($campaign_arr['bounced'],2)).'</p>
            <!--<small>'.round(($analysis_arr['not_sent']/$analysis_arr['sent'])*100,2).'%</small>-->
            </a>
        </div>
        <div class="statusXbox_v">
            <h2>OPT OUTS</h2>
            <p>'.number_format(round($campaign_arr['optouts'],2)).'</p>
            <!--<small>'.round(($notsent/$analysis_arr['recipients'])*100,2).'%</small>-->
        </div>';

        echo $response;
		exit;

	}//End get_client_campaigns_analysis


	//upload_csv_file
	public function upload_csv_file(){
		
		if($_FILES['csv_file']['name']){

		    $filename = str_replace(" ","-",$_FILES['csv_file']['name']);
		
		    $path = './assets/leads_csv_files';
			
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'csv|xlsx';
			$config['max_size']	= '15000';
			$config['overwrite'] = true;
			$config['file_name'] = $filename;
			
			$this->load->library('upload', $config);
				
			if($this->upload->do_upload('csv_file')){
				
				$file_path =  $path."/".$filename;
				include 'Classes/PHPExcel/IOFactory.php';

				$inputFileName = $file_path; 
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
				$arrayCount = count($allDataInSheet);
				$csv_fields = array_values($allDataInSheet[1]);
					
			}else{
			
				$error_file_arr = array('error' => $this->upload->display_errors());	
				$this->session->set_flashdata('err_message', $error_file_arr['error']);
			    redirect(SURL.'campaign?');
			}
		}

		$data['PAGES_ALLOWED'][] = 'CAMPAIGN';

		$data['csv_fields'] = $csv_fields;
		$data['file_name_path'] = $file_path;
		$data['file_name'] = $filename;

		//stencil is our templating library. Simply call view via it
		$this->stencil->paint('campaign/csv_fields_mapping_champion', $data);
		
	}//End upload_csv_file


	//lead_csv_fields_process
	public function lead_csv_fields_process(){
		
		// error_reporting(E_ALL);
		// ini_set('display_errors', E_ALL);
	
		$data['PAGES_ALLOWED'][] = 'CAMPAIGN';

		//Lead Insert from CSV
		$csv_id = $this->mod_dashboard->lead_insert_from_csv($this->input->post());

		$this->lead_csv_fields_uploading($csv_id,0);
		
	}//End lead_csv_fields_process


	//lead_csv_fields_uploading
	public function lead_csv_fields_uploading($csv_id,$total_new_leads){
		
		$data['PAGES_ALLOWED'][] = 'CAMPAIGN';

		//Lead Insert from CSV
		$lead_csv_insert = $this->mod_dashboard->lead_insert_from_csv_final($csv_id,$total_new_leads);
		
		echo json_encode( $lead_csv_insert );
		
	}//End lead_csv_fields_uploading

}
