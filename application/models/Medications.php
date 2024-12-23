<?php

class Medications extends CI_Model {
    
    public function addMedication($data) {
        $this->db->insert('medications', $data);
    }

    public function getMedications() {

        $query = $this->db->get('medications');
        return $query->result();
    }
}
