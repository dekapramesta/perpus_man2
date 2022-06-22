<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InventoryPdf extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
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
        $data['getAllPdf'] = $this->db->get('t_ebook')->result_array();
        $data['category_pdf'] = $this->db->get('t_kategori')->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/pdf', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function save_pdf()
    {

        $config['upload_path'] = './assets/pdf';
        $config['allowed_types'] = 'pdf';

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file_pdf')) {
            $file_ebook = $this->upload->data('file_name');
            $data = array(
                'judul_ebook' => $this->input->post('judul'),
                'penulis' => $this->input->post('penulis'),
                'halaman' => $this->input->post('halaman'),
                'deskripsi' => $this->input->post('deskripsi'),
                'kategori' =>  implode(',', $this->input->post('kategori_pdf', TRUE)),
                'file_ebook' => $file_ebook,
            );
            $this->Model_admin->Tambah_data($data, 't_ebook');
            redirect('Admin/InventoryPdf');
        } else {
            $linkinto = base_url() . 'Admin/InventoryPdf';
            echo "<script>
				alert('Pdf Gagal Upload');
				window.location.href = '" . $linkinto . "';// your redirect path here
				</script>";
        }
    }
    public function DetailPdf($id)
    {
        $data['ebook'] = $this->db->get_where('t_ebook', array('id_ebook' => $id))->row();
        $data['category_pdf'] = $this->db->get('t_kategori')->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/detailpdf', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function EditPdf($idpdf)
    {
        $config['upload_path'] = './assets/pdf';
        $config['allowed_types'] = 'pdf';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_pdf')) {
            $data_update = array(
                'judul_ebook' => $this->input->post('judul'),
                'penulis' => $this->input->post('penulis'),
                'halaman' => $this->input->post('halaman'),
                'deskripsi' => $this->input->post('deskripsi'),
                'kategori' =>  implode(',', $this->input->post('kategori', TRUE)),
            );
        } else {
            $file_ebook = $this->upload->data('file_name');
            $data_update = array(
                'judul_ebook' => $this->input->post('judul'),
                'penulis' => $this->input->post('penulis'),
                'halaman' => $this->input->post('halaman'),
                'deskripsi' => $this->input->post('deskripsi'),
                'kategori' =>  implode(',', $this->input->post('kategori', TRUE)),
                'file_ebook' => $file_ebook,

            );
        }


        $whereid = array(
            'id_ebook' => $idpdf
        );


        $this->Model_admin->edit_data($whereid, $data_update, 't_ebook');
        redirect('Admin/InventoryPdf/DetailPdf/' . $idpdf);
    }
    public function deletePdf()
    {
        # code...
        $delete = $this->db->delete('t_ebook', array('id_ebook' => $this->input->post('id_ebook')));
        if ($delete) {
            $pesan = array('status' => 1, 'token' => $this->security->get_csrf_hash());

            echo json_encode($pesan);
        } else {
            $pesan = array('status' => 0, 'token' => $this->security->get_csrf_hash());

            echo json_encode($pesan);
        }
    }
}
