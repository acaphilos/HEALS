<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppointmentListAdmin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('appointments','',TRUE);
        $this->load->model('user','',TRUE);

        $this->load->library('Email_library');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index() {
        if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }

        $data['all_appointments'] = $this-> appointments ->get_all_appointment();
        $data['all_up_appointments'] = $this-> appointments ->get_up_all_appointment();
        
        $this->load->view('admin_header_logged');
		$this->load->view('appointment_list_admin_view', $data);
		$this->load->view('footer');
    }
    
    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }

    public function cancelAppointment($appointmentId){

        // Get the new doctor's remark from the POST data
        $newRemark = $this->input->post('doctor_remark');

        // Call the model method to update the remark in the database
        $this-> appointments ->updateDoctorRemark($appointmentId, $newRemark);
        $result = $this-> appointments -> cancel_Appointment($appointmentId);

        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">Appointment is cancelled Successfully!</div>');
                
                $data['user_data'] = $this-> appointments -> get_all_user_appointment_by_appId($appointmentId);
                $this->sendEmailCancelled($data);

                redirect('AppointmentListAdmin');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('AppointmentListAdmin');
        }
    }

    public function approveAppointment($appointmentId){
        
        $result = $this-> appointments -> approve_Appointment($appointmentId);
        

        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">Appointment is approved Successfully!</div>');
                
                $data['user_data'] = $this-> appointments -> get_all_user_appointment_by_appId($appointmentId);
                $this->sendEmailApproved($data);

                //here
                redirect('AppointmentListAdmin');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('AppointmentListAdmin');
        }
    }


    public function declineAppointment($appointmentId){
        
        $result = $this-> appointments -> decline_Appointment($appointmentId);

        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">Appointment is declined Successfully!</div>');
                
                $data['user_data'] = $this-> appointments -> get_all_user_appointment_by_appId($appointmentId);
                $this->sendEmailDeclined($data);

                redirect('AppointmentListAdmin');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('AppointmentListAdmin');
        }
    }

    public function deleteAppointment($appointmentId) {

        $result = $this-> appointments ->deleteAppointment($appointmentId);
        
        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">Appointment is deleted Successfully!</div>');
                $uId = $this->input->post('uID');
                redirect('AppointmentListAdmin');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('AppointmentListAdmin');
        }
    }

    

    public function sendEmailApproved($data){

        $this->email_library->setFrom('healsproject52@gmail.com', 'HEALS');
        $this->email_library->addAddress($data['user_data']->userEmail, $data['user_data']->userFname);
        $this->email_library->Subject = 'Appointment Approved';
        $this->email_library->Body    = 
        'Dear our beloved patient, your appointment is already approved! Please make sure to attend your appointment on time.<br><br>Appointment Details:<br><br>Appointment for ' . $data['user_data']->reason . 
        '<br>Date and time: ' . $data['user_data']->date . ' ' . $data['user_data']->time_slot . 
        '<br>Venue: Clinic ABC' . 
        '<br>Remark: ' . $data['user_data']->remark . 
        '<br>Status: ' . $data['user_data']->status . 
        '<br>Appt ID: ' . $data['user_data']->id . '<br>';

        $this->email_library->send();
    }

    public function sendEmailDeclined($data){

        $this->email_library->setFrom('healsproject52@gmail.com', 'HEALS');
        $this->email_library->addAddress($data['user_data']->userEmail, $data['user_data']->userFname);
        $this->email_library->Subject = 'Appointment Declined';
        $this->email_library->Body    = 
        'Dear our beloved patient, your appointment is declined! Please submit a new appointment with different date or time.<br><br>Appointment Details:<br><br>Appointment for ' . $data['user_data']->reason . 
        '<br>Date and time: ' . $data['user_data']->date . ' ' . $data['user_data']->time_slot . 
        '<br>Venue: Clinic ABC' . 
        '<br>Remark: ' . $data['user_data']->remark . 
        '<br>Status: ' . $data['user_data']->status . 
        '<br>Appt ID: ' . $data['user_data']->id . '<br>';

        $this->email_library->send();
    }

    public function sendEmailCancelled($data){

        $this->email_library->setFrom('healsproject52@gmail.com', 'HEALS');
        $this->email_library->addAddress($data['user_data']->userEmail, $data['user_data']->userFname);
        $this->email_library->Subject = 'Appointment Cancelled';
        $this->email_library->Body    = 
        'Dear our beloved patient, your appointment is cancelled! Please submit a new appointment with different date or time.<br><br>Appointment Details:<br><br>Appointment for ' . $data['user_data']->reason . 
        '<br>Date and time: ' . $data['user_data']->date . ' ' . $data['user_data']->time_slot . 
        '<br>Venue: Clinic ABC' . 
        '<br>Remark: ' . $data['user_data']->remark . 
        '<br>Status: ' . $data['user_data']->status . 
        '<br>Appt ID: ' . $data['user_data']->id . '<br>';

        $this->email_library->send();
    }     

}