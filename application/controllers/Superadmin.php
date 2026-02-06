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

    public function manage_events() {
        $data['title'] = 'Manage Events';
        $data['events'] = $this->Event_model->get_events();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/manage_event', $data);
        $this->load->view('template_admin/footer');
    }

    public function create_event() {
        if ($this->input->post()) {
            $data = [
                'nama_event' => $this->input->post('nama_event'),
                'tanggal' => $this->input->post('tanggal')
            ];
            $event_id = $this->Event_model->create_event($data);
            $event = $this->db->get_where('events', ['id' => $event_id])->row();
            $link = base_url('event/form/' . $event->kode_event);
            $this->session->set_flashdata('link', $link);
            redirect('superadmin/manage_events');
        }
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/create_event');
        $this->load->view('template_admin/footer');
    }

    public function manage_school_staff() {
        $data['title'] = 'Manage School Staff';
        $search = $this->input->get('search') ? $this->input->get('search') : '';
        $data['staff'] = $this->School_staff_model->get_all_staff($search);
        $data['jabatan'] = $this->School_staff_model->get_all_jabatan();
        $data['rooms'] = $this->Room_model->get_all_rooms();
        $data['kelas'] = $this->db->get('kelas')->result();
        $data['jabatan_kategori'] = $this->School_staff_model->get_all_jabatan_kategori();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/manage_school_staff', $data);
        $this->load->view('template_admin/footer');
    }

    public function assign_staff_to_room_or_class() {
        $staff_id = $this->input->post('staff_id');
        $room_id = $this->input->post('room_id') ?: null;
        $kelas_id = $this->input->post('kelas_id') ?: null;
        $data = [
            'room_id' => $room_id,
            'kelas_id' => $kelas_id
        ];
        $this->School_staff_model->update_staff($staff_id, $data);
        $this->session->set_flashdata('success', 'Staff berhasil ditugaskan.');
        redirect('superadmin/manage_school_staff');
    }

    public function add_school_staff() {
        if ($this->input->post()) {
            $data = [
                'name' => $this->input->post('name'),
                'jabatan_id' => $this->input->post('jabatan_id'),
                'room_id' => $this->input->post('room_id') ?: null,
                'kelas_id' => $this->input->post('kelas_id') ?: null
            ];
            $this->School_staff_model->add_staff($data);
            $this->session->set_flashdata('success', 'Staff berhasil ditambahkan.');
            redirect('superadmin/manage_school_staff');
        }
        $data['jabatan'] = $this->School_staff_model->get_all_jabatan();
        $data['rooms'] = $this->Room_model->get_all_rooms();
        $data['kelas'] = $this->db->get('kelas')->result();
        $data['jabatan_kategori'] = $this->School_staff_model->get_all_jabatan_kategori();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/add_school_staff', $data);
        $this->load->view('template_admin/footer');
    }

    public function edit_school_staff($id) {
        if ($this->input->post()) {
            $data = [
                'name' => $this->input->post('name'),
                'jabatan_id' => $this->input->post('jabatan_id'),
                'room_id' => $this->input->post('room_id') ?: null,
                'kelas_id' => $this->input->post('kelas_id') ?: null
            ];
            $this->School_staff_model->update_staff($id, $data);
            $this->session->set_flashdata('success', 'Staff berhasil diperbarui.');
            redirect('superadmin/manage_school_staff');
        }
        $data['staff'] = $this->School_staff_model->get_staff($id);
        $data['jabatan'] = $this->School_staff_model->get_all_jabatan();
        $data['rooms'] = $this->Room_model->get_all_rooms();
        $data['kelas'] = $this->db->get('kelas')->result();
        $data['jabatan_kategori'] = $this->School_staff_model->get_all_jabatan_kategori();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/edit_school_staff', $data);
        $this->load->view('template_admin/footer');
    }

    public function delete_school_staff($id) {
        $staff = $this->School_staff_model->get_staff($id);
        if (!$staff) {
            $this->session->set_flashdata('error', 'Staff tidak ditemukan.');
            redirect('superadmin/manage_school_staff');
        }
        if ($this->School_staff_model->delete_staff($id)) {
            $this->session->set_flashdata('success', 'Staff berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus staff.');
        }
        redirect($this->input->get('redirect') ?: 'superadmin/manage_school_staff');
    }

    public function manage_jabatan() {
        $data['title'] = 'Kelola Jabatan';
        $search = $this->input->get('search');
        $data['jabatan'] = $this->School_staff_model->get_all_jabatan($search);
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/manage_jabatan', $data);
        $this->load->view('template_admin/footer');
    }

    public function add_jabatan() {
        if ($this->input->post()) {
            $data = [
                'nama_jabatan' => $this->input->post('nama_jabatan')
            ];
            $this->School_staff_model->add_jabatan($data);
            $this->session->set_flashdata('success', 'Jabatan berhasil ditambahkan.');
            redirect('superadmin/manage_jabatan');
        }
        $data['title'] = 'Tambah Jabatan';
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/add_jabatan', $data);
        $this->load->view('template_admin/footer');
    }

    public function edit_jabatan($id) {
        if ($this->input->post()) {
            $data = [
                'nama_jabatan' => $this->input->post('nama_jabatan')
            ];
            $this->School_staff_model->update_jabatan($id, $data);
            $this->session->set_flashdata('success', 'Jabatan berhasil diperbarui.');
            redirect('superadmin/manage_jabatan');
        }
        $data['title'] = 'Edit Jabatan';
        $data['jabatan'] = $this->School_staff_model->get_jabatan($id);
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/edit_jabatan', $data);
        $this->load->view('template_admin/footer');
    }

    public function delete_jabatan($id) {
        $result = $this->School_staff_model->delete_jabatan($id);
        if ($result) {
            $this->session->set_flashdata('success', 'Jabatan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Jabatan tidak dapat dihapus karena digunakan oleh staff.');
        }
        redirect('superadmin/manage_jabatan');
    }

    public function view_jabatan_staff($id) {
        $data['title'] = 'Staff dengan Jabatan';
        $data['jabatan'] = $this->School_staff_model->get_jabatan($id);
        if (!$data['jabatan']) {
            $this->session->set_flashdata('error', 'Jabatan tidak ditemukan.');
            redirect('superadmin/manage_jabatan');
        }
        $data['staff'] = $this->School_staff_model->get_staff_by_jabatan($id);
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/view_jabatan_staff', $data);
        $this->load->view('template_admin/footer');
    }

    public function manage_jabatan_kategori() {
        $data['title'] = 'Kelola Kategori Jabatan';
        $data['jabatan_kategori'] = $this->School_staff_model->get_all_jabatan_kategori();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('superadmin/manage_jabatan_kategori', $data);
        $this->load->view('template_admin/footer');
    }

    public function add_jabatan_kategori() {
        $data['title'] = 'Tambah Kategori Jabatan';
        if ($this->input->post()) {
            $data = ['nama_kategori' => $this->input->post('nama_kategori')];
            if ($this->School_staff_model->add_jabatan_kategori($data)) {
                $this->session->set_flashdata('success', 'Kategori jabatan berhasil ditambahkan.');
                redirect('superadmin/manage_jabatan_kategori');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan kategori jabatan.');
            }
        }
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('superadmin/add_jabatan_kategori', $data);
        $this->load->view('template_admin/footer');
    }

    public function edit_jabatan_kategori($id) {
        $data['title'] = 'Edit Kategori Jabatan';
        $data['kategori'] = $this->School_staff_model->get_jabatan_kategori($id);
        if ($this->input->post()) {
            $data_update = ['nama_kategori' => $this->input->post('nama_kategori')];
            if ($this->School_staff_model->update_jabatan_kategori($id, $data_update)) {
                $this->session->set_flashdata('success', 'Kategori jabatan berhasil diperbarui.');
                redirect('superadmin/manage_jabatan_kategori');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui kategori jabatan.');
            }
        }
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('superadmin/edit_jabatan_kategori', $data);
        $this->load->view('template_admin/footer');
    }

    public function delete_jabatan_kategori($id) {
        if ($this->School_staff_model->delete_jabatan_kategori($id)) {
            $this->session->set_flashdata('success', 'Kategori jabatan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus kategori jabatan. Kategori masih digunakan.');
        }
        redirect('superadmin/manage_jabatan_kategori');
    }

    public function manage_jabatan_kategori_relasi($kategori_id) {
        $data['title'] = 'Kelola Jabatan dalam Kategori';
        $data['kategori'] = $this->School_staff_model->get_jabatan_kategori($kategori_id);
        $data['jabatan_in_kategori'] = $this->School_staff_model->get_jabatan_by_kategori($kategori_id);
        $data['jabatan_not_in_kategori'] = $this->School_staff_model->get_jabatan_not_in_kategori($kategori_id);
        if ($this->input->post()) {
            $jabatan_ids = $this->input->post('jabatan_ids') ?? [];
            foreach ($jabatan_ids as $jabatan_id) {
                $this->School_staff_model->add_jabatan_to_kategori($jabatan_id, $kategori_id);
            }
            $this->session->set_flashdata('success', 'Jabatan dalam kategori berhasil diperbarui.');
            redirect('superadmin/manage_jabatan_kategori_relasi/' . $kategori_id);
        }
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/manage_jabatan_kategori_relasi', $data);
        $this->load->view('template_admin/footer');
    }

    public function remove_jabatan_from_kategori($kategori_id, $jabatan_id) {
        $this->School_staff_model->remove_jabatan_from_kategori($jabatan_id, $kategori_id);
        $this->session->set_flashdata('success', 'Jabatan berhasil dihapus dari kategori.');
        redirect('superadmin/manage_jabatan_kategori_relasi/' . $kategori_id);
    }

    public function getJabatanByKategori($kategori_id) {
        $jabatan = $this->School_staff_model->get_jabatan_by_kategori($kategori_id);
        echo json_encode($jabatan);
    }
}