<DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="../CSS/style.css">
      <title>Rencontres-go</title>
      <script type="text/javascript" src="../JS/theme.js"></script>
    </head>
    <body>
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
                  <option value="sombre" onclick="changeColor('black', 'white');" style="background-color : black; color:white;">Sombre</option>
                  <option value="clair" onclick="changeColor('white', 'black');" >Clair</option>
                  <option value="original" onclick="changeColor('rgb(237,176,95)', 'black');" style="background-color : rgb(237,176,95); color:black;">Original</option>
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
