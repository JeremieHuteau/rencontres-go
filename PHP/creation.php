<?php
  ini_set('display_errors', 1);
  session_start();
  include_once("connexionDB.php");
  include_once("../PHP/classePartie.php");
  $partie = new classePartie();
//variables du formulaire qu'on récupère avec post
  $confidentialite = $_POST['bouton_Confidentialite'];
  $taille = $_POST['taille-Goban'];

  
  $res = $partie->creation($confidentialite,$taille,$_SESSION["id"]);

  if($res)
  {
    header("Location: /~ag044096/lol/Interface/partie.php?id=".$res);
  }
?>