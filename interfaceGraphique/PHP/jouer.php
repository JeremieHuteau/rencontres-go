<DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="../CSS/style.css">
      <title>Rencontres-go</title>
    </head>
    <body>
      <main>
        <header>
          <div class="bouton_header">
            <p>
              <a href="home.php">Accueil</a>
            </p>
          </div>
          <div class="bouton_header">
            <p>
              <a href="jouer.php">Jouer</a>
            </p>
          </div>
          <div class="bouton_header">
            <p>
              <a href="regarder.php">Regarder</a>
            </p>
          </div>
          <div class="bouton_header">
            <p>
              <a href="regles.php">Règles</a>
            </p>
          </div>
          <div class="bouton_header">
            <p>
              <a href="connexion.php">Connexion</a>
            </p>
          </div>
        </header>
        <div id="div_formulaire">

          <form action="partie.php" method="post" >

            <fieldset>
              <legend>Créer une partie : </legend>
                <p>
                  Confidentialité :
                </p>
                <p>
                  <input type="radio" name="bouton_Confidentialite" />
                  <label><span></span>Publique</label>
                </p>
                <p>
                  <input type="radio" name="bouton_Confidentialite" />
                  <label><span></span>Privée</label>
                </p>
                <p>
                  <input type="radio" name="bouton_Confidentialite" />
                  <label><span></span>Confidentielle</label>
                </p>

                <p>
                  Taille du Goban :
                </p>
                <p>
                  <input type="radio" name="taille-Goban" />
                  <label><span></span>9x9</label>
                </p>
                <p>
                  <input type="radio" name="taille-Goban" />
                  <label><span></span>13x13</label>
                </p>
                <p>
                  <input type="radio" name="taille-Goban" />
                  <label><span></span>19x19</label>
                </p>
                <p>
                  <input type="submit" value="Créer la partie" id="bouton_Creer_Partie" />
                </p>
            </fieldset>

          </form>

          <form action="partie.php" method="post" >

            <fieldset>
              <legend> Rejoindre une partie : </legend>
               <p>Nom de l'hôte : </p>
               <input type="search" size="20" maxlength="40" id="search_Hote" />
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
