-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 11 Sep 2019 pada 13.54
-- Versi Server: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.3.8-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rawat_jalan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_child_transaksi`
--

CREATE TABLE `tb_child_transaksi` (
  `id` int(10) NOT NULL,
  `jenis` enum('terapi','herbal') NOT NULL,
  `item_id` int(11) NOT NULL,
  `terapis_id` int(11) NOT NULL,
  `biaya` decimal(19,0) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `subtotal` decimal(19,0) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_obat`
--

CREATE TABLE `tb_detail_obat` (
  `id_detail_obat` int(11) NOT NULL,
  `kode_regristrasi` int(11) DEFAULT NULL,
  `kode_obat` varchar(25) DEFAULT NULL,
  `jumlah_produk` int(50) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detail_obat`
--

INSERT INTO `tb_detail_obat` (`id_detail_obat`, `kode_regristrasi`, `kode_obat`, `jumlah_produk`) VALUES
(69, 40, 'OB004', 1),
(70, 40, 'OB001', 1),
(73, 41, 'OB003', 1),
(74, 46, 'OB001', 6),
(75, 46, 'OB003', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_tindakan`
--

CREATE TABLE `tb_detail_tindakan` (
  `id_detail_tindakan` int(11) NOT NULL,
  `kode_regristrasi` int(11) DEFAULT NULL,
  `kode_tindakan` varchar(35) DEFAULT NULL,
  `terapis_id` int(20) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detail_tindakan`
--

INSERT INTO `tb_detail_tindakan` (`id_detail_tindakan`, `kode_regristrasi`, `kode_tindakan`, `terapis_id`, `tanggal`) VALUES
(53, 40, 'TN003', 4, '2019-09-11 02:42:50'),
(54, 40, 'TN005', 6, '2019-09-11 02:42:53'),
(56, 40, 'TN006', 7, '2019-09-11 02:43:12'),
(59, 43, 'TN001', NULL, '2019-09-11 03:11:29'),
(60, 46, 'TN002', 7, '2019-09-11 04:18:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `kode_dokter` int(11) NOT NULL,
  `nama_dokter` varchar(35) DEFAULT NULL,
  `alamat` text,
  `telp` double DEFAULT NULL,
  `kode_poliklinik` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_dokter`
--

INSERT INTO `tb_dokter` (`kode_dokter`, `nama_dokter`, `alamat`, `telp`, `kode_poliklinik`) VALUES
(4, 'Terapis 1', 'alamat 1', 86222222, '1'),
(5, 'Terapis 2', 'alamat 2', 457779992, '2'),
(6, 'Terapis 3', 'alamat 3', 12357354, '3'),
(7, 'Terapis 4', 'alamat 4', 2324234, '4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_obat`
--

CREATE TABLE `tb_obat` (
  `kode_obat` varchar(35) NOT NULL,
  `nama_obat` varchar(45) DEFAULT NULL,
  `harga_beli` double DEFAULT NULL,
  `harga_jual` double DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_obat`
--

INSERT INTO `tb_obat` (`kode_obat`, `nama_obat`, `harga_beli`, `harga_jual`, `stok`) VALUES
('OB001', 'G10', 45000, 120000, 10),
('OB002', 'G17', 35000, 110000, 15),
('OB003', 'G12', 75000, 175000, 12),
('OB004', 'Biozime', 35000, 100000, 35);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_parent_transaksi`
--

CREATE TABLE `tb_parent_transaksi` (
  `transaksi_id` int(10) NOT NULL,
  `pasien_id` int(10) NOT NULL,
  `oprator_id` int(10) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `kode_pasien` varchar(35) NOT NULL,
  `nama_pasien` varchar(50) DEFAULT NULL,
  `alamat` text,
  `jk` enum('L','P') DEFAULT NULL,
  `umur` int(11) DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `golongan_darah` char(5) DEFAULT NULL,
  `transaksi_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pasien`
--

INSERT INTO `tb_pasien` (`kode_pasien`, `nama_pasien`, `alamat`, `jk`, `umur`, `agama`, `pekerjaan`, `telepon`, `golongan_darah`, `transaksi_id`) VALUES
('RM0000002', 'Kosasih', 'Bojonggede', 'L', 12, NULL, NULL, NULL, NULL, NULL),
('RM0000003', 'Lutfi', 'Cibinong', 'L', 23, NULL, NULL, NULL, NULL, 47);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_poliklinik`
--

CREATE TABLE `tb_poliklinik` (
  `kode_poliklinik` int(11) NOT NULL,
  `nama_poliklinik` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_poliklinik`
--

INSERT INTO `tb_poliklinik` (`kode_poliklinik`, `nama_poliklinik`) VALUES
(1, 'Kamar 1'),
(2, 'Kamar 2'),
(3, 'Kamar 3'),
(4, 'Kamar 4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_regristrasi`
--

CREATE TABLE `tb_regristrasi` (
  `kode_regristrasi` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kode_pasien` varchar(25) DEFAULT NULL,
  `total` decimal(19,0) DEFAULT NULL,
  `tanggal_selesai` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `jenis_tindakan` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_regristrasi`
--

INSERT INTO `tb_regristrasi` (`kode_regristrasi`, `tanggal`, `kode_pasien`, `total`, `tanggal_selesai`, `jenis_tindakan`) VALUES
(40, '2019-09-09', 'RM0000001', '0', '2019-09-10 01:42:22', 'rawat_inap'),
(41, '2019-09-10', 'RM0000002', '0', '2019-09-11 03:23:59', 'rawat_jalan'),
(46, '2019-09-11', 'RM0000003', '0', '2019-09-11 04:10:00', 'rawat_jalan'),
(47, '2019-09-11', 'RM0000003', '0', '2019-09-11 05:30:10', 'rawat_jalan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tindakan`
--

CREATE TABLE `tb_tindakan` (
  `kode_tindakan` varchar(25) NOT NULL,
  `nama_tindakan` varchar(35) DEFAULT NULL,
  `harga` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_tindakan`
--

INSERT INTO `tb_tindakan` (`kode_tindakan`, `nama_tindakan`, `harga`) VALUES
('TN001', 'MTR Kranial', 100000),
('TN002', 'MTR Totok Wajah', 100000),
('TN003', 'Bekam', 100000),
('TN004', 'Al Fasdhu', 100000),
('TN005', 'Akupuntur', 150000),
('TN006', 'Paket Rawat Inap 7hari', 1500000),
('TN007', 'Pake Rawat Inap 1 bulan', 7000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(35) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `jabatan` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `jabatan`) VALUES
(1, 'admin', 'admin', 'Admin'),
(2, 'dokter', 'dokter', 'Dokter'),
(3, 'apoteker', 'apoteker', 'Apoteker'),
(4, 'ikin', 'ikin', 'Dokter');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_detail_obat`
--
ALTER TABLE `tb_detail_obat`
  ADD PRIMARY KEY (`id_detail_obat`);

--
-- Indexes for table `tb_detail_tindakan`
--
ALTER TABLE `tb_detail_tindakan`
  ADD PRIMARY KEY (`id_detail_tindakan`);

--
-- Indexes for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`kode_dokter`);

--
-- Indexes for table `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`kode_obat`);

--
-- Indexes for table `tb_parent_transaksi`
--
ALTER TABLE `tb_parent_transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`kode_pasien`);

--
-- Indexes for table `tb_poliklinik`
--
ALTER TABLE `tb_poliklinik`
  ADD PRIMARY KEY (`kode_poliklinik`);

--
-- Indexes for table `tb_regristrasi`
--
ALTER TABLE `tb_regristrasi`
  ADD PRIMARY KEY (`kode_regristrasi`);

--
-- Indexes for table `tb_tindakan`
--
ALTER TABLE `tb_tindakan`
  ADD PRIMARY KEY (`kode_tindakan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_detail_obat`
--
ALTER TABLE `tb_detail_obat`
  MODIFY `id_detail_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `tb_detail_tindakan`
--
ALTER TABLE `tb_detail_tindakan`
  MODIFY `id_detail_tindakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  MODIFY `kode_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_parent_transaksi`
--
ALTER TABLE `tb_parent_transaksi`
  MODIFY `transaksi_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_poliklinik`
--
ALTER TABLE `tb_poliklinik`
  MODIFY `kode_poliklinik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_regristrasi`
--
ALTER TABLE `tb_regristrasi`
  MODIFY `kode_regristrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
