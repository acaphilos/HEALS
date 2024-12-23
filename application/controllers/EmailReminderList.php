<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailReminderList extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('user','',TRUE);
        $this->load->model('reminders','',TRUE);
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index() {
        if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }

        $data['all_reminders'] = $this-> reminders ->get_all_reminder();
        
        $this->load->view('admin_header_logged');
        $this->load->view('reminder_list_all_view', $data);
        $this->load->view('footer');
    }

    //user

    public function viewUserReminderUser() {
        if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }

        $uId = $this->session -> userdata['logged_in']['id'];
        $data['user_reminders'] = $this-> reminders ->get_all_user_reminder($uId);
        
        $this->load->view('user_header_logged');
        $this->load->view('reminder_list_user_view', $data);
        $this->load->view('footer');
    }

    


    //admin
    public function viewUserReminderAdmin($uId) {
        if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }

        $data['user_reminders'] = $this-> reminders ->get_all_user_reminder($uId);
        
        $this->load->view('admin_header_logged');
        $this->load->view('reminder_list_admin_view', $data);
        $this->load->view('footer');
    }

    public function updateReminder($reminderId){

        $result = $this-> reminders -> update_Reminder($reminderId);

        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">Reminder is cancelled Successfully!</div>');
                $uId = $this->input->post('uID');
                redirect('EmailReminderList/viewUserReminderAdmin/' . $reminderId);
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('EmailReminderList/viewUserReminderAdmin/' . $reminderId);
        }
    }

    public function deleteReminder($reminderId) {

        $result = $this-> reminders ->deleteReminder($reminderId);
        
        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">Reminder is deleted Successfully!</div>');
                $uId = $this->input->post('uID');
                redirect('EmailReminderList');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('EmailReminderList');
        }
    }

    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }
}