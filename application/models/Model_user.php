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
}
