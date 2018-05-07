<?php
    
    session_start();

    if(empty($_POST["mail"]))
    {
        echo "Pas de mail";
        exit;
    }

    include_once "../PHP/testconnexion.php";
    include_once("../PHP/utilisateur.php");

    $user2 = new Utilisateur();

    $user2->recupPassword($_POST["mail"]);

    echo "0";
?>