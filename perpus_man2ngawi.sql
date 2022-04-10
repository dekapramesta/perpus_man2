-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Apr 2022 pada 20.37
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus_man2ngawi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile_perpus`
--

CREATE TABLE `profile_perpus` (
  `nama_sekolah` text NOT NULL,
  `alamat` text NOT NULL,
  `tujuan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_booking`
--

CREATE TABLE `t_booking` (
  `id_booking` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` varchar(20) NOT NULL,
  `tgl_pemesanan` datetime NOT NULL,
  `status_pesan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_booking`
--

INSERT INTO `t_booking` (`id_booking`, `id_user`, `id_buku`, `tgl_pemesanan`, `status_pesan`) VALUES
(5, 8, 'JE196489', '2022-04-01 10:19:17', 1),
(6, 8, 'JE544061', '2022-04-01 10:22:59', 0),
(7, 8, 'JE601010', '2022-04-01 11:14:43', 0),
(8, 5, 'JE659307', '2022-04-05 13:48:28', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_buku`
--

CREATE TABLE `t_buku` (
  `id_buku` varchar(20) NOT NULL,
  `judul_buku` text NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `kode_buku` varchar(50) NOT NULL,
  `sinopsis` text NOT NULL,
  `penulis` text NOT NULL,
  `tahun_terbit` date NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `halaman` int(11) NOT NULL,
  `cover_buku` varchar(150) NOT NULL,
  `status_buku` tinyint(1) NOT NULL,
  `src_book` tinyint(1) NOT NULL,
  `lokasi_buku` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_buku`
--

INSERT INTO `t_buku` (`id_buku`, `judul_buku`, `kategori`, `kode_buku`, `sinopsis`, `penulis`, `tahun_terbit`, `tanggal_masuk`, `halaman`, `cover_buku`, `status_buku`, `src_book`, `lokasi_buku`) VALUES
('BU260651', 'Bumi', 'Fiksi,Pendidikan', '9789797809487', 'berkisah mengenai petualangan antarklan dengan tokoh utamanya, yaitu Raib. Raib adalah generasi keturunan murni dari Klan Bulan dan ia melakukan petualangan ke dunia paralel bersama dua sahabatnya, yaitu Seli dan Ali. Seli berasal dari keturunan klan Matahari, sementara Ali berasal dari klan Bumi atau tanah. Sebenarnya, mereka bertiga merupakan anak remaja pada umumnya, tetapi di novel inilah awal dari segalanya terungkap.', 'Tere Liye', '2022-03-11', '2022-03-11', 440, 'bukubumi.jpg', 0, 1, 'Lemari Fiksi,Psikologi Dan Filsafat'),
('JE196489', 'Jeda', 'Fiction', '9786021036860', 'Berilah sedikit jeda, untuk mengingat setiap senyum dan tawa yang tak henti selalu menghiasi. Untuk kembali mengulang canda sederhana dengan orang-orang yang sempat kita lupa. Berilah sedikit jeda, agar kita bisa kembali merangkai mimpi yang barangkali sempat terhenti. Untuk kembali mengingat janji-janji yang belum sempat ditepati. Berilah sedikit jeda, untuk menyendiri dan memperbaiki diri, barangkali ada hati yang tersakiti. Untuk melupakan dan memaafkan segala bentuk kesalahan yang pernah membekas. Biarlah jeda memberi kita sedikit ketenangan dan ruang untuk meresapi bahagia. Buku persembahan penerbit Transmedia', 'Andre Rianda', '2018-12-01', '2022-03-24', 212, 'http://books.google.com/books/content?id=dM-EDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 1, 0, 'Lemari Fiksi,Psikologi Dan Filsafat'),
('JE544061', 'Jeda', 'Fiction', '9786021036860', 'Berilah sedikit jeda, untuk mengingat setiap senyum dan tawa yang tak henti selalu menghiasi. Untuk kembali mengulang canda sederhana dengan orang-orang yang sempat kita lupa. Berilah sedikit jeda, agar kita bisa kembali merangkai mimpi yang barangkali sempat terhenti. Untuk kembali mengingat janji-janji yang belum sempat ditepati. Berilah sedikit jeda, untuk menyendiri dan memperbaiki diri, barangkali ada hati yang tersakiti. Untuk melupakan dan memaafkan segala bentuk kesalahan yang pernah membekas. Biarlah jeda memberi kita sedikit ketenangan dan ruang untuk meresapi bahagia. Buku persembahan penerbit Transmedia', 'Andre Rianda', '2018-12-01', '2022-03-24', 212, 'http://books.google.com/books/content?id=dM-EDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 7, 0, 'Lemari Fiksi,Psikologi Dan Filsafat'),
('JE601010', 'Jeda', 'Fiction', '9786021036860', 'Berilah sedikit jeda, untuk mengingat setiap senyum dan tawa yang tak henti selalu menghiasi. Untuk kembali mengulang canda sederhana dengan orang-orang yang sempat kita lupa. Berilah sedikit jeda, agar kita bisa kembali merangkai mimpi yang barangkali sempat terhenti. Untuk kembali mengingat janji-janji yang belum sempat ditepati. Berilah sedikit jeda, untuk menyendiri dan memperbaiki diri, barangkali ada hati yang tersakiti. Untuk melupakan dan memaafkan segala bentuk kesalahan yang pernah membekas. Biarlah jeda memberi kita sedikit ketenangan dan ruang untuk meresapi bahagia. Buku persembahan penerbit Transmedia', 'Andre Rianda', '2018-12-01', '2022-03-24', 212, 'http://books.google.com/books/content?id=dM-EDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 7, 0, 'Lemari Fiksi,Psikologi Dan Filsafat'),
('JE659307', 'Jeda', 'Fiction', '9786021036860', 'Berilah sedikit jeda, untuk mengingat setiap senyum dan tawa yang tak henti selalu menghiasi. Untuk kembali mengulang canda sederhana dengan orang-orang yang sempat kita lupa. Berilah sedikit jeda, agar kita bisa kembali merangkai mimpi yang barangkali sempat terhenti. Untuk kembali mengingat janji-janji yang belum sempat ditepati. Berilah sedikit jeda, untuk menyendiri dan memperbaiki diri, barangkali ada hati yang tersakiti. Untuk melupakan dan memaafkan segala bentuk kesalahan yang pernah membekas. Biarlah jeda memberi kita sedikit ketenangan dan ruang untuk meresapi bahagia. Buku persembahan penerbit Transmedia', 'Andre Rianda', '2018-12-01', '2022-03-24', 212, 'http://books.google.com/books/content?id=dM-EDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 7, 0, 'Lemari Fiksi,Psikologi Dan Filsafat'),
('JE996738', 'Jeda', 'Fiction,Pendidikan,Agama', '9786021036860', 'Berilah sedikit jeda, untuk mengingat setiap senyum dan tawa yang tak henti selalu menghiasi. Untuk kembali mengulang canda sederhana dengan orang-orang yang sempat kita lupa. Berilah sedikit jeda, agar kita bisa kembali merangkai mimpi yang barangkali sempat terhenti. Untuk kembali mengingat janji-janji yang belum sempat ditepati. Berilah sedikit jeda, untuk menyendiri dan memperbaiki diri, barangkali ada hati yang tersakiti. Untuk melupakan dan memaafkan segala bentuk kesalahan yang pernah membekas. Biarlah jeda memberi kita sedikit ketenangan dan ruang untuk meresapi bahagia. Buku persembahan penerbit Transmedia', 'Jeda', '2018-12-01', '2022-03-11', 212, 'http://books.google.com/books/content?id=dM-EDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 0, 0, 'Lemari Fiksi,Psikologi Dan Filsafat'),
('JI721739', 'Jika Kita Tak Pernah Jadi Apa-Apa', 'Fiction', '9789797809485', 'Jika Kita Tak Pernah Jadi Apa-Apa Kau melihat teman-teman dan mereka sudah sudah mendapatkan impian, sementara kau masih termangu menggenggam harapan. Pelan, dalam hati kau berujar, \"Kapan mimpiku terwujud?\" *** Jika Kita Tak Pernah Jadi Apa-Apa Selama perjalanan mencapai tujuan, adakalanya kau melihat sekeliling... menakar jauh jangkauan. Atau, kau malah membandingkannya dengan orang lain. Lalu, lupa melanjutkan perjalanan. *** Jika Kita Tak Pernah Jadi Apa-Apa Benarkah segala usaha dan upayamu selama ini lebur bersama kecewa yang kau bangun sendiri? Sungguhkah sesuatu yang hanya kau lihat dalam dunia maya menjadikanmu merasa bukan apa-apa? *** Jika Kita Tak Pernah Jadi Apa-Apa akan menemanimu selama perjalanan. Buku ini untukmu yang khawatir tentang masa depan. Tenang saja, kau tidak sedang diburu waktu. Bacalah tiap lembarnya dengan penuh kesadaran bahwa hidup adalah tentang sebaik-baiknya berusaha, jatuh lalu bangun lagi, dan tidak berhenti percaya bahwa segala perjuanganmu tidak akan sia-sia. Bukankah sebaiknya apa-apa yang fana tidak selayaknya membuatmu kecewa? ---------------Sebuah buku inspiratif untuk pengembangan diri persembahan penerbit Gagasmedia.', 'Alvi Syahrin', '2020-02-01', '2022-04-01', 242, 'http://books.google.com/books/content?id=WpjDDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 0, 0, 'Lemari Fiksi,Psikologi Dan Filsafat'),
('JI737072', 'Jika Kita Tak Pernah Jadi Apa-Apa', 'Fiction', '9789797809485', 'Jika Kita Tak Pernah Jadi Apa-Apa Kau melihat teman-teman dan mereka sudah sudah mendapatkan impian, sementara kau masih termangu menggenggam harapan. Pelan, dalam hati kau berujar, \"Kapan mimpiku terwujud?\" *** Jika Kita Tak Pernah Jadi Apa-Apa Selama perjalanan mencapai tujuan, adakalanya kau melihat sekeliling... menakar jauh jangkauan. Atau, kau malah membandingkannya dengan orang lain. Lalu, lupa melanjutkan perjalanan. *** Jika Kita Tak Pernah Jadi Apa-Apa Benarkah segala usaha dan upayamu selama ini lebur bersama kecewa yang kau bangun sendiri? Sungguhkah sesuatu yang hanya kau lihat dalam dunia maya menjadikanmu merasa bukan apa-apa? *** Jika Kita Tak Pernah Jadi Apa-Apa akan menemanimu selama perjalanan. Buku ini untukmu yang khawatir tentang masa depan. Tenang saja, kau tidak sedang diburu waktu. Bacalah tiap lembarnya dengan penuh kesadaran bahwa hidup adalah tentang sebaik-baiknya berusaha, jatuh lalu bangun lagi, dan tidak berhenti percaya bahwa segala perjuanganmu tidak akan sia-sia. Bukankah sebaiknya apa-apa yang fana tidak selayaknya membuatmu kecewa? ---------------Sebuah buku inspiratif untuk pengembangan diri persembahan penerbit Gagasmedia.', 'Alvi Syahrin', '2020-02-01', '2022-04-01', 242, 'http://books.google.com/books/content?id=WpjDDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 0, 0, 'Lemari Fiksi,Psikologi Dan Filsafat'),
('JI840198', 'Jika Kita Tak Pernah Jadi Apa-Apa', 'Fiction', '9789797809485', 'Jika Kita Tak Pernah Jadi Apa-Apa Kau melihat teman-teman dan mereka sudah sudah mendapatkan impian, sementara kau masih termangu menggenggam harapan. Pelan, dalam hati kau berujar, \"Kapan mimpiku terwujud?\" *** Jika Kita Tak Pernah Jadi Apa-Apa Selama perjalanan mencapai tujuan, adakalanya kau melihat sekeliling... menakar jauh jangkauan. Atau, kau malah membandingkannya dengan orang lain. Lalu, lupa melanjutkan perjalanan. *** Jika Kita Tak Pernah Jadi Apa-Apa Benarkah segala usaha dan upayamu selama ini lebur bersama kecewa yang kau bangun sendiri? Sungguhkah sesuatu yang hanya kau lihat dalam dunia maya menjadikanmu merasa bukan apa-apa? *** Jika Kita Tak Pernah Jadi Apa-Apa akan menemanimu selama perjalanan. Buku ini untukmu yang khawatir tentang masa depan. Tenang saja, kau tidak sedang diburu waktu. Bacalah tiap lembarnya dengan penuh kesadaran bahwa hidup adalah tentang sebaik-baiknya berusaha, jatuh lalu bangun lagi, dan tidak berhenti percaya bahwa segala perjuanganmu tidak akan sia-sia. Bukankah sebaiknya apa-apa yang fana tidak selayaknya membuatmu kecewa? ---------------Sebuah buku inspiratif untuk pengembangan diri persembahan penerbit Gagasmedia.', 'Alvi Syahrin', '2020-02-01', '2022-04-01', 242, 'http://books.google.com/books/content?id=WpjDDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 0, 0, 'Lemari Fiksi,Psikologi Dan Filsafat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_ebook`
--

CREATE TABLE `t_ebook` (
  `id_ebook` int(11) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `halaman` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `judul_ebook` text NOT NULL,
  `file_ebook` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_ebook`
--

INSERT INTO `t_ebook` (`id_ebook`, `penulis`, `halaman`, `deskripsi`, `judul_ebook`, `file_ebook`, `kategori`) VALUES
(1, 'dhanter', '440   ', 'there is a man with little hope in his dream', 'the way  i thought about you', 'wadwd.pdf', 'Fiksi,Filosofi,Psikologi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_guru`
--

CREATE TABLE `t_guru` (
  `id_guru` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kategori`
--

CREATE TABLE `t_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_kategori`
--

INSERT INTO `t_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Fiksi'),
(2, 'Horor'),
(3, 'Pendidikan'),
(4, 'Agama'),
(5, 'Hukum'),
(6, 'Hobi & Keterampilan'),
(7, 'Kesehatan'),
(8, 'Filosofi'),
(9, 'Psikologi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_notice`
--

CREATE TABLE `t_notice` (
  `id_notice` int(11) NOT NULL,
  `no_wa` int(11) NOT NULL,
  `tanggal_wa` date NOT NULL,
  `status_kirim` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_peminjaman`
--

CREATE TABLE `t_peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` varchar(20) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status_pengembalian` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_peminjaman`
--

INSERT INTO `t_peminjaman` (`id_peminjaman`, `id_user`, `id_buku`, `tanggal_pinjam`, `tanggal_pengembalian`, `status_pengembalian`) VALUES
(6, 6, 'JE996738', '2022-04-01', '2022-04-04', 1),
(7, 6, 'JI840198', '2022-04-01', '2022-04-04', 1),
(8, 8, 'JE196489', '2022-04-06', '2022-04-09', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pengembalian`
--

CREATE TABLE `t_pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `tgl_pengembalian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_pengembalian`
--

INSERT INTO `t_pengembalian` (`id_pengembalian`, `id_peminjaman`, `tgl_pengembalian`) VALUES
(7, 6, '2022-04-01'),
(8, 7, '2022-04-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_profile`
--

CREATE TABLE `t_profile` (
  `id_profile` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(155) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `coin` varchar(50) NOT NULL,
  `angkatan` int(11) NOT NULL,
  `nisn` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_profile`
--

INSERT INTO `t_profile` (`id_profile`, `id_user`, `nama`, `email`, `no_hp`, `coin`, `angkatan`, `nisn`) VALUES
(1, 5, 'admin', 'admin@gmail', '8792374932', '0', 2019, '000000'),
(2, 6, ' Deka Pramesta', 'dekapramesta77@gmail.com', '08967215276517', '0', 2019, '9809808'),
(3, 7, 'pogeng', 'alif@gmail.com', '71628168', '0', 2019, '176176'),
(4, 8, 'dk', 'dkpra@gmail.com', '1261627', '0', 2019, '190181080'),
(5, 9, 'SuperAdmin', 'superadmin@gmail.com', '089868565657', '0', 2000, '000000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_register`
--

CREATE TABLE `t_register` (
  `id_register` int(11) NOT NULL,
  `nisn` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `no_wa` varchar(50) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `status_daftar` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_register`
--

INSERT INTO `t_register` (`id_register`, `nisn`, `nama`, `code`, `no_wa`, `barcode`, `status_daftar`) VALUES
(1, '000000', 'admin', '372837628368', '8792374932', '8972381739', 1),
(2, '9809808', ' Deka ', '336839', ' 0896751517', ' 7886860', 1),
(3, '89789279', 'Dhanter', '803318', '08181618618', '6987686', 0),
(4, '190181080', 'dk', '765865', '1261627', '716281762', 1),
(5, '176176', 'pogeng', '227777', '71628168', '9879873892', 1),
(6, '000000000', 'SuperAdmin', '522221', '089868565657', '767867867', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_setup`
--

CREATE TABLE `t_setup` (
  `id_setup` int(11) NOT NULL,
  `nama_fitur` varchar(50) NOT NULL,
  `status_fitur` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_slider`
--

CREATE TABLE `t_slider` (
  `id_slider` int(11) NOT NULL,
  `filename` text NOT NULL,
  `alt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`id_user`, `username`, `password`, `role_id`) VALUES
(5, 'admin', '$2y$10$ys6CZqyh3Y6CirA.SAHBVOjTTKuwzjx/bNSBUiG2obhVc/jNGP/WO', 77),
(6, 'dekapramesta77', '$2y$10$PYOjGpbMCdlik1rHwLbEc.a7wiRzo.lUsJitRFXpQe/etRQI8BqDu', 1),
(7, 'alif', '$2y$10$bOGssNwgL6CmZfttgmKuWeokZ3hdNZgyEou2OIjn.nSN2c8LG7hYu', 1),
(8, 'dkpra', '$2y$10$zjspSvLsBDxMv5Muz0baCO/kcjO4anIkbyNoUbP7cbW.TMOATikyi', 1),
(9, 'SuperAdmin', '$2y$10$ivwAtjIqhCvAytrXHI3xmOBpSTnsH99pqTaDf9Jm6c7OE0IP3W/Qy', 70);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_booking`
--
ALTER TABLE `t_booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `t_buku`
--
ALTER TABLE `t_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `t_ebook`
--
ALTER TABLE `t_ebook`
  ADD PRIMARY KEY (`id_ebook`);

--
-- Indeks untuk tabel `t_guru`
--
ALTER TABLE `t_guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `t_kategori`
--
ALTER TABLE `t_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `t_notice`
--
ALTER TABLE `t_notice`
  ADD PRIMARY KEY (`id_notice`);

--
-- Indeks untuk tabel `t_peminjaman`
--
ALTER TABLE `t_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `t_pengembalian`
--
ALTER TABLE `t_pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_peminjaman` (`id_peminjaman`);

--
-- Indeks untuk tabel `t_profile`
--
ALTER TABLE `t_profile`
  ADD PRIMARY KEY (`id_profile`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `t_register`
--
ALTER TABLE `t_register`
  ADD PRIMARY KEY (`id_register`);

--
-- Indeks untuk tabel `t_setup`
--
ALTER TABLE `t_setup`
  ADD PRIMARY KEY (`id_setup`);

--
-- Indeks untuk tabel `t_slider`
--
ALTER TABLE `t_slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indeks untuk tabel `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_booking`
--
ALTER TABLE `t_booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `t_ebook`
--
ALTER TABLE `t_ebook`
  MODIFY `id_ebook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `t_guru`
--
ALTER TABLE `t_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_kategori`
--
ALTER TABLE `t_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `t_notice`
--
ALTER TABLE `t_notice`
  MODIFY `id_notice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_peminjaman`
--
ALTER TABLE `t_peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `t_pengembalian`
--
ALTER TABLE `t_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `t_profile`
--
ALTER TABLE `t_profile`
  MODIFY `id_profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `t_register`
--
ALTER TABLE `t_register`
  MODIFY `id_register` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `t_setup`
--
ALTER TABLE `t_setup`
  MODIFY `id_setup` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_slider`
--
ALTER TABLE `t_slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_booking`
--
ALTER TABLE `t_booking`
  ADD CONSTRAINT `t_booking_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_booking_ibfk_3` FOREIGN KEY (`id_buku`) REFERENCES `t_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_guru`
--
ALTER TABLE `t_guru`
  ADD CONSTRAINT `t_guru_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_peminjaman`
--
ALTER TABLE `t_peminjaman`
  ADD CONSTRAINT `t_peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `t_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_pengembalian`
--
ALTER TABLE `t_pengembalian`
  ADD CONSTRAINT `t_pengembalian_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `t_peminjaman` (`id_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_profile`
--
ALTER TABLE `t_profile`
  ADD CONSTRAINT `t_profile_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
