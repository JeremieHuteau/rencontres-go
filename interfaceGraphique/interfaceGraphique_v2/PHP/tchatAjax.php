<?php
  ini_set('display_errors', 1);
  session_start();
  require("connect.php");

  $d = array();
  if(!isset($_SESSION["user"]) || empty($_SESSION["user"]) || !isset($_POST["action"]))
  {
    $d["erreur"] = "Vous devez être connecté pour utiliser le tchat";
  }
  else
  {
    extract($_POST);
    $user = $_SESSION["user"];
    /**
    * Action : addMessage
    * Permet l'ajout d'un message
    **/
    if($_POST["action"] == "addMessage")
    {
      try
      {
        $sql = "INSERT INTO messages(user,`message`,`date`) VALUES(?,?,?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($user,$message,time()));
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
        
        $data = $req->fetchAll(PDO::FETCH_ASSOC);

        $result = array();
        foreach($data as $row){
          array_push($result, $row["user"]);
          break;
        }
        $d["result"] = $result[0];

        $d["lastid"] = $data["id"];
      
        $d["erreur"]="ok";
      }
      catch (\Exception $e)
      {
        $d["erreur"]=$e->getMessage();
      }
    }
    echo json_encode($d);
  }
 ?>
