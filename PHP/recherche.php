<?php

  //variables de recherche
  $liste = $_POST['jliste'];
  $taille = $_POST['jtaille'];

  //connexion à la bdd
  $dsn = 'projetweb';
  $user = 'root';
  $password = 'root';
  $host = '127.0.0.1';

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
      $partie = "SELECT * FROM Partie WHERE Acces='Public' AND Fin IS NULL";
    }
    if($taille==9){
      $partie = "SELECT * FROM Partie WHERE Taille='9' AND Acces='Public' AND Fin IS NULL";
    }
    if($taille==13){
      $partie = "SELECT * FROM Partie WHERE Taille='13' AND Acces='Public' AND Fin IS NULL";
    }
    if($taille==19){
      $partie = "SELECT * FROM Partie WHERE Taille='19' AND Acces='Public' AND Fin IS NULL";
    }

    foreach ($dbh->query($partie) as $row) {

      echo "<a href=\"rejoindre.php?search_Hote=" . $row['JoueurN'] . "&search_ID=" . $row['idPartie'] . "\"><li>";
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

      echo "</li></a>";
    }

  } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
  }

?>
