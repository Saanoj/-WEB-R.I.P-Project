<?php
session_start();
include '../include/fonction.php';
ban($_GET["id"]);
header("location: backOffice.php");
