<?php
require_once 'functionServices.php';
if (isset($_POST["edit"])) {
  edit($_POST["id"],
  $_POST["nomService"],
  $_POST["prixService"],
  $_POST["categorie"],
  $_POST["description"]
);
header("location: backOfficeServices.php");
}

if (isset($_POST["drop"])) {
  drop($_POST["id"]);
header("location: backOfficeServices.php");
}

if (isset($_POST["add"])){

  if(
    !(
    empty($_POST["nomService"])&&
    empty($_POST["prixService"])&&
    empty($_POST["categorie"])&&
    empty($_POST["description"])
  )){

      add($_POST["nomService"],
      $_POST["prixService"],
      $_POST["categorie"],
      $_POST["description"]);
    }
  header("location: backOfficeServices.php");
}


?>
