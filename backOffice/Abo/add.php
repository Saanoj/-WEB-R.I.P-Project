<?php
session_start();
include '../../include/fonctionAbo.php';
if(!(
  empty($_POST["idClient"])&&
  empty($_POST["dateDebut"])&&
  empty($_POST["dateFin"])&&
  empty($_POST["typeAbonnement"])&&
  empty($_POST["isEngagement"])
  )
){

  add($_POST["idClient"],
  $_POST["dateDebut"],
  $_POST["dateFin"],
  $_POST["typeAbonnement"],
  $_POST["isEngagement"]
);
}
header("location: backOfficeAbo.php");
?>
