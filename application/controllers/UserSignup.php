<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserSignup extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->model('User','',TRUE);
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

	function addnewUser() {
		//signup form validation
		$this->load->library('form_validation');
		$data ['content'] = "userFormSignUp";

		//define the rules of input validation
		$this->form_validation->set_rules('userFname', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('userDate', 'date of birth', 'trim|required');
		$this->form_validation->set_rules('userPhone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('userNric', 'NRIC number', 'trim|required|regex_match[/^[0-9]{12}$/]');
		$this->form_validation->set_rules('userEmail', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('userPassword', 'Password', 'trim|required|min_length[6]|max_length[20]');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');


		if($this->form_validation->run() === FALSE)
		{
			//field validation failed. user redirected to signup page
			$this-> session->set_flashdata('status', '<div class="alert alert-danger text-center">Error! Please Enter the Correct Information!</div>');
			redirect('UserSignup');
		}
		else
		{
			//Binding form data from view to array $data
			$data['uFname'] = $this->input->post('userFname');
			$data['uDate'] = $this->input->post('userDate');
			$data['uNric'] = $this->input->post('userNric');
			$data['uPhone'] = $this->input->post('userPhone');
			$data['uEmail'] = $this->input->post('userEmail');
			$data['uPassword'] = $this->input->post('userPassword');


			//Pass the $data to model
			$this->load->model('User', '', TRUE);
			$result = $this-> User -> insertNewUser($data);

			if($result){
				$this->session->set_flashdata('status', '<div class="alert alert-success">New User was Added Succesfully!</div>');
				redirect('UserSignup');
			}else{
				$this->session->set_flashdata('status', '<div class="alert alert-danger">Error! Please Try Again!</div>');
				redirect('UserSignup');
			}
		}
	}//end of addnew
}//end of class