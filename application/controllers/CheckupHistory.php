 <?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CheckupHistory extends CI_Controller {
	
	private $checkupresult;

	function __construct(){
		
		parent::__construct();
		$this->load->model('checkups','',TRUE);
        $this->load->model('user','',TRUE);

		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login'); // Change 'login' to the actual login page URL
        }

        $uId = $this->session-> userdata['logged_in']['id'];
		$data['checkups'] = $this -> checkups -> get_all_user_checkup($uId);
		/*var_dump($data);*/

		$this->load->view('user_header_logged');
		$this->load->view('checkup_history_view', $data);
		$this->load->view('footer');

	
	}

	public function deleteCheckup($checkupId) {

        $result = $this-> checkups ->deleteUserCheckup($checkupId);
        
        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:60%">Appointment is deleted Successfully!</div>');
                redirect('CheckupHistory');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:60%">Error! Please Try Again!</div>');
            redirect('CheckupHistory');
        }

    }

    private function is_logged_in() {
        return isset($this->session -> userdata['logged_in']['id']);
    }

}//end of class
