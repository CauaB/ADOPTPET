-- -----------------------------------------------------
-- Table `adoptpetv1`.`abrigo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adoptpetv1`.`abrigo` (
  `CODabrigo` VARCHAR(20) NOT NULL,
  `nome` VARCHAR(200) NOT NULL,
  `endereco` VARCHAR(200) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`CODabrigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `adoptpetv1`.`pet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adoptpetv1`.`pet` (
  `CODpet` VARCHAR(20) NOT NULL,
  `nome` VARCHAR(200) NOT NULL,
  `sexo` VARCHAR(20) NOT NULL,
  `datanasc` DATE NOT NULL,
  `raca` VARCHAR(200) NOT NULL,
  `especie` VARCHAR(200) NOT NULL,
  `statuspet` VARCHAR(200) NOT NULL,
  `CODabrig` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`CODpet`),
  INDEX `IDX_CODabrig` (`CODabrig` ASC) VISIBLE,
  CONSTRAINT `FK_CODabrig`
    FOREIGN KEY (`CODabrig`)
    REFERENCES `adoptpetv1`.`abrigo` (`CODabrigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `adoptpetv1`.`adotante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adoptpetv1`.`adotante` (
  `CPF` VARCHAR(20) NOT NULL,
  `nome` VARCHAR(200) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `sexo` VARCHAR(20) NOT NULL,
  `endereco` VARCHAR(200) NOT NULL,
  `quantpets` INT(11) NULL DEFAULT NULL,
  `datanasc` DATE NOT NULL,
  `senha` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`CPF`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `adoptpetv1`.`adocao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adoptpetv1`.`adocao` (
  `CODadocao` INT(11) NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(200) NOT NULL,
  `dataadocao` DATE NOT NULL,
  `CPFadotante` VARCHAR(20) NOT NULL,
  `CODpet` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`CODadocao`),
  INDEX `IDX_CPFadotante` (`CPFadotante` ASC) VISIBLE,
  INDEX `IDX_CODpet` (`CODpet` ASC) VISIBLE,
  CONSTRAINT `FK_CODpet`
    FOREIGN KEY (`CODpet`)
    REFERENCES `adoptpetv1`.`pet` (`CODpet`)
    ON DELETE CASCADE,
  CONSTRAINT `FK_CPFadotante`
    FOREIGN KEY (`CPFadotante`)
    REFERENCES `adoptpetv1`.`adotante` (`CPF`)
    ON DELETE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `adoptpetv1`.`cuidador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adoptpetv1`.`cuidador` (
  `CPF` VARCHAR(20) NOT NULL,
  `nome` VARCHAR(200) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `senha` VARCHAR(200) NOT NULL,
  `CODabri` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`CPF`),
  INDEX `CODabri` (`CODabri` ASC) VISIBLE,
  CONSTRAINT `CODabri`
    FOREIGN KEY (`CODabri`)
    REFERENCES `adoptpetv1`.`abrigo` (`CODabrigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `adoptpetv1`.`trabalhar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adoptpetv1`.`trabalhar` (
  `CODabrigo` VARCHAR(20) NOT NULL,
  `CPFcuidador` VARCHAR(20) NOT NULL,
  INDEX `IDX_CODabrigo` (`CODabrigo` ASC) VISIBLE,
  INDEX `IDX_CPFcuidador` (`CPFcuidador` ASC) VISIBLE,
  CONSTRAINT `FK_CODabrigo`
    FOREIGN KEY (`CODabrigo`)
    REFERENCES `adoptpetv1`.`abrigo` (`CODabrigo`),
  CONSTRAINT `FK_CPFcuidador`
    FOREIGN KEY (`CPFcuidador`)
    REFERENCES `adoptpetv1`.`cuidador` (`CPF`)
    ON DELETE CASCADE)
ENGINE = InnoDB;