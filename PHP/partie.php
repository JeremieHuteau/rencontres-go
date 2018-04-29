<DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="../CSS/style.css">
      <link rel="stylesheet" href="../CSS/try.css" />
  		<link rel="stylesheet" href="../CSS/goban.css" />
      <title>Rencontres-go</title>
    </head>
    <body>
      <?php include_once 'header.php';?>
      <div id="global ">
        <div id="div_Partie">
          <p>
            Chat
          </p>
        </div>
        <div id="div_Partie">
          <p>
            <?php include_once 'goban.php';?>
          </p>
        </div>
        <div id="div_Partie">
          <p>
            Chrono + derniers coups joués
          </p>
        </div>
        <footer>
          <p>Projet Développement d'applications web - Université de Bourgogne - Groupe 2</p>
        </footer>
      </div>
    </body>
  </html>
