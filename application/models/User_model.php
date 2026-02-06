
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Get all admins (superadmin or admin_ruangan)
    public function get_all_users() {
        return $this->db->get_where('users', ['status' => 'admin_ruangan'])->result();
    }

    // Get admins with room names
    public function get_admins() {
        $this->db->select('users.*, rooms.room_name');
        $this->db->from('users');
        $this->db->join('rooms', 'users.room_id = rooms.id', 'left');
        $this->db->where('users.status', 'admin_ruangan');
        return $this->db->get()->result();
    }

    // Get admin with rooms
    public function get_admin_with_rooms() {
        $this->db->select('users.id, users.name as admin_name, rooms.room_name as room_name, rooms.id as room_id');
        $this->db->from('users');
        $this->db->join('rooms', 'users.room_id = rooms.id', 'left');
        $this->db->where('users.status', 'admin_ruangan');
        return $this->db->get()->result();
    }

    // Get user by ID
    public function get_user($id) {
        return $this->db->get_where('users', ['id' => $id, 'status' => 'admin_ruangan'])->row();
    }

    // Verifikasi login
    public function check_login($username, $password) {
        $this->db->select('users.*, rooms.room_name');
        $this->db->from('users');
        $this->db->join('rooms', 'users.room_id = rooms.id', 'left');
        $this->db->where('users.username', $username);
        $query = $this->db->get();
        $user = $query->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }

    // Menambahkan admin baru
    public function add_admin($data) {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    // Mengupdate data admin
    public function update_admin($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    // Menghapus admin
    public function delete_admin($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    // Assign admin to room
    public function assign_admin_to_room($admin_id, $room_id) {
        $data = ['room_id' => $room_id];
        $this->db->where('id', $admin_id);
        return $this->db->update('users', $data);
    }
}

