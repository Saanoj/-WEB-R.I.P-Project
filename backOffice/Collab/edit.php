<?php
session_start();
include '../../include/fonctionCollab.php';

edit($_POST["id"],
$_POST["email"],
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

header("location: backOfficeCollab.php");
?>
