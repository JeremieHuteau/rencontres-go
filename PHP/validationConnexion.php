<?php
  session_start();
  ini_set('display_errors', 1);

  include("utilisateur.php");
  include("connexionDB.php");
  $user = new Utilisateur();

  // Récupération des données de chaque champ du formulaire avec POST
  $email = null;
  $password = null;

  if(   !isset($_POST["email"])
      | !isset($_POST["password"]))
  {
    // Erreur 1 : champ manquant
    echo "1";
    exit;
  }

  $email = $_POST["email"];
  $password = $_POST["password"];

  $resultat = $user->identification($email,$password);

  // Si connexion réussie
  if($resultat[0]==0)
  {
    // Retour succes
    echo "0";

    // Session
    $_SESSION["user"] = $email;
    $_SESSION["password"] = $password;
    $_SESSION["id"] = $resultat[1];
  }
  else
  {
    echo $resultat[1];
  }

?>
