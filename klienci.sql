-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Sty 2017, 22:43
-- Wersja serwera: 10.1.13-MariaDB
-- Wersja PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `klienci`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id` int(11) NOT NULL,
  `user` text COLLATE utf8_polish_ci NOT NULL,
  `pass` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `drewno` int(11) NOT NULL,
  `kamien` int(11) NOT NULL,
  `zboze` int(11) NOT NULL,
  `dnipremium` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id`, `user`, `pass`, `email`, `drewno`, `kamien`, `zboze`, `dnipremium`) VALUES
(1, 'adam', '$2y$10$0tTDG0F9FrJUgF7HOVOgd.HCOpywgDr159afgdmP2zIQqIs3vR0Nq', 'adam@gmail.com', 213, 5675, 342, 0),
(2, 'marek', '$2y$10$Pj.f9Tc5WTDjWNmnJDkPHOrTS2jtZva40AQSrZ9YVtLCDUI0nnrme', 'marek@gmail.com', 324, 1123, 4325, 15),
(3, 'anna', '$2y$10$FPsoXHUUtOhBldjY.Mj7SedJ8UKtBK4/K0Q2lHH7j2EPBKpQbBHQa', 'anna@gmail.com', 4536, 17, 120, 25),
(4, 'andrzej', '$2y$10$hfz53ZrZhtwxcaRqFLazMeswKwB2l.PexMNVa3orCrfNuTPG/UHYC', 'andrzej@gmail.com', 5465, 132, 189, 0),
(5, 'justyna', '$2y$10$4qblgRdel1IutAoFoLwTReYDVysVed6cbNkbQsFhnDsgo2YF717GO', 'justyna@gmail.com', 245, 890, 554, 0),
(6, 'kasia', '$2y$10$NctDMcLbyK8ta4WQKi20AucPc8ecFlFFDRz2VG5ZpslGtav.CB2Jm', 'kasia@gmail.com', 267, 980, 109, 12),
(7, 'beata', '$2y$10$Yz.mOAD3qo3M49nii2gMhel/nFK16IO2wX7Syjqg8V8M0zDwm51Q6', 'beata@gmail.com', 565, 356, 447, 77),
(8, 'jakub', '$2y$10$m766/0umkc1a6imtIqRDGex7rvK3P4LbZnQzDIZZOKhEvKjHPBOH2', 'jakub@gmail.com', 2467, 557, 876, 0),
(9, 'janusz', '$2y$10$A9KSzoQlZBM8wAEl6uF0He7Kzzvi8awUdCikW/IFBkPE7e8KgrAm.', 'janusz@gmail.com', 65, 456, 2467, 0),
(10, 'roman', '$2y$10$jB7efr2zS2MjoqJ0zudm4./csq20Glh7Tzi1YNtExBDq3X4Lq8/wS', 'roman@gmail.com', 97, 226, 245, 23),
(11, 'bartek', '$2y$10$aO2vp1hfwTfXDxdMv6qe2.BZcNRE2a00Qi1DDUmldyw6F02MXKwHS', 'bartekXXX@gmail.com', 1, 1, 1, 3);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
