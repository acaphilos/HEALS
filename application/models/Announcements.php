<?php

class Announcements extends CI_Model {

	public function __construct() {

		parent::__construct();
		//echo 'constructor';
	}

	public function getAnnouncementData() {

		$query = $this->db->get('announcements');

		return $query->result();
	}

	function insertNewAnnouncement($data){
	if($data){
		$this->db->trans_begin(true);

		$count = 0;

		if($count == 0) {
			$this->db->select_max('announcementId');
			$result = $this->db->get('announcements');

			if($result->num_rows() > 0) {
				$cArray = $result->result_array();
				$cCount = $cArray[0]['announcementId'];
				$cNumber = $cCount + 1;
			} else {
				$cNumber = 10000;
			}

			$value = array(
				'announcementId' => trim($cNumber),
				'announcementTitle' => trim($data['announcementTitle']),
				'announcementContent' => trim($data['announcementContent']),
				'date' => trim($data['date']),
				'aId' => trim($data['aId'])
			);


		$this->db->insert('announcements', $value);
		   
		  
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

	public function deleteAnnouncement($announcementId) {

        $this->db->where('announcementId', $announcementId);
        if ($this -> db -> delete('announcements')) 
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
?>