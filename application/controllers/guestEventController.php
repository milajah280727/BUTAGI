<?php
class guestEventController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Event_guest_model');
    }

    public function index() {
        $data['events'] = $this->Event_guest_model->get_unique_events();
        $data['guests_by_event'] = [];
        foreach ($data['events'] as $event) {
            $data['guests_by_event'][$event->event_id] = $this->Event_guest_model->get_guests_by_event($event->event_id);
        }
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('superadmin/manage_guest_event', $data);
        $this->load->view('template_admin/footer');
    }
}
?>