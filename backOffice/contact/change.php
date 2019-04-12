<?php
require_once 'functionContact.php';
if (isset($_POST["edit"])) {
  edit($_POST["id"],
  $_POST["idClient"],
  $_POST["nameClient"],
  $_POST["phoneNumber"],
  $_POST["messageContact"],
  $_POST["dateContact"]
);
header("location: backOfficeContact.php");
}

if (isset($_POST["drop"])) {
  drop($_POST["id"]);
header("location: backOfficeContact.php");
}

if (isset($_POST["add"])){

  if(
    !(
    empty($_POST["idClient"])&&
    empty($_POST["nameClient"])&&
    empty($_POST["phoneNumber"])&&
    empty($_POST["messageContact"])&&
    empty($_POST["dateContact"])
  )){

      add($_POST["idClient"],
      $_POST["nameClient"],
      $_POST["phoneNumber"],
      $_POST["messageContact"],
      $_POST["dateContact"]);
    }
  header("location: backOfficeContact.php");
}


?>
