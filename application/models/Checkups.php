<?php

class Checkups extends CI_Model {

public function create_checkup($data) {
    return $this->db->insert('checkups', $data);
}

public function get_all_checkup() {

    return $this->db->get('checkups')->result();
}

public function get_all_user_checkup($userId) {

    $this->db->select('*');
	$this->db->from('checkups');
	$this->db->where('uId', $userId);
	$this->db->order_by('id', 'desc'); // Order by id in descending order
	$query = $this->db->get();

	if($query->num_rows() > 0)
	{
		return $query->result();
	}else {
		return false;
	}
}

function getCheckupSymptoms($userId) {
	$this->db->select('symptoms');
	$this->db->from('checkups');
	$this->db->where('uId', $userId);
	$this->db->order_by('id', 'desc'); // Order by id in descending order
    $this->db->limit(1); // Limit the symptoms to 1 row
	$query = $this->db->get();

	if($query->num_rows() > 0)
	{
		return $query->row()->symptoms;
	}else {
		return false;
	}
}

function getCheckupResult($userId) {
	$this->db->select('result');
	$this->db->from('checkups');
	$this->db->where('uId', $userId);
	$this->db->order_by('id', 'desc'); // Order by id in descending order
    $this->db->limit(1); // Limit the result to 1 row
	$query = $this->db->get();

	if($query->num_rows() > 0)
	{
		return $query->row()->result;
	}else {
		return false;
	}
}

public function deleteUserCheckup($appointmentId) {

        $this->db->where('id', $appointmentId);
        if ($this -> db -> delete('checkups')) 
        {
        /*echo 'update success';*/
        return true;
        } else 
        {
        /*echo 'update error';*/
        return false;
        }
    }

}//end of class
?>