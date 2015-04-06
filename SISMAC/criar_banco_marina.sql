-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema marina
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `marina` ;

-- -----------------------------------------------------
-- Schema marina
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `marina` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `marina` ;

-- -----------------------------------------------------
-- Table `marina`.`perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marina`.`perfil` (
  `idperfil` SMALLINT NOT NULL AUTO_INCREMENT,
  `perfil` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idperfil`),
  UNIQUE INDEX `perfil_UNIQUE` (`perfil` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marina`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marina`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(100) NOT NULL,
  `ativo` TINYINT(1) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `idperfil` SMALLINT NOT NULL,
  PRIMARY KEY (`id`, `idperfil`),
  INDEX `fk_usuario_perfil1_idx` (`idperfil` ASC),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC),
  CONSTRAINT `fk_usuario_perfil1`
    FOREIGN KEY (`idperfil`)
    REFERENCES `marina`.`perfil` (`idperfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marina`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marina`.`cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `foto` VARCHAR(255) NULL,
  `cpf` VARCHAR(14) NOT NULL,
  `rg` VARCHAR(15) NULL,
  `datanascimento` TIMESTAMP NULL,
  `ativo` TINYINT(1) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `conjugue` VARCHAR(45) NULL,
  `tipo` VARCHAR(1) NOT NULL,
  `datainicio` TIMESTAMP NULL DEFAULT now(),
  `datafim` TIMESTAMP NULL,
  PRIMARY KEY (`id`, `cpf`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marina`.`embarcacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marina`.`embarcacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `cor` VARCHAR(45) NOT NULL,
  `marcamotor` VARCHAR(45) NOT NULL,
  `ativo` TINYINT(1) NOT NULL,
  `casco` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marina`.`contrato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marina`.`contrato` (
  `idcliente` INT NOT NULL,
  `idembarcacao` INT NOT NULL,
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `datainicio` TIMESTAMP NOT NULL DEFAULT now(),
  `datafim` TIMESTAMP NULL,
  `vencimento` SMALLINT NOT NULL,
  `mensalidade` FLOAT NOT NULL,
  `ativo` TINYINT(1) NOT NULL,
  `tipo` VARCHAR(3) NOT NULL,
  PRIMARY KEY (`id`, `idcliente`, `idembarcacao`),
  INDEX `fk_cliente_has_embarcacao_embarcacao1_idx` (`idembarcacao` ASC),
  INDEX `fk_cliente_has_embarcacao_cliente_idx` (`idcliente` ASC),
  CONSTRAINT `fk_cliente_has_embarcacao_cliente`
    FOREIGN KEY (`idcliente`)
    REFERENCES `marina`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cliente_has_embarcacao_embarcacao1`
    FOREIGN KEY (`idembarcacao`)
    REFERENCES `marina`.`embarcacao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marina`.`telefone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marina`.`telefone` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `telefone` VARCHAR(15) NOT NULL,
  `idcliente` INT NOT NULL,
  `ativo` TINYINT(1) NOT NULL,
  `operadora` VARCHAR(45) NULL,
  `tipo` CHAR NOT NULL,
  PRIMARY KEY (`id`, `idcliente`),
  INDEX `fk_telefone_cliente1_idx` (`idcliente` ASC),
  CONSTRAINT `fk_telefone_cliente1`
    FOREIGN KEY (`idcliente`)
    REFERENCES `marina`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marina`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marina`.`endereco` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idcliente` INT NOT NULL,
  `rua` VARCHAR(255) NOT NULL,
  `bairro` VARCHAR(255) NOT NULL,
  `cidade` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  `numero` VARCHAR(45) NULL,
  `complemento` VARCHAR(255) NULL,
  `referencia` VARCHAR(255) NULL,
  `cep` VARCHAR(11) NULL,
  `ativo` VARCHAR(45) NOT NULL,
  `tipo` CHAR NOT NULL,
  PRIMARY KEY (`id`, `idcliente`),
  INDEX `fk_endereco_cliente1_idx` (`idcliente` ASC),
  CONSTRAINT `fk_endereco_cliente1`
    FOREIGN KEY (`idcliente`)
    REFERENCES `marina`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marina`.`email`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marina`.`email` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `idcliente` INT NOT NULL,
  `ativo` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`, `idcliente`),
  INDEX `fk_email_cliente1_idx` (`idcliente` ASC),
  CONSTRAINT `fk_email_cliente1`
    FOREIGN KEY (`idcliente`)
    REFERENCES `marina`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marina`.`formapagamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marina`.`formapagamento` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  `ativo` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marina`.`mensalidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marina`.`mensalidade` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `acrescimo` FLOAT NULL DEFAULT 0,
  `mesreferencia` SMALLINT NOT NULL,
  `idcontrato` BIGINT NOT NULL,
  `ativo` TINYINT(1) NOT NULL DEFAULT 0,
  `dataPagamento` TIMESTAMP NULL DEFAULT NULL,
  `idusuario` INT NULL,
  `desconto` FLOAT NULL DEFAULT 0,
  `anoreferencia` SMALLINT NOT NULL,
  `formapagamento` BIGINT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_mensalidade_contrato1_idx` (`idcontrato` ASC),
  INDEX `fk_mensalidade_usuario1_idx` (`idusuario` ASC),
  INDEX `fk_mensalidade_forma_pagamento1_idx` (`formapagamento` ASC),
  CONSTRAINT `fk_mensalidade_contrato1`
    FOREIGN KEY (`idcontrato`)
    REFERENCES `marina`.`contrato` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensalidade_usuario1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `marina`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensalidade_forma_pagamento1`
    FOREIGN KEY (`formapagamento`)
    REFERENCES `marina`.`formapagamento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marina`.`usuarioembarcacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marina`.`usuarioembarcacao` (
  `idusuario` INT NOT NULL,
  `idembarcacao` INT NOT NULL,
  PRIMARY KEY (`idusuario`, `idembarcacao`),
  INDEX `fk_usuario_has_embarcacao_embarcacao1_idx` (`idembarcacao` ASC),
  INDEX `fk_usuario_has_embarcacao_usuario1_idx` (`idusuario` ASC),
  CONSTRAINT `fk_usuario_has_embarcacao_usuario1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `marina`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_embarcacao_embarcacao1`
    FOREIGN KEY (`idembarcacao`)
    REFERENCES `marina`.`embarcacao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marina`.`parametros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marina`.`parametros` (
  `idparametro` INT NOT NULL AUTO_INCREMENT,
  `chave` VARCHAR(45) NOT NULL,
  `valor` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idparametro`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marina`.`recibo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marina`.`recibo` (
  `idrecibo` BIGINT NOT NULL AUTO_INCREMENT,
  `valor` DECIMAL(10,0) NULL,
  `importancia` VARCHAR(500) NULL,
  `referente` VARCHAR(500) NULL,
  `recebido` VARCHAR(45) NULL,
  PRIMARY KEY (`idrecibo`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
