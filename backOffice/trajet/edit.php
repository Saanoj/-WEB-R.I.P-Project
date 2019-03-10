<?php
session_start();
include '../../include/fonctionTrajet.php';

edit($_POST["id"],
$_POST["idClient"],
$_POST["idChauffeur"],
$_POST["heureDebut"],
$_POST["heureFin"],
$_POST["dateResevation"],
$_POST["prixtrajet"],
$_POST["debut"],
$_POST["fin"]
);

header("location: backOfficeTrajet.php");
?>
