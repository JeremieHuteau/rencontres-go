<?php
  session_start();
  if(!isset($_SESSION["pseudo"]) || empty($_SESSION["pseudo"]))
    header("location:indexTchat.php");
  include "connect.php";
?>
<DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="../CSS/style.css">
      <script
			  src="https://code.jquery.com/jquery-3.3.1.js"
			  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
			  crossorigin="anonymous"></script>
      <script type="text/javascript" src="../JS/tchat.js">
        <?php
          $sql = "SELECT id FROM messages ORDER BY id DESC LIMIT 1";
          $req = $dbh->query($sql);
          $data = $req->fetch(PDO::FETCH_ASSOC);
        ?>
        var lastid = <?php echo $data["id"]; ?>
      </script>
      <title>Rencontres-go</title>
    </head>
    <body>
      <h1>Mon tchat, connecté en tant que <?php echo $_SESSION["pseudo"]; ?></h1>
      <div id="tchat">
        <textarea name="tchatText" id="" cols="30" rows="10">
          <?php
            $sql = "SELECT * FROM messages ORDER BY date DESC LIMIT 15";
            $req = $dbh->query($sql);
            $d = array();
            while($data = $req->fetch(PDO::FETCH_ASSOC))
            {
              $d[] = $data;
            }
            for($i=count($d)-1 ; $i>=0 ; $i--)
            {
              ?>
                <?php echo $d[$i]["pseudo"]; ?> (<?php echo date("d/m/Y H:i:s", $d[$i]["date"]); ?>) : <?php echo htmlentities($d[$i]["message"]); ?>
              <?php
            }
          ?>
        </textarea>

      <div id="tchatForm" style="bottom:0;width:100%">
      <form action="#" method="post">
        <div style="margin-right:110px;">
          <textarea name="message" style="width:100%;"></textarea>
        </div>
        <div style="position:absolute; top:12px; right:0;">
          <input type="submit" value="Envoyer" />
        </div>

        </form>

        </div>

        <footer>
            <p>Projet Développement d'applications web - Université de Bourgogne - Groupe 2</p>
        </footer>
      </div>
    </body>
  </html>
