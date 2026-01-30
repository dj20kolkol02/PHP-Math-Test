-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 04:40 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `lvl` int(11) NOT NULL DEFAULT 1,
  `step` int(11) NOT NULL DEFAULT 1,
  `isCompleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `lvl`, `step`, `isCompleted`, `created_at`) VALUES
(1, 'testuser', '$2y$10$3xovK/kabT9MxAHO4tpjde/M.y0nk/ftYHwSYtlOpq0hcOEJZEy7a', 0, 0, 1, '2024-12-08 14:32:05'),
(2, 'jakub', '$2y$10$C3.T/RQ.G0Olo/Do8pt87O5sovAsvHgg/TE18QWkEyQpD656llksS', 0, 0, 1, '2024-12-08 14:53:02'),
(4, 'kuba', '$2y$10$jeyvPWgKzoPzB0othjiuj.UPgiXee46juZ/pbNQ0axTSgcevYYUBa', 0, 0, 1, '2024-12-08 15:03:26'),
(6, 'natan', '$2y$10$.jRXvTqQl58wjNXwTuqMFOJSqqEi6QFANQYd.hFuVoRCmK99MBuEm', 0, 0, 1, '2024-12-08 15:34:50');

--
-- Indeksy dla zrzutów tabel
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
