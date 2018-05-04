<?php
//variables du formulaire qu'on récupère avec post
  $confidentialite = $_POST['bouton_Confidentialite'];
  $taille = $_POST['taille-Goban'];

  //connexion à la bdd
    $dsn = 'ag044096';
    $user = 'ag044096';
    $password = 'ag044096';
    $host='172.31.21.41';

  try {
    $dbh = new PDO("mysql:host=$host;dbname=$dsn","$user", "$password");
    
    //TODO:insérer le joueur connecté
    $insertion = "INSERT INTO partie (Taille, Handicap, Komi, Debut, Fin, Duree, Acces, JoueurN, JoueurB, Vainqueur)
    VALUES (?,0,'6.5',NOW(),NULL,'01:00:00',?,1,NULL,NULL)";

    //ajoute la taille et la confidentialite a la requete
    $prepara = $dbh->prepare($insertion);
    $prepara->execute(array($taille,$confidentialite));

    echo "Reussite";
  } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
  }
?>
