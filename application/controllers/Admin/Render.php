<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Render extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->library('Ciqrcode');
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('role_id') != 77) {
            redirect('');
        }
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
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/home');
        $this->load->view('Admin/templates/footer');
    }

    public function Barcode($code)
    {
        $this->load->library('zend');
        // Load in folder Zend
        $this->zend->load('Zend/Barcode');
        // Generate barcode
        Zend_Barcode::render('code128', 'image', array('text' => $code), array());
    }
}
