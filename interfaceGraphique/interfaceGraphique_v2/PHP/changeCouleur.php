<?php 
session_start();
include("connect.php");
  $theme = $_POST["theme"];
  $sql = "UPDATE profil SET Theme='".$theme."' WHERE Utilisateur=1";
  $req = $dbh->query($sql);
  echo $theme;
?> 