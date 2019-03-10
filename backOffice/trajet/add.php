<?php
session_start();
include '../../include/fonctionTrajet.php';
if(!(
  empty($_POST["idClient"])&&
  empty($_POST["idChauffeur"])&&
  empty($_POST["heureDebut"])&&
  empty($_POST["heureFin"])&&
  empty($_POST["dateResevation"])&&
  empty($_POST["prixtrajet"])&&
  empty($_POST["debut"])&&
  empty($_POST["fin"])
  )
){

  add($_POST["idClient"],
  $_POST["idChauffeur"],
  $_POST["heureDebut"],
  $_POST["heureFin"],
  $_POST["dateResevation"],
  $_POST["prixtrajet"],
  $_POST["debut"],
  $_POST["fin"];
}
header("location: backOfficeTrajet.php");
?>
