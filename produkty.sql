-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2025 at 09:51 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sklep`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `opis` text DEFAULT NULL,
  `zdjecie` varchar(255) DEFAULT NULL,
  `kategoria` varchar(50) NOT NULL,
  `data_dodania` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `cena`, `opis`, `zdjecie`, `kategoria`, `data_dodania`) VALUES
(1, 'huj', 2137.00, 'dsafasdadasd', 'sad', 'huj', '2025-03-17 07:34:08'),
(2, 'bmw m5', 10000000.00, 'dwbncvxwd', 'sieg', 'samochod', '2025-03-17 08:23:30'),
(3, 'kjnl.', 15467890.00, 'fasdfbgnhmkj.', 'wefsgdfghjbkn', '546478', '2025-03-17 12:00:01'),
(4, 'HEJ', 123456.00, 'sdfgfds', 'shopping-cart.ico', 'sfgfdsdfg', '2025-03-17 17:49:28'),
(5, '1242423', 31231.00, '3123213', 'shopping-cart.png', 'huj', '2025-03-17 17:50:39'),
(6, 'huj', 1234567.00, 'siema\r\nsiema\r\nsiema', '', 'Inne', '2025-03-17 17:56:28'),
(7, 'siema', 99999999.99, 'fsDgfgjkjksdfghn', '', 'Inne', '2025-03-18 07:04:22'),
(8, 'jakub kiep', 0.00, 'g', '', 'Inne', '2025-03-18 08:34:05');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
