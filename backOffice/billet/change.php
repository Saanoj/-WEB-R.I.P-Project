<?php
require_once 'functionBillet.php';
if (isset($_POST["edit"])) {
  edit($_POST["id"],
  $_POST["nom"],
  $_POST["isValide"],
  $_POST["villeBillet"],
  $_POST["prix"]
);
header("location: backOfficeBillet.php");
}

if (isset($_POST["drop"])) {
  drop($_POST["id"],
);
header("location: backOfficeBillet.php");
}

if (isset($_POST["add"])){

  if(
    !(
    empty($_POST["nom"])&&
    empty($_POST["isValide"])&&
    empty($_POST["villeBillet"])&&
    empty($_POST["prix"])
  )){

      add($_POST["nom"],
      $_POST["isValide"],
      $_POST["villeBillet"],
      $_POST["prix"]);
    }
  //header("location: backOfficeBillet.php");
}


?>
