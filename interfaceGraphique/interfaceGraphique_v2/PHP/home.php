<?php
  session_start();
  include("connect.php");
  $sql = "SELECT Theme FROM profil WHERE Utilisateur='1'";
  $req = $dbh->prepare($sql);
  $req->execute();
  $theme = $req->fetch(PDO::FETCH_ASSOC);
  $theme = $theme["Theme"];
?>  
<DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <script type="text/javascript" src="../JS/theme.js"></script>
  <title>Rencontres-go</title>
  </head>
  <body onload="changeColor();">
  <input type="hidden" id="theme" value="<?=$theme?>"/>
    <?php include_once 'header.php';?>
    <div id="global">
      <p>Page d'accueil</p>
      <footer>
        <p>Projet Développement d'applications web - Université de Bourgogne - Groupe 2</p>
      </footer>
    </div>
  </body>
</html>
