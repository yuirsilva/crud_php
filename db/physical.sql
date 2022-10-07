CREATE DATABASE IF NOT EXISTS `fand` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fand`;

CREATE TABLE users (
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
email varchar(255) NOT NULL,
cpf varchar(255),
pass varchar(255) NOT NULL,
namef varchar(255) NOT NULL,
typef INT
);

CREATE TABLE curriculum (
id_curr INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
namef varchar(255) NOT NULL,
email varchar(255) NOT NULL,
phonenumber varchar(14) NOT NULL,
course varchar(255) NOT NULL,
id_user INT NOT NULL,
FOREIGN KEY (id_user) REFERENCES users (id)
);

CREATE TABLE competences (
id_com INT PRIMARY KEY AUTO_INCREMENT,
competence varchar(255),
id_curr INT,
FOREIGN KEY(id_curr) REFERENCES curriculum (id_curr)
);

CREATE TABLE abilities (
id_abi INT PRIMARY KEY AUTO_INCREMENT,
ability varchar(255),
id_curr INT,
FOREIGN KEY(id_curr) REFERENCES curriculum (id_curr)
);

CREATE TABLE education (
id_edu INT PRIMARY KEY AUTO_INCREMENT,
institution varchar(255),
course varchar(255),
startf date,
endf date,
id_curr INT,
FOREIGN KEY(id_curr) REFERENCES curriculum (id_curr)
);

CREATE TABLE experience (
id_exp INT PRIMARY KEY AUTO_INCREMENT,
occupation varchar(255),
company varchar(255),
startf date,
endf date,
id_curr INT,
FOREIGN KEY(id_curr) REFERENCES curriculum (id_curr)
);