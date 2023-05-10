CREATE DATABASE vestibular_fatec;

USE vestibular_fatec;

CREATE TABLE usuario (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  cpf VARCHAR(14),
  telefone VARCHAR(15),
  escola_publica BOOLEAN
);
