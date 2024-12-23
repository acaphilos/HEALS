<?php

class Schedules extends CI_Model {
    

    public function create_appointment($data) {
        return $this->db->insert('schedules', $data);
    }

    public function verifyTimeslot($date, $time)
    {
    //echo sha1($password);
    $this->db->select('*');
    $this->db->from('schedules');
    $this->db->where('date', $date);
    $this->db->where('time_slot', $time);

    $this->db->limit(1);
    $query = $this->db->get();

    //echo "1";
    $query->row_array();

    if($query->num_rows() == 0)
    {
        return true;
        //echo "2";
    }
    else
    {
        //echo "3";
        return false;
    }
    }

    function update_appointment($data)
    {
        $value = array(
            
            'id' => trim($data['appId']),
            'date' => trim($data['date']),
            'time_slot' => trim($data['time_slot']),
            'reason' => trim($data['reason']),
            'status' => 'Scheduled',
            'remark' => 'No Remark'
        );

        $this->db->where('id',$data['appId']);

        if ($this -> db -> update('schedules',$value)) 
        {
        // echo 'update success';
        return true;
        } else 
        {
        // echo 'update error'
        return false;
        }

    }

    public function end_Appointment($appointmentId) {
        
        $data = array(
            'status' => 'Ended'
        );
        $this->db->where('id', $appointmentId);
        if ($this -> db -> update('schedules',$data)) 
        {
        /*echo 'update success';*/
        return true;
        } else 
        {
        /*echo 'update error';*/
        return false;
        }
    }
    
    public function reschedule_Appointment($appointmentId) {
        
        $data = array(
            'status' => 'Pending'
        );
        $this->db->where('id', $appointmentId);
        if ($this -> db -> update('schedules',$data)) 
        {
        /*echo 'update success';*/
        return true;
        } else 
        {
        /*echo 'update error';*/
        return false;
        }
    }

    public function deleteAppointment($appointmentId) {

        $this->db->where('id', $appointmentId);
        if ($this -> db -> delete('schedules')) 
        {
        /*echo 'update success';*/
        return true;
        } else 
        {
        /*echo 'update error';*/
        return false;
        }
    }


    public function get_all_appointment() {

        $this->db->select('*');
        $this->db->from('schedules');
        $this->db->join('user', 'user.uId = schedules.uId', 'inner');
        $this->db->order_by('schedules.date', 'desc');
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }else {
            return false;
        }
    }

    public function get_all_user_appointment($userId) {
    $this->db->select('*');
    $this->db->from('schedules');
    $this->db->join('user', 'user.uId = schedules.uId', 'inner');
    $this->db->where('schedules.uId', $userId); // Assuming 'uId' is the column in the 'schedules' table
    $this->db->order_by('schedules.date', 'desc');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        /*return $query->row();*/
        return $query->result();
    } else {
        return false;
    }
}

    public function get_all_user_appointment_row_uid($userId) {
    $this->db->select('*');
    $this->db->from('schedules');
    $this->db->join('user', 'user.uId = schedules.uId', 'inner');
    $this->db->where('schedules.uId', $userId); // Assuming 'uId' is the column in the 'schedules' table
    $this->db->order_by('schedules.date', 'desc');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        /*return $query->row();*/
        return $query->row();
    } else {
        return false;
    }
}

    public function get_all_user_appointment_rows($appId) {
    $this->db->select('*');
    $this->db->from('schedules');
    $this->db->join('user', 'user.uId = schedules.uId', 'inner');
    $this->db->where('schedules.id', $appId); // Assuming 'uId' is the column in the 'schedules' table
    $this->db->order_by('schedules.date', 'desc');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return false;
    }
}

    public function get_up_user_appointment($userId) {

        date_default_timezone_set('Asia/Kuala_Lumpur');
        $this->db->select('*');
        $this->db->from('schedules');
        $this->db->join('user', 'user.uId = schedules.uId', 'inner');
        $this->db->where('schedules.uId', $userId);
        $this->db->where('date >=', date('Y-m-d'));
        $this->db->where("(status = 'Scheduled' OR status = 'Pending')");

        $this->db->order_by('date', 'asce'); // Order by id in descending order
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }else {
            return false;
        }

    }

     public function get_up_all_appointment() {

        date_default_timezone_set('Asia/Kuala_Lumpur');
        $this->db->select('*');
        $this->db->from('schedules');
        $this->db->where('date >=', date('Y-m-d'));
        $this->db->where("(status = 'Scheduled')");

        $this->db->order_by('date', 'asce'); // Order by id in descending order
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }else {
            return false;
        }

    }

    public function updateDoctorRemark($appointmentId, $newRemark)
    {
        // Update the 'remark' field in the 'schedules' table
        $data = array('remark' => $newRemark);
        $this->db->where('id', $appointmentId);
        $this->db->update('schedules', $data);
    }
}