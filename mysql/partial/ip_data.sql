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
-- Struktura tabeli dla tabeli `ip_data`
--

CREATE TABLE `ip_data` (
  `id` int(55) NOT NULL,
  `admin_id` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `ip` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `UID` int(55) NOT NULL,
  `visited` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `city` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `region` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `region_code` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `country` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `country_name` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `continent_code` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `in_eu` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `postal` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `latitude` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `longitude` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `timezone` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `utc_offset` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `country_calling_code` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `currency` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `asn` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `org` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `languages` varchar(55) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `ip_data`
--
ALTER TABLE `ip_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `ip_data`
--
ALTER TABLE `ip_data`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
