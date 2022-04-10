<?php

class Model_admin extends CI_Model
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
    public function returnBook($idbuku)
    {
        $this->db->where('t_peminjaman.id_buku', $idbuku);
        $this->db->select('t_peminjaman.*,t_buku.* ,t_user.id_user , t_user.username');
        $this->db->from('t_peminjaman');
        $this->db->join('t_user', 't_user.id_user=t_peminjaman.id_user', 'left');
        $this->db->join('t_buku', 't_buku.id_buku=t_peminjaman.id_buku', 'left');
        // $this->db->where('status_pengembalian=0');
        return $this->db->get();
    }
    public function DetailBuku($idbuku)
    {
        $this->db->where('t_buku.id_buku', $idbuku);
        $this->db->select('t_peminjaman.*,t_buku.* ,t_user.id_user , t_user.username');
        $this->db->from('t_buku');
        $this->db->join('t_peminjaman', 't_peminjaman.id_buku=t_buku.id_buku', 'left');
        $this->db->join('t_user', 't_user.id_user=t_peminjaman.id_user', 'left');
        $this->db->where('status_pengembalian=0');
        return $this->db->get();
    }
    public function DataBooking()
    {
        $this->db->select('t_booking.*,t_buku.* ,t_user.id_user , t_user.username, t_profile.*');
        $this->db->from('t_booking');
        $this->db->join('t_buku', 't_buku.id_buku=t_booking.id_buku', 'left');
        $this->db->join('t_user', 't_user.id_user=t_booking.id_user', 'left');
        $this->db->join('t_profile', 't_profile.id_user=t_user.id_user', 'left');
        return $this->db->get();
    }
    public function TrackingBooking($idbuku)
    {
        $this->db->where('t_booking.id_buku', $idbuku);
        $this->db->select('t_booking.*,t_buku.* ,t_user.id_user , t_user.username, t_profile.*');
        $this->db->from('t_booking');
        $this->db->join('t_buku', 't_buku.id_buku=t_booking.id_buku', 'left');
        $this->db->join('t_user', 't_user.id_user=t_booking.id_user', 'left');
        $this->db->join('t_profile', 't_profile.id_user=t_user.id_user', 'left');
        $this->db->where('status_pesan=0');
        return $this->db->get();
    }
    public function getBooking($idsiswa)
    {
        $this->db->where('t_booking.id_user', $idsiswa);
        $this->db->select('t_booking.*,t_buku.* ,t_user.id_user , t_user.username, t_profile.*');
        $this->db->from('t_booking');
        $this->db->join('t_buku', 't_buku.id_buku=t_booking.id_buku', 'left');
        $this->db->join('t_user', 't_user.id_user=t_booking.id_user', 'left');
        $this->db->join('t_profile', 't_profile.id_user=t_user.id_user', 'left');
        $this->db->where('status_pesan=0');
        return $this->db->get();
    }
}
