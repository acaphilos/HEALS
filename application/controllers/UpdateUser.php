<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateUser extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

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
		$this->load->view('edit_user_view', $data);
		$this->load->view('footer');
		/*var_dump($aId);*/
	}
    
    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }


function updateUserProfile()
	{
		// form validation
		$this->load->library('form_validation');
		$data ['content'] = "formUser";

		//define the rules of input validation
		$this->form_validation->set_rules('userFname', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('userDate', 'date of birth', 'trim|required');
		$this->form_validation->set_rules('userPhone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('userNric', 'Nric', 'trim|required');
		$this->form_validation->set_rules('userEmail', 'Email', 'trim|required|valid_email');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if($this->form_validation->run() === FALSE)
		{
			//field validation failed. user redirected to signup page
			$this-> session->set_flashdata('status', '<div class="alert alert-danger text-center" style="width:100%">Error! Please Enter the  Information Again!</div>');
			
			$uId = $this->input->post('uID');
			$data = $this-> user ->getUserData($uId);
			redirect('UpdateUser');
		}
		else
		{
			//Binding form data from view to array $data
			$data['uId'] = $this->session->userdata['logged_in']['id'];
			$data['uFname'] = $this->input->post('userFname');
			$data['uDate'] = $this->input->post('userDate');
			$data['uNric'] = $this->input->post('userNric');
			$data['uPhone'] = $this->input->post('userPhone');
			$data['uEmail'] = $this->input->post('userEmail');
			$data['uPassword'] = $this->input->post('userPassword');

			//Pass the $data to model
			$this->load->model('user', '', TRUE);
			$result = $this-> user -> updateUser($data);

			if($result){
				$this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">New Information was Updated Successfully!</div>');
				$uId = $this->input->post('uID');
				redirect('UpdateUser');
			}else{
				$this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:500px">Error! Please Try Again!</div>');
				redirect('UpdateUser');
			}
		} //form validation
	} //index function

	public function deleteUser($uId) {

        $result = $this-> user ->deleteUser($uId);
        
        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">User is deleted Successfully!</div>');
                redirect('Login');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('UpdateUser');
        }

        redirect('appointment_list');
    }



}//class