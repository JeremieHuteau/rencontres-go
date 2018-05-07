<?php
session_start();
$_SESSION["user"]="Jojo";
if(!isset($_SESSION["user"]) || empty($_SESSION["user"]))
header("location:indexTchat.php");
include "connect.php";
?>
<DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../CSS/style.css">
        <title>Rencontres-go</title>
    </head>
    <body>
        <div id="tchat">
            <textarea id="tchatText" cols="45" rows="10" disabled></textarea>

            <div id="tchatForm" style="bottom:0;width:100%">
                <form action="#" method="post">
                    <div style="margin-right:110px;">
                        <textarea name="message" style="width:100%;"></textarea>
                    </div>
                    <div style="top:12px; right:0;">
                        <input type="submit" value="Envoyer"/>
                    </div>
                </form>
            </div>

        </div>

        <script src="../JS/tchat.js" charset="utf-8"></script>
        <script type="text/javascript">
            let idPartie = <?php echo $_GET['id'];?>;
            var tchat = new TchatController(idPartie, "Joueur");
        </script>
        <footer>
            <p>Projet Développement d'applications web - Université de Bourgogne - Groupe 2</p>
        </footer>

    </body>
    </html>
