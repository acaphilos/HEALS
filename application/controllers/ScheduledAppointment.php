<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ScheduledAppointment extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('user','',TRUE);
        $this->load->model('schedules','',TRUE);
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index() {
        if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }

        $data['all_users'] = $this-> user ->getAllUserData();
        
        $this->load->view('admin_header_logged');
		$this->load->view('schedule_users_view', $data);
		$this->load->view('footer');
    }

    ///user
    public function cancelSchedule($appointmentId){
        
        $result = $this-> schedules -> cancel_Appointment($appointmentId);

        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">Appointment is Cancelled Successfully!</div>');
                $uId = $this->input->post('uID');
                redirect('ScheduledAppointmentList');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('ScheduledAppointmentList');
        }
    }

    
    ///admin

    public function viewAddSchedule($uId) {
    	if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }
		$data['user_data'] = $this -> user -> getUserData($uId);
        $this->load->view('admin_header_logged');
		$this->load->view('schedule_add_view', $data);
		$this->load->view('footer');
    }

    public function viewUpdateSchedule($appId) {
    	if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }
		$data['user_data'] = $this -> schedules -> get_all_user_appointment_rows($appId);
        $this->load->view('admin_header_logged');
		$this->load->view('schedule_update_view', $data);
		$this->load->view('footer');
    }

    

    public function create($uId) {
	    $data = [
	        'uId' => $uId,
	        'date' => $this->input->post('date'),
	        'time_slot' => $this->input->post('time_slot'),
	        'reason' => $this->input->post('reason'),
	        'status' => 'Scheduled',
	        'remark' => 'No Remark'
	    ];

	    if ($this-> schedules ->verifyTimeslot($data['date'], $data['time_slot'])) {
            if ($this-> schedules ->create_appointment($data)) {

	        // Appointment created successfully
	        $this->session->set_flashdata('status', '<div class="alert alert-success">New Appointment was Added Succesfully!</div>');

            $data_app['user_data'] = $this-> schedules -> get_all_user_appointment_row_uid($uId);
                $this->sendEmailCreated($data_app);
	        
	        redirect('ScheduledAppointmentList');

    	    } else {
    	        // Appointment creation failed
    	        $this->session->set_flashdata('status', '<div class="alert alert-danger">Error! Failed to create scheduled appointment!</div>');
    	        
    	        redirect('ScheduledAppointmentList');
    	    }

        } else {
                // Appointment creation failed
                $this->session->set_flashdata('status', '<div class="alert alert-danger">Timeslot is Already Booked! Please Choose Another Date or Time!</div>');
                
                redirect('ScheduledAppointment/viewAddSchedule/' . $uId);
        }
	}

	public function update($appointmentId) {
	    $data = [
	        'appId' => $appointmentId,
	        'date' => $this->input->post('date'),
	        'time_slot' => $this->input->post('time_slot'),
	        'reason' => $this->input->post('reason'),
	        'status' => 'Scheduled',
	        'remark' => 'No Remark'
	    ];

	    if ($this-> schedules ->update_appointment($data)) {

	        // Appointment created successfully
	        $this->session->set_flashdata('status', '<div class="alert alert-success">New Appointment was Updated Succesfully!</div>');

            $data_app['user_data'] = $this-> schedules -> get_all_user_appointment_rows($appointmentId);
                $this->sendEmailUpdated($data_app);
	        
	        redirect('ScheduledAppointmentList');

	    } else {
	        // Appointment creation failed
	        $this->session->set_flashdata('status', '<div class="alert alert-danger">Error! Please Try Again!</div>');
	        
	        redirect('ScheduledAppointmentList');
	    }
	}

    public function endSchedule($appointmentId){
        
        $result = $this-> schedules -> end_Appointment($appointmentId);

        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">Appointment is Ended Successfully!</div>');
                
                $data['user_data'] = $this-> schedules -> get_all_user_appointment_rows($appointmentId);
                $this->sendEmailEnded($data);
            
            redirect('ScheduledAppointmentList');

                redirect('ScheduledAppointmentList');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('ScheduledAppointmentList');
        }
    }

    public function deleteSchedule($appointmentId) {

        $result = $this-> schedules ->deleteAppointment($appointmentId);
        
        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">Appointment is deleted Successfully!</div>');
                $uId = $this->input->post('uID');
                redirect('ScheduledAppointmentList');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('ScheduledAppointmentList');
        }
    }

    public function viewUser($userId) {

        $result = $this-> user ->getUserData($userId);
        
        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">User is viewed Successfully!</div>');
                redirect('ManageAllUser');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('ManageAllUser');
        }

    }
    
    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }

    public function sendEmailCreated($data){

        $this->email_library->setFrom('healsproject52@gmail.com', 'HEALS');
        $this->email_library->addAddress($data['user_data']->userEmail, $data['user_data']->userFname);
        $this->email_library->Subject = 'Scheduled Appointment Created';
        $this->email_library->Body    = 
        'Dear our beloved patient, your scheduled appointment is created! Please make sure to attend your appointment on time.<br><br>Appointment Details:<br><br>Appointment for ' . $data['user_data']->reason . 
        '<br>Date and time: ' . $data['user_data']->date . ' ' . $data['user_data']->time_slot . 
        '<br>Venue: Clinic ABC' . 
        '<br>Remark: ' . $data['user_data']->remark . 
        '<br>Status: ' . $data['user_data']->status . 
        '<br>Appt ID: ' . $data['user_data']->id . '<br>';

        $this->email_library->send();
    }

    public function sendEmailUpdated($data){

        $this->email_library->setFrom('healsproject52@gmail.com', 'HEALS');
        $this->email_library->addAddress($data['user_data']->userEmail, $data['user_data']->userFname);
        $this->email_library->Subject = 'Scheduled Appointment Updated';
        $this->email_library->Body    = 
        'Dear our beloved patient, your scheduled appointment is updated! Please make sure to attend your appointment on time.<br><br>Appointment Details:<br><br>Appointment for ' . $data['user_data']->reason . 
        '<br>Date and time: ' . $data['user_data']->date . ' ' . $data['user_data']->time_slot . 
        '<br>Venue: Clinic ABC' . 
        '<br>Remark: ' . $data['user_data']->remark . 
        '<br>Status: ' . $data['user_data']->status . 
        '<br>Appt ID: ' . $data['user_data']->id . '<br>';

        $this->email_library->send();
    }

    public function sendEmailEnded($data){

        $this->email_library->setFrom('healsproject52@gmail.com', 'HEALS');
        $this->email_library->addAddress($data['user_data']->userEmail, $data['user_data']->userFname);
        $this->email_library->Subject = 'Scheduled Appointment Ended';
        $this->email_library->Body    = 
        'Dear our beloved patient, your scheduled appointment is already ended! Please submit a new appointment with doctor to set new scheduled appointment.<br><br>Appointment Details:<br><br>Appointment for ' . $data['user_data']->reason . 
        '<br>Date and time: ' . $data['user_data']->date . ' ' . $data['user_data']->time_slot . 
        '<br>Venue: Clinic ABC' . 
        '<br>Remark: ' . $data['user_data']->remark . 
        '<br>Status: ' . $data['user_data']->status . 
        '<br>Appt ID: ' . $data['user_data']->id . '<br>';

        $this->email_library->send();
    }
}