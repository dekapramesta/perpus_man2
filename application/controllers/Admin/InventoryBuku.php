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
        $this->id_admin = $this->db->get_where('t_admin', array('id_user' => $this->session->userdata('id_user')))->row()->id_admin;
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
    public function PenambahanBuku()
    {
        # code...
        $data['kategori'] = $this->db->get('t_kategori')->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/penambahan_buku', $data);
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
                $kategori = implode(',', $this->input->post('kategori', TRUE));
                $cover = $_FILES['cover']['name'];
                if ($cover != null) {
                    $config['upload_path'] = './assets/img/CoverBuku/';
                    $config['allowed_types'] = 'jpg|png|jpeg|gif';

                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('cover')) {
                        $cover = $this->upload->data('file_name');
                    } else {
                        $this->session->set_flashdata(
                            'penambahan_buku',
                            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Gagal","Gagal","error");</script>'
                        );
                        redirect('Admin/InventoryBuku/PenambahanBuku');
                    }
                }
            }
            $this->load->library('zend');
            $this->zend->load('Zend/Barcode');
            $file = Zend_Barcode::draw('code128', 'image', array('text' => $Primary_Barcode), array());
            $code = time() . $Primary_Barcode;
            imagepng($file, "./assets/img/Barcode/{$code}.png");
            // return $code . '.png';
            $data = array(
                'id_buku' => trim(preg_replace('/\\s+/', ' ', $Primary_Barcode)),
                'judul_buku' => $judul,
                'kategori' => $kategori,
                'kode_buku' => $isbn_code,
                'sinopsis' => $desc,
                'penulis' => $penulis,
                'tahun_terbit' => $tahun_terbit,
                'tanggal_masuk' => $tanggal_masuk,
                'lokasi_buku' => $this->input->post('lokasi_buku'),
                'halaman' => $halaman,
                'cover_buku' => $cover,
                'status_buku' => 0,
                'src_book' => $src_book,
                'barcode_pic' => $code . '.png',
                'insert_by' => $this->id_admin
            );


            $this->Model_admin->Tambah_data($data, 't_buku');
            $this->session->set_flashdata(
                'penambahan_buku',
                '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Sukses","success");</script>'
            );
            redirect('Admin/InventoryBuku/PenambahanBuku');
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
                    $kategori = implode(',', $this->input->post('kategori', TRUE));

                    $cover = $_FILES['cover']['name'];
                    if ($cover != null) {
                        $config['upload_path'] = './assets/img/CoverBuku/';
                        $config['allowed_types'] = 'jpg|png|jpeg|gif';

                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('cover')) {
                            $cover = $this->upload->data('file_name');
                        } else {
                            $this->session->set_flashdata(
                                'penambahan_buku',
                                '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Gagal","Gagal","error");</script>'
                            );
                            redirect('Admin/InventoryBuku/PenambahanBuku');
                        }
                    }
                }
                $this->load->library('zend');
                $this->zend->load('Zend/Barcode');
                $file = Zend_Barcode::draw('code128', 'image', array('text' => $Primary_Barcode), array());
                $code = time() . $Primary_Barcode;
                imagepng($file, "./assets/img/Barcode/{$code}.png");
                $data = array(
                    'id_buku' => trim(preg_replace('/\\s+/', ' ', $Primary_Barcode)),
                    'judul_buku' => $judul,
                    'kategori' => $kategori,
                    'kode_buku' => $isbn_code,
                    'sinopsis' => $desc,
                    'penulis' => $penulis,
                    'tahun_terbit' => $tahun_terbit,
                    'tanggal_masuk' => $tanggal_masuk,
                    'lokasi_buku' => $this->input->post('lokasi_buku'),
                    'halaman' => $halaman,
                    'cover_buku' => $cover,
                    'status_buku' => 0,
                    'src_book' => $src_book,
                    'barcode_pic' => $code . '.png',
                    'insert_by' => $this->id_admin

                );
                $this->Model_admin->Tambah_data($data, 't_buku');
            }
            $this->session->set_flashdata(
                'penambahan_buku',
                '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Sukses","success");</script>'
            );
            redirect('Admin/InventoryBuku/PenambahanBuku');
        }
    }
    public function DetailBuku($idbuku)
    {
        $databuku = $this->db->get_where('t_buku', array('id_buku' => $idbuku))->row();
        $admin = $this->db->get_where('t_admin', array('id_admin' => $databuku->insert_by))->row();

        $data['category'] = $this->db->get('t_kategori')->result_array();
        if ($databuku->status_buku == 1) {
            $data['buku'] = $this->Model_admin->DetailBuku($idbuku)->row();
        } else {
            $data['buku'] = $databuku;
        }
        $data['admin'] = $admin;
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
        $file = $_FILES['cover_buku']['name'];
        if ($file == null) {
            if (!$this->upload->do_upload('cover_buku')) {
                $data_update = array(
                    'judul_buku' => $judul_buku,
                    'kategori' => $kategori,
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
                    'sinopsis' => $sinopsis,
                    'penulis' => $penulis,
                    'tahun_terbit' => $tahun_terbit,
                    'tanggal_masuk' => $tanggal_masuk,
                    'halaman' => $halaman,
                    'status_buku' => $status_buku,
                    'cover_buku' => $cover

                );
            }
        } else {
            if (!$this->upload->do_upload('cover_buku')) {
                $this->session->set_flashdata(
                    'admin_buku',
                    '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Gagal","Gagal","error");</script>'
                );
                redirect('Admin/InventoryBuku/DetailBuku/' . $id_buku);
            } else {
                $cover = $this->upload->data('file_name');
                $data_update = array(
                    'judul_buku' => $judul_buku,
                    'kategori' => $kategori,
                    'sinopsis' => $sinopsis,
                    'penulis' => $penulis,
                    'tahun_terbit' => $tahun_terbit,
                    'tanggal_masuk' => $tanggal_masuk,
                    'halaman' => $halaman,
                    'status_buku' => $status_buku,
                    'cover_buku' => $cover

                );
            }
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
            'kode_buku' => $kode_buku
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
        $this->session->set_flashdata(
            'admin_buku',
            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Sukses","success");</script>'
        );

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
        $id_guru = $this->input->post('id_guru');
        $id_user = $this->input->post('barcode_siswa');
        if ($id_guru != null) {
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
                'id_user' => $id_guru,
                'id_buku' => $id_buku,
                'tanggal_pinjam' => date('Y-m-d'),
                'tanggal_pengembalian' => $tgl_pengembalian,
                'peminjaman_by' => $this->id_admin

            );
            $this->Model_admin->Tambah_data($data, 't_peminjaman');

            $data_update = array(
                'status_buku' => 1,
            );
            $whereid = array(
                'id_buku' => $id_buku
            );
            $this->Model_admin->edit_data($whereid, $data_update, 't_buku');
        } elseif ($id_user != null) {
            $id_siswa = $this->db->get_where('t_siswa', array('nisn' => $id_user))->row()->id_user;
            if ($id_siswa == null) {
                $this->session->set_flashdata(
                    'admin_peminjaman',
                    '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Gagal","Siswa Tdak Ditemukan","error");</script>'
                );
                redirect('Admin/Perpustakaan/DataPeminjaman');
            }
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
                'id_user' => $id_siswa,
                'id_buku' => $id_buku,
                'tanggal_pinjam' => date('Y-m-d'),
                'tanggal_pengembalian' => $tgl_pengembalian,
                'peminjaman_by' => $this->id_admin

            );
            $this->Model_admin->Tambah_data($data, 't_peminjaman');

            $data_update = array(
                'status_buku' => 1,
            );
            $whereid = array(
                'id_buku' => $id_buku
            );
            $this->Model_admin->edit_data($whereid, $data_update, 't_buku');
        }
        $this->session->set_flashdata(
            'admin_peminjaman',
            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Peminjaman","success");</script>'
        );
        redirect('Admin/Perpustakaan/DataPeminjaman');
        // var_dump($data);
        // die;
    }

    public function KembaliBuku()
    {
        // $id_buku = $this->input->post('barcode_return');
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
        $this->session->set_flashdata(
            'admin_pengembalian',
            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Data bertambah","success");</script>'
        );
        redirect('Admin/Perpustakaan/DataPengembalian');
    }
    public function getGuru()
    {
        $data['token'] = $this->security->get_csrf_hash();
        $data['guru'] = $this->Model_admin->getGuru()->result_array();
        echo json_encode($data);
    }
    public function CetakBarcode()
    {
        $data['buku'] = $this->Model_user->get_data_home('t_buku')->result_array();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar');
        $this->load->view('Admin/cetak_barcode', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function CetakBarcodeBuku()
    {

        $data_buku = $this->input->post('buku', TRUE);
        $buku = array();
        foreach ($data_buku as $dt) {
            $buku[] = $this->db->get_where('t_buku', array('judul_buku' => $dt))->result_array();
        }
        // foreach ($buku as $bk) {
        //     foreach ($bk as $bl) {
        //         echo $bl['judul_buku'];
        //     }
        // }
        // die;
        // var_dump($buku);
        // die;
        $this->data['buku'] = $buku;

        $this->load->library('pdfgenerator');

        // title dari pdf
        $this->data['title_pdf'] = 'Cetak Buku Perpustakaan MAN 2 Ngawi';

        // filename dari pdf ketika didownload
        $file_pdf = 'cetak_barcode';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = $this->load->view('admin/barcode_buku', $this->data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
    public function BarcodeCetak($code)
    {
        $this->load->library('zend');
        // Load in folder Zend
        $this->zend->load('Zend/Barcode');
        // Generate barcode
        Zend_Barcode::render('code128', 'image', array('text' => $code), array('imageType' => 'png'));
    }
    public function deleteBook()
    {
        # code...
        $delete = $this->db->delete('t_buku', array('id_buku' => $this->input->post('id_buku')));
        if ($delete) {
            $pesan = array('status' => 1, 'token' => $this->security->get_csrf_hash());

            echo json_encode($pesan);
        } else {
            $pesan = array('status' => 0, 'token' => $this->security->get_csrf_hash());

            echo json_encode($pesan);
        }
    }
    public function BukuPinjamHilang()
    {
        # code...

        $id_buku = $this->input->post('id_buku');
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
        echo json_encode($data);
    }
    public function HilangPeminjaman()
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
        $data_status = array(
            'status_pengembalian' => 99
        );
        $where_status = array(
            'id_peminjaman' => $this->input->post('id_peminjaman')
        );
        $this->Model_admin->edit_data($where_status, $data_status, 't_peminjaman');
        echo json_encode(1);
    }
}
