-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema michaelprepatest
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema michaelprepatest
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `michaelprepatest` DEFAULT CHARACTER SET latin1 ;
USE `michaelprepatest` ;

-- -----------------------------------------------------
-- Table `michaelprepatest`.`fos_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `michaelprepatest`.`fos_user` (
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
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `michaelprepatest`.`news`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `michaelprepatest`.`news` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(120) NULL,
  `texte` TEXT NULL,
  `temps` TIMESTAMP NULL,
  `fosUserId` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_news_fos_user_idx` (`fosUserId` ASC),
  CONSTRAINT `fk_news_fos_user`
    FOREIGN KEY (`fosUserId`)
    REFERENCES `michaelprepatest`.`fos_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `michaelprepatest`.`images`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `michaelprepatest`.`images` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `michaelprepatest`.`images_has_news`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `michaelprepatest`.`images_has_news` (
  `images_id` INT UNSIGNED NOT NULL,
  `news_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`images_id`, `news_id`),
  INDEX `fk_images_has_news_news1_idx` (`news_id` ASC),
  INDEX `fk_images_has_news_images1_idx` (`images_id` ASC),
  CONSTRAINT `fk_images_has_news_images1`
    FOREIGN KEY (`images_id`)
    REFERENCES `michaelprepatest`.`images` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_images_has_news_news1`
    FOREIGN KEY (`news_id`)
    REFERENCES `michaelprepatest`.`news` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
