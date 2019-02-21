<?php
session_start();
include '../../include/fonction.php';

edit($_POST["id"],$_POST["email"], $_POST["first_name"], $_POST["last_name"], $_POST["birthday"], $_POST["gender"]);
header("location: backOfficeUsers.php");
?>
