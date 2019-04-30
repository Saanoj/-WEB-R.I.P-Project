<?php
require_once 'functionTrajet.php';
if (isset($_POST["edit"])) {
  edit($_POST["id"],
  $_POST["idClient"],
  $_POST["idChauffeur"],
  $_POST["heureDebut"],
  $_POST["heureFin"],
  $_POST["dateResevation"],
  $_POST["distanceTrajet"],
  $_POST["prixtrajet"],
  $_POST["debut"],
  $_POST["fin"],
  $_POST["duration"],
  $_POST["state"],
  $_POST["stateDriver"]
);
header("location: backOfficeTrajet.php");
}

if (isset($_POST["drop"])) {
  drop($_POST["id"]);
header("location: backOfficeTrajet.php");
}

if (isset($_POST["add"])){

  if(
    !(
    empty($_POST["idClient"])&&
    empty($_POST["idChauffeur"])&&
    empty($_POST["heureDebut"])&&
    empty($_POST["heureFin"])&&
    empty($_POST["dateResevation"])&&
    empty($_POST["distanceTrajet"])&&
    empty($_POST["prixtrajet"])&&
    empty($_POST["debut"])&&
    empty($_POST["fin"])&&
    empty($_POST["duration"])&&
    empty($_POST["state"])&&
    empty($_POST["stateDriver"])
  )){
      add($_POST["idClient"],
      $_POST["idChauffeur"],
      $_POST["heureDebut"],
      $_POST["heureFin"],
      $_POST["dateResevation"],
      $_POST["distanceTrajetdistanceTrajet"],
      $_POST["prixtrajet"],
      $_POST["debut"],
      $_POST["fin"],
      $_POST["duration"],
      $_POST["state"],
      $_POST["stateDriver"]
    );
    }
  header("location: backOfficeTrajet.php");
}


?>
