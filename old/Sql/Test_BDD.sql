/* Jeu de test pour vérifier le fonctionnement de la BDD et illustrer le fonctionnement des différents trigger/procédure*/

DELETE FROM A_LIEU;
DELETE FROM CONCERNE;
DELETE FROM INSCRIT;
DELETE FROM CREER_SUPPRIMER_CONTRIB;
DELETE FROM EVENEMENT;
DELETE FROM LIEU;
DELETE FROM THEME;
DELETE FROM CONTRIBUTEUR;
DELETE FROM ADMINISTRATEUR;
DELETE FROM VISITEUR;

INSERT INTO ADMINISTRATEUR VALUES('1','Cardano','Vincent','vincent.cardano@gmail.com','cardano34');

INSERT INTO VISITEUR VALUES('1','michel.dumas@laposte.net','Dumas','Michel','68','Michou','cuisinella');
INSERT INTO CONTRIBUTEUR VALUES('1','1','michel.dumas@laposte.net','Dumas','Michel','68','Michou','cuisinella');
INSERT INTO CREER_SUPPRIMER_CONTRIB VALUES('1','1',now());
INSERT INTO CONTRIBUTEUR VALUES('2','1','roger.delcours@wanadoo.fr','Delcours','Roger','43','Roro','delro21');
INSERT INTO CREER_SUPPRIMER_CONTRIB VALUES('2','1',now());


INSERT INTO LIEU VALUES('1','France','Montpellier','Gambetta','5',34000,234,-213);
INSERT INTO LIEU VALUES('2','France','Paris','Place Montmartre','21',78000,454,228);
INSERT INTO LIEU VALUES('3','France','Grenoble',' Rue Millet','11',38000,800,134);
INSERT INTO LIEU VALUES('4','France','Toulouse','Rue Clément','19',31000,234,900);

INSERT INTO THEME VALUES('1','Shooting photo','Photo','1',now());
INSERT INTO THEME VALUES('2','Exposition peinture','Art','1',now());
INSERT INTO THEME VALUES('3','Maraude','Associatif','1',now());


/* Ces 2 lignes déclenchent les triggers de suivi dans les tables A_LIEU et CONCERNE */

INSERT INTO EVENEMENT VALUES('1','2019-12-21',400,900,'1','1','2',now());
INSERT INTO EVENEMENT VALUES('2','2019-12-28',2,40,'1','1','3',now());
INSERT INTO EVENEMENT VALUES('3','2019-12-24',0,20,'1','3','4',now());

INSERT INTO INSCRIT VALUES('1','1',now());

/* Exemple d'utilisation de la procédure NOMBRE_UTILISATION_THEME */
SET @nb=0;
CALL NOMBRE_UTILISATION_THEME(@nb,'1');
SELECT @nb as NombreTotal;





