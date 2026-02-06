<?php
class Event_model extends CI_Model {
    
    public function create_event($data) {
        $data['kode_event'] = substr(md5(rand()), 0, 8); // Generate kode unik
        $this->db->insert('events', $data);
        return $this->db->insert_id();
    }

    public function get_events() {
        return $this->db->get('events')->result();
    }

    public function get_event_by_kode($kode) {
        return $this->db->get_where('events', ['kode_event' => $kode])->row();
    }
}