<?php
require_once 'functionLinkService.php';
if (isset($_POST["edit"])) {
  edit($_POST["id"],
  $_POST["idTrajet"],
  $_POST["idService"],
  $_POST["idAnnexe"],
  $_POST["quantite"],
  $_POST["statut"],
  $_POST["dateStart"],
  $_POST["dateEnd"]
);
header("location: backOfficeLinkService.php");
}

if (isset($_POST["drop"])) {
  drop($_POST["id"]);
header("location: backOfficeLinkService.php");
}

if (isset($_POST["add"])){

  if(
    !(
    empty($_POST["idTrajet"])&&
    empty($_POST["idService"])&&
    empty($_POST["idAnnexe"])&&
    empty($_POST["quantite"])&&
    empty($_POST["statut"])&&
    empty($_POST["dateStart"])&&
    empty($_POST["dateEnd"])
  )){

      add($_POST["idTrajet"],
      $_POST["idService"],
      $_POST["idAnnexe"],
      $_POST["quantite"],
      $_POST["statut"],
      $_POST["dateStart"],
      $_POST["dateEnd"]
    );
    }
  header("location: backOfficeLinkService.php");
}


?>
