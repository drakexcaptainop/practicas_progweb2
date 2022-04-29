CREATE DATABASE practical_assignment6;

USE practical_assignment6;

CREATE TABLE student
(
   id int NOT NULL AUTO_INCREMENT,
   first_name varchar(50) NOT NULL,
   last_name varchar(50) NOT NULL,
   city varchar(50) NOT NULL,
   semester int NOT NULL,
   PRIMARY KEY(id)
)
ENGINE InnoDB;

INSERT INTO student (first_name, last_name, city, semester) VALUES ('Juan', 'Perez', 'La Paz', 3);
INSERT INTO student (first_name, last_name, city, semester) VALUES ('Jorge', 'Lopez', 'Cochabamba', 5);

CREATE TABLE professor
(id int NOT NULL AUTO_INCREMENT,
 first_name varchar(50) NOT NULL,
 last_name varchar(50) NOT NULL,
 city varchar(50) NOT NULL,
 salary decimal(10,2) NOT NULL,
 PRIMARY KEY(id)
)
ENGINE InnoDB;

INSERT INTO professor (first_name, last_name, city, salary) VALUES ('John', 'Doe', 'La Paz', 10.5);
