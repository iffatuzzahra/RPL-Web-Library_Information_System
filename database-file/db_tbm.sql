-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Bulan Mei 2020 pada 05.43
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tbm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `IdAnggota` varchar(20) NOT NULL,
  `PIN` int(11) NOT NULL,
  `NamaAnggota` varchar(30) NOT NULL,
  `AlamatAnggota` text NOT NULL,
  `Pekerjaan` varchar(30) NOT NULL,
  `Instansi` varchar(30) NOT NULL,
  `NoHpWa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`IdAnggota`, `PIN`, `NamaAnggota`, `AlamatAnggota`, `Pekerjaan`, `Instansi`, `NoHpWa`) VALUES
('086/p-18', 2716, 'Nia Yulita', 'Andalas', 'Pelajar', 'MTsN 1 Matur', '0280092811'),
('087/l-18', 1126, 'Ahdan Zaim', 'Lawang', 'Pelajar', 'SDN 16 Pc.Lawang', '098862441311'),
('088/l-18', 7727, 'Izzuddin Azzaky', 'Lawang', 'Pelajar', 'MAN 1 Padang', '097676755342'),
('089/p-19', 8088, 'Indahyani', 'Sulawesi Selatan', 'Mahasiswa', 'Teknik Informatika UPN veteran', '08776465554'),
('090/l-19', 9969, 'Lovely Kitty', 'Lubuk Linggau', 'Mahasiswa', 'UPN veteran Yogyakarta', '087779765665'),
('091/p-19', 7753, 'Iffatuz Zahra', 'Padang', 'Mahasiswa', 'UPN veteran Yogyakarta', '086565172727'),
('092/l-19', 1695, 'ahmad dahlan', 'Jakarta', 'pengusaha', 'PT.Karya Indah', '087715272515');

-- --------------------------------------------------------

--
-- Struktur dari tabel `answer`
--

CREATE TABLE `answer` (
  `KodeA` int(11) NOT NULL,
  `IsiA` text NOT NULL,
  `IdPetugas` varchar(20) NOT NULL,
  `KodeQ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `answer`
--

