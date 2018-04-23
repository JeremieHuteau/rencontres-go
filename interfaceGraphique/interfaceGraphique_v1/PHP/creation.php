<DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="../CSS/style.css">
      <title>Rencontres-go</title>
    </head>
    <body>
      <main>
        <?php include 'header.php';?>
        <div id="div_formulaire">

          <form action="partie.php" method="post" >

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
      </main>

    </body>
  </html>

<?php

//variables du formulaire qu'on récupère avec post
  $confidentialite = $_POST['bouton_Confidentialite'];
  $taille = $_POST['taille-Goban'];

  //connexion à la bdd
  $dsn = 'projetweb';
  $user = 'root';
  $password = 'root';
  $host='127.0.0.1';

  try {
    $dbh = new PDO("mysql:host=$host;dbname=$dsn","$user", "$password");
    //TODO:insérer le joueur connecté
    $insertion = "INSERT INTO partie (`Taille`, `Handicap`, `Komi`, `Debut`, `Fin`, `Duree`, `Acces`, `JoueurN`, `JoueurB`, `Vainqueur`)
    VALUES (?,0,'6.5',NOW(),NULL,'01:00:00',?,1,NULL,NULL)";

    //ajoute la taille et la confidentialite a la requete
    $prepara = $dbh->prepare($insertion);
    $prepara->execute(array($taille,$confidentialite));

    echo "Reussite";

    } catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
  }
?>
