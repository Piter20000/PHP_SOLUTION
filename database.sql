-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 12 Lip 2018, 10:12
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
('admin', 'admin', '2018-07-04 15:56:12');

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
-- Zrzut danych tabeli `warehouse`
--

INSERT INTO `warehouse` (`id`, `UID`, `fname`, `lname`, `phone`, `country`, `postal_code`, `place`, `house_number`, `weigth`, `price`, `quantity`, `insurance`, `status`, `position`, `option`, `ordered`, `delivered`, `status_checked`, `delivered_checked`, `paid_data`, `product_name`, `razorpay_payment_id`) VALUES
(1, 1, 'Piotr', 'Murdzia', '231245436', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 299.99, 1, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-05 19:10:18', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'AMD RYZEN 7 1700 8-Core 3.0 GHz Socket AM4 CPU', ''),
(2, 1, 'Piotr', 'Murdzia', '231245436', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 199.99, 1, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-05 19:10:21', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'NZXT H700i Mid Tower Chassis Tempered Glass Case', ''),
(3, 1, 'Piotr', 'Murdzia', '324325345', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 199.99, 1, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-05 19:23:44', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'NZXT H700i Mid Tower Chassis Tempered Glass Case', ''),
(4, 1, 'Piotr', 'Murdzia', '213234423', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 299.99, 1, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-05 19:47:52', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'AMD RYZEN 7 1700 8-Core 3.0 GHz Socket AM4 CPU', ''),
(5, 3, 'efewgew', 'qergqehythrwthrwy', '324251454', 'PL', '37-310', 'Nowa Sarzyna', '443', 0, 399.98, 2, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-05 20:16:54', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'NZXT H700i Mid Tower Chassis Tempered Glass Case', ''),
(6, 2, 'Piotr', 'Murdzia', '423645254', 'PL', '37-310', 'Nowa Sarzyna', '33', 0, 799.96, 4, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-06 19:25:20', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'NZXT H700i Mid Tower Chassis Tempered Glass Case', ''),
(7, 2, 'Piotr', 'Murdzia', '423645254', 'PL', '37-310', 'Nowa Sarzyna', '33', 0, 899.95, 5, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-06 19:25:23', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Corsair Crystal 570X RGB ATX Mid Tower Case', ''),
(8, 2, 'Piotr', 'Murdzia', '423645254', 'PL', '37-310', 'Nowa Sarzyna', '33', 0, 1244.97, 3, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-06 19:25:25', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Intel Core i7-8700K Coffee Lake 6-Core 3.7 GHz', ''),
(9, 2, 'Piotr', 'Murdzia', '423645254', 'PL', '37-310', 'Nowa Sarzyna', '33', 0, 159.98, 2, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-06 19:25:26', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Corsair Gaming Mouse SCIMITAR PRO RGB', ''),
(10, 2, 'Piotr', 'Murdzia', '423645254', 'PL', '37-310', 'Nowa Sarzyna', '33', 0, 1319.97, 3, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-06 19:25:28', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'G.SKILL TridentZ RGB Series 32GB DDR4', ''),
(11, 2, 'Piotr', 'Murdzia', '423645254', 'PL', '37-310', 'Nowa Sarzyna', '33', 0, 325.35, 3, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-06 19:25:30', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Samsung 850EVO BULK Solid State Drive', ''),
(12, 2, 'Piotr', 'Murdzia', '423645254', 'PL', '37-310', 'Nowa Sarzyna', '33', 0, 219.98, 2, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-06 19:25:32', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Razer Blackwidow Gaming  Mechanical Keyboard', ''),
(13, 4, 'Beata', 'Murdzia', '524624375', 'PL', '37-310', 'Nowa Sarzyna', '67676', 0, 1244.97, 3, 0, 'paid', 'Warehouse', '', '2018-07-06 23:09:08', '1111-11-11 11:11:11', 'RazorPay', '', '2018-07-06 23:09:08', 'Intel Core i7-8700K Coffee Lake 6-Core 3.7 GHz', 'pay_AW5RvoM5k9qH7a'),
(14, 4, 'Beata', 'Murdzia', '524624375', 'PL', '37-310', 'Nowa Sarzyna', '67676', 0, 539.97, 3, 0, 'paid', 'Warehouse', '', '2018-07-06 23:09:11', '1111-11-11 11:11:11', 'RazorPay', '', '2018-07-06 23:09:11', 'Corsair Crystal 570X RGB ATX Mid Tower Case', 'pay_AW5RvoM5k9qH7a'),
(15, 4, 'Beata', 'Murdzia', '524624375', 'PL', '37-310', 'Nowa Sarzyna', '67676', 0, 239.97, 3, 0, 'paid', 'Warehouse', '', '2018-07-06 23:09:12', '1111-11-11 11:11:11', 'RazorPay', '', '2018-07-06 23:09:12', 'Corsair Gaming Mouse SCIMITAR PRO RGB', 'pay_AW5RvoM5k9qH7a'),
(16, 4, 'Beata', 'Murdzia', '524624375', 'PL', '37-310', 'Nowa Sarzyna', '67676', 0, 899.97, 3, 0, 'paid', 'Warehouse', '', '2018-07-06 23:09:14', '1111-11-11 11:11:11', 'RazorPay', '', '2018-07-06 23:09:14', 'AMD RYZEN 7 1700 8-Core 3.0 GHz Socket AM4 CPU', 'pay_AW5RvoM5k9qH7a'),
(17, 4, 'Beata', 'Murdzia', '452574525', 'PL', '37-310', 'Nowa Sarzyna', '67676', 0, 599.97, 3, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-06 23:10:42', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'NZXT H700i Mid Tower Chassis Tempered Glass Case', ''),
(18, 4, 'Beata', 'Murdzia', '452574525', 'PL', '37-310', 'Nowa Sarzyna', '67676', 0, 329.97, 3, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-06 23:10:45', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Razer Blackwidow Gaming  Mechanical Keyboard', ''),
(19, 4, 'Beata', 'Murdzia', '452574525', 'PL', '37-310', 'Nowa Sarzyna', '67676', 0, 899.97, 3, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-06 23:10:47', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'AMD RYZEN 7 1700 8-Core 3.0 GHz Socket AM4 CPU', ''),
(20, 4, 'Beata', 'Murdzia', '452574525', 'PL', '37-310', 'Nowa Sarzyna', '67676', 0, 829.98, 2, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-06 23:10:50', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Intel Core i7-8700K Coffee Lake 6-Core 3.7 GHz', ''),
(21, 4, 'Beata', 'Murdzia', '245535554', 'PL', '37-310', 'Nowa Sarzyna', '67676', 0, 1319.97, 3, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-06 23:11:49', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'G.SKILL TridentZ RGB Series 32GB DDR4', ''),
(22, 1, 'Piotr', 'Murdzia', '543665765', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 299.99, 1, 0, 'paid', 'Warehouse', '', '2018-07-07 19:51:43', '1111-11-11 11:11:11', 'RazorPay', '', '2018-07-07 19:51:43', 'AMD RYZEN 7 1700 8-Core 3.0 GHz Socket AM4 CPU', 'pay_AWQcSlzd9ewUma'),
(23, 1, 'Piotr', 'Murdzia', '543665765', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 399.98, 2, 0, 'paid', 'Warehouse', '', '2018-07-07 19:51:45', '1111-11-11 11:11:11', 'RazorPay', '', '2018-07-07 19:51:45', 'NZXT H700i Mid Tower Chassis Tempered Glass Case', 'pay_AWQcSlzd9ewUma'),
(24, 1, 'Piotr', 'Murdzia', '435236256', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 329.97, 3, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-07 19:52:34', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Razer Blackwidow Gaming  Mechanical Keyboard', ''),
(25, 1, 'Piotr', 'Murdzia', '435236256', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 2489.94, 6, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-07 19:52:36', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Intel Core i7-8700K Coffee Lake 6-Core 3.7 GHz', ''),
(26, 1, 'Piotr', 'Murdzia', '435236256', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 899.95, 5, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-07 19:52:37', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Corsair Crystal 570X RGB ATX Mid Tower Case', ''),
(27, 1, 'Piotr', 'Murdzia', '435236256', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 399.95, 5, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-07 19:52:39', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Corsair Gaming Mouse SCIMITAR PRO RGB', ''),
(28, 1, 'Piotr', 'Murdzia', '435236256', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 1199.96, 4, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-07 19:52:41', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'AMD RYZEN 7 1700 8-Core 3.0 GHz Socket AM4 CPU', ''),
(29, 1, 'Piotr', 'Murdzia', '435236256', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 325.35, 3, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-07 19:52:43', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Samsung 850EVO BULK Solid State Drive', ''),
(30, 1, 'Piotr', 'Murdzia', '435236256', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 439.99, 1, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-07 19:52:44', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'G.SKILL TridentZ RGB Series 32GB DDR4', ''),
(31, 1, 'Piotr', 'Murdzia', '435346545', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 829.98, 2, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-07 19:53:15', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Intel Core i7-8700K Coffee Lake 6-Core 3.7 GHz', ''),
(32, 1, 'Piotr', 'Murdzia', '435346545', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 539.97, 3, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-07 19:53:17', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Corsair Crystal 570X RGB ATX Mid Tower Case', ''),
(33, 1, 'Piotr', 'Murdzia', '435346545', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 299.99, 1, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-07 19:53:18', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'AMD RYZEN 7 1700 8-Core 3.0 GHz Socket AM4 CPU', ''),
(34, 2, 'Piotr', 'Murdzia', '674867496', 'PL', '37-310', 'Nowa Sarzyna', '33', 0, 359.98, 2, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-07 19:55:14', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Corsair Crystal 570X RGB ATX Mid Tower Case', ''),
(35, 2, 'Piotr', 'Murdzia', '674867496', 'PL', '37-310', 'Nowa Sarzyna', '33', 0, 159.98, 2, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-07 19:55:16', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Corsair Gaming Mouse SCIMITAR PRO RGB', ''),
(36, 5, 'gdddsÈ™vvhhyiik', 'eftyyfd', '324325334', 'PL', '37-310', 'Nowa Sarzyna', '323', 0, 599.97, 3, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-09 10:36:32', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'NZXT H700i Mid Tower Chassis Tempered Glass Case', ''),
(37, 5, 'gdddsÈ™vvhhyiik', 'eftyyfd', '324325334', 'PL', '37-310', 'Nowa Sarzyna', '323', 0, 899.97, 3, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-09 10:36:34', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'AMD RYZEN 7 1700 8-Core 3.0 GHz Socket AM4 CPU', ''),
(39, 5, 'gdddsÈ™vvhhyiik', 'eftyyfd', '462566789', 'PL', '37-310', 'Nowa Sarzyna', '323', 0, 1659.96, 4, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-09 10:46:38', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Intel Core i7-8700K Coffee Lake 6-Core 3.7 GHz', ''),
(40, 5, 'gdddsÈ™vvhhyiik', 'eftyyfd', '235436545', 'PL', '37-310', 'Nowa Sarzyna', '323', 0, 41499, 100, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-09 10:47:37', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Intel Core i7-8700K Coffee Lake 6-Core 3.7 GHz', ''),
(41, 5, 'gdddsÈ™vvhhyiik', 'eftyyfd', '876578677', 'PL', '37-310', 'Nowa Sarzyna', '323', 0, 79.99, 1, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-09 13:16:28', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Corsair Gaming Mouse SCIMITAR PRO RGB', ''),
(42, 5, 'gdddsÈ™vvhhyiik', 'eftyyfd', '876578677', 'PL', '37-310', 'Nowa Sarzyna', '323', 0, 439.99, 1, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-09 13:16:31', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'G.SKILL TridentZ RGB Series 32GB DDR4', ''),
(43, 5, 'gdddsÈ™vvhhyiik', 'eftyyfd', '876578677', 'PL', '37-310', 'Nowa Sarzyna', '323', 0, 179.99, 1, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-09 13:19:58', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Corsair Crystal 570X RGB ATX Mid Tower Case', ''),
(44, 5, 'gdddsÈ™vvhhyiik', 'eftyyfd', '876578677', 'PL', '37-310', 'Nowa Sarzyna', '323', 0, 79.99, 1, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-09 13:20:00', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Corsair Gaming Mouse SCIMITAR PRO RGB', ''),
(45, 5, 'gdddsÈ™vvhhyiik', 'eftyyfd', '876578677', 'PL', '37-310', 'Nowa Sarzyna', '323', 0, 14999.5, 50, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-09 13:20:39', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'AMD RYZEN 7 1700 8-Core 3.0 GHz Socket AM4 CPU', ''),
(46, 1, 'Piotr', 'Murdzia', '435346545', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 4399.45, 55, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-10 08:41:03', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'Corsair Gaming Mouse SCIMITAR PRO RGB', ''),
(47, 1, 'Piotr', 'Murdzia', '435346545', 'PL', '37-310', 'Nowa Sarzyna', '22', 0, 29039.34, 66, 0, 'waiting_for_a_transfer', 'Warehouse', '', '2018-07-10 08:42:25', '1111-11-11 11:11:11', '', '', '1111-11-11 11:11:11', 'G.SKILL TridentZ RGB Series 32GB DDR4', '');

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
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT dla tabeli `pc_data`
--
ALTER TABLE `pc_data`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `UID` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
