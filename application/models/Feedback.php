<?php

class Feedback extends CI_Model {

	public function __construct() {

	parent::__construct();
	//echo 'constructor';
	}


function getFeedbackData() {

	$query = $this->db->get('feedback');

	return $query->result();
}

function insertNewFeedback($data){
	if($data){
		$this->db->trans_begin(true);

		$count = 0;

		if($count == 0) {
			$this->db->select_max('feedbackId');
			$result = $this->db->get('feedback');

			if($result->num_rows() > 0) {
				$cArray = $result->result_array();
				$cCount = $cArray[0]['feedbackId'];
				$cNumber = $cCount + 1;
			} else {
				$cNumber = 10000;
			}

			$value = array(
				'email' => trim($data['email']),
				'senderName' => trim($data['senderName']),
				'feedbackTitle' => trim($data['feedbackTitle']),
				'feedbackContent' => trim($data['feedbackContent']),
				'date' => trim($data['date']),
			);


		$this->db->insert('feedback', $value);
		   
		  
		} else {
			$this->db->trans_rollback();
			return false;
		}

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}

	} else {
	 	return false;
	  }
}

public function deleteFeedback($feedbackId) {

        $this->db->where('feedbackId', $feedbackId);
        if ($this -> db -> delete('feedback')) 
        {
        /*echo 'update success';*/
        return true;
        } else 
        {
        /*echo 'update error';*/
        return false;
        }
    }
}