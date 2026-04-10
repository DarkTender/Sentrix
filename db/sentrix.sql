-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: St 08.Apr 2026, 09:44
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
(1, 'SQL Injection Login', 'Obíď login pomocou SQL injection.', 'sqli', 'intermediate', 15, '\' OR 1=1 --', 'SQL injection bypass', '2026-04-08 07:13:26'),
(2, 'MD5 Crack', 'Crackni hash: 5f4dcc3b5aa765d61d8327deb882cf99', 'crypto', 'easy', 15, 'password', 'MD5 hash', '2026-04-08 07:13:26'),
(3, 'Hidden Password', 'Pozri source stránky a nájdi heslo.', 'web', 'easy', 10, 'admin123', 'HTML source', '2026-04-08 07:13:26'),
(4, 'LFI Exploit', 'Získaj obsah /etc/passwd pomocou inputu.', 'system', 'hard', 20, 'etc/passwd', 'Path traversal', '2026-04-08 07:13:26');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `challenge_id` int(11) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `submissions`
--

INSERT INTO `submissions` (`id`, `user_id`, `challenge_id`, `answer`, `is_correct`, `created_at`) VALUES
(1, 1, 1, '', 0, '2026-04-08 07:16:13'),
(2, 1, 1, '', 0, '2026-04-08 07:16:24'),
(3, 1, 3, 'admin123', 1, '2026-04-08 07:18:29'),
(4, 1, 3, 'admin123', 1, '2026-04-08 07:19:20'),
(5, 2, 2, 'password', 1, '2026-04-08 07:44:04');

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
(1, 'admin', '$2y$10$CeltFuDFQ8P0mRloC4ICzuV6Vj8rHrtF7SRLUyoQOVW49AXgE7Ek6', 10, '2026-04-08 07:15:49', 'admin'),
(2, 'user', '$2y$10$erTJxfOFRnYJXJe25tQnyeSVZdQHwEM8E8ki3g1UoapTRDdNy3z9a', 15, '2026-04-08 07:43:32', 'user');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `challenge_id` (`challenge_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pre tabuľku `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`challenge_id`) REFERENCES `challenges` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
