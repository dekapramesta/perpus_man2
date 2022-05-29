<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ebook extends CI_Controller
{

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
        $data['getAllPdf'] = $this->db->get('t_ebook')->result_array();
        $data['kategori'] = $this->db->get('t_kategori')->result_array();
        $this->load->view('templates/header');
        $this->load->view('user/ebook', $data);
        $this->load->view('templates/footer');
    }
    public function DetailEbook($id)
    {
        $data['ebook'] = $this->db->get_where('t_ebook', array('id_ebook' => $id))->row();
        $this->load->view('templates/header');
        $this->load->view('user/detail_ebook', $data);
        $this->load->view('templates/footer');
    }
    public function ByKategori($kategori)
    {
        $data['getAllPdf'] = $this->Model_user->SearchKategoriEbook($kategori)->result_array();
        $data['kategori'] = $this->db->get('t_kategori')->result_array();
        $this->load->view('templates/header');
        $this->load->view('user/ebook', $data);
        $this->load->view('templates/footer');
    }
}
