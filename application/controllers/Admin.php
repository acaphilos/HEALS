<?php

class Admin extends CI_Controller {
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
        
        $this->load->view('admin_header_logged');
        $this->load->view('admin_dashboard_view');
        $this->load->view('footer');
    }

    public function change_status($timeslot_id) {
        $this-> appointments ->toggle_timeslot_status($timeslot_id);
        redirect('admin');
    }

    private function is_logged_in() {
        return isset($this->session -> userdata['logged_in']['id']);
        }
}
