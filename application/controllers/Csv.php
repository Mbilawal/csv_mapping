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


	public function test()
	{

		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://epc.opendatacommunities.org/api/v1/domestic/search?address=1+Vere+Road&postcode=DL128AD",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "accept: application/json",
		    "authorization: Basic cHJpbmNldmFzaEBnbWFpbC5jb206NWEwZjBlMDk4Yzg3MzYyNzA4ZTk2NmZiMzM4NDY2ZjUwMmMzYjQ5Mw=="
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

		$res_arr = json_decode($response,true);
        $api_response = $res_arr['rows'];

        if(count($api_response) > 0){

            $api_res_arr = $api_response[0];

            $ins_data['current_energy_rating']     = $api_res_arr['current-energy-rating'];
            $ins_data['current_energy_efficiency'] = $api_res_arr['current-energy-efficiency'];
            $ins_data['property_type']             = $api_res_arr['property-type'];
            $ins_data['built_form']                = $api_res_arr['built-form'];
            $ins_data['lodgement_date']            = $api_res_arr['lodgement-date'];
            $ins_data['walls_description']         = $api_res_arr['walls-description'];
            $ins_data['roof_description']          = $api_res_arr['roof-description'];
            $ins_data['mainheat_description']      = $api_res_arr['mainheat-description'];
            $ins_data['floor_description']         = $api_res_arr['floor-description'];
            $ins_data['tenure']                    = $api_res_arr['tenure'];

        }else{
            $ins_data['current_energy_rating']     = "No EPC";
            $ins_data['current_energy_efficiency'] = "";
            $ins_data['property_type']             = "";
            $ins_data['built_form']                = "";
            $ins_data['lodgement_date']            = "";
            $ins_data['walls_description']         = "";
            $ins_data['roof_description']          = "";
            $ins_data['mainheat_description']      = "";
            $ins_data['floor_description']         = "";
            $ins_data['tenure']                    = "";
        }


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
			$list_fields = array('ID','First Name','Last Name','Email','Mobile','Address','Postal Code'
				,'Current Energy Rating','Current Energy Efficiency','Property Type','Built Form','Lodgement Date','Walls Description','Roof Description','Mainheat Description','Floor Description','Tenure'
			);
			
			$data_arr = array();
			for($i=0; $i<count($lead_csv_report); $i++){ 
				
				$data_arr[$i]['id'] 			= $lead_csv_report[$i]['id'];
				$data_arr[$i]['first_name'] 	= $lead_csv_report[$i]['first_name'];
				$data_arr[$i]['last_name'] 		= $lead_csv_report[$i]['last_name'];
				$data_arr[$i]['email'] 			= $lead_csv_report[$i]['email'];
				$data_arr[$i]['mobile'] 		= $lead_csv_report[$i]['home_phone'];
				$data_arr[$i]['address'] 		= $lead_csv_report[$i]['address'];
				$data_arr[$i]['postal_code'] 			   = $lead_csv_report[$i]['postal_code'];
				$data_arr[$i]['current_energy_rating']     = $lead_csv_report[$i]['current_energy_rating'];
	            $data_arr[$i]['current_energy_efficiency'] = $lead_csv_report[$i]['current_energy_efficiency'];
	            $data_arr[$i]['property_type']             = $lead_csv_report[$i]['property_type'];
	            $data_arr[$i]['built_form']                = $lead_csv_report[$i]['built_form'];
	            $data_arr[$i]['lodgement_date']            = $lead_csv_report[$i]['lodgement_date'];
	            $data_arr[$i]['walls_description']         = $lead_csv_report[$i]['walls_description'];
	            $data_arr[$i]['roof_description']          = $lead_csv_report[$i]['roof_description'];
	            $data_arr[$i]['mainheat_description']      = $lead_csv_report[$i]['mainheat_description'];
	            $data_arr[$i]['floor_description']         = $lead_csv_report[$i]['floor_description'];
	            $data_arr[$i]['tenure']                    = $lead_csv_report[$i]['tenure'];

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
