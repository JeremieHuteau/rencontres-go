<?php
  include_once("Utilisateur.php");
  session_start();
  $user = new Utilisateur();
  $connecte = $user->identification($_SESSION["user"],$_SESSION["password"]);

  // Si non connecté
  if($connecte != 0)
  {
    // Redirection vers la page de connexion
    header("Location: connexion.php");
  }
?>
