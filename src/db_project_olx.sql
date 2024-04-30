
CREATE DATABASE project_olx;

USE project_olx;

CREATE TABLE category (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255)
);

CREATE TABLE users (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255),
    `email` VARCHAR(255),
    `password` VARCHAR(255),
    `phone` VARCHAR(255),
    `role` VARCHAR(255)
);
CREATE TABLE posts (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255),
    `description` VARCHAR(255),
    `price` VARCHAR(255),
    `category` VARCHAR(255),
    `image` Longblob(255),
    `users_id` INT,
    `situation` VARCHAR(255),
    FOREIGN KEY (users_id) REFERENCES users(id)
);


