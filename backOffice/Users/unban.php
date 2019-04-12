<?php
session_start();
include 'fonction.php';
unban($_GET["id"]);
header("location: backOfficeBannedUsers.php");
