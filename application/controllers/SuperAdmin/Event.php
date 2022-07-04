<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('role_id') != 70) {
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
    // public function index()
    // {
    //     $data['siswa'] = $this->db->get('t_siswa')->result_array();
    //     $data['status'] = $this->db->get_where('t_setup', array('nama_fitur' => 'coin'))->row();
    //     $this->load->view('Admin/templates/header');
    //     $this->load->view('Admin/templates/sidebar_su');
    //     $this->load->view('Admin/event', $data);
    //     $this->load->view('Admin/templates/footer');
    // }
    public function index()
    {
        # code...
        $data['status'] = $this->db->get_where('t_setup', array('nama_fitur' => 'coin'))->row();
        $data['barang'] = $this->Model_admin->get_data_all('t_hadiah')->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar_su');
        $this->load->view('Admin/hadiah', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function getBarang($id)
    {
        # code...
        $data['hadiah'] = $this->db->get_where('t_hadiah', array('id_hadiah' => $id))->row();
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function UbahBarang()
    {
        # code...
        $data_update = array(
            'nama_item' => $this->input->post('nama_item'),
            'jenis_item' => $this->input->post('jenis_item'),
            'coin_hadiah' => $this->input->post('coin_hadiah'),
            'jumlah' => $this->input->post('jumlah')



        );
        $where = array(
            'id_hadiah' => $this->input->post('id_hadiah')
        );
        $this->Model_admin->edit_data($where, $data_update, 't_hadiah');
        redirect('SuperAdmin/Event/Hadiah');
    }
    public function TambahBarang()
    {
        # code...
        $data_array = array(
            'nama_item' => $this->input->post('nama_item'),
            'jenis_item' => $this->input->post('jenis_item'),
            'coin_hadiah' => $this->input->post('coin_hadiah'),
            'jumlah' => $this->input->post('jumlah')
        );
        $this->Model_admin->Tambah_data($data_array, 't_hadiah');
        redirect('SuperAdmin/Event/Hadiah');
    }
    public function ChangeStatus()
    {
        # code...
        $sts = $this->db->get_where('t_setup', array('nama_fitur' => 'coin'))->row();
        if ($sts->status_fitur == 1) {
            $data_update = array(
                'status_fitur' => 0
            );
            $where = array(
                'nama_fitur' => 'coin'
            );
            $this->Model_admin->edit_data($where, $data_update, 't_setup');
            $data_coin = array(
                'coin' => 0
            );
            $this->db->update('t_siswa', $data_coin);
            $this->db->truncate('t_penukaran');
            redirect('SuperAdmin/Event');
        } else {
            $data_update = array(
                'status_fitur' => 1
            );
            $where = array(
                'nama_fitur' => 'coin'
            );
            $this->Model_admin->edit_data($where, $data_update, 't_setup');
            $data_coin = array(
                'coin' => 0
            );
            $this->db->update('t_siswa', $data_coin);
            $this->db->truncate('t_penukaran');
            redirect('SuperAdmin/Event');
        }
    }
    public function DeleteHadiah()
    {
        # code...
        $delete = $this->db->delete('t_hadiah', array('id_hadiah' => $this->input->post('id')));
        if ($delete) {
            $pesan = array('status' => 1, 'token' => $this->security->get_csrf_hash());

            echo json_encode($pesan);
        } else {
            $pesan = array('status' => 0, 'token' => $this->security->get_csrf_hash());

            echo json_encode($pesan);
        }
    }
}
