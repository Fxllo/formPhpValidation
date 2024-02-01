CREATE DATABASE if not exists formOperationPhp;
character set UTF8 collate utf8_bin;
USE formOperationPhp;

CREATE TABLE student (
    `id` INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `surname` VARCHAR(255) NOT NULL,
    `class` VARCHAR(255) NOT NULL,
    `ind` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `phoneNumber` VARCHAR(255) NOT NULL
);