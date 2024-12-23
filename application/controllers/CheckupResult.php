<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CheckupResult extends CI_Controller {
	
	private $checkupresult;

	function __construct(){
		
		parent::__construct();
		$this->load->model('checkups','',TRUE);
        $this->load->model('user','',TRUE);

		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		if (!$this->is_logged_in()) {
            $this->session->set_flashdata('status', '<div class="alert alert-danger">Please login again!</div>');
            redirect('Login');
        }
		$uId = $this->session-> userdata['logged_in']['id'];
		/*$symptoms = $this -> checkups -> getCheckupSymptoms($uId);*/
		$symptoms = str_replace('_', ' ', $this -> checkups -> getCheckupSymptoms($uId));
		$result = $this -> checkups -> getCheckupResult($uId);
		$data['symptoms'] = explode(",", $symptoms);
		$data['result'] = explode(",", $result);
		/*var_dump($data['symptoms']);*/


		$this->load->view('user_header_logged');
		$this->load->view('checkup_result_view', $data);
		$this->load->view('footer');
	
	}
    
    private function is_logged_in() {
    return isset($this->session -> userdata['logged_in']['id']);
    }

	public function addNewCheckup() {
	    
	    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		    $selected_values = $_POST['userSymptom'];
		    $input_data = implode(",", $selected_values);
		    // $command = 'python C:/xampp/htdocs/heals_project/application/controllers/python_script.py ' . escapeshellarg($input_data) . ' 2>&1';
			$pythonPath = 'C:/Users/Asyraaf/AppData/Local/Programs/Python/Python313/python.exe';
			$command = $pythonPath . ' C:/xampp/htdocs/heals_project/application/controllers/python_script.py ' . escapeshellarg($input_data) . ' 2>&1';
			$output = shell_exec($command);
			$top_three_classes = explode(",", trim($output));

			// Validate Python script output
			// if ($output === null || empty($output)) {
			// 	throw new Exception('Error executing Python script or no output received.');
			// }
		}

		$uId = $this->session-> userdata['logged_in']['id'];

		date_default_timezone_set('Asia/Kuala_Lumpur');
	    $data = [
	        'uId' => $uId,
	        'datetime' => date('Y-m-d\TH:i'),
	        'symptoms' => implode(',', $this->input->post('userSymptom[]')),
	        // 'result' => implode(',', $top_three_classes)
	        'result' => $output
	    ];

	    if ($this-> checkups ->create_checkup($data)) {
	        
	        // Appointment created successfully
	        $this->session->set_flashdata('status', '<div class="alert alert-success">New Checkup was Saved Succesfully!</div>');
	        redirect('CheckupResult');

	    } else {
	        // Appointment creation failed
	        $this->session->set_flashdata('status', '<div class="alert alert-danger">Error! Please Try Again!</div>');
	        redirect('DiseasePrediction');
	    }
	}

}//end of class
