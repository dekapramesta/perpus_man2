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
        $data['siswa'] = $this->Model_admin->RegisterSiswa()->result_array();

        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar_su');
        $this->load->view('Admin/registrasi', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function RegisterGuru()
    {
        $data['guru'] = $this->Model_admin->RegisterGuru()->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar_su');
        $this->load->view('Admin/registrasi_guru', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function tambah_regist()
    {
        $perpus = $this->db->get('profile_perpus')->row();


        $this->form_validation->set_rules('nisn', 'NISN', 'required|is_unique[t_siswa.nisn]');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('no_hp', 'No Whatsapp', 'required');
        $this->form_validation->set_rules('angkatan', 'Angkatan', 'required');


        $this->form_validation->set_message('is_unique', '{field} Sudah Ada');
        $this->form_validation->set_message('required', '{field} Kosong');
        $this->form_validation->set_message('matches', 'Pass Tidak Cocok');
        $this->form_validation->set_message('min_length', '{field} Minimal Harus {param} Karakter .');

        if (!$this->form_validation->run()) {
            $message = substr(strip_tags(validation_errors()), 0, -1);

            $this->session->set_flashdata(
                'regis_su',
                '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Gagal","' . $message . '","error");</script>'
            );
            redirect('SuperAdmin/Registrasi');
        } else {
            $data_user = array(
                'username' => 'siswa' . rand(1000, 9999),
                'password' => password_hash('12345678', PASSWORD_DEFAULT),
                'role_id' => 1,
                'status_block' => 1
            );
            $this->Model_auth->Tambah_data($data_user, 't_user');
            $nisn = $this->input->post('nisn');
            $nama = $this->input->post('nama');
            $no_wa = $this->input->post('no_hp');
            $angakatan = $this->input->post('angkatan');
            $id_user = $this->db->insert_id();

            $data_add = array(
                'nisn' => $nisn,
                'id_user' => $id_user,
                'nama' => $nama,
                'no_hp' => $no_wa,
                'angkatan' => $angakatan,
                'coin' => 0
            );
            $this->Model_auth->Tambah_data($data_add, 't_siswa');

            $code = rand(00000, 99999);
            $data_aktivasi = array(
                'id_user' => $id_user,
                'code' => $code
            );


            $this->Model_auth->Tambah_data($data_aktivasi, 't_aktivasi');
            $data = array(
                'token' => $perpus->token_wa,
                'phone' => $no_wa,
                'message' => 'Berikut Kode Untuk Pendaftaran ' . $code
            );
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://nusagateway.com/api/send-message.php',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
            ));

            $response = curl_exec($curl);
            $hasil = json_decode($response);

            curl_close($curl);
        }

        redirect('SuperAdmin/Registrasi');
        // }
    }
    public function tambah_regist_guru()
    {
        $perpus = $this->db->get('profile_perpus')->row();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('no_wa', 'No Whatsapp', 'required');
        $this->form_validation->set_message('required', '{field} Kosong');


        if (!$this->form_validation->run()) {
            $message = substr(strip_tags(validation_errors()), 0, -1);

            $this->session->set_flashdata(
                'regisguru_su',
                '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Gagal","' . $message . '","error");</script>'
            );
            redirect('SuperAdmin/Registrasi/RegisterGuru');
        } else {
        }
        $data_user = array(
            'username' => 'guru' . rand(1000, 9999),
            'password' => password_hash('12345678', PASSWORD_DEFAULT),
            'role_id' => 2,
            'status_block' => 1
        );
        $this->Model_auth->Tambah_data($data_user, 't_user');
        $nama = $this->input->post('nama');
        $no_wa = $this->input->post('no_wa');
        $id_user = $this->db->insert_id();

        $data_add = array(
            'id_user' => $id_user,
            'nama_guru' => $nama,
            'no_hp' => $no_wa,
        );
        $this->Model_auth->Tambah_data($data_add, 't_guru');

        $code = rand(00000, 99999);
        $data_aktivasi = array(
            'id_user' => $id_user,
            'code' => $code
        );


        $this->Model_auth->Tambah_data($data_aktivasi, 't_aktivasi');
        $data = array(
            'token' => $perpus->token_wa,
            'phone' => $no_wa,
            'message' => 'Berikut Kode Pendaftaran Anda  ' . $code
        );
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://nusagateway.com/api/send-message.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
        ));

        $response = curl_exec($curl);
        $hasil = json_decode($response);

        curl_close($curl);

        redirect('SuperAdmin/Registrasi/RegisterGuru');
        // }
    }
    public function edit_guru()
    {
        # code...
        $id_register = $this->input->post('id_registerGuru');
        $nama = $this->input->post('nama_guru');
        $no_wa = $this->input->post('no_hp');


        $data_update = array(
            'nama_guru' => $nama,
            'no_hp' => $no_wa,

        );
        $whereid = array(
            'id_user' => $id_register
        );
        $this->Model_admin->edit_data($whereid, $data_update, 't_guru');

        redirect('SuperAdmin/Registrasi/RegisterGuru');
    }
    public function deleteAktivasi()
    {
        # code...
        $delete = $this->db->delete('t_user', array('id_user' => $this->input->post('id_user')));
        if ($delete) {
            $pesan = array('status' => 1, 'token' => $this->security->get_csrf_hash());

            echo json_encode($pesan);
        } else {
            $pesan = array('status' => 0, 'token' => $this->security->get_csrf_hash());

            echo json_encode($pesan);
        }
    }
    public function edit_regist()
    {
        $id_register = $this->input->post('id_register');
        $nisn = $this->input->post('nisn');
        $nama = $this->input->post('nama');
        $no_wa = $this->input->post('no_wa');


        $data_update = array(
            'nisn' => $nisn,
            'nama' => $nama,
            'no_hp' => $no_wa,
        );
        $whereid = array(
            'id_user' => $id_register
        );
        $this->Model_admin->edit_data($whereid, $data_update, 't_siswa');
        $this->session->set_flashdata(
            'regis_su',
            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Data Berhasl Berubh","success");</script>'
        );
        redirect('SuperAdmin/Registrasi');
        // var_dump($data);
        // die;
    }
    public function getRegister($id)
    {
        $data['profile'] = $this->db->get_where('t_siswa', array('id_user' => $id))->row();
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function getRegisterGuru($id)
    {
        $data['profile'] = $this->db->get_where('t_guru', array('id_user' => $id))->row();
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
        $perpus = $this->db->get('profile_perpus')->row();

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
                    $data_user = array(
                        'username' => 'guru' . rand(1000, 9999),
                        'password' => password_hash('12345678', PASSWORD_DEFAULT),
                        'role_id' => 2,
                        'status_block' => 1
                    );
                    $this->Model_auth->Tambah_data($data_user, 't_user');
                    $id_user = $this->db->insert_id();

                    $insert_data = array(
                        'nama_guru' => $row['nama'],
                        'no_hp' => $row['no_hp'],
                        'id_user' => $id_user
                    );
                    $this->Model_auth->Tambah_data($insert_data, 't_guru');
                    $code = rand(00000, 99999);
                    $data_aktivasi = array(
                        'id_user' => $id_user,
                        'code' => $code
                    );


                    $this->Model_auth->Tambah_data($data_aktivasi, 't_aktivasi');
                    $data = array(
                        'token' => $perpus->token_wa,
                        'phone' => $row['no_hp'],
                        'message' => 'Berikut Kode Pendaftaran Anda  ' . $code
                    );
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://nusagateway.com/api/send-message.php',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => $data,
                    ));

                    $response = curl_exec($curl);
                    $hasil = json_decode($response);

                    curl_close($curl);
                }
                redirect('SuperAdmin/Registrasi/RegisterGuru');
                //echo "<pre>"; print_r($insert_data);
            } else {
                echo 'Gagal';
            }
        }
    }
    public function csv_regist()
    {
        $perpus = $this->db->get('profile_perpus')->row();
        $datasiswa = $this->db->get('t_siswa')->result_array();
        $nisn_array = array_column($datasiswa, 'nisn');
        $nama = array();

        $this->load->library('csvimport');
        // $data['addressbook'] = $this->csv_model->get_addressbook();
        // $data['error'] = '';    //initialize image upload error array to empty

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);


        // If upload failed, display error
        if (!$this->upload->do_upload()) {

            $this->session->set_flashdata(
                'regis_su',
                '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Gagal","Gagal Upload File","error");</script>'
            );
            redirect('SuperAdmin/Registrasi');
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/' . $file_data['file_name'];

            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                // var_dump($csv_array);
                // die;
                foreach ($csv_array as $row) {
                    if (in_array($row['nisn'], $nisn_array)) {
                        $nama[] = $row['nama'];
                        continue;
                    } else {
                        if ($row['nama'] == null) {
                            $nama[] = $row['nama'];
                            continue;
                        } elseif ($row['no_wa'] == null) {
                            $nama[] = $row['nama'];
                            continue;
                        } elseif ($row['angkatan'] == null) {
                            $nama[] = $row['nama'];
                            continue;
                        } else {
                            $data_user = array(
                                'username' => 'siswa' . rand(1000, 9999),
                                'password' => password_hash('12345678', PASSWORD_DEFAULT),
                                'role_id' => 1,
                                'status_block' => 1
                            );
                            $this->Model_auth->Tambah_data($data_user, 't_user');
                            $id_user = $this->db->insert_id();
                            $insert_data = array(
                                'nisn' => $row['nisn'],
                                'nama' => $row['nama'],
                                'id_user' => $id_user,
                                'no_hp' => $row['no_wa'],
                                'angkatan' => $row['angkatan'],
                                'coin' => 0
                            );
                            $this->Model_auth->Tambah_data($insert_data, 't_siswa');
                            $code = rand(00000, 99999);
                            $data_aktivasi = array(
                                'id_user' => $id_user,
                                'code' => $code
                            );


                            $this->Model_auth->Tambah_data($data_aktivasi, 't_aktivasi');
                            $data = array(
                                'token' => $perpus->token_wa,
                                'phone' => $row['no_wa'],
                                'message' => 'Berikut Kode Pendaftaran Anda  ' . $code
                            );
                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                                CURLOPT_URL => 'http://nusagateway.com/api/send-message.php',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => $data,
                            ));

                            $response = curl_exec($curl);
                            $hasil = json_decode($response);

                            curl_close($curl);
                        }
                    }
                }
                if ($nama != null) {
                    $this->session->set_flashdata(
                        'regis_su',
                        '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Gagal","' . implode(",", $nama) . ' Gagal Upload","warning");</script>'
                    );
                } else {
                    $this->session->set_flashdata(
                        'regis_su',
                        '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Data terupload Semua","success");</script>'
                    );
                }
                redirect('SuperAdmin/Registrasi');
                //echo "<pre>"; print_r($insert_data);
            } else {
                echo 'Gagal';
            }
        }
    }
}
