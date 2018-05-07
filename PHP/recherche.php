<?php

  //variables de recherche
  $liste = $_POST['jliste'];
  $taille = $_POST['jtaille'];

  $dsn = 'ag044096';
  $user = 'ag044096';
  $password = 'ag044096';
  $hst='172.31.21.41';

  try {
    $dbh = new PDO("mysql:host=$hst;dbname=$dsn","$user", "$password");
    //requete de la table utilisateurs
    $utilisateur = 'SELECT * FROM Utilisateur';

    //on associe les id aux pseudos pour permettre la recherche par pseudo
    foreach ($dbh->query($utilisateur) as $row) {
      $tab_utilisateurs[] = array(
        'id' => $row['ID'],
        'nom' => $row['Pseudo'],
      );
    }

    //recherche en focntion de la taille du goban
    if($taille==0){
      $partie = "SELECT * FROM Partie WHERE Acces='Public' AND Fin IS NULL AND JoueurBlanc IS NULL";
    }
    if($taille==9){
      $partie = "SELECT * FROM Partie WHERE Taille='9' AND Acces='Public' AND Fin IS NULL AND JoueurBlanc IS NULL";
    }
    if($taille==13){
      $partie = "SELECT * FROM Partie WHERE Taille='13' AND Acces='Public' AND Fin IS NULL AND JoueurBlanc IS NULL";
    }
    if($taille==19){
      $partie = "SELECT * FROM Partie WHERE Taille='19' AND Acces='Public' AND Fin IS NULL AND JoueurBlanc IS NULL";
    }

    foreach ($dbh->query($partie) as $row) {

      echo "<a href=\"../PHP/rejoindre.php?search_Hote=" . $row['JoueurNoir'] . "&search_ID=" . $row['ID'] . "\"><li>";
      echo "<b>ID partie :</b> ".$row['ID'];
      echo " <b>Taille du Goban :</b> ".$row['Taille'];

      //affichage des pseudos au lieu des id
      $joueur = $row['JoueurNoir'];
      $id = $row['ID'];

      for($i=0 ; $i<count($tab_utilisateurs) ; $i++){
        if($tab_utilisateurs[$i]['id']==$joueur){
          echo " <b>Hôte :</b> ".$tab_utilisateurs[$i]['nom'];
        }
      }

      echo "</li></a></br></br>";
    }

  } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
  }

?>
