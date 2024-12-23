<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->model('User','',TRUE);
		$this->load->model('Admin','',TRUE);
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('login_view');
		$this->load->view('footer');
	}

	function verifyUser() {

		$this->load->library('form_validation');
		$this->form_validation->set_rules('userEmail', 'Login Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('userPassword', 'Login Password', 'trim|required|min_length[6]|max_length[20]');

		if($this->input->post('userType') == 1)
		{
			if($this->form_validation->run() == FALSE)
			{
				//field validation failed. user redirected to login page
				$this->load->helper(array('form'));
				$this-> load->view('header');
				$this-> load->view('home');
				$this-> load->view('footer');
				$this-> session->set_flashdata('status', '<div class="alert alert-danger text-center" >Error! Please Enter a valid user email and login password!</div>');
			}
			else
			{
				//passed validation. Continue to verify user login details
				$email = $this->input->post('userEmail');
				$password = $this->input->post('userPassword');
				$userId = $this->checkUserDatabase($email, $password);
				$data = $this->User->getUserData($userId);
				
			}
		}

		else if($this->input->post('userType') == 2)
		{
			if($this->form_validation->run() == FALSE)
			{
				//field validation failed. user redirected to login page
				$this->load->helper(array('form'));
				$this-> load->view('header');
				$this-> load->view('home');
				$this-> load->view('footer');
				$this-> session->set_flashdata('status', '<div class="alert alert-danger text-center" >Error! Please Enter a valid user email and login password!</div>');
			}
			else
			{
				//passed validation. Continue to verify user login details
				$email = $this->input->post('userEmail');
				$password = $this->input->post('userPassword');
				$cNumber = $this->checkAdminDatabase($email, $password);
				$data = $this->Admin->getAdminData($cNumber);
				
			}
		}

		
	}

	function checkUserDatabase($email, $password){

		//query the database
		$result = $this->User->verifyLogin($email, $password);

		if($result)
		{
			$sess_array = array ();
			foreach($result as $row)
			{
				$sess_array = array(
					'id' => $row->userId,
					'name' => $row->userFName,
					'email' => $email
				);

				$userId = $row->userId;
				$this->session->set_userdata('logged_in', $sess_array);
			}
			redirect('HomeUser');

			return $userId;
		}
		else
		{
			$this->session->set_flashdata('status','<div class="alert alert-danger" >User Record Not Found! Please enter a correct username and password.</div>');
			redirect('Login');
		}
	}//end of checkDatabase

	function checkAdminDatabase($email, $password){

		//query the database
		$result = $this-> Admin ->verifyLogin($email, $password);

		if($result)
		{
			$sess_array = array ();
			foreach($result as $row)
			{
				$sess_array = array(
					'id' => $row->aId,
					'name' => $row->adminFName,
					'email' => $email
				);

				$adminId = $row->aId;
				$this->session->set_userdata('logged_in', $sess_array);
			}

			redirect('admin');

			return $adminId;
		}
		else
		{
			$this->session->set_flashdata('status','<div class="alert alert-danger" >User Record Not Found! Please enter a correct username and password.</div>');
			redirect('Welcome');
		}
	}//end of checkDatabase

}//end of class