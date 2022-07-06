<?php

class Model_auth extends CI_Model
{
    public function Checkingcode($hashcode)
    {
        $this->db->select('*');
        $this->db->from('t_aktivasi');
        $this->db->join('t_user', 't_user.id_user=t_aktivasi.id_user', 'left');
        $this->db->join('t_siswa', 't_siswa.id_user=t_user.id_user', 'left');
        $this->db->where('t_user.role_id', 1);
        $this->db->where('t_aktivasi.code', $hashcode);
        return $this->db->get();
    }
    public function Checkingcode_guru($hashcode)
    {
        $this->db->select('*');
        $this->db->from('t_aktivasi');
        $this->db->join('t_user', 't_user.id_user=t_aktivasi.id_user', 'left');
        $this->db->join('t_guru', 't_guru.id_user=t_user.id_user', 'left');
        $this->db->where('t_user.role_id', 2);
        $this->db->where('t_aktivasi.code', $hashcode);
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
            if ($hasil->username === $username) {
                if (password_verify($password, $hasil->password)) {
                    if ($hasil->status_block == 0) {
                        return $hasil;
                    } else {
                        $this->session->set_flashdata('pesan', '<div style="justify-content:center;" class="text-center alert alert-danger alert-dismissible fade show" role="alert">Username Atau Password Salah!</div>');
                        redirect('Login');
                    }
                } else {

                    return array();
                }
            } else {
                $this->session->set_flashdata('pesan', '<div style="justify-content:center;" class="text-center alert alert-danger alert-dismissible fade show" role="alert">Username Atau Password Salah!</div>');
                redirect('Login');
            }
        } else {

            $this->session->set_flashdata('pesan', '<div style="justify-content:center;" class="text-center alert alert-danger alert-dismissible fade show" role="alert">Username Atau Password Salah!</div>');
            redirect('Login');
        }
    }
    public function Tambah_data($data, $table)
    {
        return $this->db->insert($table, $data);
    }
    public function CekUser($user)
    {
        $this->db->select('t_user.id_user , t_user.username, t_user.role_id, t_siswa.*,t_guru.*,t_siswa.no_hp as hp_siswa,t_guru.no_hp as hp_guru,t_user.id_user as main_user');
        $this->db->from('t_user');
        $this->db->join('t_siswa', 't_siswa.id_user=t_user.id_user', 'left');
        $this->db->join('t_guru', 't_guru.id_user=t_user.id_user', 'left');
        $this->db->where('t_user.username', $user);

        return $this->db->get();
    }
}
