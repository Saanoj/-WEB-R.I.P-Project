<?php
require_once 'functionDevis.php';
if (isset($_POST["edit"])) {
  edit($_POST["id"],
  $_POST["isValide"],
  $_POST["prixTrajet"],
  $_POST["prixServices"]
);
header("location: backOfficeDevis.php");
}

if (isset($_POST["drop"])) {
  drop($_POST["id"]);
header("location: backOfficeDevis.php");
}

if (isset($_POST["add"])){

  if(
    !(
    empty($_POST["isValide"])&&
    empty($_POST["prixTrajet"])&&
    empty($_POST["prixServices"])
  )){

      add($_POST["isValide"],
      $_POST["prixTrajet"],
      $_POST["prixServices"]);
    }
  header("location: backOfficeDevis.php");
}


?>
