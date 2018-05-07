<?php
  include_once("utilisateur.php");
  include_once("connexionDB.php");
  session_start();
  $user = new Utilisateur();
  $connecte = $user->identification($_SESSION["user"],$_SESSION["password"]);

  $infos = $user->recupInfos($connecte[1]);

  // Si non connecté
  if($connecte[0] != 0)
  {
    // Redirection vers la page de connexion
    $variableTestConnexion = false;
    $themeUser = "Theme1";
    $informations = null;
  }else
  {
    $variableTestConnexion = true;
    $themeUser = $infos["Theme"];
    $informations = $infos;
  }
?>
