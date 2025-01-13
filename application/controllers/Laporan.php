    <?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Laporan extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model('Laporan_model'); // Pastikan model ini dibuat
        }

        // Tampilkan laporan pesanan
        public function index() {
            $data['laporan'] = $this->Laporan_model->get_all_laporan();
            $this->load->view('Index/header');
            $this->load->view('Dashboard/Laporan/index', $data);
            $this->load->view('Index/footer');
        }

        // Detail laporan berdasarkan ID
        public function detail($id_pesanan) {
            $data['detail'] = $this->Laporan_model->get_laporan_by_id($id_pesanan);
            $this->load->view('Index/header');
            $this->load->view('Dashboard/Laporan/detail', $data);
            $this->load->view('Index/footer');
        }

        // Hapus laporan
        public function delete($id_pesanan) {
            if ($this->Laporan_model->delete_laporan($id_pesanan)) {
                $this->session->set_flashdata('message', 'Laporan berhasil dihapus.');
            } else {
                $this->session->set_flashdata('message', 'Gagal menghapus laporan.');
            }
            redirect('Laporan');
        }
    }
