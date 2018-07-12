-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Lip 2018, 12:19
-- Wersja serwera: 10.1.33-MariaDB
-- Wersja PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `database`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pc_data`
--

CREATE TABLE `pc_data` (
  `id` int(100) NOT NULL,
  `admin_id` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `ip` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `UID` int(55) NOT NULL,
  `visited` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `windows_version` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `64BitOS` varchar(3) COLLATE utf8_polish_ci NOT NULL,
  `pc_name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `cpus_number` int(5) NOT NULL,
  `logical_drivers_available` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `windows_folder` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `host_name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `domain_name` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `browser` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `device` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `MAC` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `pc_data`
--
ALTER TABLE `pc_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `pc_data`
--
ALTER TABLE `pc_data`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
