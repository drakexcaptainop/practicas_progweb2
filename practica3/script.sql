CREATE DATABASE assignment3;

USE assignment3;

CREATE TABLE customer
(id int NOT NULL AUTO_INCREMENT,
 first_name varchar(50) NOT NULL,
 last_name varchar(50) NOT NULL,
 birth_date date NOT NULL,
 city varchar(50) NOT NULL,
 PRIMARY KEY(id))
ENGINE InnoDB;

INSERT INTO customer(first_name, last_name, birth_date, city) VALUES ('Juan', 'Perez', '2000-01-02', 'La Paz');
INSERT INTO customer(first_name, last_name, birth_date, city) VALUES ('Jorge', 'Lopez', '1999-07-04', 'Cochabamba');
INSERT INTO customer(first_name, last_name, birth_date, city) VALUES ('Alberto', 'Flores', '1998-06-04', 'La Paz');

