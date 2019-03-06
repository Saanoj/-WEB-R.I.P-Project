<?php
session_start();

//multilingue
if (!isset($_SESSION['lang'])) {
  $_SESSION['lang'] = "fr";
}
include "multilingue/multilingue.php";
loadLanguageFromSession($_SESSION['lang']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Reservation de chauffeur</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Ride in pride">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/bootstrap4/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/main_styles.css">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/responsive.css">
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="css/choixDriver/main.css">


  <?php
  include 'includehtml/head.html'; ?>
</head>
<body>
  <?php


  require 'Class/Autoloader.php';
  App\Autoloader::register();
  $bdd = new App\Database('rip');
  $backOffice=0;
  $type = 1;
  $navbar = new App\Navbar($backOffice,$type);
  $navbar->navbar();

  $form = new App\Form(array());


  // ON VERIFIE LA DIFFERENCE D'HEURE ENTRE LE DEBUT ET LA FIN DU CRENEAU DE L"INTERPRETE
$_SESSION['startInterprete'];
$_SESSION['endInterprete'];
$hourInterprete = (strtotime($_SESSION['endInterprete']) - strtotime($_SESSION['startInterprete']));
$hourInterprete = $hourInterprete/3600;

// ON VERIFIE LA DIFFERENCE D'HEURE ENTRE LE DEBUT ET LA FIN DU CRENEAU DU COACH SPORTIF
$hourCoachSportif = (strtotime($_SESSION['endCoachSportif']) - strtotime($_SESSION['startCoachSportif']));
$hourCoachSportif = $hourCoachSportif/3600;

//  ON VERIFIE LA DIFFERENCE D'HEURE ENTRE LE DEBUT ET LA FIN DU CRENEAU DU COACH CULTURE
$hourCoachCulture = (strtotime($_SESSION['endCoachCulture']) - strtotime($_SESSION['startCoachCulture']));
$hourCoachCulture = $hourCoachCulture/3600;

  // On recupere l'objet trajet contenant nos infos de trajet depuis la session
  $trajet = unserialize($_SESSION['trajet']);

  ?>
  <div class="container">
    <div class="row">
      <div class="offset-md-2 col-md-8">
        <div class="card" style="margin:50px 0">

          <!-- Infos Trajet -->
          <div class="card-header">
            <h1 class="display-3">Devis</h1>
            <?php $trajet->showInfosTrajet(); ?>
            <?php echo "<p>ID de votre trajet: ".$_SESSION["idTrajet"]."</p>" ?>
          </div>

          <!-- Info choix des services -->
          <div class="list-group list-group-flush">
            <h3 class="display-5 center-block">Services choisi</h3>
            <p class="center-block">
              <?php
              //on recupere les id des services choisis sur ce trajet
              $idServices = $bdd->query('SELECT idService FROM linkServicetrajet WHERE idTrajet='.$_SESSION["idTrajet"].'');

              if (empty($idServices)) {
                echo "Aucun services selectionnés";
              }else {
                //on boucle les id des services choisis
                foreach ($idServices as $unIdService) {

                  //on recupere les infos du service en fonction de son id
                  $service = $bdd->queryOne('SELECT * FROM services WHERE idService='.$unIdService["idService"].'');
                  $linkService = $bdd->queryOne('SELECT * FROM linkServicetrajet WHERE idService='.$unIdService["idService"].' AND idTrajet='.$_SESSION["idTrajet"].'');


                  //choix en fonciton du type de service special
                  if($unIdService["idService"] == 1){
                    $infoLinkService = $bdd->queryOne('SELECT * FROM restaurants WHERE idRestaurant='.$linkService["idAnnexe"].'');
                    $typeEtablissement="Restaurant";
                  }elseif ($unIdService["idService"] == 7) {
                    $infoLinkService = $bdd->queryOne('SELECT * FROM hotel WHERE idHotel='.$linkService["idAnnexe"].'');
                    $typeEtablissement="Hotel";
                  }elseif ($unIdService["idService"] == 8) {
                    $infoLinkService = $bdd->queryOne('SELECT * FROM billettourisme WHERE idBillet='.$linkService["idAnnexe"].'');
                    $typeEtablissement="Billet touristque"; }
                    elseif ($unIdService["idService"] == 11) {
                      $infoLinkService = $bdd->queryOne('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].'');
                      $typeEtablissement="Interprete";
                  }
                  elseif ($unIdService["idService"] == 12) {
                    $infoLinkService = $bdd->queryOne('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].'');
                    $typeEtablissement="Coach Sportif";
                }
                elseif ($unIdService["idService"] == 13) {
                  $infoLinkService = $bdd->queryOne('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].'');
                  $typeEtablissement="Coach Culture";
              }else {

                  }

                  //Affichage des infos
                  if ($linkService["idAnnexe"] < 0) {
                    echo "ID: ".$service["idService"]." | ".$service["nomService"];
                  }
                  else if ($linkService["idService"] == 11) {
                    echo "ID: ".$infoLinkService["idCollaborateurs"]." | ".$service["nomService"]." : ".$infoLinkService["last_name"]." ".$infoLinkService["first_name"]." | Quantitée: ".$linkService["quantite"]." interprètes";
                  }
                  else if ($linkService["idService"] == 12) {
                    echo "ID: ".$infoLinkService["idCollaborateurs"]." | ".$service["nomService"]." : ".$infoLinkService["last_name"]." ".$infoLinkService["first_name"]." | Quantitée: ".$linkService["quantite"]." Coachs Sportifs";
                  }
                  else if ($linkService["idService"] == 13) {
                    echo "ID: ".$infoLinkService["idCollaborateurs"]." | ".$service["nomService"]." : ".$infoLinkService["last_name"]." ".$infoLinkService["first_name"]." | Quantitée: ".$linkService["quantite"]." Coachs Cultures";
                  }
                  else{
                    echo "ID: ".$service["idService"]." | ".$service["nomService"]." : ".$typeEtablissement." ".$infoLinkService["nom"]." | Quantitée: ".$linkService["quantite"]." places";
                  }
                  echo "<br><br>";
                }
              }
              ?>
            </p>
          </div>

          <!-- Info choix des services -->
          <div class="list-group-item">
            <div class="list-group list-group-flush">
              <h3 class="display-5 center-block">Votre chauffeur</h3>
              <p>
                <?php
                //$idServices = $bdd->query('SELECT idService FROM linkServicetrajet WHERE idTrajet='.$_SESSION["idTrajet"].'');
                $idChauffeur= $bdd->queryOne('SELECT idChauffeur FROM trajet WHERE idTrajet='.$_SESSION["idTrajet"].'');
                $unChauffeur= $bdd->queryOne('SELECT * FROM collaborateurs WHERE idCollaborateurs='.$idChauffeur["idChauffeur"].'');

                $car=App\Chauffeur::getCar($unChauffeur["idCollaborateurs"],$bdd);
                $chauffeur = new App\Chauffeur($unChauffeur["idCollaborateurs"],$unChauffeur["email"],$unChauffeur["last_name"],$unChauffeur["first_name"],$unChauffeur["metier"],$unChauffeur["prixCollaborateur"],
                $unChauffeur["dateEmbauche"],$unChauffeur["ville"],$unChauffeur["heuresTravailees"],$unChauffeur["rating"],$unChauffeur["ratingNumber"],$car["carId"],$car["carBrand"],$car["carModel"],$car["carColor"],$car["nbPlaces"]);
                ?>
                <li class="list-group">
                  <?php //echo $i?>
                  <h4><?php echo $chauffeur->getFirst_name()." ".$chauffeur->getLast_name();?></h4>
                  <h6>id du Chauffeur: <?php echo $chauffeur->getIdCollaborateur(); ?> Prix: <?php echo $chauffeur->getPrixCollaborateur()."€ / Km  // AJOUTER SYSTEME PHOTO + SYSTEME ETOILES" ?></h6>
                  <div class="row">
                    <div class="col-md-6">
                      <h4>Infos: </h4>
                      <ul>
                        <li><?php echo "Ville d'operation: ".$chauffeur->getVille(); ?></li>
                        <li><?php echo "Heures Travailées: ".$chauffeur->getHeuresTravailees(); ?></li>
                        <li><?php echo "Date d'embauche: ".$chauffeur->getDateEmbauche(); ?></li>
                      </ul>
                    </div>
                    <div class="col-md-6">
                      <h4>Véhicule: </h4>
                      <ul>
                        <li><?php echo "Marque: ".$chauffeur->getCarBrand(); ?></li>
                        <li><?php echo "Modèle: ".$chauffeur->getCarModel(); ?></li>
                        <li><?php echo "Couleur: ".$chauffeur->getCarColor(); ?></li>
                        <li><?php echo "Places: ".$chauffeur->getCarSeats(); ?></li>
                      </ul>
                    </div>
                  </div>
                </li>
              </p>
            </div>
          </div>

          <!-- Recapitulatif des prix -->
          <div class="list-group-item">
            <div class="list-group list-group-flush">
              <h3 class="center-block">Récapitulatif des prix</h3>
              <p>
                <ul>
                  <div class="border border-primary p-3 m-1">
                    <label>Prix chauffeur/trajet:</label>
                    <li><?php echo $chauffeur->getPrixCollaborateur()." €/Km " ?>* <?php echo $trajet->getDistance()." Km " ?>= <?php echo $trajet->getDistance()*$chauffeur->getPrixCollaborateur()." €"; $totalChauffeurTrajet=$trajet->getDistance()*$chauffeur->getPrixCollaborateur(); ?></li>
                    <?php echo "<p>Total Chauffeur: ".$totalChauffeurTrajet."€ TTC</p>"; ?>
                  </div>
                  <div class="border border-primary p-3 m-1">
                    <label>Prix services:</label>
                    <?php
                    if (empty($idServices)) {
                      echo "Aucun services selectionnés";
                    }else {
                      //on boucle les id des services choisis
                      $totalServices = 0;
                      foreach ($idServices as $unIdService) {
                        //on recupere les infos du service en fonction de son id
                        $service = $bdd->queryOne('SELECT * FROM services WHERE idService='.$unIdService["idService"].'');
                        $linkService = $bdd->queryOne('SELECT * FROM linkServicetrajet WHERE idService='.$unIdService["idService"].' AND idTrajet='.$_SESSION["idTrajet"].'');

                        //choix en fonciton du type de service special
                        if($unIdService["idService"] == 1){
                          $infoLinkService = $bdd->queryOne('SELECT * FROM restaurants WHERE idRestaurant='.$linkService["idAnnexe"].'');
                          $typeEtablissement="Restaurant";
                        }elseif ($unIdService["idService"] == 7) {
                          $infoLinkService = $bdd->queryOne('SELECT * FROM hotel WHERE idHotel='.$linkService["idAnnexe"].'');
                          $typeEtablissement="Hotel";
                        }elseif ($unIdService["idService"] == 8) {
                          $infoLinkService = $bdd->queryOne('SELECT * FROM billettourisme WHERE idBillet='.$linkService["idAnnexe"].'');
                          $typeEtablissement="Billet touristque";
                        }elseif ($unIdService["idService"] == 11) {
                          $infoLinkService = $bdd->queryOne('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].'');
                          $typeEtablissement="Interprete";
                         }
                         elseif ($unIdService["idService"] == 12) {
                          $infoLinkService = $bdd->queryOne('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].'');
                          $typeEtablissement="Coachs Sportifs";
                         }
                         elseif ($unIdService["idService"] == 13) {
                          $infoLinkService = $bdd->queryOne('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].'');
                          $typeEtablissement="Coachs Cultures";
                         }
                       
                       else {
                           }
                        ?><li><?php
                        //Affichage des infos
                        if ($linkService["idAnnexe"] < 0) {
                          echo $service["nomService"].": ".$service["prixService"]."€";
                          $totalServices += $service["prixService"];
                        }
                        else if ($linkService["idService"] == 11) {
                          echo "ID: ".$infoLinkService["idCollaborateurs"]." | ".$service["nomService"]." : ".$infoLinkService["last_name"]." ".$infoLinkService["first_name"]." | Quantitée: ".$linkService["quantite"]." interprètes";
                          $totalServices += ($infoLinkService["prixCollaborateur"]*$linkService["quantite"]*$hourInterprete);

                        }
                        else if ($linkService["idService"] == 12) {
                          echo "ID: ".$infoLinkService["idCollaborateurs"]." | ".$service["nomService"]." : ".$infoLinkService["last_name"]." ".$infoLinkService["first_name"]." | Quantitée: ".$linkService["quantite"]." Coachs Sportifs";
                          $totalServices += ($infoLinkService["prixCollaborateur"]*$linkService["quantite"]*$hourCoachSportif);

                        }
                        else if ($linkService["idService"] == 13) {
                          echo "ID: ".$infoLinkService["idCollaborateurs"]." | ".$service["nomService"]." : ".$infoLinkService["last_name"]." ".$infoLinkService["first_name"]." | Quantitée: ".$linkService["quantite"]." Coachs Sportifs";
                          $totalServices += ($infoLinkService["prixCollaborateur"]*$linkService["quantite"]*$hourCoachCulture);

                        }
                        else{
                          echo $service["nomService"].": ".$typeEtablissement." ".$infoLinkService["nom"]." | ".$infoLinkService["prix"]."€ * ".$linkService["quantite"]." places + ".$service["prixService"]."€  = ".($infoLinkService["prix"]*$linkService["quantite"]+$service["prixService"])."€";
                          $totalServices += ($infoLinkService["prix"]*$linkService["quantite"]+$service["prixService"]);
                        }
                        ?></li><?php

                      }
                      echo "<p>Total Services: ".$totalServices."€ TTC</p>";
                    }
                    ?>
                  </div>
                </ul>
              </p>
              <!-- Afficher le prix total-->
              <?php echo "<p>Prix total TTC: ".($totalServices+$totalChauffeurTrajet)."€ TTC</p>"; ?>
            </div>
          </div>

          <!-- Validation -->
          <div class="row list-group-item center-block">
            <div class="center-block">
              <?php echo $form->submit(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include "includehtml/footer.php" ?>
</body>
</html>
