<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest_model extends CI_Model {
    public function save_guest($data) {
        return $this->db->insert('guests', $data);
    }

    public function add_guest($data) {
        $insert = $this->db->insert('guests', $data);
        if (!$insert) {
            log_message('error', 'Gagal insert guest: ' . $this->db->error()['message']);
        }
        return $insert;
    }
    
    public function count_all_guests() {
        return $this->db->count_all('guests');
    }

    public function count_guests_by_status($status) {
        $this->db->where('status', $status);
        return $this->db->count_all_results('guests');
    }

    public function get_all_guests() {
        $this->db->select('guests.id, guests.name, guests.phone, guests.institution, guests.purpose, guests.status, COALESCE(rooms.room_name, "Tidak ada ruangan") as room_name, guests.photo, school_staff.name as staff_name, guests.created_at, guests.is_featured');
        $this->db->from('guests');
        $this->db->join('school_staff', 'guests.school_staff_id = school_staff.id', 'left');
        $this->db->join('rooms', 'school_staff.room_id = rooms.id', 'left');
        $this->db->order_by('guests.created_at', 'DESC');
        $query = $this->db->get();
        if ($query === FALSE) {
            log_message('error', 'Gagal get all guests: ' . $this->db->error()['message']);
            return [];
        }
        return $query->result();
    }

    public function get_all_rooms() {
        $query = $this->db->get('rooms');
        if ($query === FALSE) {
            log_message('error', 'Gagal get all rooms: ' . $this->db->error()['message']);
            return [];
        }
        return $query->result();
    }

    public function get_today_guests() {
        $this->db->select('guests.*, COALESCE(rooms.room_name, "Tidak ada ruangan") as room_name');
        $this->db->from('guests');
        $this->db->join('school_staff', 'guests.school_staff_id = school_staff.id', 'left');
        $this->db->join('rooms', 'school_staff.room_id = rooms.id', 'left');
        $this->db->where('DATE(guests.created_at)', date('Y-m-d'));
        $query = $this->db->get();
        if ($query === FALSE) {
            log_message('error', 'Gagal get today guests: ' . $this->db->error()['message']);
            return [];
        }
        return $query->result();
    }
    
    public function get_pending_guests($room_id) {
        $this->db->select('guests.id, guests.name, guests.phone, guests.institution, guests.purpose, guests.signature, guests.photo, guests.status, guests.created_at, school_staff.name as staff_name, COALESCE(rooms.room_name, "Tidak ada ruangan") as room_name');
        $this->db->from('guests');
        $this->db->join('school_staff', 'guests.school_staff_id = school_staff.id', 'left');
        $this->db->join('rooms', 'school_staff.room_id = rooms.id', 'left');
        $this->db->where('school_staff.room_id', $room_id);
        $this->db->where('guests.status', 'pending');
        $this->db->order_by('guests.created_at', 'DESC');
        $query = $this->db->get();
        if ($query === FALSE) {
            log_message('error', 'Gagal get pending guests: ' . $this->db->error()['message']);
            return [];
        }
        return $query->result();
    }

    public function get_filtered_guests($room_id, $start_date, $end_date) {
        $this->db->select('guests.name AS guest_name, guests.phone, guests.institution, guests.purpose, guests.signature, guests.photo, guests.status, guests.reason, guests.created_at, COALESCE(rooms.room_name, "Tidak ada ruangan") as room_name, school_staff.name as staff_name');
        $this->db->from('guests');
        $this->db->join('school_staff', 'guests.school_staff_id = school_staff.id', 'left');
        $this->db->join('rooms', 'school_staff.room_id = rooms.id', 'left');
        $this->db->where('guests.created_at >=', $start_date);
        $this->db->where('guests.created_at <=', $end_date);
        if ($room_id) {
            $this->db->where('school_staff.room_id', $room_id);
        }
        $query = $this->db->get();
        if ($query === FALSE) {
            log_message('error', 'Gagal get filtered guests: ' . $this->db->error()['message']);
            return [];
        }
        return $query->result_array();
    }    

    public function get_featured_guests() {
        $this->db->select('guests.id, guests.name, guests.phone, guests.institution, guests.purpose, guests.status, COALESCE(rooms.room_name, "Tidak ada ruangan") as room_name, guests.photo, school_staff.name as staff_name, guests.created_at');
        $this->db->from('guests');
        $this->db->join('school_staff', 'guests.school_staff_id = school_staff.id', 'left');
        $this->db->join('rooms', 'school_staff.room_id = rooms.id', 'left');
        $this->db->where('guests.is_featured', 1);
        $this->db->order_by('guests.created_at', 'DESC');
        $query = $this->db->get();
        if ($query === FALSE) {
            log_message('error', 'Gagal get featured guests: ' . $this->db->error()['message']);
            return [];
        }
        return $query->result();
    }

    public function toggle_featured($id, $is_featured) {
        $data = ['is_featured' => $is_featured];
        $this->db->where('id', $id)->update('guests', $data);
        return $this->db->affected_rows() > 0;
    }
}