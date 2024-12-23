<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateAdmin extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->model('admin','',TRUE);
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


		$aId = $this->session->userdata['logged_in']['id'];
		$data = $this -> admin -> getAdminData($aId);
		$this->load->view('admin_header_logged');
		$this->load->view('edit_admin_view', $data);
		$this->load->view('footer');
		/*var_dump($aId);*/
	}
    
    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }


function updateAdminProfile()
	{
		// form validation
		$this->load->library('form_validation');
		$data ['content'] = "formAdmin";

		//define the rules of input validation
		$this->form_validation->set_rules('adminFname', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('adminDate', 'date of birth', 'trim|required');
		$this->form_validation->set_rules('adminPhone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('adminNric', 'Nric', 'trim|required');
		$this->form_validation->set_rules('adminEmail', 'Email', 'trim|required|valid_email');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');


		if($this->form_validation->run() === FALSE)
		{
			//field validation failed. user redirected to signup page
			$this-> session->set_flashdata('status', '<div class="alert alert-danger text-center" style="width:100%">Error! Please Enter the  Information Again!</div>');
			
			redirect('UpdateAdmin');
		}
		else
		{
			//Binding form data from view to array $data
			$data['aId'] = $this->session->userdata['logged_in']['id'];
			$data['aFname'] = $this->input->post('adminFname');
			$data['aDate'] = $this->input->post('adminDate');
			$data['aNric'] = $this->input->post('adminNric');
			$data['aPhone'] = $this->input->post('adminPhone');
			$data['aEmail'] = $this->input->post('adminEmail');
			$data['aPassword'] = $this->input->post('adminPassword');

			//Pass the $data to model
			$this->load->model('admin', '', TRUE);
			$result = $this-> admin -> updateAdmin($data);

			if($result){
				$this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">New Information was Updated Successfully!</div>');
				$aId = $this->input->post('aId');
				redirect('UpdateAdmin');
			}else{
				$this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:500px">Error! Please Try Again!</div>');
				redirect('UpdateAdmin');
			}
		} //form validation
	} //index function
}//class