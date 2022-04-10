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
