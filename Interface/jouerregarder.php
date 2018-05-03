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

          <form action="../PHP/partie.php" method="post" id="form1">

            <fieldset>
              <legend> Regarder une partie : </legend>
               <p>Statut de la partie : </p>
               <p>
                 <label>
                   <input type="radio" name="type_Partie" value="en_Cours"/>
                   En cours
                 </label>
               </p>
               <p>
                 <label>
                   <input type="radio" name="type_Partie" value="terminee"/>
                   Terminée
                 </label>
               </p>
               <p>Nom d'un des joueurs : </p>
               <input type="search" size="20" maxlength="40" id="search_Hote" />
               <p>
                 <input type="submit" value="Rechercher" id="bouton_Rechercher_Partie" />
               </p>
               <p>ou ID de la partie : </p>
               <input type="search" size="20" maxlength="40" id="search_ID" />
               <p>
                 <input type="submit" value="Rechercher" id="bouton_Rechercher_Partie" />
               </p>
            </fieldset>

          </form>

          <form id="form1">
          <fieldset>
            <legend>Regarder une partie publique : </legend>
            <select name="dropdown_taille">
              <option value="0">Taille indifférente</option>
              <option value="9">9 x 9</option>
              <option value="13">13 x 13</option>
              <option value="19">19 x 19</option>
            </select>
  
            <nav style="height: 100px; width: 350px; overflow:hidden; overflow-y:scroll; background-color: grey;" >
                <ul id="liste">
  
                </ul>
            </nav>
            
          </fieldset>
        </form>

        </div>
        <footer>
            <p>Projet Développement d'applications web - Université de Bourgogne - Groupe 2</p>
        </footer>
      </div>
    </body>
    <script src="../JS/events.js"></script>
    <script src="../JS/regarderpartie.js"></script>
  </html>