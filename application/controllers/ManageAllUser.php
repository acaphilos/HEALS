<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageAllUser extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('user','',TRUE);
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
		$this->load->view('manage_user_view', $data);
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

}