<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LogPerpus extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('role_id') != 77) {
            redirect('');
        }
        // KirimWA();
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @seehttps://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/log_perpus');
        $this->load->view('Admin/templates/footer');
    }
    public function DataLog()
    {
        # code...
        $data['log_perpus'] = $this->Model_admin->LogPerpus()->result_array();

        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/data_log', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function PostData()
    {
        # code...
        $code = $this->input->post('code');
        $data = $this->Model_admin->GetSiswaByNisn($code)->row();
        if ($data != null) {
            $data_post = array(
                'id_user' => $data->id_user,
                'jam' => date('Y-m-d H:i:s')
            );
            $this->Model_admin->Tambah_data($data_post, 't_log');
            $pesan = array(
                'status' => 1,
                'message' => 'Siswa dengan ID ' . $data->nisn . ' Berhasil Masuk',
                'token' => $this->security->get_csrf_hash()

            );
            echo json_encode($pesan);
        } else {
            $pesan = array(
                'status' => 0,
                'message' => 'Siswa dengan ID ' . $code . ' Tersebut Tidak Ada',
                'token' => $this->security->get_csrf_hash()

            );
            echo json_encode($pesan);
        }
    }
}
