<?php
session_start();
include '../../include/fonctionCollab.php';

add($_POST["id"],$_POST["email"], $_POST["first_name"], $_POST["last_name"], $_POST["metier"], $_POST["prixCollaborateur"],$_POST["dateEmbauche"],$_POST["ville"],$_POST["heuresTravailees"]);

header("location: backOfficeCollab.php");
?>
