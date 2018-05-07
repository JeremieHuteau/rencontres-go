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
        $insertion = "INSERT INTO partie (Taille, Handicap, Komi, Debut, Fin, Duree, Acces, JoueurN, JoueurB, Vainqueur)
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
        $utilisateur = "SELECT * FROM utilisateur WHERE Pseudo='$pseudo'";
        $prepara = $this->bdd->prepare($utilisateur);
        $prepara->execute();
        $row = $prepara->fetch();
     
        return $row;
    }

    function rejoindrePartie($requete,$idJoueur){
        $prepara = $this->bdd->prepare($requete);
        $prepara->execute();
        $row = $prepara->fetch();
        $idPartie = $row['idPartie'];
        $idHote = $row['JoueurN'];

        if($idHote == $idJoueur){
            echo "Vous avez créé cette partie, vous ne pouvez pas la rejoindre";
        }else{
            $prepara = $this->bdd->prepare("UPDATE partie SET JoueurB=$idJoueur where idPartie=$idPartie");
            $prepara->execute();
            return $idPartie;
        }
        return false;
    }

    function regarderPartie($requete){
        $prepara = $this->bdd->prepare($requete);
        $prepara->execute();
        $row = $prepara->fetch();
        $idPartie = $row['idPartie'];

        if($idPartie)
        {
            return $idPartie;
        }
        return false;
    }

}
?>