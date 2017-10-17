-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema michaelprepamany
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema michaelprepamany
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `michaelprepamany` DEFAULT CHARACTER SET latin1 ;
USE `michaelprepamany` ;

-- -----------------------------------------------------
-- Table `michaelprepamany`.`fos_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `michaelprepamany`.`fos_user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(180) CHARACTER SET 'utf8' NOT NULL,
  `username_canonical` VARCHAR(180) CHARACTER SET 'utf8' NOT NULL,
  `email` VARCHAR(180) CHARACTER SET 'utf8' NOT NULL,
  `email_canonical` VARCHAR(180) CHARACTER SET 'utf8' NOT NULL,
  `enabled` TINYINT(1) NOT NULL,
  `salt` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `password` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL,
  `last_login` DATETIME NULL DEFAULT NULL,
  `confirmation_token` VARCHAR(180) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `password_requested_at` DATETIME NULL DEFAULT NULL,
  `roles` LONGTEXT CHARACTER SET 'utf8' NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UNIQ_957A647992FC23A8` (`username_canonical` ASC),
  UNIQUE INDEX `UNIQ_957A6479A0D96FBF` (`email_canonical` ASC),
  UNIQUE INDEX `UNIQ_957A6479C05FB297` (`confirmation_token` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `michaelprepamany`.`blabla`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `michaelprepamany`.`blabla` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(100) NULL,
  `texte` TEXT NULL,
  `ladate` TIMESTAMP NULL,
  `fos_user_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_blabla_fos_user_idx` (`fos_user_id` ASC),
  CONSTRAINT `fk_blabla_fos_user`
    FOREIGN KEY (`fos_user_id`)
    REFERENCES `michaelprepamany`.`fos_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `michaelprepamany`.`image`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `michaelprepamany`.`image` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `michaelprepamany`.`image_has_blabla`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `michaelprepamany`.`image_has_blabla` (
  `image_id` INT UNSIGNED NOT NULL,
  `blabla_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`image_id`, `blabla_id`),
  INDEX `fk_image_has_blabla_blabla1_idx` (`blabla_id` ASC),
  INDEX `fk_image_has_blabla_image1_idx` (`image_id` ASC),
  CONSTRAINT `fk_image_has_blabla_image1`
    FOREIGN KEY (`image_id`)
    REFERENCES `michaelprepamany`.`image` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_image_has_blabla_blabla1`
    FOREIGN KEY (`blabla_id`)
    REFERENCES `michaelprepamany`.`blabla` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
