<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
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
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $data['getAllBook'] = $this->Model_user->get_data_home('t_buku')->result_array();
        $data['kategori'] = $this->db->get('t_kategori')->result_array();
        $this->load->view('templates/header');
        $this->load->view('user/buku', $data);
        $this->load->view('templates/footer');
    }
    public function DetailBuku($id)
    {
        $data['buku'] = $this->Model_user->get_data_detail($id)->row();
        $data['isbn'] = $this->db->get_where('t_buku', array('kode_buku' => $id))->result_array();
        $this->load->view('templates/header');
        $this->load->view('user/detail_buku', $data);
        $this->load->view('templates/footer');
    }
    public function BookingBuku()
    {
        $idbuku = $this->input->post("id_buku");
        $isbn =  $this->db->get_where('t_buku', array('id_buku' => $idbuku))->row()->kode_buku;
        $data = array(

            'id_user' => $this->session->userdata('id_user'),
            'id_buku' => $idbuku,
            'tgl_pemesanan' => date('Y-m-d H:i:s'),
            'status_pesan' => 0,

        );
        $this->Model_user->Tambah_data($data, 't_booking');
        $data_update = array(
            'status_buku' => 7,
        );
        $whereid = array(
            'id_buku' => $idbuku
        );
        $this->Model_user->edit_data($whereid, $data_update, 't_buku');
        redirect('Buku/DetailBuku/' . $isbn);
    }
}
