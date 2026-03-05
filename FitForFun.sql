CREATE DATABASE FitForFun 
DEFAULT CHARACTER SET utf8mb4;

USE FitForFun;

CREATE TABLE Les (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Naam VARCHAR(50) NOT NULL,
    Prijs DECIMAL(5,2) NOT NULL,
    Datum DATE NOT NULL,
    Tijd TIME NOT NULL,
    MinAantalPersonen TINYINT NOT NULL,
    MaxAantalPersonen TINYINT NOT NULL,
    Beschikbaarheid VARCHAR(50) NOT NULL,
    Isactief BIT NOT NULL DEFAULT 1,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL,
    Datumgewijzigd DATETIME(6) NOT NULL
) ENGINE=InnoDB;