CREATE DATABASE contatos_db;
USE contatos_db;

CREATE TABLE contatos(
  id_contato INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100),
  telefone VARCHAR(15),
  email VARCHAR(254),
  empresa VARCHAR(100),
  observacao VARCHAR(255)
);

CREATE TABLE tipo_contato (
	id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(100)
);

CREATE TABLE historico_chamada (
	id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    telefone VARCHAR(15),
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
