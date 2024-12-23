<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class AnnouncementAdmin extends CI_Controller {
	
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
		/*$data['announce_data'] = $this -> announcements -> getAnnouncementData();*/
		$this->load->view('admin_header_logged');
		$this->load->view('announcement_admin_view');
		/*$this->load->view('announcement_view', $data);*/
		$this->load->view('footer');
	

	}
    
    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }

	function addnewAnnouncement() {
		//signup form validation
		$this->load->library('form_validation');
		$data ['content'] = "userFormAnnouncement";

		//define the rules of input validation
		$this->form_validation->set_rules('fTitle', 'announcement Title', 'trim|required');
		$this->form_validation->set_rules('fContent', 'announcement Content', 'trim|required');
		$this->form_validation->set_rules('fDate', 'announcement Date', 'trim|required');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if($this->form_validation->run() === FALSE)
		{
			//field validation failed. user redirected to signup page
			$this-> session->set_flashdata('status', '<div class="alert alert-danger text-center" style="width:100%">Error! Please Enter the Correct Information!</div>');
			redirect('AnnouncementAdmin');
		}
		else
		{
			//Binding form data from view to array $data
			$data['announcementTitle'] = $this->input->post('fTitle');
			$data['announcementContent'] = $this->input->post('fContent');
			$data['date'] = $this->input->post('fDate');

			$adminId = $this-> session ->userdata['logged_in']['id'];
			$data['aId'] = $adminId;

			//Pass the $data to model
			$this->load->model('announcements', '', TRUE); 
			$result = $this-> announcements -> insertNewAnnouncement($data);

			if($result){
				$this->session->set_flashdata('status', '<div class="alert_green" style="width:100%">New announcement was Added Succesfully!</div>');
				redirect('AnnouncementAdmin');
			}else{
				$this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:500px">Error! Please Try Again!</div>');
				redirect('AnnouncementAdmin');
			}
		}
	}//end of addnew

}//end of class