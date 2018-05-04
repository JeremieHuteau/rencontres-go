<DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="../CSS/style.css">
      <title>Rencontres-go</title>
    </head>
    <body onload="form1.reset()">
      <?php include 'header.php';?>
      <div id="global">
        <div id="div_formulaire">

          <form action="../PHP/regarder.php" method="post" id="form1">

            <fieldset>
              <legend> Regarder une partie : </legend>
               <p>Statut de la partie : </p>
               <p>
                 <label>
                   <input type="radio" name="type_Partie" value="en_Cours"/>
                   En cours
                 </label>
               </p>
               <p>
                 <label>
                   <input type="radio" name="type_Partie" value="terminee"/>
                   Terminée
                 </label>
               </p>
               <p>Nom d'un des joueurs : </p>
               <input type="text" size="20" maxlength="40" name="search_Hote_regarder" />
               <p>ou ID de la partie : </p>
               <input type="text" size="20" maxlength="40" name="search_ID_regarder" />
               <p>
                 <input type="submit" value="Rechercher" id="bouton_Rechercher" />
               </p>
            </fieldset>

          </form>       

          <?php include 'regarderrecherche.php';?>

        </div>
        <footer>
            <p>Projet Développement d'applications web - Université de Bourgogne - Groupe 2</p>
        </footer>
      </div>
    </body>

  </html>