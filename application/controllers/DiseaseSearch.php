<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DiseaseSearch extends CI_Controller {

    function __construct(){
        
        parent::__construct();
        $this->load->model('DiseaseBookmarks','',TRUE);
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index() {

        if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }
        // Load the default view
        $this->load->view('user_header_logged');
        $this->load->view('disease_search_view');
        $this->load->view('footer');
    }
    
    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }

    public function addBookmark() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Get the new doctor's remark from the POST data
        $uId = $this->session-> userdata['logged_in']['id'];
        date_default_timezone_set('Asia/Kuala_Lumpur');

        $data = [
            'uId' => $uId,
            'datetime' => date('Y-m-d\TH:i'),
            'content' => $this->input->post('search')
        ];
        /*var_dump($data);*/

        $this->load->model('DiseaseBookmarks','',TRUE);

        if ($this-> DiseaseBookmarks -> addNewBookmark($data)) {
            
            // Appointment created successfully
            $this->session->set_flashdata('status', '<div class="alert alert-success">New Bookmark was Saved Succesfully!</div>');
            redirect('DiseaseSearch');

        } else {
            // Appointment creation failed
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            redirect('DiseasePrediction');
        }

    }
}
}
