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
    public function get_data_ebook($table)
    {
        $this->db->select('*');
        $this->db->from('t_ebook');
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
    public function SearchEbook($keyword)
    {
        $this->db->select('*');
        $this->db->from('t_ebook');
        $this->db->like('judul_ebook', $keyword);
        $this->db->or_like('kategori', $keyword);
        $this->db->group_by('judul_ebook');
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
    public function SearchKategoriBuku($keyword, $number, $offset)
    {
        $this->db->select('*');
        $this->db->from('t_buku');
        $this->db->like('kategori', $keyword);
        $this->db->group_by('judul_buku');
        $this->db->limit($number, $offset);
        return $this->db->get();
    }
    public function SearchKategoriEbook($keyword)
    {
        $this->db->select('*');
        $this->db->from('t_ebook');
        $this->db->like('kategori', $keyword);
        return $this->db->get();
    }
    public function SearchKategoriEbookNow($keyword, $number, $offset)
    {
        $this->db->select('*');
        $this->db->from('t_ebook');
        $this->db->like('kategori', $keyword);
        $this->db->group_by('judul_ebook');
        $this->db->limit($number, $offset);
        return $this->db->get();
    }
    public function Profile($id)
    {
        $this->db->where('t_user.id_user', $id);
        $this->db->select('t_user.id_user , t_user.username, t_siswa.*');
        $this->db->from('t_user');
        $this->db->join('t_siswa', 't_siswa.id_user=t_user.id_user', 'left');
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
    function buku_pag($number, $offset)
    {
        $this->db->select('*');
        $this->db->from('t_buku');
        $this->db->group_by('judul_buku');
        $this->db->limit($number, $offset);
        return $this->db->get();
    }
    function ebook_pag($number, $offset)
    {
        $this->db->select('*');
        $this->db->from('t_ebook');
        $this->db->limit($number, $offset);
        return $this->db->get();
    }
    public function BookHome()
    {
        # code...
        $this->db->select('*');
        $this->db->from('t_buku');
        $this->db->group_by('judul_buku');
        $this->db->order_by('rand()');
        $this->db->limit(3);
        return $this->db->get();
    }
    public function BukuPeminjaman($id)
    {
        # code...
        $this->db->where('t_peminjaman.id_user', $id);
        $this->db->select('*');
        $this->db->from('t_peminjaman');
        $this->db->join('t_buku', 't_buku.id_buku=t_peminjaman.id_buku', 'left');
        return $this->db->get();
    }
}
