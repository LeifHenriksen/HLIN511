DROP DATABASE IF EXISTS HLIN511;
CREATE DATABASE HLIN511;
DROP TABLE IF EXISTS VISITEUR;
DROP TABLE IF EXISTS Evenement;

CREATE TABLE VISITEUR (
IDVIS INT NOT NULL AUTO_INCREMENT,
NUM_INSCRIPTION INT,
NOMVIS VARCHAR(50),
LOC_EV VARCHAR(50),
THEME_EV VARCHAR(50),
DATE_EV DATE,
DESC_EV TEXT,
NOTE INT,
CONSTRAINT PK_VISITEUR PRIMARY KEY (IDVIS,NUM_INSCRIPTION),
);
CREATE TABLE Evenement(
Id_ev INT NOT NULL AUTO_INCREMENT,
Localisation NVARCHAR(1000),
Theme NVARCHAR(255),
Date_ev DATE,
Description TEXT,
Effectif_min INT,
Effectif_max INT,
Rating INT,
PRIMARY KEY (Id_ev)
);

INSERT INTO Evenement (Localisation,Theme,Date_ev,Description,Effectif_min,Effectif_max,Rating)
  VALUES ('Montpellier','Historique','2019-10-20','Une fete historique',10,100,NULL);

INSERT INTO Evenement (Localisation,Theme,Date_ev,Description,Effectif_min,Effectif_max,Rating)
  VALUES ('Nimes','Historique','2019-2-12','Une fete historique',10,100,NULL);

INSERT INTO Evenement (Localisation,Theme,Date_ev,Description,Effectif_min,Effectif_max,Rating)
  VALUES ('Lunel','Historique','2019-9-9','Une fete historique',10,100,NULL);

INSERT INTO Evenement (Localisation,Theme,Date_ev,Description,Effectif_min,Effectif_max,Rating)
  VALUES ('Lattes','Historique','2019-12-20','Une fete historique',10,100,NULL);

INSERT INTO Evenement (Localisation,Theme,Date_ev,Description,Effectif_min,Effectif_max,Rating)
  VALUES ('Perol','Historique','2019-1-20','Une fete historique',10,100,NULL);

