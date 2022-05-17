<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $sts = $this->db->get_where('t_setup', array('id_setup' => 1))->row();
        if ($sts->status_fitur == 0) {
            redirect('/');
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
            $kode = rand(100000, 999999);
            $data_array = array(
                'id_penukaran' => $kode,
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
                $data = array(
                    'number' => $siswa->no_hp,
                    'message' => 'Selamat Coin Berhasil Ditukarkan, Berikut Kode Penukaran : ' . $kode
                );

                $payload = json_encode($data);

                // Prepare new cURL resource
                $ch = curl_init('http://localhost:5000/send-message');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLINFO_HEADER_OUT, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

                // Set HTTP Header for POST request 
                curl_setopt(
                    $ch,
                    CURLOPT_HTTPHEADER,
                    array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($payload)
                    )
                );

                // Submit the POST request
                $result = curl_exec($ch);
                $hasil = json_decode($result);

                // Close cURL session handle
                curl_close($ch);
                $this->session->set_flashdata(
                    'pesan',
                    '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
				<script type ="text/JavaScript">swal("Success","Sukses Penukaran","success");</script>'
                );
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
