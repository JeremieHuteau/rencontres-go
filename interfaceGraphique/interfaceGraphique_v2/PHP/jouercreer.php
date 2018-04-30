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

          <form action="partie.php" method="post" id="form1">

          <fieldset>
            <legend>Créer une partie : </legend>
              <p>
                Confidentialité :
              </p>

              <p>
                <label>
                  <input type="radio" name="bouton_Confidentialite" value="Public"/>
                  Publique
                </label>
              </p>

              <p>
                <label>
                  <input type="radio" name="bouton_Confidentialite" value="Prive"/>
                  Privée
                </label>
              </p>

              <p>
                <label>
                  <input type="radio" name="bouton_Confidentialite" value="Confidentiel"/>
                  Confidentielle
                </label>
              </p>

              <p>
                Taille du Goban :
              </p>
              <p>
                <label>
                  <input type="radio" name="taille-Goban" value="9"/>
                  9x9
                </label>
              </p>

              <p>
                <label>
                  <input type="radio" name="taille-Goban" value="13"/>
                  13x13
                </label>
              </p>

              <p>
                <label>
                  <input type="radio" name="taille-Goban" value="19"/>
                  19x19
                </label>
              </p>

              <p>
                <input type="submit" value="Créer la partie" id="bouton_Creer_Partie" />
              </p>
          </fieldset>

        </form>

        </div>

        <footer>
            <p>Projet Développement d'applications web - Université de Bourgogne - Groupe 2</p>
        </footer>
      </div>
    </body>
  </html>
