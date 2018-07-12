-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Lip 2018, 12:18
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
-- Struktura tabeli dla tabeli `admins`
--

CREATE TABLE `admins` (
  `login` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `last_logedin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `admins`
--

INSERT INTO `admins` (`login`, `password`, `last_logedin`) VALUES
('admin', 'admin', '2018-07-04 10:08:59');

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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`) VALUES
(1, 'Intel Core i7-8700K Coffee Lake 6-Core 3.7 GHz', 'corei7.jpg', 414.99),
(2, 'Corsair Crystal 570X RGB ATX Mid Tower Case', 'corsair570xrgb.jpg', 179.99),
(3, 'Corsair Gaming Mouse SCIMITAR PRO RGB', 'Corsair-Gaming-SCIMITAR-PRO-RGB.jpg', 79.99),
(4, 'G.SKILL TridentZ RGB Series 32GB DDR4', 'gskill-tridentz-rgb.jpg', 439.99),
(5, 'AMD RYZEN 7 1700 8-Core 3.0 GHz Socket AM4 CPU', 'ryzen7.jpg', 299.99),
(6, 'NZXT H700i Mid Tower Chassis Tempered Glass Case', 'nzxth700i.jpg', 199.99),
(7, 'Razer Blackwidow Gaming  Mechanical Keyboard', 'razer-blackwidow.jpg', 109.99),
(8, 'Samsung 850EVO BULK Solid State Drive', 'samsung-850evo.jpg', 108.45);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `UID` int(55) NOT NULL,
  `Fuid` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `Guid` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `fname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `fblink` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `dp` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `lastlogin` datetime NOT NULL,
  `registrationtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `referal` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `nick` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `img` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_session`
--

CREATE TABLE `users_session` (
  `id` int(55) NOT NULL,
  `UID` int(55) NOT NULL,
  `hash` varchar(300) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

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
-- Indeksy dla tabeli `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`login`);

--
-- Indeksy dla tabeli `ip_data`
--
ALTER TABLE `ip_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pc_data`
--
ALTER TABLE `pc_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`);

--
-- Indeksy dla tabeli `users_session`
--
ALTER TABLE `users_session`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `ip_data`
--
ALTER TABLE `ip_data`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT dla tabeli `pc_data`
--
ALTER TABLE `pc_data`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `UID` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT dla tabeli `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
