-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 08 mars 2018 à 13:51
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `exercice_3`
--

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id_film` int(4) NOT NULL,
  `title` varchar(100) NOT NULL,
  `actors` varchar(500) NOT NULL,
  `director` varchar(100) NOT NULL,
  `producer` varchar(100) NOT NULL,
  `year_of_prod` year(4) NOT NULL,
  `language` varchar(50) NOT NULL,
  `category` enum('action','horreur','romantique','') NOT NULL,
  `storyline` text NOT NULL,
  `video` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id_film`, `title`, `actors`, `director`, `producer`, `year_of_prod`, `language`, `category`, `storyline`, `video`) VALUES
(2, 'blabla', 'blabla', 'blabla', 'blabla', 2020, 'Anglais', 'action', 'blabla', 'https://getbootstrap.com/docs/4.0/components/forms/'),
(3, 'Bambi', 'Bambi', 'Disney', 'Disney', 1978, 'Français', 'horreur', 'zafraefeffffffffffffffffffffffffffffffffffffffffffffffffffffffff', 'https://www.youtube.com/watch?v=m4wVf05X5GQ'),
(4, 'Rambo', 'Rambo JR', 'Spielberg', 'Bank of America', 2020, 'Anglais', 'romantique', 'zafraefeffffffffffffffffffffffffffffffffffffffffffffffffffffffff', 'http://www.allocine.fr/video/player_gen_cmedia=19554712&cfilm=2007.html');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id_film`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id_film` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
