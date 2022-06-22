-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jun 2022 pada 09.46
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
  `id_profile` int(11) NOT NULL,
  `nama_sekolah` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `profile` text NOT NULL,
  `kordinat_gmaps` text NOT NULL,
  `banner` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `profile_perpus`
--

INSERT INTO `profile_perpus` (`id_profile`, `nama_sekolah`, `alamat`, `profile`, `kordinat_gmaps`, `banner`) VALUES
(77, 'MAN 2 Ngawi', 'Jl. Raya Paron No.2, Kenaiban, Paron, Kec. Paron, Kabupaten Ngawi, Jawa Timur', 'Dos Santos Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vel quae minima voluptas accusantium, placeat eos excepturi aliquid consequatur est odio repellendus, facere at repellat, labore rem debitis! Porro, ea corrupti. Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam mollitia odio facere veritatis dolor, nam laudantium quis. Molestiae quae, amet aperiam similique modi, non, odit nemo culpa consectetur rerum cumque.. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, illo! Maxime eveniet totam ut non unde fuga repellendus nulla, odio magni porro quo, molestias cumque illum incidunt ullam suscipit. Laborum!', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.3048024690074!2d111.39998701415035!3d-7.43148397527232!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79e8bddd463405%3A0x7a33b878169b9ec0!2sMadrasah%20Aliyah%20Negeri%202%20Ngawi!5e0!3m2!1sid!2sid!4v1653844926048!5m2!1sid!2sid', '1654856876bg-library.jpg');

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
(15, 11, 'IN397297', '2022-05-18 01:37:34', 6),
(17, 11, 'IN604835', '2022-05-29 01:22:01', 6),
(19, 10, 'IN604835', '2022-06-13 12:48:57', 6);

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
  `barcode_pic` varchar(25) NOT NULL,
  `status_buku` tinyint(1) NOT NULL,
  `src_book` tinyint(1) NOT NULL,
  `lokasi_buku` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_buku`
--

INSERT INTO `t_buku` (`id_buku`, `judul_buku`, `kategori`, `kode_buku`, `sinopsis`, `penulis`, `tahun_terbit`, `tanggal_masuk`, `halaman`, `cover_buku`, `barcode_pic`, `status_buku`, `src_book`, `lokasi_buku`) VALUES
('AN948160', 'An Artist In Floating World', 'Pendidikan,Filosofi', '9786020204970', 'ka pada suatu hari yang cerah, kau mendaki jalan curam ke arah bukit dari jembatna kayu kecil yang dikenal sebagai “Jembatan Keraguan”. kau akan mendapati atap rumahku rampa di antara ujung dua pohon gingko. Bahkan, meskipun posisi rumahku tidka terlalu strategis, bangunan itu masih akan tetap mencolok dibandingkan dengan rumah lain di sekitarnya, dan kau akan mendapati dirimu membayangkan sekaya apa pemiliknya.\r\n\r\nNamun, aku bukan, dan juga tidak pernah, menjadi orang kaya. Aku adalah Masuji Onon, seorang seniman bohemian dan propagandis imperialisme Jepang selama masa perang. Tetapi kini perang telah berakhir dan Jepang kalah. Istri dan putraku terbunuh. Lalu apa yang tersisa padaku?', 'Kazuo Ishiguro', '2022-05-30', '2022-05-30', 233, '15929364__SY475_.jpg', '1653864606AN948160.png', 0, 1, ''),
('B949398', ' Bulan', 'Fiksi', '978328349', ' Petualangan Raib, Seli, dan Ali berlanjut.Beberapa bulan setelah peristiwa klan bulan, Miss Selena akhirnya muncul di sekolah. Ia membawa kabar menggembirakan untuk anak-anak yang berjiwa petualang seperti Raib, Seli, dan Ali. Miss Selena bersama dengan Av akan mengajak mereka untuk mengunjungi klan matahari selama dua minggu. Av berencana akan bertemu dengan ketua konsil klan matahari, yang menguasai klan matahari sepenuhnya untuk mencari sekutu dalam menghadapi Tamus yang diperkirakan akan bebas dan juga membebaskan raja tanpa mahkota.\r\n\r\nSesampainya mereka di Klan matahari, mereka disambut oleh festival bunga matahari. Hal yang tidak pernah disangka oleh Av dan Miss Selena adalah ketua konsil klan matahari yang meminta Raib, Seli, Ali, dan Ily untuk menjadi peserta ke-10 dari festival bunga matahari. Setelah perdebatan yang amat panjang, akhirnya rombongan Raib menerima tawaran itu.', ' Tere Liye', '2015-06-17', '2022-06-10', 300, 'bulan1.jpg', '1654846632 B949398.png', 0, 1, ' Lemai Fiksi Rak Atas'),
('B980565', ' Bulan', 'Fiksi', '978328349', ' Petualangan Raib, Seli, dan Ali berlanjut.Beberapa bulan setelah peristiwa klan bulan, Miss Selena akhirnya muncul di sekolah. Ia membawa kabar menggembirakan untuk anak-anak yang berjiwa petualang seperti Raib, Seli, dan Ali. Miss Selena bersama dengan Av akan mengajak mereka untuk mengunjungi klan matahari selama dua minggu. Av berencana akan bertemu dengan ketua konsil klan matahari, yang menguasai klan matahari sepenuhnya untuk mencari sekutu dalam menghadapi Tamus yang diperkirakan akan bebas dan juga membebaskan raja tanpa mahkota.\r\n\r\nSesampainya mereka di Klan matahari, mereka disambut oleh festival bunga matahari. Hal yang tidak pernah disangka oleh Av dan Miss Selena adalah ketua konsil klan matahari yang meminta Raib, Seli, Ali, dan Ily untuk menjadi peserta ke-10 dari festival bunga matahari. Setelah perdebatan yang amat panjang, akhirnya rombongan Raib menerima tawaran itu.', ' Tere Liye', '2015-06-17', '2022-06-10', 300, 'bulan.jpg', '1654846632 B980565.png', 0, 1, ' Lemai Fiksi Rak Atas'),
('BU262276', 'Bumi Manusia', 'Fiksi,Pendidikan,Filosofi', '9789799731234', 'Bumi Manusia menceritakan tentang kehidupan Minke, siswa HBS sekolah menengah atas dengan pengantar bahasa Belanda. Minke merupakan satu-satunya orang Indonesia di antara siswa Belanda. Sebagai keturunan priayi, ia mendapat kesempatan dari pemerintah kolonial untuk bersekolah di sana. Ia lulus HBS dengan meraih peringkat dua di seluruh Hinia atau peringkat pertama untuk seluruh Surabaya. Pada masa itu, golongan priayi tinggi diberi hak istimewa untuk menduduki karier yang terhormat selama ia patuh pada tuntutan sistem yang ada, yakni berperilaku dengan mengikuti kebudayaan priayi dan tunduk pada kemauan penguasa kolonial yang memanfaatkan golongan priayi untuk mengukuhkan kekuasaan. Minke menjalin cinta dengan Annelies, putri Herman Mellema dengan Nyai Ontosuroh. Kemudian, Minke menikah dengan Annelies. Secara keilmuan, ia banyak berinteraksi dengan Magda Peters, guru bahasa Belanda yang beraliran etis di sekolahnya. Tulisan-tulisan Minke dalam majalah berbahasa Belanda membuat Asisten Residen mengundangnya sebagai tamu kehormatan kemudian menjadikannya sahabat keluarga. Ia pun berangsur-angsur menyadari posisinya yang berada dalam masyarakat rasialis. Ia menemukan pula bahwa sistem etis sekalipun tidak dapat menerima masyarakat bangsanya. Di sisi lain, kondisi masyarakat Indonesia pada saat itu pun dihadapkan pada kehidupan yang dengan ketat melaksanakan praktik feodalisme, termasuk oleh keluarganya sendiri.\r\n\r\n', 'Pramoedya Ananta Toer', '2022-05-30', '2022-05-30', 500, 'bumi-manusia-edit1.jpg', '1653864836BU262276.png', 0, 1, ''),
('BU316475', 'Bumi Manusia', 'Fiksi,Pendidikan,Filosofi', '9789799731234', 'Bumi Manusia menceritakan tentang kehidupan Minke, siswa HBS sekolah menengah atas dengan pengantar bahasa Belanda. Minke merupakan satu-satunya orang Indonesia di antara siswa Belanda. Sebagai keturunan priayi, ia mendapat kesempatan dari pemerintah kolonial untuk bersekolah di sana. Ia lulus HBS dengan meraih peringkat dua di seluruh Hinia atau peringkat pertama untuk seluruh Surabaya. Pada masa itu, golongan priayi tinggi diberi hak istimewa untuk menduduki karier yang terhormat selama ia patuh pada tuntutan sistem yang ada, yakni berperilaku dengan mengikuti kebudayaan priayi dan tunduk pada kemauan penguasa kolonial yang memanfaatkan golongan priayi untuk mengukuhkan kekuasaan. Minke menjalin cinta dengan Annelies, putri Herman Mellema dengan Nyai Ontosuroh. Kemudian, Minke menikah dengan Annelies. Secara keilmuan, ia banyak berinteraksi dengan Magda Peters, guru bahasa Belanda yang beraliran etis di sekolahnya. Tulisan-tulisan Minke dalam majalah berbahasa Belanda membuat Asisten Residen mengundangnya sebagai tamu kehormatan kemudian menjadikannya sahabat keluarga. Ia pun berangsur-angsur menyadari posisinya yang berada dalam masyarakat rasialis. Ia menemukan pula bahwa sistem etis sekalipun tidak dapat menerima masyarakat bangsanya. Di sisi lain, kondisi masyarakat Indonesia pada saat itu pun dihadapkan pada kehidupan yang dengan ketat melaksanakan praktik feodalisme, termasuk oleh keluarganya sendiri.\r\n\r\n', 'Pramoedya Ananta Toer', '2022-05-30', '2022-05-30', 500, 'bumi-manusia-edit2.jpg', '1653864836BU316475.png', 1, 1, ''),
('BU528801', 'Bumi Manusia', 'Fiksi,Pendidikan,Filosofi', '9789799731234', 'Bumi Manusia menceritakan tentang kehidupan Minke, siswa HBS sekolah menengah atas dengan pengantar bahasa Belanda. Minke merupakan satu-satunya orang Indonesia di antara siswa Belanda. Sebagai keturunan priayi, ia mendapat kesempatan dari pemerintah kolonial untuk bersekolah di sana. Ia lulus HBS dengan meraih peringkat dua di seluruh Hinia atau peringkat pertama untuk seluruh Surabaya. Pada masa itu, golongan priayi tinggi diberi hak istimewa untuk menduduki karier yang terhormat selama ia patuh pada tuntutan sistem yang ada, yakni berperilaku dengan mengikuti kebudayaan priayi dan tunduk pada kemauan penguasa kolonial yang memanfaatkan golongan priayi untuk mengukuhkan kekuasaan. Minke menjalin cinta dengan Annelies, putri Herman Mellema dengan Nyai Ontosuroh. Kemudian, Minke menikah dengan Annelies. Secara keilmuan, ia banyak berinteraksi dengan Magda Peters, guru bahasa Belanda yang beraliran etis di sekolahnya. Tulisan-tulisan Minke dalam majalah berbahasa Belanda membuat Asisten Residen mengundangnya sebagai tamu kehormatan kemudian menjadikannya sahabat keluarga. Ia pun berangsur-angsur menyadari posisinya yang berada dalam masyarakat rasialis. Ia menemukan pula bahwa sistem etis sekalipun tidak dapat menerima masyarakat bangsanya. Di sisi lain, kondisi masyarakat Indonesia pada saat itu pun dihadapkan pada kehidupan yang dengan ketat melaksanakan praktik feodalisme, termasuk oleh keluarganya sendiri.\r\n\r\n', 'Pramoedya Ananta Toer', '2022-05-30', '2022-05-30', 500, 'bumi-manusia-edit.jpg', '1653864836BU528801.png', 0, 1, ''),
('BU855303', 'Bumi Manusia', 'Fiksi,Pendidikan,Filosofi', '9789799731234', 'Bumi Manusia menceritakan tentang kehidupan Minke, siswa HBS sekolah menengah atas dengan pengantar bahasa Belanda. Minke merupakan satu-satunya orang Indonesia di antara siswa Belanda. Sebagai keturunan priayi, ia mendapat kesempatan dari pemerintah kolonial untuk bersekolah di sana. Ia lulus HBS dengan meraih peringkat dua di seluruh Hinia atau peringkat pertama untuk seluruh Surabaya. Pada masa itu, golongan priayi tinggi diberi hak istimewa untuk menduduki karier yang terhormat selama ia patuh pada tuntutan sistem yang ada, yakni berperilaku dengan mengikuti kebudayaan priayi dan tunduk pada kemauan penguasa kolonial yang memanfaatkan golongan priayi untuk mengukuhkan kekuasaan. Minke menjalin cinta dengan Annelies, putri Herman Mellema dengan Nyai Ontosuroh. Kemudian, Minke menikah dengan Annelies. Secara keilmuan, ia banyak berinteraksi dengan Magda Peters, guru bahasa Belanda yang beraliran etis di sekolahnya. Tulisan-tulisan Minke dalam majalah berbahasa Belanda membuat Asisten Residen mengundangnya sebagai tamu kehormatan kemudian menjadikannya sahabat keluarga. Ia pun berangsur-angsur menyadari posisinya yang berada dalam masyarakat rasialis. Ia menemukan pula bahwa sistem etis sekalipun tidak dapat menerima masyarakat bangsanya. Di sisi lain, kondisi masyarakat Indonesia pada saat itu pun dihadapkan pada kehidupan yang dengan ketat melaksanakan praktik feodalisme, termasuk oleh keluarganya sendiri.\r\n\r\n', 'Pramoedya Ananta Toer', '2022-05-30', '2022-05-30', 500, 'bumi-manusia-edit3.jpg', '1653864836BU855303.png', 0, 1, ''),
('IN397297', 'In A Blue Moon', 'Fiction', '9786020314624', '“Apakah kau masih membenciku?” “Aku heran kau merasa perlu bertanya.” Lucas Ford pertama kali bertemu dengan Sophie Wilson di bulan Desember pada tahun terakhir SMA-nya. Gadis itu membencinya. Lucas kembali bertemu dengan Sophie di bulan Desember sepuluh tahun kemudian di kota New York. Gadis itu masih membencinya. Masalah utamanya bukan itu—oh, bukan!—melainkan kenyataan bahwa gadis yang membencinya itu kini ditetapkan sebagai tunangan Lucas oleh kakeknya yang suka ikut campur. Lucas mendekati Sophie bukan karena perintah kakeknya. Ia mendekati Sophie karena ingin mengubah pendapat Sophie tentang dirinya. Juga karena ia ingin Sophie menyukainya sebesar ia menyukai gadis itu. Dan, kadang-kadang—ini sangat jarang terjadi, tentu saja—kakeknya bisa mengambil keputusan yang sangat tepat.', 'Ilana Tan', '2015-04-07', '2022-05-17', 320, 'http://books.google.com/books/content?id=lLo8DwAAQBAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '1652798585IN397297.png', 1, 0, ''),
('IN604835', 'In A Blue Moon', 'Fiction', '9786020314624', '“Apakah kau masih membenciku?” “Aku heran kau merasa perlu bertanya.” Lucas Ford pertama kali bertemu dengan Sophie Wilson di bulan Desember pada tahun terakhir SMA-nya. Gadis itu membencinya. Lucas kembali bertemu dengan Sophie di bulan Desember sepuluh tahun kemudian di kota New York. Gadis itu masih membencinya. Masalah utamanya bukan itu—oh, bukan!—melainkan kenyataan bahwa gadis yang membencinya itu kini ditetapkan sebagai tunangan Lucas oleh kakeknya yang suka ikut campur. Lucas mendekati Sophie bukan karena perintah kakeknya. Ia mendekati Sophie karena ingin mengubah pendapat Sophie tentang dirinya. Juga karena ia ingin Sophie menyukainya sebesar ia menyukai gadis itu. Dan, kadang-kadang—ini sangat jarang terjadi, tentu saja—kakeknya bisa mengambil keputusan yang sangat tepat.', 'Ilana Tan', '2015-04-07', '2022-05-17', 320, 'http://books.google.com/books/content?id=lLo8DwAAQBAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '1652798585IN604835.png', 0, 0, ''),
('IN896455', 'In A Blue Moon', 'Fiction', '9786020314624', '“Apakah kau masih membenciku?” “Aku heran kau merasa perlu bertanya.” Lucas Ford pertama kali bertemu dengan Sophie Wilson di bulan Desember pada tahun terakhir SMA-nya. Gadis itu membencinya. Lucas kembali bertemu dengan Sophie di bulan Desember sepuluh tahun kemudian di kota New York. Gadis itu masih membencinya. Masalah utamanya bukan itu—oh, bukan!—melainkan kenyataan bahwa gadis yang membencinya itu kini ditetapkan sebagai tunangan Lucas oleh kakeknya yang suka ikut campur. Lucas mendekati Sophie bukan karena perintah kakeknya. Ia mendekati Sophie karena ingin mengubah pendapat Sophie tentang dirinya. Juga karena ia ingin Sophie menyukainya sebesar ia menyukai gadis itu. Dan, kadang-kadang—ini sangat jarang terjadi, tentu saja—kakeknya bisa mengambil keputusan yang sangat tepat.', 'Ilana Tan', '2015-04-07', '2022-05-17', 320, 'http://books.google.com/books/content?id=lLo8DwAAQBAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '1652798489IN896455.png', 0, 0, ''),
('IT104656', 'It started with kiss', 'Filosofi', '9786020306636', 'Cinta datang ketika kau tidak mengharapkannya...\r\n\r\nSebagai penyanyi di pernikahan, Romily Parker sudah kenyang melihat pesta pernikahan yang bahagia, walaupun kisah cintanya sendiri tidak seberapa seru.\r\n\r\nPada suatu hari sebelum Natal, tak lama setelah gagal menyatakan cinta kepada Charlie, sahabatnya sendiri, Romily berpapasan dengan pria tampan tak dikenal. Pertemuan singkat itu diakhiri ciuman mendebarkan yang mengubah segalanya.\r\n\r\nBertekad untuk menemukan pria itu lagi, Rom memulai pencarian dengan bantuan (atau terkadang halangan) dari Paman Dudley, Bibi Mags, dan Wren yang flamboyan. Dapatkah Rom menemukan pria impiannya? Ataukah sang cinta sejati selama ini tak berada jauh darinya?', 'Miranda Dickinson', '2022-05-30', '2022-05-30', 200, '76530_f1.jpg', '1653863912IT104656.png', 0, 1, ''),
('IT153423', 'It started with kiss', 'Filosofi', '9786020306636', 'Cinta datang ketika kau tidak mengharapkannya...\r\n\r\nSebagai penyanyi di pernikahan, Romily Parker sudah kenyang melihat pesta pernikahan yang bahagia, walaupun kisah cintanya sendiri tidak seberapa seru.\r\n\r\nPada suatu hari sebelum Natal, tak lama setelah gagal menyatakan cinta kepada Charlie, sahabatnya sendiri, Romily berpapasan dengan pria tampan tak dikenal. Pertemuan singkat itu diakhiri ciuman mendebarkan yang mengubah segalanya.\r\n\r\nBertekad untuk menemukan pria itu lagi, Rom memulai pencarian dengan bantuan (atau terkadang halangan) dari Paman Dudley, Bibi Mags, dan Wren yang flamboyan. Dapatkah Rom menemukan pria impiannya? Ataukah sang cinta sejati selama ini tak berada jauh darinya?', 'Miranda Dickinson', '2022-05-30', '2022-05-30', 200, '76530_f.jpg', '1653863912IT153423.png', 0, 1, ''),
('IT628757', 'It started with kiss', 'Filosofi', '9786020306636', 'Cinta datang ketika kau tidak mengharapkannya...\r\n\r\nSebagai penyanyi di pernikahan, Romily Parker sudah kenyang melihat pesta pernikahan yang bahagia, walaupun kisah cintanya sendiri tidak seberapa seru.\r\n\r\nPada suatu hari sebelum Natal, tak lama setelah gagal menyatakan cinta kepada Charlie, sahabatnya sendiri, Romily berpapasan dengan pria tampan tak dikenal. Pertemuan singkat itu diakhiri ciuman mendebarkan yang mengubah segalanya.\r\n\r\nBertekad untuk menemukan pria itu lagi, Rom memulai pencarian dengan bantuan (atau terkadang halangan) dari Paman Dudley, Bibi Mags, dan Wren yang flamboyan. Dapatkah Rom menemukan pria impiannya? Ataukah sang cinta sejati selama ini tak berada jauh darinya?', 'Miranda Dickinson', '2022-05-30', '2022-05-30', 200, '76530_f2.jpg', '1653863913IT628757.png', 0, 1, ''),
('JI191121', 'Jika Kita Tak Pernah Jadi Apa-Apa', 'Fiction', '9789797809485', 'Jika Kita Tak Pernah Jadi Apa-Apa Kau melihat teman-teman dan mereka sudah sudah mendapatkan impian, sementara kau masih termangu menggenggam harapan. Pelan, dalam hati kau berujar, \"Kapan mimpiku terwujud?\" *** Jika Kita Tak Pernah Jadi Apa-Apa Selama perjalanan mencapai tujuan, adakalanya kau melihat sekeliling... menakar jauh jangkauan. Atau, kau malah membandingkannya dengan orang lain. Lalu, lupa melanjutkan perjalanan. *** Jika Kita Tak Pernah Jadi Apa-Apa Benarkah segala usaha dan upayamu selama ini lebur bersama kecewa yang kau bangun sendiri? Sungguhkah sesuatu yang hanya kau lihat dalam dunia maya menjadikanmu merasa bukan apa-apa? *** Jika Kita Tak Pernah Jadi Apa-Apa akan menemanimu selama perjalanan. Buku ini untukmu yang khawatir tentang masa depan. Tenang saja, kau tidak sedang diburu waktu. Bacalah tiap lembarnya dengan penuh kesadaran bahwa hidup adalah tentang sebaik-baiknya berusaha, jatuh lalu bangun lagi, dan tidak berhenti percaya bahwa segala perjuanganmu tidak akan sia-sia. Bukankah sebaiknya apa-apa yang fana tidak selayaknya membuatmu kecewa? ---------------Sebuah buku inspiratif untuk pengembangan diri persembahan penerbit Gagasmedia.', 'Alvi Syahrin', '2020-02-01', '2022-05-20', 242, 'http://books.google.com/books/content?id=WpjDDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '1653028627JI191121.png', 0, 0, ''),
('JI344624', 'Jika Kita Tak Pernah Jadi Apa-Apa', 'Fiction', '9789797809485', 'Jika Kita Tak Pernah Jadi Apa-Apa Kau melihat teman-teman dan mereka sudah sudah mendapatkan impian, sementara kau masih termangu menggenggam harapan. Pelan, dalam hati kau berujar, \"Kapan mimpiku terwujud?\" *** Jika Kita Tak Pernah Jadi Apa-Apa Selama perjalanan mencapai tujuan, adakalanya kau melihat sekeliling... menakar jauh jangkauan. Atau, kau malah membandingkannya dengan orang lain. Lalu, lupa melanjutkan perjalanan. *** Jika Kita Tak Pernah Jadi Apa-Apa Benarkah segala usaha dan upayamu selama ini lebur bersama kecewa yang kau bangun sendiri? Sungguhkah sesuatu yang hanya kau lihat dalam dunia maya menjadikanmu merasa bukan apa-apa? *** Jika Kita Tak Pernah Jadi Apa-Apa akan menemanimu selama perjalanan. Buku ini untukmu yang khawatir tentang masa depan. Tenang saja, kau tidak sedang diburu waktu. Bacalah tiap lembarnya dengan penuh kesadaran bahwa hidup adalah tentang sebaik-baiknya berusaha, jatuh lalu bangun lagi, dan tidak berhenti percaya bahwa segala perjuanganmu tidak akan sia-sia. Bukankah sebaiknya apa-apa yang fana tidak selayaknya membuatmu kecewa? ---------------Sebuah buku inspiratif untuk pengembangan diri persembahan penerbit Gagasmedia.', 'Alvi Syahrin', '2020-02-01', '2022-05-13', 242, 'http://books.google.com/books/content?id=WpjDDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '1652387560JI344624.png', 1, 0, ''),
('JI515844', 'Jika Kita Tak Pernah Jadi Apa-Apa', 'Fiction', '9789797809485', 'Jika Kita Tak Pernah Jadi Apa-Apa Kau melihat teman-teman dan mereka sudah sudah mendapatkan impian, sementara kau masih termangu menggenggam harapan. Pelan, dalam hati kau berujar, \"Kapan mimpiku terwujud?\" *** Jika Kita Tak Pernah Jadi Apa-Apa Selama perjalanan mencapai tujuan, adakalanya kau melihat sekeliling... menakar jauh jangkauan. Atau, kau malah membandingkannya dengan orang lain. Lalu, lupa melanjutkan perjalanan. *** Jika Kita Tak Pernah Jadi Apa-Apa Benarkah segala usaha dan upayamu selama ini lebur bersama kecewa yang kau bangun sendiri? Sungguhkah sesuatu yang hanya kau lihat dalam dunia maya menjadikanmu merasa bukan apa-apa? *** Jika Kita Tak Pernah Jadi Apa-Apa akan menemanimu selama perjalanan. Buku ini untukmu yang khawatir tentang masa depan. Tenang saja, kau tidak sedang diburu waktu. Bacalah tiap lembarnya dengan penuh kesadaran bahwa hidup adalah tentang sebaik-baiknya berusaha, jatuh lalu bangun lagi, dan tidak berhenti percaya bahwa segala perjuanganmu tidak akan sia-sia. Bukankah sebaiknya apa-apa yang fana tidak selayaknya membuatmu kecewa? ---------------Sebuah buku inspiratif untuk pengembangan diri persembahan penerbit Gagasmedia.', 'Alvi Syahrin', '2020-02-01', '2022-05-13', 242, 'http://books.google.com/books/content?id=WpjDDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '1652387475JI515844.png', 0, 0, ''),
('JI551760', 'Jika Kita Tak Pernah Jadi Apa-Apa', 'Fiction', '9789797809485', 'Jika Kita Tak Pernah Jadi Apa-Apa Kau melihat teman-teman dan mereka sudah sudah mendapatkan impian, sementara kau masih termangu menggenggam harapan. Pelan, dalam hati kau berujar, \"Kapan mimpiku terwujud?\" *** Jika Kita Tak Pernah Jadi Apa-Apa Selama perjalanan mencapai tujuan, adakalanya kau melihat sekeliling... menakar jauh jangkauan. Atau, kau malah membandingkannya dengan orang lain. Lalu, lupa melanjutkan perjalanan. *** Jika Kita Tak Pernah Jadi Apa-Apa Benarkah segala usaha dan upayamu selama ini lebur bersama kecewa yang kau bangun sendiri? Sungguhkah sesuatu yang hanya kau lihat dalam dunia maya menjadikanmu merasa bukan apa-apa? *** Jika Kita Tak Pernah Jadi Apa-Apa akan menemanimu selama perjalanan. Buku ini untukmu yang khawatir tentang masa depan. Tenang saja, kau tidak sedang diburu waktu. Bacalah tiap lembarnya dengan penuh kesadaran bahwa hidup adalah tentang sebaik-baiknya berusaha, jatuh lalu bangun lagi, dan tidak berhenti percaya bahwa segala perjuanganmu tidak akan sia-sia. Bukankah sebaiknya apa-apa yang fana tidak selayaknya membuatmu kecewa? ---------------Sebuah buku inspiratif untuk pengembangan diri persembahan penerbit Gagasmedia.', 'Alvi Syahrin', '2020-02-01', '2022-05-13', 242, 'http://books.google.com/books/content?id=WpjDDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '1652387560JI551760.png', 0, 0, ''),
('JI720544', 'Jika Kita Tak Pernah Jadi Apa-Apa', 'Fiction', '9789797809485', 'Jika Kita Tak Pernah Jadi Apa-Apa Kau melihat teman-teman dan mereka sudah sudah mendapatkan impian, sementara kau masih termangu menggenggam harapan. Pelan, dalam hati kau berujar, \"Kapan mimpiku terwujud?\" *** Jika Kita Tak Pernah Jadi Apa-Apa Selama perjalanan mencapai tujuan, adakalanya kau melihat sekeliling... menakar jauh jangkauan. Atau, kau malah membandingkannya dengan orang lain. Lalu, lupa melanjutkan perjalanan. *** Jika Kita Tak Pernah Jadi Apa-Apa Benarkah segala usaha dan upayamu selama ini lebur bersama kecewa yang kau bangun sendiri? Sungguhkah sesuatu yang hanya kau lihat dalam dunia maya menjadikanmu merasa bukan apa-apa? *** Jika Kita Tak Pernah Jadi Apa-Apa akan menemanimu selama perjalanan. Buku ini untukmu yang khawatir tentang masa depan. Tenang saja, kau tidak sedang diburu waktu. Bacalah tiap lembarnya dengan penuh kesadaran bahwa hidup adalah tentang sebaik-baiknya berusaha, jatuh lalu bangun lagi, dan tidak berhenti percaya bahwa segala perjuanganmu tidak akan sia-sia. Bukankah sebaiknya apa-apa yang fana tidak selayaknya membuatmu kecewa? ---------------Sebuah buku inspiratif untuk pengembangan diri persembahan penerbit Gagasmedia.', 'Alvi Syahrin', '2020-02-01', '2022-05-13', 242, 'http://books.google.com/books/content?id=WpjDDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '1652387560JI720544.png', 0, 0, ''),
('JI808830', 'Jika Kita Tak Pernah Jadi Apa-Apa', 'Fiction', '9789797809485', 'Jika Kita Tak Pernah Jadi Apa-Apa Kau melihat teman-teman dan mereka sudah sudah mendapatkan impian, sementara kau masih termangu menggenggam harapan. Pelan, dalam hati kau berujar, \"Kapan mimpiku terwujud?\" *** Jika Kita Tak Pernah Jadi Apa-Apa Selama perjalanan mencapai tujuan, adakalanya kau melihat sekeliling... menakar jauh jangkauan. Atau, kau malah membandingkannya dengan orang lain. Lalu, lupa melanjutkan perjalanan. *** Jika Kita Tak Pernah Jadi Apa-Apa Benarkah segala usaha dan upayamu selama ini lebur bersama kecewa yang kau bangun sendiri? Sungguhkah sesuatu yang hanya kau lihat dalam dunia maya menjadikanmu merasa bukan apa-apa? *** Jika Kita Tak Pernah Jadi Apa-Apa akan menemanimu selama perjalanan. Buku ini untukmu yang khawatir tentang masa depan. Tenang saja, kau tidak sedang diburu waktu. Bacalah tiap lembarnya dengan penuh kesadaran bahwa hidup adalah tentang sebaik-baiknya berusaha, jatuh lalu bangun lagi, dan tidak berhenti percaya bahwa segala perjuanganmu tidak akan sia-sia. Bukankah sebaiknya apa-apa yang fana tidak selayaknya membuatmu kecewa? ---------------Sebuah buku inspiratif untuk pengembangan diri persembahan penerbit Gagasmedia.', 'Alvi Syahrin', '2020-02-01', '2022-05-13', 242, 'http://books.google.com/books/content?id=WpjDDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '1652387559JI808830.png', 0, 0, ''),
('JI939522', 'Jika Kita Tak Pernah Jadi Apa-Apa', 'Fiction', '9789797809485', 'Jika Kita Tak Pernah Jadi Apa-Apa Kau melihat teman-teman dan mereka sudah sudah mendapatkan impian, sementara kau masih termangu menggenggam harapan. Pelan, dalam hati kau berujar, \"Kapan mimpiku terwujud?\" *** Jika Kita Tak Pernah Jadi Apa-Apa Selama perjalanan mencapai tujuan, adakalanya kau melihat sekeliling... menakar jauh jangkauan. Atau, kau malah membandingkannya dengan orang lain. Lalu, lupa melanjutkan perjalanan. *** Jika Kita Tak Pernah Jadi Apa-Apa Benarkah segala usaha dan upayamu selama ini lebur bersama kecewa yang kau bangun sendiri? Sungguhkah sesuatu yang hanya kau lihat dalam dunia maya menjadikanmu merasa bukan apa-apa? *** Jika Kita Tak Pernah Jadi Apa-Apa akan menemanimu selama perjalanan. Buku ini untukmu yang khawatir tentang masa depan. Tenang saja, kau tidak sedang diburu waktu. Bacalah tiap lembarnya dengan penuh kesadaran bahwa hidup adalah tentang sebaik-baiknya berusaha, jatuh lalu bangun lagi, dan tidak berhenti percaya bahwa segala perjuanganmu tidak akan sia-sia. Bukankah sebaiknya apa-apa yang fana tidak selayaknya membuatmu kecewa? ---------------Sebuah buku inspiratif untuk pengembangan diri persembahan penerbit Gagasmedia.', 'Alvi Syahrin', '2020-02-01', '2022-06-10', 242, 'http://books.google.com/books/content?id=WpjDDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '1654846264JI939522.png', 0, 0, 'Lemari Fiksi Rak Tengah'),
('KA285848', 'Kau, Aku, dan Sepucuk Angpau Merah', 'Juvenile Fiction', '9789792279139', '\"Ada tujuh miliar penduduk bumi saat ini. Jika separuh saja dari mereka pernah jatuh cinta, setidaknya akan ada satu miliar lebih cerita cinta. Akan ada setidaknya 5 kali dalam setiap detik, 300 kali dalam semenit, 18.000 kali dalam setiap jam, dan nyaris setengah juta sehari-semalam, seseorang entah di belahan dunia mana, berbinar, harap-harap cemas, gemetar, malu-malu menyatakan perasaannya. Apakah Kau, Aku, dan Sepucuk Angpau Merah ini sama spesialnya dengan miliaran cerita cinta lain? Sama istimewanya dengan kisah cinta kita? Ah, kita tidak memerlukan sinopsis untuk memulai membaca cerita ini. Juga tidak memerlukan komentar dari orang-orang terkenal. Cukup dari teman, kerabat, tetangga sebelah rumah. Nah, setelah tiba di halaman terakhir, sampaikan, sampaikan ke mana-mana seberapa spesial kisah cinta ini. Ceritakan kepada mereka.\"', 'Tere-Liye', '2013-07-23', '2022-05-30', 512, 'http://books.google.com/books/content?id=KFFFDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '1653864146KA285848.png', 0, 0, ''),
('KA635276', 'Kau, Aku, dan Sepucuk Angpau Merah', 'Juvenile Fiction', '9789792279139', '\"Ada tujuh miliar penduduk bumi saat ini. Jika separuh saja dari mereka pernah jatuh cinta, setidaknya akan ada satu miliar lebih cerita cinta. Akan ada setidaknya 5 kali dalam setiap detik, 300 kali dalam semenit, 18.000 kali dalam setiap jam, dan nyaris setengah juta sehari-semalam, seseorang entah di belahan dunia mana, berbinar, harap-harap cemas, gemetar, malu-malu menyatakan perasaannya. Apakah Kau, Aku, dan Sepucuk Angpau Merah ini sama spesialnya dengan miliaran cerita cinta lain? Sama istimewanya dengan kisah cinta kita? Ah, kita tidak memerlukan sinopsis untuk memulai membaca cerita ini. Juga tidak memerlukan komentar dari orang-orang terkenal. Cukup dari teman, kerabat, tetangga sebelah rumah. Nah, setelah tiba di halaman terakhir, sampaikan, sampaikan ke mana-mana seberapa spesial kisah cinta ini. Ceritakan kepada mereka.\"', 'Tere-Liye', '2013-07-23', '2022-05-30', 512, 'http://books.google.com/books/content?id=KFFFDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '1653864146KA635276.png', 0, 0, ''),
('KA722818', 'Kau, Aku, dan Sepucuk Angpau Merah', 'Juvenile Fiction', '9789792279139', '\"Ada tujuh miliar penduduk bumi saat ini. Jika separuh saja dari mereka pernah jatuh cinta, setidaknya akan ada satu miliar lebih cerita cinta. Akan ada setidaknya 5 kali dalam setiap detik, 300 kali dalam semenit, 18.000 kali dalam setiap jam, dan nyaris setengah juta sehari-semalam, seseorang entah di belahan dunia mana, berbinar, harap-harap cemas, gemetar, malu-malu menyatakan perasaannya. Apakah Kau, Aku, dan Sepucuk Angpau Merah ini sama spesialnya dengan miliaran cerita cinta lain? Sama istimewanya dengan kisah cinta kita? Ah, kita tidak memerlukan sinopsis untuk memulai membaca cerita ini. Juga tidak memerlukan komentar dari orang-orang terkenal. Cukup dari teman, kerabat, tetangga sebelah rumah. Nah, setelah tiba di halaman terakhir, sampaikan, sampaikan ke mana-mana seberapa spesial kisah cinta ini. Ceritakan kepada mereka.\"', 'Tere-Liye', '2013-07-23', '2022-05-30', 512, 'http://books.google.com/books/content?id=KFFFDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '1653864146KA722818.png', 0, 0, ''),
('NE353707', 'Negeri Senja', 'Pendidikan,Hukum', '9789799109309', 'Hidupku penuh dengan kesedihan–karena itu aku selalu mengembara.” Maka pengembara itu pun tiba di Negeri Senja, yang selalu berada dalam keadaan senja, karena matahari tersangkut di cakrawala, dan tidak pernah terbenam selama-lamanya. Bagi sang pengembara, yang selalu memburu senja terindah ke berbagai pelosok bumi, pemandangan itu merupakan hal terbaik dalam hidupnya. Namun bukan hanya pesona senja ditemukannya. Di balik keindahan senja terdapat drama manusia dalam permainan kekuasaan: intrik dan teror, perlawanan', 'Seno Gumira', '2022-05-30', '2022-05-30', 440, '26874741__SX318_.jpg', '1653864426NE353707.png', 0, 1, ''),
('PU326395', 'Pulang', 'Fiksi', '9786020822129', 'bercerita tentang shadow economy. Tokoh utamanya adalah Bujang, anak muda yang hidup di pedalaman Sumatra. Ia mewarisi darah ayahnya, Samad, yang merupakan seorang tukang pukul yang paling ditakuti di sebuah kerajaan shadow economy. Samad ingin agar Bujang meneruskan karir bapaknya', 'Tere Liye', '2022-05-30', '2022-05-30', 440, 'pulang-604a532ed541df675f6f2592.jpg', '1653862578PU326395.png', 0, 1, ''),
('SE431036', 'Selena', 'Fiksi', '182182', 'Dunia kita dekat sekali dengan kegelapan. Maka saat gelap menyelimutimu, pastikan kamu tetap berusaha mencari cahaya di sekitarmu. Dirimu sendiri adalah satu-satunya yang bisa kaupercaya. Nurani. Cahaya itu selalu ada di hatimu. Gunakanlah. Terangi jalanmu, temukan pilihan hidupmu. Semoga itu bisa membawamu menuju jalan yang lebih baik', 'Tere Liye', '2022-06-10', '2022-06-10', 300, 'selena_gramedia2.jpg', '1654847132SE431036.png', 0, 1, 'Lemari Fiksi Rak Tengah'),
('SE727665', 'Selena', 'Fiksi', '182182', 'Dunia kita dekat sekali dengan kegelapan. Maka saat gelap menyelimutimu, pastikan kamu tetap berusaha mencari cahaya di sekitarmu. Dirimu sendiri adalah satu-satunya yang bisa kaupercaya. Nurani. Cahaya itu selalu ada di hatimu. Gunakanlah. Terangi jalanmu, temukan pilihan hidupmu. Semoga itu bisa membawamu menuju jalan yang lebih baik', 'Tere Liye', '2022-06-10', '2022-06-10', 300, 'selena_gramedia.jpg', '1654847132SE727665.png', 0, 1, 'Lemari Fiksi Rak Tengah'),
('SE781917', 'Selena', 'Fiksi', '182182', 'Dunia kita dekat sekali dengan kegelapan. Maka saat gelap menyelimutimu, pastikan kamu tetap berusaha mencari cahaya di sekitarmu. Dirimu sendiri adalah satu-satunya yang bisa kaupercaya. Nurani. Cahaya itu selalu ada di hatimu. Gunakanlah. Terangi jalanmu, temukan pilihan hidupmu. Semoga itu bisa membawamu menuju jalan yang lebih baik', 'Tere Liye', '2022-06-10', '2022-06-10', 300, 'selena_gramedia1.jpg', '1654847132SE781917.png', 0, 1, 'Lemari Fiksi Rak Tengah');

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
(1, 'dhanter', '440       ', 'there is a man with little hope in his dream', 'the way  i love u', 'Laporan_Tugas_Akhir_Bella-N-193307042.pdf', 'Fiksi,Filosofi');

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

--
-- Dumping data untuk tabel `t_guru`
--

INSERT INTO `t_guru` (`id_guru`, `id_user`, `nama_guru`, `no_hp`, `alamat`, `email`) VALUES
(1, 10, 'deka Pramesta', '0895377941531', 'Alamat', 'dkpra77@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_hadiah`
--

CREATE TABLE `t_hadiah` (
  `id_hadiah` int(11) NOT NULL,
  `nama_item` varchar(20) NOT NULL,
  `jenis_item` varchar(20) NOT NULL,
  `coin_hadiah` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_hadiah`
--

INSERT INTO `t_hadiah` (`id_hadiah`, `nama_item`, `jenis_item`, `coin_hadiah`, `jumlah`) VALUES
(1, 'Teh Pucuk', 'Minuman', 30, 10),
(2, 'Coca Cola', 'Minuman', 40, 0),
(3, 'Sari Roti', 'Makanan', 50, 0),
(4, 'Pencil', 'Alat Tulis', 20, 30);

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
  `id_peminjaman` int(11) NOT NULL,
  `no_wa` varchar(15) NOT NULL,
  `tanggal_wa` date NOT NULL,
  `status_kirim` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_notice`
--

INSERT INTO `t_notice` (`id_notice`, `id_peminjaman`, `no_wa`, `tanggal_wa`, `status_kirim`) VALUES
(8, 22, '2147483647', '2022-05-20', 1),
(9, 23, '2147483647', '2022-05-20', 1),
(26, 28, '0895377941531', '2022-06-10', 1),
(27, 26, '0895377941531', '2022-06-10', 1);

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
(22, 11, 'IN397297', '2022-05-20', '2022-05-21', 1),
(23, 11, 'JI191121', '2022-05-20', '2022-05-21', 1),
(24, 8, 'IN397297', '2022-05-29', '2022-06-01', 0),
(25, 11, 'JI344624', '2022-05-29', '2022-06-01', 0),
(26, 11, 'AN948160', '2022-06-10', '2022-06-11', 1),
(28, 10, 'BU316475', '2022-06-10', '2022-06-11', 0);

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
(18, 22, '2022-05-20'),
(19, 23, '2022-05-20'),
(20, 26, '2022-06-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_penukaran`
--

CREATE TABLE `t_penukaran` (
  `id_penukaran` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_hadiah` int(11) NOT NULL,
  `status_penukaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(6, '000000000', 'SuperAdmin', '522221', '089868565657', '767867867', 1),
(7, '34234723', 'akaza', '845688', '89729834723', '8745894357', 1),
(8, '24823789', 'hjahdkj', '192734', '8798274', 'knfjsf', 0),
(9, '12176271', 'bonzo', '902765', '0891829', '734834', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_registerguru`
--

CREATE TABLE `t_registerguru` (
  `id_registerGuru` int(11) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `code` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status_daftar` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_registerguru`
--

INSERT INTO `t_registerguru` (`id_registerGuru`, `nama_guru`, `no_hp`, `code`, `email`, `status_daftar`) VALUES
(1, 'deka Pramesta', '9819728179', '801494', 'dkpra77@gmail.com', 1),
(2, 'aceng', '087677676', '961216', 'aceng@gmail.com', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_setup`
--

CREATE TABLE `t_setup` (
  `id_setup` int(11) NOT NULL,
  `nama_fitur` varchar(50) NOT NULL,
  `status_fitur` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_setup`
--

INSERT INTO `t_setup` (`id_setup`, `nama_fitur`, `status_fitur`) VALUES
(1, 'coin', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_siswa`
--

CREATE TABLE `t_siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(155) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `coin` varchar(50) NOT NULL,
  `angkatan` int(11) NOT NULL,
  `nisn` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_siswa`
--

INSERT INTO `t_siswa` (`id_siswa`, `id_user`, `nama`, `email`, `no_hp`, `coin`, `angkatan`, `nisn`) VALUES
(1, 5, 'admin', 'admin@gmail', '8792374932', '0', 2019, '18927938745'),
(2, 6, ' Deka Pramestaaa', 'dekapramesta77@gmail.com', '08967215276517', '0', 2019, '9809808'),
(3, 7, 'pogeng', 'alif@gmail.com', '71628168', '0', 2019, '176176'),
(4, 8, 'dk', 'dkpra@gmail.com', '1261627', '0', 2019, '190181080'),
(5, 9, 'SuperAdmin', 'superadmin@gmail.com', '089868565657', '0', 2000, '000000000'),
(6, 11, 'akaza', 'akaza@gmail.com', '12', '30', 2019, '342347291'),
(7, 12, 'bonzo', 'itachi@gmail.com', '261762', '0', 2019, '12176271');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status_block` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`id_user`, `username`, `password`, `role_id`, `status_block`) VALUES
(5, 'admin', '$2y$10$ys6CZqyh3Y6CirA.SAHBVOjTTKuwzjx/bNSBUiG2obhVc/jNGP/WO', 77, 0),
(6, 'dekapramesta77', '$2y$10$PYOjGpbMCdlik1rHwLbEc.a7wiRzo.lUsJitRFXpQe/etRQI8BqDu', 1, 1),
(7, 'alif', '$2y$10$bOGssNwgL6CmZfttgmKuWeokZ3hdNZgyEou2OIjn.nSN2c8LG7hYu', 1, 1),
(8, 'dkpra', '$2y$10$zjspSvLsBDxMv5Muz0baCO/kcjO4anIkbyNoUbP7cbW.TMOATikyi', 1, 1),
(9, 'SuperAdmin', '$2y$10$ivwAtjIqhCvAytrXHI3xmOBpSTnsH99pqTaDf9Jm6c7OE0IP3W/Qy', 70, 0),
(10, 'dkprabos', '$2y$10$Zp8j/2VuWRMbgDMeB1JAc.eIISzPvfhAMDlrneByj7U2E9pXn9RuK', 2, 0),
(11, 'akaza', '$2y$10$8lGJulRJI2bzg7sJg0D/kOUvvTcgYo.qJ9.Rrm/Bv7YE3/ZkHf2MW', 1, 0),
(12, 'bonzo', '$2y$10$ypCCva0zeKCQGTSPEMU9TOWrkoBi/jmQbQUIuPRTXkLEIJfLQeBzK', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `profile_perpus`
--
ALTER TABLE `profile_perpus`
  ADD PRIMARY KEY (`id_profile`);

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
-- Indeks untuk tabel `t_hadiah`
--
ALTER TABLE `t_hadiah`
  ADD PRIMARY KEY (`id_hadiah`);

--
-- Indeks untuk tabel `t_kategori`
--
ALTER TABLE `t_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `t_notice`
--
ALTER TABLE `t_notice`
  ADD PRIMARY KEY (`id_notice`),
  ADD KEY `id_peminjaman` (`id_peminjaman`);

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
-- Indeks untuk tabel `t_penukaran`
--
ALTER TABLE `t_penukaran`
  ADD PRIMARY KEY (`id_penukaran`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_hadiah` (`id_hadiah`);

--
-- Indeks untuk tabel `t_register`
--
ALTER TABLE `t_register`
  ADD PRIMARY KEY (`id_register`);

--
-- Indeks untuk tabel `t_registerguru`
--
ALTER TABLE `t_registerguru`
  ADD PRIMARY KEY (`id_registerGuru`);

--
-- Indeks untuk tabel `t_setup`
--
ALTER TABLE `t_setup`
  ADD PRIMARY KEY (`id_setup`);

--
-- Indeks untuk tabel `t_siswa`
--
ALTER TABLE `t_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_user` (`id_user`);

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
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `t_ebook`
--
ALTER TABLE `t_ebook`
  MODIFY `id_ebook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `t_guru`
--
ALTER TABLE `t_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `t_hadiah`
--
ALTER TABLE `t_hadiah`
  MODIFY `id_hadiah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `t_kategori`
--
ALTER TABLE `t_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `t_notice`
--
ALTER TABLE `t_notice`
  MODIFY `id_notice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `t_peminjaman`
--
ALTER TABLE `t_peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `t_pengembalian`
--
ALTER TABLE `t_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `t_register`
--
ALTER TABLE `t_register`
  MODIFY `id_register` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `t_registerguru`
--
ALTER TABLE `t_registerguru`
  MODIFY `id_registerGuru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `t_setup`
--
ALTER TABLE `t_setup`
  MODIFY `id_setup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `t_siswa`
--
ALTER TABLE `t_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- Ketidakleluasaan untuk tabel `t_notice`
--
ALTER TABLE `t_notice`
  ADD CONSTRAINT `t_notice_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `t_peminjaman` (`id_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Ketidakleluasaan untuk tabel `t_penukaran`
--
ALTER TABLE `t_penukaran`
  ADD CONSTRAINT `t_penukaran_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `t_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_penukaran_ibfk_2` FOREIGN KEY (`id_hadiah`) REFERENCES `t_hadiah` (`id_hadiah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_siswa`
--
ALTER TABLE `t_siswa`
  ADD CONSTRAINT `t_siswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
