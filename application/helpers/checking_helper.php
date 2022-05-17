<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



if (!function_exists('check_booking')) {

    function check_booking($id)

    {
        $CI    = &get_instance();
        $CI->load->database();
        $data =  $CI->Model_admin->TrackingBooking($id)->row()->nama;
        echo $data;
        // echo $years;
    }
}
if (!function_exists('time_booking')) {

    function time_booking()

    {
        date_default_timezone_set('Asia/Jakarta');
        $CI    = &get_instance();
        $CI->load->database();
        $hari = strtotime(date('Y-m-d'));
        $data =  $CI->Model_admin->getBookingAll()->result_array();
        foreach ($data as $dt) {
            $tgl = strtotime($dt['tgl_pemesanan']);
            if ($tgl < $hari) {
                $where = array(
                    'id_booking' => $dt['id_booking']
                );
                $ubah = array(
                    'status_pesan' => 6
                );

                $CI->Model_admin->edit_data($where, $ubah, 't_booking');
                $data_update = array(
                    'status_buku' => 0,
                );
                $whereid = array(
                    'id_buku' => $dt['id_buku']
                );
                $CI->Model_user->edit_data($whereid, $data_update, 't_buku');
            }
        }
    }
}
function KirimWA()
{
    date_default_timezone_set('Asia/Jakarta');
    $CI    = &get_instance();
    $CI->load->database();
    $data =  $CI->Model_admin->KirimNotif()->result_array();
    $checknotif =  $CI->Model_admin->get_data_onecol('t_notice', 'id_peminjaman')->result_array();
    foreach ($checknotif as $ck) {
        $notif[] = $ck['id_peminjaman'];
    }

    foreach ($data as $dt) {
        if (!in_array($dt['id_peminjaman'], $notif)) {
            $hari_ini = date('Y-m-d');
            $hari = date('Y-m-d', strtotime($dt['tanggal_pengembalian'] . '-1 days'));
            if ($hari_ini == $hari) {
                if ($dt['role_id'] == 1) {
                    $data = array(
                        'number' => $dt['hp_siswa'],
                        'message' => 'Pengingatan Akan Pengembalian Buku dengan ID ' . $dt['id_buku'] . ', Dimana Masa Peminjaman Kurang 1 Hari'
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
                    if ($hasil->status == true) {
                        $data_array = array(
                            'id_peminjaman' => $dt['id_peminjaman'],
                            'no_wa' => $dt['hp_siswa'],
                            'tanggal_wa' => date('Y-m-d'),
                            'status_kirim' => 1
                        );
                        $CI->Model_admin->Tambah_data($data_array, 't_notice');
                    } else {
                        $data_array = array(
                            'id_peminjaman' => $dt['id_peminjaman'],
                            'no_wa' => $dt['hp_siswa'],
                            'tanggal_wa' => date('Y-m-d'),
                            'status_kirim' => 0
                        );
                        $CI->Model_admin->Tambah_data($data_array, 't_notice');
                    }
                } elseif ($dt['role_id'] == 2) {
                    $data = array(
                        'number' => $dt['hp_guru'],
                        'message' => 'Pengingatan Akan Pengembalian Buku dengan ID ' . $dt['id_buku'] . ', Dimana Masa Peminjaman Kurang 1 Hari'
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
                    if ($hasil) {


                        if ($hasil->status == true) {
                            $data_array = array(
                                'id_peminjaman' => $dt['id_peminjaman'],
                                'no_wa' => $dt['hp_guru'],
                                'tanggal_wa' => date('Y-m-d'),
                                'status_kirim' => 1
                            );
                            $CI->Model_admin->Tambah_data($data_array, 't_notice');
                        } else {
                            $data_array = array(
                                'id_peminjaman' => $dt['id_peminjaman'],
                                'no_wa' => $dt['hp_guru'],
                                'tanggal_wa' => date('Y-m-d'),
                                'status_kirim' => 0
                            );
                            $CI->Model_admin->Tambah_data($data_array, 't_notice');
                        }
                    }
                }
            }
        }
    }



    // $post = [
    //     'number' => '0895377941531',
    //     'message' => 'dk',
    // ];
    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, 'https://deka-ciapi.herokuapp.com/send-message');
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // $output = curl_exec($ch);
    // curl_close($ch);
    // echo $output;
    // die;
    // $data = array(
    //     'number' => '0895377941531',
    //     'message' => 'dk'
    // );

    // $payload = json_encode($data);

    // // Prepare new cURL resource
    // $ch = curl_init('https://deka-ciapi.herokuapp.com/send-message');
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    // curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    // // Set HTTP Header for POST request 
    // curl_setopt(
    //     $ch,
    //     CURLOPT_HTTPHEADER,
    //     array(
    //         'Content-Type: application/json',
    //         'Content-Length: ' . strlen($payload)
    //     )
    // );

    // // Submit the POST request
    // $result = curl_exec($ch);
    // $hasil = json_decode($result);

    // // Close cURL session handle
    // curl_close($ch);
    // var_dump($hasil);
    // die;
}
// echo KirimWA();
