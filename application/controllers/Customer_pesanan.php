<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_pesanan extends CI_Controller {

	public function index() {

		$this->load->view('Index/header');
		$this->load->view('Customer/index');
		$this->load->view('Index/footer');

	}


}
