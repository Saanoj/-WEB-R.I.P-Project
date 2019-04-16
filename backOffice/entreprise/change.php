<?php
require_once 'functionEntreprise.php';
if (isset($_POST["edit"])) {
  edit($_POST["id"],
  $_POST["nameEntreprise"],
  $_POST["numEntreprise"],
  $_POST["adresse"],
  $_POST["numSiret"],
  $_POST["idDirecteur"],
  $_POST["nbSalarie"],
  $_POST["pays"]
);
header("location: backOfficeEntreprise.php");
}

if (isset($_POST["drop"])) {
  drop($_POST["id"]);
header("location: backOfficeEntreprise.php");
}

if (isset($_POST["add"])){

  if(
    !(
    empty($_POST["nameEntreprise"])&&
    empty($_POST["numEntreprise"])&&
    empty($_POST["adresse"])&&
    empty($_POST["numSiret"])&&
    empty($_POST["idDirecteur"])&&
    empty($_POST["nbSalarie"])&&
    empty($_POST["pays"])
  )){

      add($_POST["nameEntreprise"],
      $_POST["numEntreprise"],
      $_POST["adresse"],
      $_POST["numSiret"],
      $_POST["idDirecteur"],
      $_POST["nbSalarie"],
      $_POST["pays"]
    );
    }
  header("location: backOfficeEntreprise.php");
}


?>
