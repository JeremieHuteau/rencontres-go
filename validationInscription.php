<?php
/// Partie vérification des informatios fournies pour l'inscription ///
  ini_set('display_errors', 1);

  include("Utilisateur.php");
  include("connexionDB.php");
  include("methodes.php");
  $user = new Utilisateur();

  // Récupération des données de chaque champ du formulaire avec POST
  $pseudo = null;
  $email = null;
  $emailConfirmation = null;
  $password = null;
  $passwordConfirmation = null;

  if(   !isset($_POST["pseudo"])
      | !isset($_POST["email"])
      | !isset($_POST["emailConfirmation"])
      | !isset($_POST["password"])
      | !isset($_POST["passwordConfirmation"]))
  {
    // Erreur 1 : champ manquant
    echo "1";
    exit;
  }

  $pseudo = $_POST["pseudo"];
  $email = $_POST["email"];
  $emailConfirmation = $_POST["emailConfirmation"];
  $password = $_POST["password"];
  $passwordConfirmation = $_POST["passwordConfirmation"];

  // Memes verifications que en JS :

  // Test format pseudo
  if(!formatPseudo($pseudo))
  {
    // Erreur 2 : format pseudo incorrect
    echo "2";
    exit;
  }

  // Test format adresse mail
  if(!formatEmail($email))
  {
    // Erreur 3 : format mail incorrect
    echo "3";
    exit;
  }

  // Test format adresse mail confirmation
  if(!formatEmail($emailConfirmation))
  {
    // Erreur 3 : format mail incorrect
    echo "3";
    exit;
  }

  // Test format password
  if(!formatPassword($password))
  {
    // Erreur 4 : format password incorrect
    echo "4";
    exit;
  }

  // Test format password confirmation
  if(!formatPassword($passwordConfirmation))
  {
    // Erreur 4 : format password incorrect
    echo "4";
    exit;
  }

  // Test coherence passwords
  if($password != $passwordConfirmation)
  {
    // Erreur 5 : incoherence passwords
    echo "5";
    exit;
  }

  // Test coherence emails
  if($email != $emailConfirmation)
  {
    // Erreur 6 : incoherence mails
    echo "6";
    exit;
  }

  // Si adresse mail deja utilisee : ERREUR
  if($user->ExistsUser($email,"Mail"))
  {
    // Erreur 7 : mail pris
    echo "7";
    exit;
  }

  // Si pseudo déjà utilisé : ERREUR
  if($user->ExistsUser($pseudo,"Pseudo"))
  {
    // Erreur 8 : pseudo pris
    echo "8";
    exit;
  }

  if(!$user->insertUser($pseudo,$email,$password))
  {
    // Erreur 9 : Echec lors de l insertion raison indeterminee
    echo "9";
    exit;
  }

  // Code 0 : aucune erreur insertion reussie
  echo "0";
?>
