<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 'superadmin') {
            redirect('login');
        }
        $this->load->model('User_model');
        $this->load->model('Room_model');
        $this->load->model('Guest_model');
        $this->load->model('Event_model');
        $this->load->model('Event_guest_model');
        $this->load->model('School_staff_model');
        $this->load->library('pagination');
    }

    public function index() {
        $data['title'] = 'Dashboard Superadmin';
        $data['admins'] = $this->User_model->get_admins();
        $data['rooms'] = $this->Room_model->get_all_rooms();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/dashboard', $data);
        $this->load->view('template_admin/footer');
    }

    public function manage_rooms() {
        $data['rooms'] = $this->Room_model->get_all_rooms();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/manage_rooms', $data);
        $this->load->view('template_admin/footer');
    }

    public function edit_room($room_id) {
        if ($this->input->post()) {
            $data = [
                'room_name' => $this->input->post('room_name')
            ];
            $this->Room_model->update_room($room_id, $data);
            $this->session->set_flashdata('success', 'Ruangan berhasil diperbarui.');
            redirect('superadmin/manage_rooms');
        }
        $data['room'] = $this->Room_model->get_room_by_id($room_id);
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/edit_rooms', $data);
        $this->load->view('template_admin/footer');
    }

    public function manage_admins() {
        $data['admins'] = $this->User_model->get_admins();
        $data['rooms'] = $this->Room_model->get_all_rooms();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/manage_admins', $data);
        $this->load->view('template_admin/footer');
    }

    public function add_admin() {
        if ($this->input->post()) {
            $data = [
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'status' => 'admin_ruangan',
                'room_id' => $this->input->post('room_id')
            ];
            $this->User_model->add_admin($data);
            $this->session->set_flashdata('success', 'Admin berhasil ditambahkan.');
            redirect('superadmin/manage_admins');
        }
        $data['rooms'] = $this->Room_model->get_all_rooms();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/add_admin', $data);
        $this->load->view('template_admin/footer');
    }

    public function edit_admin($id) {
        if ($this->input->post()) {
            $data = [
                'username' => $this->input->post('username'),
                'room_id' => $this->input->post('room_id')
            ];
            if ($this->input->post('password')) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
            $this->User_model->update_admin($id, $data);
            $this->session->set_flashdata('success', 'Admin berhasil diperbarui.');
            redirect('superadmin/manage_admins');
        }
        $data['admin'] = $this->User_model->get_user($id);
        $data['rooms'] = $this->Room_model->get_all_rooms();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/edit_admin', $data);
        $this->load->view('template_admin/footer');
    }

    public function delete_admin($id) {
        $this->User_model->delete_admin($id);
        $this->session->set_flashdata('success', 'Admin berhasil dihapus.');
        redirect('superadmin/manage_admins');
    }

    public function manage_guests() {
        $data['guests'] = $this->Guest_model->get_all_guests();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/manage_guests', $data);
        $this->load->view('template_admin/footer');
    }

    public function add_room() {
        $room_name = $this->input->post('room_name');
        $result = $this->Room_model->add_room($room_name);
        if ($result === true) {
            $this->session->set_flashdata('success', 'Ruangan berhasil ditambahkan.');
            redirect('superadmin/manage_rooms');
        }
    }

    public function delete_room($room_id) {
        $result = $this->Room_model->delete_room($room_id);
        if ($result === false) {
            $this->session->set_flashdata('error', 'Ruangan tidak dapat dihapus karena terdapat tamu yang terdaftar.');
        } else {
            $this->session->set_flashdata('success', 'Ruangan berhasil dihapus.');
        }
        redirect('superadmin/manage_rooms');
    }

    public function assign_admin_to_room() {
        $admin_id = $this->input->post('admin_id');
        $room_id = $this->input->post('room_id');
        $this->User_model->assign_admin_to_room($admin_id, $room_id);
        $this->session->set_flashdata('success', 'Admin berhasil ditugaskan ke ruangan.');
        redirect('superadmin/manage_admins');
    }

    public function export_guests() {
        $data['admins'] = $this->User_model->get_admins();
        $data['rooms'] = $this->Room_model->get_all_rooms();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/export_guests', $data);
        $this->load->view('template_admin/footer');
    }

    public function manage_featured_guests() {
        $data['title'] = 'Manage Featured Guests';
        $data['guests'] = $this->Guest_model->get_all_guests();
        if ($this->input->post('action') == 'toggle_featured') {
            $id = $this->input->post('id');
            $current_featured = $this->input->post('current_featured');
            $new_featured = ($current_featured == 1) ? 0 : 1;
            if ($this->Guest_model->toggle_featured($id, $new_featured)) {
                $this->session->set_flashdata('success', 'Status featured tamu berhasil diubah.');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengubah status featured.');
            }
            redirect('superadmin/manage_featured_guests');
        }
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/manage_featured_guests', $data);
        $this->load->view('template_admin/footer');
    }
}