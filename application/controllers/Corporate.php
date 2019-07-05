<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Corporate extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('corporate/order-list.php');
	}
	public function login()
	{
		$this->load->view('corporate/index.php');
	}

	public function profile()
	{
		$this->load->view('corporate/profile.php');
	}

	public function editProfile()
	{
		$this->load->view('corporate/edit-profile.php');
	}

	public function orderDetails()
	{
		$this->load->view('corporate/order-details.php');
	}

	public function forgotPassword()
	{
		$this->load->view('corporate/forgot-password.php');
	}

	public function invoice()
	{
		$this->load->view('corporate/invoice.php');
	}
	
}