<DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="style.php">
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
        <div id="creation_partie">

          <form action="Partie.php" method="post" >

            <fieldset id="confidentialite">
              <legend>Créer une partie : </legend>
                <p>
                  Confidentialité :
                </p>
                <p>
                  <input type="radio" name="r_conf" />
                  <label for="r1"><span></span>Publique</label>
                </p>
                <p>
                  <input type="radio" name="r_conf" />
                  <label for="r2"><span></span>Privée</label>
                </p>
                <p>
                  <input type="radio" name="r_conf" />
                  <label for="r2"><span></span>Confidentielle</label>
                </p>

                <p>
                  Spectateurs :
                </p>
                <p>
                  <input type="radio" name="r_spec" />
                  <label for="r1"><span></span>Avec</label>
                </p>
                <p>
                  <input type="radio" name="r_spec" />
                  <label for="r2"><span></span>Sans</label>
                </p>
            </fieldset>

          </form>

          <form action="Accueil.php" method="post" >

            <fieldset>
              <legend> S'inscrire : </legend>
               <p>Email : </p>
               <input type="email" name="email" size="20" maxlength="40" value="Email" id="email" />
               <p>Confirmer votre Email : </p>
               <input type="email" name="email" size="20" maxlength="40" value="Email" id="conf_email" />
               <p>Mot de passe : </p>
               <input type="password" name="mdp" size="20" maxlength="40" value="Mot de passe" id="mdp" />
               <p>Confirmer votre mot de passe : </p>
               <input type="password" name="mdp" size="20" maxlength="40" value="Mot de passe" id="conf_mdp" />
               <p>
                 <input type="submit" value="S'inscrire" />
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
