-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2020 at 09:00 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `skripsi_andre`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
`ID_ADMIN` int(255) NOT NULL,
  `USERNAME` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(64) DEFAULT NULL,
  `NAMA` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`ID_ADMIN`, `USERNAME`, `PASSWORD`, `NAMA`, `EMAIL`) VALUES
(1, 'admin', '0cc175b9c0f1b6a831c399e269772661', 'RIZAL', 'ali@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_anggota`
--

CREATE TABLE IF NOT EXISTS `tbl_anggota` (
`ID_SISWA` int(11) NOT NULL,
  `NIS` varchar(20) DEFAULT NULL,
  `NAMA_SISWA` varchar(255) DEFAULT NULL,
  `TEMPAT_LAHIR` varchar(255) DEFAULT NULL,
  `TGL_LAHIR` varchar(255) DEFAULT NULL,
  `JENIS_KELAMIN` int(1) DEFAULT NULL,
  `NO_TELP` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `ALAMAT` varchar(255) DEFAULT NULL,
  `FOTO` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(64) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_anggota`
--

INSERT INTO `tbl_anggota` (`ID_SISWA`, `NIS`, `NAMA_SISWA`, `TEMPAT_LAHIR`, `TGL_LAHIR`, `JENIS_KELAMIN`, `NO_TELP`, `EMAIL`, `ALAMAT`, `FOTO`, `PASSWORD`) VALUES
(1, '12345', 'ANDRE', 'MALANG', '2017-05-16', 1, '08998389044', 'rieezal.rahman@gmail.com', 'halo dunia123', 'rsz_logo_jpeg.jpg', '0cc175b9c0f1b6a831c399e269772661');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku`
--

CREATE TABLE IF NOT EXISTS `tbl_buku` (
`ID_BUKU` int(11) NOT NULL,
  `ISBN` varchar(20) DEFAULT NULL,
  `NM_BUKU` varchar(255) DEFAULT NULL,
  `DES_BUKU` varchar(500) DEFAULT NULL,
  `STOK` int(11) NOT NULL,
  `ID_PENERBIT` int(11) NOT NULL,
  `ID_PENULIS` int(11) NOT NULL,
  `ID_RAKBUKU` int(11) NOT NULL,
  `EBOOK` varchar(255) DEFAULT NULL,
  `GAMBAR` varchar(255) DEFAULT NULL,
  `TGL_POST` varchar(10) DEFAULT NULL,
  `WKT_POST` varchar(8) DEFAULT NULL,
  `STS_PUBLISH` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_buku`
--

INSERT INTO `tbl_buku` (`ID_BUKU`, `ISBN`, `NM_BUKU`, `DES_BUKU`, `STOK`, `ID_PENERBIT`, `ID_PENULIS`, `ID_RAKBUKU`, `EBOOK`, `GAMBAR`, `TGL_POST`, `WKT_POST`, `STS_PUBLISH`) VALUES
(2, '9786020321844', 'Traveling Is Possible!', 'SELALU ADA JALAN UNTUK KITA YANG SUKA JALANJALAN\r\n\r\nSetiap orang memiliki destinasi impian Sayangnya masalah biaya waktu izinvisa atau\r\nketakutan rmenghadapi dunia luar dan budaya asing kadang membuat kita ragu untuk melakukan\r\nperjalanan ke destinasi impian kita Buku ini akan menjadi jembatan kita untuk tetap optimistis\r\nberfokus dan bersemangat mewujudkan perjalanan impian kita', 42, 1, 2, 1, '', 'traveling-is-possible_.jpg', '2017-04-23', '22:05:59', '1'),
(3, '9786027572362', '50 Kreasi Bento Rumahan', 'Sering bingung ketika akan menyiapkan sarapan ataupun bekal makan siang anak ke sekolah Bento adalah solusinya Dengan berbagai macam bentuk yang lucu dan menarik anak Anda pasti lebih bersemangat menghabiskan makanannya Dalam buku 50 Kreasi Bento Rumahan ini Anda akan dibimbing step by step menyiapkan bekal untuk si kecil', 7, 1, 1, 2, '', 'ID_STIL2016MTH05KBR_C.jpg', '2017-04-23', '22:29:18', '1'),
(4, '9786020324418', 'Technical Analysis for Mega Profit', 'Saya kira sudah lama para investor Indonesia membutuhkan buku berkualitas seperti ini Penyajiannyasangat terstruktur lengkap dan jelas Ini adalah buku wajib bagi setiap investor dan traderJendral Purn M Yunus Yosfi ah  Anggota DPR Komisi XI dan Mantan Menteri Penerangan RISaya percaya buku ini akan menjadi salah satu tonggak terpenting perkembangan Analisis Teknikal diIndonesia ke arah yang lebih baikProf Dr Ir Singgih Riphat MA', 9, 1, 3, 1, '', 'ID_GPU2016MTH06TAFMP_C.jpg', '2017-04-23', '23:24:34', '1'),
(5, '978934693419', 'Cascading Style Sheets:Solusi Mempercantik Halaman Web(Css)', '', 48, 1, 2, 1, '', '200034909_xl.jpg', '2017-04-24', '10:29:14', '1'),
(6, '9786024282707', 'Scrambled ~We Are Scrambled!~', 'Aku ingin membuat band di sekolah baruku ini\r\nSetelah pindah sekolah Filan Sebastian memutuskan untuk membuat sebuah band bersama temantemannya yang baru\r\n\r\nAda visi sepupu Filan yang pemalu Axel yang pendiam Valent yang populer tapi misterius dan Hosea kakak kelas yang baik banget\r\n\r\nIni awal perjalann dari band bernama SCRAMBLED', 37, 1, 3, 2, '', '9786024282707_scrambled-_we-are-scrambled_.jpg', '2017-04-28', '18:18:49', '1'),
(7, '9789792905526', 'Php Secret For Webmaster', 'Ramai diperbincangkan di milis atau forum mengenai SEO Search Engine Optimization Apa yang saya tulis di buku ini merupakan dokumentasi dari pengalaman saya dalam membuat web yang benarbenar terindex sepenuhnya oleh search engine Google Yahoo Saya sering bereksperimendenagn bebagai macam cara seluruh content web masuk ke search engine Dan teknik best practice iniliah yang berasal dari pengalaman saya sendiri yang terjabarkan dengan gamblang dan mudah untuk dipahami oleh para pembaca Apa itu regi', 8, 2, 3, 2, '', '200078890_xl.jpg', '2017-05-09', '18:01:19', '1'),
(8, '200091582', 'Konstruksi Pola Busana Wanita', 'Dunia mode pakaian wanita kini berkembang sangat pesat Buku ini menyajikan gambargambar konstruksi pola dasar pakaian wanita yang up to date mulai dari model leher lengan kerah dari berbagai busana nasional Asia Eropa dan perpaduannya Dengan memiliki buku ini Anda akan mampu membuat dan bahkan mengembangkan sendiri gaun yang sesuai dengan citarasa dan kepribadian Anda', 12, 2, 3, 3, 'Tahlil.doc', '9789796877928.jpg', '2017-05-24', '23:44:40', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info`
--

CREATE TABLE IF NOT EXISTS `tbl_info` (
`ID_INFO` int(10) NOT NULL,
  `JUDUL_WEBSITE` varchar(255) DEFAULT NULL,
  `ALAMAT` varchar(255) DEFAULT NULL,
  `LOGO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_info`
--

INSERT INTO `tbl_info` (`ID_INFO`, `JUDUL_WEBSITE`, `ALAMAT`, `LOGO`) VALUES
(1, 'Perpustakaan', 'JL Mawar melati', 'Koala.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keranjangsewa`
--

CREATE TABLE IF NOT EXISTS `tbl_keranjangsewa` (
`ID_KERANJANGSEWA` int(11) NOT NULL,
  `ID_TRANSAKSI` varchar(30) DEFAULT NULL,
  `ID_BUKU` int(11) DEFAULT NULL,
  `QTY` int(11) DEFAULT NULL,
  `STS_ACTIVE` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_keranjangsewa`
--

INSERT INTO `tbl_keranjangsewa` (`ID_KERANJANGSEWA`, `ID_TRANSAKSI`, `ID_BUKU`, `QTY`, `STS_ACTIVE`) VALUES
(1, '20191223014219', 8, 1, 1),
(2, '20200223054405', 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penerbit`
--

CREATE TABLE IF NOT EXISTS `tbl_penerbit` (
`ID_PENERBIT` int(11) NOT NULL,
  `NAMA_PENERBIT` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `NO_TELP` varchar(255) DEFAULT NULL,
  `FOTO` varchar(255) DEFAULT NULL,
  `ALAMAT` varchar(255) DEFAULT NULL,
  `WEBSITE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penerbit`
--

INSERT INTO `tbl_penerbit` (`ID_PENERBIT`, `NAMA_PENERBIT`, `EMAIL`, `NO_TELP`, `FOTO`, `ALAMAT`, `WEBSITE`) VALUES
(1, 'Gramedia Pustaka Utama', NULL, NULL, NULL, NULL, NULL),
(2, 'Diroz Pustaka', 'rieezal.rahman@gmail.com', '08998389044', 'DIROZ LOGO.jpg', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penulis`
--

CREATE TABLE IF NOT EXISTS `tbl_penulis` (
`ID_PENULIS` int(11) NOT NULL,
  `NAMA_PENULIS` varchar(255) DEFAULT NULL,
  `ALAMAT` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `WEBSITE` varchar(255) DEFAULT NULL,
  `NO_TELP` varchar(20) DEFAULT NULL,
  `FOTO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penulis`
--

INSERT INTO `tbl_penulis` (`ID_PENULIS`, `NAMA_PENULIS`, `ALAMAT`, `EMAIL`, `WEBSITE`, `NO_TELP`, `FOTO`) VALUES
(1, 'Ika Natassa', NULL, NULL, NULL, NULL, NULL),
(2, 'Tere Liye', NULL, NULL, NULL, NULL, NULL),
(3, 'Yas Marina', NULL, NULL, NULL, NULL, NULL),
(4, 'Naoko Takeuchi', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rakbuku`
--

CREATE TABLE IF NOT EXISTS `tbl_rakbuku` (
`ID_RAKBUKU` int(11) NOT NULL,
  `NAMA_RAKBUKU` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rakbuku`
--

INSERT INTO `tbl_rakbuku` (`ID_RAKBUKU`, `NAMA_RAKBUKU`) VALUES
(1, 'Aksi'),
(2, 'Komedi'),
(3, 'Teknologi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sewa`
--

CREATE TABLE IF NOT EXISTS `tbl_sewa` (
`ID_SEWA` int(11) NOT NULL,
  `ID_TRANSAKSI` varchar(30) DEFAULT NULL,
  `TGL_SEWA` varchar(10) DEFAULT NULL,
  `TGL_AMBIL` varchar(10) DEFAULT NULL,
  `WKT_SEWA` varchar(8) DEFAULT NULL,
  `TGL_KEMBALI` varchar(10) DEFAULT NULL,
  `ID_SISWA` int(11) DEFAULT NULL,
  `STS_CONFIRM` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sewa`
--

INSERT INTO `tbl_sewa` (`ID_SEWA`, `ID_TRANSAKSI`, `TGL_SEWA`, `TGL_AMBIL`, `WKT_SEWA`, `TGL_KEMBALI`, `ID_SISWA`, `STS_CONFIRM`) VALUES
(1, '20191223014219', '2019-12-23', '2019-12-23', '19:44:51', '2019-12-23', 1, 3),
(2, '20200223054405', '2020-02-23', NULL, '11:45:33', NULL, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
 ADD PRIMARY KEY (`ID_ADMIN`);

--
-- Indexes for table `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
 ADD PRIMARY KEY (`ID_SISWA`);

--
-- Indexes for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
 ADD PRIMARY KEY (`ID_BUKU`), ADD UNIQUE KEY `ID_BUKU` (`ID_BUKU`);

--
-- Indexes for table `tbl_info`
--
ALTER TABLE `tbl_info`
 ADD PRIMARY KEY (`ID_INFO`);

--
-- Indexes for table `tbl_keranjangsewa`
--
ALTER TABLE `tbl_keranjangsewa`
 ADD PRIMARY KEY (`ID_KERANJANGSEWA`);

--
-- Indexes for table `tbl_penerbit`
--
ALTER TABLE `tbl_penerbit`
 ADD PRIMARY KEY (`ID_PENERBIT`);

--
-- Indexes for table `tbl_penulis`
--
ALTER TABLE `tbl_penulis`
 ADD PRIMARY KEY (`ID_PENULIS`);

--
-- Indexes for table `tbl_rakbuku`
--
ALTER TABLE `tbl_rakbuku`
 ADD PRIMARY KEY (`ID_RAKBUKU`);

--
-- Indexes for table `tbl_sewa`
--
ALTER TABLE `tbl_sewa`
 ADD PRIMARY KEY (`ID_SEWA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
MODIFY `ID_ADMIN` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
MODIFY `ID_SISWA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
MODIFY `ID_BUKU` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_info`
--
ALTER TABLE `tbl_info`
MODIFY `ID_INFO` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_keranjangsewa`
--
ALTER TABLE `tbl_keranjangsewa`
MODIFY `ID_KERANJANGSEWA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_penerbit`
--
ALTER TABLE `tbl_penerbit`
MODIFY `ID_PENERBIT` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_penulis`
--
ALTER TABLE `tbl_penulis`
MODIFY `ID_PENULIS` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_rakbuku`
--
ALTER TABLE `tbl_rakbuku`
MODIFY `ID_RAKBUKU` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_sewa`
--
ALTER TABLE `tbl_sewa`
MODIFY `ID_SEWA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
