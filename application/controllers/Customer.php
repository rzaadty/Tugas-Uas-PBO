<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function index() {

		$this->load->view('Index/header_customer');
		$this->load->view('Customer/index');
		$this->load->view('Index/footer_customer');

	}


}
