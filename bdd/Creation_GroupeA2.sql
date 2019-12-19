/*
	FIchier : Creation_GroupeA.sql
	Auteurs : 
	Jérémy Simione 21709554
	Leif Henriksen Larez 21602894
	Nom du groupe : A
	*/

	DROP DATABASE IF EXISTS HLIN511;
	CREATE DATABASE HLIN511;
	USE HLIN511;
	/*
	Création de la base de  données
	*/
	DROP TABLE IF EXISTS DEMANDE_CONTRIBUTEUR;
	DROP TABLE IF EXISTS MOYENNE;
	DROP TABLE IF EXISTS RATING;
	DROP TABLE IF EXISTS VISITE;
	DROP TABLE IF EXISTS EVENEMENT;
	DROP TABLE IF EXISTS NIVEAU_THEME;
	DROP TABLE IF EXISTS THEME;
	DROP TABLE IF EXISTS UTILISATEUR;


	/*
	Creation des relations utilisateur - theme - niveau-theme - evenement - rating - visite - demande contributeur. 
	Logerror est utilisée par les triggers
	*/

	CREATE TABLE UTILISATEUR(
	ID INT AUTO_INCREMENT,
	NOM VARCHAR(50),
	PRENOM VARCHAR(50),
	EMAIL VARCHAR (50),
	MDP VARCHAR(50),
	TYPE_UTILISATEUR NUMERIC(1),
	ADRESSE VARCHAR(50),
	AGE INT NOT NULL,
	CONSTRAINT PK_UTILISATEURS PRIMARY KEY (ID),
	CONSTRAINT DOM_TYPE_UTILISATEUR CHECK ( TYPE_UTILISATEUR BETWEEN 0 AND 2),
	CONSTRAINT DOM_EMAIL CHECK ( EMAIL LIKE '%@%'),
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
	INDEX(DATE_EV),
	CONSTRAINT PK_EVENEMENT PRIMARY KEY (ID_EVENT,DATE_EV),
	CONSTRAINT DOM_GPS CHECK (LATITUDE >0 AND LONGITUDE >0),
	CONSTRAINT FK_EVENEMENT_ID_CREATEUR FOREIGN KEY (ID_CREATEUR) REFERENCES UTILISATEUR(ID)  ON DELETE CASCADE,
	CONSTRAINT FK_EVENEMENT_THEME       FOREIGN KEY (THEME)       REFERENCES THEME(NOM_THEME) ON DELETE CASCADE
	);

