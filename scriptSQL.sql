-- Script para criação e inserção de dados
DROP SCHEMA IF EXISTS fconsulta;
CREATE SCHEMA IF NOT EXISTS fconsulta;
USE fconsulta;

-- Especialidades
DROP TABLE IF EXISTS especialidade;
CREATE TABLE especialidade ( `id` INT NOT NULL AUTO_INCREMENT , `nome` TEXT NOT NULL , `descricao` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- medicos
DROP TABLE IF EXISTS medicos;
CREATE TABLE medicos ( `id` INT NOT NULL AUTO_INCREMENT , `nome` TEXT NOT NULL , `crm` TEXT NOT NULL , `telefone` TEXT NOT NULL , 
`especialidade` INT NOT NULL , `endereco` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Clientes
DROP TABLE IF EXISTS clientes;
CREATE TABLE clientes ( `id` INT NOT NULL AUTO_INCREMENT , `nome` TEXT NOT NULL , `cpf` TEXT NOT NULL ,
 `telefone` TEXT NOT NULL , `email` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Consultas
DROP TABLE IF EXISTS consultas;
CREATE TABLE consultas ( `id` INT NOT NULL AUTO_INCREMENT , `idCliente` INT NOT NULL , `idMedico` INT NOT NULL , 
`dataConsulta` DATE NOT NULL , `horaConsulta` TIME NOT NULL ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- INSERTS ---
-- Especialidades
INSERT INTO especialidade (`id`, `nome`, `descricao`) 
VALUES (NULL, 'Cardiologista', 'Aborda as doenças relacionadas com o coração e sistema vascular.'), 
(NULL, 'Gastroenterologista', 'Responsável pelo estudo, diagnóstico, tratamento e prevenção de doenças relacionadas ao aparelho digestivo, desde erros inatos do metabolismo, doença do trato gastrointestinal, doenças do fígado e cânceres.'),
(NULL, 'Urologista', 'Estuda e trata cirurgicamente e clinicamente os problemas do sistema urinário e do sistema reprodutor masculino e feminino.'),
(NULL, 'Oftalmologista', 'Estuda e trata os distúrbios dos olhos.');

-- Medicos
INSERT INTO medicos (`id`, `nome`, `crm`, `telefone`, `especialidade`, `endereco`) 
VALUES (NULL, 'Gabriel Menezes', '2903-9', '99991-2633', '1', 'Av. Duque de Caxias, 33'), 
(NULL, 'Juan Cavalheiro', '1233-5', '3212-2344', '3', 'Rua Atenas, 35');


-- Clientes
INSERT INTO clientes (`id`, `nome`, `cpf`, `telefone`, `email`) 
VALUES (NULL, 'Ronaldo Silveira', '032123454321', '32435564', 'ronaldo@gaucho.com'), 
(NULL, 'Rodrigo da Silva e Silva', '012345678901', '991234432', 'rodrigo@silvaesilva.com');

-- Consultas
INSERT INTO consultas (`id`, `idCliente`, `idMedico`, `dataConsulta`, `horaConsulta`) 
VALUES (NULL, '1', '1', '2018-01-17', '10:30:00'), 
(NULL, '2', '1', '2018-01-31', '17:00:00');