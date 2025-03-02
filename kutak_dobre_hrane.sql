-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 07, 2024 at 02:05 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kutak_dobre_hrane`
--

-- --------------------------------------------------------

--
-- Table structure for table `gosti`
--

DROP TABLE IF EXISTS `gosti`;
CREATE TABLE IF NOT EXISTS `gosti` (
  `kor_ime` varchar(40) NOT NULL,
  `lozinka` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ime` varchar(30) NOT NULL,
  `prezime` varchar(30) NOT NULL,
  `pol` char(1) NOT NULL,
  `bez_pitanje` varchar(100) NOT NULL,
  `bez_odgovor` varchar(100) NOT NULL,
  `adresa` varchar(50) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `kartica` varchar(20) NOT NULL,
  `mejl` varchar(30) NOT NULL,
  `slika` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL,
  `nepojavljivanje` int NOT NULL,
  PRIMARY KEY (`kor_ime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gosti`
--

INSERT INTO `gosti` (`kor_ime`, `lozinka`, `ime`, `prezime`, `pol`, `bez_pitanje`, `bez_odgovor`, `adresa`, `telefon`, `kartica`, `mejl`, `slika`, `status`, `nepojavljivanje`) VALUES
('marija', '$2y$10$Tewu2oYRhMOiriwGCFbANOs95K6Yyj7SKC7HiHfBE89.l371ByCNa', 'Maca', 'Rakonjac', 'Z', 'Koja je moja omiljena boja?', 'Plava', 'Milke Grgurove 10a', '0641133835', '2222222222222222', 'marija.rakonjac01@gmail.com', 'slike/marija.png', 'odobren', 0),
('nikola', '$2y$10$0fxwxc5jKkvHaEORbG7y..lRUh2pqeLfVvj6F46KtzkxPeowb/jgy', 'Nikola', 'Dimic', 'M', 'Koja je moja omiljena zivotinja?', 'Macka', 'Kostolacka 27', '0677777777', '3333333333333333', 'nikola@gmail.com', 'slike/nikola.png', 'odobren', 0),
('biljana', '$2y$10$4N6JFTaej9WGxAz2tV5SreqRHA3NS.oyFaHeN45YpMP0VRzjN9iJS', 'Biljana', 'Rakonjac', 'Z', 'Koje je boje moja kosa?', 'Braon', 'Milke 10', '0642233554', '7777777777777777', 'biljana.rakonjac@gmail.com', 'slike/podrazumevana.jpg', 'odobren', 0),
('ceca', '$2y$10$pMeRhIFqsxO9CcBtx0laf.5PLlwNCp2mUq9laHaNAxsqm4ZWkzBPm', 'Ceca', 'Cecic', 'Z', 'Ko sam ja?', 'Ceca', 'Kalnickoj 90', '0642233554', '2222222222222222', 'ceca@gmail.com', 'slike/ceca.jpeg', 'odbijen', 0),
('veljko', '$2y$10$qIc1s6sc7MeJb2XQVZGeDOgQwx4Y31wcgHw.kuLYGATEp9vEasdzy', 'Velja', 'Gavric', 'M', 'Ko sam ja?', 'Veljko', 'Vovode Stepe 220', '063888888', '2222222222222222', 'veljko@yahoo.com', 'slike/Veljko.jpg', 'odobren', 0),
('milica', '$2y$10$dBrQjtSlUoBp4VLeKtqrAOqMXLBcECE54HMY/NSN//nYwBhQIkRzi', 'Milica', 'Milic', 'Z', 'Ko sam ja?', 'Milica', 'Kalnicka 30', '065444444', '9999999999999999', 'milica@gmail.com', 'slike/podrazumevana.jpg', 'deaktiviran', 0),
('brkic', '$2y$10$55xXRusYrkaNtJeyM8IiH.Izoz7kcYNBfnf3.NHQqO6/nC.KKwAtm', 'Marija', 'Brkic', 'Z', 'Koje je moje omiljeno jelo?', 'Pica', 'Juhorska 10', '065334433', '2222222222222222', 'marija@gmail.com', 'slike/brkic.png', 'cekanje', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jela`
--

DROP TABLE IF EXISTS `jela`;
CREATE TABLE IF NOT EXISTS `jela` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_restorana` varchar(3) NOT NULL,
  `naziv` varchar(30) NOT NULL,
  `cena` int NOT NULL,
  `sastojci` varchar(100) NOT NULL,
  `slika` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jela`
--

INSERT INTO `jela` (`id`, `id_restorana`, `naziv`, `cena`, `sastojci`, `slika`) VALUES
(1, '1', 'burger', 1000, 'Meso, hleb, salata, kecap', 'slike/burger.jpeg'),
(2, '1', 'pica', 750, 'Testo, kecap, masline, sir, sunka', 'slike/pica.jpeg'),
(3, '2', 'torta', 500, 'Mleko, jaja, secer', 'slike/torta.jpg'),
(4, '2', 'sejk', 300, 'Mleko, jagode', 'slike/sejk.jpg'),
(5, '2', 'pomfrit', 500, 'Krompir, so', 'slike/pomfrit.jpg'),
(6, '3', 'pileca krilca', 1000, 'Piletina, zacini', 'slike/krilca.jpeg'),
(7, '5', 'cizkejk', 550, 'Sir, sumsko voce, plazma', 'slike/cizkejk.jpg'),
(8, '5', 'susi', 1500, 'Pirinac, riba', 'slike/susi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

DROP TABLE IF EXISTS `komentari`;
CREATE TABLE IF NOT EXISTS `komentari` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_restorana` varchar(3) NOT NULL,
  `id_rezervacije` varchar(3) NOT NULL,
  `gost` varchar(30) NOT NULL,
  `komentar` varchar(100) NOT NULL,
  `ocena` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `id_restorana`, `id_rezervacije`, `gost`, `komentar`, `ocena`) VALUES
(1, '1', '1', 'veljko', 'Prijatno iskustvo!', 5),
(2, '1', '3', 'biljana', 'Super!', 5),
(3, '2', '14', 'Veljko', 'Sjajno!', 4),
(4, '1', '15', 'Veljko', 'Onako', 3),
(5, '1', '15', 'Veljko', 'Onako', 3);

-- --------------------------------------------------------

--
-- Table structure for table `konobari`
--

DROP TABLE IF EXISTS `konobari`;
CREATE TABLE IF NOT EXISTS `konobari` (
  `kor_ime` varchar(40) NOT NULL,
  `lozinka` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ime` varchar(30) NOT NULL,
  `prezime` varchar(30) NOT NULL,
  `adresa` varchar(50) NOT NULL,
  `mejl` varchar(40) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `bez_pitanje` varchar(100) NOT NULL,
  `bez_odgovor` varchar(30) NOT NULL,
  `slika` varchar(50) NOT NULL,
  `id_restorana` int NOT NULL,
  `pol` char(1) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`kor_ime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `konobari`
--

INSERT INTO `konobari` (`kor_ime`, `lozinka`, `ime`, `prezime`, `adresa`, `mejl`, `telefon`, `bez_pitanje`, `bez_odgovor`, `slika`, `id_restorana`, `pol`, `status`) VALUES
('zeljko', '$2y$10$GAzK/5D1Qs1JObSLPJZlneL/sg3L05s6d8J0EwTpmBdJcHMpkYiPO', 'Zeljko', 'Djurovic', 'Bulevar Kralja Aleksandra 10', 'zeljko@gmail.com', '0658877888', 'Sta ja predajem?', 'OPG', 'slike/podrazumevana.jpg', 1, 'M', 'odobren'),
('sanja', '$2y$10$H/nrS1g.PuZnhT93whptkOnNdhp.6EZonzd9HN/2n6dFTWToLW542', 'Sanja', 'Vujnovic', 'Bulevar Kralja Aleksandra 90', 'sanja@yahoo.com', '068888888', 'Sta ja predajem?', 'SSE', 'slike/podrazumevana.jpg', 1, 'Z', 'odobren'),
('pedja', '$2y$10$.xjCDoOqvGCaihYTuAzfA.D12RSTPfCuHHzlHDIa6GZYvmqd95vBm', 'Pedja', 'Tadic', 'Bulevar Kralja Aleksandra 10', 'pedja@gmail.com', '067777888', 'Sta ja predajem?', 'VI', 'slike/podrazumevana.jpg', 2, 'M', 'odobren'),
('rakic', '$2y$10$AX03IwijawSUp7L5RxHf4uHBz0x8zlwDUyFSpZHaQbu1ZyfONoj1i', 'Aleksandar', 'Rakic', 'Bulevar Oslobodjenja 10', 'aca_rakic@gmail.com', '067777777', 'Sta ja predajem?', 'SAU2', 'slike/podrazumevana.jpg', 3, 'M', 'odobren'),
('mirka', '$2y$10$6DOKoeQbQxQ1jMgwOTGC/O0FpSoi0QzCD1w1U1KQHFv.m00ouQBQm', 'Mirka', 'Federer', 'Patrisa Lumumbe 60', 'mirka@gmail.com', '0678855', 'Koji je moj omiljeni sport?', 'Tenis', 'slike/podrazumevana.jpg', 1, 'Z', 'odobren'),
('masa', '$2y$10$th2TpylYeJ1Ty7ZPsJ706uYV1AAQ2TwCBwmUC4U1IbQggcxYIpg9W', 'Masa', 'Tio', 'Makedonska 20', 'masa_tio@gmail.com', '065555444', 'Sta ja predajem?', 'PO', 'slike/podrazumevana.jpg', 5, 'Z', 'odobren');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

DROP TABLE IF EXISTS `korisnici`;
CREATE TABLE IF NOT EXISTS `korisnici` (
  `kor_ime` varchar(40) NOT NULL,
  `lozinka` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ime` varchar(30) NOT NULL,
  `prezime` varchar(30) NOT NULL,
  `pol` char(1) NOT NULL,
  `tip` varchar(10) NOT NULL,
  `bez_pitanje` varchar(100) NOT NULL,
  `bez_odgovor` varchar(30) NOT NULL,
  `adresa` varchar(50) NOT NULL,
  `telefon` varchar(15) NOT NULL,
  `mejl` varchar(40) NOT NULL,
  `slika` varchar(50) NOT NULL,
  PRIMARY KEY (`kor_ime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`kor_ime`, `lozinka`, `ime`, `prezime`, `pol`, `tip`, `bez_pitanje`, `bez_odgovor`, `adresa`, `telefon`, `mejl`, `slika`) VALUES
('peradmin', 'Pera123?', 'Pera', 'Peric', 'M', 'admin', 'Da li sam ja admin?', 'Da', 'Perina 5', '064444444', 'pera@gmail.com', 'slike/podrazumevana.jpg'),
('zeljko', '$2y$10$GAzK/5D1Qs1JObSLPJZlneL/sg3L05s6d8J0EwTpmBdJcHMpkYiPO', 'Zeljko', 'Djurovic', 'M', 'konobar', 'Sta ja predajem?', 'OPG', 'Bulevar Kralja Aleksandra 10', '0658877888', 'zeljko@gmail.com', 'slike/podrazumevana.jpg'),
('marija', '$2y$10$Tewu2oYRhMOiriwGCFbANOs95K6Yyj7SKC7HiHfBE89.l371ByCNa', 'Maca', 'Rakonjac', 'Z', 'gost', 'Koja je moja omiljena boja?', 'Plava', 'Milke Grgurove 10a', '0641133835', 'marija.rakonjac01@gmail.com', 'slike/marija.png'),
('nikola', '$2y$10$0fxwxc5jKkvHaEORbG7y..lRUh2pqeLfVvj6F46KtzkxPeowb/jgy', 'Nikola', 'Dimic', 'M', 'gost', 'Koja je moja omiljena zivotinja?', 'Macka', 'Kostolacka 27', '0677777777', 'nikola@gmail.com', 'slike/nikola.png'),
('biljana', '$2y$10$4N6JFTaej9WGxAz2tV5SreqRHA3NS.oyFaHeN45YpMP0VRzjN9iJS', 'Biljana', 'Rakonjac', 'z', 'gost', 'Koje je boje moja kosa?', 'Braon', 'Milke 10', '0642233554', 'biljana.rakonjac@gmail.com', 'slike/podrazumevana.jpg'),
('Veljko', '$2y$10$qIc1s6sc7MeJb2XQVZGeDOgQwx4Y31wcgHw.kuLYGATEp9vEasdzy', 'Velja', 'Gavric', 'M', 'gost', 'Ko sam ja?', 'Veljko', 'Vovode Stepe 220', '063888888', 'veljko@yahoo.com', 'slike/Veljko.jpg'),
('ceca', '$2y$10$pMeRhIFqsxO9CcBtx0laf.5PLlwNCp2mUq9laHaNAxsqm4ZWkzBPm', 'Ceca', 'Cecic', 'Z', 'gost', 'Ko sam ja?', 'Ceca', 'Kalnickoj 90', '0642233554', 'ceca@gmail.com', 'slike/ceca.jpeg'),
('milica', '$2y$10$dBrQjtSlUoBp4VLeKtqrAOqMXLBcECE54HMY/NSN//nYwBhQIkRzi', 'Milica', 'Milic', 'Z', 'gost', 'Ko sam ja?', 'Milica', 'Kalnicka 30', '065444444', 'milica@gmail.com', 'slike/podrazumevana.jpg'),
('sanja', '$2y$10$H/nrS1g.PuZnhT93whptkOnNdhp.6EZonzd9HN/2n6dFTWToLW542', 'Sanja', 'Vujnovic', 'Z', 'konobar', 'Sta ja predajem?', 'SSE', 'Bulevar Kralja Aleksandra 90', '068888888', 'sanja@yahoo.com', 'slike/podrazumevana.jpg'),
('pedja', '$2y$10$.xjCDoOqvGCaihYTuAzfA.D12RSTPfCuHHzlHDIa6GZYvmqd95vBm', 'Pedja', 'Tadic', 'M', 'konobar', 'Sta ja predajem?', 'VI', 'Bulevar Kralja Aleksandra 10', '067777888', 'pedja@gmail.com', 'slike/podrazumevana.jpg'),
('mirka', '$2y$10$6DOKoeQbQxQ1jMgwOTGC/O0FpSoi0QzCD1w1U1KQHFv.m00ouQBQm', 'Mirka', 'Federer', 'Z', 'gost', 'Koji je moj omiljeni sport?', 'Tenis', 'Patrisa Lumumbe 60', '0678855', 'mirka@gmail.com', 'slike/podrazumevana.jpg'),
('brkic', '$2y$10$55xXRusYrkaNtJeyM8IiH.Izoz7kcYNBfnf3.NHQqO6/nC.KKwAtm', 'Marija', 'Brkic', 'Z', 'gost', 'Koje je moje omiljeno jelo?', 'Pica', 'Juhorska 10', '065334433', 'marija@gmail.com', 'slike/brkic.png'),
('rakic', '$2y$10$AX03IwijawSUp7L5RxHf4uHBz0x8zlwDUyFSpZHaQbu1ZyfONoj1i', 'Aleksandar', 'Rakic', 'M', 'konobar', 'Sta ja predajem?', 'SAU2', 'Bulevar Oslobodjenja 10', '067777777', 'aca_rakic@gmail.com', 'slike/podrazumevana.jpg'),
('masa', '$2y$10$th2TpylYeJ1Ty7ZPsJ706uYV1AAQ2TwCBwmUC4U1IbQggcxYIpg9W', 'Masa', 'Tio', 'Z', 'konobar', 'Sta ja predajem?', 'PO', 'Makedonska 20', '065555444', 'masa_tio@gmail.com', 'slike/podrazumevana.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `korpa`
--

DROP TABLE IF EXISTS `korpa`;
CREATE TABLE IF NOT EXISTS `korpa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_jela` varchar(3) NOT NULL,
  `kolicina` varchar(10) NOT NULL,
  `cena` int NOT NULL,
  `gost` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `narudzbine`
--

DROP TABLE IF EXISTS `narudzbine`;
CREATE TABLE IF NOT EXISTS `narudzbine` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_restorana` varchar(3) NOT NULL,
  `gost` varchar(30) NOT NULL,
  `datum_i_vreme` datetime NOT NULL,
  `status` varchar(30) NOT NULL,
  `procenjeno_vreme` varchar(50) NOT NULL,
  `iznos` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `narudzbine`
--

INSERT INTO `narudzbine` (`id`, `id_restorana`, `gost`, `datum_i_vreme`, `status`, `procenjeno_vreme`, `iznos`) VALUES
(1, '1', 'Veljko', '2024-07-04 01:45:45', 'potvrdjeno', '20-30 minuta', 750),
(2, '1', 'Veljko', '2024-07-04 02:05:57', 'odbijeno', '', 2250),
(3, '1', 'Veljko', '2024-07-04 02:06:06', 'potvrdjeno', '30-40 minuta', 4000),
(4, '2', 'marija', '2024-07-07 01:40:36', 'potvrdjeno', '20-30 minuta', 1600),
(5, '2', 'marija', '2024-07-07 01:46:46', 'odbijeno', '', 500),
(6, '5', 'marija', '2024-07-07 02:16:28', 'potvrdjeno', '20-30 minuta', 1100),
(7, '1', 'marija', '2024-07-07 03:58:09', 'cekanje', '', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `restorani`
--

DROP TABLE IF EXISTS `restorani`;
CREATE TABLE IF NOT EXISTS `restorani` (
  `id` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(30) NOT NULL,
  `adresa` varchar(50) NOT NULL,
  `tip` varchar(30) NOT NULL,
  `telefon` varchar(30) NOT NULL,
  `ocena` float NOT NULL,
  `mapa` varchar(50) NOT NULL,
  `kontakt_osoba` varchar(30) NOT NULL,
  `opis` varchar(100) NOT NULL,
  `otvaranje` time NOT NULL,
  `zatvaranje` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `restorani`
--

INSERT INTO `restorani` (`id`, `naziv`, `adresa`, `tip`, `telefon`, `ocena`, `mapa`, `kontakt_osoba`, `opis`, `otvaranje`, `zatvaranje`) VALUES
(1, 'Spice', 'Bulevar Kralja Aleksandra 30', 'indijski', '011222555', 4, '', 'Mirko Mirkovic', 'Prijatan indijski restoran.', '08:00:00', '23:00:00'),
(2, 'Voulez Vous', 'Djordja Vajferta 52', 'razno', '011333444', 4.5, '', 'Marko Markovic', 'Odlicna hrana sa najljubaznijim osobljem u gradu.', '00:00:00', '23:00:00'),
(3, 'Ambar', 'Beton Hala 30', 'srpski', '011666555', 3, '', 'Lazar Lazarevic', 'Divna hrana sa pogledom na reku.', '08:00:00', '22:00:00'),
(5, 'Grey', 'Vojvode Stepe 100', 'srpska', '0674455', 0, '', 'Mina Minic', 'Prijatan komsiluk', '09:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rezervacije`
--

DROP TABLE IF EXISTS `rezervacije`;
CREATE TABLE IF NOT EXISTS `rezervacije` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_restorana` int NOT NULL,
  `gost` varchar(30) NOT NULL,
  `broj_osoba` varchar(3) NOT NULL,
  `datum_i_vreme` datetime NOT NULL,
  `dodatni_zahtev` varchar(100) NOT NULL,
  `id_stola` varchar(3) NOT NULL,
  `pojavljivanje` varchar(2) NOT NULL,
  `konobar` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `komentar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `produzavanje` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rezervacije`
--

INSERT INTO `rezervacije` (`id`, `id_restorana`, `gost`, `broj_osoba`, `datum_i_vreme`, `dodatni_zahtev`, `id_stola`, `pojavljivanje`, `konobar`, `status`, `komentar`, `produzavanje`) VALUES
(6, 1, 'milica', '3', '2024-07-18 17:20:00', 'Nema', '1', 'ne', 'sanja', 'potvrdjeno', '', 0),
(14, 2, 'Veljko', '2', '2024-07-02 00:32:00', '', '4', 'ne', 'pedja', 'potvrdjeno', '', 1),
(15, 1, 'veljko', '2', '2024-07-03 15:28:49', 'nista', '2', 'da', 'zeljko', 'potvrdjeno', 'nista', 0),
(16, 3, 'marija', '2', '2024-07-10 13:26:00', 'Prosidba!', '7', 'da', '', 'cekanje', '', 0),
(17, 5, 'marija', '6', '2024-07-07 11:27:00', '', '5', 'ne', 'masa', 'odbijeno', 'Zauzeta sam.', 0),
(18, 1, 'marija', '3', '2024-07-12 14:49:00', 'Slavim rodjendan!\r\n', '1', '', '', 'cekanje', '', 0),
(21, 2, 'nikola', '3', '2024-07-07 02:37:00', '', '', '', 'pedja', 'potvrdjeno', '', 0),
(22, 2, 'nikola', '2', '2024-07-07 02:37:00', '', '', 'da', 'pedja', 'potvrdjeno', '', 1),
(23, 2, 'nikola', '2', '2024-07-07 02:39:00', '', '', 'ne', 'pedja', 'potvrdjeno', '', 0),
(24, 2, 'biljana', '3', '2024-07-07 05:01:00', '', '3', '', 'pedja', 'potvrdjeno', '', 1),
(25, 2, 'biljana', '3', '2024-07-07 05:01:00', '', '4', '', 'pedja', 'potvrdjeno', '', 1),
(26, 2, 'biljana', '2', '2024-07-07 05:02:00', '', '9', '', 'pedja', 'potvrdjeno', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stavke_narudzbine`
--

DROP TABLE IF EXISTS `stavke_narudzbine`;
CREATE TABLE IF NOT EXISTS `stavke_narudzbine` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_narudzbine` varchar(3) NOT NULL,
  `id_jela` varchar(3) NOT NULL,
  `kolicina` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stavke_narudzbine`
--

INSERT INTO `stavke_narudzbine` (`id`, `id_narudzbine`, `id_jela`, `kolicina`) VALUES
(10, '1', '2', 1),
(11, '2', '2', 3),
(12, '3', '1', 4),
(13, '4', '3', 2),
(14, '4', '4', 2),
(15, '5', '5', 1),
(16, '6', '7', 2),
(17, '7', '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `stolovi`
--

DROP TABLE IF EXISTS `stolovi`;
CREATE TABLE IF NOT EXISTS `stolovi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_restorana` varchar(3) NOT NULL,
  `broj_osoba` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stolovi`
--

INSERT INTO `stolovi` (`id`, `id_restorana`, `broj_osoba`) VALUES
(1, '1', 5),
(2, '1', 10),
(3, '2', 10),
(4, '2', 4),
(5, '5', 10),
(6, '5', 5),
(7, '3', 5),
(8, '3', 8),
(9, '2', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
