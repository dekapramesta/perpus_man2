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
                    case 2:
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
    public function LupaPassword($hash)
    {
        # code...
        $token = $this->db->get_where('t_tokenpass', array('id_tokenpass' => $hash))->row();
        if ($token != null) {
            $this->load->view('templates/header');
            $this->load->view('lupapass');
            $this->load->view('templates/footer');
        } else {
            echo "Bad Gateway";
        }
    }
    public function PassChange()
    {
        # code...
        $this->form_validation->set_rules('password', 'password', 'required|min_length[8]');
        $this->form_validation->set_rules('hash', 'hash', 'required');
        $this->form_validation->set_rules('conf_password', 'conf_password', 'required|matches[password]');

        $this->form_validation->set_message('required', '{field} Kosong');
        $this->form_validation->set_message('matches', 'Pass Tidak Cocok');
        $this->form_validation->set_message('min_length', '{field} Minimal Harus {param} Karakter .');

        if (!$this->form_validation->run()) {
            $pesan = array(
                'status' => 0,
                'pesan' => strip_tags(validation_errors()),
                'token' => $this->security->get_csrf_hash(),

            );
        } else {
            $new_pass = $this->input->post('password');
            $token = $this->db->get_where('t_tokenpass', array('id_tokenpass' => $this->input->post('hash')))->row();
            $data_pass = array(
                'password' => password_hash($new_pass, PASSWORD_DEFAULT)
            );
            $pass_where = array(
                'id_user' => $token->id_user
            );
            $this->Model_user->edit_data($pass_where, $data_pass, 't_user');
            $this->db->delete('t_tokenpass', array('id_tokenpass' => $this->input->post('hash')));
            $pesan = array(
                'status' => 1,
                'pesan' => "Success",
                'token' => $this->security->get_csrf_hash(),

            );
        }
        echo json_encode($pesan);
    }
    public function SendToken()
    {
        # code...
        $perpus = $this->db->get('profile_perpus')->row();

        $data = $this->Model_auth->CekUser($this->input->post('username'))->row();
        if ($data != null) {
            $code = md5($data->username);
            if ($data->role_id == 1) {
                $pesan = array(
                    'token' => $perpus->token_wa,
                    'phone' => $data->hp_siswa,
                    'message' => "Beriku Link Untuk Mengganti Password " . base_url('Login/LupaPassword/' . $code),
                );
            } else {
                $pesan = array(
                    'token' => $perpus->token_wa,
                    'phone' => $data->hp_guru,
                    'message' => "Beriku Link Untuk Mengganti Password " . base_url('Login/LupaPassword/' . $code),
                );
            }

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
                CURLOPT_POSTFIELDS => $pesan,
            ));

            $response = curl_exec($curl);
            $hasil = json_decode($response);

            curl_close($curl);
            if ($hasil->result == true) {
                $data_token = array(
                    'id_tokenpass' => $code,
                    'id_user' => $data->main_user,
                );
                $this->Model_admin->Tambah_data($data_token, 't_tokenpass');
                $response = array(
                    'status' => 1,
                    'token' => $this->security->get_csrf_hash(),
                    'data' => $data
                );
            } else {
                $response = array(
                    'status' => 0,
                    'token' => $this->security->get_csrf_hash(),
                    'data' => "error"
                );
            }



            echo json_encode($response);
        } else {
            $response = array(
                'status' => 0,
                'data' => "Data Tidak Ada",
                'token' => $this->security->get_csrf_hash(),
            );
            echo json_encode($response);
        }
    }
}
