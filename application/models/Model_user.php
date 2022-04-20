<?php

class Model_user extends CI_Model
{
    public function get_data_all($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        return $this->db->get();
    }
    public function get_data_home($table)
    {
        $this->db->select('*');
        $this->db->from('t_buku');
        $this->db->group_by('judul_buku');
        return $this->db->get();
    }
    public function get_data_detail($idbuku)
    {
        $this->db->select('*');
        $this->db->from('t_buku');
        $this->db->where('kode_buku', $idbuku);
        $this->db->group_by('judul_buku');
        return $this->db->get();
    }
    public function edit_data($where, $data, $table)
    {
        $this->db->where($where);
        $query = $this->db->update($table, $data);
        return $query;
    }
    public function Tambah_data($data, $table)
    {
        return $this->db->insert($table, $data);
    }
    public function SearchBuku($keyword)
    {
        $this->db->select('*');
        $this->db->from('t_buku');
        $this->db->like('judul_buku', $keyword);
        $this->db->or_like('kategori', $keyword);
        $this->db->group_by('judul_buku');
        return $this->db->get();
    }
    public function SearchKategori($keyword)
    {
        $this->db->select('*');
        $this->db->from('t_buku');
        $this->db->like('kategori', $keyword);
        $this->db->group_by('judul_buku');
        return $this->db->get();
    }
    public function Profile($id)
    {
        $this->db->where('t_user.id_user', $id);
        $this->db->select('t_user.id_user , t_user.username, t_profile.*');
        $this->db->from('t_user');
        $this->db->join('t_profile', 't_profile.id_user=t_user.id_user', 'left');
        // $this->db->where('status_pengembalian=0');
        return $this->db->get();
    }
    public function ProfileGuru($id)
    {
        $this->db->where('t_user.id_user', $id);
        $this->db->select('t_user.id_user , t_user.username, t_guru.*');
        $this->db->from('t_user');
        $this->db->join('t_guru', 't_guru.id_user=t_user.id_user', 'left');
        // $this->db->where('status_pengembalian=0');
        return $this->db->get();
    }
}
