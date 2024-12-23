<?php
class EmailReminder extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('reminders','',TRUE);
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

        $data['all_users'] = $this-> user ->getAllUserData();

        $this->load->view('admin_header_logged');
        $this->load->view('reminder_users_view', $data);
        $this->load->view('footer');

    }

      ///admin

    public function viewAddReminder($uId) {
        if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }
        $data['user_data'] = $this -> user -> getUserData($uId);
        $this->load->view('admin_header_logged');
        $this->load->view('reminder_add_view', $data);
        $this->load->view('footer');
    }

    public function viewUpdateReminder($reminderId) {
        if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }
        $data['user_data'] = $this -> reminders -> get_all_user_reminder_rows($reminderId);
        $this->load->view('admin_header_logged');
        $this->load->view('reminder_update_view', $data);
        $this->load->view('footer');
    }

    public function create($uId) {
        $data = [
            'uId' => $uId,
            'name' => $this->input->post('name'),
            'dosage' => $this->input->post('dosage'),
            'frequency' => $this->input->post('frequency'),
            'taken' => $this->input->post('taken'),
            'meal' => $this->input->post('meal'),
            'disease' => $this->input->post('disease'),
            'remark' => $this->input->post('remark'),
            'date' => $this->input->post('date'),
        ];

        $this->sendEmailMeds($data);

        if ($this-> reminders ->create_reminder($data)) {

            // Appointment created successfully
            $this->session->set_flashdata('status', '<div class="alert alert-success">New Reminder was Added Succesfully!</div>');
            
            redirect('EmailReminderList');

        } else {
            // Appointment creation failed
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            
            redirect('EmailReminderList');
        }
    }

    public function update($reminderId) {
        $data = [
            'id' => $reminderId,
            'name' => $this->input->post('name'),
            'dosage' => $this->input->post('dosage'),
            'frequency' => $this->input->post('frequency'),
            'taken' => $this->input->post('taken'),
            'meal' => $this->input->post('meal'),
            'disease' => $this->input->post('disease'),
            'remark' => $this->input->post('remark'),
            'date' => $this->input->post('date')
        ];

        if ($this-> reminders ->update_reminder($data)) {

            // Appointment created successfully
            $this->session->set_flashdata('status', '<div class="alert alert-success">New Reminder was Updated Succesfully!</div>');
            
            redirect('EmailReminderList');

        } else {
            // Appointment creation failed
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            
            redirect('EmailReminderList');
        }
    }


    public function sendEmailMeds($data){

        $user_data = $this-> user ->getUserData($data['uId']);

        $this->email_library->setFrom('healsproject52@gmail.com', 'HEALS');
        $this->email_library->addAddress($user_data->userEmail, 'Muhammad Afif');
        $this->email_library->Subject = 'Medication Reminder';
        $this->email_library->Body    = 
        'Dear our beloved patient, don\'t forget to take your medication:'. '<br>Meds Name: ' .
        $data['name'] . '<br>' . 
        $data['dosage'] . ' ' . $data['frequency']. ' ' . $data['taken']. ' ' . $data['meal'] . 
        '<br>For: ' . $data['disease']. 
        '<br>Remark: ' . $data['remark'].
        '<br>Venue: Clinic ABC';

        $this->email_library->send();
    }
       
    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }

    
}
