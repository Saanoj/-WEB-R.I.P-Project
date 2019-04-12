<?php
session_start();
include 'fonction.php';
admin($_POST["id"],$_POST["admin"]);
header("location: backOfficeUsers.php");
