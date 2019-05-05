<?php
session_start();
require_once 'fonction.php';
dirrec($_POST["id"],$_POST["dir"]);
header("location: backOfficeUsers.php");
?>
