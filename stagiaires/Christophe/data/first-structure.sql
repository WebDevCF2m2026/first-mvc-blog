-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema first
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `first` ;

-- -----------------------------------------------------
-- Schema first
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `first` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `first` ;

-- -----------------------------------------------------
-- Table `first`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `first`.`user` ;

CREATE TABLE IF NOT EXISTS `first`.`user` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id par défaut\nobligatoire mais autoincrément\nunsigned',
  `username` VARCHAR(30) NOT NULL COMMENT 'Pour se connecter',
  `email` VARCHAR(120) NOT NULL COMMENT 'mail de user',
  `realname` VARCHAR(60) NULL,
  `pwd` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_0900_as_cs' NOT NULL COMMENT 'Mot de passe haché, sera géré par PHP\nchangement de case, il doit être case sensitive (cs)\nVoir password_hash() et password_verify()\n255 carcatères pour avenir',
  `actif` TINYINT NULL DEFAULT 0 COMMENT 'basé sur 1 octet, donc 256 posibilités\n\n0 => inscrit non validé par mail\n1 => actif grâce au mail \n2 => bannie',
  `uniqid` CHAR(59) NOT NULL COMMENT 'uniqid est créé avec la fonction uniquid(true) de PHP et on rajoute des bytes transformés en haxadécimal',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `username_UNIQUE` ON `first`.`user` (`username` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `first`.`article`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `first`.`article` ;

CREATE TABLE IF NOT EXISTS `first`.`article` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) NOT NULL,
  `content` TEXT NOT NULL,
  `date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Temps du serveur actuel : CURRENT_TIMESTAMP ou NOW()',
  `published` TINYINT UNSIGNED NULL DEFAULT 1 COMMENT 'Valeur de 0 à 255\n0 => non publié\n1 => publié\n2 => caché',
  `user_id` INT UNSIGNED NOT NULL COMMENT 'Un article ne peut avoir 1 seul user',
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_article_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `first`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_article_user_idx` ON `first`.`article` (`user_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `first`.`category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `first`.`category` ;

CREATE TABLE IF NOT EXISTS `first`.`category` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `description` VARCHAR(400) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `first`.`category_has_article`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `first`.`category_has_article` ;

CREATE TABLE IF NOT EXISTS `first`.`category_has_article` (
  `category_id` INT UNSIGNED NOT NULL,
  `article_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`category_id`, `article_id`),
  CONSTRAINT `fk_category_has_article_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `first`.`category` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_category_has_article_article1`
    FOREIGN KEY (`article_id`)
    REFERENCES `first`.`article` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_category_has_article_article1_idx` ON `first`.`category_has_article` (`article_id` ASC) VISIBLE;

CREATE INDEX `fk_category_has_article_category1_idx` ON `first`.`category_has_article` (`category_id` ASC) VISIBLE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
