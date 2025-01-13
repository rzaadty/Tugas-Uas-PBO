<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dapur extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Dapur_model');
    }

    public function index() {
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Dapur/index');
        $this->load->view('Index/footer');
    }
    public function status_baru() {
        $data['orders'] = $this->Dapur_model->get_orders();
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Dapur/status_baru',$data);
        $this->load->view('Index/footer');
    }
    public function status_diproses() {
        $data['orders'] = $this->Dapur_model->get_orders();
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Dapur/status_diproses',$data);
        $this->load->view('Index/footer');
    }
    public function status_selesai() {
        $data['orders'] = $this->Dapur_model->get_orders();
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Dapur/status_selesai', $data);
        $this->load->view('Index/footer');
    }

    public function view_order($id_pesanan) {
        $data['order_details'] = $this->Dapur_model->get_order_details($id_pesanan);
        $data['order_id'] = $id_pesanan;
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Dapur/detail_order', $data);
        $this->load->view('Index/footer');
    }

    public function update_status($id_pesanan, $status) {
        $this->Dapur_model->update_order_status($id_pesanan, $status);
        redirect('Dapur');
    }

    
}



