<?php
session_start();
include 'fonctionAbo.php';

edit($_POST["idAbonnement"],
$_POST["typeAbonnement"],
$_POST["isEngagement"]
);

header("location: backOfficeAbo.php");
?>
