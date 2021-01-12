CREATE DATABASE IF NOT EXISTS customers CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE customers;

# DROP TABLE customer;
CREATE TABLE IF NOT EXISTS customer(
  id INT UNSIGNED AUTO_INCREMENT NOT NULL,
  name VARCHAR(255) NOT NULL,
  cpf VARCHAR(11) UNIQUE DEFAULT NULL,
  birthdate DATETIME NOT NULL,
  gender CHAR(1) NOT NULL CHECK (gender IN('M', 'F')),
  cep VARCHAR(9),
  address VARCHAR(255),
  number VARCHAR(6),
  complement VARCHAR(150),
  neighborhood VARCHAR(200),
  state CHAR(2),
  city VARCHAR(200),
  PRIMARY KEY (id)
) ENGINE = InnoDB;

# SELECT * FROM customer;
