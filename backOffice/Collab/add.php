<?php
session_start();
include '../../include/fonctionCollab.php';
if(!(
  empty($_POST["email"])&&
  empty($_POST["last_name"])&&
  empty($_POST["first_name"])&&
  empty($_POST["metier"])&&
  empty($_POST["description"])&&
  empty($_POST["prixCollaborateur"])&&
  empty($_POST["dateEmbauche"])&&
  empty($_POST["ville"])&&
  empty($_POST["heuresTravailees"])&&
  empty($_POST["rating"])&&
  empty($_POST["ratingNumber"])
  )
){

  add($_POST["email"],
  $_POST["last_name"],
  $_POST["first_name"],
  $_POST["metier"],
  $_POST["description"],
  $_POST["prixCollaborateur"],
  $_POST["dateEmbauche"],
  $_POST["ville"],
  $_POST["heuresTravailees"],
  $_POST["rating"],
  $_POST["ratingNumber"]);
}
header("location: backOfficeCollab.php");
?>
