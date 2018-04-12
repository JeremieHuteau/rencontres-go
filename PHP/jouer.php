<DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="style.php">
      <title>Jeu de go</title>
    </head>
    <body>
      <main>
        <?php include_once 'header.php';?>
        <div id="div_formulaire">

          <form action="creation.php" method="post" >

            <fieldset>
              <legend>Créer une partie : </legend>
                <p>
                  Confidentialite :
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
                    Privee
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

          <form action="rejoindre.php" method="post" >

            <fieldset>
              <legend> Rejoindre une partie : </legend>
               <p>Nom de l'hote : </p>
               <input type="search" size="20" maxlength="40" name="search_Hote" />
               <p>ou ID de la partie : </p>
               <input type="search" size="20" maxlength="40" name="search_ID"/>
               <p>
                 <input type="submit" value="Rechercher" id="bouton_Rechercher_Partie" />
               </p>

               <select name="dropdown_confidentialite">
                 <option value="Public">Partie Publique</option>
                 <option value="Prive">Partie Privee</option>
                 <option value="Confidentiel">Partie Confidentielle</option>
              </select>

            </fieldset>
          </form>

        </div>
        <footer>
            <p>Projet Developpement d'applications web - Universite de Bourgogne - Groupe 2</p>
        </footer>
      </main>

    </body>
      <script src="../JS/events.js"></script>
      <script src="../JS/gestionparties.js"></script>

  </html>
