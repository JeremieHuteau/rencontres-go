<DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="../CSS/style.css">
      <script type="text/javascript" src="../JS/event.js"></script>
      <title>Rencontres-go</title>
    </head>
    <body onload="form1.reset() ; form2.reset()">
      <?php include_once 'header.php';?>
      <div id="global">
        <div id="div_formulaire">

          <form action="home.php" method="post" id="form1">

            <fieldset>
              <legend> Se connecter : </legend>
               <p>Email : </p>
               <input type="email" size="20" maxlength="40" placeholder="Email" id="email_Connexion" />
               <p>Mot de passe : </p>
               <input type="password" size="20" maxlength="40" placeholder="Mot de passe" id="mdp_Connexion" />
               <p>
                 <input type="submit" value="Se connecter" id="bouton_Connexion"/>
               </p>
            </fieldset>

          </form>

          <?php //include_once 'formulaireInscription.php';?>

          <form action="home.php" method="post" id="form2">

            <fieldset>
              <legend>S'inscrire : </legend>
               <p>Email : </p>
               <input type="email" size="20" maxlength="40" placeholder="Email" id="email_Inscription" />
               <p>Confirmer votre Email : </p>
               <input type="email" size="20" maxlength="40" placeholder="Email" id="confirmation_Email_Inscription" />
               <p>Mot de passe : </p>
               <input type="password" size="20" maxlength="40" placeholder="Mot de passe" id="mdp_Inscription" />
               <p>Confirmer votre mot de passe : </p>
               <input type="password" size="20" maxlength="40" placeholder="Mot de passe" id="confirmation_Mdp_Inscription" />
               <p>
                 <input type="submit" value="S'inscrire" id="bouton_Inscription"/>
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
