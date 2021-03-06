-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 25 mars 2020 à 14:37
-- Version du serveur :  10.3.16-MariaDB
-- Version de PHP : 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `id12571223_tennistest`
-- use `id12571223_tennistest`;

-- --------------------------------------------------------
-- Structure de la table `billet`
--
CREATE TABLE `ventes` (
  `idventes` TINYINT AUTO_INCREMENT ,
  `montanttotal` FLOAT NOT NULL ,
  `paniermoyen` FLOAT NOT NULL ,
  `nbventes` MEDIUMINT NOT NULL ,
  `mois` VARCHAR(20) NOT NULL,
  PRIMARY KEY(`idventes`)
) ENGINE = InnoDB;

CREATE TABLE `client` (
  `IDCLIENT` int(11) NOT NULL AUTO_INCREMENT,
  `NOMCLIENT` char(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PRENOMCLIENT` char(26) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MAILCLIENT` char(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MDPCLIENT` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ESTLICENCIE` tinyint(1) DEFAULT NULL,
  `NUMEROLICENCE` VARCHAR(20) DEFAULT NULL,
  `TELCLIENT` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`idclient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `licence` (
  `idlicence` INT NOT NULL AUTO_INCREMENT ,
  `numlicencie` VARCHAR(20) NOT NULL,
 PRIMARY KEY (`idlicence`)
 )
   ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Structure de la table `billet`
--

CREATE TABLE `billet` (
  `idbillet` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `idtbillet` TINYINT NOT NULL,
  `idmatch` int(11) NOT NULL,
  `quantite` SMALLINT NOT NULL,
  `libellebillet` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
   PRIMARY KEY (`idbillet`)


) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------
-- Structure de la table `tbillet`
CREATE TABLE `tbillet` (
  `idtbillet` TINYINT NOT NULL AUTO_INCREMENT,
  `prixtbillet` float NOT NULL,
  `libelletbillet` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
   PRIMARY KEY (`idtbillet`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
--
-- Structure de la table `commande`
CREATE TABLE `commande` (
`idcommande` INT NOT NULL AUTO_INCREMENT ,
`idclient` INT NOT NULL ,
`idemplacement` TINYINT NOT NULL,
`idtbillet` TINYINT NOT NULL,
`montant` FLOAT NOT NULL,
 PRIMARY KEY (`idcommande`)) ENGINE = InnoDB;

-- --------------------------------------------------------

--
-- Structure de la table `emplacement`
--

CREATE TABLE `emplacement` (
  `idemplacement` TINYINT NOT NULL AUTO_INCREMENT,
  `libelleemplacement` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `coeffemplacement` float NOT NULL,
   PRIMARY KEY (`idemplacement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `promo`
--

CREATE TABLE `promo` (
  `idpromo` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `libellepromo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `coeffpromo` float NOT NULL,
  `idtbillet` TINYINT NOT NULL,
   PRIMARY KEY (`idpromo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_match`
--

--
-- PARTIE PLANNING MATCHS
-- table match 2 à fusionner

CREATE TABLE `_match` (
 `idmatch` INT(11) NOT NULL AUTO_INCREMENT ,
 `libelleMatch` VARCHAR(50),
 `dateMatch` DATE,
 `coeffMatch` FLOAT UNSIGNED,
 `courtMatch` VARCHAR(20),
 `creneauMatch` VARCHAR(6),
 `typeMatch` VARCHAR(12),
 `tournoi` VARCHAR(20),
 `inactif` int(1) DEFAULT 0,
 `estjoue` BOOLEAN NOT NULL DEFAULT FALSE,
 PRIMARY KEY (`idMatch`)
 ) ENGINE = InnoDB;

CREATE TABLE `arbitre` (
 `idArbitre` TINYINT NOT NULL AUTO_INCREMENT , `categorie` CHAR(4) NOT NULL , `nomArbitre` VARCHAR(20) NOT NULL , `prenomArbitre` VARCHAR(20) NOT NULL , PRIMARY KEY (`idArbitre`)
) ENGINE = InnoDB;

CREATE TABLE `ramasseurs` (
`idRamasseur` TINYINT NOT NULL AUTO_INCREMENT , `nomRamasseur` VARCHAR(20) NOT NULL , `prenomRamasseur` VARCHAR(20) NOT NULL , PRIMARY KEY (`idRamasseur`)
) ENGINE = InnoDB;

-- Idée trigger : vérifier qu'une même équipe de ramasseurs ne participe pas à 2 matchs de suite.

 CREATE TABLE `equipeA` (
 `equipeArbitre` TINYINT NOT NULL AUTO_INCREMENT , `libelleEquipeA` VARCHAR(50) NOT NULL , PRIMARY KEY (`equipeArbitre`)
 ) ENGINE = InnoDB;

 CREATE TABLE `equipeR` (
 `equipeRamasseurs` TINYINT NOT NULL AUTO_INCREMENT , `libelleEquipeR` VARCHAR(50) NOT NULL , PRIMARY KEY (`equipeRamasseurs`)
 ) ENGINE = InnoDB;

 CREATE TABLE `joueur` (
 `idjoueur` SMALLINT NOT NULL AUTO_INCREMENT ,
 `nomjoueur` VARCHAR(30) NOT NULL ,
 `prenomjoueur` VARCHAR(30) NULL ,
 `datenaissance` DATE NULL ,
 `nationalite` VARCHAR(30) NOT NULL ,
 `classementATP` VARCHAR(10) NULL ,
  PRIMARY KEY (`idjoueur`)
 ) ENGINE = InnoDB;

 CREATE TABLE `score` (
 `idmatch` INT NOT NULL ,
 `idjoueur` SMALLINT NOT NULL ,
 `numeroset` TINYINT NOT NULL ,
 `nbjeux` TINYINT NOT NULL ,
 PRIMARY KEY (`idmatch`, `idjoueur`, `numeroset`)
 ) ENGINE = InnoDB;

--
-- Contraintes pour la partie billeterie
--

ALTER TABLE `commande`
	ADD CONSTRAINT `fk_emplacement` FOREIGN KEY (`idemplacement`)
REFERENCES `emplacement`(`idemplacement`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `commande`
	ADD CONSTRAINT `fk_tbillet` FOREIGN KEY (`idtbillet`)
REFERENCES `tbillet`(`idtbillet`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `commande`
	ADD CONSTRAINT `fk_client` FOREIGN KEY (`idclient`)
REFERENCES `client`(`idclient`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `promo`
    ADD CONSTRAINT `fk_promo_tbillet` FOREIGN KEY (`idtbillet`)
REFERENCES `tbillet`(`idtbillet`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `billet`
	ADD CONSTRAINT `fk_match` FOREIGN KEY (`idmatch`)
REFERENCES `_match`(`idmatch`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `billet`
	ADD CONSTRAINT `fk_tbillet_billet` FOREIGN KEY (`idtbillet`)
REFERENCES `tbillet`(`idtbillet`) ON DELETE CASCADE ON UPDATE CASCADE;

-- contraintes pour la partie PLANNING

ALTER TABLE `_match`
ADD `equipeA` TINYINT NOT NULL AFTER `tournoi`,
ADD `equipeR1` TINYINT NOT NULL AFTER `equipeA`,
ADD `equipeR2` TINYINT NOT NULL AFTER `equipeR1`,
ADD `joueurA1` SMALLINT NOT NULL AFTER `equipeR2`,
ADD `joueurA2` SMALLINT NULL AFTER `joueurA1`,
ADD `joueurB1` SMALLINT NOT NULL AFTER `joueurA2`,
ADD `joueurB2` SMALLINT NULL AFTER `joueurB1`,
ADD CONSTRAINT `FK_EquipeA` FOREIGN KEY (`equipeA`) REFERENCES `equipeA`(`equipeArbitre`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_EquipeR1` FOREIGN KEY (`equipeR1`) REFERENCES `equipeR`(`equipeRamasseurs`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_EquipeR2` FOREIGN KEY (`equipeR2`) REFERENCES `equipeR`(`equipeRamasseurs`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_JoueurA1` FOREIGN KEY (`joueurA1`) REFERENCES `joueur`(`idjoueur`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_JoueurA2` FOREIGN KEY (`joueurA2`) REFERENCES `joueur`(`idjoueur`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_JoueurB1` FOREIGN KEY (`joueurB1`) REFERENCES `joueur`(`idjoueur`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_JoueurB2` FOREIGN KEY (`joueurB2`) REFERENCES `joueur`(`idjoueur`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `arbitre` ADD `equipeArbitre` TINYINT NOT NULL AFTER `prenomArbitre`,
ADD CONSTRAINT `FK_AEQUIPEA` FOREIGN KEY (`equipeArbitre`) REFERENCES `equipeA`(`equipeArbitre`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `ramasseurs` ADD `equipeRamasseurs` TINYINT NOT NULL AFTER `prenomRamasseur`,
ADD CONSTRAINT `FK_REQUIPER` FOREIGN KEY (`equipeRamasseurs`) REFERENCES `equipeR`(`equipeRamasseurs`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `score` ADD CONSTRAINT `fk_scorematch` FOREIGN KEY (`idmatch`) REFERENCES `_match`(`idmatch`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `score` ADD CONSTRAINT `fk_scorejoueur` FOREIGN KEY (`idjoueur`) REFERENCES `joueur`(`idjoueur`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Procédures et triggers

--  Trigger 1 - met à jour la table des ventes

DELIMITER |
CREATE TRIGGER after_commande AFTER INSERT
ON commande FOR EACH ROW
BEGIN
    UPDATE ventes
    SET nbventes = nbventes+1
    WHERE idventes =1;
END |


-- Trigger 2 - Supprime un match quand la quantité de billet tombe à zero
-- pour ne pas proposer des billets sold out à la vente.
-- + Desactiver un match dont la date est passé.


DELIMITER | -- OK fonctionne
CREATE TRIGGER suppr_match before UPDATE
ON commande FOR EACH ROW
BEGIN
	 DECLARE id int;
     SET id =(SELECT idmatch from _match WHERE EXISTS (SELECT idmatch FROM billet WHERE quantite=0));
     UPDATE _match SET inactif = 1 WHERE idmatch= id;
     UPDATE _match SET inactif= 1 WHERE dateMatch < CURRENT_TIMESTAMP;

END |


-- Trigger 3 - controle date lors de l'ajout match

DELIMITER |
CREATE TRIGGER ajout_match before INSERT ON _match
FOR EACH ROW
BEGIN
 IF new.dateMatch < CURRENT_TIMESTAMP
 THEN
 	SIGNAL SQLSTATE '45001'
    SET MESSAGE_TEXT = "Vous ne pouvez pas ajouter de match à une date antérieure";
 END IF;
END |

/*
DELIMITER | -- marche pas : empeche la quantite de passer à zéro
CREATE TRIGGER suppr_match AFTER UPDATE
ON billet FOR EACH ROW
BEGIN
	 DECLARE id int;
     SET id =(select idmatch from _match where EXISTS (select idmatch from billet where quantite=0));
     UPDATE _match SET inactif = 1 where idmatch= id;

     update `_match` set inactif= 1 where dateMatch < CURRENT_TIMESTAMP;

END |
*/






-- Triggers

-- Vues fonctionne pas encore
/*
CREATE VIEW detail_commande
AS
	SELECT _match.libelleMatch,_match.datematch, tbillet.libelletbillet,commande.idcommande,client.NOMCLIENT,client.PRENOMCLIENT,emplacement.libelleemplacement
    FROM _match
    INNER JOIN billet on _match.idmatch=billet.idmatch
    INNER JOIN tbillet on tbillet.idtbillet=billet.idtbillet
    INNER JOIN commande on commande.idtbillet=tbillet.idtbillet
    INNER JOIN client on client.idclient= commande.idclient;
*/


--  Insertion des données de test
  INSERT INTO `equipeA` (`equipeArbitre`, `libelleEquipeA`) VALUES (NULL, 'Equipe 1');

  INSERT INTO `equipeR` (`equipeRamasseurs`, `libelleEquipeR`) VALUES (NULL, 'brascassés');
  INSERT INTO `equipeR` (`equipeRamasseurs`, `libelleEquipeR`) VALUES (NULL, 'etudiants');

  INSERT INTO `ramasseurs` (`idRamasseur`, `nomRamasseur`, `prenomRamasseur`, `equipeRamasseurs`) VALUES (NULL, 'Magic', 'Jhonson', '1');
  INSERT INTO `ramasseurs` (`idRamasseur`, `nomRamasseur`, `prenomRamasseur`, `equipeRamasseurs`) VALUES (NULL, 'Kobe', 'Bryan', '1');

  INSERT INTO `joueur` (`idjoueur`, `nomjoueur`, `prenomjoueur`, `datenaissance`, `nationalite`, `classementATP`) VALUES (NULL, 'Cazelly', 'Aurore', '2019-04-17', 'Francais', '150');
  INSERT INTO `joueur` (`idjoueur`, `nomjoueur`, `prenomjoueur`, `datenaissance`, `nationalite`, `classementATP`) VALUES (NULL, 'Busquet', 'Salomé', '2019-04-17', 'Francais', '150');

  INSERT INTO `joueur` (`idjoueur`, `nomjoueur`, `prenomjoueur`, `datenaissance`, `nationalite`, `classementATP`) VALUES (NULL, 'Quemar', 'Martin', '2019-04-17', 'Francais', '150');
  INSERT INTO `joueur` (`idjoueur`, `nomjoueur`, `prenomjoueur`, `datenaissance`, `nationalite`, `classementATP`) VALUES (NULL, 'Anginieur', 'Bastien', '2019-04-17', 'Francais', '150');

  INSERT INTO `_match` (`idmatch`, `libelleMatch`, `dateMatch`, `coeffMatch`, `courtMatch`, `creneauMatch`, `typeMatch`, `tournoi`, `equipeA`, `equipeR1`, `equipeR2`, `joueurA1`, `joueurA2`, `joueurB1`, `joueurB2`, `inactif`, `estjoue`)
  VALUES (NULL, 'Match1', '2020-07-23', '1', 'Central', '14h', 'double', 'Open', '1', '1', '2', '1', '2', '3', '4', '0', '0');


  -- création match simple
  INSERT INTO `_match` (`idmatch`, `libelleMatch`, `dateMatch`, `coeffMatch`, `courtMatch`, `creneauMatch`, `typeMatch`, `tournoi`, `equipeA`, `equipeR1`, `equipeR2`, `joueurA1`, `joueurA2`, `joueurB1`, `joueurB2`, `inactif`, `estjoue`)
  VALUES (NULL, 'Match1', '2020-07-24', '1.2', 'Central', '14h', 'simple', 'Open', '1', '1', '2', '1', null, '2', null, '0', '0');


  INSERT INTO `tbillet` (`idtbillet`, `prixtbillet`, `libelletbillet`) VALUES (NULL, '50', 'promo');
  INSERT INTO `tbillet` (`idtbillet`, `prixtbillet`, `libelletbillet`) VALUES (NULL, '40', 'licencie');
  INSERT INTO `tbillet` (`idtbillet`, `prixtbillet`, `libelletbillet`) VALUES (NULL, '40', 'grandPublic');
  INSERT INTO `tbillet` (`idtbillet`, `prixtbillet`, `libelletbillet`) VALUES (NULL, '40', 'journéeSolidarité');
  INSERT INTO `tbillet` (`idtbillet`, `prixtbillet`, `libelletbillet`) VALUES (NULL, '40', 'theBigMatch');

  INSERT INTO `emplacement` (`idemplacement`, `libelleemplacement`, `coeffemplacement`) VALUES (NULL, 'Tribune', '0.95');
  INSERT INTO `promo` (`idpromo`, `libellepromo`, `coeffpromo`, `idtbillet`) VALUES (NULL, 'Etudiant', '0.9', '2');
  INSERT INTO `promo` (`idpromo`, `libellepromo`, `coeffpromo`, `idtbillet`) VALUES (NULL, 'Chomeur', '0.8', '4');
  INSERT INTO `licence` (`idlicence`, `numlicencie`) VALUES (NULL, '10');
  INSERT INTO `billet` (`idbillet`, `idtbillet`, `idmatch`, `quantite`, `libellebillet`) VALUES (NULL, '2', '1', '5', 'Match1Promo');
  INSERT INTO `billet` (`idbillet`, `idtbillet`, `idmatch`, `quantite`, `libellebillet`) VALUES (NULL, '1', '1', '10', 'Match1 - licencié');
  INSERT INTO `billet` (`idbillet`, `idtbillet`, `idmatch`, `quantite`, `libellebillet`) VALUES (NULL, '2', '2', '6', 'MatchEfef-Promo');


  INSERT INTO `ventes` (`idventes`, `montanttotal`, `paniermoyen`, `nbventes`, `mois`)
  VALUES ('1', '0', '0', '0', 'Janvier');

-- procédure 1 - met à jour le champ ESTLICENCIE si le client à passé une
-- commande d'un billet licencié

DELIMITER |
CREATE PROCEDURE enregistrer_licence()
	BEGIN
  DECLARE id INT;
  DECLARE done INT DEFAULT FALSE; -- variable done indique quand on a parcouru toutes les données
  DECLARE curseur CURSOR
  FOR select client.idclient from commande inner join client
  on commande.idclient = client.IDCLIENT
  inner join tbillet on commande.idtbillet = tbillet.idtbillet
  where tbillet.libelletbillet ='licencie';
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

  OPEN curseur;
  myloop: LOOP
  	FETCH curseur INTO id;
    IF done THEN
    	LEAVE myloop;
    END IF;
    UPDATE client SET ESTLICENCIE ="1";
  END LOOP;
  CLOSE curseur;
END;



-- comptabilise le nombre de billets restants pour un match donné

DELIMITER |
CREATE PROCEDURE recap_ventes()
BEGIN

	select sum(commande.montant) as ventes_totales from commande INNER JOIN tbillet on tbillet.idtbillet=commande.idtbillet
    INNER JOIN billet on billet.idtbillet=tbillet.idtbillet
    INNER JOIN _match on _match.idmatch=billet.idmatch;

    select sum(commande.montant) Ventes_match,_match.libelleMatch as intitule_match from commande
    INNER JOIN tbillet on tbillet.idtbillet=commande.idtbillet
    INNER JOIN billet on billet.idtbillet=tbillet.idtbillet
    INNER JOIN _match on _match.idmatch=billet.idmatch
    group by _match.idmatch order by sum(commande.montant) DESC;

END |

-- pour appeler la procédure:
--  CALL billets_restants(4,@qtotale);

-- Pour des raisons d’équité, un même arbitre de chaise ne doit pas juger plus de
--  4 matchs sur la durée du tournoi (2 en Simples et 2 en Double).


create or replace VIEW matchs_terminés
as
SELECT `idmatch`,`dateMatch`,`libelleMatch`,`creneauMatch`,`tournoi` FROM `_match` WHERE `estjoue`=1 ORDER BY `datematch`;

create or  replace VIEW Matchs
  as
SELECT `idmatch`,`dateMatch`,`libelleMatch`,`creneauMatch`
FROM `_match`

Create view commandebillet
AS SELECT idtbillet, COUNT(idcommande) as totalcommande
FROM commande
GROUP BY idtbillet

-- gestion des Index

CREATE UNIQUE INDEX index_mail
ON client (MAILCLIENT);  -- Crée un index UNIQUE

CREATE INDEX index_matchs
ON billet (idmatch);  -- Crée un index simple
