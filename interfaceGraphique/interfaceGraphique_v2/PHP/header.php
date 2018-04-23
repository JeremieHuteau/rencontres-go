<header>
  <nav>
    <ul>
      <li class="bouton_header">
          <a href="home.php">Accueil</a>
      </li>
      <li class="bouton_header">
        <a>Jouer</a>
        <ul class="onglet">
          <li>
            <a href="creation.php">Créer une partie</a>
          </li>
          <li>
            <a href="rejoindre.php">Rejoindre une partie</a>
          </li>
        </ul>
      </li>
      <li class="bouton_header">
          <a href="regarder.php">Regarder</a>
      </li>
      <li class="bouton_header">
          <a>Règles</a>
          <ul class="onglet">
            <li>
              <a href="regles_Go.php">Règles du Go</a>
            </li>
            <li>
              <a href="regles_tchat.php">Règles du tchat</a>
            </li>
          </ul>
      </li>
      <li class="bouton_header">
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
      </li>
    </ul>
  </nav>
</header>
