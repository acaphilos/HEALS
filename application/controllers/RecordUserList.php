<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordUserList extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('user','',TRUE);
        $this->load->model('checkups','',TRUE);
        $this->load->model('appointments','',TRUE);
        $this->load->model('schedules','',TRUE);
        $this->load->model('records','',TRUE);
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
		$this->load->view('record_users_list_view', $data);
		$this->load->view('footer');
    }

    //user

    public function viewUserRecordsUser() {

        if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }

        $uId = $this->session-> userdata['logged_in']['id'];

        $data['user_data'] = $this -> user -> getUserData($uId);
        $data['user_record'] = $this -> records -> getUserRecords($uId);
        $data['checkups'] = $this -> checkups -> get_all_user_checkup($uId);
        $data['appointments'] = $this -> appointments -> get_all_user_appointment($uId);
        $data['schedules'] = $this -> schedules -> get_all_user_appointment($uId);
        /*$data['user_data'] = $this -> records -> getAllUserRecord($uId);*/

        
        $this->load->view('user_header_logged');
        $this->load->view('record_user_details_view', $data);
        $this->load->view('footer');
    }

    //admin

    public function create($appId) {
        $data = [
            'appId' => $appId,
            'datetime' => $this->input->post('datetime'),
            'summary' => $this->input->post('summary'),
            'prescription' => $this->input->post('prescription')

        ];

        if ($this-> records ->createRecord($data)) {

            $result = $this-> appointments -> complete_Appointment($appId);

            if($result){
                    $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">New User Record was Added Succesfully!</div>');

                    $data['user_data'] = $this-> appointments -> get_all_user_appointment_by_appId($appId);
                $this->sendEmailCompleted($data);

                    redirect('AppointmentListAdmin');
            }else{
                $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Record Submitted! Failed to change completed status!</div>');
                redirect('AppointmentListAdmin');
            }

        } else {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Failed to submit record! Please Try Again!</div>');
            
            redirect('AppointmentListAdmin');
        }
    }

    public function addUserRecords($appId) {
        if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }
        $data['user_data'] = $this -> records -> getUserData($appId);
        $data['appointments'] = $this -> appointments -> get_all_user_appointment($appId);
        $this->load->view('admin_header_logged');
        $this->load->view('record_user_add_view', $data);
        $this->load->view('footer');
    }

    public function viewUserRecords($uId) {

        if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }

        $data['user_data'] = $this -> user -> getUserData($uId);
        $data['user_record'] = $this -> records -> getUserRecords($uId);
        $data['checkups'] = $this -> checkups -> get_all_user_checkup($uId);
        $data['appointments'] = $this -> appointments -> get_all_user_appointment($uId);
        $data['schedules'] = $this -> schedules -> get_all_user_appointment($uId);
        /*$data['user_data'] = $this -> records -> getAllUserRecord($uId);*/

        
        $this->load->view('admin_header_logged');
        $this->load->view('record_user_details_view', $data);
        $this->load->view('footer');
    }
    
    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }


    public function deleteUserData($userId) {

        $result = $this-> user ->deleteUser($userId);
        
        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">User is deleted Successfully!</div>');
                $uId = $this->input->post('uID');
                redirect('ManageAllUser');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('ManageAllUser');
        }

    }

    public function updateUserData($id) {
    // Check if the request is a POST request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Get the new doctor's remark from the POST data
        $newRemark = $this->input->post('doctor_remark');

        // Call the model method to update the remark in the database
        $this-> user ->updateUser($id, $newRemark);

        // Redirect to the appointment list or any other appropriate page
        redirect('ManageAllUser');
    } else {
        // Handle non-POST requests or redirect to an error page
        redirect('ManageAllUser');
    }
    }

    function updateUserProfile($uId)
    {
        if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }
        $data = $this -> user -> getUserData($uId);
        $this->load->view('user_header_logged');
        $this->load->view('edit_user_view', $data);
        $this->load->view('footer');
    } 

    public function sendEmailCompleted($data){

        $this->email_library->setFrom('healsproject52@gmail.com', 'HEALS');
        $this->email_library->addAddress($data['user_data']->userEmail, $data['user_data']->userFname);
        $this->email_library->Subject = 'Appointment Completed';
        $this->email_library->Body    = 
        'Dear our beloved patient, your appointment is already completed! Thank you for attending your appointment on time.<br><br>Appointment Details:<br><br>Appointment for ' . $data['user_data']->reason . 
        '<br>Date and time: ' . $data['user_data']->date . ' ' . $data['user_data']->time_slot . 
        '<br>Remark: ' . $data['user_data']->remark . 
        '<br>Status: ' . $data['user_data']->status . 
        '<br>Appt ID: ' . $data['user_data']->id . '<br>';

        $this->email_library->send();
    }

    public function deleteRecord($recordId) {

        $result = $this-> records ->deleteUserRecord($recordId);
        
        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">Record is deleted Successfully!</div>');
                redirect('RecordUserList/viewUserRecordsUser');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('RecordUserList/viewUserRecordsUser');
        }

    }

}