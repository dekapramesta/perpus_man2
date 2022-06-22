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
        $data_hadiah = $this->db->get_where('t_hadiah', array('id_hadiah' => $id_hadiah))->row();
        $hadiah = (int) $data_hadiah->coin_hadiah;
        $siswa = $this->db->get_where('t_siswa', array('id_user' => $id))->row();
        $coin = (int) $siswa->coin;
        $quantity =  $data_hadiah->jumlah;
        if ((int) $quantity >= 1) {

            if ($coin >= $hadiah) {
                $kode = rand(100000, 999999);
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
                    CURLOPT_POSTFIELDS => array('token' => '4kWunMnyn6SyqVo3K7qx6h7YcOkZQpBw2CuID1m4O6jompSrBG', 'phone' => $siswa->no_hp),
                ));

                $status_cek = curl_exec($cek_wa);
                $hasil_cek = json_decode($status_cek);

                curl_close($cek_wa);
                // var_dump($hasil_cek);
                // die;
                if ($hasil_cek->status == "valid") {
                    $data = array(
                        'token' => '4kWunMnyn6SyqVo3K7qx6h7YcOkZQpBw2CuID1m4O6jompSrBG',
                        'phone' => $siswa->no_hp,
                        'message' => 'Selamat Coin Berhasil Ditukarkan, Berikut Kode Penukaran : ' . $kode
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
                        CURLOPT_POSTFIELDS => $data,
                    ));

                    $response = curl_exec($curl);
                    $hasil = json_decode($response);

                    curl_close($curl);
                    if ($hasil->result == true) {
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
                        }
                    } else {
                        $this->session->set_flashdata(
                            'pesan',
                            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            	<script type ="text/JavaScript">swal("Gagal","Gagal Penukaran","error");</script>'
                        );
                    }

                    // $data_array = array(
                    //     'id_penukaran' => $kode,
                    //     'id_siswa' => $siswa->id_siswa,
                    //     'id_hadiah' => $id_hadiah,
                    //     'status_penukaran' => 0
                    // );
                    // $kirim = $this->Model_user->Tambah_data($data_array, 't_penukaran');
                    // if ($kirim) {
                    //     $where = array(
                    //         'id_siswa' => $siswa->id_siswa
                    //     );
                    //     $data_update = array(
                    //         'coin' => $coin - $hadiah
                    //     );
                    //     $this->Model_user->Edit_data($where, $data_update, 't_siswa');
                    //     $data = array(
                    //         'number' => $siswa->no_hp,
                    //         'message' => 'Selamat Coin Berhasil Ditukarkan, Berikut Kode Penukaran : ' . $kode
                    //     );

                    //     $payload = json_encode($data);

                    //     // Prepare new cURL resource
                    //     $ch = curl_init('http://localhost:5000/send-message');
                    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    //     curl_setopt($ch, CURLINFO_HEADER_OUT, true);
                    //     curl_setopt($ch, CURLOPT_POST, true);
                    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

                    //     // Set HTTP Header for POST request 
                    //     curl_setopt(
                    //         $ch,
                    //         CURLOPT_HTTPHEADER,
                    //         array(
                    //             'Content-Type: application/json',
                    //             'Content-Length: ' . strlen($payload)
                    //         )
                    //     );

                    //     // Submit the POST request
                    //     $result = curl_exec($ch);
                    //     $hasil = json_decode($result);

                    //     // Close cURL session handle
                    //     curl_close($ch);
                    $this->session->set_flashdata(
                        'pesan',
                        '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script type ="text/JavaScript">swal("Success","Sukses Penukaran","success");</script>'
                    );
                    $where_hdh = array(
                        'id_hadiah' => $data_hadiah->id_hadih,
                    );
                    $data_hdh = array(
                        'jumlah' => (int) $data_hadiah->jumlah - 1
                    );
                    $this->Model_user->Edit_data($where_hdh, $data_hdh, 't_hadiah');
                    // }
                } elseif ($hasil_cek->status == "invalid") {
                    $this->session->set_flashdata(
                        'pesan',
                        '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            	<script type ="text/JavaScript">swal("Gagal","No Tidak Terdaftar Whatsapp","error");</script>'
                    );
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            	<script type ="text/JavaScript">swal("Gagal","Gagal Penukaran","error");</script>'
                    );
                }
                // var_dump($hasil_cek);
                // die;

            } else {
                $this->session->set_flashdata(
                    'pesan',
                    '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            	<script type ="text/JavaScript">swal("Gagal","Koin Kurang","error");</script>'
                );
            }
        } elseif ($quantity <= 0) {
            $this->session->set_flashdata(
                'pesan',
                '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            	<script type ="text/JavaScript">swal("Gagal","Hadiah Habis","error");</script>'
            );
        }

        redirect('Events', 'refresh');
    }
}
