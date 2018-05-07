<?php


  class classePartie{

    private $bdd;

    public function __construct()
    {
      // Recuperation de la BDD
      $conn = new connexionDB();
      $this->bdd = $conn->db;
    }

    function creation($conf,$taille,$id)
    {
        $insertion = "INSERT INTO Partie (Taille, Handicap, Komi, Debut, Fin, Duree, Acces, JoueurNoir, JoueurBlanc, Vainqueur)
        VALUES (?,0,'6.5',NOW(),NULL,'01:00:00',?,?,NULL,NULL)";
    
        //ajoute la taille et la confidentialite a la requete
        $prepara = $this->bdd->prepare($insertion);
        $prepara->execute(array($taille,$conf,$id));

        $id = $this->bdd->lastInsertId();

        if($id)
        {
            return $id;
        }
        return false;
    }

    function recupereID($pseudo){
        $utilisateur = "SELECT * FROM Utilisateur WHERE Pseudo='$pseudo'";
        $prepara = $this->bdd->prepare($utilisateur);
        $prepara->execute();
        $row = $prepara->fetch();
     
        return $row;
    }

    function rejoindrePartie($requete,$idJoueur){
        $prepara = $this->bdd->prepare($requete);
        $prepara->execute();
        $row = $prepara->fetch();
        $idPartie = $row['ID'];
        $idHote = $row['JoueurNoir'];

        if($idHote == $idJoueur){
            echo "Vous avez créé cette partie, vous ne pouvez pas la rejoindre";
        }else{
            $prepara = $this->bdd->prepare("UPDATE Partie SET JoueurBlanc=$idJoueur where ID=$idPartie");
            $prepara->execute();
            return $idPartie;
        }
        return false;
    }

    function regarderPartie($requete){
        $prepara = $this->bdd->prepare($requete);
        $prepara->execute();
        $row = $prepara->fetch();
        $idPartie = $row['ID'];

        if($idPartie)
        {
            return $idPartie;
        }
        return false;
    }

    /*pour améliorer sur recherche.php mais j'y arrive pas
    function tabutilisateurs(){
        $utilisateur = 'SELECT * FROM Utilisateur';
          //on associe les id aux pseudos pour permettre la recherche par pseudo
        foreach ($this->$bdd->query($utilisateur) as $row) {
            $tab_utilisateurs[] = array(
            'id' => $row['ID'],
            'nom' => $row['Pseudo'],
            );
        }
        return $tab_utilisateurs;
    }

    function listerecherche($partie,$tab_utilisateurs){
        foreach ($this->$bdd->query($partie) as $row) {
            
            echo "<a href=\"../PHP/rejoindre.php?search_Hote=" . $row['JoueurN'] . "&search_ID=" . $row['idPartie'] . "\"><li>";
            echo "<b>ID partie :</b> ".$row['idPartie'];
            echo " <b>Taille du Goban :</b> ".$row['Taille'];
        
            //affichage des pseudos au lieu des id
            $cpt = 0;
            $joueur = $row['JoueurNoir'];
            $id = $row['ID'];
            foreach ($this->$bdd->query($utilisateur) as $row) {
                if($tab_utilisateurs[$cpt]['id']==$joueur){
                echo " <b>Hôte :</b> ".$tab_utilisateurs[$cpt]['nom'];
                }
                $cpt++;
            }
        
            echo "</li></a>";
            }
    }*/

    function afficheUtilisateurs($utilisateur,$joueur,$id,$joueurB){
        echo "ok";
        //on associe les id aux pseudos pour permettre la recherche par pseudo
        foreach ($this->$bdd->query($utilisateur) as $row) {
            $tab_utilisateurs[] = array(
            'id' => $row['ID'],
            'nom' => $row['Pseudo'],
            );
            
        }

        foreach ($this->$bdd->query($utilisateur) as $row) {
            if($tab_utilisateurs[$cpt]['id']==$joueur){
              echo " <b>Hôte :</b> ".$tab_utilisateurs[$cpt]['nom'];
            }
            $cpt++;
          }
    
          $cpt = 0;
          foreach ($this->$bdd->query($utilisateur) as $row) {
            if($tab_utilisateurs[$cpt]['id']==$joueurB){
              echo " <b>Second Joueur :</b> ".$tab_utilisateurs[$cpt]['nom'];
            }
            $cpt++;
          }
    }

}
?>