# 📇 Sistema de Agenda de Contatos

Este projeto é um sistema simples de agenda de contatos, desenvolvido com PHP, MySQL, HTML e CSS, executado no ambiente XAMPP. O sistema permite cadastrar, editar, remover e listar contatos, além de visualizar o histórico de chamadas recentes.

# 🚀 Funcionalidades

✅ Cadastrar novos contatos via formulário.

📝 Editar dados de contatos existentes.

🗑️ Deletar contatos.

📋 Listar todos os contatos cadastrados.

📞 Listar chamadas recentes com nome, telefone e data/hora.

# 🛠️ Tecnologias Utilizadas

PHP – Backend da aplicação.

MySQL – Banco de dados relacional.

XAMPP – Ambiente local com Apache + MySQL.

HTML e CSS – Interface e estilo.

# 🗃️ Estrutura do Banco de Dados

Utilize o arquivo contatos_db.sql para criar as tabelas no banco de dados. Ele contém:

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

CREATE TABLE contatos (

id_contato INT PRIMARY KEY AUTO_INCREMENT,

id_tipo_contato INT,

nome VARCHAR(100),

telefone VARCHAR(15),

email VARCHAR(254),

empresa VARCHAR(100),

observacao VARCHAR(255),

FOREIGN KEY (id_tipo_contato) REFERENCES tipo_contato(id)

);

# 📦 Instalação e Execução

1 - Clone ou copie o projeto para o diretório htdocs do XAMPP:

C:\xampp\htdocs\agenda-contatos

2 - Crie o banco de dados:

Acesse http://localhost/phpmyadmin

Crie um banco de dados com o nome agenda

Importe o arquivo contatos_db.sql

3 - Configure a conexão em conn/conexao.php:

$conn = new mysqli("localhost", "root", "", "agenda");

4 - Inicie o servidor no XAMPP (Apache + MySQL).

5 - Acesse o sistema no navegador
http://localhost/agendaDecontatos-Semantic25/
