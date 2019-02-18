<?php
session_start();
include '../include/fonction.php';

editProjet($_POST["id"], $_POST["title"], $_POST["descc"], $_POST["but"],  $_POST["stat"], $_POST["idEtudiant"]);


header("location: backOfficeProjet.php");

?>
