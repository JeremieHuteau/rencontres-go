<header>
  <nav>
    <ul>
      <li class="bouton_header">
          <a href="home.php" name="ref">Accueil</a>
      </li>
      <li class="bouton_header">
        <a name="ref">Jouer</a>
        <ul class="onglet">
          <li>
            <a href="creation.php" name="ref">Créer une partie</a>
          </li>
          <li>
            <a href="rejoindre.php" name="ref">Rejoindre une partie</a>
          </li>
        </ul>
      </li>
      <li class="bouton_header">
          <a href="regarder.php" name="ref">Regarder</a>
      </li>
      <li class="bouton_header">
          <a name="ref">Règles</a>
          <ul class="onglet">
            <li>
              <a href="regles_Go.php" name="ref">Règles du Go</a>
            </li>
            <li>
              <a href="regles_tchat.php" name="ref">Règles du tchat</a>
            </li>
          </ul>
      </li>
      <li class="bouton_header">
          <a href="connexion.php" name="ref">
            <?php
            $utilisateurConnecte = false;
            if ($utilisateurConnecte == true) :
            { echo 'Compte';}
            else :
            { echo 'Connexion';}
            endif;
            ?>
          </a>
      </li>
    </ul>
  </nav>
</header>
