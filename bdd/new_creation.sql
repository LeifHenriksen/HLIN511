DROP TABLE IF EXISTS DEMANDE_CONTRIBUTEUR;
DROP TABLE IF EXISTS VISITE;
DROP TABLE IF EXISTS EVENEMENT;
DROP TABLE IF EXISTS NIVEAU_THEME;
DROP TABLE IF EXISTS THEME;
DROP TABLE IF EXISTS UTILISATEUR;


CREATE TABLE UTILISATEUR(
ID INT AUTO_INCREMENT,
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

CREATE TABLE THEME(
NOM_THEME  VARCHAR(20),
THEME_PERE VARCHAR(20),  
THEME_RACINE VARCHAR(20),

CONSTRAINT PK_THEME            PRIMARY KEY (NOM_THEME),
CONSTRAINT FK_THEME_THEME_RACINE FOREIGN KEY (THEME_RACINE) REFERENCES THEME(NOM_THEME) ON DELETE CASCADE,
CONSTRAINT FK_THEME_THEME_PERE FOREIGN KEY (THEME_PERE) REFERENCES THEME(NOM_THEME) ON DELETE CASCADE  
);

CREATE TABLE NIVEAU_THEME(
NOM_THEME VARCHAR(20),
NIVEAU INT NOT NULL,
CONSTRAINT NIVEAU_POSITIVE CHECK (NIVEAU>=0),
CONSTRAINT PK_THEME        PRIMARY KEY (NOM_THEME),
CONSTRAINT FK_NIVEAU_THEME FOREIGN KEY (NOM_THEME) REFERENCES THEME(NOM_THEME) ON DELETE CASCADE
);

CREATE TABLE EVENEMENT (
ID_EVENT INT AUTO_INCREMENT,
ID_CREATEUR INT NOT NULL,
NOM_EVENT VARCHAR(50),
ADRESSE VARCHAR(50),
LONGITUDE FLOAT,
LATITUDE FLOAT,
THEME VARCHAR(20),
DATE_EV DATE,
DESCRIPTIF TEXT,
EFFECTIF_MAX INT,
EFFECTIF_MIN INT,
CONSTRAINT PK_EVENEMENT PRIMARY KEY (ID_EVENT),
CONSTRAINT DOM_GPS CHECK (LATITUDE >0 AND LONGITUDE >0),
CONSTRAINT FK_EVENEMENT_ID_CREATEUR FOREIGN KEY (ID_CREATEUR) REFERENCES UTILISATEUR(ID)  ON DELETE CASCADE,
CONSTRAINT FK_EVENEMENT_THEME       FOREIGN KEY (THEME)       REFERENCES THEME(NOM_THEME) ON DELETE CASCADE
);

CREATE TABLE VISITE(
ID_VISITEUR INT NOT NULL,
ID_EV INT NOT NULL,

CONSTRAINT FK_VISITE_VISITEUR FOREIGN KEY (ID_VISITEUR) REFERENCES UTILISATEUR(ID),
CONSTRAINT FK_VISITE_EVENT    FOREIGN KEY (ID_EV)       REFERENCES EVENEMENT(ID_EVENT),
CONSTRAINT PK_VISITE          PRIMARY KEY (ID_VISITEUR, ID_EV)
);

CREATE TABLE DEMANDE_CONTRIBUTEUR(
ID_UTILISATEUR INT NOT NULL,
LM VARCHAR(300),

CONSTRAINT PK_DEMANDE_CONTRIBUTEUR             PRIMARY KEY (ID_UTILISATEUR),
CONSTRAINT FK_DEMANDE_CONTRIBUTEUR_UTILISATEUR FOREIGN KEY (ID_UTILISATEUR) REFERENCES UTILISATEUR(ID)
);

INSERT INTO UTILISATEUR (NOM, PRENOM, EMAIL, MDP, TYPE_UTILISATEUR, ADRESSE, AGE) VALUES ('utilisateur', '', ' @', 'utilisateur', 0, '', 420);
INSERT INTO UTILISATEUR (NOM, PRENOM, EMAIL, MDP, TYPE_UTILISATEUR, ADRESSE, AGE) VALUES ('admin', '', '@', 'admin', 1, '', 69);
INSERT INTO UTILISATEUR (NOM, PRENOM, EMAIL, MDP, TYPE_UTILISATEUR, ADRESSE, AGE) VALUES ('contributeur', '', '@', 'contributeur', 2, '', 7);

DELIMITER //
create trigger `niveau_theme` AFTER INSERT on `THEME`
for each row
BEGIN
     IF NEW.THEME_RACINE IS NOT NULL THEN
        INSERT INTO NIVEAU_THEME VALUES (NEW.NOM_THEME, (SELECT NIVEAU FROM NIVEAU_THEME NT WHERE NT.NOM_THEME = NEW.THEME_PERE) + 1);
     ELSE          
        INSERT INTO NIVEAU_THEME VALUES (NEW.NOM_THEME, 0);
     END IF;
END;
//
DELIMITER ;

INSERT INTO THEME (NOM_THEME, THEME_PERE, THEME_RACINE) VALUES ('SPORTS', NULL    , NULL);
INSERT INTO THEME (NOM_THEME, THEME_PERE, THEME_RACINE) VALUES ('SKI'   , 'SPORTS', 'SPORTS');
INSERT INTO THEME (NOM_THEME, THEME_PERE, THEME_RACINE) VALUES ('SKI_DEBUTANT', 'SKI', 'SPORTS');
INSERT INTO THEME (NOM_THEME, THEME_PERE, THEME_RACINE) VALUES ('SKI_TRES_DEBUTANT', 'SKI_DEBUTANT', 'SPORTS');
INSERT INTO THEME (NOM_THEME, THEME_PERE, THEME_RACINE) VALUES ('MUSIQUE', NULL, NULL);
INSERT INTO THEME (NOM_THEME, THEME_PERE, THEME_RACINE) VALUES ('CLASSIQUE','MUSIQUE', 'MUSIQUE');

INSERT INTO EVENEMENT (ID_CREATEUR, NOM_EVENT, ADRESSE, LONGITUDE, LATITUDE, THEME, DATE_EV, DESCRIPTIF, EFFECTIF_MAX, EFFECTIF_MIN)VALUES (3, "Test", "abc",52,45,"SPORTS","2019-10-5","test",20,60);
INSERT INTO EVENEMENT (ID_CREATEUR, NOM_EVENT, ADRESSE, LONGITUDE, LATITUDE, THEME, DATE_EV, DESCRIPTIF, EFFECTIF_MAX, EFFECTIF_MIN)VALUES (3, "Test", "abc",52,45,"SPORTS","2019-10-5","test",20,60);
INSERT INTO EVENEMENT (ID_CREATEUR, NOM_EVENT, ADRESSE, LONGITUDE, LATITUDE, THEME, DATE_EV, DESCRIPTIF, EFFECTIF_MAX, EFFECTIF_MIN)VALUES (3, "Test", "abc",52,45,"SPORTS","2019-10-5","test",20,60);
INSERT INTO EVENEMENT (ID_CREATEUR, NOM_EVENT, ADRESSE, LONGITUDE, LATITUDE, THEME, DATE_EV, DESCRIPTIF, EFFECTIF_MAX, EFFECTIF_MIN)VALUES (3, "Test", "abc",52,45,"SPORTS","2019-10-5","test",20,60);


