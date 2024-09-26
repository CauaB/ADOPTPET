# ADOPT PET - Sistema para Adoção de Pets

## 📄 Sobre:
O sistema é uma aplicação web voltada para a gestão e facilitação do processo de adoção de pets, conectando adotantes a abrigos e cuidadores. Ele permite o gerenciamento completo de informações relacionadas à pets disponíveis para adoção, incluindo cadastro de espécies, raças, idades, status de adoção, e dados de abrigos onde os animais estão localizados. Além disso, o sistema armazena informações de adotantes, cuidadores e abrigos, facilitando o processo de busca por um novo lar para os animais. A principal finalidade do sistema é oferecer uma plataforma intuitiva onde os adotantes podem pesquisar por pets, realizar a adoção online e visualizar detalhes como a espécie, raça e histórico do pet. Já os cuidadores têm a função de gerenciar os pets vinculados ao abrigo, controlando o cadastro e o status de cada animal. O sistema também gera relatórios e dashboards visuais com gráficos que mostram a quantidade de pets por espécie, raça, e estatísticas sobre adotantes por endereço, oferecendo uma boa visão das adoções realizadas. Dessa forma, a aplicação contribui significativamente para a otimização do processo de adoção de animais em uma comunidade.

## Apresentação do Projeto:
[![YouTube](https://img.shields.io/badge/-YouTube-FF0000?style=for-the-badge&logo=youtube&logoColor=white)](https://www.youtube.com/watch?v=bI6gdqveSB0&t=23s)

## 📄 Modelo ER:
<img src="Documentação/Modelo%20ER%20-%20ADOPTPET.png" alt="Modelo ER" width="1000" />

## 📄 Modelo Lógico:
<img src="Documentação/Modelo%20Logico%20-%20ADOPTPET.png" alt="Modelo ER" width="1000" />

## 🔨 Ferramentas:
[![PHP](https://img.shields.io/badge/-PHP-6959CD?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)

[![MySQL](https://img.shields.io/badge/-MySQL-001F3F?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)

[![Xampp](https://img.shields.io/badge/-Xampp-FF4500?style=for-the-badge&logo=xampp&logoColor=white)](https://www.apachefriends.org/index.html)

[![Bootstrap](https://img.shields.io/badge/-Bootstrap-8A2BE2?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)

[![JavaScript](https://img.shields.io/badge/-JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)

## 📄 Script DB:
``` sql
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
```
