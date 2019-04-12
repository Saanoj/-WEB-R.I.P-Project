<?php
session_start();
include 'fonctionAbo.php';

drop($_POST["id"]);
header("location: backOfficeCollab.php");
?>
