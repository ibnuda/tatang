-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 04 Nov 2014 pada 11.17
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `test`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test_multi_sets`()
    DETERMINISTIC
begin
        select user() as first_col;
        select user() as first_col, now() as second_col;
        select user() as first_col, now() as second_col, now() as third_col;
        end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `1itemset`
--

CREATE TABLE IF NOT EXISTS `1itemset` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `JUDUL` varchar(100) NOT NULL,
  `JUMLAH` int(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `1itemset`
--

INSERT INTO `1itemset` (`ID`, `JUDUL`, `JUMLAH`) VALUES
(1, 'mangga', 3),
(2, 'anggur', 4),
(3, 'rambutan', 2),
(4, 'leci', 1),
(5, 'durian', 2),
(6, 'manggis', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `2itemset`
--

CREATE TABLE IF NOT EXISTS `2itemset` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ITEM1` varchar(50) NOT NULL,
  `ITEM2` varchar(50) NOT NULL,
  `JUMLAH` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sheet1`
--

CREATE TABLE IF NOT EXISTS `sheet1` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FAKTUR` varchar(20) NOT NULL,
  `NAMA_GOLONGAN` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data untuk tabel `sheet1`
--

INSERT INTO `sheet1` (`ID`, `FAKTUR`, `NAMA_GOLONGAN`) VALUES
(1, '1', 'mangga'),
(2, '1', 'anggur'),
(3, '1', 'rambutan'),
(4, '2', 'mangga'),
(5, '2', 'anggur'),
(6, '3', 'leci'),
(7, '4', 'rambutan'),
(8, '4', 'mangga'),
(9, '4', 'mangga'),
(10, '5', 'anggur'),
(11, '5', 'durian'),
(12, '6', 'anggur'),
(13, '6', 'durian'),
(14, '6', 'manggis'),
(15, '4', 'rambutan');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
