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
            }
        }
    }
}
