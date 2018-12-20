<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Includes extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{
		$this->load->view('includes/login');
	}

	public function client_registration()
	{
		$this->load->view('includes/client-registration');
	}

	public function hospital_registration()
	{
		$this->load->view('includes/hospital-registration');
	}

	public function vendor_registration()
	{
		$this->load->view('includes/vendor-registration');
	}
	public function dashboard_header()
	{
		$this->load->view('includes/dashboard-header');
	}
	public function call_alerts()
	{
		$this->load->view('includes/call-alerts');
	}
	public function footer()
	{
		$this->load->view('includes/footer');
	}
	public function my_call_alerts()
	{
		$this->load->view('includes/call-alerts4');
	}
}