<?php

class Records extends CI_Model {

	public function __construct() {

	parent::__construct();
	//echo 'constructor';
	}

	public function createRecord($data) {

    if ($this->db->insert('medicalrecords', $data)) {
    	return true;
    } else {
        return false;
    
	}
    }

	public function getUserData($appId) {
    $this->db->select('*');
    $this->db->from('appointments');
    $this->db->join('user', 'user.uId = appointments.uId', 'inner');
    $this->db->where('appointments.id', $appId);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return false;
    }
	}

	/*public function getAllUserRecord($uId) {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->join('checkups', 'checkups.uId = user.uId', 'inner');
    $this->db->join('appointments', 'appointments.uId = user.uId', 'inner');
    $this->db->join('schedules', 'schedules.uId = user.uId', 'inner');
    $this->db->where('user.uId', $uId);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return false;
    }
	}*/

	public function getUserRecords($userId) {
    $this->db->select('*');
    $this->db->from('appointments');
    $this->db->join('medicalrecords', 'medicalrecords.appId = appointments.id', 'inner');
    $this->db->where('appointments.uId', $userId);
    $this->db->order_by('medicalrecords.datetime', 'desc');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
	}

    public function deleteUserRecord($recordId) {

            $this->db->where('recordId', $recordId);
            if ($this -> db -> delete('medicalrecords')) 
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