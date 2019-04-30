<?php
require_once 'functionHotel.php';
if (isset($_POST["edit"])) {
  edit($_POST["id"],
  $_POST["nom"],
  $_POST["adresseHotel"]
);
header("location: backOfficeHotel.php");
}

if (isset($_POST["drop"])) {
  drop($_POST["id"]);
header("location: backOfficeHotel.php");
}

if (isset($_POST["add"])){

  if(
    !(
    empty($_POST["nom"])&&
    empty($_POST["adresseHotel"])
  )){

      add($_POST["nom"],
      $_POST["adresseHotel"]
    );
    }
  header("location: backOfficeHotel.php");
}


?>
