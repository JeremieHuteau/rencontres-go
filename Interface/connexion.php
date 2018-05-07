<DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="../CSS/style.css">
      <title>Rencontres-go</title>
      <script src="../JS/methodes.js"></script>
      <script src="../JS/script.js"></script>
      <script src="../JS/recuperation.js"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    </head>

    <body onload="Init();changeColor();">


      <?php 
        $user = null;
        include_once "../PHP/testconnexion.php";
        if($variableTestConnexion)
        {
          header("Location: /~ag044096/lol/Interface/home.php");
        } ?>
      <?php include_once 'header.php';?>
      <div id="global">
        



        <div id="div_formulaire">

          <?php include("formulaireConnexion.php"); ?>

          <?php include('formulaire_inscription.html'); ?>


        </div>

        <div id="recup">

        <form id="formulaire_recuperation" action="../PHP/recuperationPassword.php" method="POST" onsubmit="return validationRecuperation();">
          <input type="text" id="mailRecup"/>
          <input type="submit" value="Envoyer un nouveau mot de passe"/>
        </form>
        </div>


        <footer>
          <p>Projet Développement d'applications web - Université de Bourgogne - Groupe 2</p>
        </footer>

	</div>

    </body>
    <script src="../JS/theme.js"></script>

  </html>
