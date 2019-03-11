<?php
session_start();
include '../../include/fonctionAbo.php';

edit($_POST["idClient"],
$_POST["dateDebut"],
$_POST["dateFin"],
$_POST["typeAbonnement"],
$_POST["isEngagement"]
);

header("location: backOfficeAbo.php");
?>
