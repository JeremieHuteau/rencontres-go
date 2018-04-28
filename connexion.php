<DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="style.php">
      <title>Rencontres-go</title>
      <script src="methodes.js"></script>
      <script src="script.js"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    </head>

    <body onload="Init()">

      <main>

      <?php include_once 'header.php';?>

        <div id="div_formulaire">

          <?php include("formulaireConnexion.php"); ?>

          <?php include('formulaire_inscription.html'); ?>


        </div>

        <footer>
          <p>Projet Développement d'applications web - Université de Bourgogne - Groupe 2</p>
        </footer>

      </main>

    </body>

  </html>
