﻿-- MySQL Script generated by MySQL Workbench
-- Tue Apr  9 17:56:51 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema esispace
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema esispace
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `esispace` DEFAULT CHARACTER SET latin1 ;
USE `esispace` ;

-- -----------------------------------------------------
-- Table `esispace`.`utilisateur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `esispace`.`utilisateur` (
  `idutilisateur` VARCHAR(30) NOT NULL,
  `nom` VARCHAR(45) NOT NULL,
  `prenom` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `motpass` VARCHAR(45) NOT NULL,
  `photo_prf` VARCHAR(60) NULL DEFAULT 'photo_profile/default.png',
  `type_utilisateur` ENUM('a', 'd', 'n') NOT NULL,
  PRIMARY KEY (`idutilisateur`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `esispace`.`enseignent`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `esispace`.`enseignent` (
  `date_ns` DATE NOT NULL,
  `grade` VARCHAR(30) NOT NULL,
  `utilisateur_idutilisateur` VARCHAR(30) NOT NULL,
  INDEX `fk_enseignent_utilisateur1_idx` (`utilisateur_idutilisateur` ASC),
  CONSTRAINT `fk_enseignent_utilisateur1`
    FOREIGN KEY (`utilisateur_idutilisateur`)
    REFERENCES `esispace`.`utilisateur` (`idutilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `esispace`.`etudiant`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `esispace`.`etudiant` (
  `date_ns` DATE NOT NULL,
  `lieu_ns` VARCHAR(20) NOT NULL,
  `groupe` VARCHAR(20) NOT NULL,
  `annee` VARCHAR(20) NOT NULL,
  `section` VARCHAR(20) NULL DEFAULT NULL,
  `utilisateur_idutilisateur` VARCHAR(30) NOT NULL,
  INDEX `fk_etudiant_utilisateur1_idx` (`utilisateur_idutilisateur` ASC),
  CONSTRAINT `fk_etudiant_utilisateur1`
    FOREIGN KEY (`utilisateur_idutilisateur`)
    REFERENCES `esispace`.`utilisateur` (`idutilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `esispace`.`Module`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `esispace`.`Module` (
  `idModule` INT NOT NULL,
  `Nommodule` VARCHAR(45) NULL,
  `coff` VARCHAR(45) NULL,
  `annee` VARCHAR(45) NULL,
  `semestre` VARCHAR(45) NULL,
  PRIMARY KEY (`idModule`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `esispace`.`message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `esispace`.`message` (
  `idmessage` INT NOT NULL AUTO_INCREMENT ,
  `text` TEXT NULL,
  `util_envoyer` VARCHAR(45) NOT NULL,
  `util_recevoir` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idmessage`),
  INDEX `fk_message_utilisateur1_idx` (`util_envoyer` ASC) ,
  INDEX `fk_message_utilisateur2_idx` (`util_recevoir` ASC) ,
  CONSTRAINT `fk_message_utilisateur1`
    FOREIGN KEY (`util_envoyer`)
    REFERENCES `esispace`.`utilisateur` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_message_utilisateur2`
    FOREIGN KEY (`util_recevoir`)
    REFERENCES `esispace`.`utilisateur` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `esispace`.`note`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `esispace`.`note` (
  `idnote` INT NOT NULL,
  `cntrl_intr` VARCHAR(45) NULL,
  `cntrl_final` VARCHAR(45) NULL,
  `td` VARCHAR(45) NULL,
  `Module_idModule` INT NOT NULL,
  `utilisateur_idutilisateur` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idnote`),
  INDEX `fk_note_Module1_idx` (`Module_idModule` ASC) VISIBLE,
  INDEX `fk_note_utilisateur1_idx` (`utilisateur_idutilisateur` ASC) VISIBLE,
  CONSTRAINT `fk_note_Module1`
    FOREIGN KEY (`Module_idModule`)
    REFERENCES `esispace`.`Module` (`idModule`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_note_utilisateur1`
    FOREIGN KEY (`utilisateur_idutilisateur`)
    REFERENCES `esispace`.`utilisateur` (`idutilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `esispace`.`releveNote`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `esispace`.`releveNote` (
  `idreleve` INT NOT NULL,
  `annee` VARCHAR(45) NULL,
  `semestre` VARCHAR(45) NULL,
  `moyenne` VARCHAR(45) NULL,
  `utilisateur_idutilisateur` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idreleve`),
  INDEX `fk_releveNote_utilisateur1_idx` (`utilisateur_idutilisateur` ASC) VISIBLE,
  CONSTRAINT `fk_releveNote_utilisateur1`
    FOREIGN KEY (`utilisateur_idutilisateur`)
    REFERENCES `esispace`.`utilisateur` (`idutilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `esispace`.`seance`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `esispace`.`seance` (
  `idseance` INT NOT NULL,
  `type` ENUM("cours", "td", "tp") NULL,
  `duree` VARCHAR(45) NULL,
  `jour` VARCHAR(45) NULL,
  `grp_sec` VARCHAR(45) NULL,
  `sall_amphi` VARCHAR(45) NULL,
  `Module_idModule` INT NOT NULL,
  `plage_hr` VARCHAR(45) NULL,
  `utilisateur_idutilisateur` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idseance`),
  INDEX `fk_seance_Module1_idx` (`Module_idModule` ASC) VISIBLE,
  INDEX `fk_seance_utilisateur1_idx` (`utilisateur_idutilisateur` ASC) VISIBLE,
  CONSTRAINT `fk_seance_Module1`
    FOREIGN KEY (`Module_idModule`)
    REFERENCES `esispace`.`Module` (`idModule`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_seance_utilisateur1`
    FOREIGN KEY (`utilisateur_idutilisateur`)
    REFERENCES `esispace`.`utilisateur` (`idutilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `esispace`.`spicialité`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `esispace`.`spicialité` (
  `spicialité` INT NOT NULL,
  `nom_spic` VARCHAR(45) NULL,
  `utilisateur_idutilisateur` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`spicialité`),
  INDEX `fk_spicialité_utilisateur1_idx` (`utilisateur_idutilisateur` ASC) VISIBLE,
  CONSTRAINT `fk_spicialité_utilisateur1`
    FOREIGN KEY (`utilisateur_idutilisateur`)
    REFERENCES `esispace`.`utilisateur` (`idutilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `esispace`.`annee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `esispace`.`annee` (
  `idannee` INT NOT NULL,
  `nom_annee` VARCHAR(45) NULL,
  PRIMARY KEY (`idannee`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `esispace`.`section`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `esispace`.`section` (
  `idsection` INT NOT NULL,
  `nom_section` VARCHAR(45) NULL,
  `annee_idannee` INT NOT NULL,
  PRIMARY KEY (`idsection`),
  INDEX `fk_section_annee1_idx` (`annee_idannee` ASC) VISIBLE,
  CONSTRAINT `fk_section_annee1`
    FOREIGN KEY (`annee_idannee`)
    REFERENCES `esispace`.`annee` (`idannee`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `esispace`.`groupe`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `esispace`.`groupe` (
  `idgroupe` INT NOT NULL,
  `num_groupe` VARCHAR(45) NULL,
  `section_idsection` INT NOT NULL,
  PRIMARY KEY (`idgroupe`),
  INDEX `fk_groupe_section1_idx` (`section_idsection` ASC) VISIBLE,
  CONSTRAINT `fk_groupe_section1`
    FOREIGN KEY (`section_idsection`)
    REFERENCES `esispace`.`section` (`idsection`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `esispace`.`file_msg`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `esispace`.`file_msg` (
  `idfile_msg` INT NOT NULL AUTO_INCREMENT,
  `chemain` VARCHAR(60) NOT NULL,
  `message_idmessage` INT NOT NULL,
  PRIMARY KEY (`idfile_msg`),
  INDEX `fk_file_msg_message1_idx` (`message_idmessage` ASC) ,
  CONSTRAINT `fk_file_msg_message1`
    FOREIGN KEY (`message_idmessage`)
    REFERENCES `esispace`.`message` (`idmessage`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
