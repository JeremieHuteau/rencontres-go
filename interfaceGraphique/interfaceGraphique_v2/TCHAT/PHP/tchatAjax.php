<?php
  ini_set('display_errors', 1);
  session_start();
  require("connect.php");

  $d = array();
  if(!isset($_SESSION["pseudo"]) || empty($_SESSION["pseudo"]) || !isset($_POST["action"]))
  {
    $d["erreur"] = "Vous devez être connecté pour utiliser le tchat";
  }
  else
  {
    extract($_POST);
    $pseudo = $_SESSION["pseudo"];
    /**
    * Action : addMessage
    * Permet l'ajout d'un message
    **/
    if($_POST["action"] == "addMessage")
    {
      try
      {
        $sql = "INSERT INTO messages(pseudo,`message`,`date`) VALUES(?,?,?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($pseudo,$message,time()));
        $d["erreur"] = "ok";
      }
      catch (\Exception $e)
      {
        echo $e->getMessage();
      }
    }
    

  /**
    * Action : getMessages
    * Permet l'affichage des derniers messages
    **/
    if($_POST["action"] == "getMessages")
    {
      try
      {
        $lastid = floor($lastid);
        $sql = "SELECT * FROM messages WHERE id > $lastid ORDER BY `date` ASC";
        $req = $dbh->query($sql);
        $d["result"] = "";
        $d["lastid"] = $lastid;
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $d["result"] .= '<p><strong>'.$data["pseudo"].'</strong>('.date("d/m/Y H:i:s", $data["date"]).') : '.htmlentities($data["message"]).'</p>';
            $d["lastid"] = $data["id"];
        }
        $d["erreur"]="ok";
      }
      catch (\Exception $e)
      {
        echo $e->getMessage();
      }
    }
    echo json_encode($d);
  
  }
 ?>
