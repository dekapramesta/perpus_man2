<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('role_id') != 77) {
            redirect('');
        }
        KirimWA();
        time_booking();
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
     * @seehttps://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $data['data'] = $this->Model_admin->getNotifikasi()->result_array();

        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/notifikasi', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function KirimNotif()
    {
        # code...
        $data = $this->db->get_where('t_notice', array('id_notice' => $this->input->post('id')))->row();
        $cek_wa = curl_init();

        curl_setopt_array($cek_wa, array(
            CURLOPT_URL => 'http://nusagateway.com/api/check-number.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('token' => '4kWunMnyn6SyqVo3K7qx6h7YcOkZQpBw2CuID1m4O6jompSrBG', 'phone' => $data->no_wa),
        ));

        $status_cek = curl_exec($cek_wa);
        $hasil_cek = json_decode($status_cek);

        curl_close($cek_wa);
        if ($hasil_cek->status == "valid") {
            $notice = array(
                'token' => '4kWunMnyn6SyqVo3K7qx6h7YcOkZQpBw2CuID1m4O6jompSrBG',
                'phone' => $data->no_wa,
                'message' => 'Pemberitahuan Pengembalian Buku Yang Dipinjan'
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
                CURLOPT_POSTFIELDS => $notice,
            ));

            $response = curl_exec($curl);
            $hasil = json_decode($response);
            if ($hasil->result == true) {
                $where = array(
                    'id_notice' => $this->input->post('id')
                );
                $data_update = array(
                    'status_kirim' => 1
                );
                $this->Model_user->Edit_data($where, $data_update, 't_notice');
                $pesan = array('status' => 1, 'message' => $hasil->message, 'token' => $this->security->get_csrf_hash());
            } else {
                $pesan = array('status' => 0, 'message' => $hasil->message, 'token' => $this->security->get_csrf_hash());
            }
        } else {
            $pesan = array('status' => 0, 'message' => $hasil_cek->message, 'token' => $this->security->get_csrf_hash());
        }
        echo json_encode($pesan);
    }
}
