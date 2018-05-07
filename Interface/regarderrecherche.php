<DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="../CSS/style.css">
      <title>Rencontres-go</title>
    </head>
    <body onload="form1.reset();changeColor();">

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

    </body>
    <script src="../JS/events.js"></script>
    <script src="../JS/regarderpartie.js"></script>
    <script src="../JS/theme.js"></script>
  </html>