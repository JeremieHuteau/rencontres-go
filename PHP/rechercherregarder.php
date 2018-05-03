<?php

  //variables de recherche
  $liste = $_POST['jliste'];
  $taille = $_POST['jtaille'];

  //include 'connexionBD.php';
  $dsn = 'ag044096';
  $user = 'ag044096';
  $password = 'ag044096';
  $hst='172.31.21.41';

  try {
    $dbh = new PDO("mysql:host=$hst;dbname=$dsn","$user", "$password");
    //requete de la table utilisateurs
    $utilisateur = 'SELECT * FROM utilisateur';

    //on associe les id aux pseudos pour permettre la recherche par pseudo
    foreach ($dbh->query($utilisateur) as $row) {
      $tab_utilisateurs[] = array(
        'id' => $row['idUtil'],
        'nom' => $row['Pseudo'],
      );
    }

    //recherche en focntion de la taille du goban
    if($taille==0){
      $partie = "SELECT * FROM partie WHERE Acces='Public' AND Fin IS NULL AND JoueurB IS NOT NULL";
    }
    if($taille==9){
      $partie = "SELECT * FROM partie WHERE Taille='9' AND Acces='Public' AND Fin IS NULL AND JoueurB IS NOT NULL";
    }
    if($taille==13){
      $partie = "SELECT * FROM partie WHERE Taille='13' AND Acces='Public' AND Fin IS NULL AND JoueurB IS NOT NULL";
    }
    if($taille==19){
      $partie = "SELECT * FROM partie WHERE Taille='19' AND Acces='Public' AND Fin IS NULL AND JoueurB IS NOT NULL";
    }

    foreach ($dbh->query($partie) as $row) {

      echo "<a href=\"../PHP/rejoindre.php?search_Hote=" . $row['JoueurN'] . "&search_ID=" . $row['idPartie'] . "\"><li>";
      echo "<b>ID partie :</b> ".$row['idPartie'];
      echo "<b> Taille du Goban :</b> ".$row['Taille'];


      //affichage des pseudos au lieu des id
      $cpt = 0;
      $joueur = $row['JoueurN'];
      $id = $row['idPartie'];
      $joueurB = $row['JoueurB'];

      foreach ($dbh->query($utilisateur) as $row) {
        if($tab_utilisateurs[$cpt]['id']==$joueur){
          echo " <b>Hôte :</b> ".$tab_utilisateurs[$cpt]['nom'];
        }
        $cpt++;
      }

      $cpt = 0;
      foreach ($dbh->query($utilisateur) as $row) {
        if($tab_utilisateurs[$cpt]['id']==$joueurB){
          echo " <b>Second Joueur :</b> ".$tab_utilisateurs[$cpt]['nom'];
        }
        $cpt++;
      }
      echo "</li></a>";
    }

  } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
  }

?>