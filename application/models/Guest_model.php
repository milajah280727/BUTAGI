<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest_model extends CI_Model {
    public function save_guest($data) {
        $this->db->insert('guests', $data);
    }

    public function add_guest($data) {
        $this->db->insert('guests', $data);
    }
    
    public function count_all_guests() {
        return $this->db->count_all('guests');
    }

    public function count_guests_by_status($status) {
        $this->db->where('status', $status);
        return $this->db->count_all_results('guests');
    }

    public function get_all_guests() {
        $this->db->select('guests.id, guests.name, guests.phone, guests.institution, guests.purpose, guests.status, rooms.room_name as room_name, guests.photo, users.name as user_name, guests.created_at, guests.is_featured');
        $this->db->from('guests');
        $this->db->join('users', 'guests.user_id = users.id');
        $this->db->join('rooms', 'rooms.id = users.room_id');
        $this->db->order_by('guests.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_rooms() {
        return $this->db->get('rooms')->result();
    }

    public function get_today_guests() {
        $this->db->select('guests.*, rooms.room_name');
        $this->db->from('guests');
        $this->db->join('rooms', 'rooms.id = users.room_id');
        $this->db->join('users', 'guests.user_id = users.id');
        $this->db->where('DATE(guests.created_at)', date('Y-m-d'));
        return $this->db->get()->result();
    }
    
    public function get_pending_guests($room_id) {
        $this->db->select('guests.id, guests.name, guests.phone, guests.institution, guests.purpose, guests.signature, guests.photo, guests.status, guests.created_at, users.name as admin_name');
        $this->db->from('guests');
        $this->db->join('users', 'users.id = guests.user_id');
        $this->db->join('rooms', 'rooms.id = users.room_id');
        $this->db->where('room_id', $room_id);
        $this->db->where('guests.status', 'pending');
        $this->db->order_by('guests.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_filtered_guests($room_id, $start_date, $end_date) {
        $this->db->select('guests.name AS guest_name, guests.phone, guests.institution, guests.purpose, guests.signature, guests.photo, guests.status, guests.reason, guests.created_at, rooms.room_name, users.name as admin_name');
        $this->db->from('guests');
        $this->db->join('users', 'users.id = guests.user_id');
        $this->db->join('rooms', 'rooms.id = users.room_id');
        $this->db->where('guests.created_at >=', $start_date);
        $this->db->where('guests.created_at <=', $end_date);

        if ($room_id) {
            $this->db->where('rooms.id', $room_id);
        }
        
        return $this->db->get()->result_array();
    }    

    // Method baru untuk mengambil tamu yang featured
    public function get_featured_guests() {
        $this->db->select('guests.id, guests.name, guests.phone, guests.institution, guests.purpose, guests.status, rooms.room_name as room_name, guests.photo, users.name as user_name, guests.created_at');
        $this->db->from('guests');
        $this->db->join('users', 'guests.user_id = users.id');
        $this->db->join('rooms', 'rooms.id = users.room_id');
        $this->db->where('guests.is_featured', 1);
        $this->db->order_by('guests.created_at', 'DESC');
        return $this->db->get()->result();
    }

    // Method baru untuk toggle status featured
    public function toggle_featured($id, $is_featured) {
        $data = ['is_featured' => $is_featured];
        $this->db->where('id', $id)->update('guests', $data);
        return $this->db->affected_rows() > 0;
    }
}