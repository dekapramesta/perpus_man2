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
    public function EditProfile($id)
    {
        if ($this->session->userdata('id_user') == $id) {
            $data_edit = array(
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('no_hp'),
                'angkatan' => $this->input->post('angkatan'),
                'nisn' => $this->input->post('nisn'),
            );
            $data_where = array(
                'id_profile' => $id
            );
            $this->Model_user->edit_data($data_where, $data_edit, 't_profile');
            redirect('Profile/DataDiri/' . $this->session->userdata('id_user'));
        } else {
            redirect("");
        }
    }
}
