-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 05 jan. 2021 à 12:29
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sprint`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

DROP TABLE IF EXISTS `appartient`;
CREATE TABLE IF NOT EXISTS `appartient` (
  `idPiece` int(11) NOT NULL,
  `idService` int(11) NOT NULL,
  PRIMARY KEY (`idPiece`,`idService`),
  KEY `FK_appartient_Service` (`idService`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `employé`
--

DROP TABLE IF EXISTS `employé`;
CREATE TABLE IF NOT EXISTS `employé` (
  `idEmployé` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(64) NOT NULL,
  `Prénom` varchar(64) NOT NULL,
  `Rôle` int(11) NOT NULL,
  PRIMARY KEY (`idEmployé`),
  KEY `Rôle` (`Rôle`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `employé`
--

INSERT INTO `employé` (`idEmployé`, `Nom`, `Prénom`, `Rôle`) VALUES
(1, 'Master', 'Chief', 1),
(2, 'Patrick', 'Pierro', 2),
(5, 'CROUSTICHÔ', 'Jean', 3);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `numEtudiant` int(11) NOT NULL,
  `nom` varchar(32) DEFAULT NULL,
  `prenom` varchar(32) DEFAULT NULL,
  `dateDeNaissance` date DEFAULT NULL,
  `adresse` varchar(128) DEFAULT NULL,
  `numTel` int(11) DEFAULT NULL,
  `mail` varchar(128) DEFAULT NULL,
  `montantDiffereAutorise` int(11) DEFAULT NULL,
  `montantDiffere` int(11) DEFAULT NULL,
  PRIMARY KEY (`numEtudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `idLogs` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) DEFAULT NULL,
  `pwd` varchar(32) DEFAULT NULL,
  `Role` text NOT NULL,
  PRIMARY KEY (`idLogs`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `logs`
--

INSERT INTO `logs` (`idLogs`, `login`, `pwd`, `Role`) VALUES
(1, 'directeur', 'dir', 'directeur'),
(2, 'agentadmin', 'admin', 'agent administratif'),
(3, 'agentacc', 'acc', 'agent d\'acceuil');

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

DROP TABLE IF EXISTS `piece`;
CREATE TABLE IF NOT EXISTS `piece` (
  `idPiece` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`idPiece`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `idRDV` int(11) NOT NULL AUTO_INCREMENT,
  `idService` int(11) DEFAULT NULL,
  `numEtudiant` int(11) DEFAULT NULL,
  `idStaff` int(11) NOT NULL,
  `nomService` varchar(32) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `horaire` time DEFAULT NULL,
  `statut` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`idRDV`),
  KEY `FK_RDV_Service` (`idService`),
  KEY `FK_RDV_Etudiant` (`numEtudiant`),
  KEY `RDV_ibfk_3` (`idStaff`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rel_2`
--

DROP TABLE IF EXISTS `rel_2`;
CREATE TABLE IF NOT EXISTS `rel_2` (
  `numEtudiant` int(11) NOT NULL,
  `IdService` int(11) NOT NULL,
  PRIMARY KEY (`numEtudiant`,`IdService`),
  KEY `IdService` (`IdService`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `idService` int(11) NOT NULL AUTO_INCREMENT,
  `prix` int(11) DEFAULT NULL,
  `nom` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`idService`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD CONSTRAINT `appartient_ibfk_1` FOREIGN KEY (`idPiece`) REFERENCES `piece` (`idPiece`),
  ADD CONSTRAINT `appartient_ibfk_2` FOREIGN KEY (`idService`) REFERENCES `service` (`idService`);

--
-- Contraintes pour la table `employé`
--
ALTER TABLE `employé`
  ADD CONSTRAINT `Rôle` FOREIGN KEY (`Rôle`) REFERENCES `logs` (`idLogs`);

--
-- Contraintes pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD CONSTRAINT `RDV_ibfk_2` FOREIGN KEY (`numEtudiant`) REFERENCES `etudiant` (`numEtudiant`),
  ADD CONSTRAINT `RDV_ibfk_3` FOREIGN KEY (`idStaff`) REFERENCES `employé` (`idEmployé`),
  ADD CONSTRAINT `rdv_ibfk_1` FOREIGN KEY (`idService`) REFERENCES `service` (`idService`);

--
-- Contraintes pour la table `rel_2`
--
ALTER TABLE `rel_2`
  ADD CONSTRAINT `rel_2_ibfk_2` FOREIGN KEY (`numEtudiant`) REFERENCES `etudiant` (`numEtudiant`),
  ADD CONSTRAINT `rel_2_ibfk_3` FOREIGN KEY (`IdService`) REFERENCES `service` (`idService`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
