<?php

class Admin extends CI_Model {

public function __construct() {

	parent::__construct();
	//echo 'constructor';
}

function insertNewAdmin($data){
	if($data){
		$this->db->trans_begin(true);

		//check the duplication of account
		$query = $this->db->get_where('loginadmin', array('email' => trim($data['aEmail'])));
		$count = $query->num_rows();

		if($count == 0) {
			$this->db->select_max('aId');
			$result = $this->db->get('admin');

			if($result->num_rows() > 0) {
				$cArray = $result->result_array();
				$cCount = $cArray[0]['aId'];
				$cNumber = $cCount + 1;
			} else {
				$cNumber = 10000;
			}

			$value = array(
				'aId' => $cNumber,
				'adminFname' => trim($data['aFname']),
				'adminDate' => trim($data['aDate']),
				'adminPhone' => trim($data['aPhone']),
				'adminNric' => trim($data['aNric']),
				'adminEmail' => trim($data['aEmail'])
			);

			$this->db->insert('admin', $value);
			
			$valuelogin = array(
				'aId' => $cNumber,
				'email' => trim($data['aEmail']),
				'password' => sha1($data['aPassword'])
			);
			$this->db->insert('loginadmin', $valuelogin);
		
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
}//end of addNewAdmin

function verifyLogin($email, $password)
{
	//echo sha1($password);
	$this->db->select('loginadmin.aId, admin.adminFName');
	$this->db->from('loginadmin');
	$this->db->join('admin', 'admin.aId = loginadmin.aId');
	$this->db->where('loginadmin.email', $email);
	$this->db->where('loginadmin.password', sha1($password));

	$this->db->limit(1);
	$query = $this->db->get();

	//echo "1";
	$query->row_array();

	if($query->num_rows() == 1)
	{
		return $query->result();
		echo "true";
	}
	else
	{
		echo "false";
		return false;
	}

}

function getAdminData($cNumber) {
	$this->db->select('*');
	$this->db->from('admin');
	$this->db->where('aId', $cNumber);
	$query = $this->db->get();

	if($query->num_rows() == 1)
	{
		return $query->row_array();
	}else {
		return false;
	}

}

function updateAdmin($data)
	{
		$value = array(
			'aId' => trim($data['aId']),
			'adminFname' => trim($data['aFname']),
			'adminDate' => trim($data['aDate']),
			'adminNric' => trim($data['aNric']),
			'adminPhone' => trim($data['aPhone']),
			'adminEmail' => trim($data['aEmail'])
		);

		$this->db->where('aId',$data['aId']);

		if ($this -> db -> update('admin', $value)) 
		{
		// echo 'update success';
		return true;
		} else 
		{
		// echo 'update error'
		return false;
		}

	}

}//end of class
?>