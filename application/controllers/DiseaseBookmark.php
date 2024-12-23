<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DiseaseBookmark extends CI_Controller {

    function __construct(){
        
        parent::__construct();
        $this->load->model('DiseaseBookmarks','',TRUE);
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
        // Load the default view
        $uId = $this->session-> userdata['logged_in']['id'];
        $data['bookmarks'] = $this -> DiseaseBookmarks -> get_all_user_bookmark($uId);

        $this->load->view('user_header_logged');
        $this->load->view('disease_bookmark_view', $data);
        $this->load->view('footer');
    }
    
    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }

    public function deleteBookmark($bookmarkId) {

        $result = $this-> DiseaseBookmarks ->deleteUserBookmark($bookmarkId);
        
        if($result){
                $this->session->set_flashdata('status', '<div class="alert alert-success" style="width:100%">Bookmark is deleted Successfully!</div>');
                redirect('DiseaseBookmark');
        }else{
            $this->session->set_flashdata('status', '<div class="alert alert-danger" style="width:100%">Error! Please Try Again!</div>');
            redirect('DiseaseBookmark');
        }
    }
}