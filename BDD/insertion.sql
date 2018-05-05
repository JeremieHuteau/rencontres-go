-- Utilisateur

INSERT INTO Utilisateur VALUES(
    0, 'Arche', 'arche@archimail.com', 'mdp1'
);
INSERT INTO Utilisateur VALUES(
    0, 'HappeauLean', 'lapinmalin@archimail.com', 'mdp2'
);
INSERT INTO Utilisateur VALUES(
    0, 'Honinbo Shusaku', 'sai@archimail.com', 'mdp3'
);
INSERT INTO Utilisateur VALUES(
    0, 'Gorille Kasparof', 'gk@archimail.com', 'mdp4'
);

-- Partie

INSERT INTO Partie VALUES(
    0, '13', 0, '7.5', NOW() - INTERVAL 4 HOUR, NOW() - INTERVAL 90 MINUTE, NOW() - (NOW() - INTERVAL 152 MINUTE), 'Public', 1, 3, 3
);
INSERT INTO Partie VALUES(
    0, '19', 0, '6.5', NOW() - INTERVAL 1 HOUR, NULL, NULL, 'Public', 1, NULL, NULL
);
INSERT INTO Partie VALUES(
    0, '19', 0, '7.5', NOW() - INTERVAL 30 MINUTE, NULL, NULL, 'Public', 2, 3, NULL
);
INSERT INTO Partie VALUES(
    0, '9', 0, '0.5', NOW() - INTERVAL 26 MINUTE, NULL, NULL, 'Prive', 4, NULL, NULL
);


-- Message

INSERT INTO Message VALUES(
    0, 2, 2, 0, 'coucou, tu veux voir ma frite ?', 'Joueur'
);
INSERT INTO Message VALUES(
    0, 2, 3, 0, 'avec plaisir !', 'Joueur'
);
