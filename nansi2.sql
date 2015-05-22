-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: localhost
-- Χρόνος δημιουργίας: 07 Μάη 2015 στις 16:58:37
-- Έκδοση διακομιστή: 5.6.21
-- Έκδοση PHP: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Βάση δεδομένων: `nansi2`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id_category` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `categories`
--

INSERT INTO `categories` (`id_category`, `title`, `caption`, `photo`) VALUES
(1, 'moto', 'moto', 'images/categories/motos.jpg'),
(3, 'services', 'services', 'images/categories/services.jpg'),
(4, 'shoes', 'shoes', 'images/categories/shoes.jpg'),
(5, 'travels', 'travels', 'images/categories/travels.jpeg');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id_comment` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_pns` int(10) NOT NULL,
  `comment` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `comments`
--

INSERT INTO `comments` (`id_comment`, `id_user`, `id_pns`, `comment`, `ip`, `date`) VALUES
(12, 0, 1, 'fefreferfre', '127.0.0.1', '2015-05-07 12:45:47'),
(13, 0, 1, 'fefreferfreferferferfrefrefrefrfr', '127.0.0.1', '2015-05-07 12:45:49'),
(14, 0, 1, 'ferferfre', '127.0.0.1', '2015-05-07 12:46:30'),
(15, 0, 1, 'είπε ο Φέντερερ στο tie break του 2ου σετ, θέλοντας να εκφράσει το παράπονό του για τις υποδείξεις των κριτών...', '127.0.0.1', '2015-05-07 12:47:43'),
(16, 1, 1, 'fwfref', '127.0.0.1', '2015-05-07 12:55:51');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `pns`
--

CREATE TABLE IF NOT EXISTS `pns` (
  `id_pns` int(10) NOT NULL,
  `id_category` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `pns`
--

INSERT INTO `pns` (`id_pns`, `id_category`, `title`, `photo`) VALUES
(1, 4, 'goves', 'images/pns/a.jpg'),
(2, 4, 'goves 2\r\n\r\n', 'images/pns/jimmy-choo.jpg');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sirname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `votes` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id_user`, `name`, `sirname`, `email`, `photo`, `votes`, `password`) VALUES
(1, 'admin', 'admin', 'admin@admin.gr', '', 0, '$2y$10$VkR/dgz3uVK4rRND/d2BW.t9MIbhEIsSdd4DnBXC/Nd9c8z7p1l9C');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id_vote` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_pns` int(10) NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `like` int(10) NOT NULL,
  `dislike` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `votes`
--

INSERT INTO `votes` (`id_vote`, `id_user`, `id_pns`, `ip`, `like`, `dislike`) VALUES
(1, 1, 1, '127.0.0.1', 1, 0),
(2, 1, 1, '127.0.0.1', 1, 0),
(3, 1, 1, '127.0.0.1', 1, 0);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Ευρετήρια για πίνακα `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`);

--
-- Ευρετήρια για πίνακα `pns`
--
ALTER TABLE `pns`
  ADD PRIMARY KEY (`id_pns`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Ευρετήρια για πίνακα `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id_vote`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT για πίνακα `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT για πίνακα `pns`
--
ALTER TABLE `pns`
  MODIFY `id_pns` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT για πίνακα `votes`
--
ALTER TABLE `votes`
  MODIFY `id_vote` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
