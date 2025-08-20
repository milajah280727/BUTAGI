<?php
class M_chatbot extends CI_Model {
    public function getResponse($keyword) {
        $this->db->select('keyword, response, image');
        $faq = $this->db->get('chatbot_faq')->result();

        foreach ($faq as $row) {
            if (stripos($keyword, $row->keyword) !== false) {
                return [
                    'response' => $row->response,
                    'image' => $row->image ? base_url($row->image) : null
                ];
            }
        }

        return [
            'response' => 'Maaf, saya belum mengerti pertanyaan Anda.',
            'image' => null
        ];
    }
}
?>
