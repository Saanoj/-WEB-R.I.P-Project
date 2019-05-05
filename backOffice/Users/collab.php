<?php
session_start();
include 'fonction.php';
collab($_POST["id"],$_POST["collab"]);
header("location: backOfficeUsers.php");
?>
