<?php
session_start();
include 'fonctionCollab.php';

drop($_POST["id"]);
header("location: backOfficeCollab.php");
?>
