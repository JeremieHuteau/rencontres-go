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
      $partie = "SELECT * FROM partie WHERE Acces='Public' AND Fin IS NULL";
    }
    if($taille==9){
      $partie = "SELECT * FROM partie WHERE Taille='9' AND Acces='Public' AND Fin IS NULL";
    }
    if($taille==13){
      $partie = "SELECT * FROM partie WHERE Taille='13' AND Acces='Public' AND Fin IS NULL";
    }
    if($taille==19){
      $partie = "SELECT * FROM partie WHERE Taille='19' AND Acces='Public' AND Fin IS NULL";
    }

    foreach ($dbh->query($partie) as $row) {

      echo "<li><a href=\"rejoindre.php?search_Hote=" . $row['JoueurN'] . "&search_ID=" . $row['idPartie'] . "\">";
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
        $cpt++;
      }

      echo "</a></li>";
    }

  } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
  }

?>
