<?php
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class Eventcontroller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(['Event_model', 'Event_guest_model']);
        require_once 'C:/laragon/www/butagi-mainn/vendor/autoload.php'; // Arahkan ke root vendor // Pastikan path ini ada
    }

    public function form($kode_event) {
        $event = $this->Event_model->get_event_by_kode($kode_event);
        if (!$event) show_404();
        $data['event'] = $event;
        $this->load->view('event/event_form', $data);
    }

    public function submit_form() {
        $kode_event = $this->input->post('kode_event');
        $event = $this->Event_model->get_event_by_kode($kode_event);
        $guest_data = [
            'event_id' => $event->id,
            'nama' => $this->input->post('nama'),
            'no_hp' => $this->input->post('no_hp'),
            'hubungan' => $this->input->post('hubungan')
        ];
        $guest_id = $this->Event_guest_model->save_guest($guest_data);

        $qr_content = base_url('event/scan/' . $guest_id); // Perbaiki URL scan
        $qr = new QrCode($qr_content);
        $qr->setSize(300);
        $writer = new PngWriter();
        $qr_path = 'assets/qr/' . $guest_id . '.png';
        if (!file_exists(FCPATH . 'assets/qr')) mkdir(FCPATH . 'assets/qr', 0777, true);
        $writer->write($qr)->saveToFile(FCPATH . $qr_path);

        $this->db->update('event_guests', ['qr_code' => $qr_path], ['id' => $guest_id]);
        $data['qr_url'] = base_url($qr_path);
        $this->load->view('event/show_qr', $data);
    }

   public function scan() {
    // Enable error reporting untuk debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    // Log semua request
    error_log('=== SCAN REQUEST ===');
    error_log('GET params: ' . print_r($_GET, true));
    error_log('POST params: ' . print_r($_POST, true));
    
    $qr_content = $this->input->get('qr');
    error_log('QR Content received: ' . $qr_content);
    
    if (empty($qr_content)) {
        $response = ['error' => 'QR code tidak valid atau kosong'];
        error_log('Response: ' . json_encode($response));
        echo json_encode($response);
        return;
    }
    
    // Extract guest_id
    if (strpos($qr_content, 'eventcontroller/scan/') !== false) {
        $parts = explode('/', $qr_content);
        $guest_id = end($parts);
        error_log('Guest ID from URL: ' . $guest_id);
    } else {
        $guest_id = $qr_content;
        error_log('Guest ID direct: ' . $guest_id);
    }
    
    if (!is_numeric($guest_id)) {
        $response = ['error' => 'Format QR code tidak valid: ' . $guest_id];
        error_log('Response: ' . json_encode($response));
        echo json_encode($response);
        return;
    }
    
    // Cari guest
    $guest = $this->Event_guest_model->get_guest_by_id($guest_id);
    error_log('Guest found: ' . ($guest ? 'Yes' : 'No'));
    
    if ($guest) {
        error_log('Guest data: ' . print_r($guest, true));
        
        // Update attended
        $this->Event_guest_model->update_attended($guest_id);
        
        $response = [
            'success' => true,
            'nama' => $guest->nama,
            'guest_id' => $guest_id
        ];
        
        error_log('Success response: ' . json_encode($response));
        echo json_encode($response);
    } else {
        $response = ['error' => 'Tamu tidak ditemukan dengan ID: ' . $guest_id];
        error_log('Response: ' . json_encode($response));
        echo json_encode($response);
    }
}
}