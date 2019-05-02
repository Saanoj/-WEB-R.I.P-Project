<?php
require_once 'functionRemuneration.php';
if (isset($_POST["edit"])) {
  edit($_POST["id"],
  $_POST["idCollab"],
  $_POST["idTrajet"],
  $_POST["Price"]
);
header("location: backOfficeRemuneration.php");
}

if (isset($_POST["drop"])) {
  drop($_POST["id"]);
header("location: backOfficeRemuneration.php");
}

if (isset($_POST["add"])){

  if(
    !(
    empty($_POST["idCollab"])&&
    empty($_POST["idTrajet"])&&
    empty($_POST["Price"])
  )){

      add($_POST["idCollab"],
      $_POST["idTrajet"],
      $_POST["Price"]);
    }
  header("location: backOfficeRemuneration.php");
}


?>
