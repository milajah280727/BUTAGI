<?php
class Event_guest_model extends CI_Model {

    public function save_guest($data) {
        $this->db->insert('event_guests', $data);
        return $this->db->insert_id();
    }

    public function get_guest_by_id($id) {
        return $this->db->get_where('event_guests', ['id' => $id])->row();
    }

    public function update_attended($id) {
        $this->db->update('event_guests', ['attended' => 1], ['id' => $id]);
    }

    public function get_all_guests() {
        return $this->db->get('event_guests')->result();
    }

    public function get_guests_by_event($event_id) {
        return $this->db->get_where('event_guests', ['event_id' => $event_id])->result();
    }

    public function get_unique_events() {
        $this->db->distinct();
        $this->db->select('event_id'); // Ganti dengan kolom event yang sesuai
        return $this->db->get('event_guests')->result();
    }
}