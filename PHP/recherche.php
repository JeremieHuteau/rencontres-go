<?php

  //variables de recherche
  $liste = $_POST['jliste'];
  $taille = $_POST['jtaille'];

  //connexion à la bdd
  $dsn = 'projetweb';
  $user = 'root';
  $password = 'root';
  $host = '127.0.0.1';

  //commence la session
  session_start();

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
    }

    //recherche en focntion de la taille du goban
    if($taille==0){
      $partie = "SELECT * FROM Partie";
    }
    if($taille==9){
      $partie = "SELECT * FROM Partie WHERE Taille='9'";
    }
    if($taille==13){
      $partie = "SELECT * FROM Partie WHERE Taille='13'";
    }
    if($taille==19){
      $partie = "SELECT * FROM Partie WHERE Taille='19'";
    }

    foreach ($dbh->query($partie) as $row) {

      echo "<a href=\"rejoindre.php\"><li>";
      echo "ID : ".$row['idPartie'];
      echo " Taille du Goban : ".$row['Taille'];

      //affichage des pseudos au lieu des id
      $cpt = 0;
      $joueur = $row['JoueurN'];
      $id = $row['idPartie'];

      foreach ($dbh->query($utilisateur) as $row) {
        if($tab_utilisateurs[$cpt]['id']==$joueur){
          echo " Hôte : ".$tab_utilisateurs[$cpt]['nom'];
        }
        //tableau des infos à envoyer pour rejoindre une partie
        $tab_parties[] = array(
          'id' => $id,
          'nom' => $tab_utilisateurs[$cpt]['nom'],
        );
        //variables envoyés à rejoindre.php
        //TODO: envoyer les infos selon ce qui est cliqué
        $_SESSION["nom"] = $tab_utilisateurs[$cpt]['nom'];
        $_SESSION["id"] = $id;
        $cpt++;
      }
      echo "</li></a>";
    }

  } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
  }
  
?>
