<?php
    ini_set('display_errors', 1);
    session_start();
    require("connect.php");

    if(!isset($_SESSION["user"]) || empty($_SESSION["user"]))
    {
        echo "Vous devez être connecté pour utiliser le tchat";
        return;
    }


    if (isset($_POST["partie"]) && isset($_POST["tchat"])
        && isset($_POST["contenu"]) && !empty($_POST["contenu"])) {

        try {
            $stmt = $dbh->prepare("
                INSERT INTO Message VALUES (
                    0, :partie, :auteur, :horodatage, :contenu, :tchat)
            ");

            $parameters = array(
                "partie" => $_POST["partie"],
                "auteur" => 1,//$_SESSION["id"],
                "horodatage" => 0,
                "contenu" => $_POST["contenu"],
                "tchat" => $_POST["tchat"]
            );

            $stmt->execute($parameters);
            $res = $stmt->errorCode();

            echo json_encode($res);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    if (isset($_GET["partie"]) && isset($_GET["tchat"])) {
        try {
            $stmt = $dbh->prepare("
                SELECT Message.ID, Utilisateur.Pseudo, Message.Horodatage, Message.Contenu
                FROM Message JOIN Utilisateur
                    ON Message.Auteur = Utilisateur.ID
                WHERE Message.Partie = :partie
                    AND Message.Chat = :tchat
                    AND Message.ID > :after
                ORDER BY Message.ID
            ");

            $parameters = array(
                "partie" => $_GET["partie"],
                "tchat" => $_GET["tchat"]
            );

            if (isset($_GET["after"]) and !empty($_GET["after"])) {
                $after = $_GET["after"];
            } else {
                $after = -1;
            }
            $parameters["after"] = $after;

            $stmt->execute($parameters);

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($rows);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

 ?>
