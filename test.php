<?php

   ini_set('display_errors', 1);
   include("connexionDB.php");
  include("TestConnexion.php");
  include_once("Utilisateur.php");
  $user = new Utilisateur();

  $userInfos = $user->recupInfos($_SESSION["id"]);

  echo "<br/>Infos sur l'utilisateur : <br/>";
  echo "Pseudo : ".$userInfos["Pseudo"];
  echo "<br/>Mail : ".$userInfos["Mail"];
  echo "<br/>Rang : ".$userInfos["Ranking"];

?>
