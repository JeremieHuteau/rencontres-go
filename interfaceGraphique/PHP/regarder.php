<DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="style.php">
      <title>Rencontres-go</title>
    </head>
    <body>
      <main>
        <?php include_once 'header.php';?>
        <div id="div_formulaire">

        <form action="partie.php" method="post" >

          <fieldset>
            <legend> Regarder une partie : </legend>
             <p>Statut de la partie : </p>
             <p>
               <input type="radio" name="type_Partie" />
               <label><span></span>En cours</label>
             </p>
             <p>
               <input type="radio" name="type_Partie" />
               <label><span></span>Terminée</label>
             </p>
             <p>Nom d'un des joueurs : </p>
             <input type="search" size="20" maxlength="40" id="search_Hote" />
             <p>
               <input type="submit" value="Rechercher" id="bouton_Rechercher_Partie" />
             </p>
             <p>ID de la partie : </p>
             <input type="search" size="20" maxlength="40" id="search_ID" />
             <p>
               <input type="submit" value="Rechercher" id="bouton_Rechercher_Partie" />
             </p>
          </fieldset>

        </form>

        </div>
        <footer>
            <p>Projet Développement d'applications web - Université de Bourgogne - Groupe 2</p>
        </footer>
      </main>
    </body>
  </html>