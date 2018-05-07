SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `Utilisateur`;
CREATE TABLE Utilisateur(
	ID INTEGER PRIMARY KEY AUTO_INCREMENT,
	Pseudo VARCHAR(20),
	Mail VARCHAR(60),
	Password VARCHAR(100),
	CONSTRAINT UNIQUE (Pseudo),
	CONSTRAINT UNIQUE (Mail)
);

DROP TABLE IF EXISTS `Profil`;
CREATE TABLE Profil(
	Utilisateur INTEGER PRIMARY KEY,
	Statut ENUM('Actif','Inactif','Banni'),
	DateCreation DATE NOT NULL,
	DateCloturation DATE,
	Ranking INTEGER,
	Theme ENUM('Theme1','Theme2','Theme3'),
	CONSTRAINT fk_ProfilUtil FOREIGN KEY (Utilisateur) REFERENCES Utilisateur(ID)
);

DROP TABLE IF EXISTS `Validation`;
CREATE TABLE Validation(
	Utilisateur INTEGER PRIMARY KEY,
	Cle VARCHAR(30),
	Etat ENUM ('OK','En Attente'),
	CONSTRAINT UNIQUE (Cle),
	CONSTRAINT fk_Util FOREIGN KEY (Utilisateur) REFERENCES Utilisateur(ID)
);

DROP TABLE IF EXISTS `Partie`;
CREATE TABLE Partie(
	ID INTEGER PRIMARY KEY AUTO_INCREMENT,
	Taille ENUM('9','13','19') NOT NULL,
	Handicap NUMERIC(1) NOT NULL,
	Komi ENUM('0.5','6.5','7.5'),
	Debut DATETIME NOT NULL,
	Fin DATETIME,
	Duree TIME,
	Acces ENUM('Confidentiel','Prive','Public') NOT NULL,
	JoueurNoir INTEGER,
	JoueurBlanc INTEGER,
	Vainqueur INTEGER,
	CONSTRAINT fk_PartieJN FOREIGN KEY (JoueurNoir) REFERENCES Utilisateur(ID),
	CONSTRAINT fk_PartieJB FOREIGN KEY (JoueurBlanc) REFERENCES Utilisateur(ID),
	CONSTRAINT fk_PartieV FOREIGN KEY (Vainqueur) REFERENCES Utilisateur(ID)
);

DROP TABLE IF EXISTS `goban`;
CREATE TABLE Goban(
	ID INTEGER PRIMARY KEY AUTO_INCREMENT,
	Partie INTEGER,
	Tour INTEGER,
	Description TEXT,
	CONSTRAINT fk_GobanPartie FOREIGN KEY (Partie) REFERENCES Partie(ID)
);

DROP TABLE IF EXISTS `Coup`;
CREATE TABLE Coup(
	Goban INTEGER PRIMARY KEY,
	Horodatage TIME,
	X NUMERIC(2),
	Y NUMERIC(2),
	Couleur ENUM('Noir','Blanc'),
	CONSTRAINT fk_CoupGoban FOREIGN KEY (Goban) REFERENCES Goban(ID)
);

DROP TABLE IF EXISTS `Message`;
CREATE TABLE Message(
	ID INTEGER PRIMARY KEY AUTO_INCREMENT,
	Partie INTEGER,
	Auteur INTEGER,
	Horodatage TIME,
	Contenu VARCHAR(180),
	Chat ENUM('Spectateur','Joueur'),
	CONSTRAINT fk_MessagePartie FOREIGN KEY (Partie) REFERENCES Partie(ID),
	CONSTRAINT fk_MessageAuteur FOREIGN KEY (Auteur) REFERENCES Utilisateur(ID)
);

-- A ne surtout pas retirer sans retirer le SET ..=0; au début du script
SET FOREIGN_KEY_CHECKS=1;

-- TRIGGERS

DROP TRIGGER IF EXISTS bi_Message;

DELIMITER //
CREATE TRIGGER bi_Message
BEFORE INSERT ON Message FOR EACH ROW
BEGIN
	DECLARE tempsMessage TIME;
	SET @tempsMessage := TIMEDIFF(NOW(), (SELECT Debut FROM Partie WHERE ID = NEW.Partie));
	SET NEW.Horodatage = @tempsMessage;
END //

DELIMITER ;

DROP TRIGGER IF EXISTS bi_Coup;

DELIMITER //
CREATE TRIGGER bi_Coup
BEFORE INSERT ON Coup FOR EACH ROW
BEGIN
	DECLARE tempsCoup TIME;
	SET @tempsCoup := TIMEDIFF(NOW(), (
		SELECT Partie.Debut
		FROM Goban
			JOIN Partie ON Goban.Partie = Partie.ID
		WHERE Goban.ID = NEW.Goban));
	SET NEW.Horodatage = @tempsCoup;
END //
-- Il est fort probable que l'update de Goban (Tour++) ne soit pas à faire.
-- Il me semble que Goban est une description (immutable) du goban à un tour.

DELIMITER ;

DROP TRIGGER IF EXISTS ai_Utilisateur;

DELIMITER //
CREATE TRIGGER ai_Utilisateur
AFTER INSERT ON Utilisateur FOR EACH ROW
BEGIN
	INSERT INTO Profil VALUES (NEW.ID,'Inactif',NOW(),NULL,0,'Theme1');
END //

DELIMITER ;
