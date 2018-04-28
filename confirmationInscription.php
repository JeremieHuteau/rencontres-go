<?php
  ini_set('display_errors', 1);
  include("connexionDB.php");
  include("Utilisateur.php");

  $user = new Utilisateur();

  if(!isset($_GET["cle"]) || !isset($_GET["mail"]))
  {
    // Erreur
    echo "Erreur";
    exit;
  }

  $cle = $_GET["cle"];
  $mail = $_GET["mail"];

  // Confirmation de l'inscription

  $resultat = $user->confirmationInscription($cle,$mail);

  if($resultat==1)
  {
    echo "Votre email a bien été confirmée";
  }
  else
  {
    echo "Votre compte a déjà été confirmé ou le lien n'est pas bon";
  }


?>
