<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events extends CI_Controller
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
        $data['hadiah'] = $this->db->get('t_hadiah')->result_array();
        $this->load->view('templates/header');
        $this->load->view('user/event_bacabuku', $data);
        $this->load->view('templates/footer');
    }
    public function Tukarhadiah()
    {
        $id_hadiah = $this->input->post('id_hadiah');
        $id = $this->session->userdata('id_user');
        $hadiah = (int) $this->db->get_where('t_hadiah', array('id_hadiah' => $id_hadiah))->row()->coin_hadiah;
        $siswa = $this->db->get_where('t_siswa', array('id_user' => $id))->row();
        $coin = (int) $siswa->coin;
        if ($coin >= $hadiah) {
            $data_array = array(
                'id_penukaran' => rand(100000, 999999),
                'id_siswa' => $siswa->id_siswa,
                'id_hadiah' => $id_hadiah,
                'status_penukaran' => 0
            );
            $kirim = $this->Model_user->Tambah_data($data_array, 't_penukaran');
            if ($kirim) {
                $where = array(
                    'id_siswa' => $siswa->id_siswa
                );
                $data_update = array(
                    'coin' => $coin - $hadiah
                );
                $this->Model_user->Edit_data($where, $data_update, 't_siswa');
            }
        } else {
            $this->session->set_flashdata(
                'pesan',
                '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
				<script type ="text/JavaScript">swal("Gagal","Gagal Penukaran","error");</script>'
            );
        }
        redirect('Events', 'refresh');
    }
}
