<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class HomeUser extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->model('appointments','',TRUE);
		$this->load->model('announcements','',TRUE);
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
        $data['user_appointments'] = $this-> appointments ->get_up_user_appointment($uId);
        $data['announce_data'] = $this -> announcements -> getAnnouncementData();
		$this->load->view('user_header_logged');
		$this->load->view('home_user_view', $data);
		$this->load->view('footer');
	

	}
    
    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }

}//end of class