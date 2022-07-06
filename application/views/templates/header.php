<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Mentor Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('assets/img/favicon.png') ?>" rel="icon">
    <link href="<?= base_url('assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/vendor/animate.css/animate.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/aos/aos.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Mentor - v4.7.0
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center ">
            <div class="row">
                <div class="col">
                    <div class="col-12 col-lg">
                        <h1 class="logo me-auto"><a href="index.html">Perpustakaan</a></h1>
                    </div>
                    <div class="col-12 col-lg">
                        <h1 class="logo me-auto"><a href="index.html">MAN 2 Ngawi</a></h1>
                    </div>
                </div>
            </div>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-lg-0 ms-auto">
                <ul>
                    <li><a class="<?php echo $this->uri->segment(1) == "Home" ?  "active" : '' ?>" href="<?= base_url('Home') ?>">Home</a></li>
                    <li><a class="<?php echo $this->uri->segment(1) == "Buku" ?  "active" : '' ?>" href="<?= base_url('Buku') ?>">Buku</a></li>
                    <li><a class="<?php echo $this->uri->segment(1) == "Ebook" ?  "active" : '' ?>" href="<?= base_url('Ebook') ?>">E-Book</a></li>
                    <li><a class="<?php echo $this->uri->segment(1) == "Events" ?  "active" : '' ?>" href="<?= base_url('Events') ?>">Events</a></li>
                    <li><a class="<?php echo $this->uri->segment(1) == "Tentang" ?  "active" : '' ?>" href="<?= base_url('Tentang') ?>">Profil Perpus</a></li>
                    <li><a href="#" onclick="modalcari()">Cari</a></li>
                    <?php if ($this->session->userdata('id_user') == null) : ?>

                        <li class="dropdown"><a href="#"><span>Masuk</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="<?= base_url('Login') ?>">Login</a></li>

                                <li><a href="<?= base_url('Register') ?>">Register</a></li>
                                <!-- <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li> -->
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="dropdown"><a href="#"><span>Akun</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 1) : ?>
                                    <li><a href="<?= base_url("Profile/DataDiri/" . $this->session->userdata('id_user')) ?>">Profil Akun</a></li>
                                <?php endif; ?>

                                <li><a href="<?= base_url('Home/Logout') ?>">Log Out</a></li>
                                <!-- <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li> -->
                            </ul>
                        </li>
                    <?php endif; ?>


                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>

            </nav>
            <div class="modal fade" id="modal_cari" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class=" modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cari</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form_caribuku" action="#" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <select id="jenis" class="form-select" aria-label="Default select example" required oninvalid="setCustomValidity('Pilih Salah Satu')" oninput="setCustomValidity('')">
                                        <option hidden disabled selected value="">Pilih Buku/Buku Elektorinik</option>
                                        <option value="1">Buku</option>
                                        <option value="2">Buku Elektronik</option>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <input id="name_buku" name="buku" type="text" class="form-control" required oninvalid="setCustomValidity('Masukan Inputan')" oninput="setCustomValidity('')" />

                                </div>
                                <input hidden type=" text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                <button type="submit" class="btn btn-success mt-2 w-100 ">Cari</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- .navbar -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

            <script>
                function modalcari() {
                    $('#modal_cari').appendTo("body").modal('show');
                    // console.log('tes')
                }
                document.getElementById("form_caribuku").addEventListener('submit', function(e) {
                    e.preventDefault();
                    let jenis = $('#jenis').val();
                    let nama = $('#name_buku').val();
                    if (parseInt(jenis) == 1) {
                        window.location.href = "<?= base_url('Buku/SearchBuku/') ?>" + nama;

                    } else {
                        window.location.href = "<?= base_url('Ebook/SearchEbook/') ?>" + nama;

                    }


                });
            </script>

        </div>
    </header>

    <script>

    </script>

    <!-- End Header -->