<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
        $data['getAllBook'] = $this->Model_user->BookHome()->result_array();
        $data['total_buku'] = $this->Model_user->get_data_home('t_buku')->num_rows();
        $data['total_ebook'] = $this->db->get('t_ebook')->num_rows();
        $data['kategori'] = $this->db->get('t_kategori')->result_array();
        $this->load->view('templates/header');
        $this->load->view('user/home', $data);
        $this->load->view('templates/footer');
    }
    public function Logout()
    {
        $this->session->sess_destroy();
        redirect('');
    }
}
