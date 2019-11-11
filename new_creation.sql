DROP DATABASE GESTION;
CREATE DATABASE GESTION;

CREATE TABLE UTILISATEURS (
ID INT,
NOM VARCHAR(50),
PRENOM VARCHAR(50),
EMAIL VARCHAR (50),
MDP VARCHAR(50),
TYPE_UTILISATEUR INT,
ADRESSE VARCHAR(50),
AGE INT NOT NULL,
CONSTRAINT PK_UTILISATEURS PRIMARY KEY (ID),
CONSTRAINT DOM_EMAIL CHECK ( EMAIL LIKE '%@%'),
CONSTRAINT DOM_TYPE_UTILISATEUR CHECK  ( TYPE_UTILISATEUR BETWEEN 0 AND 2),
CONSTRAINT DOM_AGE CHECK (AGE > 0)
); 

CREATE TABLE EVENEMENT (
IDEVENT INT,
NOMEVENT VARCHAR(50),
ADRESSE VARCHAR(50),
LONGITUDE FLOAT,
LATITUDE FLOAT,
THEME VARCHAR(20),
DATE_EV DATE,
DESCRIPTIF TEXT,
EFFECTIF_MIN_MAX INT,
CONSTRAINT PK_EVENEMENT PRIMARY KEY (ID_EV),
CONSTRAINT DOM_GPS CHECK (LATITUDE >0 AND LONGITUDE >0),
CONSTRAINT DOM_EFFECTIF CHECK (EFFECTIF_MIN_MAX BETWEEN 1 AND 50)
);
