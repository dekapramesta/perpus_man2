<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
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
        $this->load->view('login');
        $this->load->view('templates/footer');
    }
    public function login_user()
    {
        $this->form_validation->set_rules('username', 'Username', 'required', ['required' => 'Username wajib diisi!']);
        $this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Password wajib diisi!']);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('login');
            $this->load->view('templates/footer');
        } else {
            $auth = $this->Model_auth->cek_login();
            if ($auth == FALSE) {
                $this->session->set_flashdata('pesan', '<div style="justify-content:center;" class="text-center alert alert-danger alert-dismissible fade show" role="alert">Password Anda Salah!</div>');
                redirect('Login');
            } else {
                $this->session->set_userdata('username', $auth->username);
                $this->session->set_userdata('role_id', $auth->role_id);
                $this->session->set_userdata('id_user', $auth->id_user);
                switch ($auth->role_id) {
                    case 77:
                        redirect('Admin/Home');
                        break;
                    case 1:
                        redirect('Home');
                        break;
                    case 70:
                        redirect('SuperAdmin/Home');
                        break;
                    default:
                        break;
                }
            }
        }
    }
}