CREATE TABLE VISITE(
	ID_VISITEUR INT NOT NULL,
	ID_EV INT NOT NULL,
	CONSTRAINT FK_VISITE_VISITEUR FOREIGN KEY (ID_VISITEUR) REFERENCES UTILISATEUR(ID) ON DELETE CASCADE,
	CONSTRAINT FK_VISITE_EVENT    FOREIGN KEY (ID_EV)       REFERENCES EVENEMENT(ID_EVENT) ON DELETE CASCADE,
	CONSTRAINT PK_VISITE          PRIMARY KEY (ID_VISITEUR, ID_EV)
	);

	CREATE TABLE RATING(
	ID_EV INT,
	ID_UTILISATEUR INT,
	NOTE NUMERIC(1),
	DATE_EVENT DATE,
	CONSTRAINT FK_RATING_DAT FOREIGN KEY (DATE_EVENT) REFERENCES EVENEMENT(DATE_EV),
	CONSTRAINT FK_RATING_ID_UTILISATEUR FOREIGN KEY (ID_UTILISATEUR) REFERENCES UTILISATEUR(ID)     ON DELETE CASCADE,  
	CONSTRAINT FK_RATING_EVENT          FOREIGN KEY (ID_EV)          REFERENCES EVENEMENT(ID_EVENT) ON DELETE CASCADE,
	CONSTRAINT PK_RATING PRIMARY KEY (ID_EV, ID_UTILISATEUR)
	);

	CREATE TABLE MOYENNE(
	ID_EV INT,
	ID_UTILISATEUR INT,
	NOTE FLOAT,
	DATE_EVENT DATE,
	VALEUR_NOTE VARCHAR(20),
	CONSTRAINT PK_MOYENNE PRIMARY KEY (ID_EV,ID_UTILISATEUR),
	CONSTRAINT FK_MOYENNE_EV FOREIGN KEY (ID_EV) REFERENCES rating(ID_EV),
        CONSTRAINT FK_MOYENNE_US FOREIGN KEY (ID_UTILISATEUR) REFERENCES RATING(ID_UTILISATEUR)
	);	

	CREATE TABLE DEMANDE_CONTRIBUTEUR(
	ID_UTILISATEUR INT NOT NULL,
	LM VARCHAR(300),

	CONSTRAINT PK_DEMANDE_CONTRIBUTEUR             PRIMARY KEY (ID_UTILISATEUR),
	CONSTRAINT FK_DEMANDE_CONTRIBUTEUR_UTILISATEUR FOREIGN KEY (ID_UTILISATEUR) REFERENCES UTILISATEUR(ID)
	);




	/* 
	Insertion de tuples dans les relations
	*/

	INSERT INTO UTILISATEUR (NOM, PRENOM, EMAIL, MDP, TYPE_UTILISATEUR, ADRESSE, AGE) VALUES ('utilisateur', '', ' @', 'utilisateur', 0, '', 420);
	INSERT INTO UTILISATEUR (NOM, PRENOM, EMAIL, MDP, TYPE_UTILISATEUR, ADRESSE, AGE) VALUES ('admin', '', '@', 'admin', 1, '', 69);
	INSERT INTO UTILISATEUR (NOM, PRENOM, EMAIL, MDP, TYPE_UTILISATEUR, ADRESSE, AGE) VALUES ('contributeur', '', '@', 'contributeur', 2, '', 7);

	INSERT INTO THEME (NOM_THEME, THEME_PERE, THEME_RACINE) VALUES ('SPORTS', NULL    , NULL);
	INSERT INTO THEME (NOM_THEME, THEME_PERE, THEME_RACINE) VALUES ('SKI'   , 'SPORTS', 'SPORTS');
	INSERT INTO THEME (NOM_THEME, THEME_PERE, THEME_RACINE) VALUES ('SKI_DEBUTANT', 'SKI', 'SPORTS');
	INSERT INTO THEME (NOM_THEME, THEME_PERE, THEME_RACINE) VALUES ('SKI_TRES_DEBUTANT', 'SKI_DEBUTANT', 'SPORTS');
	INSERT INTO THEME (NOM_THEME, THEME_PERE, THEME_RACINE) VALUES ('MUSIQUE', NULL, NULL);
	INSERT INTO THEME (NOM_THEME, THEME_PERE, THEME_RACINE) VALUES ('CLASSIQUE','MUSIQUE', 'MUSIQUE');

	INSERT INTO EVENEMENT (ID_CREATEUR, NOM_EVENT, ADRESSE, LONGITUDE, LATITUDE, THEME, DATE_EV, DESCRIPTIF, EFFECTIF_MAX, EFFECTIF_MIN)VALUES (3, "Ski nautique a palavas", "Palavas-les-flots",3,43.1,"SKI","2019-10-5","Journée ski nuatique a palavas",20,60);
	INSERT INTO EVENEMENT (ID_CREATEUR, NOM_EVENT, ADRESSE, LONGITUDE, LATITUDE, THEME, DATE_EV, DESCRIPTIF, EFFECTIF_MAX, EFFECTIF_MIN)VALUES (3, "Tennis a Grammont", "Montpellier",3.5,43.2,"SPORTS","2019-10-12","Après-midi tennis a grammont",20,60);
	INSERT INTO EVENEMENT (ID_CREATEUR, NOM_EVENT, ADRESSE, LONGITUDE, LATITUDE, THEME, DATE_EV, DESCRIPTIF, EFFECTIF_MAX, EFFECTIF_MIN)VALUES (3, "Foot en salle a Montpellier", "Montpellier",3.6,43.3,"SPORTS","2019-10-20","test",20,60);
	INSERT INTO EVENEMENT (ID_CREATEUR, NOM_EVENT, ADRESSE, LONGITUDE, LATITUDE, THEME, DATE_EV, DESCRIPTIF, EFFECTIF_MAX, EFFECTIF_MIN)VALUES (3, "Nage 100m", "Nîmes",4.1,43.6,"SPORTS","2020-10-5","A la piscine municipale de Nîmes ",20,60);

	INSERT INTO VISITE VALUES (2,1);
	INSERT INTO VISITE VALUES (2,4);


	/* 
	Affichage des tuples
	*/
	SELECT * FROM EVENEMENT;
	SELECT * FROM VISITE;
	SELECT * FROM THEME;
	SELECT * FROM NIVEAU_THEME;
	SELECT * FROM DEMANDE_CONTRIBUTEUR;
	SELECT * FROM UTILISATEUR;
	SELECT * FROM RATING;

	/* 
	Définion de triggers
	*/

	/* 
	Trigger pour garantir 
	*/

	DELIMITER //
	create trigger niveau_theme AFTER INSERT on THEME
	for each row
	BEGIN
	     IF NEW.THEME_RACINE IS NOT NULL THEN
	        INSERT INTO NIVEAU_THEME VALUES (NEW.NOM_THEME, (SELECT NIVEAU FROM NIVEAU_THEME NT WHERE NT.NOM_THEME = NEW.THEME_PERE) + 1);
	     ELSE          
	        INSERT INTO NIVEAU_THEME VALUES (NEW.NOM_THEME, 0);
	     END IF;
	END //


	/*
	Trigger pour garantir qu'une note insérée concerne bien un évenement passé
	*/
	DELIMITER //
	create trigger ajout_note BEFORE INSERT ON RATING
	 FOR EACH ROW
	 BEGIN 
	 		IF NEW.DATE_EVENT > '2019-12-15' THEN
	 		 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "L'évènement n'est pas encore passé, vous ne pouvez pas le noter", MYSQL_ERRNO = 1001; 
	 		 END IF;
	 		 END //

