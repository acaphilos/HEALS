<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('appointments','',TRUE);
        $this->load->model('user','',TRUE);
        $this->load->model('checkups','',TRUE);
        $this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
    }

    public function index() {
    	if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }
        $uId = $this->session-> userdata['logged_in']['id'];
		$data['user_data'] = $this -> user -> getUserData($uId);
		$data['checkups'] = $this -> checkups -> get_all_user_checkup($uId);
        $this->load->view('user_header_logged');
		$this->load->view('appointment_user_view', $data);
		$this->load->view('footer');
    }
    
    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }

	public function create() {
		$uId = $this->session-> userdata['logged_in']['id'];
	    $data = [
	        'uId' => $uId,
	        'date' => $this->input->post('date'),
	        'time_slot' => $this->input->post('time_slot'),
	        'reason' => $this->input->post('reason'),
	        'checkupId' => $this->input->post('checkupId'),
	        'status' => 'Pending',
	        'remark' => 'No Remark'
	    ];

	    if ($this-> appointments ->verifyTimeslot($data['date'], $data['time_slot'])) {
		    if ($this-> appointments ->create_appointment($data)) {

		        // Appointment created successfully
		        $this->session->set_flashdata('status', '<div class="alert alert-success">New Appointment was requested Succesfully! Please wait for the doctor to approve your appointment.</div>');
		        
		        redirect('AppointmentListUser');

		    } else {
		        // Appointment creation failed
		        $this->session->set_flashdata('status', '<div class="alert alert-danger">Error! Failed to create appointment!</div>');
		        
		        redirect('appointment');
		    }
		
		} else {
		        // Appointment creation failed
		        $this->session->set_flashdata('status', '<div class="alert alert-danger">Timeslot is Already Booked! Please Choose Another Date or Time!</div>');
		        
		        redirect('appointment');
		    }
	}
}
