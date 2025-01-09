<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_booking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Customer_booking_model');
        $this->load->library('cart');
        $this->load->library('upload');
    }

    // Menampilkan halaman utama pemesanan
    public function index() {
        $data['meja_items'] = $this->Customer_booking_model->get_all_meja(); // Mengambil data meja
        $data['menu_items'] = $this->Customer_booking_model->get_all_menu(); // Mengambil data menu
        $this->load->view('Index/header');
        $this->load->view('Customer/Booking/index', $data);
        $this->load->view('Index/footer');
    }

    // Menambahkan item ke dalam cart
    public function tambah_ke_cart() {
        $data = array(
            'id' => $this->input->post('id_barang'), // ID barang
            'name' => $this->input->post('nama_barang'), // Nama barang
            'price' => $this->input->post('harga'), // Harga barang
            'qty' => $this->input->post('jumlah') // Jumlah barang
        );
        $this->cart->insert($data); // Menambahkan item ke dalam cart
        redirect('Customer_booking/lihat_cart'); // Redirect ke halaman lihat cart
    }

    // Menampilkan isi cart
    public function lihat_cart() {
        $data['cart_items'] = $this->cart->contents(); // Mengambil data isi cart
        $data['total_harga'] = $this->cart->total(); // Menghitung total harga
        $this->load->view('Index/header_customer');
        $this->load->view('Customer/Booking/lihat_cart', $data);
        $this->load->view('Index/footer_customer');
    }

    // Menghapus item dari cart
    public function hapus_item_cart($rowid) {
        $data = array('rowid' => $rowid, 'qty' => 0); // Menentukan item yang akan dihapus
        $this->cart->update($data); // Menghapus item dari cart
        redirect('Customer_booking/lihat_cart'); // Redirect ke halaman lihat cart
    }

    // Menampilkan halaman checkout
    public function checkout() {
        $data['cart_items'] = $this->cart->contents(); // Mengambil data isi cart
        $data['total_harga'] = $this->cart->total(); // Menghitung total harga
        $data['meja_items'] = $this->Customer_booking_model->get_all_meja(); // Mengambil data meja
        $this->load->view('Index/header_customer');
        $this->load->view('Customer/Booking/checkout', $data);
        $this->load->view('Index/footer_customer');
    }

    // Memproses pembuatan pesanan
    public function buat_pesanan() {
        if ($this->input->post()) {
            // Validasi form
            $this->form_validation->set_rules('id_meja', 'Nomor Meja', 'required');
            $this->form_validation->set_rules('uang_bayar', 'Uang Dibayarkan', 'required|numeric');
            $this->form_validation->set_rules('bukti_pembayaran', 'Bukti Pembayaran', 'callback_file_check');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('customer_booking_view'); // Menampilkan halaman form jika validasi gagal
            } else {
                $uang_bayar = $this->input->post('uang_bayar');
                $total_harga = $this->cart->total();
                $kembalian = $uang_bayar - $total_harga;

                // Menyiapkan data pesanan
                $data = array(
                    'id_pemesan_online' => $this->session->userdata('id'),
                    'id_meja' => $this->input->post('id_meja'),
                    'nama' => $this->input->post('nama'),
                    'jenis_order' => $this->input->post('jenis_order'),
                    'metode_pembayaran' => $this->input->post('metode_pembayaran'),
                    'total_harga' => $this->cart->total(),
                    'uang_bayar' => $this->input->post('uang_bayar'),
                    'kembalian' => $kembalian,
                    'tanggal' => date('Y-m-d H:i:s'),
                    'status_pesanan' => 'Menunggu',
                );

                // Upload bukti pembayaran jika ada
                if ($_FILES['bukti_pembayaran']['name']) {
                    $config['upload_path'] = FCPATH . 'path/gambar_bukti_transfer/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
                    $config['max_size'] = 2048;
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('bukti_pembayaran')) {
                        $data['bukti_pembayaran'] = $this->upload->data('file_name');
                    } else {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('Customer_booking/buat_pesanan');
                    }
                }

                // Menyimpan data pesanan ke database
                $insert = $this->Customer_booking_model->tambah_pesanan($data);

                if ($insert) {
                    // Menyimpan detail pesanan dan mengurangi stok barang
                    foreach ($this->cart->contents() as $item) {
                        $data_detail = array(
                            'id_pesanan' => $insert,
                            'id_barang' => $item['id'],
                            'jumlah' => $item['qty'],
                            'harga_jual' => $item['price']
                        );
                        $this->Customer_booking_model->tambah_detail_pesanan($data_detail);
                        $this->Customer_booking_model->kurangi_stok($item['id'], $item['qty']);
                    }

                    $this->cart->destroy(); // Menghapus cart setelah pemesanan

                    $this->session->set_flashdata('success', 'Pesanan berhasil diproses!');
                    redirect('Customer_booking/konfirmasi_pesanan/' . $insert); // Redirect ke halaman konfirmasi
                } else {
                    $this->session->set_flashdata('error', 'Gagal memproses pesanan, coba lagi.');
                    redirect('Customer_booking/buat_pesanan');
                }
            }
        } else {
            $this->load->view('customer_booking_view');
        }
    }

    // Validasi file bukti pembayaran
    public function file_check($str) {
        if ($_FILES['bukti_pembayaran']['size'] == 0) {
            $this->form_validation->set_message('file_check', 'The {field} field is required.');
            return FALSE;
        }
        return TRUE;
    }

    // Menampilkan halaman konfirmasi pesanan
    public function konfirmasi_pesanan($id_pesanan) {
        $data['pesanan'] = $this->Customer_booking_model->get_pesanan_by_id($id_pesanan); // Mengambil data pesanan berdasarkan ID
        $data['detail_pesanan'] = $this->Customer_booking_model->get_detail_pesanan($id_pesanan); // Mengambil detail pesanan
        $this->load->view('Index/header_customer');
        $this->load->view('Customer/Booking/konfirmasi_pesanan', $data);
        $this->load->view('Index/footer_customer');
    }
}
