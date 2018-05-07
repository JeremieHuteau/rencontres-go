<?php
  ini_set('display_errors', 1);
  session_start();
  include_once("connexionDB.php");

  include_once("../PHP/classePartie.php");
  $partie = new classePartie();

  //on récupère les infos
  //en post si elles sont rentrées à la main
  if(isset($_POST['search_Hote']) && isset($_POST['search_ID'])){
    $hote = $_POST['search_Hote'];
    $id = $_POST['search_ID'];
    //recherche de l'id correspondant au pseudo de l'utilisateur 
    $row=$partie->recupereID($hote);
    $hote = $row['idUtil']; 

    //requete de la table partie
    if(!empty($hote)){
      $requete = "SELECT * FROM Partie WHERE JoueurNoir='$hote' AND Fin IS NULL LIMIT 1";
    }else{
      $requete = "SELECT * FROM Partie WHERE ID=$id AND Fin IS NULL LIMIT 1";
    }

  }else{
    //en get si ça vient de la liste
    $hote = $_GET["search_Hote"];
    $id = $_GET["search_ID"];

    $requete = "SELECT * FROM Partie WHERE ID=$id LIMIT 1";
  }

  $res = $partie->rejoindrePartie($requete,$_SESSION["id"]);

  if($res)
  {
    header("Location: /~ag044096/lol/Interface/partie.php?id=".$res);
  }


?>