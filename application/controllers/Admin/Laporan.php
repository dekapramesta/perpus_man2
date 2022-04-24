<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function LaporanPeminjaman()
    {
        $data['tahun'] =  $this->Model_admin->AmbilTahun()->result_array();
        // var_dump($data['tahun']);
        // die;
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/cetak_peminjaman', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function CetakLaporanPinjam()
    {
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        $hari = $this->input->post('hari');

        $this->load->library('pdfgenerator');

        // title dari pdf
        $this->data['title_pdf'] = 'Laporan Peminjaman Perpustakaan MAN 2 Ngawi';

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_peminjaman';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        if (($tahun != null) && ($bulan != null) && ($hari != null)) {
            $this->data['peminjaman'] = array_chunk($this->Model_admin->LaporanPeminjaman($tahun, $bulan, $hari)->result_array(), 7);
        } elseif (($tahun != null) && ($bulan != null) && ($hari == null)) {
            $this->data['peminjaman'] = array_chunk($this->Model_admin->LaporanPeminjaman($tahun, $bulan, 0)->result_array(), 7);
        } elseif (($tahun != null) && ($bulan == null) && ($hari == null)) {
            $this->data['peminjaman'] = array_chunk($this->Model_admin->LaporanPeminjaman($tahun, 0, 0)->result_array(), 7);
        }
        $html = $this->load->view('admin/laporan_peminjaman', $this->data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
    public function LaporanPengembalian()
    {
        $data['laporan'] = $this->Model_admin->LaporanPeminjaman()->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/laporan_pengembalian', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function BukuMasuk()
    {
        $data['tahun'] =  $this->Model_admin->AmbilTahunBuku()->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/lap_bukumasuk', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function CetakBukuMasuk()
    {
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        $hari = $this->input->post('hari');
        $this->load->library('pdfgenerator');

        // title dari pdf
        $this->data['title_pdf'] = 'Laporan Buku Masuk Perpustakaan MAN 2 Ngawi';

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_buku_masuk';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        if (($tahun != null) && ($bulan != null) && ($hari != null)) {
            $this->data['buku'] = array_chunk($this->Model_admin->LaporanBuku($tahun, $bulan, $hari)->result_array(), 7);
        } elseif (($tahun != null) && ($bulan != null) && ($hari == null)) {
            $this->data['buku'] = array_chunk($this->Model_admin->LaporanBuku($tahun, $bulan, 0)->result_array(), 7);
        } elseif (($tahun != null) && ($bulan == null) && ($hari == null)) {
            $this->data['buku'] = array_chunk($this->Model_admin->LaporanBuku($tahun, 0, 0)->result_array(), 7);
        }
        $html = $this->load->view('admin/laporan_buku', $this->data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
    // public function LaporanPeminjaman()
    // {
    //     // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
    //     $this->load->library('pdfgenerator');

    //     // title dari pdf
    //     $this->data['title_pdf'] = 'Laporan Peminjaman Perpustakaan MAN 2 Ngawi';

    //     // filename dari pdf ketika didownload
    //     $file_pdf = 'laporan_peminjaman';
    //     // setting paper
    //     $paper = 'A4';
    //     //orientasi paper potrait / landscape
    //     $orientation = "portrait";
    //     $this->data['peminjaman'] = $this->Model_admin->LaporanPeminjaman()->result_array();
    //     $html = $this->load->view('admin/laporan_peminjaman', $this->data, true);

    //     // run dompdf
    //     $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    // }
}
