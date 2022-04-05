<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cron extends CI_Controller {
	public function __construct() {

		// error_reporting(E_ALL);
		// ini_set('display_errors', E_ALL);

		parent::__construct();
		
		// Load Modal
		$this->load->model('mod_dashboard');
		
	}
	

	public function upload_final_csv_records_cron()
	{
		$this->mod_dashboard->lead_insert_from_csv_final();

		echo 1;
		exit;
	}


	public function upload_final_csv_cron()
	{
		$this->mod_dashboard->lead_insert_temp_csv();

		echo 1;
		exit;
	}
}
