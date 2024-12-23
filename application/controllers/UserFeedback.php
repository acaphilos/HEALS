<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserFeedback extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->model('feedback','',TRUE);
		$this->load->model('user','',TRUE);
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

		$uId = $this->session-> userdata['logged_in']['id'];
		$data = $this -> user -> getUserData($uId);
		$this->load->view('user_header_logged');
		$this->load->view('feedback_user_view', $data);
		$this->load->view('footer');
	}
    
    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }

	function addnewfeedback() {
		//signup form validation
		$this->load->library('form_validation');
		$data ['content'] = "userFormfeedback";

		//define the rules of input validation
		$this->form_validation->set_rules('cEmail', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('cName', 'sender Name', 'trim|required');
		$this->form_validation->set_rules('cTitle', 'feedback Title', 'trim|required');
		$this->form_validation->set_rules('cContent', 'feedback Content', 'trim|required');
		$this->form_validation->set_rules('date', 'feedback Date', 'trim|required');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');


		if($this->form_validation->run() === FALSE)
		{
			//field validation failed. user redirected to signup page
			$this-> session->set_flashdata('status', '<div class="alert alert-danger text-center" style="width:100%">Error! Please Enter the Correct Information!</div>');
			$this-> load->view('user_header_logged');
			$this-> load->view('feedback_user_view', $data);
			$this-> load->view('footer');
		}
		else
		{
			//Binding form data from view to array $data
			$data['feedbackId'] = $this->input->post('cID');
			$data['email'] = $this->input->post('cEmail');
			$data['senderName'] = $this->input->post('cName');
			$data['feedbackTitle'] = $this->input->post('cTitle');
			$data['feedbackContent'] = $this->input->post('cContent');
			$data['date'] = $this->input->post('date');

			//Pass the $data to model
			$this->load->model('feedback', '', TRUE); $result = $this->
			feedback -> insertNewfeedback($data);

			if($result){
				$this->session->set_flashdata('status', '<div class="alert_green" style="width:100%">New feedback was Added Succesfully!</div>');
				redirect('UserFeedback');
			}else{
				$this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:500px">Error! Please Try Again!</div>');
				
				redirect('UserFeedback');
			}
		}
	}//end of addnew

}//end of class