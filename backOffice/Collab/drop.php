<?php
session_start();
include '../../include/fonctionTrajet.php';

drop($_POST["id"]);
header("location: backOfficeTrajet.php");
?>
