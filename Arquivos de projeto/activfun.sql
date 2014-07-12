SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE TABLE IF NOT EXISTS `activfun`.`usuarios` (
  `idusuarios` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  `data_nascimento` VARCHAR(45) NULL DEFAULT NULL,
  `foto` BLOB NULL DEFAULT NULL,
  `create_time` TIMESTAMP NULL DEFAULT NULL,
  UNIQUE INDEX `idusuarios_UNIQUE` (`idusuarios` ASC),
  PRIMARY KEY (`idusuarios`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `activfun`.`Interesses` (
  `idInteresses` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idInteresses`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `activfun`.`usuarios_interesses` (
  `usuarios_idusuarios` INT(11) NOT NULL,
  `Interesses_idInteresses` INT(11) NOT NULL,
  PRIMARY KEY (`usuarios_idusuarios`, `Interesses_idInteresses`),
  INDEX `fk_usuarios_has_Interesses_Interesses1_idx` (`Interesses_idInteresses` ASC),
  INDEX `fk_usuarios_has_Interesses_usuarios_idx` (`usuarios_idusuarios` ASC),
  CONSTRAINT `fk_usuarios_has_Interesses_usuarios`
    FOREIGN KEY (`usuarios_idusuarios`)
    REFERENCES `activfun`.`usuarios` (`idusuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_Interesses_Interesses1`
    FOREIGN KEY (`Interesses_idInteresses`)
    REFERENCES `activfun`.`Interesses` (`idInteresses`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `activfun`.`Atividades` (
  `idAtividades` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NULL DEFAULT NULL,
  `descricao` TEXT NULL DEFAULT NULL,
  `data_inicio` DATE NULL DEFAULT NULL,
  `data_fim` DATE NULL DEFAULT NULL,
  `endereco` VARCHAR(80) NULL DEFAULT NULL,
  `latitude` VARCHAR(45) NULL DEFAULT NULL,
  `longitude` VARCHAR(45) NULL DEFAULT NULL,
  `usuarios_idusuarios` INT(11) NOT NULL,
  `Interesses_idInteresses` INT(11) NOT NULL,
  PRIMARY KEY (`idAtividades`),
  INDEX `fk_Atividades_usuarios1_idx` (`usuarios_idusuarios` ASC),
  INDEX `fk_Atividades_Interesses1_idx` (`Interesses_idInteresses` ASC),
  CONSTRAINT `fk_Atividades_usuarios1`
    FOREIGN KEY (`usuarios_idusuarios`)
    REFERENCES `activfun`.`usuarios` (`idusuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Atividades_Interesses1`
    FOREIGN KEY (`Interesses_idInteresses`)
    REFERENCES `activfun`.`Interesses` (`idInteresses`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `activfun`.`participa` (
  `usuarios_idusuarios` INT(11) NOT NULL,
  `Atividades_idAtividades` INT(11) NOT NULL,
  PRIMARY KEY (`usuarios_idusuarios`, `Atividades_idAtividades`),
  INDEX `fk_usuarios_has_Atividades_Atividades1_idx` (`Atividades_idAtividades` ASC),
  INDEX `fk_usuarios_has_Atividades_usuarios1_idx` (`usuarios_idusuarios` ASC),
  CONSTRAINT `fk_usuarios_has_Atividades_usuarios1`
    FOREIGN KEY (`usuarios_idusuarios`)
    REFERENCES `activfun`.`usuarios` (`idusuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_Atividades_Atividades1`
    FOREIGN KEY (`Atividades_idAtividades`)
    REFERENCES `activfun`.`Atividades` (`idAtividades`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `activfun`.`comenta` (
  `usuarios_idusuarios` INT(11) NOT NULL,
  `Atividades_idAtividades` INT(11) NOT NULL,
  `comentario` TEXT NOT NULL,
  `create_time` TIMESTAMP NOT NULL,
  PRIMARY KEY (`usuarios_idusuarios`, `Atividades_idAtividades`),
  INDEX `fk_usuarios_has_Atividades_Atividades2_idx` (`Atividades_idAtividades` ASC),
  INDEX `fk_usuarios_has_Atividades_usuarios2_idx` (`usuarios_idusuarios` ASC),
  CONSTRAINT `fk_usuarios_has_Atividades_usuarios2`
    FOREIGN KEY (`usuarios_idusuarios`)
    REFERENCES `activfun`.`usuarios` (`idusuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_Atividades_Atividades2`
    FOREIGN KEY (`Atividades_idAtividades`)
    REFERENCES `activfun`.`Atividades` (`idAtividades`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
