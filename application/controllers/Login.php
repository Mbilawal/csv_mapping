<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		// error_reporting(E_ALL);
		// ini_set('display_errors', E_ALL);
		//load main template
		$this->stencil->layout('layout'); //Layout
		//load required slices
		$this->stencil->slice('header_script');
		// $this->stencil->slice('header');
		// $this->stencil->slice('footer');
		$this->stencil->slice('footer_script');
		// Load Modal
		$this->load->model('mod_login');
	}
	/*********************************************/
	/*                LOGIN SECTION              */
	/*********************************************/
	// Index function begins...
	public function index() {
		$this->stencil->title(SITETITLE. ' | Login');
		if (!empty($this->session->userdata('username'))) {
			redirect(SURL. 'dashboard/');
		}
		$data['LOGIN_PAGE'] =  'true';
		$this->stencil->paint('login/login', $data);
	}
	// END Index function...
	// Login Process function...
	public function login_process() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$response = array();
		if (empty(trim($username))) :
			$response['message'] = 'Username is Empty!';
			$response['success'] = 'false';
		endif;
		if (empty(trim($password))) :
			$response['message'] = 'Password is Empty!';
			$response['success'] = 'false';
		endif;
		$return = $this->mod_login->validate_login_credentials($username, $password);
		if ($return) :
			$this->session->set_userdata($return);
			$response['success'] = 'true';
			$response['url']     = SURL. 'dashboard/';
		else :
			$response['success'] = 'false';
			$response['message'] = 'Username or Password is Invalid!';
		endif;
		echo json_encode($response); exit;
	}
	// END Login Process Function...
	public function log_out() {
		$this->session->unset_userdata('username');
		// $this->session->sess_destroy();
		redirect(SURL.'login/');
	}
}
