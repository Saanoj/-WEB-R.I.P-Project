<?php
require_once 'functionRestaurants.php';
if (isset($_POST["edit"])) {
  edit($_POST["id"],
  $_POST["isDispo"],
  $_POST["nom"],
  $_POST["prix"],
  $_POST["horrairesDebut"],
  $_POST["horrairesFin"],
  $_POST["adresseRestaurant"],
  $_POST["villeRestaurant"]
);
header("location: backOfficeRestaurants.php");
}

if (isset($_POST["drop"])) {
  drop($_POST["id"]);
header("location: backOfficeRestaurants.php");
}

if (isset($_POST["add"])){

  if(
    !(
    empty($_POST["isDispo"])&&
    empty($_POST["nom"])&&
    empty($_POST["prix"])&&
    empty($_POST["horrairesDebut"])&&
    empty($_POST["horrairesFin"])&&
    empty($_POST["adresseRestaurant"])&&
    empty($_POST["villeRestaurant"])
  )){

      add($_POST["isDispo"],
      $_POST["nom"],
      $_POST["prix"],
      $_POST["horrairesDebut"],
      $_POST["horrairesFin"],
      $_POST["adresseRestaurant"],
      $_POST["villeRestaurant"]
    );
    }
  header("location: backOfficeRestaurants.php");
}


?>
