<?php
  if(!empty($_POST) && isset($_POST["pseudo"]) && !empty($_POST["pseudo"]))
  {
    session_start();
    $_SESSION["pseudo"] = $_POST["pseudo"];
    header("location:tchat.php");
  }
?>
<DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="../CSS/style.css">
      <title>Rencontres-go</title>
    </head>
    <body>
      <?php include 'header.php';?>
      <div id="global">
          <h1>Mon tchat</h1>
          <form action=indexTchat.php method="post">
            Pseudo : <input type="text" name="pseudo" />
            <input type="submit" value="tchater" />

        </form>

        </div>

        <footer>
            <p>Projet Développement d'applications web - Université de Bourgogne - Groupe 2</p>
        </footer>
      </div>
    </body>
  </html>
