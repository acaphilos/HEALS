 <?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AnnouncementList extends CI_Controller {
	
	private $announcementresult;

	function __construct(){
		
		parent::__construct();
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
		$data['announcements'] = $this -> announcements -> getAnnouncementData();
		/*var_dump($data);*/

		$this->load->view('admin_header_logged');
		$this->load->view('announcement_list_view', $data);
		$this->load->view('footer');

	
	}
    
    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }

	public function deleteAnnouncement($announcementId) {

        $result = $this-> announcements ->deleteAnnouncement($announcementId);
        
        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">Appointment is deleted Successfully!</div>');
                redirect('AnnouncementList');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('AnnouncementList');
        }

        redirect('appointment_list');
    }

}//end of class
