<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perpustakaan extends CI_Controller
{
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
}
