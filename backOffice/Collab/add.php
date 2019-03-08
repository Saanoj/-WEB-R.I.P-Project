<?php
session_start();
include '../../include/fonctionCollab.php';
if(
  isset($_POST["email"])&&
  isset($_POST["last_name"])&&
  isset($_POST["first_name"])&&
  isset($_POST["metier"])&&
  isset($_POST["description"])&&
  isset($_POST["prixCollaborateur"])&&
  isset($_POST["dateEmbauche"])&&
  isset($_POST["ville"])&&
  isset($_POST["heuresTravailees"])&&
  isset($_POST["rating"])&&
  isset($_POST["ratingNumber"])
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
