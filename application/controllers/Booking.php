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

    public function view_order($id_pesanan) {
        $data['order_details'] = $this->Dapur_model->get_order_details($id_pesanan);
        $data['order_id'] = $id_pesanan;
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Booking/detail_order', $data);
        $this->load->view('Index/footer');
    }

    public function update_status($id_pesanan, $status) {
        $this->Dapur_model->update_order_status($id_pesanan, $status);
        redirect('Dapur');
    }

    public function filter_orders() {
        $status_filter = $this->input->get('status_filter');  // Get the selected status filter from the dropdown
    
        // If status_filter is empty, get all orders
        if ($status_filter) {
            // Get orders based on selected status
            $orders = $this->Dapur_model->get_orders_by_status($status_filter);
        } else {
            // Get all orders if no filter is selected
            $orders = $this->Dapur_model->get_all_orders();
        }
    
        // Pass the filtered orders to the view
        $data['orders'] = $orders;
    
        // Load the view
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Booking/order_list', $data);
        $this->load->view('Index/footer');
    }
    
}



