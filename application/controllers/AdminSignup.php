<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminSignup extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->model('Admin','',TRUE);
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }
		$this->load->view('admin_header_logged');
		$this->load->view('admin_signup_view');
		$this->load->view('footer');
	}
    
    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }

	function addnewAdmin() {
		//signup form validation
		$this->load->library('form_validation');
		$data ['content'] = "adminFormSignup";

		//define the rules of input validation
		$this->form_validation->set_rules('adminFname', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('adminDate', 'date of birth', 'trim|required');
		$this->form_validation->set_rules('adminPhone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('adminNric', 'NRIC number', 'trim|required|regex_match[/^[0-9]{12}$/]');
		$this->form_validation->set_rules('adminEmail', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('adminPassword', 'Password', 'trim|required|min_length[6]|max_length[20]');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');


		if($this->form_validation->run() === FALSE)
		{
			//field validation failed. user redirected to signup page
			$this-> session->set_flashdata('status', '<div class="alert alert-danger text-center" style="width:100%">Error! Please Enter the Correct Information!</div>');
			redirect('AdminSignup');
		}
		else
		{
			//Binding form data from view to array $data
			$data['aFname'] = $this->input->post('adminFname');
			$data['aDate'] = $this->input->post('adminDate');
			$data['aNric'] = $this->input->post('adminNric');
			$data['aPhone'] = $this->input->post('adminPhone');
			$data['aEmail'] = $this->input->post('adminEmail');
			$data['aPassword'] = $this->input->post('adminPassword');



			//Pass the $data to model
			$this->load->model('Admin', '', TRUE);
			$result = $this-> Admin -> insertNewAdmin($data);

			if($result){
				$this->session->set_flashdata('status', '<div class="alert alert-success">New Admin was Added Succesfully!</div>');
				
				redirect('AdminSignup');
			}else{
				$this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:500px">Error! Please Try Again!</div>');
				redirect('AdminSignup');
			}
		}
	}//end of addnew
}//end of class