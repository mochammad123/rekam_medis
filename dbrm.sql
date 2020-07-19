-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2020 at 05:53 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id_hak_akses` tinyint(4) NOT NULL,
  `nama_hak_akses` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id_hak_akses`, `nama_hak_akses`) VALUES
(1, 'karyawan'),
(2, 'dokter'),
(5, 'admin'),
(6, 'kepala');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `id_dokter` tinyint(4) NOT NULL,
  `NIP` char(18) NOT NULL DEFAULT '',
  `nama` varchar(100) DEFAULT NULL,
  `jenis_poli` varchar(20) DEFAULT NULL,
  `jk` varchar(15) DEFAULT NULL,
  `alamat` varchar(40) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dokter`
--

INSERT INTO `tb_dokter` (`id_dokter`, `NIP`, `nama`, `jenis_poli`, `jk`, `alamat`, `no_hp`, `username`) VALUES
(35, '123456789', 'Dr. Endang Suherlan, Sp.T.H.T.K.L., M.kes', 'THT', 'Laki-laki', 'Jln', '098872343322', 'endang');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_poli`
--

CREATE TABLE `tb_jenis_poli` (
  `id_jenis` tinyint(4) NOT NULL,
  `nama_jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jenis_poli`
--

INSERT INTO `tb_jenis_poli` (`id_jenis`, `nama_jenis`) VALUES
(5, 'THT');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id_karyawan` tinyint(4) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `username` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id_karyawan`, `nama`, `tgl_lahir`, `alamat`, `no_hp`, `username`) VALUES
(4, 'Sobri', '1991-03-01', 'Gemawang', '085292331112', 'sobri'),
(5, 'Emiyati', '1989-05-16', 'Samigaluh', '085444923177', 'emiyati'),
(6, 'Moch. Faisal Ediansyah', '1998-06-23', 'Cibiru Raya', '087725343309', 'faisal');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `id_login` tinyint(4) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(32) DEFAULT NULL,
  `posisi` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`id_login`, `username`, `password`, `posisi`) VALUES
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(44, 'amanda', '6209804952225ab3d14348307b5a4a27', 'dokter'),
(41, 'ardian', '46632a526b980b41478ca6078fb02c28', 'dokter'),
(15, 'asep', 'dc855efb0dc7476760afaa1b281665f1', 'admin'),
(43, 'diana', '3a23bb515e06d0e944ff916e79a7775c', 'dokter'),
(45, 'emiyati', '130537f1bc32bdedc0df45e6fc4bb59b', 'karyawan'),
(46, 'endang', '7565a1fb1ffd44d62ba851ce3540b5e4', 'dokter'),
(47, 'faisal', 'f4668288fdbf9773dd9779d412942905', 'karyawan'),
(4, 'kepala', '870f669e4bbbfa8a6fde65549826d1c4', 'kepala'),
(42, 'sobri', 'c4488d5f18f4494949d67b72926a183c', 'karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_obat`
--

CREATE TABLE `tb_obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(30) NOT NULL,
  `jenis_obat` varchar(20) DEFAULT NULL,
  `kategori_obat` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_obat`
--

INSERT INTO `tb_obat` (`id_obat`, `nama_obat`, `jenis_obat`, `kategori_obat`) VALUES
(60, 'Amoxilin 30mg', 'Botol', 'Generik'),
(61, 'Paracetamol 30mg', 'Capsul', 'Paten'),
(62, 'Amoxilin 30mg', 'Botol', 'Paten'),
(63, 'Amoxilin 30mg', 'Botol', 'Generik'),
(64, 'Paracetamol 30mg', 'Sirup', 'Paten'),
(65, 'Paracetamol 30mg', 'Sirup', ''),
(66, 'Paracetamol 30mg', 'Sirup', 'Paten'),
(67, 'Paracetamol 30mg', 'Capsul', ''),
(68, 'Paracetamol 30mg', 'Botol', ''),
(69, 'Paracetamol 30mg', 'Tablet', ''),
(70, 'Paracetamol 30mg', 'Tablet', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `id_pasien` int(11) NOT NULL,
  `NIK` varchar(30) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` varchar(15) DEFAULT NULL,
  `pekerjaan` varchar(20) DEFAULT NULL,
  `alamat` varchar(40) NOT NULL,
  `kontak` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pasien`
--

INSERT INTO `tb_pasien` (`id_pasien`, `NIK`, `nama`, `tempat_lahir`, `tgl_lahir`, `jk`, `pekerjaan`, `alamat`, `kontak`) VALUES
(27, '20121112112', 'Moch. Faisal Ediansyah', 'Jakarta', '2020-06-26', 'Laki-laki', 'Ibu Rumah Tangga', 'Lemah Hegar ', '0877652134444'),
(28, '11333222222', 'Moch. Faisal Ediansyah', 'Bandung', '2020-06-11', 'Laki-laki', 'Belum bekerja', 'Jln. Jend Achmad Yani', '0877652134444'),
(29, '123456789', 'Amin Fachrudin', 'Bandung', '2020-06-24', 'Perempuan', 'Programmer', 'Batununggal Elok Raya No. 16', '087725343308'),
(30, '20121112113', 'Ny. Gilang Sumiarsih', 'Bandung', '2020-06-01', 'Perempuan', 'Belum bekerja', 'Batununggal Elok Raya No. 16', '087725343309'),
(31, '2333311111111', 'Kujang', 'Jakarta', '2020-06-28', 'Perempuan', 'Belum bekerja', 'Batununggal Elok Raya No. 16', '087725343309'),
(32, '3321111999', 'Aminah', 'Bandung', '2020-06-03', 'Laki-laki', 'Pelajar', 'Lemah Hegar ', '0877652134444'),
(33, '33211119994', 'Ayang Kamuuh', 'Jakarta', '2020-06-03', 'Laki-laki', 'Pelajar', 'Jln. Astana Anyar', '087725343307'),
(34, '111111111111', 'Ny. Gilang Sumiarsih', 'Jakarta', '2020-06-04', 'Laki-laki', 'Programmer', 'Jl. Dewi Sartika No. 48 B', '087725343308'),
(35, '332111199911', 'Aminah', 'Bandung', '2014-01-01', 'Laki-laki', 'Ibu Rumah Tangga', 'Lemah Hegar ', '087725343309'),
(36, '11111222', 'Amin Fachrudin', 'Jakarta', '1998-01-15', 'Laki-laki', 'Programmer', 'Lemah Hegar ', '087725343308'),
(37, '11333222222222', 'Amin Fachrudin', 'Bandung', '2007-05-01', 'Laki-laki', 'Belum bekerja', 'Jl. Dewi Sartika No. 48 B', '087725343308');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendaftaran`
--

CREATE TABLE `tb_pendaftaran` (
  `id_rawat` tinyint(4) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_kunjungan` varchar(5) NOT NULL,
  `proses` enum('THT') NOT NULL,
  `status` varchar(20) NOT NULL,
  `keterangan` enum('Selesai','Menunggu...','','') NOT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `id_karyawan` tinyint(4) DEFAULT NULL,
  `no_cm` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pendaftaran`
--

INSERT INTO `tb_pendaftaran` (`id_rawat`, `nama`, `tanggal`, `jenis_kunjungan`, `proses`, `status`, `keterangan`, `id_pasien`, `id_karyawan`, `no_cm`) VALUES
(61, 'Amin Fachrudin', '2020-06-01', 'Baru', 'THT', 'Aktif', 'Selesai', NULL, 6, '1458'),
(62, 'Moch. Faisal Ediansyah', '2020-06-02', 'Lama', 'THT', 'Aktif', 'Selesai', NULL, 6, '0689'),
(83, 'Moch. Faisal Ediansyah', '2020-07-01', 'Baru', 'THT', 'Aktif', 'Menunggu...', 27, 6, '0157');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rekam_medis`
--

CREATE TABLE `tb_rekam_medis` (
  `no_rm` int(11) NOT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `tgl_rekam` date NOT NULL,
  `NIP` char(18) DEFAULT NULL,
  `periksa` varchar(30) NOT NULL,
  `diagnosa` varchar(30) NOT NULL,
  `tindakan` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rekam_medis`
--

INSERT INTO `tb_rekam_medis` (`no_rm`, `id_pasien`, `tgl_rekam`, `NIP`, `periksa`, `diagnosa`, `tindakan`) VALUES
(250, 28, '2020-06-01', '123456789', '', '', ''),
(251, 28, '2020-06-01', '123456789', 'a', 'b', 'c'),
(252, 28, '2020-06-01', '123456789', '', '', ''),
(253, 28, '2020-06-01', '123456789', '', '', ''),
(254, 28, '2020-06-01', '123456789', 'a', 'b', 'c'),
(255, 28, '2020-06-01', '123456789', 'c', 'w', 'q'),
(256, 28, '2020-06-01', '123456789', '', '', ''),
(257, 28, '2020-06-01', '123456789', '', '', ''),
(258, 28, '2020-06-01', '123456789', 'aaa', 'ddd', 'ggg'),
(259, 28, '2020-06-01', '123456789', '', '', ''),
(260, 28, '2020-06-01', '123456789', 'Oke', 'Maju ', 'HHAHAHA'),
(261, 28, '2020-06-01', '123456789', '', '', ''),
(262, 28, '2020-06-01', '123456789', '', '', ''),
(263, 27, '2020-07-01', '123456789', 'a', 'v', 'cc'),
(264, 27, '2020-07-01', '123456789', '', '', ''),
(265, 27, '2020-07-01', '123456789', '', '', ''),
(266, 27, '2020-07-01', '123456789', 'a', 's', 'ddddddddg'),
(267, 27, '2020-07-01', '123456789', 'aaa', 'aaaaaaa', 'aaaaaaaaaaaa'),
(268, 27, '2020-07-01', '123456789', 'apa', 'sss', 'yaddd'),
(269, 27, '2020-07-01', '123456789', 'aaaaav', 'hahaha', 'ccccccq'),
(270, 27, '2020-07-01', '123456789', 'sakit', 'hati', 'dan jiwa'),
(271, 27, '2020-07-01', '123456789', '', '', ''),
(272, 27, '2020-07-01', '123456789', '', '', ''),
(273, 27, '2020-07-01', '123456789', 'xxx', 'xxxxx', 'xxxxxxx'),
(274, 27, '2020-07-01', '123456789', '', '', ''),
(275, 27, '2020-07-01', '123456789', 'Sehat', 'Sakit Jiwa', 'Mati'),
(276, 27, '2020-07-01', '123456789', 'aa', 'bb', 'cc'),
(277, 27, '2020-07-01', '123456789', 'vv', 'cvd', 'vd'),
(278, 27, '2020-07-01', '123456789', '', '', ''),
(279, 27, '2020-07-01', '123456789', '', '', ''),
(280, 27, '2020-07-01', '123456789', 'a', 'c', 'b');

-- --------------------------------------------------------

--
-- Table structure for table `tb_resep_obat`
--

CREATE TABLE `tb_resep_obat` (
  `kode_resep` int(11) NOT NULL,
  `id_obat` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `no_rm` int(11) NOT NULL,
  `status` enum('Diambil','Belum Diambil','Tidak Ada Obat','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `tb_resep_obat`
--
DELIMITER $$
CREATE TRIGGER `kurangi_stok` AFTER INSERT ON `tb_resep_obat` FOR EACH ROW Begin
UPDATE tb_obat set stok_obat=stok_obat-NEW.jumlah where id_obat=NEW.id_obat;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `status_bayar` enum('Belum Lunas','Lunas','','') NOT NULL,
  `no_rm` int(11) DEFAULT NULL,
  `Total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`nama_hak_akses`),
  ADD KEY `id_hak_akses` (`id_hak_akses`);

--
-- Indexes for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`NIP`),
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `fk2` (`jenis_poli`),
  ADD KEY `id_login` (`username`);

--
-- Indexes for table `tb_jenis_poli`
--
ALTER TABLE `tb_jenis_poli`
  ADD PRIMARY KEY (`nama_jenis`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id_login` (`id_login`),
  ADD KEY `fk1` (`posisi`);

--
-- Indexes for table `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  ADD PRIMARY KEY (`id_rawat`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `tb_rekam_medis`
--
ALTER TABLE `tb_rekam_medis`
  ADD PRIMARY KEY (`no_rm`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `nip` (`NIP`);

--
-- Indexes for table `tb_resep_obat`
--
ALTER TABLE `tb_resep_obat`
  ADD PRIMARY KEY (`kode_resep`),
  ADD KEY `kode_resep` (`kode_resep`),
  ADD KEY `no_rm` (`no_rm`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `no_rm` (`no_rm`),
  ADD KEY `fk3` (`id_pasien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_hak_akses` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  MODIFY `id_dokter` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_jenis_poli`
--
ALTER TABLE `tb_jenis_poli`
  MODIFY `id_jenis` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `id_karyawan` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id_login` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tb_obat`
--
ALTER TABLE `tb_obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  MODIFY `id_rawat` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tb_rekam_medis`
--
ALTER TABLE `tb_rekam_medis`
  MODIFY `no_rm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT for table `tb_resep_obat`
--
ALTER TABLE `tb_resep_obat`
  MODIFY `kode_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD CONSTRAINT `fk22` FOREIGN KEY (`jenis_poli`) REFERENCES `tb_jenis_poli` (`nama_jenis`) ON DELETE CASCADE ON UPDATE SET NULL,
  ADD CONSTRAINT `tb_dokter_ibfk_1` FOREIGN KEY (`username`) REFERENCES `tb_login` (`username`);

--
-- Constraints for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD CONSTRAINT `tb_karyawan_ibfk_1` FOREIGN KEY (`username`) REFERENCES `tb_login` (`username`);

--
-- Constraints for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`posisi`) REFERENCES `hak_akses` (`nama_hak_akses`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  ADD CONSTRAINT `fk53` FOREIGN KEY (`id_karyawan`) REFERENCES `tb_karyawan` (`id_karyawan`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pendaftaran_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `tb_pasien` (`id_pasien`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tb_rekam_medis`
--
ALTER TABLE `tb_rekam_medis`
  ADD CONSTRAINT `fk88` FOREIGN KEY (`id_pasien`) REFERENCES `tb_pasien` (`id_pasien`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk99` FOREIGN KEY (`NIP`) REFERENCES `tb_dokter` (`NIP`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tb_resep_obat`
--
ALTER TABLE `tb_resep_obat`
  ADD CONSTRAINT `tb_resep_obat_ibfk_1` FOREIGN KEY (`no_rm`) REFERENCES `tb_rekam_medis` (`no_rm`),
  ADD CONSTRAINT `tb_resep_obat_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `tb_obat` (`id_obat`);

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `fk3` FOREIGN KEY (`id_pasien`) REFERENCES `tb_pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk70` FOREIGN KEY (`no_rm`) REFERENCES `tb_rekam_medis` (`no_rm`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
