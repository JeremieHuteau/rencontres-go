<?php

  //variables du formulaire qu'on récupère avec post
  //elles n'existent pas si on ouvre le fichier avec recherche.php 
  if(isset($_POST['search_Hote']) && isset($_POST['search_ID'])){
    $hote = $_POST['search_Hote'];
    $id = $_POST['search_ID'];
  }else{
    //reprise de la session
    session_start();
    $hote = $_SESSION["nom"];
    $id = $_SESSION["id"];
  }


  //connexion à la bdd
  $dsn = 'projetweb';
  $user = 'root';
  $password = 'root';
  $host='127.0.0.1';

  //variable pour éviter de répéter de rejoindre plusieurs parties
  //permet aussi de vérifier si on en a rejoint aucune
  $brk = 0;

  //compteur parce qu'apparement les foreach sont à moitié inutiles...
  $cpt = 0;

  try {
    $dbh = new PDO("mysql:host=$host;dbname=$dsn","$user", "$password");

    //requete de la table utilisateurs
    $utilisateur = 'SELECT * FROM Utilisateur';

    //on associe les id aux pseudos pour permettre la recherche par pseudo
    foreach ($dbh->query($utilisateur) as $row) {
      $tab_utilisateurs[] = array(
        'id' => $row['idUtil'],
        'nom' => $row['Pseudo'],
      );
      //vérifie si on a le nom d'hote qui correspond a un id d'une partie crée
      //ça évite de faire deux foreach après
      if($hote==$tab_utilisateurs[$cpt]['nom']){
        $hote="okay";
      }
      $cpt++;
    }

    //requete de la table partie
    $partie = 'SELECT * FROM Partie';

    foreach ($dbh->query($partie) as $row) {
      if($hote=="okay" && $row['Fin']==NULL && $brk==0){
        //recherche de l'id du joueur identique
        //TODO:update la table avec le joueurB
        echo "Vous avez rejoins la partie de ".$row['JoueurN'];
        echo "<br />L'id de la partie est ".$row['idPartie'];
        echo "<br />La taille du goban est ".$row['Taille'];
        $brk = 1;
      }elseif ($id==$row['idPartie'] && $row['Fin']==NULL && $brk==0) {
        //recherche de l'id de partie identique
        //TODO:update la table avec le joueurB
        echo "Vous avez rejoins la partie de ".$row['JoueurN'];
        echo "<br />L'id de la partie est ".$row['idPartie'];
        echo "<br />La taille du goban est ".$row['Taille'];
        $brk = 1;
      }
    }

    if($brk==0){
      //aucune partie correspondant aux criteres de recherche n'a été trouvée
      echo "Il n'y a aucune partie correspondant aux critères";
    }
  } catch (PDOException $e) {
    //la connexion n'a pas pu se faire
    echo 'Connection failed: ' . $e->getMessage();
  }

?>
