<?php
session_start();
include 'fonctionAbo.php';
if(!(
  empty($_POST["typeAbonnement"])&&
  empty($_POST["isEngagement"])
  )
){

  add(
  $_POST["typeAbonnement"],
  $_POST["isEngagement"]
);
}
header("location: backOfficeAbo.php");
?>
