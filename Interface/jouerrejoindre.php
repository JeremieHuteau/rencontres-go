<DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="../CSS/style.css">
      <title>Rencontres-go</title>
    </head>
    <body onload="form1.reset();changeColor();">
      <?php include 'header.php';?>
      <div id="global">
        <div id="div_formulaire">

          <form action="../PHP/rejoindre.php" method="post" id="form1">

          <fieldset>
            <legend>Rejoindre une partie : </legend>
             <p>Nom de l'hôte : </p>
             <input type="text" size="20" maxlength="40" name="search_Hote" />
             <p>ou ID de la partie : </p>
             <input type="text" size="20" maxlength="40" name="search_ID"/>
             <p>
               <input type="submit" value="Rechercher" id="bouton_Rechercher_Partie" />
             </p>
          </fieldset>

        </form>

        <?php include 'jouerrechercher.php';?>

        </div>

        <footer>
            <p>Projet Développement d'applications web - Université de Bourgogne - Groupe 2</p>
        </footer>
      </div>
    </body>
    <script src="../JS/theme.js"></script>
  </html>
