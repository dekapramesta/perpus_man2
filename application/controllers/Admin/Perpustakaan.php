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
        $html = $this->load->view('admin/laporan_peminjaman', $this->data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
