<?php
session_start();
require_once 'fonction.php';
admin($_POST["id"],$_POST["admin"]);
header("location: backOfficeUsers.php");
?>
