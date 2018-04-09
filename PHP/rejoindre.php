<?php
  $hote = $_POST['search_Hote'];
  $partie = $_POST['search_ID'];

  //connexion à la bdd
  $dsn = 'projetweb';
  $user = 'root';
  $password = 'root';
  $host='127.0.0.1';

  $brk = 0;

  try {
    $dbh = new PDO("mysql:host=$host;dbname=$dsn","$user", "$password");

    //parcours de la table partie
    $requete = 'SELECT * FROM Partie';

    foreach ($dbh->query($requete) as $row) {

        if($hote==$row['JoueurN'] && $row['Fin']==NULL && $brk==0){
          //TODO:update la table avec le joueurB
          echo "Vous avez rejoins la partie de ".$row['JoueurN'];
          echo "<br />L'id de la partie est ".$row['idPartie'];
          echo "<br />La taille du goban est ".$row['Taille'];
          $brk = 1;
        }elseif ($partie==$row['idPartie'] && $row['Fin']==NULL && $brk==0) {
          //TODO:update la table avec le joueurB
          echo "Vous avez rejoins la partie de ".$row['JoueurN'];
          echo "<br />L'id de la partie est ".$row['idPartie'];
          echo "<br />La taille du goban est ".$row['Taille'];
          $brk = 1;
        }
      }

      if($brk==0){
        echo "Il n'y a aucune partie correspondant aux critères";
      }

    } catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
  }


?>
