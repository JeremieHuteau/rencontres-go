<?php
    //variables du formulaire qu'on récupère avec post
    ini_set('display_errors', 1);
    session_start();
    include_once("connexionDB.php");

    include_once("../PHP/classePartie.php");
    $partie = new classePartie();

    if(isset($_POST['search_Hote_regarder']) && isset($_POST['search_ID_regarder'])){
        $typeDePartie = $_POST['type_Partie'];
        $hote = $_POST['search_Hote_regarder'];
        $id = $_POST['search_ID_regarder'];
        //recherche de l'id correspondant au pseudo de l'utilisateur 
        $row=$partie->recupereID($hote);
        $hote = $row['idUtil']; 
        
        if($typeDePartie == "en_Cours"){                        
            if(!empty($hote)){
                $requete = "SELECT * FROM Partie WHERE JoueurNoir=$hote AND Fin IS NULL AND JoueurBlanc IS NOT NULL LIMIT 1";
            }else{
                $requete = "SELECT * FROM Partie WHERE ID=$id AND Fin IS NULL AND JoueurBlanc IS NOT NULL LIMIT 1";
            }
        }else{            
            if(!empty($hote)){          
                $requete = "SELECT * FROM Partie WHERE JoueurNoir=$hote AND Fin IS NOT NULL AND JoueurBlanc IS NOT NULL LIMIT 1";
            }else{
                $requete = "SELECT * FROM Partie WHERE ID=$id AND Fin IS NOT NULL AND JoueurBlanc IS NOT NULL LIMIT 1";
            }
        }

    }else{
        //en get si ça vient de la liste
        $hote = $_GET["search_Hote"];
        $id = $_GET["search_ID"];
        
        $requete = "SELECT * FROM Partie WHERE ID=$id LIMIT 1";
    }

    $res = $partie->regarderPartie($requete);

    if($res)
    {
      header("Location: /~ag044096/lol/Interface/partie.php?id=".$res);
    }
?>