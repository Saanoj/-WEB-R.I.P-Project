<?php
require_once 'functionFactures.php';
if (isset($_POST["edit"])) {
  edit($_POST["id"],
  $_POST["idTrajet"],
  $_POST["prixTrajet"],
  $_POST["prixService"],
  $_POST["prixTotal"],
  $_POST["dateFacture"]
);
header("location: backOfficeFactures.php");
}

if (isset($_POST["drop"])) {
  drop($_POST["id"]);
header("location: backOfficeFactures.php");
}

if (isset($_POST["add"])){

  if(
    !(
    empty($_POST["idTrajet"])&&
    empty($_POST["prixTrajet"])&&
    empty($_POST["prixService"])&&
    empty($_POST["prixTotal"])&&
    empty($_POST["dateFacture"])
  )){

      add($_POST["idTrajet"],
      $_POST["prixTrajet"],
      $_POST["prixService"],
      $_POST["prixTotal"],
      $_POST["dateFacture"]
    );
    }
  header("location: backOfficeFactures.php");
}


?>
