<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminFeedback extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->model('feedback','',TRUE);
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
		$data['feedback_data'] = $this -> feedback -> getFeedbackData();

		$this->load->view('admin_header_logged');
		$this->load->view('feedback_admin_view', $data);
		$this->load->view('footer');
	}

	public function deleteFeedback($feedbackId) {

        $result = $this-> feedback ->deleteFeedback($feedbackId);
        
        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">Appointment is deleted Successfully!</div>');
                redirect('AdminFeedback');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('AdminFeedback');
        }

        redirect('appointment_list');
    }

    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }
}//end of class