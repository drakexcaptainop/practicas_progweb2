CREATE DATABASE example2;

USE example2;

CREATE TABLE product
(
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2),
    image TEXT,
    PRIMARY KEY(id)
)
ENGINE INNODB;

CREATE TABLE client
(
    id INT AUTO_INCREMENT NOT NULL,
    nit VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    PRIMARY KEY(id)
)
ENGINE INNODB;

CREATE TABLE invoice_master
(
    id INT AUTO_INCREMENT NOT NULL,
    client_id INT NOT NULL,
    invoice_date date NOT NULL,
    PRIMARY KEY(id)
)
ENGINE INNODB;

CREATE TABLE invoice_detail
(
    id INT AUTO_INCREMENT NOT NULL,
    invoice_master_id INT NOT NULL,
    product_id INT NOT NULL,
    product_quantity INT,
    PRIMARY KEY(id),
    FOREIGN KEY (invoice_master_id) REFERENCES invoice_master(id),
    FOREIGN KEY (product_id) REFERENCES product(id)
)
ENGINE INNODB;

INSERT INTO client(nit, name, last_name) VALUES ('12345', 'Jorge', 'Lopez');
INSERT INTO client(nit, name, last_name) VALUES ('54321', 'Juan', 'Perez');
