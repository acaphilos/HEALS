<?php
class Reminders extends CI_Model {
    
    public function create_reminder($data) {
        return $this->db->insert('reminders', $data);
    }

    public function get_all_reminder() {

        $this->db->select('*');
        $this->db->from('reminders');
        $this->db->join('user', 'user.uId = reminders.uId', 'inner');
        $this->db->order_by('reminders.date', 'desc');
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }else {
            return false;
        }
    }

    ////

    function update_reminder($data)
    {
        $value = array(
            
            'id' => trim($data['id']),
            'name' => trim($data['name']),
            'dosage' => trim($data['dosage']),
            'frequency' => trim($data['frequency']),
            'taken' => trim($data['taken']),
            'meal' => trim($data['meal']),
            'disease' => trim($data['disease']),
            'remark' => trim($data['remark']),
            'date' => trim($data['date'])
        );

        $this->db->where('id',$data['id']);

        if ($this -> db -> update('reminders',$value)) 
        {
        // echo 'update success';
        return true;
        } else 
        {
        // echo 'update error'
        return false;
        }

    }


    public function deleteReminder($reminderId) {

        $this->db->where('id', $reminderId);
        if ($this -> db -> delete('reminders')) 
        {
        /*echo 'update success';*/
        return true;
        } else 
        {
        /*echo 'update error';*/
        return false;
        }
    }


    public function get_all_user_reminder($userId) {
    $this->db->select('*');
    $this->db->from('reminders');
    $this->db->join('user', 'user.uId = reminders.uId', 'inner');
    $this->db->where('reminders.uId', $userId); // Assuming 'uId' is the column in the 'reminders' table
    $this->db->order_by('reminders.date', 'desc');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        /*return $query->row();*/
        return $query->result();
    } else {
        return false;
    }
}

    public function get_all_user_reminder_rows($reminderId) {
    $this->db->select('*');
    $this->db->from('reminders');
    $this->db->join('user', 'user.uId = reminders.uId', 'inner');
    $this->db->where('reminders.id', $reminderId); // Assuming 'uId' is the column in the 'reminders' table
    $this->db->order_by('reminders.date', 'desc');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return false;
    }
}

}
