<?php
require_once 'functionChambre.php';
if (isset($_POST["edit"])) {
  edit($_POST["id"],
  $_POST["typeChambre"],
  $_POST["idHotel"],
  $_POST["litsDispo"],
  $_POST["isDispo"]
);
header("location: backOfficeChambre.php");
}

if (isset($_POST["drop"])) {
  drop($_POST["id"]);
header("location: backOfficeChambre.php");
}

if (isset($_POST["add"])){

  if(
    !(
    empty($_POST["typeChambre"])&&
    empty($_POST["idHotel"])&&
    empty($_POST["litsDispo"])&&
    empty($_POST["isDispo"])
  )){

      add($_POST["typeChambre"],
      $_POST["idHotel"],
      $_POST["litsDispo"],
      $_POST["isDispo"]);
    }
  header("location: backOfficeChambre.php");
}


?>
