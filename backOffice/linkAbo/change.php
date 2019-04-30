<?php
require_once 'functionLinkAbo.php';
if (isset($_POST["edit"])) {
  edit($_POST["id"],
  $_POST["idAbonnement"],
  $_POST["idClient"],
  $_POST["idEntreprise"],
  $_POST["dateDebut"],
  $_POST["dateFin"]
);
header("location: backOfficeLinkAbo.php");
}

if (isset($_POST["drop"])) {
  drop($_POST["id"]);
header("location: backOfficeLinkAbo.php");
}

if (isset($_POST["add"])){

  if(
    !(
    empty($_POST["idAbonnement"])&&
    empty($_POST["idClient"])&&
    empty($_POST["idEntreprise"])&&
    empty($_POST["dateDebut"])&&
    empty($_POST["dateFin"])
  )){

      add($_POST["idAbonnement"],
      $_POST["idClient"],
      $_POST["idEntreprise"],
      $_POST["dateDebut"],
      $_POST["dateFin"]
    );
    }
  header("location: backOfficeLinkAbo.php");
}


?>
