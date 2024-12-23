<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckupSymptom extends CI_Controller {

	function __construct(){
		
		parent::__construct();
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
		
		$this->load->view('user_header_logged');
		$this->load->view('checkup_symptom_view');
		$this->load->view('footer');
	}
    
    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }
}
