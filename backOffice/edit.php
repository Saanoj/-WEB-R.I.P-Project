<?php
session_start();
include '../include/fonction.php';

echo '  <script>console.log('.$_POST["pseudo"].'.value)</script>';
edit($_POST["mail"], $_POST["pseudo"], $_POST["birthday"], $_POST["gender"]);
header("location: backOffice.php");
?>
