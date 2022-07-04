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
        $this->db->select('t_booking.*,t_buku.* ,t_user.id_user , t_user.username, t_siswa.*,t_guru.*');
        $this->db->from('t_booking');
        $this->db->join('t_buku', 't_buku.id_buku=t_booking.id_buku', 'left');
        $this->db->join('t_user', 't_user.id_user=t_booking.id_user', 'left');
        $this->db->join('t_siswa', 't_siswa.id_user=t_user.id_user', 'left');
        $this->db->join('t_guru', 't_guru.id_user=t_user.id_user', 'left');
        return $this->db->get();
    }
    public function TrackingBooking($idbuku)
    {
        $this->db->where('t_booking.id_buku', $idbuku);
        $this->db->select('t_booking.*,t_buku.* ,t_user.id_user , t_user.username, t_siswa.*');
        $this->db->from('t_booking');
        $this->db->join('t_buku', 't_buku.id_buku=t_booking.id_buku', 'left');
        $this->db->join('t_user', 't_user.id_user=t_booking.id_user', 'left');
        $this->db->join('t_siswa', 't_siswa.id_user=t_user.id_user', 'left');
        $this->db->where('status_pesan=0');
        return $this->db->get();
    }
    public function getBooking($idsiswa)
    {
        $this->db->where('t_booking.id_user', $idsiswa);
        $this->db->select('t_booking.*,t_buku.* ,t_user.id_user , t_user.username, t_siswa.*');
        $this->db->from('t_booking');
        $this->db->join('t_buku', 't_buku.id_buku=t_booking.id_buku', 'left');
        $this->db->join('t_user', 't_user.id_user=t_booking.id_user', 'left');
        $this->db->join('t_siswa', 't_siswa.id_user=t_user.id_user', 'left');
        $this->db->where('status_pesan=0');
        return $this->db->get();
    }
    public function getBookingGuru($idsiswa)
    {
        $this->db->where('t_booking.id_user', $idsiswa);
        $this->db->select('t_booking.*,t_buku.* ,t_user.id_user , t_user.username, t_guru.*');
        $this->db->from('t_booking');
        $this->db->join('t_buku', 't_buku.id_buku=t_booking.id_buku', 'left');
        $this->db->join('t_user', 't_user.id_user=t_booking.id_user', 'left');
        $this->db->join('t_guru', 't_guru.id_user=t_user.id_user', 'left');
        $this->db->where('status_pesan=0');
        return $this->db->get();
    }
    public function getBookingAll()
    {
        $this->db->select('t_booking.*,t_buku.* ,t_user.id_user , t_user.username, t_siswa.*');
        $this->db->from('t_booking');
        $this->db->join('t_buku', 't_buku.id_buku=t_booking.id_buku', 'left');
        $this->db->join('t_user', 't_user.id_user=t_booking.id_user', 'left');
        $this->db->join('t_siswa', 't_siswa.id_user=t_user.id_user', 'left');
        $this->db->where('status_pesan=0');
        return $this->db->get();
    }
    public function getGuru()
    {
        $this->db->select('t_guru.*,t_user.id_user , t_user.username');
        $this->db->from('t_guru');
        $this->db->join('t_user', 't_user.id_user=t_guru.id_user', 'left');
        return $this->db->get();
    }
    public function LaporanPeminjaman($tahun, $bulan, $hari)
    {
        $this->db->select('t_user.id_user , t_user.username, t_user.role_id, t_siswa.*,t_guru.*,t_peminjaman.*,t_pengembalian.*,t_buku.*');
        $this->db->from('t_peminjaman');
        $this->db->join('t_user', 't_user.id_user=t_peminjaman.id_user', 'left');
        $this->db->join('t_siswa', 't_siswa.id_user=t_user.id_user', 'left');
        $this->db->join('t_guru', 't_guru.id_user=t_user.id_user', 'left');
        $this->db->join('t_pengembalian', 't_pengembalian.id_peminjaman=t_peminjaman.id_peminjaman', 'left');
        $this->db->join('t_buku', 't_buku.id_buku=t_peminjaman.id_buku', 'left');
        if (($tahun != null) && ($bulan != null) && ($hari != null)) {
            $this->db->where('YEAR(t_peminjaman.tanggal_pinjam)', $tahun);
            $this->db->where('MONTH(t_peminjaman.tanggal_pinjam)', $bulan);
            $this->db->where('DAY(t_peminjaman.tanggal_pinjam)', $hari);
        } elseif (($tahun != null) && ($bulan != null) && ($hari == null)) {
            $this->db->where('YEAR(t_peminjaman.tanggal_pinjam)', $tahun);
            $this->db->where('MONTH(t_peminjaman.tanggal_pinjam)', $bulan);
        } elseif (($tahun != null) && ($bulan == null) && ($hari == null)) {
            $this->db->where('YEAR(t_peminjaman.tanggal_pinjam)', $tahun);
        }
        $this->db->where('status_pengembalian=1');
        return $this->db->get();
    }
    public function LaporanBuku($tahun, $bulan, $hari)
    {
        $this->db->select('*');
        $this->db->from('t_buku');
        if (($tahun != null) && ($bulan != null) && ($hari != null)) {
            $this->db->where('YEAR(tanggal_masuk)', $tahun);
            $this->db->where('MONTH(tanggal_masuk)', $bulan);
            $this->db->where('DAY(tanggal_masuk)', $hari);
        } elseif (($tahun != null) && ($bulan != null) && ($hari == null)) {
            $this->db->where('YEAR(tanggal_masuk)', $tahun);
            $this->db->where('MONTH(tanggal_masuk)', $bulan);
        } elseif (($tahun != null) && ($bulan == null) && ($hari == null)) {
            $this->db->where('YEAR(tanggal_masuk)', $tahun);
        }
        return $this->db->get();
    }
    public function LaporanPengembalian()
    {
        $this->db->select('t_user.id_user , t_user.username, t_user.role_id, t_siswa.*,t_guru.*,t_peminjaman.*,t_pengembalian.*,t_buku.*,t_admin.*');
        $this->db->from('t_peminjaman');
        $this->db->join('t_user', 't_user.id_user=t_peminjaman.id_user', 'left');
        $this->db->join('t_siswa', 't_siswa.id_user=t_user.id_user', 'left');
        $this->db->join('t_guru', 't_guru.id_user=t_user.id_user', 'left');
        $this->db->join('t_pengembalian', 't_pengembalian.id_peminjaman=t_peminjaman.id_peminjaman', 'left');
        $this->db->join('t_admin', 't_admin.id_admin=t_pengembalian.pengembalian_by', 'left');
        $this->db->join('t_buku', 't_buku.id_buku=t_peminjaman.id_buku', 'left');

        $this->db->where('status_pengembalian=1');
        return $this->db->get();
    }
    public function LaporanPeminjamanAll()
    {
        $this->db->select('t_user.id_user , t_user.username, t_user.role_id, t_siswa.*,t_guru.*,t_peminjaman.*,t_buku.*,t_admin.*');
        $this->db->from('t_peminjaman');
        $this->db->join('t_admin', 't_admin.id_admin=t_peminjaman.peminjaman_by', 'left');
        $this->db->join('t_user', 't_user.id_user=t_peminjaman.id_user', 'left');
        $this->db->join('t_siswa', 't_siswa.id_user=t_user.id_user', 'left');
        $this->db->join('t_guru', 't_guru.id_user=t_user.id_user', 'left');
        $this->db->join('t_buku', 't_buku.id_buku=t_peminjaman.id_buku', 'left');
        return $this->db->get();
    }
    public function KirimNotif()
    {
        $this->db->select('t_user.id_user , t_user.username, t_user.role_id, t_siswa.*,t_guru.*,t_peminjaman.*,t_buku.*,t_siswa.no_hp as hp_siswa,t_guru.no_hp as hp_guru');
        $this->db->from('t_peminjaman');
        $this->db->join('t_user', 't_user.id_user=t_peminjaman.id_user', 'left');
        $this->db->join('t_siswa', 't_siswa.id_user=t_user.id_user', 'left');
        $this->db->join('t_guru', 't_guru.id_user=t_user.id_user', 'left');
        $this->db->join('t_buku', 't_buku.id_buku=t_peminjaman.id_buku', 'left');
        $this->db->where('status_pengembalian=0');
        return $this->db->get();
    }

    public function AmbilTahun()
    {
        $this->db->select('YEAR(tanggal_pinjam)');
        $this->db->group_by('YEAR(tanggal_pinjam)');
        $this->db->from('t_peminjaman');
        return $this->db->get();
    }
    public function AmbilTahunBuku()
    {
        $this->db->select('YEAR(tanggal_masuk)');
        $this->db->group_by('YEAR(tanggal_masuk)');
        $this->db->from('t_buku');
        return $this->db->get();
    }
    public function get_data_onecol($table, $col)
    {
        $this->db->select($col);
        $this->db->from($table);
        return $this->db->get();
    }
    public function GetAllSiswa()
    {
        # code...
        $this->db->select('*');
        $this->db->from('t_siswa');
        $this->db->join('t_user', 't_user.id_user=t_siswa.id_user', 'left');
        return $this->db->get();
    }
    public function GetSiswa($id)
    {
        # code...
        $this->db->where('t_siswa.id_siswa', $id);
        $this->db->select('*');
        $this->db->from('t_siswa');
        $this->db->join('t_user', 't_user.id_user=t_siswa.id_user', 'left');
        return $this->db->get();
    }
    public function GetGuruId($id)
    {
        # code..
        $this->db->where('t_guru.id_guru', $id);
        $this->db->select('*');
        $this->db->from('t_guru');
        $this->db->join('t_user', 't_user.id_user=t_guru.id_user', 'left');
        return $this->db->get();
    }
    public function GetAllAdmin()
    {
        # code...

        $this->db->select('*');
        $this->db->from('t_admin');
        $this->db->join('t_user', 't_user.id_user=t_admin.id_user', 'left');
        return $this->db->get();
    }
    public function GetAdmin($id)
    {
        # code...
        $this->db->where('t_admin.id_admin', $id);
        $this->db->select('*');
        $this->db->from('t_admin');
        $this->db->join('t_user', 't_user.id_user=t_admin.id_user', 'left');
        return $this->db->get();
    }
    public function GetAllGuru()
    {
        # code...
        $this->db->select('*');
        $this->db->from('t_guru');
        $this->db->join('t_user', 't_user.id_user=t_guru.id_user', 'left');
        return $this->db->get();
    }
    public function GetAngkatan()
    {
        # code...
        $this->db->select('angkatan');
        $this->db->from('t_siswa');
        $this->db->group_by('angkatan');
        return $this->db->get();
    }
    public function getPenukaranData($id)
    {
        # code...
        $this->db->where('t_penukaran.id_penukaran', $id);
        $this->db->select('*');
        $this->db->from('t_penukaran');
        $this->db->join('t_siswa', 't_siswa.id_siswa=t_penukaran.id_siswa', 'left');
        $this->db->join('t_hadiah', 't_hadiah.id_hadiah=t_penukaran.id_hadiah', 'left');
        return $this->db->get();
    }
    public function getNotifikasi()
    {
        # code...
        $this->db->select('*');
        $this->db->from('t_notice');
        $this->db->join('t_peminjaman', 't_peminjaman.id_peminjaman=t_notice.id_peminjaman', 'left');
        $this->db->join('t_user', 't_user.id_user=t_peminjaman.id_user', 'left');
        $this->db->join('t_siswa', 't_siswa.id_user=t_user.id_user', 'left');
        $this->db->join('t_guru', 't_guru.id_user=t_user.id_user', 'left');



        // $this->db->join('t_hadiah', 't_hadiah.id_hadiah=t_penukaran.id_hadiah', 'left');
        return $this->db->get();
    }
    public function RegisterSiswa()
    {
        # code...
        $this->db->select('*');
        $this->db->from('t_aktivasi');
        $this->db->join('t_user', 't_user.id_user=t_aktivasi.id_user', 'left');
        $this->db->join('t_siswa', 't_siswa.id_user=t_user.id_user', 'left');
        $this->db->where('t_user.role_id', 1);

        return $this->db->get();
    }
    public function RegisterGuru()
    {
        # code...
        $this->db->select('*');
        $this->db->from('t_aktivasi');
        $this->db->join('t_user', 't_user.id_user=t_aktivasi.id_user', 'left');
        $this->db->join('t_guru', 't_guru.id_user=t_user.id_user', 'left');
        $this->db->where('t_user.role_id', 2);

        return $this->db->get();
    }

    public function LogPerpus()
    {
        # code...
        $this->db->select('*');
        $this->db->from('t_log');
        $this->db->join('t_user', 't_user.id_user=t_log.id_user', 'left');
        $this->db->join('t_siswa', 't_siswa.id_user=t_user.id_user', 'left');
        return $this->db->get();
    }
}
