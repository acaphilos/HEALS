<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppointmentListUser extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('appointments','',TRUE);
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
        $data['user_appointments'] = $this-> appointments ->get_all_user_appointment($uId);
        
        $this->load->view('user_header_logged');
		$this->load->view('appointment_list_user_view', $data);
		$this->load->view('footer');
    }
    
    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }

    public function cancelAppointment($appointmentId){
        
        $result = $this-> appointments -> cancel_Appointment($appointmentId);

        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">Appointment is cancelled Successfully!</div>');
                $uId = $this->input->post('uID');
                redirect('AppointmentListUser');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('AppointmentListUser');
        }
    }

    public function deleteAppointment($appointmentId) {

        $result = $this-> appointments ->deleteAppointment($appointmentId);
        
        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">Appointment is deleted Successfully!</div>');
                $uId = $this->input->post('uID');
                redirect('AppointmentListUser');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('AppointmentListUser');
        }

        redirect('appointment_list');
    }
}