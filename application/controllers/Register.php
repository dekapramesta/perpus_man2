<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
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
        $this->load->view('templates/header');
        $this->load->view('register');
        $this->load->view('templates/footer');
    }
    public function RegisterGuru()
    {
        $this->load->view('templates/header');
        $this->load->view('register_guru');
        $this->load->view('templates/footer');
    }
    public function daftar()
    {
        $this->form_validation->set_rules('nisn', 'NISN', 'required');
        $this->form_validation->set_rules('username', 'username', 'required|is_unique[t_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|is_unique[t_profile.nama]');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|is_unique[t_profile.no_hp]');
        $this->form_validation->set_rules('angkatan', 'Angkatan', 'required');
        $this->form_validation->set_rules('barcode', 'Barcode', 'required');

        $this->form_validation->set_message('required', '{field} tidak boleh kosong!');
        $this->form_validation->set_message('is_unique', '{field} sudah digunakan!');

        if ($this->form_validation->run()) {
            $username = $this->input->post('username');
            $pwd = $this->input->post('password');
            $nisn = $this->input->post('nisn');
            $namalengkap = $this->input->post('nama_lengkap');
            $email = $this->input->post('email');
            $no_hp = $this->input->post('no_hp');
            $angkatan = $this->input->post('angkatan');
            $barcode = $this->input->post('barcode');
            $password         = password_hash($pwd, PASSWORD_DEFAULT);
            $roleid = 1;
            $coin = 0;


            $data_user = array(
                'username' => $username,
                'password' => $password,
                'role_id' => $roleid
            );

            $regis_user = $this->Model_auth->daftar_user($data_user, 't_user');

            if ($regis_user) {
                $id_user =  $this->db->insert_id();
                $data_profile = array(
                    'id_user' => $id_user,
                    'nama' => $namalengkap,
                    'email' => $email,
                    'no_hp' => $no_hp,
                    'coin' => 0,
                    'angkatan' => $angkatan,
                    'nisn' => $nisn
                );
                $regis_profile = $this->Model_auth->daftar_user($data_profile, 't_profile');
                if ($regis_profile) {
                    $wherenisn = array(
                        'nisn' => $nisn
                    );
                    $changestatus = array(
                        'status_daftar' => 1
                    );
                    $this->Model_auth->change_status($wherenisn, $changestatus, 't_register');
                    redirect('Login');
                }
            }
        } else {
            $this->load->view('templates/header');
            $this->load->view('register');
            $this->load->view('templates/footer');
        }
    }
    public function daftar_guru()
    {
        $this->form_validation->set_rules('username', 'username', 'required|is_unique[t_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Guru', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|is_unique[t_guru.no_hp]');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');



        $this->form_validation->set_message('required', '{field} tidak boleh kosong!');
        $this->form_validation->set_message('is_unique', '{field} sudah digunakan!');

        if ($this->form_validation->run()) {

            $username = $this->input->post('username');
            $pwd = $this->input->post('password');
            $namalengkap = $this->input->post('nama_lengkap');
            $email = $this->input->post('email');
            $no_hp = $this->input->post('no_hp');
            $alamat = $this->input->post('alamat');
            $password         = password_hash($pwd, PASSWORD_DEFAULT);
            $roleid = 2;
            $coin = 0;


            $data_user = array(
                'username' => $username,
                'password' => $password,
                'role_id' => $roleid
            );

            $regis_user = $this->Model_auth->daftar_user($data_user, 't_user');

            if ($regis_user) {
                $id_user =  $this->db->insert_id();
                $data_profile = array(
                    'id_user' => $id_user,
                    'nama_guru' => $namalengkap,
                    'email' => $email,
                    'no_hp' => $no_hp,
                    'alamat' => $alamat,

                );
                $regis_profile = $this->Model_auth->daftar_user($data_profile, 't_guru');
                if ($regis_profile) {
                    $wherenisn = array(
                        'email' => $email
                    );
                    $changestatus = array(
                        'status_daftar' => 1
                    );
                    $this->Model_auth->change_status($wherenisn, $changestatus, 't_registerguru');
                    redirect('Login');
                }
            }
        } else {
            echo "cok";
            die;
            $this->load->view('templates/header');
            $this->load->view('register');
            $this->load->view('templates/footer');
        }
    }
    public function checkingcode()
    {
        $code = $this->input->post('hashcode');
        $data_regis['profile'] = $this->Model_auth->checkingcode_guru($code)->row();
        $data_regis['token'] = $this->security->get_csrf_hash();
        $data_regis['token_name'] = $this->security->get_csrf_token_name();
        if ($data_regis) {
            echo json_encode($data_regis);
        } else {
            echo json_encode(7);
        }
    }
    public function checkingcode_guru()
    {
        $code = $this->input->post('hashcode');
        $data_regis['profile'] = $this->Model_auth->Checkingcode_guru($code)->row();
        $data_regis['token'] = $this->security->get_csrf_hash();
        $data_regis['token_name'] = $this->security->get_csrf_token_name();
        if ($data_regis) {
            echo json_encode($data_regis);
        } else {
            echo json_encode(7);
        }
    }
}
