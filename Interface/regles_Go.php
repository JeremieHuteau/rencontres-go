<DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="../CSS/style.css">
      <title>Rencontres-go</title>
    </head>
    <body>
      <?php include_once 'header.php';?>
      <div id="global">

        <h1>Règle française du jeu de go</h1>

        <h3>Matériel</h3>

        <p>Le matériel de jeu traditionnel se compose d'un goban sur lequel est tracé un quadrillage de 19x19 lignes, soit 361 intersections, et de pierres qui sont soit noires, soit blanches.</br>
          Mais rien n'empêche les joueurs d'utiliser un autre matériel, et en particulier des gobans de 13x13 ou 9x9 lignes pour les parties d'initiation.</br>
          Généralement, la distance entre deux lignes du goban est approximativement de 24 mm dans le sens de la longueur et de 22 mm dans le sens de la largeur : le goban n'est donc pas tout à fait carré.</br>
          Quant aux pierres, elles sont de forme biconvexe et d'un diamètre d'environ 22 mm.</br>
          <img src="../Images/diag0.png" alt="diag0" /> Voici un goban de 19x19 lignes.</br></br>
          Remarquez que certains points sont renforcés. On les appelle hoshi.</br></br>
        </p>

        <h3>Chaîne et libertés</h3>

        <p>Deux intersections sont dites voisines quand elles sont sur la même ligne et sans autre intersection entre elles.</br>
          <img src="../Images/diag1.png" alt="diag1" />Diag. 1 : 'a' et 'b' sont des intersections voisines, mais 'b' et 'c' ne le sont pas.</br></br>
          Deux pierres sont voisines si elles occupent des intersections voisines.</br>
          Une chaîne est un ensemble de une ou plusieurs pierres de même couleur voisines de proche en proche.</br>
          Les libertés d'une chaîne sont les intersections inoccupées voisines des pierres de cette chaîne.</br>
          <img src="../Images/diag2.png" alt="diag2" />Diag. 2 : Les quatre pierres blanches marquées d'un 'X' sont voisines de proche en proche. Elles forment une chaîne qui a cinq libertés : les intersections marquées par les lettres 'a', 'b', 'c', 'd', et 'e'.</br></br>
        </p>

        <h3>Territoire</h3>

        <p>Un territoire est un ensemble de une ou plusieurs intersections inoccupées voisines de proche en proche, délimitées par des pierres de même couleur.</br>
          <img src="../Images/diag3.png" alt="diag3" />Diag. 3 : Les pierres noires délimitent un territoire de 7 intersections.</br></br>
          Notez que le bord de la grille forme une frontière naturelle du territoire, mais on pourrait bien sûr avoir un territoire qui ne touche pas du tout le bord
          (imaginez que la grille est un continent entouré par la mer,
          que le bord de la grille représente le rivage, et que les pierres représentent les frontières entre les pays de ce continent).</br></br>
        </p>

        <h3>Déroulement du jeu</h3>

        <p>Le go se joue à deux.</br>
          Celui qui commence joue avec les pierres noires et l'autre avec les blanches.</br>
          A tour de rôle, les joueurs posent une pierre de leur couleur sur une intersection inoccupée du goban ou bien ils passent.</br>
          Passer sert essentiellement à indiquer à l'adversaire que l'on considère la partie terminée.</br></br>
        </p>

        <h3>Capture</h3>

        <p>Lorqu'un joueur supprime la dernière liberté d'une chaîne adverse, il la capture en retirant du goban les pierres de cette chaîne.</br>
          De plus, en posant une pierre, un joueur ne doit pas construire une chaîne sans liberté, sauf si par ce coup il capture une chaîne adverse.</br>

          Lorsqu'une chaîne n'a plus qu'une liberté, on dit qu'elle est en atari.</br>
          <img src="../Images/diag4.png" alt="diag4" />Diag. 4 : Les trois pierres blanches 'X' forment une chaîne qui est en atari (car elle n'a plus qu'une liberté, en 'a').</br></br>
          <img src="../Images/diag5.png" alt="diag5" />Diag. 5 : Si Noir joue en 1, il supprime la dernière liberté des pierres blanches...</br></br>
          <img src="../Images/diag6.png" alt="diag6" />Diag. 6 : ...alors Noir capture les pierres blanches et les retire du goban.</br></br>
        </p>

        <h3>Vie et mort</h3>

        <p>De la règle de capture découle la notion de vie et de mort : des pierres mortes sont des pierres que l'on est sûr de pouvoir capturer sans y perdre par ailleurs, tandis que des pierres vivantes sont des pierres que l'on ne peut plus espérer capturer.</br>
          <img src="../Images/diag7.png" alt="diag7" />  Diag. 7 : D'après la règle de capture, Blanc peut jouer en 'a' et prendre Noir. On dit dans ce cas que Noir n'a qu'un œil (l'intersection 'a') et qu'il est mort.</br></br>
          <img src="../Images/diag8.png" alt="diag8" />Diag. 8 : Blanc ne pouvant jouer ni en 'b', ni en 'c', il ne pourra jamais capturer Noir. On dit alors que Noir a deux yeux (les intersections 'b' et 'c') et qu'il est vivant.</br></br>
          <img src="../Images/diag9.png" alt="diag9" />Diag. 9 : Si Noir joue en 'd' (ou 'e'), Blanc jouera en 'e' (ou 'd') et le capturera. De même, si Blanc joue en 'd' (ou 'e'), Noir le capturera.</br></br>
          Autrement dit, personne n'a intérêt à jouer en 'd' ou 'e'. Dans ce cas, on dit que les pierres 'X' sont vivantes par seki, et que 'd' et 'e' sont des intersections neutres.</br></br>
        </p>

        <h3>Répétition</h3>

        <p>Un joueur, en posant une pierre, ne doit pas redonner au goban un état identique à l'un de ceux qu'il lui avait déjà donné.</br>
            Les diagrammes qui suivent montrent le cas de répétition le plus simple et le plus fréquent que l'on appelle aussi ko.</br>
            <img src="../Images/diag10.png" alt="diag10" />Diag. 10 : Si Noir joue en 'a', il capture la pierre blanche 'X' qui est en atari.</br></br>
            <img src="../Images/diag11.png" alt="diag11" />Diag. 11 : Blanc ne peut pas rejouer immédiatement en 'b' et prendre la pierre noire 1 qui est pourtant en atari car, sinon, il reproduirait la situation du diagramme 10.</br></br>
            Il doit donc jouer ailleurs. Toute l'astuce pour Blanc consiste, avec ce coup ailleurs, à essayer de créer une menace suffisamment grave pour que Noir ait intérêt à y répondre immédiatement, et n'ait pas le temps de jouer lui-même en 'b'.</br>
            Si Noir répond à la menace, Blanc pourra à nouveau jouer en 'b', puisque son coup précédent aura changé l'état du goban.</br>
            Alors ce sera au tour de Noir de trouver une menace, et ainsi de suite, tant qu'aucun des deux joueurs ne connecte.</br></br>
        </p>

        <h3>Fin de la partie</h3>

        <p>La partie s'arrête lorsque les deux joueurs passent consécutivement. On compte alors les points.</br>
          Chaque intersection du territoire d'un joueur lui rapporte un point, ainsi que chacune de ses pierres encore présentes sur le goban.</br>
          Par ailleurs, commencer est un avantage pour Noir. </br>
          Aussi, dans une partie à égalité, Blanc reçoit en échange des points de compensation, appellés komi. </br>
          Le komi est habituellement de 7 points et demi (le demi-point sert à éviter les parties nulles).</br>
          Le gagnant est celui qui a le plus de points.</br>
          <img src="../Images/diag12.png" alt="diag12" />Diag. 12 : A ce stade, tous les territoires sont fermés, et aucune de leurs frontières ne peut être capturée par l'adversaire. C'est le moment de passer et de compter les points.</br></br>

            Noir a 8 points de territoire en bas à gauche et 2 en haut à droite. Il a de plus 33 pierres sur le jeu. Son total est de 43 points.</br>
            Blanc a 2 points de territoire en haut à gauche et 9 en bas à droite. Il a de plus 27 pierres sur le jeu. Son total est de 38 points.</br>
            Noir a donc 5 points de plus que Blanc sur le jeu. Mais si l'on tient compte du komi, Blanc gagne de 2 points et demi.</br></br>

          En pratique, afin de raccourcir les parties sans en changer le score, les joueurs pourront, d'un commun accord, retirer du goban les pierres mortes adverses juste avant le décompte des points, sans avoir à rajouter les coups nécessaires à leur capture. </br>
          En cas de désaccord (ce qui est en principe exceptionnel), il suffira de continuer à jouer jusqu'à ce que tous les litiges éventuels soient réglés.</br>
          Diag. 13 : Si Noir joue en 'a', il capture les pierres blanches 'X'.</br>
          Si Blanc essaie de les sauver en jouant lui-même en 'a', Noir joue en 'b' et les capture quand même. </br>
          Comme par ailleurs, tous les territoires sont fermés, les deux joueurs passent. </br>
          Puis Noir retire les pierres 'X' du jeu, et on peut compter les points. Vérifiez que Noir gagne d'un point et demi.
        </p>

        <h4>Note importante : en pratique, on peut utiliser une méthode de décompte rapide qui évite d'avoir à déterminer le nombre des pierres qui sont sur le jeu.</br>
          Cette méthode est décrite plus loin.</h4>

        <h3>Partie à handicap</h3>

        <p>Parfois, on donne un handicap à l'un des joueurs, consistant à laisser l'autre, qui prend Noir, jouer plusieurs coups de suite au début de la partie.
          Dans ce cas, Blanc reçoit un demi-point (toujours pour éviter les parties nulles), et un nombre de points supplémentaires égal au nombre de coups qu'il n'a pas pu jouer en début de partie.</br>
          <img src="../Images/diag13.png" alt="diag13" /></br></br>
          Voici le début d'une partie à 9 pierres de handicap. Noir commence par poser 9 pierres sur le jeu. Ce n'est qu'ensuite que Blanc pose sa première pierre (le coup 1 dans cet exemple).
          Traditionnellement, Noir place les pierres de handicap sur les hoshis.
        </p>

        <footer>
            <p>Projet Développement d'applications web - Université de Bourgogne - Groupe 2</p>
        </footer>
      </div>
    </body>
  </html>
