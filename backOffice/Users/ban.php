<?php
session_start();
include 'fonction.php';
ban($_GET["id"]);
header("location: backOfficeUsers.php");
