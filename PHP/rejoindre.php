<?php

  //connexion à la bdd
  $dsn = 'projetweb';
  $user = 'root';
  $password = 'root';
  $host='127.0.0.1';

  //variables du formulaire qu'on récupère avec post
  //elles n'existent pas si on ouvre le fichier avec recherche.php
  if(isset($_POST['search_Hote']) && isset($_POST['search_ID'])){
    $hote = $_POST['search_Hote'];
    $id = $_POST['search_ID'];

    $utilisateur = "SELECT * FROM Utilisateur WHERE Pseudo='$hote'";

    $prepara = $dbh->prepare($utilisateur);
    $prepara->execute();
    $row = $prepara->fetch();
    $hote = $row['idUtil'];

  }else{
    $hote = $_GET["search_Hote"];
    $id = $_GET["search_ID"];
  }

  try {
    $dbh = new PDO("mysql:host=$host;dbname=$dsn","$user", "$password");

    //requete de la table partie
    if(!empty($hote)){
      $partie = "SELECT * FROM Partie WHERE JoueurN='$hote' AND Fin IS NULL LIMIT 1";
    }else{
      $partie = "SELECT * FROM Partie WHERE idPartie=$id AND Fin IS NULL LIMIT 1";
    }

    $prepara = $dbh->prepare($partie);
    $prepara->execute();
    $row = $prepara->fetch();

    var_dump($prepara);

    if($row==false){
      echo "Il n'y a aucune partie correspondant aux critères";
    }else{
      //affichage du résultat qui sera supprimé à terme
      echo "Vous avez rejoins la partie de ".$row['JoueurN'];
      echo "<br />L'id de la partie est ".$row['idPartie'];
      echo "<br />La taille du goban est ".$row['Taille'];
    }

  } catch (PDOException $e) {
    //la connexion n'a pas pu se faire
    echo 'Connection failed: ' . $e->getMessage();
  }

?>
