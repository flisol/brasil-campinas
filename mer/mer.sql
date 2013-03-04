SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `Flisol` ;
CREATE SCHEMA IF NOT EXISTS `Flisol` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `Flisol` ;

-- -----------------------------------------------------
-- Table `Flisol`.`Files`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Flisol`.`Files` ;

CREATE  TABLE IF NOT EXISTS `Flisol`.`Files` (
  `idFile` INT(10) NOT NULL AUTO_INCREMENT ,
  `mimeType` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `size` INT(10) NOT NULL ,
  `originalName` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `currentName` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `status` ENUM('active','blocked','suspense','deleted') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT 'active' ,
  `extension` VARCHAR(5) NOT NULL ,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`idFile`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `Flisol`.`Usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Flisol`.`Usuarios` ;

CREATE  TABLE IF NOT EXISTS `Flisol`.`Usuarios` (
  `idUsuario` INT(10) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `sobrenome` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `login` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `password` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `status` ENUM('active','blocked','suspense','deleted') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT 'active' ,
  `genero` ENUM('m','f') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `nascimento` DATETIME NOT NULL ,
  `dataCriacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`idUsuario`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `Flisol`.`Posts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Flisol`.`Posts` ;

CREATE  TABLE IF NOT EXISTS `Flisol`.`Posts` (
  `idPost` INT(10) NOT NULL AUTO_INCREMENT ,
  `idAutor` INT(10) NOT NULL ,
  `titulo` VARCHAR(255) NOT NULL ,
  `conteudoOriginal` BLOB NOT NULL ,
  `conteudo` BLOB NOT NULL ,
  `dataCriacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`idPost`, `idAutor`) ,
  INDEX `fk_Posts_Users` (`idAutor` ASC) ,
  CONSTRAINT `fk_Posts_Users`
    FOREIGN KEY (`idAutor` )
    REFERENCES `Flisol`.`Usuarios` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Flisol`.`Patrocinadores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Flisol`.`Patrocinadores` ;

CREATE  TABLE IF NOT EXISTS `Flisol`.`Patrocinadores` (
  `idPatrocinador` INT(10) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(45) NOT NULL ,
  `tipo` ENUM('gold','silver','bronze','general') NOT NULL DEFAULT 'general' ,
  `url` VARCHAR(45) NOT NULL ,
  `dataCriacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`idPatrocinador`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Flisol`.`Patrocinadores_has_Files`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Flisol`.`Patrocinadores_has_Files` ;

CREATE  TABLE IF NOT EXISTS `Flisol`.`Patrocinadores_has_Files` (
  `idPatrocinadoresHasFiles` INT(10) NOT NULL AUTO_INCREMENT ,
  `idPatrocinador` INT(10) NOT NULL ,
  `idFile` INT(10) NOT NULL ,
  INDEX `fk_Patrocinadores_has_Files_Files1` (`idFile` ASC) ,
  INDEX `fk_Patrocinadores_has_Files_Patrocinadores1` (`idPatrocinador` ASC) ,
  PRIMARY KEY (`idPatrocinadoresHasFiles`) ,
  CONSTRAINT `fk_Patrocinadores_has_Files_Patrocinadores1`
    FOREIGN KEY (`idPatrocinador` )
    REFERENCES `Flisol`.`Patrocinadores` (`idPatrocinador` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Patrocinadores_has_Files_Files1`
    FOREIGN KEY (`idFile` )
    REFERENCES `Flisol`.`Files` (`idFile` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


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
  `tipo` ENUM('staff','palestrante','regular','vip','press') NOT NULL DEFAULT 'regular' ,
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
  `descricao` TEXT NOT NULL ,
  `data` DATETIME NULL ,
  `dataCriacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`idPalestra`, `idPalestrante`) ,
  INDEX `fk_Palestras_Inscricoes1` (`idPalestrante` ASC) ,
  CONSTRAINT `fk_Palestras_Inscricoes1`
    FOREIGN KEY (`idPalestrante` )
    REFERENCES `Flisol`.`Inscricoes` (`idInscricao` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Flisol`.`Inscricoes_has_Palestras`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Flisol`.`Inscricoes_has_Palestras` ;

CREATE  TABLE IF NOT EXISTS `Flisol`.`Inscricoes_has_Palestras` (
  `idInscricoes_has_Palestras` INT(10) NOT NULL AUTO_INCREMENT ,
  `idInscricao` INT(10) NOT NULL ,
  `idPalestra` INT(10) NOT NULL ,
  INDEX `fk_Inscricoes_has_Palestras_Palestras1` (`idPalestra` ASC) ,
  INDEX `fk_Inscricoes_has_Palestras_Inscricoes1` (`idInscricao` ASC) ,
  PRIMARY KEY (`idInscricoes_has_Palestras`) ,
  CONSTRAINT `fk_Inscricoes_has_Palestras_Inscricoes1`
    FOREIGN KEY (`idInscricao` )
    REFERENCES `Flisol`.`Inscricoes` (`idInscricao` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Inscricoes_has_Palestras_Palestras1`
    FOREIGN KEY (`idPalestra` )
    REFERENCES `Flisol`.`Palestras` (`idPalestra` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
