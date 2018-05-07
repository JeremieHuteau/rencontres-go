<header>
  <?php
    include("../PHP/testconnexion.php");
  ?>
  <script src="../JS/theme.js"></script>
  <input type="hidden" id="theme" value="<?=$themeUser?>"/>
  <nav>
    <ul>
      <li class="bouton_header">
          <a href="home.php">Accueil</a>
      </li>
      <li class="bouton_header">
        <a>Jouer</a>
        <ul class="onglet">
          <li>
            <a href="jouercreer.php">Créer une partie</a>
          </li>
          <li>
            <a href="jouerrejoindre.php">Rejoindre une partie</a>
          </li>
        </ul>
      </li>
      <li class="bouton_header">
          <a href="jouerregarder.php">Regarder</a>
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
            <?php
            if ($variableTestConnexion == true)
            { echo '<a href="monCompte.php"> Compte </a>';}
            else
            { echo '<a href="connexion.php"> Connexion </a>';}
            ?>
      </li>
    </ul>
  </nav>
</header>
