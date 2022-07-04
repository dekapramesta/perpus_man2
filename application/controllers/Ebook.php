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
        // $data['getAllPdf'] = $this->db->get('t_ebook')->result_array();
        $data['kategori'] = $this->db->get('t_kategori')->result_array();

        $this->load->library('pagination');

        $config['base_url'] = base_url('Ebook');
        $config['total_rows'] = $this->Model_user->get_data_ebook('t_ebook')->num_rows();
        $config['per_page'] = 2;
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
        $data['getAllPdf'] = $this->Model_user->ebook_pag($config['per_page'], $data['start'])->result_array();
        // $data['kategori'] = $this->db->get('t_kategori')->result_array();
        $this->load->view('templates/header');
        $this->load->view('user/ebook', $data);
        $this->load->view('templates/footer');
    }
    public function DetailEbook($id)
    {
        $data['ebook'] = $this->db->get_where('t_ebook', array('id_ebook' => $id))->row();
        $data['kategori'] = $this->db->get('t_kategori')->result_array();
        $this->load->view('templates/header');
        $this->load->view('user/detail_ebook', $data);
        $this->load->view('templates/footer');
    }
    public function ByKategori($id)
    {
        $kategori = str_replace('-', ' ', $id);

        $data['getAllPdf'] = $this->Model_user->SearchKategoriEbook($kategori)->result_array();
        $this->load->library('pagination');

        $config['base_url'] = base_url('Ebook');
        $config['total_rows'] = $this->Model_user->SearchKategoriEbook($kategori)->num_rows();
        $config['per_page'] = 2;
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
        $data['getAllPdf'] = $this->Model_user->SearchKategoriEbookNow($kategori, $config['per_page'], $data['start'])->result_array();
        $data['kategori'] = $this->db->get('t_kategori')->result_array();
        $this->load->view('templates/header');
        $this->load->view('user/ebook', $data);
        $this->load->view('templates/footer');
    }
    public function SearchEbook($ebook)
    {
        # code...
        $data['getAllPdf'] = $this->Model_user->SearchEbook($ebook)->result_array();
        $data['kategori'] = $this->db->get('t_kategori')->result_array();
        $this->load->view('templates/header');
        $this->load->view('user/ebook', $data);
        $this->load->view('templates/footer');
    }
    // public function TesApi()
    // {
    //     # code...


    //     // $curl = curl_init();

    //     // curl_setopt_array($curl, [
    //     //     CURLOPT_URL => "https://bookmeth1.p.rapidapi.com/?q=Harry%20Potter&start=0&sort=datedesc",
    //     //     CURLOPT_RETURNTRANSFER => true,
    //     //     CURLOPT_FOLLOWLOCATION => true,
    //     //     CURLOPT_ENCODING => "",
    //     //     CURLOPT_MAXREDIRS => 10,
    //     //     CURLOPT_TIMEOUT => 30,
    //     //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     //     CURLOPT_CUSTOMREQUEST => "GET",
    //     //     CURLOPT_HTTPHEADER => [
    //     //         "X-RapidAPI-Host: bookmeth1.p.rapidapi.com",
    //     //         "X-RapidAPI-Key: 92d78be9d6mshe07f84d7337ce17p1320a3jsn31601609c0e1"
    //     //     ],
    //     // ]);

    //     // $response = curl_exec($curl);
    //     // $err = curl_error($curl);

    //     // curl_close($curl);
    //     // $data_array = json_decode($response);

    //     // // if ($err) {
    //     // //     echo "cURL Error #:" . $err;
    //     // // } else {
    //     // //     echo $response;
    //     // // }
    //     // $last = null;
    //     // foreach ($data_array as $rs) {
    //     //     $last = $rs;
    //     // }
    //     // $link = $last->_source->external_link;
    //     $data['ebook'] = 'https://the-eye.eu/public/Books/Calibre_Libraries/69.163.12.2/Harry%20Potter%20and%20the%20Sorcerer%27%20-%20J.K.%20Rowling_309.pdf';
    //     $this->load->view('templates/header');
    //     $this->load->view('user/tes_ebook', $data);
    //     $this->load->view('templates/footer');
    // }
}