INSERT INTO `answer` (`KodeA`, `IsiA`, `IdPetugas`, `KodeQ`) VALUES
(1, 'A : Silakan datang langsung ke TBM-Prestasi lawang tigo balai untuk mengambil formulir pendaftaran', '001', 3),
(3, 'A : Tentu aja boleh,, Silahkan ajukan surat permohonan ke perpustakaan TBM-Prestasi Lawang tigo balai, surat dapat diserahkan kepada petugas yang sedang berjaga, terimakasih', '002', 7),
(4, 'A : silahkan bertanya kepada petugas perpustakaan atau anda dapat melihat melalui website ini', '001', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `aset`
--

CREATE TABLE `aset` (
  `IdAset` int(3) NOT NULL,
  `JenisAset` varchar(30) NOT NULL,
  `JumlahAset` int(11) NOT NULL,
  `Keterangan` varchar(30) NOT NULL,
  `NoKwitansi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aset`
--

INSERT INTO `aset` (`IdAset`, `JenisAset`, `JumlahAset`, `Keterangan`, `NoKwitansi`) VALUES
(1, 'Busa Lantai 2x1/2 m', 2, 'Digunakan', '2018/002'),
(2, 'Meja 3x2x1/2 m', 1, 'Digunakan', '2018/002'),
(3, 'Rak Sepatu 3 Tingkat', 1, 'Digunakan', '2019/002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `IdBuku` int(4) NOT NULL,
  `JudulBuku` varchar(60) NOT NULL,
  `Pengarang` varchar(120) NOT NULL,
  `Penerbit` varchar(30) NOT NULL,
  `TahunTerbit` int(11) NOT NULL,
  `Status` varchar(30) NOT NULL,
  `NoKwitansi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`IdBuku`, `JudulBuku`, `Pengarang`, `Penerbit`, `TahunTerbit`, `Status`, `NoKwitansi`) VALUES
(1, 'Pesona Tanaman Hias dalam Pot', 'Barmin', 'CV.Ricardo', 2008, 'Diarsipkan', '2018/001'),
(2, 'Seni Kerajinan Bambu', 'Soedjono BSC', 'Angkasa Bandung', 2008, 'Dipinjam', '2018/007'),
(3, 'Seni Kerajinan Ukir Kayu', 'Soedjono BSC', 'Angkasa Bandung', 2008, 'Dipinjam', '2018/007'),
(4, 'Seni Kerajinan Ukir Kayu', 'Soedjono BSC', 'Angkasa Bandung', 2008, 'Disumbangkan', '2018/007'),
(5, 'Belajar Menjahit', 'Yulia Nursetyawati', 'Mitra Sarana', 2006, 'Dikembalikan', '2018/007'),
(6, 'Mengenal Undur-Undur', 'Tim PPLH', 'CV.Ricardo', 2008, 'Dikembalikan', '2018/007'),
(7, 'Mengenal Undur-Undur', 'Tim PPLH', 'CV.Ricardo', 2008, 'Dikembalikan', '2018/007'),
(10, 'Matematika SMA Kelas X ktsp Jilid 1', 'MGMP Matematika Indonesia', 'Yudhistira', 2007, 'Dikembalikan', '2019/001'),
(11, 'Matematika SMA Kelas X ktsp Jilid 2', 'MGMP Matematika Indonesia', 'Yudhistira', 2007, 'Dipinjam', '2019/001'),
(12, 'Matematika SMA Kelas XI ktsp Jilid 1', 'MGMP Matematika Indonesia', 'Yudhistira', 2007, 'Dipinjam', '2019/001'),
(13, 'Matematika SMA Kelas XI ktsp Jilid 2', 'MGMP Matematika Indonesia', 'Yudhistira', 2007, 'Dikembalikan', '2019/001'),
(14, 'Rindu', 'Tere Liye', 'Republika', 2018, 'Dikembalikan', '2020/001'),
(15, 'Komik Naruto', 'Misaki', 'MnC', 2010, 'Diarsipkan', '2019/004');

-- --------------------------------------------------------

--
-- Struktur dari tabel `infopetugas`
--

CREATE TABLE `infopetugas` (
  `KodeInfo` int(11) NOT NULL,
  `IsiInfo` text NOT NULL,
  `IdPetugas` varchar(20) NOT NULL,
  `KodeTampil` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `infopetugas`
--

INSERT INTO `infopetugas` (`KodeInfo`, `IsiInfo`, `IdPetugas`, `KodeTampil`) VALUES
(1, 'Perpustakaan TBM-Prestasi tutup selama tiga hari dari tanggal 10-13 maret 2019', '001', '0'),
(4, 'Pepustakaan akan mengadakan lomba memasak pada 5 mei mendatang, bagi yang berkenan untuk ikut bisa mendaftar ke perpustakaan TBM-Prestasi Lawang Tigo Balai, Lomba ini gratis tidak dipungut biaya!', '001', '0'),
(5, 'Terimakasih kepada seluruh pengunjung TBM-Prestasi, saat ini kami sudah memiliki lebih dari 1000 buku di perpustakaan', '001', '1'),
(7, 'perpustakaan libur selama lebaran', '001', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keuangan`
--

CREATE TABLE `keuangan` (
  `NoKwitansi` varchar(20) NOT NULL,
  `JenisTransaksi` varchar(30) NOT NULL,
  `Jumlah` decimal(10,0) NOT NULL,
  `Nominal` int(11) NOT NULL,
  `IdPetugas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keuangan`
--

INSERT INTO `keuangan` (`NoKwitansi`, `JenisTransaksi`, `Jumlah`, `Nominal`, `IdPetugas`) VALUES
('2018/001', 'Pembelian Buku', '1', 130000, '001'),
('2018/002', 'Pembelian Aset', '2', 6000000, '001'),
('2018/003', 'Pendaftaran Anggota Januari', '8', 80000, '001'),
('2018/004', 'Denda Buku Januari', '12', 21000, '001'),
('2018/005', 'Pendaftaran anggota Februari', '20', 200000, '001'),
('2018/006', 'Denda Buku Februari', '21', 66000, '001'),
('2018/007', 'Terima Sumbangan Buku', '6', 0, '001'),
('2019/001', 'Pembelian Buku', '4', 440000, '002'),
('2019/002', 'Pembelian Aset', '1', 20000, '002'),
('2019/003', 'Pembayaran Gaji Petugas', '2', 200000, '002'),
('2019/004', 'Menerima Sumbangan Buku', '1', 0, '001'),
('2020/001', 'Menerima Sumbangan Buku', '1', 0, '002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `KodePeminjaman` int(11) NOT NULL,
  `IdBuku` int(4) NOT NULL,
  `TanggalPinjam` date NOT NULL,
  `TanggalKembali` date NOT NULL,
  `Denda` int(11) NOT NULL,
  `IdAnggota` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`KodePeminjaman`, `IdBuku`, `TanggalPinjam`, `TanggalKembali`, `Denda`, `IdAnggota`) VALUES
(1, 1, '2018-08-11', '2018-08-19', 0, '086/p-18'),
(2, 6, '2018-08-11', '2018-08-14', 0, '086/p-18'),
(4, 3, '2020-04-17', '2020-04-17', 0, '086/p-18'),
(5, 2, '2020-04-02', '2020-04-17', 2000, '086/p-18'),
(8, 4, '2020-04-17', '2020-04-18', 0, '086/p-18'),
(9, 2, '2020-04-17', '0000-00-00', 0, '086/p-18'),
(10, 1, '2020-04-17', '2020-04-18', 0, '086/p-18'),
(12, 4, '2020-04-18', '2020-04-18', 0, '087/l-18'),
(13, 7, '2020-04-02', '2020-04-18', 0, '087/l-18'),
(14, 2, '2020-04-19', '2020-04-20', 0, '090/l-19'),
(15, 6, '2020-04-20', '2020-04-20', 0, '090/l-19'),
(16, 3, '2020-04-20', '0000-00-00', 0, '087/l-18'),
(17, 6, '2020-03-31', '2020-04-21', 7000, '088/l-18'),
(18, 6, '2020-04-11', '2020-04-20', 0, '090/l-19'),
(19, 12, '2020-04-02', '2020-04-21', 6000, '087/l-18'),
(22, 10, '2020-04-21', '2020-04-21', 0, '086/p-18'),
(23, 11, '2020-05-08', '0000-00-00', 0, '090/l-19'),
(24, 12, '2020-05-08', '0000-00-00', 0, '087/l-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `IdPetugas` varchar(10) NOT NULL,
  `NamaPetugas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`IdPetugas`, `NamaPetugas`) VALUES
('001', 'Yusraini'),
('002', 'Alfi Fadli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `question`
--

CREATE TABLE `question` (
  `KodeQ` int(11) NOT NULL,
  `IsiQ` text NOT NULL,
  `IdAnggota` varchar(20) NOT NULL,
  `KodeTampil` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `question`
--

INSERT INTO `question` (`KodeQ`, `IsiQ`, `IdAnggota`, `KodeTampil`) VALUES
(3, 'Q : Bagaimana jika ingin menjadi anggota', '086/p-18', '2'),
(4, 'Q : Baik terimakasih ', '086/p-18', '1'),
(5, 'Q : Kepada siapa saya dapat bertanya mengenai keanggotaan', '086/p-18', '1'),
(6, 'Q : Apakah Saya dapat mengajukan proposal sumbangan ke perpustakaan?', '091/p-19', '0'),
(7, 'Q : Apakah TBM-Prestasi menyediakan magang untuk mahasiswa?? kalau boleh bagaimana prosedur pengajuannya??', '089/p-19', '1'),
(9, 'Q: apakah perpustakaan saat ini membuka lowongan pekerjaan,, karna saya melihat posternya di mading taman kota kemarin ', '088/l-18', '0'),
(13, 'Q : Haloo!!!', '087/l-18', '0'),
(20, 'Q : Assalamualaikum admin', '086/p-18', '0');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`IdAnggota`);

--
-- Indeks untuk tabel `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`KodeA`),
  ADD KEY `fk_answer-question_KodeQ` (`KodeQ`),
  ADD KEY `fk_answer-anggota_IdAnggota` (`IdPetugas`);

--
-- Indeks untuk tabel `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`IdAset`),
  ADD KEY `fk_aset-keuangan_NoKwitansi` (`NoKwitansi`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`IdBuku`),
  ADD KEY `fk_buku-keuangan_NoKwitansi` (`NoKwitansi`);

--
-- Indeks untuk tabel `infopetugas`
--
ALTER TABLE `infopetugas`
  ADD PRIMARY KEY (`KodeInfo`),
  ADD KEY `fk_infopetuga-petugas_IdPetugas` (`IdPetugas`);

--
-- Indeks untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`NoKwitansi`),
  ADD KEY `fk_keuangan-petugas_IdPetugas` (`IdPetugas`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`KodePeminjaman`),
  ADD KEY `fk_peminjaman-anggota_IdAnggota` (`IdAnggota`),
  ADD KEY `fk_peminjaman-buku_IdBuku` (`IdBuku`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`IdPetugas`);

--
-- Indeks untuk tabel `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`KodeQ`),
  ADD KEY `fk_question-petugas_IdPetugas` (`IdAnggota`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `answer`
--
ALTER TABLE `answer`
  MODIFY `KodeA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `aset`
--
ALTER TABLE `aset`
  MODIFY `IdAset` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `IdBuku` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `infopetugas`
--
ALTER TABLE `infopetugas`
  MODIFY `KodeInfo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `KodePeminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `question`
--
ALTER TABLE `question`
  MODIFY `KodeQ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `fk_answer-petugas_IdPetugas` FOREIGN KEY (`IdPetugas`) REFERENCES `petugas` (`IdPetugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_answer-question_KodeQ` FOREIGN KEY (`KodeQ`) REFERENCES `question` (`KodeQ`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `aset`
--
ALTER TABLE `aset`
  ADD CONSTRAINT `fk_aset-keuangan_NoKwitansi` FOREIGN KEY (`NoKwitansi`) REFERENCES `keuangan` (`NoKwitansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `fk_buku-keuangan_NoKwitansi` FOREIGN KEY (`NoKwitansi`) REFERENCES `keuangan` (`NoKwitansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `infopetugas`
--
ALTER TABLE `infopetugas`
  ADD CONSTRAINT `fk_infopetuga-petugas_IdPetugas` FOREIGN KEY (`IdPetugas`) REFERENCES `petugas` (`IdPetugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  ADD CONSTRAINT `fk_keuangan-petugas_IdPetugas` FOREIGN KEY (`IdPetugas`) REFERENCES `petugas` (`IdPetugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `fk_peminjaman-anggota_IdAnggota` FOREIGN KEY (`IdAnggota`) REFERENCES `anggota` (`IdAnggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_peminjaman-buku_IdBuku` FOREIGN KEY (`IdBuku`) REFERENCES `buku` (`IdBuku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_question-anggota_IdAnggota` FOREIGN KEY (`IdAnggota`) REFERENCES `anggota` (`IdAnggota`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
