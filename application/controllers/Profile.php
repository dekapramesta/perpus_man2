<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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
    public function DataDiri($id)
    {
        $user_role = $this->db->get_where('t_user', array('id_user' => $this->session->userdata('id_user')))->row()->role_id;
        if ($user_role == 1) {
            if ($this->session->userdata('id_user') == $id) {
                $data['role'] = 1;
                $data['profile'] = $this->Model_user->Profile($id)->row();
                $data['peminjaman'] =  $this->Model_user->BukuPeminjaman($id)->result_array();

                $this->load->view('templates/header');
                $this->load->view('user/profile', $data);
                $this->load->view('templates/footer');
            } else {
                redirect("");
            }
        } elseif ($user_role == 2) {
            if ($this->session->userdata('id_user') == $id) {
                $data['role'] = 2;
                $data['profile'] = $this->Model_user->ProfileGuru($id)->row();
                $data['peminjaman'] =  $this->Model_user->BukuPeminjaman($id)->result_array();

                $this->load->view('templates/header');
                $this->load->view('user/profile', $data);
                $this->load->view('templates/footer');
            } else {
                redirect("");
            }
        } else {
            redirect("");
        }
    }
    public function EditProfile()
    {
        if ($this->session->userdata('id_user') != null) {
            if ($this->session->userdata('role_id') == 1) {
                $original = $this->Model_user->Profile($this->session->userdata('id_user'))->row();
                if ($original->username != $this->input->post('username')) {
                    $this->form_validation->set_rules('username', 'username', 'required|is_unique[t_user.username]');
                    $this->form_validation->set_message('is_unique', '{field} sudah digunakan!');
                    if (!$this->form_validation->run()) {
                        $message = substr(strip_tags(validation_errors()), 0, -1);
                        $this->session->set_flashdata(
                            'profile_error',
                            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Gagal","' . $message . '","error");</script>'
                        );
                        redirect('Profile/DataDiri/' . $this->session->userdata('id_user'));
                    }
                }
                $id_siswa = $this->db->get_where('t_siswa', array('id_user' => $this->session->userdata('id_user')))->row()->id_siswa;

                $datauser = array(
                    'username' => $this->input->post('username')
                );
                $whereuser = array(
                    'id_user' => $this->session->userdata('id_user')
                );
                $edit_user = $this->Model_user->edit_data($whereuser, $datauser, 't_user');
                if ($edit_user) {
                    $data_edit = array(
                        'nama' => $this->input->post('nama'),
                        'email' => $this->input->post('email'),
                        'no_hp' => $this->input->post('no_hp'),
                    );
                    $data_where = array(
                        'id_siswa' => $id_siswa
                    );
                    $this->Model_user->edit_data($data_where, $data_edit, 't_siswa');
                    redirect('Profile/DataDiri/' . $this->session->userdata('id_user'));
                }
            } elseif ($this->session->userdata('role_id') == 2) {
                $original = $this->Model_user->ProfileGuru($this->session->userdata('id_user'))->row();
                if ($original->username != $this->input->post('username')) {
                    $this->form_validation->set_rules('username', 'username', 'required|is_unique[t_user.username]');
                    $this->form_validation->set_message('is_unique', '{field} sudah digunakan!');
                    if (!$this->form_validation->run()) {
                        $message = substr(strip_tags(validation_errors()), 0, -1);
                        $this->session->set_flashdata(
                            'profile_error',
                            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Gagal","' . $message . '","error");</script>'
                        );
                        redirect('Profile/DataDiri/' . $this->session->userdata('id_user'));
                    }
                }
                $id_guru = $this->db->get_where('t_guru', array('id_user' => $this->session->userdata('id_user')))->row()->id_guru;
                $datauser = array(
                    'username' => $this->input->post('username')
                );
                $whereuser = array(
                    'id_user' => $this->session->userdata('id_user')
                );
                $edit_user = $this->Model_user->edit_data($whereuser, $datauser, 't_user');
                if ($edit_user) {
                    $data_edit = array(
                        'nama_guru' => $this->input->post('nama'),
                        'email' => $this->input->post('email'),
                        'no_hp' => $this->input->post('no_hp'),
                        'alamat' => $this->input->post('alamat'),
                    );
                    $data_where = array(
                        'id_guru' => $id_guru
                    );
                    $this->Model_user->edit_data($data_where, $data_edit, 't_guru');
                    redirect('Profile/DataDiri/' . $this->session->userdata('id_user'));
                }
            }
        } else {
            redirect("/");
        }
    }
    public function UbahPass()
    {
        # code...
        $pass = $this->input->post('password');
        $new_pass = $this->input->post('new_pass');
        $conf_pass = $this->input->post('conf_pass');

        if ($this->session->userdata('id_user') != null) {
            $data = $this->db->get_where('t_user', array('id_user' => $this->session->userdata('id_user')))->row();
            if (password_verify($pass, $data->password)) {


                if ($conf_pass === $new_pass) {
                    $data_pass = array(
                        'password' => password_hash($new_pass, PASSWORD_DEFAULT)
                    );
                    $pass_where = array(
                        'id_user' => $this->session->userdata('id_user')
                    );
                    $this->Model_user->edit_data($pass_where, $data_pass, 't_user');
                    $this->session->set_flashdata(
                        'password_erorr',
                        '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Berhasil","Password Berhasil Dirubah","success");</script>'
                    );
                    redirect('Profile/DataDiri/' . $this->session->userdata('id_user'));
                } else {
                    $this->session->set_flashdata(
                        'password_erorr',
                        '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Gagal","Confirmasi Password dan Password Baru Tidak Sama","error");</script>'
                    );
                }
            } else {

                $this->session->set_flashdata(
                    'password_erorr',
                    '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            	<script type ="text/JavaScript">swal("Gagal","Password Salah","error");</script>'
                );
            }
            redirect('Profile/DataDiri/' . $this->session->userdata('id_user'));
        } else {
            redirect("/");
        }
    }
}
