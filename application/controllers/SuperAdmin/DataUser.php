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
    public function DataGuru()
    {
        # code...
        $data['guru'] = $this->Model_admin->GetAllGuru()->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar_su');
        $this->load->view('Admin/DataGuru', $data);
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

        if ($data->role_id == 1) {
            redirect('SuperAdmin/DataUser');
        } elseif ($data->role_id == 2) {
            redirect('SuperAdmin/DataUser/DataGuru');
        } elseif ($data->role_id == 77) {
            redirect('SuperAdmin/DataUser/Admin');
        }

        // $this->Model_admin->edit_data($whereid, $data_update, 't_registerguru');
    }
    public function getSiswa($id)
    {
        # code...
        $data['profile'] = $this->Model_admin->GetSiswa($id)->row();
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function getAdmin($id)
    {
        # code...
        $data['profile'] = $this->Model_admin->GetAdmin($id)->row();
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function getGuru($id)
    {
        # code...
        $data['profile'] = $this->Model_admin->GetGuruId($id)->row();
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function UpdateSiswa()
    {

        $original =  $this->Model_admin->GetSiswa($this->input->post('id_siswa'))->row();
        if ($original->username != $this->input->post('username')) {
            $this->form_validation->set_rules('username', 'username', 'required|is_unique[t_user.username]');
            $this->form_validation->set_message('is_unique', '{field} sudah digunakan!');
            if (!$this->form_validation->run()) {
                $message = substr(strip_tags(validation_errors()), 0, -1);
                $this->session->set_flashdata(
                    'siswaDU',
                    '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Gagal","' . $message . '","error");</script>'
                );
                redirect('SuperAdmin/DataUser');
            }
        }
        # code...
        $datauser = array(
            'username' => $this->input->post('username')
        );
        $whereuser = array(
            'id_user' => $original->id_user
        );
        $this->Model_user->edit_data($whereuser, $datauser, 't_user');
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
        $this->session->set_flashdata(
            'siswaDU',
            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Berhasil Dirubah ","success");</script>'
        );
        redirect('SuperAdmin/DataUser');
    }
    public function UpdateGuru()
    {
        # code...
        $original = $this->Model_admin->GetGuruId($this->input->post('id_guru'))->row();;
        if ($original->username != $this->input->post('username')) {
            $this->form_validation->set_rules('username', 'username', 'required|is_unique[t_user.username]');
            $this->form_validation->set_message('is_unique', '{field} sudah digunakan!');
            if (!$this->form_validation->run()) {
                $message = substr(strip_tags(validation_errors()), 0, -1);
                $this->session->set_flashdata(
                    'guruDU',
                    '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Gagal","' . $message . '","error");</script>'
                );
                redirect('SuperAdmin/DataUser/DataGuru');
            }
        }
        $datauser = array(
            'username' => $this->input->post('username')
        );
        $whereuser = array(
            'id_user' => $original->id_user
        );
        $this->Model_user->edit_data($whereuser, $datauser, 't_user');
        $data_update = array(
            'nama_guru' => $this->input->post('nama_guru'),
            'email' => $this->input->post('email'),
            'no_hp' => $this->input->post('no_hp'),

        );
        $whereid = array(
            'id_guru' => $this->input->post('id_guru')
        );
        $this->Model_admin->edit_data($whereid, $data_update, 't_guru');
        $this->session->set_flashdata(
            'guruDU',
            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Berhasil Dirubah ","success");</script>'
        );
        redirect('SuperAdmin/DataUser/DataGuru');
    }
    public function UpdateAdmin()
    {
        # code...
        $original =  $this->Model_admin->GetAdmin($this->input->post('id_admin'))->row();
        if ($original->username != $this->input->post('username')) {
            $this->form_validation->set_rules('username', 'username', 'required|is_unique[t_user.username]');
            $this->form_validation->set_message('is_unique', '{field} sudah digunakan!');
            if (!$this->form_validation->run()) {
                $message = substr(strip_tags(validation_errors()), 0, -1);
                $this->session->set_flashdata(
                    'adminDU',
                    '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Gagal","' . $message . '","error");</script>'
                );
                redirect('SuperAdmin/DataUser/Admin');
            }
        }
        $datauser = array(
            'username' => $this->input->post('username')
        );
        $whereuser = array(
            'id_user' => $original->id_user
        );
        $this->Model_user->edit_data($whereuser, $datauser, 't_user');
        $data_update = array(
            'nama_admin' => $this->input->post('nama_admin'),



        );
        $whereid = array(
            'id_admin' => $this->input->post('id_admin')
        );
        $this->Model_admin->edit_data($whereid, $data_update, 't_admin');
        $this->session->set_flashdata(
            'adminDU',
            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Berhasil Dirubah ","success");</script>'
        );
        redirect('SuperAdmin/DataUser/Admin');
    }

    function UbahPassword()
    {
        # code...
        $data = $this->db->get_where('t_user', array('id_user' => $this->input->post('id_user')))->row();

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

        $this->form_validation->set_message('min_length', '{field} Minimal Harus {param} Karakter .');
        if (!$this->form_validation->run()) {
            $message = substr(strip_tags(validation_errors()), 0, -1);
            if ($data->role_id == 1) {
                $this->session->set_flashdata(
                    'siswaDU',
                    '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Gagal","' . $message . '","error");</script>'
                );
                redirect('SuperAdmin/DataUser');
            } elseif ($data->role_id == 2) {
                $this->session->set_flashdata(
                    'guruDU',
                    '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Gagal","' . $message . '","error");</script>'
                );
                redirect('SuperAdmin/DataUser/DataGuru');
            } elseif ($data->role_id == 77) {
                $this->session->set_flashdata(
                    'adminDU',
                    '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Gagal","' . $message . '","error");</script>'
                );
                redirect('SuperAdmin/DataUser/Admin');
            }
        }

        $data_update = array(
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        );
        $whereid = array(
            'id_user' => $this->input->post('id_user')
        );
        $this->Model_admin->edit_data($whereid, $data_update, 't_user');
        if ($data->role_id == 1) {
            $this->session->set_flashdata(
                'siswaDU',
                '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Berhasil Dirubah ","success");</script>'
            );
            redirect('SuperAdmin/DataUser');
        } elseif ($data->role_id == 2) {
            $this->session->set_flashdata(
                'guruDU',
                '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Berhasil Dirubah ","success");</script>'
            );
            redirect('SuperAdmin/DataUser/DataGuru');
        } elseif ($data->role_id == 77) {
            $this->session->set_flashdata(
                'adminDU',
                '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Berhasil Dirubah ","success");</script>'
            );
            redirect('SuperAdmin/DataUser/Admin');
        }
    }
    public function Admin()
    {
        # code...
        $data['admin'] = $this->Model_admin->GetAllAdmin()->result_array();


        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar_su');
        $this->load->view('Admin/DataAdmin', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function TambahAdmin()
    {
        # code...
        $data_user = array(
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role_id' => 77,
            'status_block' => 0
        );
        $this->Model_auth->Tambah_data($data_user, 't_user');
        $data_add = array(
            'id_user' => $this->db->insert_id(),
            'nama_admin' => $this->input->post('nama_admin'),
        );
        $this->Model_auth->Tambah_data($data_add, 't_admin');
        redirect('SuperAdmin/DataUser/Admin');
    }
}
