<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perpustakaan extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('role_id') != 77) {
            redirect('');
        }
        $this->id_admin = $this->db->get_where('t_admin', array('id_user' => $this->session->userdata('id_user')))->row()->id_admin;
    }
    public function DataPeminjaman()
    {
        $data['laporan'] = $this->Model_admin->LaporanPeminjamanAll()->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/datapeminjam', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function DataPengembalian()
    {
        $data['laporan'] = $this->Model_admin->LaporanPengembalian()->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/datapengembalian', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function Peminjaman()
    {
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/TambahPinjam');
        $this->load->view('Admin/templates/footer');
    }
    public function Pengembalian()
    {
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/Pengembalian');
        $this->load->view('Admin/templates/footer');
    }
    public function LaporanPeminjaman()
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $this->data['title_pdf'] = 'Laporan Peminjaman Perpustakaan MAN 2 Ngawi';

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_peminjaman';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $this->data['peminjaman'] = $this->Model_admin->LaporanPeminjaman()->result_array();
        $html = $this->load->view('Admin/laporan_peminjaman', $this->data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
    public function Kategori()
    {
        # code...
        $data['kategori'] = $this->db->get('t_kategori')->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/kategori', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function deleteKategori()
    {
        # code...
        $delete = $this->db->delete('t_kategori', array('id_kategori' => $this->input->post('id_kategori')));
        if ($delete) {
            $pesan = array('status' => 1, 'token' => $this->security->get_csrf_hash());

            echo json_encode($pesan);
        } else {
            $pesan = array('status' => 0, 'token' => $this->security->get_csrf_hash());

            echo json_encode($pesan);
        }
    }
    public function getKategori($id)
    {
        # code...
        $data['token'] = $this->security->get_csrf_hash();
        $data['kategori'] = $this->db->get_where('t_kategori', array('id_kategori' => $id))->row();
        echo json_encode($data);
    }
    public function UpdateKategori()
    {
        # code...
        $data_update = array(
            'nama_kategori' => $this->input->post('nama_kategori'),
        );
        $whereupdate = array(
            'id_kategori' => $this->input->post('id_kategori')
        );
        $this->Model_admin->edit_data($whereupdate, $data_update, 't_kategori');
        $this->session->set_flashdata(
            'kategori',
            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Sukses DI Update","success");</script>'
        );
        redirect('Admin/Perpustakaan/Kategori');
    }
    public function TambahKategori()
    {
        # code...
        $data = array(
            'nama_kategori' => $this->input->post('nama_kategori'),


        );
        $this->Model_admin->Tambah_data($data, 't_kategori');
        $this->session->set_flashdata(
            'kategori',
            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Sukses Ditambah","success");</script>'
        );
        redirect('Admin/Perpustakaan/Kategori');
    }
    public function BukuHilang()
    {
        # code...
        $data['all'] = $this->Model_admin->double_where()->result_array();
        $data['buku'] = $this->db->get('t_buku')->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/buku_hilang', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function TambahBukuHilang()
    {
        # code...
        $id = $this->input->post('id_buku');
        $data_update = array(
            'status_buku' => 66
        );
        $whereupdate = array(
            'id_buku' => $id
        );
        $this->Model_admin->edit_data($whereupdate, $data_update, 't_buku');
        $this->session->set_flashdata(
            'buku_hilang',
            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Sukses","success");</script>'
        );
        redirect('Admin/Perpustakaan/BukuHilang');
    }
    public function PeminjamanBuku()
    {
        # code...
        $data['guru'] =  $this->Model_admin->getGuru()->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/peminjamanperpus', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function getSiswa()
    {
        # code...
        $code = $this->input->post('code');
        $data = $this->Model_admin->GetSiswaByNisn($code)->row();
        if ($data != null) {
            $message = array(
                'status' => true,
                'data' => $data,
                'token' => $this->security->get_csrf_hash()
            );
        } else {
            $message = array(
                'status' => false,
                'data' => "Siswa Tidak Ditemukan",
                'token' => $this->security->get_csrf_hash()

            );
        }
        echo json_encode($message);
    }
    public function getGuru()
    {
        # code...
        $code = $this->input->post('id_user');
        $data = $this->Model_admin->GetGuruId($code)->row();
        if ($data != null) {
            $message = array(
                'status' => true,
                'data' => $data,
                'token' => $this->security->get_csrf_hash()
            );
        } else {
            $message = array(
                'status' => false,
                'data' => "Guru Tidak Ditemukan",
                'token' => $this->security->get_csrf_hash()

            );
        }
        echo json_encode($message);
    }
    public function getBuku()
    {
        # code...
        $code = $this->input->post('idbuku');
        $token = $this->security->get_csrf_hash();
        $data = $this->db->get_where('t_buku', array('id_buku' => $code))->row();
        if ($data != null) {
            $data_array = array(
                'status' => true,
                'message' => $data,
                'token' => $token
            );
        } else {
            $data_array = array(
                'status' => false,
                'message' => "Kosong",
                'token' => $token
            );
        }
        echo json_encode($data_array);
    }
    public function BukuPinjam()
    {
        # code...
        $lama_pinjam = $this->input->post('lama_pinjam');
        $id_user = $this->input->post('id_user');
        $data = array();
        $buku = $this->input->post('buku');
        foreach ($buku as $bk) {
            $code = explode("-", $bk);
            $data[] = $code[0];
        }
        if ($lama_pinjam == 3) {
            $tgl_pengembalian = date('Y-m-d', strtotime('+3 days'));
        } elseif ($lama_pinjam == 5) {
            $tgl_pengembalian = date('Y-m-d', strtotime('+5 days'));
        } elseif ($lama_pinjam == 7) {
            $tgl_pengembalian = date('Y-m-d', strtotime('+7 days'));
        } else {
            echo "error";
        }

        foreach ($data as $dt) {
            $data = array(
                'id_user' => $id_user,
                'id_buku' => $dt,
                'tanggal_pinjam' => date('Y-m-d'),
                'tanggal_pengembalian' => $tgl_pengembalian,
                'peminjaman_by' => $this->id_admin

            );
            $this->Model_admin->Tambah_data($data, 't_peminjaman');

            $data_update = array(
                'status_buku' => 1,
            );
            $whereid = array(
                'id_buku' => $dt
            );
            $this->Model_admin->edit_data($whereid, $data_update, 't_buku');
        }
        $this->session->set_flashdata(
            'peminjaman_buku',
            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Sukses","success");</script>'
        );
        redirect('Admin/Perpustakaan/PeminjamanBuku');
    }
    public function getPeminjaman()
    {
        # code...
        $id = $this->input->post('id');
        $token = $this->security->get_csrf_hash();
        $datapinjam = $this->Model_admin->getPeminjaman($id)->result_array();
        $data = array(
            'peminjaman' => $datapinjam,
            'token' => $token
        );
        echo json_encode($data);
    }
    public function KembaliBuku()
    {
        # code...
        $data_peminjaman = $this->db->get_where('t_peminjaman', array('id_peminjaman' => $this->input->post('id_peminjaman')))->row();
        $aktifasi = $this->db->get_where('t_setup', array('nama_fitur' => 'coin'))->row()->status_fitur;
        if ($aktifasi == 1) {
            $id_user = $this->db->get_where('t_peminjaman', array('id_peminjaman' => $this->input->post('id_peminjaman')))->row()->id_user;
            $role_id = $this->db->get_where('t_user', array('id_user' => $id_user))->row()->role_id;
            if ($role_id == 1) {
                $siswa = $this->db->get_where('t_siswa', array('id_user' => $id_user))->row();
                $data_coin = array(
                    "coin" => $siswa->coin + 2
                );
                $data_where = array(
                    'id_siswa' => $siswa->id_siswa
                );
                $this->Model_admin->edit_data($data_where, $data_coin, 't_siswa');
            }
        }
        $data = array(
            'id_peminjaman' => $this->input->post('id_peminjaman'),
            'tgl_pengembalian' => date('Y-m-d'),
            'pengembalian_by' => $this->id_admin

        );
        $this->Model_admin->Tambah_data($data, 't_pengembalian');

        $data_update = array(
            'status_buku' => 0,
        );
        $whereid = array(
            'id_buku' => $data_peminjaman->id_buku
        );
        $this->Model_admin->edit_data($whereid, $data_update, 't_buku');
        $data_status = array(
            'status_pengembalian' => 1
        );
        $where_status = array(
            'id_peminjaman' => $this->input->post('id_peminjaman')
        );
        $this->Model_admin->edit_data($where_status, $data_status, 't_peminjaman');

        $data_send = array(
            'status' => true,
            'token' => $this->security->get_csrf_hash(),
        );
        echo json_encode($data_send);
    }
    public function KembalikanSemuaBuku()
    {
        # code...
        $idpeminjaman = $this->input->post('id_peminjaman');
        foreach ($idpeminjaman as $pjm) {
            $data_peminjaman = $this->db->get_where('t_peminjaman', array('id_peminjaman' => $pjm))->row();
            $aktifasi = $this->db->get_where('t_setup', array('nama_fitur' => 'coin'))->row()->status_fitur;
            if ($aktifasi == 1) {
                $id_user = $this->db->get_where('t_peminjaman', array('id_peminjaman' => $pjm))->row()->id_user;
                $role_id = $this->db->get_where('t_user', array('id_user' => $id_user))->row()->role_id;
                if ($role_id == 1) {
                    $siswa = $this->db->get_where('t_siswa', array('id_user' => $id_user))->row();
                    $data_coin = array(
                        "coin" => $siswa->coin + 2
                    );
                    $data_where = array(
                        'id_siswa' => $siswa->id_siswa
                    );
                    $this->Model_admin->edit_data($data_where, $data_coin, 't_siswa');
                }
            }
            $data = array(
                'id_peminjaman' => $pjm,
                'tgl_pengembalian' => date('Y-m-d'),
                'pengembalian_by' => $this->id_admin

            );
            $this->Model_admin->Tambah_data($data, 't_pengembalian');

            $data_update = array(
                'status_buku' => 0,
            );
            $whereid = array(
                'id_buku' => $data_peminjaman->id_buku
            );
            $this->Model_admin->edit_data($whereid, $data_update, 't_buku');
            $data_status = array(
                'status_pengembalian' => 1
            );
            $where_status = array(
                'id_peminjaman' => $pjm
            );
            $this->Model_admin->edit_data($where_status, $data_status, 't_peminjaman');
        }
        $this->session->set_flashdata(
            'peminjaman_buku',
            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Sukses","success");</script>'
        );
        redirect('Admin/Perpustakaan/PeminjamanBuku');
    }
}
