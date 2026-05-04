-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 02 mai 2026 à 18:26
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cinevoix`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteurs`
--

DROP TABLE IF EXISTS `acteurs`;
CREATE TABLE IF NOT EXISTS `acteurs` (
  `id_acteur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `tel` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `rue` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cp` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ville` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  `etat` tinyint(1) NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`id_acteur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `acteurs`
--

INSERT INTO `acteurs` (`id_acteur`, `nom`, `prenom`, `email`, `mdp`, `tel`, `rue`, `cp`, `ville`, `date_naissance`, `role`, `etat`, `date_creation`) VALUES
(1, 'Fajnzyn—Courtant', 'Prosper', 'prosperfajnzyn@gmail.com', 'abcde', '0101010101', 'aaa', '93440', 'Dugny', '0000-00-00', 'user', 1, '2026-05-02'),
(2, 'test', 'fzef', 'fzfez@gre.fr', '12345', '05050505505', 'fezfe', '93440', 'Dugny', '0205-01-01', 'user', 1, '2026-05-02');

-- --------------------------------------------------------

--
-- Structure de la table `codepromo`
--

DROP TABLE IF EXISTS `codepromo`;
CREATE TABLE IF NOT EXISTS `codepromo` (
  `id_code` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `pourcentage_reduc` decimal(3,2) NOT NULL,
  `etat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

DROP TABLE IF EXISTS `film`;
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `duree` int NOT NULL COMMENT 'en minutes',
  `affiche` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'on sait pas (prof ?)',
  `genre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `age_min` int DEFAULT NULL,
  `realisateur` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_sortie` date DEFAULT NULL,
  `bande_annonce` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_film`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`id_film`, `nom`, `description`, `duree`, `affiche`, `genre`, `age_min`, `realisateur`, `date_sortie`, `bande_annonce`) VALUES
(1, 'Mario galaxy', 'genial', 137, 'https://image.tmdb.org/t/p/w500/aSQktALDmbunDbwkuZbZFMEWVFr.jpg', 'enfantin', 3, 'mr. jesépa', '2024-08-02', 'https://www.youtube.com/watch?v=fiNpzIqc2CQ'),
(2, 'F1 - Le Film', 'VROUM', 480, 'https://image.tmdb.org/t/p/w500/up0kyZZlLX24dE9SzDuTjXe6HFl.jpg', 'Action', 12, 'Lewis Hamilton (le goat)', '2025-06-17', 'https://www.youtube.com/watch?v=dKB7lDz6Xbk'),
(3, 'Smile 2', 'BOUH !', 0, 'https://image.tmdb.org/t/p/w500/bZQweCDilXNvF8KuaEHcghM3Nwf.jpg', 'Horreur', 16, 'jsp', '0012-12-12', 'https://www.youtube.com/watch?v=GL7nOrqkfrw');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `statut` varchar(25) NOT NULL,
  `qte_plein_tarif` int NOT NULL,
  `qte_etudiant` int NOT NULL,
  `qte_senior` int NOT NULL,
  `ref_seance` int NOT NULL,
  `ref_code` int DEFAULT NULL,
  `ref_acteur` int NOT NULL,
  `moyen_paiement` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `fk_reservation_seance` (`ref_seance`),
  KEY `fk_reservation_codepromo` (`ref_code`),
  KEY `fk_reservation_acteur` (`ref_acteur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `statut`, `qte_plein_tarif`, `qte_etudiant`, `qte_senior`, `ref_seance`, `ref_code`, `ref_acteur`, `moyen_paiement`) VALUES
(1, 'en attente', 1, 0, 0, 1, NULL, 2, 'carte');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `id_salle` int NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `capacite` int NOT NULL,
  `etat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_salle`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `code`, `nom`, `capacite`, `etat`) VALUES
(1, '01', 'Salle Hamilton', 120, 1);

-- --------------------------------------------------------

--
-- Structure de la table `seances`
--

DROP TABLE IF EXISTS `seances`;
CREATE TABLE IF NOT EXISTS `seances` (
  `id_seance` int NOT NULL AUTO_INCREMENT,
  `date_seance` date NOT NULL,
  `ref_film` int NOT NULL,
  `ref_salle` int NOT NULL,
  PRIMARY KEY (`id_seance`),
  KEY `fk_seances_film` (`ref_film`),
  KEY `fk_seances_salle` (`ref_salle`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `seances`
--

INSERT INTO `seances` (`id_seance`, `date_seance`, `ref_film`, `ref_salle`) VALUES
(1, '2026-05-03', 2, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_reservation_acteur` FOREIGN KEY (`ref_acteur`) REFERENCES `acteurs` (`id_acteur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservation_codepromo` FOREIGN KEY (`ref_code`) REFERENCES `codepromo` (`id_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservation_seance` FOREIGN KEY (`ref_seance`) REFERENCES `seances` (`id_seance`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `seances`
--
ALTER TABLE `seances`
  ADD CONSTRAINT `fk_seances_film` FOREIGN KEY (`ref_film`) REFERENCES `film` (`id_film`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_seances_salle` FOREIGN KEY (`ref_salle`) REFERENCES `salle` (`id_salle`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
