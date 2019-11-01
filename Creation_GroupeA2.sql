/*CREATE DATABASE HLIN511;*/

CREATE TABLE Evenement(
Id_ev INT NOT NULL AUTO_INCREMENT,
Localisation NVARCHAR(1000),
Theme NVARCHAR(255),
Date_ev DATE,
Descriptif TEXT,
Effectif_min INT,
Effectif_max INT,
PRIMARY KEY (Id_ev)
);
