<?php

class User extends CI_Model {

public function __construct() {

	parent::__construct();
	//echo 'constructor';
}

function insertNewUser($data){
	if($data){
		$this->db->trans_begin(true);

		//check the duplication of account
		$query = $this->db->get_where('loginuser', array('email' => trim($data['uEmail'])));
		$count = $query->num_rows();

		if($count == 0) {
			$this->db->select_max('uId');
			$result = $this->db->get('user');

			if($result->num_rows() > 0) {
				$cArray = $result->result_array();
				$cCount = $cArray[0]['uId'];
				$cNumber = $cCount + 1;
			} else {
				$cNumber = 10000;
			}

			$value = array(
				'uId' => $cNumber,
				'userFname' => trim($data['uFname']),
				'userDate' => trim($data['uDate']),
				'userPhone' => trim($data['uPhone']),
				'userNric' => trim($data['uNric']),
				'userEmail' => trim($data['uEmail'])
			);

			$this->db->insert('user', $value);
			
			$valuelogin = array(
				'loginUId' => $cNumber,
				'email' => trim($data['uEmail']),
				'password' => sha1($data['uPassword']), //db column => sha1 encrypt
				'userId' => $cNumber,
			);
			$this->db->insert('loginuser', $valuelogin);
		
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
}//end of addNewUser

function verifyLogin($email, $password)
{
	//echo sha1($password);
	$this->db->select('loginuser.userId, user.userFName');
	$this->db->from('loginuser');
	$this->db->join('user', 'user.uId = loginuser.userId');
	$this->db->where('loginuser.email', $email);
	$this->db->where('loginuser.password', sha1($password));

	$this->db->limit(1);
	$query = $this->db->get();

	//echo "1";
	$query->row_array();

	if($query->num_rows() == 1)
	{
		return $query->result();
		//echo "2";
	}
	else
	{
		//echo "3";
		return false;
	}

}

function getAllUserData() {
	$this->db->select('*');
	$this->db->from('user');
	$query = $this->db->get();

	if($query->num_rows() > 0)
	{
		return $query->result();
	}else {
		return false;
	}
}

function getUserData($userId) {
	$this->db->select('*');
	$this->db->from('user');
	$this->db->where('uId', $userId);
	$query = $this->db->get();

	if($query->num_rows() == 1)
	{
		return $query->row();
	}else {
		return false;
	}
}


function updateUser($data)
	{
		$value = array(
			'uId' => trim($data['uId']),
			'userFname' => trim($data['uFname']),
			'userDate' => trim($data['uDate']),
			'userPhone' => trim($data['uPhone']),
			'userNric' => trim($data['uNric']),
			'userEmail' => trim($data['uEmail'])
		);

		$this->db->where('uId',$data['uId']);

		if ($this -> db -> update('user',$value)) 
		{
		// echo 'update success';
		return true;
		} else 
		{
		// echo 'update error'
		return false;
		}

	}

	public function deleteUser($uId) {

        $this->db->where('uId', $uId);
        if ($this -> db -> delete('user')) 
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