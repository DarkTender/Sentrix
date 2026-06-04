-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Št 04.Jún 2026, 10:46
-- Verzia serveru: 10.4.32-MariaDB
-- Verzia PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `sentrix`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `challenges`
--

CREATE TABLE `challenges` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `difficulty` varchar(20) DEFAULT NULL,
  `points` int(11) DEFAULT 10,
  `correct_answer` varchar(255) DEFAULT NULL,
  `explanation` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `challenges`
--

INSERT INTO `challenges` (`id`, `title`, `description`, `type`, `difficulty`, `points`, `correct_answer`, `explanation`, `created_at`) VALUES
(1, 'SQL Injection Login', 'Obíď login pomocou SQL injection.', 'sqli', 'intermediate', 15, '\' OR 1=1 -- \'', 'SQL injection bypass', '2026-04-08 07:13:26'),
(2, 'MD5 Crack', 'Crackni hash: 5f4dcc3b5aa765d61d8327deb882cf99', 'crypto', 'easy', 5, 'password', 'MD5 hash', '2026-04-08 07:13:26'),
(3, 'Hidden Password', 'Pozri source stránky a nájdi heslo.', 'web', 'extreme', 50, 'WerZ23...12poREtzuF', 'HTML source', '2026-04-08 07:13:26'),
(4, 'LFI Exploit', 'Získaj obsah /etc/passwd pomocou inputu.', 'system', 'hard', 20, '../../../../etc/passwd', 'Path traversal', '2026-04-08 07:13:26'),
(5, 'Role Switch', 'Je nastavene Cookie na role user a treba zistit ako zmenit nastavenie aby ziskal role admin', 'role', 'hard', 20, 'flag{cookie_tampering_success}', 'Otvorenie Debug Mode v browseri a zmena role user na role admin.\r\nZiskanie flag', '2026-04-10 23:37:31');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `challenge_id` int(11) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `submissions`
--

INSERT INTO `submissions` (`id`, `user`, `challenge_id`, `answer`, `is_correct`, `created_at`) VALUES
(39, 7, 1, '\' OR 1=1 --', 0, '2026-05-26 11:19:19'),
(40, 7, 1, '\' OR 1=1 -- \'', 1, '2026-05-26 11:19:32'),
(41, 7, 1, '\' OR 1=1 --', 0, '2026-05-26 11:19:44'),
(42, 7, 2, 'password', 1, '2026-05-26 11:21:01'),
(43, 7, 3, 'WerZ23...12poREtzuF', 1, '2026-05-26 11:21:29'),
(44, 7, 4, '../../../../etc/passwd', 1, '2026-05-26 11:21:39'),
(45, 7, 5, 'flag{cookie_tampering_success}', 1, '2026-05-26 11:22:07'),
(46, 8, 3, 'password', 0, '2026-05-26 11:28:35'),
(47, 8, 3, 'password', 0, '2026-05-26 11:28:39'),
(48, 8, 3, 'password', 0, '2026-05-26 11:28:42'),
(49, 8, 2, 'password', 1, '2026-05-26 11:28:50'),
(50, 1, 2, 'password', 1, '2026-05-26 18:29:52'),
(51, 9, 4, '../../../../etc/passwd', 1, '2026-05-26 18:31:32');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `score` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `score`, `created_at`, `role`) VALUES
(1, 'admin', '$2y$10$utX4NVxZM66EFLp09RgF2Ozh1DjwIMxcdwvrWBpkaBNilP1820KMW', 5, '2026-05-03 15:54:40', 'admin'),
(9, 'dusan', '$2y$10$qML38VYbw9IzIcYlZXw/x.WF9T/gvHOHcMfZe1EoGHbfFRCE6eIbK', 20, '2026-05-26 18:30:51', 'user');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pre tabuľku `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
