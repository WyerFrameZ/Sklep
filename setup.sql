-- Utworzenie bazy danych
CREATE DATABASE IF NOT EXISTS sklep;
USE sklep;

-- Utworzenie tabeli użytkowników
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(255) NOT NULL UNIQUE,
    haslo VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Utworzenie tabeli produktów
CREATE TABLE IF NOT EXISTS produkty (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nazwa VARCHAR(255) NOT NULL,
    cena DECIMAL(10,2) NOT NULL,
    opis TEXT,
    zdjecie VARCHAR(255),
    kategoria VARCHAR(50),
    data_dodania TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Przykładowe dane (opcjonalnie)
INSERT INTO users (login, haslo) VALUES 
('test', '$2y$10$H.Qy9i6YdFgNcD.7oVMdh.U3pqMHn.Z3HdgQ0Wy0YEQYhfU/WfDky'); -- hasło: test123

-- Przykładowe produkty
INSERT INTO produkty (nazwa, cena, opis, zdjecie, kategoria) VALUES
('Smartfon XYZ', 1999.99, 'Najnowszy model smartfona z 6GB RAM i 128GB pamięci', 'https://via.placeholder.com/300x200', 'Elektronika'),
('Buty sportowe', 299.99, 'Wygodne buty do biegania', 'https://via.placeholder.com/300x200', 'Sport i Hobby'),
('Sofa narożna', 2499.99, 'Elegancka sofa do salonu', 'https://via.placeholder.com/300x200', 'Dom i Ogród'); 