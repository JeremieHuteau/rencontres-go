<?php
  class connexionDB
  {

    public $db = null;
    function __construct()
    {
      try{
        $this->db = new PDO('mysql:host=172.31.21.41;dbname=mt177991',"mt177991","mt177991");
      }
      catch(PDOException $e){
                echo "Erreur ! :".$e->getMessage()."<br/>";
                die();
      }
    }
  }
?>
