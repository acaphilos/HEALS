<?php

class Appointments extends CI_Model {
    

    public function create_appointment($data) {
        return $this->db->insert('appointments', $data);
    }

    public function verifyTimeslot($date, $time)
    {
    //echo sha1($password);
    $this->db->select('*');
    $this->db->from('appointments');
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

    public function cancel_Appointment($appointmentId) {
        
        $data = array(
            'status' => 'Cancelled'
        );
        $this->db->where('id', $appointmentId);
        if ($this -> db -> update('appointments',$data)) 
        {
        /*echo 'update success';*/
        return true;
        } else 
        {
        /*echo 'update error';*/
        return false;
        }
    }

    public function decline_Appointment($appointmentId) {
        
        $data = array(
            'status' => 'Declined'
        );
        $this->db->where('id', $appointmentId);
        if ($this -> db -> update('appointments',$data)) 
        {
        /*echo 'update success';*/
        return true;
        } else 
        {
        /*echo 'update error';*/
        return false;
        }
    }
    
    public function approve_Appointment($appointmentId) {
        
        $data = array(
            'status' => 'Approved'
        );
        $this->db->where('id', $appointmentId);
        if ($this -> db -> update('appointments',$data)) 
        {
        /*echo 'update success';*/
        return true;
        } else 
        {
        /*echo 'update error';*/
        return false;
        }
    }

    public function complete_Appointment($appointmentId) {
        
        $data = array(
            'status' => 'Completed'
        );
        $this->db->where('id', $appointmentId);
        if ($this -> db -> update('appointments',$data)) 
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
        if ($this -> db -> delete('appointments')) 
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
        $this->db->from('appointments');
        $this->db->join('user', 'user.uId = appointments.uId', 'inner');
        $this->db->order_by('appointments.date', 'desc');
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
        $this->db->from('appointments');
        $this->db->join('user', 'user.uId = appointments.uId', 'inner');
        $this->db->where('appointments.uId', $userId);
        $this->db->order_by('date', 'desc');
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }else {
            return false;
        }
    }

    public function get_all_user_appointment_by_appId($appointmentId) {

        $this->db->select('*');
        $this->db->from('appointments');
        $this->db->join('user', 'user.uId = appointments.uId', 'inner');
        $this->db->where('appointments.id', $appointmentId);
        $this->db->order_by('date', 'desc');
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->row();
        }else {
            return false;
        }
    }

    public function get_up_user_appointment($userId) {

        date_default_timezone_set('Asia/Kuala_Lumpur');
        $this->db->select('*');
        $this->db->from('appointments');
        $this->db->join('user', 'user.uId = appointments.uId', 'inner');
        $this->db->where('appointments.uId', $userId);
        $this->db->where('date >=', date('Y-m-d'));
        $this->db->where("(status = 'Approved' OR status = 'Pending')");

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
        $this->db->from('appointments');
        $this->db->join('user', 'user.uId = appointments.uId', 'inner');
        $this->db->where('appointments.date >=', date('Y-m-d'));
        $this->db->where("(appointments.status = 'Approved' OR appointments.status = 'Pending')");

        $this->db->order_by('appointments.date', 'asce'); // Order by id in descending order
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
        // Update the 'remark' field in the 'appointments' table
        $data = array('remark' => $newRemark);
        $this->db->where('id', $appointmentId);
        $this->db->update('appointments', $data);
    }
}