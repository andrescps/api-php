-- MySQL Script generated by MySQL Workbench
-- 05/12/22 00:15:16
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema crud
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `crud` ;

-- -----------------------------------------------------
-- Schema crud
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `crud` DEFAULT CHARACTER SET utf8 ;
USE `crud` ;

-- -----------------------------------------------------
-- Table `crud`.`viajeros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `crud`.`viajeros` (
  `id_viajeros` INT NOT NULL AUTO_INCREMENT,
  `nombe` VARCHAR(45) NOT NULL,
  `cedula_viajero` INT NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  `telefono` INT NOT NULL,
  PRIMARY KEY (`id_viajeros`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crud`.`viajes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `crud`.`viajes` (
  `id_viajes` INT NOT NULL AUTO_INCREMENT,
  `codigo_viaje` INT NOT NULL,
  `numero_plazas` INT NOT NULL,
  `destino` VARCHAR(45) NOT NULL,
  `origen` VARCHAR(45) NOT NULL,
  `precio` INT NOT NULL,
  PRIMARY KEY (`id_viajes`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crud`.`user_viajes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `crud`.`user_viajes` (
  `id_user_viajes` INT NOT NULL AUTO_INCREMENT,
  `id_viajeros` INT NOT NULL,
  `id_viajes` INT NOT NULL,
  PRIMARY KEY (`id_user_viajes`),
  CONSTRAINT `fk_id_viajeros`
    FOREIGN KEY (`id_viajeros`)
    REFERENCES `crud`.`viajeros` (`id_viajeros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_viajes`
    FOREIGN KEY (`id_viajes`)
    REFERENCES `crud`.`viajes` (`id_viajes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_id_viajeros_idx` ON `crud`.`user_viajes` (`id_viajeros` ASC);

CREATE INDEX `fk_id_viajes_idx` ON `crud`.`user_viajes` (`id_viajes` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;