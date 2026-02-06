<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Guest_model $Guest_model
 * @property User_model $User_model
 * @property School_staff_model $School_staff_model
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Loader $load
 * @property CI_DB_query_builder $db
 */
class GuestController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Guest_model');
        $this->load->model('User_model');
        $this->load->model('School_staff_model');
        // Helper file dan url biasanya sudah auto-load, tapi jika belum, load di sini
        $this->load->helper(array('form', 'url', 'file'));
    }

    public function index() {
        $data['guests'] = $this->Guest_model->get_featured_guests();
        $data['rooms'] = $this->Guest_model->get_all_rooms();
        $this->load->view('templates/header');
        $this->load->view('templates/navigator');
        $this->load->view('guest/form', $data);
        $this->load->view('templates/footer');
    }

    public function guest_form() {
        $data['admins'] = $this->User_model->get_admin_with_rooms(); // Admin + Ruangan
        $data['rooms'] = $this->Guest_model->get_all_rooms();
        $data['jabatan'] = $this->School_staff_model->get_all_jabatan(); 
        $data['jabatan_kategori'] = $this->School_staff_model->get_all_jabatan_kategori(); 
        $this->load->view('templates/header');
        $this->load->view('templates/navigator');
        $this->load->view('guest/guest_form', $data);
        $this->load->view('templates/footer');
    }

    public function today() {
        $data['guests'] = $this->Guest_model->get_featured_guests();
        $this->load->view('guest/today', $data);
    }

        // --- PERBAIKAN: Method submit_form yang sesuai dengan Guest_model ---
    public function submit_form() {
        // 1. Ambil data inputan
        $name        = $this->input->post('name');
        $phone       = $this->input->post('phone');
        $institution = $this->input->post('institution');
        $purpose     = $this->input->post('purpose');
        $user_id     = $this->input->post('user_id'); 
        $photo_base64     = $this->input->post('photo');
        $signature_base64 = $this->input->post('signature');

        // 2. Validasi Input Sederhana
        if (empty($name) || empty($photo_base64)) {
            echo json_encode(['status' => 'error', 'message' => 'Nama dan Foto wajib diisi!']);
            return;
        }

        // 3. Proses Upload Gambar (Menggunakan helper yang sudah dibuat sebelumnya)
        $photo_filename = $this->_upload_base64($photo_base64, 'uploads/guest_photos/');
        $sign_filename  = $this->_upload_base64($signature_base64, 'uploads/guest_signatures/');

        // 4. Siapkan Data untuk Database
        // PERHATIKAN: Kita map 'user_id' dari form menjadi 'school_staff_id' sesuai kolom DB di Model
        $data = [
            'name'           => $name,
            'phone'          => $phone,
            'institution'    => $institution,
            'purpose'        => $purpose,
            'school_staff_id'=> $user_id, // Mapping yang benar
            'photo'          => $photo_filename,
            'signature'      => $sign_filename,
            'status'         => 'pending', // Default status (sesuai logika model get_pending_guests)
            'created_at'     => date('Y-m-d H:i:s')
        ];

        // 5. Simpan ke Database
        // PERHATIKAN: Kita panggil method 'add_guest' yang ada di Model Anda
        $insert = $this->Guest_model->add_guest($data);

        // 6. Respon ke AJAX
        if ($insert) {
            echo json_encode(['status' => 'success']);
        } else {
            // Error message sudah di-log oleh model, kita kirim respon umum ke user
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data. Cek log server untuk detail.']);
        }
    }
        
    // --- Fungsi Bantuan (Private) untuk Upload Base64 ---
    private function _upload_base64($base64_string, $upload_path) {
        if (empty($base64_string)) return null;

        // Buat folder jika belum ada
        if (!is_dir(FCPATH . $upload_path)) {
            mkdir(FCPATH . $upload_path, 0755, true);
        }

        // Ambil ekstensi gambar dari string base64 (contoh: png, jpeg)
        if (preg_match('/data:image\/(\w+);base64,/', $base64_string, $type)) {
            $ext = $type[1];
        } else {
            $ext = 'png'; // Default jika tidak terdeteksi
        }

        // Decode string base64
        $base64_string = substr($base64_string, strpos($base64_string, ',') + 1);
        $image = base64_decode($base64_string);

        // Buat nama file unik
        $filename = uniqid() . '_' . time() . '.' . $ext;
        $filepath = FCPATH . $upload_path . $filename;

        // Simpan file
        file_put_contents($filepath, $image);

        return $filename; // Kembalikan nama file saja untuk disimpan di DB
    }

    // --- Method-method lainnya (AJAX) ---
    public function getJurusan() {
        echo json_encode($this->School_staff_model->get_all_jurusan());
    }

    public function getKelasByJurusan($jurusan_id) {
        echo json_encode($this->School_staff_model->get_kelas_by_jurusan($jurusan_id));
    }

    public function getUsersByJabatan($jabatan_id) {
        echo json_encode($this->School_staff_model->get_staff_by_jabatan($jabatan_id));
    }

    public function getWaliKelas($kelas_id) {
        echo json_encode($this->School_staff_model->get_wali_kelas($kelas_id));
    }

    public function getUserRoom($staff_id) {
        echo json_encode($this->School_staff_model->get_staff_with_room($staff_id));
    }

    public function getJabatanByKategori($kategori_id) {
        $jabatan = $this->School_staff_model->get_jabatan_by_kategori($kategori_id);
        echo json_encode($jabatan);
    }
}