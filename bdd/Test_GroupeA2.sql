/* Test des triggers */
/* Insertion d'un évènement  en n'étant pas adminstrateur ou contributeur*/
INSERT INTO EVENEMENT (ID_CREATEUR, NOM_EVENT, ADRESSE, LONGITUDE,LATITUDE, THEME, DATE_EV,NOTE, DESCRIPTIF, EFFECTIF_MAX, EFFECTIF_MIN)
                       VALUES(1, "Nage 100m", "Nîmes",4.1,43.6,"SPORTS","2020-10-5",null,"A la piscine municipale de Nîmes ",20,60);
/* Insertion d'un évènement  en étant adminstrateur*/
INSERT INTO EVENEMENT (ID_CREATEUR, NOM_EVENT, ADRESSE, LONGITUDE,LATITUDE, THEME, DATE_EV,NOTE, DESCRIPTIF, EFFECTIF_MAX, EFFECTIF_MIN)
                       VALUES(2, "Nage 100m", "Nîmes",4.1,43.6,"SPORTS","2020-10-5",null,"A la piscine municipale de Nîmes ",20,60);
/* Insertion d'un évènement  en étant contributeur*/
INSERT INTO EVENEMENT (ID_CREATEUR, NOM_EVENT, ADRESSE, LONGITUDE,LATITUDE, THEME, DATE_EV,NOTE, DESCRIPTIF, EFFECTIF_MAX, EFFECTIF_MIN)
                       VALUES(3, "Nage 100m", "Nîmes",4.1,43.6,"SPORTS","2020-10-5",null,"A la piscine municipale de Nîmes ",20,60);
 /*Insertion d'une note d'un evenement dont la date n'est pas encore passée */
INSERT INTO RATING VALUES (4,2,5,'2020-10-5');
  /*Insertion d'une note d'un evenement dont la date est passée */
  INSERT INTO RATING VALUES (1,1,5,'2019-10-5');
 /*Vérifiaction du trigger qui calcule la moyenne des notes pour cahque evenement*/
 INSERT INTO RATING VALUES (1,1,5,'2019-10-5');
 INSERT INTO RATING VALUES (1,2,4,'2019-10-5');
 SELECT * FROM MOYENNE;

/* Requêtes */

/* Affichage des tuples */
	SELECT * FROM EVENEMENT;
	SELECT * FROM VISITE;
	SELECT * FROM THEME;
	SELECT * FROM NIVEAU_THEME;
	SELECT * FROM DEMANDE_CONTRIBUTEUR;
	SELECT * FROM UTILISATEUR;
	SELECT * FROM RATING;

/*trouver tous les fils d'un theme*/
SELECT NT.NOM_THEME AS FILS
FROM THEME T, NIVEAU_THEME NT
WHERE T.NOM_THEME = NT.NOM_THEME
AND T.THEME_RACINE LIKE 'ancetre_commun'
AND NIVEAU > (SELECT NIVEAU FROM NIVEAU_THEME WHERE NOM_THEME LIKE 'pere');


/*Test fonction */
SELECT ID_EV, ID_UTILISATEUR,NOTE,NIVEAU_NOTE(NOTE)
FROM RATING
ORDER BY ID_EV;
