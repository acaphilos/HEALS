<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ScheduledAppointmentList extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('user','',TRUE);
        $this->load->model('checkups','',TRUE);
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

        $data['all_appointments'] = $this-> schedules ->get_all_appointment();
        $data['all_up_appointments'] = $this-> schedules ->get_up_all_appointment();
        
        $this->load->view('admin_header_logged');
        $this->load->view('schedule_list_all_view', $data);
        $this->load->view('footer');
    }

    //user

    public function viewUserSchedule($uId) {
        if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }

        $data['user_appointments'] = $this-> schedules ->get_all_user_appointment($uId);
        $data['user_up_appointments'] = $this-> schedules ->get_up_user_appointment($uId);
        
        $this->load->view('user_header_logged');
        $this->load->view('schedule_list_user_view', $data);
        $this->load->view('footer');
    }

    

    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }

    //admin
    public function viewUserScheduleAdmin($uId) {
        if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }

        $data['user_appointments'] = $this-> schedules ->get_all_user_appointment($uId);
        $data['user_up_appointments'] = $this-> schedules ->get_up_user_appointment($uId);
        
        $this->load->view('admin_header_logged');
        $this->load->view('schedule_list_admin_view', $data);
        $this->load->view('footer');
    }

    public function rescheduleAppointment($appointmentId){

        $result = $this-> schedules -> reschedule_Appointment($appointmentId);

        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">Appointment is cancelled Successfully!</div>');
                $uId = $this->input->post('uID');
                redirect('ScheduledAppointmentList/viewUserSchedule/' . $appointmentId);
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('ScheduledAppointmentList/viewUserSchedule/' . $appointmentId);
        }
    }

    public function deleteAppointment($appointmentId) {

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


    public function updateDoctorRemark($id) {
    // Check if the request is a POST request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Get the new doctor's remark from the POST data
        $newRemark = $this->input->post('doctor_remark');

        // Call the model method to update the remark in the database
        $this-> schedules ->updateDoctorRemark($id, $newRemark);

        // Redirect to the appointment list or any other appropriate page
        redirect('ScheduledAppointmentList');
    } else {
        // Handle non-POST requests or redirect to an error page
        redirect('ScheduledAppointmentList');
    }
    }
}