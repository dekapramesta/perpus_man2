<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrasi extends CI_Controller
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
        $data['siswa'] = $this->Model_admin->get_data_all('t_register')->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar_su');
        $this->load->view('Admin/registrasi', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function RegisterGuru()
    {
        $data['guru'] = $this->Model_admin->get_data_all('t_registerguru')->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar_su');
        $this->load->view('Admin/registrasi_guru', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function tambah_regist()
    {

        $this->form_validation->set_rules('nisn', 'NISN', 'required|is_unique[t_register.nisn]');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|is_unique[t_register.nama]');
        $this->form_validation->set_rules('no_wa', 'No Whatsapp', 'required|is_unique[t_register.no_wa]');
        $this->form_validation->set_rules('barcode', 'Barcode', 'required|is_unique[t_register.barcode]');

        if ($this->form_validation->run()) {
            $nisn = $this->input->post('nisn');
            $nama = $this->input->post('nama');
            $no_wa = $this->input->post('no_wa');
            $barcode = $this->input->post('barcode');
            $kode    = rand(100000, 999999);

            $data_add = array(
                'nisn' => $nisn,
                'nama' => $nama,
                'no_wa' => $no_wa,
                'barcode' => $barcode,
                'code' => $kode,
                'status_daftar' => 0
            );

            $this->Model_auth->Tambah_data($data_add, 't_register');
            redirect('SuperAdmin/Registrasi');
        }
    }
    public function tambah_regist_guru()
    {

        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[t_registerguru.email]');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('no_wa', 'No Whatsapp', 'required|is_unique[t_registerguru.no_hp]');

        if ($this->form_validation->run()) {
            $email = $this->input->post('email');
            $nama = $this->input->post('nama');
            $no_wa = $this->input->post('no_wa');
            $kode    = rand(100000, 999999);

            $data_add = array(
                'email' => $email,
                'nama_guru' => $nama,
                'no_hp' => $no_wa,
                'code' => $kode,
                'status_daftar' => 0
            );

            $this->Model_auth->Tambah_data($data_add, 't_registerguru');
            redirect('SuperAdmin/Registrasi/RegisterGuru');
        }
    }
    public function edit_guru()
    {
        # code...
        $id_register = $this->input->post('id_registerGuru');
        $nama = $this->input->post('nama_guru');
        $no_wa = $this->input->post('no_hp');
        $code = $this->input->post('code');
        $email = $this->input->post('email');
        $data = $this->db->get_where('t_registerguru', array('id_registerGuru' => $id_register))->row();
        if ($data->status_daftar == 0) {
            $status = 0;
        } else {
            $status = 1;
        }
        $code = $data->code;

        $data_update = array(
            'email' => $email,
            'nama_guru' => $nama,
            'no_hp' => $no_wa,
            'status_daftar' => $status,
            'code' => $code
        );
        $whereid = array(
            'id_registerGuru' => $id_register
        );
        $this->Model_admin->edit_data($whereid, $data_update, 't_registerguru');
        redirect('SuperAdmin/Registrasi/RegisterGuru');
    }
    public function edit_regist()
    {
        $id_register = $this->input->post('id_register');
        $nisn = $this->input->post('nisn');
        $nama = $this->input->post('nama');
        $no_wa = $this->input->post('no_wa');
        $barcode = $this->input->post('barcode');
        $data = $this->db->get_where('t_register', array('id_register' => $id_register))->row();
        if ($data->status_daftar == 0) {
            $status = 0;
        } else {
            $status = 1;
        }
        $code = $data->code;

        $data_update = array(
            'id_register' => $id_register,
            'nisn' => $nisn,
            'nama' => $nama,
            'no_wa' => $no_wa,
            'barcode' => $barcode,
            'status_daftar' => $status,
            'code' => $code
        );
        $whereid = array(
            'id_register' => $id_register
        );
        $this->Model_admin->edit_data($whereid, $data_update, 't_register');
        redirect('SuperAdmin/Registrasi');
        // var_dump($data);
        // die;
    }
    public function getRegister($id)
    {
        $data['profile'] = $this->db->get_where('t_register', array('id_register' => $id))->row();
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function getRegisterGuru($id)
    {
        $data['profile'] = $this->db->get_where('t_registerguru', array('id_registerGuru' => $id))->row();
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function download()
    {
        $this->load->helper('download');
        force_download('uploads/TemplateRegisSiswa.csv', NULL);

        redirect('SuperAdmin/Registrasi');
    }
    public function download_guru()
    {
        $this->load->helper('download');
        force_download('uploads/TemplateRegisGuru.csv', NULL);

        redirect('SuperAdmin/Registrasi');
    }
    public function csv_guru()
    {
        # code...
        $this->load->library('csvimport');
        // $data['addressbook'] = $this->csv_model->get_addressbook();
        // $data['error'] = '';    //initialize image upload error array to empty

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);


        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            echo 'Empty';
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/' . $file_data['file_name'];

            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                // var_dump($csv_array);
                // die;
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'nama_guru' => $row['nama'],
                        'email' => $row['email'],
                        'code' =>  rand(100000, 999999),
                        'no_hp' => $row['no_hp'],
                        'status_daftar' => 0,
                    );
                    $this->Model_auth->Tambah_data($insert_data, 't_registerguru');
                }
                redirect('SuperAdmin/Registrasi/RegisterGuru');
                //echo "<pre>"; print_r($insert_data);
            } else {
                echo 'cok';
            }
        }
    }
    public function csv_regist()
    {
        $this->load->library('csvimport');
        // $data['addressbook'] = $this->csv_model->get_addressbook();
        // $data['error'] = '';    //initialize image upload error array to empty

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);


        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            echo 'Empty';
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/' . $file_data['file_name'];

            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                // var_dump($csv_array);
                // die;
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'nisn' => $row['nisn'],
                        'nama' => $row['nama'],
                        'code' =>  rand(100000, 999999),
                        'no_wa' => $row['no_wa'],
                        'barcode' => $row['barcode'],
                        'status_daftar' => 0,
                    );
                    $this->Model_auth->Tambah_data($insert_data, 't_register');
                }
                redirect('SuperAdmin/Registrasi');
                //echo "<pre>"; print_r($insert_data);
            } else {
                echo 'cok';
            }
        }
    }
}
