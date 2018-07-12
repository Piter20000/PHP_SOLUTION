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
-- Struktura tabeli dla tabeli `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(55) NOT NULL,
  `UID` int(55) NOT NULL,
  `fname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `country` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `postal_code` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `place` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `house_number` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `weigth` double NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `insurance` int(1) NOT NULL,
  `status` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `position` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `option` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `ordered` datetime NOT NULL,
  `delivered` datetime NOT NULL,
  `status_checked` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `delivered_checked` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `paid_data` datetime NOT NULL,
  `product_name` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `razorpay_payment_id` varchar(200) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
