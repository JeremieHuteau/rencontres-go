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
      <a href="connexion.php">
        <?php
        $utilisateurConnecte = false;
        if ($utilisateurConnecte == true) :
        { echo 'Compte';}
        else :
        { echo 'Connexion';}
        endif;
        ?>
      </a>
    </p>
  </div>
</header>
