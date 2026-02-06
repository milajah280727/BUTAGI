<?php
class School_staff_model extends CI_Model {
    public function get_all_staff($search = '') {
        $this->db->select('school_staff.*, jabatan.nama_jabatan, COALESCE(rooms.room_name, "Tidak ada ruangan") as room_name, kelas.nama_kelas');
        $this->db->from('school_staff');
        $this->db->join('jabatan', 'school_staff.jabatan_id = jabatan.id', 'left');
        $this->db->join('rooms', 'school_staff.room_id = rooms.id', 'left');
        $this->db->join('kelas', 'school_staff.kelas_id = kelas.id', 'left');
        if ($search) {
            $this->db->like('school_staff.name', $search);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_jabatan($search = '') {
        $this->db->from('jabatan');
        if ($search) {
            $this->db->like('nama_jabatan', $search);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_jabatan_kategori($search = '') {
        $this->db->from('jabatan_kategori');
        if ($search) {
            $this->db->like('nama_kategori', $search);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function add_staff($data) {
        return $this->db->insert('school_staff', $data);
    }

    public function update_staff($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('school_staff', $data);
    }

    public function delete_staff($id) {
        $this->db->where('id', $id);
        return $this->db->delete('school_staff');
    }

    public function get_staff($id) {
        $this->db->select('school_staff.*, jabatan.nama_jabatan, COALESCE(rooms.room_name, "Tidak ada ruangan") as room_name, kelas.nama_kelas');
        $this->db->from('school_staff');
        $this->db->join('jabatan', 'school_staff.jabatan_id = jabatan.id', 'left');
        $this->db->join('rooms', 'school_staff.room_id = rooms.id', 'left');
        $this->db->join('kelas', 'school_staff.kelas_id = kelas.id', 'left');
        $this->db->where('school_staff.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_staff_with_room($staff_id) {
        $this->db->select('s.id, s.name, COALESCE(r.room_name, "Tidak ada ruangan") as room_name');
        $this->db->from('school_staff s');
        $this->db->join('rooms r', 's.room_id = r.id', 'left');
        $this->db->where('s.id', $staff_id);
        $query = $this->db->get();
        $result = $query->row();
        return $result ? (object) [
            'id' => $result->id,
            'name' => $result->name,
            'room_name' => $result->room_name
        ] : (object) [
            'id' => null,
            'name' => null,
            'room_name' => 'Tidak ada ruangan'
        ];
    }

    public function add_jabatan($data) {
        return $this->db->insert('jabatan', $data);
    }

    public function update_jabatan($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('jabatan', $data);
    }

    public function delete_jabatan($id) {
        $this->db->where('id', $id);
        if ($this->db->get_where('school_staff', ['jabatan_id' => $id])->num_rows() > 0) {
            return false;
        }
        return $this->db->delete('jabatan');
    }

    public function get_jabatan($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('jabatan');
        return $query->row();
    }

    public function get_staff_by_jabatan($jabatan_id) {
        $this->db->select('id, name');
        $this->db->from('school_staff');
        $this->db->where('jabatan_id', $jabatan_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_jurusan() {
        return $this->db->get('jurusan')->result();
    }

    public function get_kelas_by_jurusan($jurusan_id) {
        $this->db->where('jurusan_id', $jurusan_id);
        return $this->db->get('kelas')->result();
    }

    public function get_wali_kelas($kelas_id) {
        $this->db->select('s.id, s.name, COALESCE(r.room_name, "Tidak ada ruangan") as room_name');
        $this->db->from('school_staff s');
        $this->db->join('rooms r', 's.room_id = r.id', 'left');
        $this->db->where('s.kelas_id', $kelas_id);
        $result = $this->db->get()->row();
        return $result ? (object) [
            'id' => $result->id,
            'name' => $result->name,
            'room_name' => $result->room_name
        ] : null;
    }

    public function get_jabatan_by_kategori($kategori_id) {
        $this->db->select('j.id, j.nama_jabatan');
        $this->db->from('jabatan j');
        $this->db->join('jabatan_kategori_relasi jkr', 'j.id = jkr.jabatan_id');
        $this->db->where('jkr.kategori_id', $kategori_id);
        return $this->db->get()->result();
    }

    public function get_jabatan_not_in_kategori($kategori_id) {
        $this->db->select('jabatan.*');
        $this->db->from('jabatan');
        $this->db->where('jabatan.id NOT IN (SELECT jabatan_id FROM jabatan_kategori_relasi WHERE kategori_id = ' . $this->db->escape($kategori_id) . ')');
        $query = $this->db->get();
        return $query->result();
    }

    public function add_jabatan_kategori($data) {
        return $this->db->insert('jabatan_kategori', $data);
    }

    public function update_jabatan_kategori($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('jabatan_kategori', $data);
    }

    public function delete_jabatan_kategori($id) {
        if ($this->db->get_where('jabatan_kategori_relasi', ['kategori_id' => $id])->num_rows() > 0) {
            return false;
        }
        $this->db->where('id', $id);
        return $this->db->delete('jabatan_kategori');
    }
  
    public function get_jabatan_kategori($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('jabatan_kategori');
        return $query->row();
    }

    public function add_jabatan_to_kategori($jabatan_id, $kategori_id) {
        $data = [
            'jabatan_id' => $jabatan_id,
            'kategori_id' => $kategori_id
        ];
        return $this->db->insert('jabatan_kategori_relasi', $data);
    }

    public function remove_jabatan_from_kategori($jabatan_id, $kategori_id) {
        $this->db->where('jabatan_id', $jabatan_id);
        $this->db->where('kategori_id', $kategori_id);
        return $this->db->delete('jabatan_kategori_relasi');
    }
}