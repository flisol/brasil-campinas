SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `Flisol` ;
CREATE SCHEMA IF NOT EXISTS `Flisol` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `Flisol` ;

-- -----------------------------------------------------
-- Table `Flisol`.`Inscricoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Flisol`.`Inscricoes` ;

CREATE  TABLE IF NOT EXISTS `Flisol`.`Inscricoes` (
  `idInscricao` INT(10) NOT NULL AUTO_INCREMENT ,
  `uuid` VARCHAR(45) NOT NULL ,
  `nome` VARCHAR(45) NOT NULL ,
  `sobrenome` VARCHAR(255) NOT NULL ,
  `rg` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `cidade` VARCHAR(45) NOT NULL ,
  `estado` VARCHAR(45) NOT NULL ,
  `dataCriacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `tipo` ENUM('staff','regular','vip','press') NOT NULL DEFAULT 'regular' ,
  `website` VARCHAR(45) NULL ,
  PRIMARY KEY (`idInscricao`) ,
  UNIQUE INDEX `EMAIL` (`email` ASC) ,
  UNIQUE INDEX `UUID` (`uuid` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Flisol`.`Palestras`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Flisol`.`Palestras` ;

CREATE  TABLE IF NOT EXISTS `Flisol`.`Palestras` (
  `idPalestra` INT(10) NOT NULL AUTO_INCREMENT ,
  `idPalestrante` INT(10) NOT NULL ,
  `titulo` VARCHAR(50) NOT NULL ,
  `resumo` VARCHAR(255) NOT NULL ,
  `duracao` VARCHAR(45) NOT NULL DEFAULT 0 ,
  `descricao` TEXT NOT NULL ,
  `data` DATETIME NULL ,
  `status` ENUM('submetida','aprovada','rejeitada','cancelada','executada') NOT NULL DEFAULT 'submetida' ,
  `dataCriacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`idPalestra`, `idPalestrante`) ,
  INDEX `fk_Palestras_Inscricoes1_idx` (`idPalestrante` ASC) ,
  CONSTRAINT `fk_Palestras_Inscricoes1`
    FOREIGN KEY (`idPalestrante` )
    REFERENCES `Flisol`.`Inscricoes` (`idInscricao` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Flisol`.`Presenca`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Flisol`.`Presenca` ;

CREATE  TABLE IF NOT EXISTS `Flisol`.`Presenca` (
  `idPresencao` INT(10) NOT NULL AUTO_INCREMENT ,
  `idInscricao` INT(10) NOT NULL ,
  `status` ENUM('inscrito','presente') NOT NULL DEFAULT 'presente' ,
  `dataCriacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`idPresencao`, `idInscricao`) ,
  INDEX `fk_Presenca_Usuarios1_idx` (`idInscricao` ASC) ,
  CONSTRAINT `fk_Presenca_Usuarios1`
    FOREIGN KEY (`idInscricao` )
    REFERENCES `Flisol`.`Inscricoes` (`idInscricao` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
