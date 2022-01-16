-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Sty 2022, 13:41
-- Wersja serwera: 10.4.18-MariaDB
-- Wersja PHP: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `uni_szachy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `user` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `pass` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `admin`
--

INSERT INTO `admin` (`user`, `pass`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gracze`
--

CREATE TABLE `gracze` (
  `id` int(11) NOT NULL,
  `imie` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `klasa` int(1) NOT NULL,
  `litera` char(2) COLLATE utf8_polish_ci NOT NULL,
  `rank` int(6) NOT NULL,
  `blitz` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wyniki`
--

CREATE TABLE `wyniki` (
  `main_id` int(11) NOT NULL,
  `id1` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  `data` date NOT NULL,
  `wynik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `gracze`
--
ALTER TABLE `gracze`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wyniki`
--
ALTER TABLE `wyniki`
  ADD PRIMARY KEY (`main_id`),
  ADD KEY `id1` (`id1`),
  ADD KEY `id2` (`id2`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `gracze`
--
ALTER TABLE `gracze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `wyniki`
--
ALTER TABLE `wyniki`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `wyniki`
--
ALTER TABLE `wyniki`
  ADD CONSTRAINT `wyniki_ibfk_1` FOREIGN KEY (`id1`) REFERENCES `gracze` (`id`),
  ADD CONSTRAINT `wyniki_ibfk_2` FOREIGN KEY (`id2`) REFERENCES `gracze` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
