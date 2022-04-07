<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InventoryBuku extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('role_id') != 77) {
            redirect('');
        }
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $data['getAllBook'] = $this->db->get('t_buku')->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/buku', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function TambahBuku()
    {
        $dup_num = $this->input->post('dup_number');
        if ($dup_num == NULL) {
            $isbn_code = $this->input->post('isbn_code');
            $desc = $this->input->post('desc');
            $penulis = $this->input->post('penulis');
            $tahun_terbit = $this->input->post('tahun_terbit');
            $tanggal_masuk = date('Y-m-d');
            $halaman = $this->input->post('halaman');

            $judul = $this->input->post('judul');
            $Primary_Barcode = strtoupper(substr($judul, 0, 2))  . rand(100000, 999999);

            $src_book = $this->input->post('src_book');
            if ($src_book == 0) {
                $cover = $this->input->post('cover');
                $kategori = implode(',', $this->input->post('kategori', TRUE));
            } else {
                $kategori = $this->input->post('kategori');
                $cover = $_FILES['cover']['name'];
                if ($cover != null) {
                    $config['upload_path'] = './assets/img/CoverBuku/';
                    $config['allowed_types'] = 'jpg|png|jpeg|gif';

                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('cover')) {
                        $cover = $this->upload->data('file_name');
                    }
                }
            }
            $data = array(
                'id_buku' => $Primary_Barcode,
                'judul_buku' => $judul,
                'kategori' => $kategori,
                'kode_buku' => $isbn_code,
                'sinopsis' => $desc,
                'penulis' => $penulis,
                'tahun_terbit' => $tahun_terbit,
                'tanggal_masuk' => $tanggal_masuk,
                'halaman' => $halaman,
                'cover_buku' => $cover,
                'status_buku' => 0,
                'src_book' => $src_book
            );
            $this->Model_admin->Tambah_data($data, 't_buku');
            redirect('Admin/InventoryBuku');
        } elseif ($dup_num > 1) {
            for ($x = 0; $x < $dup_num; $x++) {
                $isbn_code = $this->input->post('isbn_code');
                $desc = $this->input->post('desc');
                $penulis = $this->input->post('penulis');
                $tahun_terbit = $this->input->post('tahun_terbit');
                $tanggal_masuk = date('Y-m-d');
                $halaman = $this->input->post('halaman');

                $judul = $this->input->post('judul');
                $Primary_Barcode = strtoupper(substr($judul, 0, 2))  . rand(100000, 999999);

                $src_book = $this->input->post('src_book');
                if ($src_book == 0) {
                    $cover = $this->input->post('cover');
                    $kategori = implode(',', $this->input->post('kategori', TRUE));
                } else {
                    $kategori = $this->input->post('kategori');
                    $cover = $_FILES['cover']['name'];
                    if ($cover != null) {
                        $config['upload_path'] = './assets/img/CoverBuku/';
                        $config['allowed_types'] = 'jpg|png|jpeg|gif';

                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('cover')) {
                            $cover = $this->upload->data('file_name');
                        }
                    }
                }
                $data = array(
                    'id_buku' => $Primary_Barcode,
                    'judul_buku' => $judul,
                    'kategori' => $kategori,
                    'kode_buku' => $isbn_code,
                    'sinopsis' => $desc,
                    'penulis' => $penulis,
                    'tahun_terbit' => $tahun_terbit,
                    'tanggal_masuk' => $tanggal_masuk,
                    'halaman' => $halaman,
                    'cover_buku' => $cover,
                    'status_buku' => 0,
                    'src_book' => $src_book
                );
                $this->Model_admin->Tambah_data($data, 't_buku');
            }
            redirect('Admin/InventoryBuku');
        }
    }
    public function DetailBuku($idbuku)
    {
        $databuku = $this->db->get_where('t_buku', array('id_buku' => $idbuku))->row();
        $data['category'] = $this->db->get('t_kategori')->result_array();
        if ($databuku->status_buku == 1) {
            $data['buku'] = $this->Model_admin->DetailBuku($idbuku)->row();
        } else {
            $data['buku'] = $databuku;
        }
        // var_dump($data);
        // die;
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/detailbuku', $data);
        $this->load->view('Admin/templates/footer');
    }
    // public function IfUnavalaible()
    // {
    //     echo json_encode('tes');
    // }
    public function Barcode($code)
    {
        $this->load->library('zend');
        // Load in folder Zend
        $this->zend->load('Zend/Barcode');
        // Generate barcode
        Zend_Barcode::render('code128', 'image', array('text' => $code), array());
    }
    public function EditBuku($id_buku)
    {
        $judul_buku = $this->input->post('judul');
        $kategori =  implode(',', $this->input->post('kategori', TRUE));
        $kode_buku = $this->input->post('isbn_code');
        $sinopsis = $this->input->post('sinopsis');
        $penulis = $this->input->post('penulis');
        $tahun_terbit = $this->input->post('tahun_terbit');
        $tanggal_masuk = $this->input->post('tanggal_masuk');
        $halaman = $this->input->post('halaman');
        $status_buku = $this->input->post('status_buku');


        $config['upload_path'] = './assets/img/CoverBuku/';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('cover_buku')) {
            $data_update = array(
                'judul_buku' => $judul_buku,
                'kategori' => $kategori,
                'kode_buku' => $kode_buku,
                'sinopsis' => $sinopsis,
                'penulis' => $penulis,
                'tahun_terbit' => $tahun_terbit,
                'tanggal_masuk' => $tanggal_masuk,
                'halaman' => $halaman,
                'status_buku' => $status_buku,

            );
        } else {
            $cover = $this->upload->data('file_name');
            $data_update = array(
                'judul_buku' => $judul_buku,
                'kategori' => $kategori,
                'kode_buku' => $kode_buku,
                'sinopsis' => $sinopsis,
                'penulis' => $penulis,
                'tahun_terbit' => $tahun_terbit,
                'tanggal_masuk' => $tanggal_masuk,
                'halaman' => $halaman,
                'status_buku' => $status_buku,
                'cover_buku' => $cover

            );
        }

        // if ($cover_buku == null) {
        //     $data_update = array(
        //         'judul_buku' => $judul_buku,
        //         'kategori' => $kategori,
        //         'kode_buku' => $kode_buku,
        //         'sinopsis' => $sinopsis,
        //         'penulis' => $penulis,
        //         'tahun_terbit' => $tahun_terbit,
        //         'tanggal_masuk' => $tanggal_masuk,
        //         'halaman' => $halaman,
        //         'status_buku' => $status_buku
        //     );
        //     echo "tes";
        //     die;
        // } else {
        //     $config['upload_path'] = './assets/img/CoverBuku/';
        //     $config['allowed_types'] = 'jpg|png|jpeg|gif';

        //     $this->load->library('upload', $config);
        //     if ($this->upload->do_upload('cover_buku')) {
        //         $cover_buku = $this->upload->data('file_name');
        //     }
        //     $data_update = array(
        //         'judul_buku' => $judul_buku,
        //         'kategori' => $kategori,
        //         'kode_buku' => $kode_buku,
        //         'sinopsis' => $sinopsis,
        //         'penulis' => $penulis,
        //         'tahun_terbit' => $tahun_terbit,
        //         'tanggal_masuk' => $tanggal_masuk,
        //         'halaman' => $halaman,
        //         'status_buku' => $status_buku,
        //         'cover_buku' => $cover_buku
        //     );
        //     echo "cko";
        //     die;
        // }
        $whereid = array(
            'id_buku' => $id_buku
        );

        // $data_update = array(
        //     'id_register' => $id_register,
        //     'nisn' => $nisn,
        //     'nama' => $nama,
        //     'no_wa' => $no_wa,
        //     'barcode' => $barcode,
        //     'status_daftar' => $status,
        //     'code' => $code
        // );
        // $whereid = array(
        //     'id_register' => $id_register
        // );
        $this->Model_admin->edit_data($whereid, $data_update, 't_buku');
        redirect('Admin/InventoryBuku/DetailBuku/' . $id_buku);
        // var_dump($data);
        // die;
    }
    public function getBook()
    {
        $idbuku = $this->input->post('barcode_book');
        $data['token'] = $this->security->get_csrf_hash();
        $data['buku'] = null;
        $databuku = $this->db->get_where('t_buku', array('id_buku' => $idbuku))->row();
        if ($databuku) {
            if ($databuku->status_buku == 0) {
                $data['buku'] = $databuku;
            } elseif ($databuku->status_buku == 7) {
                $data['buku'] = "booking";
            } else {
                $data['buku'] = 'unavailable';
            }
        } else {
            $data['buku'] = false;
        }

        echo json_encode($data);
    }
    public function getBookReturn()
    {
        $id_buku = $this->input->post('barcode_book');
        $data['token'] = $this->security->get_csrf_hash();
        $databuku = $this->Model_admin->returnBook($id_buku)->result_array();
        if ($databuku) {
            $data['buku'] = false;
            foreach ($databuku as $dt) {
                if ($dt['status_pengembalian'] == 0) {
                    if ($dt['status_buku'] == 1) {
                        $startTimeStamp = strtotime($dt['tanggal_pinjam']);
                        $endTimeStamp = strtotime($dt['tanggal_pengembalian']);

                        $timeDiff = abs($endTimeStamp - $startTimeStamp);

                        $numberDays = $timeDiff / 86400;
                        $lamapinjam = intval($numberDays);
                        $data['buku'] = array('lamapinjam' => $lamapinjam, 'peminjaman' => $dt);
                    }
                }
            };
        } else {
            $data['buku'] = false;
        }



        // if ($databuku) {
        //     if ($databuku->status_buku == 1) {
        //         $startTimeStamp = strtotime($databuku->tanggal_pinjam);
        //         $endTimeStamp = strtotime($databuku->tanggal_pengembalian);

        //         $timeDiff = abs($endTimeStamp - $startTimeStamp);

        //         $numberDays = $timeDiff / 86400;  // 86400 seconds in one day

        //         // and you might want to convert to integer
        //         $data['lamapinjam'] = intval($numberDays);
        //         $data['buku'] = $databuku;
        //     } else {
        //         $data['buku'] = "Tersedia";
        //     }
        // } else {
        // }
        echo json_encode($data);
    }
    public function PinjamBuku()
    {
        $id_user = $this->input->post('barcode_siswa');
        $id_buku = $this->input->post('barcode_buku');
        $lama_pinjam = $this->input->post('lama_pinjam');
        if ($lama_pinjam == 3) {
            $tgl_pengembalian = date('Y-m-d', strtotime('+3 days'));
        } elseif ($lama_pinjam == 5) {
            $tgl_pengembalian = date('Y-m-d', strtotime('+5 days'));
        } elseif ($lama_pinjam == 7) {
            $tgl_pengembalian = date('Y-m-d', strtotime('+7 days'));
        } else {
            echo "error";
        }
        $status = $this->input->post('booking');
        if ($status == 1) {
            $booking_update = array(
                'status_pesan' => 1,
            );
            $wherebooking = array(
                'id_booking' => $this->input->post('id_booking')
            );
            $this->Model_admin->edit_data($wherebooking, $booking_update, 't_booking');
        }

        $data = array(
            'id_user' => $id_user,
            'id_buku' => $id_buku,
            'tanggal_pinjam' => date('Y-m-d'),
            'tanggal_pengembalian' => $tgl_pengembalian
        );
        $this->Model_admin->Tambah_data($data, 't_peminjaman');

        $data_update = array(
            'status_buku' => 1,
        );
        $whereid = array(
            'id_buku' => $id_buku
        );
        $this->Model_admin->edit_data($whereid, $data_update, 't_buku');
        redirect('Admin/InventoryBuku');

        // var_dump($data);
        // die;
    }

    public function KembaliBuku()
    {
        // $id_buku = $this->input->post('barcode_return');
        $data = array(
            'id_peminjaman' => $this->input->post('id_peminjaman'),
            'tgl_pengembalian' => date('Y-m-d'),
        );
        $this->Model_admin->Tambah_data($data, 't_pengembalian');

        $data_update = array(
            'status_buku' => 0,
        );
        $whereid = array(
            'id_buku' => $this->input->post('barcode_return')
        );
        $this->Model_admin->edit_data($whereid, $data_update, 't_buku');
        $data_status = array(
            'status_pengembalian' => 1
        );
        $where_status = array(
            'id_peminjaman' => $this->input->post('id_peminjaman')
        );
        $this->Model_admin->edit_data($where_status, $data_status, 't_peminjaman');
        redirect('Admin/InventoryBuku');
    }
}
