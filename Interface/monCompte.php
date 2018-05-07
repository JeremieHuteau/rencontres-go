<DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <title>Rencontres-go</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../JS/theme.js"></script>
  </head>
  <body onload="changeColor();">
    <?php include_once("../PHP/testconnexion.php") ; if(!$variableTestConnexion){header("Location: /~ag044096/lol/Interface/home.php");} include 'header.php';?>
    <div id="global">
      <div id="div_formulaire">
        <form action="#" method="get" id="form1">
        <fieldset>
          <legend>Mon compte : </legend>
            <p>
              Pseudo : <?=$informations["Pseudo"]?>
            </p>

            <p>
              Rang : <?=$informations["Ranking"]?>
            </p>

            <p>
              Thème :
              <select id="themes" name="dropdown_theme">
                <option value="Theme1" onclick="changeCoul('Theme1'); "style="background-color : black; color:white;">
                Sombre
                </option>
                <option value="Theme2" onclick="changeCoul('Theme2');"style="background-color : white; color:black;">
                Clair
                </option>
                <option value="Theme3" onclick="changeCoul('Theme3'); " style="background-color : rgb(237,176,95); color:black;">
                Original
                </option>
              </select>
            </p>

            <script>
              var theme = document.getElementById("theme").value;
              document.getElementById("themes").value = theme;
            </script>

        </fieldset>
        
      </form>


      <form id="formulaire_deconnexion" action="../PHP/deconnexion.php" method="POST">
        <input type="submit" value="Se déconnecter"/>
      </form>

      </div>
      <footer id="pied">
          <p>Projet Développement d'applications web - Université de Bourgogne - Groupe 2</p>
      </footer>
    </div>
  </body>
</html>
