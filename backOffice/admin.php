<?php
session_start();
include '../include/fonction.php';
admin($_POST["id"],$_POST["admin"]);
header("location: backOffice.php");
