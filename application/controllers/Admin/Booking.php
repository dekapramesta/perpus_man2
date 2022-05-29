<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        time_booking();
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('role_id') != 77) {
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
     * @seehttps://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $data['booking'] = $this->Model_admin->DataBooking()->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/booking', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function getBooking()
    {
        $idsiswa = $this->input->post('idsiswa');
        $idguru = $this->input->post('idguru');
        if ($idguru != null) {
            $data['token'] = $this->security->get_csrf_hash();
            $databuku = $this->Model_admin->getBookingGuru($idguru)->result_array();
            // var_dump($databuku);
            if ($databuku) {
                foreach ($databuku as $dt) {
                    $dat[] = ["Id_booking" => $dt['id_booking'], "Nama" => $dt['nama_guru'], "Judul" => $dt['judul_buku'], "Kode_Buku" => $dt['id_buku'], "Id_user" => $dt['id_user']];
                }
                $data['buku'] = $dat;
            }
            echo json_encode($data);
        } elseif ($idsiswa != null) {
            $id_siswa = $this->db->get_where('t_siswa', array('nisn' => $idsiswa))->row()->id_user;
            $data['token'] = $this->security->get_csrf_hash();
            $databuku = $this->Model_admin->getBooking($id_siswa)->result_array();
            // var_dump($databuku);
            if ($databuku) {
                foreach ($databuku as $dt) {
                    $dat[] = ["Id_booking" => $dt['id_booking'], "Nama" => $dt['nama'], "Judul" => $dt['judul_buku'], "Kode_Buku" => $dt['id_buku'], "Id_user" => $dt['id_user']];
                }
                $data['buku'] = $dat;
            }
            echo json_encode($data);
        }
    }
    public function TrackingBooking($id)
    {
        $data['booking'] =  $this->Model_admin->TrackingBooking($id)->result_array();
        return $data;
    }
}