/*
Trigger pour compléter la table moyenne automatiquement après l'ajout de tuples dans la table rating
*/

	DELIMITER //
	create trigger moyenne AFTER INSERT ON RATING
	FOR EACH ROW
	BEGIN 
	 SET @ID = (SELECT distinct id_ev from rating where id_ev=NEW.ID_EV);
	 SET @NOTE =(SELECT AVG(NOTE) FROM RATING WHERE ID_EV = NEW.ID_EV);
	
		IF NEW.ID_EV = @ID THEN
		DELETE FROM MOYENNE WHERE ID_EV=NEW.ID_EV;
		INSERT INTO moyenne VALUES (NEW.ID_EV,NEW.ID_UTILISATEUR,@NOTE,NEW.DATE_EVENT,NIVEAU_NOTE(@NOTE));
		END IF;
		END //		 


/*
Trigger pour vérifier que l'insertion d'un evenement est bien faite par un admin 
*/
DELIMITER //
CREATE TRIGGER verifRol BEFORE INSERT ON EVENEMENT
FOR EACH ROW
BEGIN
	SET @TYPE_USER = (SELECT TYPE_UTILISATEUR from utilisateur where id= NEW.ID_CREATEUR);
	IF @TYPE_USER<1 THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT ='Vous devez être un administrateur ou un contributeur pour pouvoir insérer un évènement',MYSQL_ERRNO=1001;
		END IF;
		END //

	/*
	Défintions de fonctions 
	*/
	DROP FUNCTION IF EXISTS NIVEAU_NOTE;
	DELIMITER //
	CREATE FUNCTION NIVEAU_NOTE (NOTEF NUMERIC(1))
	RETURNS VARCHAR(20)
	DETERMINISTIC
	BEGIN
	    DECLARE NIVEAU VARCHAR(20);
	    
	    IF NOTEF > 4 THEN
	        SET NIVEAU = 'EXCELLENT';
	    ELSEIF (NOTEF >= 2 AND 
	            NOTEF <= 4) THEN
	        SET NIVEAU= 'MOYENNE';
	    ELSEIF NOTEF < 2 THEN
	        SET NIVEAU = 'BASSE';
	    END IF;
	    RETURN (NIVEAU);
	END //
