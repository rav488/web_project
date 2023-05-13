-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 14 Maj 2023, 00:19
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `test`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gadu_wiaduserlists`
--

CREATE TABLE `gadu_wiaduserlists` (
  `id_list` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_user_contact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `gadu_wiaduserlists`
--
ALTER TABLE `gadu_wiaduserlists`
  ADD PRIMARY KEY (`id_list`),
  ADD KEY `gadu_wiaduserlists_ibfk_1` (`id_user_contact`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `gadu_wiaduserlists`
--
ALTER TABLE `gadu_wiaduserlists`
  MODIFY `id_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `gadu_wiaduserlists`
--
ALTER TABLE `gadu_wiaduserlists`
  ADD CONSTRAINT `gadu_wiaduserlists_ibfk_1` FOREIGN KEY (`id_user_contact`) REFERENCES `gadu_wiaduser` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gadu_wiaduserlists_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `gadu_wiaduser` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
