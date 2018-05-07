<?php
  class connexionDB
  {

    public $db = null;
    function __construct()
    {
      try{
        $this->db = new PDO('mysql:host=172.31.21.41;dbname=ag044096','ag044096','ag044096');
      }
      catch(PDOException $e){
                echo "Erreur ! :".$e->getMessage()."<br/>";
                die();
      }
    }
  }
?>
