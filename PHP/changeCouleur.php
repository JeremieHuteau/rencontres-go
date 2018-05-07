<?php 
  session_start();

  include_once "../PHP/testconnexion.php";
  include_once("../PHP/utilisateur.php");

  $theme = $_POST["theme"];
  $util = $_SESSION["id"];

  $user = new Utilisateur();
    $user->changeTheme($theme,$util);

  echo $theme;
?> 