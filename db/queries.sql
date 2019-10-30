CREATE DATABASE forum_mvc;

USE forum_mvc;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(320) NOT NULL,
    password VARCHAR(50) NOT NULL,
    hash VARCHAR(255),
    is_active INT NOT NULL DEFAULT 0,
    is_admin INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at DATE
)  ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    post_title VARCHAR(255) NOT NULL,
    post_text TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at DATE
)  ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT,
    user_id INT,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)  ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    is_like BOOL NOT NULL DEFAULT 0,
    post_id INT,
    user_id INT
)  ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
)  ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS sub_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    parent INT NOT NULL
)  ENGINE=INNODB;

INSERT INTO categories (name) VALUES ('Music');
INSERT INTO categories (name) VALUES ('Movies');
INSERT INTO categories (name) VALUES ('Books');
INSERT INTO categories (name) VALUES ('Sport');

INSERT INTO sub_categories (name, parent) VALUES ('Rock', 1);
INSERT INTO sub_categories (name, parent) VALUES ('Hip-hop', 1);
INSERT INTO sub_categories (name, parent) VALUES ('Indie', 1);
INSERT INTO sub_categories (name, parent) VALUES ('Classic', 1);

INSERT INTO sub_categories (name, parent) VALUES ('Action', 2);
INSERT INTO sub_categories (name, parent) VALUES ('Fantasy', 2);
INSERT INTO sub_categories (name, parent) VALUES ('Drama', 2);
INSERT INTO sub_categories (name, parent) VALUES ('Horror', 2);

INSERT INTO sub_categories (name, parent) VALUES ('Fantasy', 3);
INSERT INTO sub_categories (name, parent) VALUES ('Drama', 3);
INSERT INTO sub_categories (name, parent) VALUES ('Crime and Detective', 3);
INSERT INTO sub_categories (name, parent) VALUES ('Romance', 3);

INSERT INTO sub_categories (name, parent) VALUES ('Football', 4);
INSERT INTO sub_categories (name, parent) VALUES ('Basketball', 4);
INSERT INTO sub_categories (name, parent) VALUES ('Volleyball', 4);
INSERT INTO sub_categories (name, parent) VALUES ('Baseball', 4);