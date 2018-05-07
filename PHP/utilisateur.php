<?php


  class Utilisateur{

    private $bdd;

    public function __construct()
    {
      // Recuperation de la BDD
      $conn = new connexionDB();
      $this->bdd = $conn->db;
    }

    public function changeTheme($theme,$id)
    {
      $req= $this->bdd->prepare("UPDATE profil SET Theme=? WHERE Util=?");
      $req->execute(array($theme,$id));
    }

    // Envoie un mdp
    public function recupPassword($mail)
    {
      $caracteres=["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","0","1","2","3","4","5","6","7","8","9"];
      $mdp = "";
      for($i=0;$i<10;$i++)
      {
        $nb = rand(0,count($caracteres)-1);
        $mdp = $mdp.$caracteres[$nb];
      }

      $hash = password_hash($mdp,PASSWORD_BCRYPT);

      $req = $this->bdd->prepare("UPDATE utilisateur SET Password=? WHERE mail=?");
      $req->execute(array($hash,$mail));


      $to      = $mail;
      $subject = 'Recuperation mot de passe';
      $message = 'Voici votre nouveau mot de passe : '.$mdp;
      $headers = 'From: ' . "\r\n" .
      'Reply-To: ' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

      mail($to, $subject, $message, $headers);


    }

    // Retourne l'id de l'utilisateur
    public function getId($var,$type)
    {
      $req = $this->bdd->prepare("SELECT idUtil FROM utilisateur WHERE ".$type."=?");
      $req->execute(array($var));

      $res = $req->fetch();

      return $res["idUtil"];
    }

    public function recupInfos($id)
    {
      $req = $this->bdd->prepare("SELECT * FROM utilisateur, profil WHERE idUtil=? AND idUtil=Util");
      $req->execute(array($id));
      $res = $req->fetch();
      return $res;
    }

    // Insertion d un utilisateur dans la bdd
    public function insertUser($pseudo,$email,$password)
    {

      // Hashage du mdp
      $hash = password_hash($password, PASSWORD_BCRYPT);

      // Creation CLE
      $time = substr(time(),-9);
      $random = rand(1000,9999);
      $cle = $time.$random;

      // Insertion nouvelle ligne dans BDD (utilisateur)
      $req=$this->bdd->prepare("INSERT INTO utilisateur (`Pseudo`,`Mail`,`Password`)
                    VALUES (?,?,?)");
      $req->execute(array($pseudo,$email,$hash));
      $id1 = $this->bdd->lastInsertId();
      $id2=null;

      // Si insertion réussie
      if($id1)
      {

        //Insertion cle + mail
        $req=$this->bdd->prepare("INSERT INTO valid (`Util`,`Key`,`Etat`)
                    VALUES (?,?,?)");
        $req->execute(array($id1,$cle,"En Attente"));
        $id2 = $this->bdd->lastInsertId();


        // Creation profil
        $req = $this->bdd->prepare("INSERT INTO profil VALUES (?,?,?,?)");
        $req->execute(array($id1,"Inactif",0,"Theme1"));


        // Envoi mail avec lien vers la page de confirm avec mail et cle
        $lien = "https://ufrsciencestech.u-bourgogne.fr/~ag044096/lol/PHP"."/confirmationInscription.php?mail=".$email."&cle=".$cle;

        $to      = $email;
        $subject = 'Inscription Go';
        $message = 'Pour valider votre inscription : </br> '.$lien;
        $headers = 'From: ' . "\r\n" .
        'Reply-To: ' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
      }

      if(is_null($id2))
      {
        return false;
      }
      return true;
    }

    // Retourne vrai si un utilisateur existe deja avec pseudo ou adresse mail (au choix)
    public function ExistsUser($var,$type)
    {
      $req = $this->bdd->prepare("SELECT count(*) as nb FROM utilisateur WHERE ".$type."=?");
      $req->execute(array($var));

      $res = $req->fetch();

      if($res["nb"]==0)
      {
        return false;
      }

      return true;
    }

    public function identification($mail,$pass)
    {
      $req3 = $this->bdd->prepare("SELECT count(idUtil) as nb FROM utilisateur,profil WHERE Statut='Actif' AND Mail=? AND idUtil=Util");
      $req3->execute(array($mail));

      $res3 = $req3->fetch();

      if($res3["nb"]==0)
      {
        return [3,-1];
      }

      $req = $this->bdd->prepare("SELECT idUtil, Password FROM utilisateur WHERE Mail=?");
      $req->execute(array($mail));

      $res = $req->fetch();
      $hash = $res["Password"];

      $id = $res["idUtil"];

      if(password_verify($pass,$hash))
      {
        return [0,$id];
      }
      return [2,-1];
    }

    public function confirmationInscription($cle,$mail)
    {
      $req = $this->bdd->prepare("UPDATE valid SET Etat='OK' WHERE Util=? AND `Key`=? ");
      $req->execute(array($this->getId($mail,"Mail"),$cle));

      $res = $req->rowCount();

      // Si mail confirmé on active le profil
      if($res==1)
      {
        $req2 = $this->bdd->prepare("UPDATE profil SET Statut='Actif' WHERE Util=?");
        $req2->execute(array($this->getId($mail,"Mail")));
      }



      return $res;
    }
  }

?>
