-- Database untuk Praktikum 9 - PHP Modular
-- Erlangga Wahyutama Fitra - 312510146
CREATE DATABASE IF NOT EXISTS db_latihan CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_latihan;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  telepon VARCHAR(20) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

DROP TABLE IF EXISTS admins;
CREATE TABLE admins (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

INSERT INTO users (nama, email, telepon) VALUES
('Rina Marlina',  'rina@example.com',  '081234567801'),
('Budi Santoso',  'budi@example.com',  '081234567802'),
('Siti Aisyah',   'siti@example.com',  '081234567803'),
('Andi Pratama',  'andi@example.com',  '081234567804'),
('Dewi Lestari',  'dewi@example.com',  '081234567805');

-- Login: admin / admin123  (hash dibuat dengan password_hash())
INSERT INTO admins (username, password_hash) VALUES
('admin', '$2y$10$mbozrNuW.DzoTirJToh8GOrC9KV.wBB0qOMplXfo43HzXfBL.tlja');
