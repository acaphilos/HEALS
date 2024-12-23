<?php

class DiseaseBookmarks extends CI_Model {

	public function __construct() {

	parent::__construct();
	//echo 'constructor';
	}

	function addNewBookmark($data){
	if($data){
		$this->db->trans_begin(true);

		$count = 0;

		if($count == 0) {
			$this->db->select_max('id');
			$result = $this->db->get('bookmarks');

			if($result->num_rows() > 0) {
				$cArray = $result->result_array();
				$cCount = $cArray[0]['id'];
				$cNumber = $cCount + 1;
			} else {
				$cNumber = 10000;
			}

			$value = array(
				'id' => $cNumber,
				'uId' => trim($data['uId']),
				'datetime' => trim($data['datetime']),
				'content' => trim($data['content'])
			);


		$this->db->insert('bookmarks', $value);
		   
		  
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

	
	public function get_all_user_bookmark($userId) {

    $this->db->select('*');
	$this->db->from('bookmarks');
	$this->db->where('uId', $userId);
	$this->db->order_by('datetime', 'desc'); // Order by id in descending order
	$query = $this->db->get();

	if($query->num_rows() > 0)
	{
		return $query->result();
	}else {
		return false;
	}
}

public function deleteUserBookmark($bookmarkId) {

        $this->db->where('id', $bookmarkId);
        if ($this -> db -> delete('bookmarks')) 
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