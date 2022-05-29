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
    public function index()
    {
        $data['siswa'] = $this->db->get('t_siswa')->result_array();
        $data['status'] = $this->db->get_where('t_setup', array('nama_fitur' => 'coin'))->row();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar_su');
        $this->load->view('Admin/event', $data);
        $this->load->view('Admin/templates/footer');
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
            redirect('SuperAdmin/Event');
        }
    }
}
