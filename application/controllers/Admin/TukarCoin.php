<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TukarCoin extends CI_Controller
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
        $this->load->view('Admin/events');
        $this->load->view('Admin/templates/footer');
    }
    public function TukarHadiah()
    {
        $id_penukaran = $this->input->post('kode_render');
        $data_penukaran = $this->db->get_where('t_penukaran', array('id_penukaran' => $id_penukaran))->row();

        if ($data_penukaran != null) {
            if ($data_penukaran->status_penukaran == 0) {
                $data_ubah = array(
                    'status_penukaran' => 1
                );
                $where = array(
                    'id_penukaran' => $id_penukaran
                );
                $this->Model_admin->edit_data($where, $data_ubah, 't_penukaran');
                $this->session->set_flashdata(
                    'notif',
                    '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
				<script type ="text/JavaScript">swal("Succes","Kode Berhasil Ditukarkan","success");</script>'
                );
                redirect('Admin/TukarCoin');
            } else {
                $this->session->set_flashdata(
                    'notif',
                    '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
				<script type ="text/JavaScript">swal("Gagal","Kode Sudah Ditukarkan Sebelumnya","error");</script>'
                );
                redirect('Admin/TukarCoin');
            }
        } else {
            $this->session->set_flashdata(
                'notif',
                '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
				<script type ="text/JavaScript">swal("Gagal","Kode Tidak Ditemukan","error");</script>'
            );
            redirect('Admin/TukarCoin');
        }
    }
    public function getData()
    {
        # code...
        $id_penukaran = $this->input->post('kode_render');
        $data_penukaran = $this->Model_admin->getPenukaranData($id_penukaran)->row();
        $data['token'] = $this->security->get_csrf_hash();
        $data['penukaran'] = $data_penukaran;
        echo json_encode($data);
        // echo json_encode('oi');
    }
}
