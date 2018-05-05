<?php
  session_start();
  include("connect.php");
  $sql = "SELECT Theme FROM profil WHERE Utilisateur='1'";
  $req = $dbh->prepare($sql);
  $req->execute();
  $theme = $req->fetch(PDO::FETCH_ASSOC);
  $theme = $theme["Theme"];
?>  
<DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="../CSS/style.css">
      <title>Rencontres-go</title>
      <script type="text/javascript" src="../JS/theme.js"></script>
      <script
			  src="https://code.jquery.com/jquery-3.3.1.js"
			  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
        </script>
    </head>
    <body onload="changeColor();">
      <input type="hidden" id="theme" value="<?=$theme?>"/>
      <?php include 'header.php';?>
      <div id="global">
        <div id="div_formulaire">

          <form action="#" method="get" id="form1">

          <fieldset>
            <legend>Mon compte : </legend>
              <p>
                Pseudo : 
              </p>

              <p>
                Rang :
              </p>

              <p>
                Thème :
                <select name="dropdown_theme">
                  <option value="sombre" onclick="changeCoul('Theme1'); "style="background-color : black; color:white;">
                  Sombre
                  </option>
                  <option value="clair" onclick="changeCoul('Theme2');"style="background-color : white; color:black;">
                  Clair
                  </option>
                  <option value="original" onclick="changeCoul('Theme3'); " style="background-color : rgb(237,176,95); color:black;">
                  Original
                  </option>
                </select>
              </p>

          </fieldset>
          
        </form>

        </div>
        <footer id="pied">
            <p>Projet Développement d'applications web - Université de Bourgogne - Groupe 2</p>
        </footer>
      </div>
    </body>
  </html>
