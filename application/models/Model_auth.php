<?php

class Model_auth extends CI_Model
{
    public function Checkingcode($hashcode)
    {
        $this->db->select('*');
        $this->db->from('t_register');
        $this->db->where('code', $hashcode);
        return $this->db->get();
    }
    public function Checkingcode_guru($hashcode)
    {
        $this->db->select('*');
        $this->db->from('t_registerguru');
        $this->db->where('code', $hashcode);
        return $this->db->get();
    }
    public function daftar_user($data, $table)
    {
        $this->db->insert($table, $data);
        return true;
    }
    public function change_status($where, $data, $table)
    {
        $this->db->where($where);
        $query = $this->db->update($table, $data);
        return $query;
    }
    public function cek_login()
    {
        $username        = set_value('username');
        $password    = set_value('password');

        $this->input->post('username', $username);
        $this->input->post('password', $password);

        $cek  = $this->db->get_where('t_user', ['username' => $username]);

        if ($cek->num_rows() > 0) {
            $hasil = $cek->row();
            if (password_verify($password, $hasil->password)) {

                return $hasil;
            } else {

                return array();
            }
        } else {

            $this->session->set_flashdata('pesan', '<div style="justify-content:center;" class="text-center alert alert-danger alert-dismissible fade show" role="alert">Username tidak ditemukan!</div>');
            redirect('Login');
        }
    }
    public function Tambah_data($data, $table)
    {
        return $this->db->insert($table, $data);
    }
}
