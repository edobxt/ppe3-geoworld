-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 18 avr. 2021 à 00:56
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `world_users`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `idCategories` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`idCategories`, `libelle`) VALUES
(1, 'admin'),
(2, 'student'),
(3, 'professor');

-- --------------------------------------------------------

--
-- Structure de la table `requetes`
--

CREATE TABLE `requetes` (
  `idRequete` int(11) NOT NULL,
  `libelle` text NOT NULL,
  `requete` text NOT NULL,
  `visibilite` int(11) NOT NULL,
  `idUsers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `email` text NOT NULL,
  `mdp` text NOT NULL,
  `idCategories` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUsers`, `nom`, `prenom`, `email`, `mdp`, `idCategories`) VALUES
(3, 'Kancel', 'Jonathan', 'kanjo@gmail.com', '$2y$10$ywdiS8y/ykdrUDBJ0tP35uI83mTIbG2jNeWK95/5bf/BGeI34ZsYC', 2),
(4, 'Gouptar-Ticket', 'Yanissa', 'ygt@gmail.com', '$2y$10$p0IiJCs0pCCILDi.yRhSHuKalb1kxIdw8eNiz09JgqaMcJnHPvTs.', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idCategories`);

--
-- Index pour la table `requetes`
--
ALTER TABLE `requetes`
  ADD PRIMARY KEY (`idRequete`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `idCategories` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `requetes`
--
ALTER TABLE `requetes`
  ADD CONSTRAINT `requetes_ibfk_1` FOREIGN KEY (`idUsers`) REFERENCES `users` (`idUsers`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
