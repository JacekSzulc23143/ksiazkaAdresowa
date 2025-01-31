-- usunięcie bazy
DROP DATABASE IF EXISTS contacts_db;
-- Utworzenie bazy danych 
CREATE DATABASE IF NOT EXISTS contacts_db DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_polish_ci;; 
-- Użycie bazy danych 
USE contacts_db; 
-- Utworzenie tabeli contacts 
CREATE TABLE contacts ( 
    id INT AUTO_INCREMENT PRIMARY KEY, -- Klucz główny z autoinkrementacją 
    name VARCHAR(100) NOT NULL, -- Imię i nazwisko (pole wymagane) 
    phone VARCHAR(15) NOT NULL, -- Numer telefonu (pole wymagane) 
    email VARCHAR(100), -- Adres e-mail (pole opcjonalne) 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Data utworzenia 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Data ostatniej aktualizacji 
);

-- Wprowadzenie danych testowych
INSERT INTO contacts (name, phone, email) VALUES
('Jan Kowalski', '123456789', 'jan.kowalski@domena.com'),
('Anna Nowak', '987654321', 'anna.nowak@domena.com'),
('Piotr Zieliński', '555666777', NULL);