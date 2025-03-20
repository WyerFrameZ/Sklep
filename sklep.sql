-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2025 at 06:56 PM
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
(12, 'TV Sony', 270.00, 'xsdafgh', 'https://images.unsplash.com/photo-1528928441742-b4ccac1bb04c?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Elektronika', '2025-03-18 11:04:31'),
(17, 'BMW M4 GT3', 400000.00, 'BMW M4 GT3', 'https://cdn.pixabay.com/photo/2022/12/02/10/22/car-racing-7630651_1280.jpg', 'Motoryzacja', '2025-03-18 12:48:41'),
(19, 'APFEL 16e', 3999.00, 'Najlepszy w swojej cenie', 'https://images.unsplash.com/photo-1510557880182-3d4d3cba35a5?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Śmieci', '2025-03-20 11:03:18'),
(20, 'Mysz gamingowa', 59.00, '1600 DPI, bezprzewodowa', 'https://ae01.alicdn.com/kf/Sb57dd7d0aaba499baa385ead50eddb2bX.jpg', 'Elektronika', '2025-03-20 11:06:30'),
(21, 'Zasilacz KIT', 49.00, 'Zestaw do samodzielnego złożenia, 24V', 'https://ae-pic-a1.aliexpress-media.com/kf/Hcb4a7146ca7749198bf7c03a0ae155d8f.jpg_480x480q75.jpg_.avif', 'Elektronika', '2025-03-20 11:08:55'),
(22, 'Koszulka MEME', 79.00, 'MEME śmieszna koszulka Z SMIESNZYM CZARNYM PANEM', 'https://ae01.alicdn.com/kf/Sa5f8c00eb10a4818a80ad3209f1d4425j.jpg', 'Moda', '2025-03-20 11:12:44'),
(23, 'Koń hobbystyczny', 179.00, 'Koń hobby horse w formacie a4', 'https://pink-papaya.de/cdn/shop/files/HobbyHorse_Dunja_1_905142e3-ea8c-4ea6-b521-47b524486ced.jpg?v=1742304649&width=840', 'Sport i Hobby', '2025-03-20 11:16:34'),
(24, 'L96a1', 5679.00, 'Stan igła, w gratisie 300 sztuk amunicji elaborowanej', 'https://cdna.artstation.com/p/assets/images/images/014/000/380/large/sergei-baranov-main-jpg89815f0a-566e-42d7-86a7-c283fcefc363original.jpg?1542036690', 'Broń', '2025-03-20 11:24:55'),
(26, 'PKM', 8999.00, 'Węgierska wersja PKM w stanie dobrym.', 'https://upload.wikimedia.org/wikipedia/commons/9/96/PKM_of_Hungarian_Army.JPG', 'Broń', '2025-03-20 11:35:28'),
(27, 'BMW M5 CS', 335000.00, 'BMW M5 CS F90 2022', 'https://hips.hearstapps.com/hmg-prod/images/2022-bmw-m5-cs-109-1611684117.jpg', 'Motoryzacja', '2025-03-20 12:01:22'),
(28, 'Zraszacz Ogrodowy', 159.00, 'Zraszacz z głową 155mm', 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcRuhak9Q5laVfZjrM2Uv6qaIKW0Ykj1Uw33prc8sNMrq9-n78bKFn06lUYwjFIYQbOPXnGWqamqnRRVoVbiflXQ3U38DkuxFkudCSMuZWLcmXpNIE-Tp6rGPQVVoccZwxxTQLT5pw&usqp=CAc', 'Dom i Ogród', '2025-03-20 12:50:30');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `haslo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `haslo`) VALUES
(1, 'siema', '$2y$10$GSjMqLAUng/v.ybYtmlONO6hWkXQlVNtQo/zbfa.tYkRgTGJ/MTYq'),
(2, 'JEBAC_ROSJE', '$2y$10$O4A2jIayaegyrKRNJZ6xw./ekqvyFXhckORroQQ5/qmLevs86qXeS'),
(3, 'a', '$2y$10$qApwDEW9kHkAZpv0S7UDkuxw.WmLSMIaNt1QdcT2bv68YJg7DkBGW'),
(4, 'ZSKZSKZSK', '$2y$10$JGxD2HaZu5yNaH8sYJOC5ec6yVXv0jUV7VPW9PbBsfkK3jNK1Ac..'),
(5, 'b', '$2y$10$VOnOyz8ZtC5.k3ug4Keiyev78sy.DPZ/Nf/cWnj9CEhvTKbiUoKOu'),
(6, 'ADSB', '$2y$10$WC0mBgpPJVykSF5EDYm6T.Hj4jTcim6TEvyXiQxeClfYWfRtcmitW'),
(7, 'aaaa', '$2y$10$/5bRuZKMOu.iF4aK2KicBer4jHDZa5xqtHX5jEAcb9htqruIzP.6.'),
(8, '123', '$2y$10$CtgjZm6Rseg8.tn6LpHPh.hMgAoWlJhBJtfdjsr8uejPeMzL0oyly');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
