-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Sep 2019 pada 09.25
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `engima`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` char(12) NOT NULL,
  `password` varchar(30) NOT NULL,
  `profile_picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`username`, `email`, `phone_number`, `password`, `profile_picture`) VALUES
('fithratulhay', 'fithrah@email.com', '083122279573', 'fithrahengima', 'fithratulhay.jpg'),
('fitpribadi', 'pribadi@email.com', '082114567254', 'pribadi000111', 'fitpribadi.jpg'),
('mrafi', 'mrafi@email.com', '08218866442', 'muhammadr', 'mrafi.jpg'),
('nisrinaaa', 'nisrina@email.com', '08111222321', 'punyanisrina', 'nisrina.jpg'),
('yumna.kh', 'yumna.kh@email.com', '08135578900', 'khairunnisayumna', 'yumnakh.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `film`
--

CREATE TABLE `film` (
  `id_film` int(5) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `durasi` int(3) NOT NULL,
  `tanggal_rilis` date NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` text NOT NULL,
  `rating` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `film`
--

INSERT INTO `film` (`id_film`, `judul`, `durasi`, `tanggal_rilis`, `deskripsi`, `foto`, `rating`) VALUES
(1, 'Lion King', 118, '2019-08-14', 'Simba idolizes his father, King Mufasa, and takes to heart his own royal destiny on the plains of Africa. But not everyone in the kingdom celebrates the new cub\'s arrival. Scar, Mufasa\'s brother -- and former heir to the throne -- has plans of his own. The battle for Pride Rock is soon ravaged with betrayal, tragedy and drama, ultimately resulting in Simba\'s exile. Now, with help from a curious pair of newfound friends, Simba must figure out how to grow up and take back what is rightfully his.', 'lionking.jpeg', 8),
(2, 'Fast & Furious Presents: Hobbs & Shaw', 136, '2019-08-14', 'Brixton Lorr is a cybernetically enhanced soldier who possesses superhuman strength, a brilliant mind and a lethal pathogen that could wipe out half of the world\'s population. It\'s now up to hulking lawman Luke Hobbs and lawless operative Deckard Shaw to put aside their past differences and work together to prevent the seemingly indestructible Lorr from destroying humanity.', 'fastandfurious.jpeg', 7),
(3, 'Dua Garis Biru', 113, '2019-08-07', 'Bima dan Dara adalah sepasang kekasih yang masih duduk di bangku SMA. Pada usia 17 tahun, mereka nekat bersanggama di luar nikah. Dara pun hamil. Keduanya kemudian dihadapkan pada kehidupan yang tak terbayangkan bagi anak seusia mereka, kehidupan sebagai orangtua.', 'duagarisbiru.jpg', 7.5),
(4, 'Bumi Manusia', 181, '2019-08-21', 'Ini adalah kisah dua anak manusia yang meramu cinta di atas pentas pergelutan tanah kolonial awal abad 20. Inilah kisah Minke dan Annelies. Cinta yang hadir di hati Minke untuk Annelies, membuatnya mengalami pergulatan batin tak berkesudahan. Dia, pemuda pribumi, Jawa totok. Sementara Annelies, gadis Indo Belanda anak seorang Nyai. Bapak Minke yang baru saja diangkat jadi Bupati, tak pernah setuju Minke dekat dengankeluarga Nyai, sebab posisi Nyai di masa itu dianggap sama rendah dengan binatang peliharaan.', 'bumimanusia.jpg', 6),
(5, 'Ready or Not', 94, '2019-08-28', 'Grace couldn\'t be happier after she marries the man of her dreams at his family\'s luxurious estate. There\'s just one catch -- she must now hide from midnight until dawn while her new in-laws hunt her down with guns, crossbows and other weapons. As Grace desperately tries to survive the night, she soon finds a way to turn the tables on her not-so-lovable relatives.', 'readyornot.jpeg', 6.5),
(6, 'Gundala', 123, '2019-09-04', 'Gundala is a 2019 Indonesian superhero film based on the comics character Gundala created by Harya “Hasmi” Suraminata in 1969, co-produced by Screenplay Films and BumiLangit Studios, and distributed by Legacy Pictures. It is the first installment in the BumiLangit Cinematic Universe.', 'gundala.jpeg', 7),
(7, 'Twivortiare', 103, '2019-09-04', 'Pertama mereka bertemu, langsung jatuh cinta. Dalam hitungan bulan, mereka menikah. Setelah dua tahun, setelah lelah dengan semua konflik dan pertengkaran yang tak berujung, akhirnya, sang Dokter Bedah yang super sibuk, Beno Wicaksono (REZA RAHARDIAN), dan Sang Bankir sukses, Alexandra Rhea (RAIHAANUN) memutuskan untuk bercerai.', 'twivortiare.jpeg', 6.8),
(8, 'IT Chapter Two', 170, '2019-09-04', 'Defeated by members of the Losers\' Club, the evil clown Pennywise returns 27 years later to terrorize the town of Derry, Maine, once again. Now adults, the childhood friends have long since gone their separate ways. But when people start disappearing, Mike Hanlon calls the others home for one final stand. Damaged by scars from the past, the united Losers must conquer their deepest fears to destroy the shape-shifting Pennywise -- now more powerful than ever.', 'it.jpeg', 8.5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `tanggal`, `waktu`) VALUES
(1, '2019-09-23', '13:15:00'),
(2, '2019-09-23', '15:00:00'),
(3, '2019-09-23', '19:30:00'),
(4, '2019-09-24', '11:45:00'),
(5, '2019-09-24', '14:00:00'),
(6, '2019-09-24', '17:20:00'),
(7, '2019-09-24', '22:00:00'),
(8, '2019-09-25', '12:10:00'),
(9, '2019-09-25', '15:45:00'),
(10, '2019-09-25', '20:20:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Action'),
(2, 'Drama'),
(3, 'Fantasy'),
(4, 'Horror'),
(5, 'Thriller'),
(6, 'Adventure'),
(7, 'Romance');

-- --------------------------------------------------------

--
-- Struktur dari tabel `memberi`
--

CREATE TABLE `memberi` (
  `username` varchar(20) NOT NULL,
  `id_jadwal` int(5) NOT NULL,
  `id_ulasan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `memberi`
--

INSERT INTO `memberi` (`username`, `id_jadwal`, `id_ulasan`) VALUES
('fithratulhay', 1, 2),
('fithratulhay', 6, 1),
('mrafi', 1, 3),
('mrafi', 3, 4),
('nisrinaaa', 2, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menonton`
--

CREATE TABLE `menonton` (
  `username` varchar(20) NOT NULL,
  `id_jadwal` int(5) NOT NULL,
  `no_kursi` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menonton`
--

INSERT INTO `menonton` (`username`, `id_jadwal`, `no_kursi`) VALUES
('fithratulhay', 1, '5'),
('fithratulhay', 6, '19'),
('fitpribadi', 2, '10'),
('fitpribadi', 4, '13'),
('fitpribadi', 5, '6'),
('fitpribadi', 8, '16'),
('mrafi', 1, '6'),
('mrafi', 3, '3'),
('mrafi', 4, '22'),
('mrafi', 5, '8'),
('mrafi', 6, '24'),
('mrafi', 9, '12'),
('nisrinaaa', 1, '7'),
('nisrinaaa', 2, '1'),
('nisrinaaa', 5, '18'),
('nisrinaaa', 8, '18'),
('nisrinaaa', 9, '25'),
('nisrinaaa', 10, '6'),
('yumna.kh', 1, '17'),
('yumna.kh', 2, '7'),
('yumna.kh', 5, '10'),
('yumna.kh', 7, '8'),
('yumna.kh', 9, '5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tayang`
--

CREATE TABLE `tayang` (
  `id_jadwal` int(5) NOT NULL,
  `id_film` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tayang`
--

INSERT INTO `tayang` (`id_jadwal`, `id_film`) VALUES
(1, 4),
(2, 3),
(3, 2),
(5, 6),
(6, 1),
(7, 5),
(8, 2),
(9, 6),
(10, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempat_duduk`
--

CREATE TABLE `tempat_duduk` (
  `id_jadwal` int(5) NOT NULL,
  `no_kursi` int(2) NOT NULL,
  `terisi` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tempat_duduk`
--

INSERT INTO `tempat_duduk` (`id_jadwal`, `no_kursi`, `terisi`) VALUES
(1, 1, 0),
(1, 2, 0),
(1, 3, 0),
(1, 4, 0),
(1, 5, 1),
(1, 6, 1),
(1, 7, 1),
(1, 8, 0),
(1, 9, 0),
(1, 10, 0),
(1, 11, 0),
(1, 12, 0),
(1, 13, 0),
(1, 14, 0),
(1, 15, 0),
(1, 16, 0),
(1, 17, 1),
(1, 18, 0),
(1, 19, 0),
(1, 20, 0),
(1, 21, 0),
(1, 22, 0),
(1, 23, 0),
(1, 24, 0),
(1, 25, 0),
(1, 26, 0),
(1, 27, 0),
(1, 28, 0),
(1, 29, 0),
(1, 30, 0),
(2, 1, 1),
(2, 2, 0),
(2, 3, 0),
(2, 4, 0),
(2, 5, 0),
(2, 6, 0),
(2, 7, 1),
(2, 8, 0),
(2, 9, 0),
(2, 10, 1),
(2, 11, 0),
(2, 12, 0),
(2, 13, 0),
(2, 14, 0),
(2, 15, 0),
(2, 16, 0),
(2, 17, 0),
(2, 18, 0),
(2, 19, 0),
(2, 20, 0),
(2, 21, 0),
(2, 22, 0),
(2, 23, 0),
(2, 24, 0),
(2, 25, 0),
(2, 26, 0),
(2, 27, 0),
(2, 28, 0),
(2, 29, 0),
(2, 30, 0),
(3, 1, 0),
(3, 2, 0),
(3, 3, 1),
(3, 4, 0),
(3, 5, 0),
(3, 6, 0),
(3, 7, 0),
(3, 8, 0),
(3, 9, 0),
(3, 10, 0),
(3, 11, 0),
(3, 12, 0),
(3, 13, 0),
(3, 14, 0),
(3, 15, 0),
(3, 16, 0),
(3, 17, 0),
(3, 18, 0),
(3, 19, 0),
(3, 20, 0),
(3, 21, 0),
(3, 22, 0),
(3, 23, 0),
(3, 24, 0),
(3, 25, 0),
(3, 26, 0),
(3, 27, 0),
(3, 28, 0),
(3, 29, 0),
(3, 30, 0),
(4, 1, 0),
(4, 2, 0),
(4, 3, 0),
(4, 4, 0),
(4, 5, 0),
(4, 6, 0),
(4, 7, 0),
(4, 8, 0),
(4, 9, 0),
(4, 10, 0),
(4, 11, 0),
(4, 12, 0),
(4, 13, 1),
(4, 14, 0),
(4, 15, 0),
(4, 16, 0),
(4, 17, 0),
(4, 18, 0),
(4, 19, 0),
(4, 20, 0),
(4, 21, 0),
(4, 22, 1),
(4, 23, 0),
(4, 24, 0),
(4, 25, 0),
(4, 26, 0),
(4, 27, 0),
(4, 28, 0),
(4, 29, 0),
(4, 30, 0),
(5, 1, 0),
(5, 2, 0),
(5, 3, 0),
(5, 4, 0),
(5, 5, 0),
(5, 6, 1),
(5, 7, 0),
(5, 8, 1),
(5, 9, 0),
(5, 10, 0),
(5, 11, 0),
(5, 12, 0),
(5, 13, 0),
(5, 14, 0),
(5, 15, 0),
(5, 16, 0),
(5, 17, 0),
(5, 18, 1),
(5, 19, 0),
(5, 20, 0),
(5, 21, 0),
(5, 22, 0),
(5, 23, 0),
(5, 24, 0),
(5, 25, 0),
(5, 26, 0),
(5, 27, 0),
(5, 28, 0),
(5, 29, 0),
(5, 30, 0),
(6, 1, 0),
(6, 2, 0),
(6, 3, 0),
(6, 4, 0),
(6, 5, 0),
(6, 6, 0),
(6, 7, 0),
(6, 8, 0),
(6, 9, 0),
(6, 10, 0),
(6, 11, 0),
(6, 12, 0),
(6, 13, 0),
(6, 14, 0),
(6, 15, 0),
(6, 16, 0),
(6, 17, 0),
(6, 18, 0),
(6, 19, 1),
(6, 20, 0),
(6, 21, 0),
(6, 22, 0),
(6, 23, 0),
(6, 24, 1),
(6, 25, 0),
(6, 26, 0),
(6, 27, 0),
(6, 28, 0),
(6, 29, 0),
(6, 30, 0),
(7, 1, 0),
(7, 2, 0),
(7, 3, 0),
(7, 4, 0),
(7, 5, 0),
(7, 6, 0),
(7, 7, 0),
(7, 8, 1),
(7, 9, 0),
(7, 10, 0),
(7, 11, 0),
(7, 12, 0),
(7, 13, 0),
(7, 14, 0),
(7, 15, 0),
(7, 16, 0),
(7, 17, 0),
(7, 18, 0),
(7, 19, 0),
(7, 20, 0),
(7, 21, 0),
(7, 22, 0),
(7, 23, 0),
(7, 24, 0),
(7, 25, 0),
(7, 26, 0),
(7, 27, 0),
(7, 28, 0),
(7, 29, 0),
(7, 30, 0),
(8, 1, 1),
(8, 2, 1),
(8, 3, 1),
(8, 4, 1),
(8, 16, 1),
(8, 17, 1),
(8, 18, 1),
(8, 19, 1),
(8, 20, 1),
(8, 21, 1),
(8, 22, 1),
(8, 23, 1),
(8, 24, 1),
(8, 25, 1),
(8, 26, 1),
(8, 27, 1),
(8, 28, 1),
(8, 29, 1),
(8, 30, 1),
(9, 1, 0),
(9, 2, 0),
(9, 3, 0),
(9, 4, 0),
(9, 5, 1),
(9, 6, 0),
(9, 7, 0),
(9, 8, 0),
(9, 9, 0),
(9, 10, 0),
(9, 11, 0),
(9, 12, 1),
(9, 13, 0),
(9, 14, 0),
(9, 15, 0),
(9, 16, 0),
(9, 17, 0),
(9, 18, 0),
(9, 19, 0),
(9, 20, 0),
(9, 21, 0),
(9, 22, 0),
(9, 23, 0),
(9, 24, 0),
(9, 25, 1),
(9, 26, 0),
(9, 27, 0),
(9, 28, 0),
(9, 29, 0),
(9, 30, 0),
(10, 1, 0),
(10, 2, 0),
(10, 3, 0),
(10, 4, 0),
(10, 5, 0),
(10, 6, 1),
(10, 7, 0),
(10, 8, 0),
(10, 9, 0),
(10, 10, 0),
(10, 11, 0),
(10, 12, 0),
(10, 13, 0),
(10, 14, 0),
(10, 15, 0),
(10, 16, 0),
(10, 17, 0),
(10, 18, 0),
(10, 19, 0),
(10, 20, 0),
(10, 21, 0),
(10, 22, 0),
(10, 23, 0),
(10, 24, 0),
(10, 25, 0),
(10, 26, 0),
(10, 27, 0),
(10, 28, 0),
(10, 29, 0),
(10, 30, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `termasuk`
--

CREATE TABLE `termasuk` (
  `id_film` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `termasuk`
--

INSERT INTO `termasuk` (`id_film`, `id_kategori`) VALUES
(1, 2),
(1, 6),
(2, 1),
(2, 6),
(3, 2),
(4, 2),
(5, 4),
(5, 5),
(6, 1),
(6, 2),
(7, 2),
(7, 7),
(8, 4),
(8, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(5) NOT NULL,
  `rating` int(2) NOT NULL,
  `isi_ulasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `rating`, `isi_ulasan`) VALUES
(1, 10, 'sangat bagus visualisasinya dan membuat nostalgia!'),
(2, 7, 'dapat membawa isu yang ada di indonesia dengan baik. boleh dicoba untuk ditonton bagi yang belum.'),
(3, 7, 'pemilihan aktornya kurang tepat'),
(4, 6, 'sangat tidak \'fast&furious\' dibandingkan film-film sebelumnya'),
(5, 10, 'sangat bagus. berani mengangkat topik yang sensitif di indonesia namun sangat penting, yaitu sex education');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`,`email`,`phone_number`);

--
-- Indeks untuk tabel `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id_film`),
  ADD UNIQUE KEY `id_film` (`id_film`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD UNIQUE KEY `id_jadwal` (`id_jadwal`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `memberi`
--
ALTER TABLE `memberi`
  ADD PRIMARY KEY (`username`,`id_jadwal`,`id_ulasan`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id_ulasan` (`id_ulasan`);

--
-- Indeks untuk tabel `menonton`
--
ALTER TABLE `menonton`
  ADD PRIMARY KEY (`username`,`id_jadwal`,`no_kursi`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indeks untuk tabel `tayang`
--
ALTER TABLE `tayang`
  ADD PRIMARY KEY (`id_jadwal`,`id_film`),
  ADD KEY `id_film` (`id_film`);

--
-- Indeks untuk tabel `tempat_duduk`
--
ALTER TABLE `tempat_duduk`
  ADD PRIMARY KEY (`id_jadwal`,`no_kursi`,`terisi`);

--
-- Indeks untuk tabel `termasuk`
--
ALTER TABLE `termasuk`
  ADD PRIMARY KEY (`id_film`,`id_kategori`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD UNIQUE KEY `id_ulasan` (`id_ulasan`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `memberi`
--
ALTER TABLE `memberi`
  ADD CONSTRAINT `memberi_ibfk_1` FOREIGN KEY (`username`) REFERENCES `akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `memberi_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `memberi_ibfk_3` FOREIGN KEY (`id_ulasan`) REFERENCES `ulasan` (`id_ulasan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `menonton`
--
ALTER TABLE `menonton`
  ADD CONSTRAINT `menonton_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menonton_ibfk_3` FOREIGN KEY (`username`) REFERENCES `akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tayang`
--
ALTER TABLE `tayang`
  ADD CONSTRAINT `tayang_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tayang_ibfk_2` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tempat_duduk`
--
ALTER TABLE `tempat_duduk`
  ADD CONSTRAINT `tempat_duduk_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `termasuk`
--
ALTER TABLE `termasuk`
  ADD CONSTRAINT `termasuk_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `termasuk_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
