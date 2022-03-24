<?php

class Model_user extends CI_Model
{
    public function get_data_all($table)
    {
        $this->db->select('*');
        $this->db->from($table);
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
