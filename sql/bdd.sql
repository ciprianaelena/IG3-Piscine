-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 07 déc. 2017 à 15:14
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `Piscine`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorieJeux`
--

CREATE TABLE `categorieJeux` (
  `idCategorie` int(11) UNSIGNED NOT NULL,
  `libelleCategorie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

CREATE TABLE `editeur` (
  `idEditeur` int(10) UNSIGNED NOT NULL,
  `nomEditeur` text NOT NULL,
  `rueEditeur` text NOT NULL,
  `codePostalEditeur` text NOT NULL,
  `villeEditeur` text NOT NULL,
  `paysEditeur` text NOT NULL,
  `siteWebEditeur` text NOT NULL,
  `commentaireEditeur` text NOT NULL,
  `actifEditeur` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `idFacture` int(10) UNSIGNED NOT NULL,
  `prixNegocie` int(11) NOT NULL,
  `payee` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `festival`
--

CREATE TABLE `festival` (
  `anneeFestival` year(4) NOT NULL,
  `prixUnitaireEmplacement` int(11) NOT NULL,
  `nbEmplacementFestival` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jeu`
--

CREATE TABLE `jeu` (
  `idJeu` bigint(20) UNSIGNED NOT NULL,
  `nomJeu` int(11) NOT NULL,
  `regles` text NOT NULL,
  `prototype` tinyint(1) NOT NULL,
  `largeur` int(11) NOT NULL,
  `hauteur` int(11) NOT NULL,
  `longueur` int(11) NOT NULL,
  `poids` int(11) NOT NULL,
  `dateSortie` date DEFAULT NULL,
  `nbJoueur` int(11) NOT NULL,
  `dureePartie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

CREATE TABLE `logement` (
  `idDemande` bigint(20) NOT NULL,
  `coutParNuit` int(11) NOT NULL,
  `nbPlace` int(11) NOT NULL,
  `RueLogement` text NOT NULL,
  `CPLogement` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `representant`
--

CREATE TABLE `representant` (
  `idRepresentant` bigint(20) UNSIGNED NOT NULL,
  `nomRepresentant` text NOT NULL,
  `prenomRepresentant` text NOT NULL,
  `mailRepresentant` text NOT NULL,
  `telFixeRepresentant` text NOT NULL,
  `telMobileRepresentant` text NOT NULL,
  `commentaireRepresentant` text,
  `actifRepresentant` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `idReservation` bigint(20) NOT NULL,
  `dateReservation` date NOT NULL,
  `prixEmplacementNegocie` int(11) NOT NULL,
  `commentaireReservation` text NOT NULL,
  `reservationAnnulee` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `suiviColis`
--

CREATE TABLE `suiviColis` (
  `idColis` bigint(20) UNSIGNED NOT NULL,
  `dateEnvoi` int(11) NOT NULL,
  `dateReception` int(11) NOT NULL,
  `commentaire` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `suiviContact`
--

CREATE TABLE `suiviContact` (
  `idContact` int(10) UNSIGNED NOT NULL,
  `typeContact` text NOT NULL,
  `dateContact` date NOT NULL,
  `commentaireContact` text NOT NULL,
  `clos` tinyint(1) NOT NULL,
  `dateRelance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(320) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `avatarURL` varchar(32) DEFAULT NULL,
  `activationURL` varchar(64) DEFAULT NULL,
  `registerDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `zone`
--

CREATE TABLE `zone` (
  `idZone` bigint(20) UNSIGNED NOT NULL,
  `nomZone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorieJeux`
--
ALTER TABLE `categorieJeux`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `editeur`
--
ALTER TABLE `editeur`
  ADD PRIMARY KEY (`idEditeur`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`idFacture`);

--
-- Index pour la table `festival`
--
ALTER TABLE `festival`
  ADD PRIMARY KEY (`anneeFestival`);

--
-- Index pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD PRIMARY KEY (`idJeu`);

--
-- Index pour la table `logement`
--
ALTER TABLE `logement`
  ADD PRIMARY KEY (`idDemande`);

--
-- Index pour la table `representant`
--
ALTER TABLE `representant`
  ADD PRIMARY KEY (`idRepresentant`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`idReservation`);

--
-- Index pour la table `suiviColis`
--
ALTER TABLE `suiviColis`
  ADD PRIMARY KEY (`idColis`);

--
-- Index pour la table `suiviContact`
--
ALTER TABLE `suiviContact`
  ADD PRIMARY KEY (`idContact`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `pseudo` (`login`);

--
-- Index pour la table `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`idZone`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorieJeux`
--
ALTER TABLE `categorieJeux`
  MODIFY `idCategorie` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `editeur`
--
ALTER TABLE `editeur`
  MODIFY `idEditeur` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `idFacture` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `idJeu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `logement`
--
ALTER TABLE `logement`
  MODIFY `idDemande` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `representant`
--
ALTER TABLE `representant`
  MODIFY `idRepresentant` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `idReservation` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `suiviColis`
--
ALTER TABLE `suiviColis`
  MODIFY `idColis` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `suiviContact`
--
ALTER TABLE `suiviContact`
  MODIFY `idContact` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `zone`
--
ALTER TABLE `zone`
  MODIFY `idZone` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



-- MODIFICATIONS

-- Ajout de la clé étrangère pour le représentant
ALTER TABLE `representant` ADD `idEditeur` INT(10) UNSIGNED NOT NULL AFTER `idRepresentant`;
ALTER TABLE `representant` ADD CONSTRAINT `fkRepresentantEditeur` FOREIGN KEY (`idEditeur`) REFERENCES `editeur`(`idEditeur`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Le nom d'un jeu est une chaine...
ALTER TABLE `jeu` CHANGE `nomJeu` `nomJeu` VARCHAR(40) NOT NULL;
-- Autorise certainnes colonnes de la table jeu à être null
ALTER TABLE `jeu` CHANGE `largeur` `largeur` INT(11) NULL, CHANGE `hauteur` `hauteur` INT(11) NULL, CHANGE `longueur` `longueur` INT(11) NULL, CHANGE `poids` `poids` INT(11) NULL, CHANGE `dateSortie` `dateSortie` DATE NULL DEFAULT NULL, CHANGE `nbJoueur` `nbJoueur` INT(11) NULL, CHANGE `dureePartie` `dureePartie` INT(11) NULL DEFAULT NULL;

-- Ajout de la clé étrangère dans la table jeu
ALTER TABLE `jeu` ADD `idEditeur` INT(10) UNSIGNED NOT NULL AFTER `idJeu`;
ALTER TABLE `jeu` ADD CONSTRAINT `fkJeuEditeur` FOREIGN KEY (`idEditeur`) REFERENCES `editeur`(`idEditeur`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Ajout de la clé étrangère idEditeur pour le suivi contact
ALTER TABLE `suiviContact` ADD `idEditeur` INT(10) UNSIGNED NOT NULL AFTER `idContact`;
ALTER TABLE `suiviContact` ADD CONSTRAINT `fksuiviContactEditeur` FOREIGN KEY (`idEditeur`) REFERENCES `editeur`(`idEditeur`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Ajout de la clé étrangère idRepresentant pour le suivi contact
ALTER TABLE `suiviContact` ADD `idRepresentant` INT(10) UNSIGNED NOT NULL AFTER `idEditeur`;
ALTER TABLE `suiviContact` ADD CONSTRAINT `fksuiviContactRepresentant` FOREIGN KEY (`idRepresentant`) REFERENCES `representant`(`idRepresentant`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Ajout de la clé étrangère idEditeur dans la table suiviContact
ALTER TABLE `suivicontact` ADD `idEditeur` INT(10) UNSIGNED NOT NULL AFTER `idContact`;
ALTER TABLE `suivicontact` ADD CONSTRAINT `fkSuiviContactEditeur` FOREIGN KEY (`idEditeur`) REFERENCES `editeur`(`idEditeur`) ON DELETE CASCADE ON UPDATE CASCADE;


