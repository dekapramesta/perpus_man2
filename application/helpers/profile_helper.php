<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('profile_perpus')) {

    function profile_perpus()

    {
        $CI    = &get_instance();
        $CI->load->database();
        $data =  $CI->db->get_where('profile_perpus', array('id_profile' => 77))->row();
        return $data;
        // echo $years;
    }
}
