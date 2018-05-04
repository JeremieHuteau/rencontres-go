<?php
//variables du formulaire qu'on récupère avec post


  //connexion à la bdd
    $dsn = 'ag044096';
    $user = 'ag044096';
    $password = 'ag044096';
    $host='172.31.21.41';

  try {
    $dbh = new PDO("mysql:host=$host;dbname=$dsn","$user", "$password");
    if(isset($_POST['search_Hote_regarder']) && isset($_POST['search_ID_regarder'])){
        $typeDePartie = $_POST['type_Partie'];
        $hote = $_POST['search_Hote_regarder'];
        $id = $_POST['search_ID_regarder'];
        //recherche de l'id correspondant au pseudo de l'utilisateur 
        $utilisateur = "SELECT * FROM utilisateur WHERE Pseudo='$hote'";
        $prepara = $dbh->prepare($utilisateur);
        $prepara->execute();
        $row = $prepara->fetch();
        $hote = $row['idUtil']; 
        
        if($typeDePartie == "en_Cours"){                        
            if(!empty($hote)){
                $partie = "SELECT * FROM partie WHERE JoueurN=$hote AND Fin IS NULL AND JoueurB IS NOT NULL LIMIT 1";
            }else{
                $partie = "SELECT * FROM partie WHERE idPartie=$id AND Fin IS NULL AND JoueurB IS NOT NULL LIMIT 1";
            }
        }else{            
            if(!empty($hote)){          
                $partie = "SELECT * FROM partie WHERE JoueurN=$hote AND Fin IS NOT NULL AND JoueurB IS NOT NULL LIMIT 1";
            }else{
                $partie = "SELECT * FROM partie WHERE idPartie=$id AND Fin IS NOT NULL AND JoueurB IS NOT NULL LIMIT 1";
            }
        }

    }else{
        //en get si ça vient de la liste
        $hote = $_GET["search_Hote"];
        $id = $_GET["search_ID"];
        
        $partie = "SELECT * FROM partie WHERE idPartie=$id LIMIT 1";
    }

    $prepara = $dbh->prepare($partie);
    $prepara->execute();
    $row = $prepara->fetch();
    if($row==false){
      echo "Il n'y a aucune partie correspondant aux critères";
    }else{
      //affichage du résultat qui sera supprimé à terme
      echo "Vous avez rejoins la partie de ".$row['JoueurN'];
      echo "<br />L'id de la partie est ".$row['idPartie'];
      echo "<br />La taille du goban est ".$row['Taille'];
      echo "<br />Le deuxième joueur est ".$row['JoueurB'];
    }

  } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
  }
?>