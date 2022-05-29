<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataUser extends CI_Controller
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
    public function index()
    {
        $data['siswa'] = $this->Model_admin->GetAllSiswa()->result_array();
        $data['angkatan'] = $this->Model_admin->GetAngkatan()->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar_su');
        $this->load->view('Admin/DataSiswa', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function UbahStatus()
    {
        # code...
        $angkatan = $this->input->post('angkatan');
        $data = $this->db->get_where('t_siswa', array('angkatan' => $angkatan))->result_array();
        // var_dump($data);
        foreach ($data as $dt) {
            $data_update = array(
                'status_block' => 1,
            );
            $whereid = array(
                'id_user' => $dt['id_user']
            );
            $this->Model_admin->edit_data($whereid, $data_update, 't_user');
        }

        // $this->Model_admin->edit_data($whereid, $data_update, 't_registerguru');
        redirect('SuperAdmin/DataUser');
    }
    public function UbahStatusById($id)
    {
        # code...
        $data = $this->db->get_where('t_user', array('id_user' => $id))->row();
        if ($data->status_block == 0) {
            $sts = 1;
        } else {
            $sts = 0;
        }
        $data_update = array(
            'status_block' => $sts,
        );
        $whereid = array(
            'id_user' => $id
        );
        $this->Model_admin->edit_data($whereid, $data_update, 't_user');


        // $this->Model_admin->edit_data($whereid, $data_update, 't_registerguru');
        redirect('SuperAdmin/DataUser');
    }
    public function getSiswa($id)
    {
        # code...
        $data['profile'] = $this->db->get_where('t_siswa', array('id_siswa' => $id))->row();
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function UpdateSiswa()
    {
        # code...
        $data_update = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'no_hp' => $this->input->post('no_hp'),
            'angkatan' => $this->input->post('angkatan'),
            'nisn' => $this->input->post('nisn'),
        );
        $whereid = array(
            'id_siswa' => $this->input->post('id_siswa')
        );
        $this->Model_admin->edit_data($whereid, $data_update, 't_siswa');
        redirect('SuperAdmin/DataUser');
    }
}
