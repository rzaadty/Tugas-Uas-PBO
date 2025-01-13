<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Dapur_model');
    }

    public function index() {
        $data['orders'] = $this->Dapur_model->get_orders();
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Booking/index', $data);
        $this->load->view('Index/footer');
    }
    public function status_baru() {
        $data['orders'] = $this->Dapur_model->get_orders();
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Booking/status_baru', $data);
        $this->load->view('Index/footer');
    }
    public function status_diproses() {
        $data['orders'] = $this->Dapur_model->get_orders();
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Booking/status_diproses', $data);
        $this->load->view('Index/footer');
    }
    public function status_selesai() {
        $data['orders'] = $this->Dapur_model->get_orders();
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Booking/status_selesai', $data);
        $this->load->view('Index/footer');
    }

    public function view_order($id_pesanan) {
        $data['order_details'] = $this->Dapur_model->get_order_details($id_pesanan);
        $data['order_id'] = $id_pesanan;
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Booking/detail_order', $data);
        $this->load->view('Index/footer');
    }

    public function update_status($id_pesanan, $status) {
        $this->Dapur_model->update_order_status($id_pesanan, $status);
        redirect('Booking');
    }
    public function update_status_selesai($id_pesanan, $status) {
        $this->Dapur_model->update_order_selesai_meja($id_pesanan, $status);
        redirect('Booking');
    }


    
}



