<?php


session_start();

?>

<!DOCTYPE html>
<html class="no-js">





<?php include "includehtml/head.html" ?>
<script src="js/homeCollab/main.js"></script>
<link rel="stylesheet" type="text/css" href="css/homeCollab/main.css"></link>
<link rel="stylesheet" href="css/profil/style.css">

<body class="bg-secondary">
  <!-- header section -->
  <?php


  require 'Class/Autoloader.php';
  App\Autoloader::register();
  $bdd = new App\Database('rip');
  $backOffice=0;
  $type = 0;
  $navbar = new App\Navbar($backOffice,$type);
  $navbar->navbar();

  $collaborateur = $bdd->queryOne('SELECT * FROM collaborateurs WHERE idCollaborateurs='.$_SESSION["id"].'');
  $user = $bdd->queryOne('SELECT * FROM users WHERE id='.$_SESSION["id"].'');

  //var_dump($user);
  //var_dump($collaborateur);
  ?>

    <div class="container bg-light pb-5">
      <div class="row">
        <div class="col-md-10 col-md-offset-2">
          <h1 class="page-header">Dashboard Collaborateur: <?php echo $collaborateur["metier"]; ?></h1>
          <div class="row placeholders border p-2 mr-1">
            <div class="col-md-3 placeholder pb-0 ">
              <div class="row">
                <?php if(empty($collaborateur["rating"])){ ?>
                  <div class="jumbotron display-1 mb-0 col-md-10 offset-1">∅</div>
                <?php }else{?>
                  <div class="jumbotron display-1 mb-0 col-md-10 offset-1"><?php echo $collaborateur["rating"] ?></div>
                <?php } ?>
              </div>
              <div class="row">
                <h4 class="h1 mt-0 text-align col-md-10 offset-1 border pb-3">Rating</h4>
              </div>
            </div>
            <div class="col-md-3 placeholder pb-0">
              <div class="row">
                <div class="jumbotron display-1 mb-0 col-md-10 offset-1"><?php echo $collaborateur["ratingNumber"] ?></div>
              </div>
              <div class="row">
                <h4 class="h1 mt-0 text-align col-md-10 offset-1  border">Nombre d'avis sur vous</h4>
              </div>
            </div>
            <div class="col-md-3 placeholder pb-0">
              <div class="row">
                <div class="jumbotron display-1 mb-0 col-md-10 offset-1"><?php echo $collaborateur["heuresTravailees"] ?></div>
              </div>
              <div class="row">
                <h4 class="h1 mt-0 text-align col-md-10 offset-1  border">Nombre d'Heures Travailees</h4>
              </div>
            </div>
            <div class="col-md-3 placeholder pb-0">
              <div class="row">
                <?php if($collaborateur["isOnline"] == 0){ ?>
                  <div id="statusLogo" class="jumbotron display-1 bg-warning text-center mb-0 col-md-10 offset-1">Off</div>
                <?php }else{?>
                  <div id="statusLogo" class="jumbotron display-1 bg-success text-center mb-0 col-md-10 offset-1">On</div>
                <?php } ?>
              </div>
              <div class="row">
                <h4 class="h1 mt-0 text-align col-md-10 offset-1 border pb-3">Statut</h4>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col-md-4 text-center">
          Changer ses infos profil:
        </div>
        <div class="col-md-4 text-center">
          Statut en/hors ligne
        </div>
        <div class="col-md-4 text-center">
          Détruire votre compte
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 text-center">
            <a href="profil.php" class="btn btn-primary col-md-12">Changer ses<br>informations profil</a>
        </div>
        <div class="col-md-4 text-center">

          <?php if($collaborateur["isOnline"] == 0){ ?>
            <button type="button" id="onlineButton" class="btn btn-success col-md-12" onclick="updateCollabStatus(1)">Se mettre<br>en ligne ajax</button>
          <?php }else{?>
            <button type="button" id="onlineButton" class="btn btn-warning col-md-12" onclick="updateCollabStatus(0)">Se mettre<br>hors ligne ajax</button>
          <?php } ?>
        </div>
        <div class="col-md-4 text-center">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-danger  col-md-12" data-toggle="modal" data-target="#exampleModal">
            Désactiver son<br>compte Collaborateur
          </button>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Désactivation du compte Collaborateur</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="h4">Attention,vous allez garder votre comte R.I.P normal. Mais vos informations collaborateur seront gardé. Vous pourrez revenir sur ce compte collaborateur en gardant vos infos actuelle, ou de les supprimer et en saisir de nouvelle si vous revenez vers nous.</div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <a href="verifDesactiverCollab.php" class="btn btn-danger">Désactiver</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr>

      <div class="row m-5">
        <?php
        if($collaborateur["metier"]=="chauffeur"){

          $car=App\Chauffeur::getCar($_SESSION["id"],$bdd);

          echo "<p class='display-4'>Votre voiture: ".$car["carBrand"]." ".$car["carModel"]." ".$car["carColor"]." ".$car["nbPlaces"]." place(s)</p>";
        } else {
          echo "<p class='display-4'>Profession: ".$collaborateur["metier"]."</p>";
        }


        ?>

      </div>
      <h2>Gérez vos trajet sur l'application android "RIPCollab"</h2>
      <div class="dropdown-divider">

      </div>
      <h3>Trajets à venir</h3>
      <div class="row m-5">

        <?php
        $idCollaborateur = $_SESSION["id"];
        $trips = [];

        $list = $bdd->query('SELECT * FROM trajet WHERE stateDriver = 0 AND idChauffeur = '.$idCollaborateur.' AND state = "Attente Collab" ORDER BY heureDebut');

        //if not a driver
        if (empty($list)) {
            $listLink = $bdd->query('SELECT idTrajet FROM linkservicetrajet WHERE (idService=11 OR idService=12 OR idService=13) AND idAnnexe = '.$idCollaborateur.' AND statut=0');
            //print_r($listLink);

            $list2 = array();
            foreach ($listLink as $key => $idTrajet) {
              $trip = $bdd->queryOne('SELECT * FROM trajet WHERE idTrajet = '.$idTrajet["idTrajet"].' AND state = "Attente Collab" ');
              array_push($list2,$trip);
            }
            $trips =  $list2;
        } else {
            $trips = $list;
        }

        if (empty($trips)) {
          echo "Aucun trajets dans cette liste";
        } else {
          foreach ($trips as $trip) {
            echo "<p>".$trip["start"]."</p>";
          }
        }


         ?>

      </div>
      <div class="dropdown-divider"></div>
      <h3>Anciens Trajets</h3>
      <div class="row m-5">

        <?php
        $idCollaborateur = $_SESSION["id"];
        $trips = [];

        $list = $bdd->query('SELECT * FROM trajet WHERE state = "Finis"  AND idChauffeur = '.$idCollaborateur.' ORDER BY heureDebut');

        //if not a driver
        if (empty($list)) {
            $listLink = $bdd->query('SELECT idTrajet FROM linkservicetrajet WHERE (idService=11 OR idService=12 OR idService=13) AND idAnnexe = '.$idCollaborateur.' AND statut=1');
            //print_r($listLink);

            $list2 = array();
            foreach ($listLink as $key => $idTrajet) {
              $trip = $bdd->queryOne('SELECT * FROM trajet WHERE idTrajet = '.$idTrajet["idTrajet"].' ');
              if($trip["state"] == "Finis"){
                  array_push($list2,$trip);
              }
            }
            $trips = $list2;
        } else {
          $trips = $list;
        }

        if (empty($trips)) {
          echo "Aucun trajets dans cette liste";
        } else {
          foreach ($trips as $trip) {
            echo "<p>".$trip["start"]."</p>";
          }
        }


         ?>

      </div>


    </div>


  <?php include "includehtml/footer.php"; ?>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBceTkjdStb2X5btD_NmC3yNsbXKIjCMc&callback=initMap"async defer></script>

</body>
</html>
