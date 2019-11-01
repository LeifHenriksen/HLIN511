CREATE DATABASE HLIN511;
DROP IF EXISTS VISITEUR;
DROP IF EXISTS Evenement;

CREATE TABLE VISITEUR (
IDVIS INT NOT NULL AUTO INCREMENT,
NUM_INSCRIPTION INT,
NOMVIS VARCHAR(50) NOT NULL,
LOC_EV NVARCHAR(50),
THEME_EV NVARCHAR(50),
DATE_EV DATE,
DESC_EV TEXT,
NOTE INT,
CONSTRAINT PK_VISITEUR PRIMARY KEY (IDVIS,NUM_INSCRIPTION),
CONSTRAINT FK_VIS_LOC FOREIGN KEY (LOC_EV) REFERENCES Evenement(Localisation),
CONSTRAINT FK_VIS_THEME FOREIGN KEY (THEME_EV) REFERENCES Evenement(Theme),
CONSTRAINT FK_VIS_DATE FOREIGN KEY (DATE_EV) REFERENCES Evenement(Date_ev),
CONSTRAINT FK_VIS_DESC FOREIGN KEY (DESC_EV) REFERENCES Evenement(Description)
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

