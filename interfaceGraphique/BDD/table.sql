create TABLE Utilisateur(
	idUtil INTEGER PRIMARY KEY,
	Pseudo VARCHAR(20),
	Mail VARCHAR(60),
	Password VARCHAR(20),
	CONSTRAINT UNIQUE (Pseudo),
	CONSTRAINT UNIQUE (Mail)
);

create TABLE Profil(
	Util INTEGER,
	Statut ENUM('Actif','Inactif','Banni'),
	Ranking INTEGER,
	Theme ENUM('Theme1','Theme2','Theme3'),
	CONSTRAINT fk_ProfilUtil FOREIGN KEY (Util) REFERENCES Utilisateur(idUtil)
);

create TABLE Partie(
	idPartie INTEGER PRIMARY KEY AUTO_INCREMENT,
	Taille ENUM('9','13','19') NOT NULL,
	Handicap NUMERIC(1) NOT NULL,
	Komi ENUM('0.5','6.5','7.5'),
	Debut DATE NOT NULL,
	Fin DATE,
	Duree TIME,
	Acces ENUM('Confidentiel','Prive','Public') NOT NULL,
	JoueurN INTEGER,
	JoueurB INTEGER,
	Vainqueur INTEGER,
	CONSTRAINT fk_PartieJN FOREIGN KEY (JoueurN) REFERENCES Utilisateur(idUtil),
	CONSTRAINT fk_PartieJB FOREIGN KEY (JoueurB) REFERENCES Utilisateur(idUtil),
	CONSTRAINT fk_PartieV FOREIGN KEY (Vainqueur) REFERENCES Utilisateur(idUtil)
);

create TABLE Message(
	Partie INTEGER,
	Auteur INTEGER,
	tMess TIME,
	Contenu VARCHAR(180),
	Chat ENUM('Spectateur','Joueur'),
	CONSTRAINT fk_MessagePartie FOREIGN KEY (Partie) REFERENCES Partie(idPartie),
	CONSTRAINT fk_MessageAuteur FOREIGN KEY (Auteur) REFERENCES Utilisateur(idUtil),
	CONSTRAINT pk_Message UNIQUE (Partie,Auteur,tMess)
);

create TABLE Goban(
	Partie INTEGER,
	idGoban INTEGER PRIMARY KEY AUTO_INCREMENT,
	Tour INTEGER,
	Description INTEGER,
	CONSTRAINT fk_GobanPartie FOREIGN KEY (Partie) REFERENCES Partie(idPartie)
);

create TABLE Coup(
	Goban INTEGER,
	temps TIME,
	CoordX NUMERIC(2),
	CoordY NUMERIC(2),
	Couleur ENUM('Noir','Blanc'),
	CONSTRAINT UNIQUE(idGoban,temps),
	CONSTRAINT fk_CoupGoban FOREIGN KEY (Goban) REFERENCES Goban(idGoban)
);

create TABLE Validation(
		Util INTEGER PRIMARY KEY,
		Key VARCHAR(30),
		Etat ENUM('OK','En Attente'),
		CONSTRAINT UNIQUE (Key)
);
