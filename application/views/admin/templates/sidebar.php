<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"> <span class="logo-name ">Admin</span>
            </a>
        </div>
        <ul class="sidebar-menu">

            <li class="menu-header">Menu</li>
            <li class="dropdown ">
                <a href="<?= base_url('Admin/Home') ?>" class="nav-link "><i data-feather="home"></i><span>Dashboard</span></a>
                <!-- <a href="<?= base_url('Admin/TukarCoin') ?>" class="nav-link "><i data-feather="monitor"></i><span>Registrasi Siswa</span></a> -->
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="briefcase"></i><span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url('Admin/InventoryBuku') ?>">Buku</a></li>
                    <li><a class="nav-link" href="<?= base_url('Admin/InventoryPdf') ?>">PDF</a></li>

                    <!-- <li><a class="nav-link" href="blog.html">Buku Masuk</a></li> -->
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="book"></i><span>Perpustakaan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url('Admin/Perpustakaan/DataPeminjaman') ?>">Peminjaman</a></li>
                    <li><a class="nav-link" href="<?= base_url('Admin/Perpustakaan/DataPengembalian') ?>">Pengembalian</a></li>
                    <li><a class="nav-link" href="<?= base_url('Admin/Booking') ?>">Booking</a></li>
                    <li><a class="nav-link" href="<?= base_url('Admin/InventoryBuku/CetakBarcode') ?>">Cetak Barcode</a></li>
                    <li><a class="nav-link" href="<?= base_url('Admin/Perpustakaan/Kategori') ?>">Kategori</a></li>


                    <!-- <li><a class="nav-link" href="blog.html">Buku Masuk</a></li> -->
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="clipboard"></i><span>Laporan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url('Admin/Laporan/LaporanPeminjaman') ?>">Cetak Laporan Peminjaman</a></li>
                    <li><a class="nav-link" href="<?= base_url('Admin/Laporan/BukuMasuk') ?>">Cetak Laporan Buku Masuk</a></li>
                    <!-- <li><a class="nav-link" href="blog.html">Buku Masuk</a></li> -->
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="feather"></i><span>Log Masuk</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url('Admin/LogPerpus') ?>">Log Masuk</a></li>
                    <li><a class="nav-link" href="<?= base_url('Admin/LogPerpus/DataLog') ?>">Data Log</a></li>
                    <!-- <li><a class="nav-link" href="blog.html">Buku Masuk</a></li> -->
                </ul>
            </li>

            <!-- <li class="dropdown ">
                <a href="<?= base_url('Admin/LogPerpus') ?>" class="nav-link "><i data-feather="feather"></i><span>Booking</span></a>
            </li> -->
            <li class="dropdown ">
                <a href="<?= base_url('Admin/Notifikasi') ?>" class="nav-link "><i data-feather="send"></i><span>Notifikasi</span></a>
                <!-- <a href="<?= base_url('Admin/Registrasi') ?>" class="nav-link "><i data-feather="monitor"></i><span>Registrasi Siswa</span></a> -->
            </li>
            <li class="dropdown ">
                <a href="<?= base_url('Admin/TukarCoin') ?>" class="nav-link "><i data-feather="gift"></i><span>Tukar Coin</span></a>
                <!-- <a href="<?= base_url('Admin/TukarCoin') ?>" class="nav-link "><i data-feather="monitor"></i><span>Registrasi Siswa</span></a> -->
            </li>


        </ul>
    </aside>
</div>