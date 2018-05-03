<?php
  class connexionDB
  {

    public $db = null;
    function __construct()
    {
      try{
        $dsn = 'ag044096';
        $user = 'ag044096';
        $password = 'ag044096';
        $hst='172.31.21.41';
        //$db = new PDO("mysql:host=$hst;dbname=$dsn","$user", "$password");

        $this->db = new PDO('mysql:host=172.31.21.41;dbname=ag044096','ag044096','ag044096');
      }
      catch(PDOException $e){
                echo "Erreur ! :".$e->getMessage()."<br/>";
                die();
      }
    }
  }
?>
