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
        $this->load->library('pagination');

        $config['base_url'] = base_url('Buku');
        $config['total_rows'] = $this->Model_user->get_data_home('t_buku')->num_rows();
        $config['per_page'] = 6;
        $config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');


        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(2);
        $data['getAllBook'] = $this->Model_user->buku_pag($config['per_page'], $data['start'])->result_array();
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
    public function SearchBuku()
    {
        $buku = $this->input->post('buku');
        $data['getAllBook'] = $this->Model_user->SearchBuku($buku)->result_array();
        $data['kategori'] = $this->db->get('t_kategori')->result_array();
        $this->load->view('templates/header');
        $this->load->view('user/buku', $data);
        $this->load->view('templates/footer');
    }
    public function ByKategori($kategori)
    {
        $data['getAllBook'] = $this->Model_user->SearchKategori($kategori)->result_array();
        $data['kategori'] = $this->db->get('t_kategori')->result_array();
        $this->load->view('templates/header');
        $this->load->view('user/buku', $data);
        $this->load->view('templates/footer');
    }
}
