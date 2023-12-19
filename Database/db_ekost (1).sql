-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Des 2023 pada 13.09
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ekost`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_account`
--

CREATE TABLE `tb_account` (
  `id_account` int(10) NOT NULL,
  `nama_account` varchar(255) NOT NULL,
  `email_account` varchar(255) NOT NULL,
  `password_account` varchar(255) NOT NULL,
  `nohp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_account`
--

INSERT INTO `tb_account` (`id_account`, `nama_account`, `email_account`, `password_account`, `nohp`) VALUES
(6, 'Arif Widiarto', 'arif@gmail.com', 'arif123', '089675456234'),
(7, 'Lesti Kejora', 'lesti@gmail.com', 'lesti', ''),
(8, 'Rizky Billar', 'billar@gmail.com', 'billar', '081234567897');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(10) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `email_admin` varchar(255) NOT NULL,
  `password_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `email_admin`, `password_admin`) VALUES
(1, 'Admin Lesti', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_location`
--

CREATE TABLE `tb_location` (
  `id_location` int(10) NOT NULL,
  `id_pemilik` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `long_location` varchar(255) NOT NULL,
  `lat_location` varchar(255) NOT NULL,
  `harga_perbulan` varchar(255) NOT NULL,
  `harga_per3bulan` varchar(255) NOT NULL,
  `harga_per6bulan` varchar(255) NOT NULL,
  `harga_pertahun` varchar(255) NOT NULL,
  `fasilitas` text NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_location`
--

INSERT INTO `tb_location` (`id_location`, `id_pemilik`, `name`, `long_location`, `lat_location`, `harga_perbulan`, `harga_per3bulan`, `harga_per6bulan`, `harga_pertahun`, `fasilitas`, `alamat_lengkap`, `foto`) VALUES
(21, 6, 'Kost Putri ', '-6.1760543019614', '106.82770729065', '200000', '600000', '1200000', '2400000', 'Lengkap', 'Megawati Makan Tai', 'assets/fotokost/chibii_naruto_hokage_sennin___the_last_by_marcinha20_d9djpeu-414w-2x.png'),
(26, 6, 'Kost A', '-6.2171829796006', '106.81260108948', '100000', '300000', '600000', '1200000', 'Lengkap', 'Jalan Merdeka', 'assets/fotokost/logo2.png'),
(27, 6, 'A', '-6.1970456873398', '106.80238723755', 'A', 'A', 'A', 'A', 'A', 'A', 'assets/fotokost/555-5557176_chibi-naruto-png-naruto-the-last-chibi-transparent.png'),
(28, 6, 'B', '-6.1676916481763', '106.787109375', 'B', 'B', 'B', 'B', 'B', 'B', 'assets/fotokost/lesti.jpg'),
(29, 6, 'C', '-6.1473817973289', '106.7915725708', 'C', 'C', 'C', 'C', 'C', 'C', 'assets/fotokost/lesti2.jpeg'),
(30, 6, 'D', '-6.1756276391479', '106.83732032776', 'D', 'D', 'D', 'D', 'D', 'D', 'assets/fotokost/lesti.jpg'),
(31, 6, 'E', '-6.1560007784709', '106.82916641235', 'E', 'E', 'E', 'E', 'E', 'E', 'assets/fotokost/lesti2.jpeg'),
(32, 6, 'Z', '-6.2511415806683', '106.787109375', 'Z', 'Z', 'Z', 'Z', 'Z', 'Z', 'assets/fotokost/62919-lesti-kejora.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_account`
--
ALTER TABLE `tb_account`
  ADD PRIMARY KEY (`id_account`);

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_location`
--
ALTER TABLE `tb_location`
  ADD PRIMARY KEY (`id_location`),
  ADD KEY `fk_kost` (`id_pemilik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_account`
--
ALTER TABLE `tb_account`
  MODIFY `id_account` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_location`
--
ALTER TABLE `tb_location`
  MODIFY `id_location` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_location`
--
ALTER TABLE `tb_location`
  ADD CONSTRAINT `fk_kost` FOREIGN KEY (`id_pemilik`) REFERENCES `tb_account` (`id_account`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
