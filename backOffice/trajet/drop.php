<?php
session_start();
include '../../include/fonctionCollab.php';

drop($_POST["id"]);
header("location: backOfficeCollab.php");
?>
