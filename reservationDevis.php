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
    $backOffice=3;
    $navbar = new App\Navbar($backOffice);
    $navbar->navbar();;

    $form = new App\Form(array());

    $trajet = unserialize($_SESSION['trajet']);
    /*
    if (isset($_POST[""])) {
      // code...
    }
    */
    ?>
   <div class="container">
      <div class="row">
        <div class="offset-md-2 col-md-8">
          <div class="card" style="margin:50px 0">
             <!-- Default panel contents -->
             <div class="card-header">
               <h1 class="display-3">Devis</h1>
               <?php $trajet->showInfosTrajet(); ?>
               <?php echo "<p>ID de votre trajet: ".$_SESSION["idTrajet"]."</p>" ?>
             </div>

             <div class="list-group list-group-flush">
               <h3 class="display-5 center-block">Services choisi</h3>
               <p class="center-block">
               <?php
               $idServices = $bdd->query('SELECT idService FROM linkServicetrajet WHERE idTrajet='.$_SESSION["idTrajet"].'');

               if (empty($idServices)) {
                 echo "Aucun services selectionnés";
               }else {
                 //var_dump($idServices);
                 foreach ($idServices as $unIdService) {
                   //var_dump($unIdService);
                   $service = $bdd->queryOne('SELECT * FROM services WHERE idService='.$unIdService["idService"].'');
                   $linkService = $bdd->queryOne('SELECT * FROM linkServicetrajet WHERE idService='.$unIdService["idService"].'');

                   //echo $linkService["idAnnexe"];
                   //var_dump($linkService);
                   if($unIdService["idService"] == 1){
                     $infoLinkService = $bdd->queryOne('SELECT * FROM restaurants WHERE idRestaurant='.$linkService["idAnnexe"].'');
                     $typeEtablissement="Restaurant";
                   }elseif ($unIdService["idService"] == 7) {
                     $infoLinkService = $bdd->queryOne('SELECT * FROM hotel WHERE idHotel='.$linkService["idAnnexe"].'');
                     $typeEtablissement="Hotel";
                   }elseif ($unIdService["idService"] == 8) {
                     $infoLinkService = $bdd->queryOne('SELECT * FROM billettourisme WHERE idBillet='.$linkService["idAnnexe"].'');
                     $typeEtablissement="Billet touristque";
                   }else {

                   }


                   if ($linkService["idAnnexe"] < 0) {
                     echo "ID: ".$service["idService"]." | ".$service["nomService"];
                   }else{
                     //var_dump($infoLinkService);
                     echo "ID: ".$service["idService"]." | ".$service["nomService"]." : ".$typeEtablissement." ".$infoLinkService["nom"]." | Quantitée: ".$linkService["quantite"]." places";
                   }
                   echo "<br><br>";
                 }
              }
              ?>
               </p>
             </div>

             <div class="list-group-item list-group-flush">
               <div class="">
                 <h3 class="center-block">Votre chauffeur</h3>
               </div>

               <p>
               <?php
               //$idServices = $bdd->query('SELECT idService FROM linkServicetrajet WHERE idTrajet='.$_SESSION["idTrajet"].'');
               $idChauffeur= $bdd->queryOne('SELECT idChauffeur FROM trajet WHERE idTrajet='.$_SESSION["idTrajet"].'');
               $unChauffeur= $bdd->queryOne('SELECT * FROM collaborateurs WHERE idCollaborateurs='.$idChauffeur["idChauffeur"].'');

               $car=App\Chauffeur::getCar($unChauffeur["idCollaborateurs"],$bdd);
               $chauffeur = new App\Chauffeur($unChauffeur["idCollaborateurs"],$unChauffeur["email"],$unChauffeur["last_name"],$unChauffeur["first_name"],$unChauffeur["metier"],$unChauffeur["prixCollaborateur"],
                                             $unChauffeur["dateEmbauche"],$unChauffeur["ville"],$unChauffeur["heuresTravailees"],$car["carId"],$car["carBrand"],$car["carModel"],$car["carColor"],$car["nbPlaces"]);
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
                      </ul>
                    </div>
                  </div>

                </li>

               </p>
             </div>
             <div class="list-group-item list-group-flush">
               <div class="">
                 <h3 class="center-block">Récapitulatif des prix</h3>
               </div>
               <p>
                 <ul>
                   <li>Prix chauffeur/trajet: <?php echo $chauffeur->getPrixCollaborateur()." €/Km " ?>* <?php echo $trajet->getDistance()." Km " ?>= <?php echo $trajet->getDistance()*$chauffeur->getPrixCollaborateur()." €" ?></li>
                   <li>Prix Services: </li>
                   <li></li>
                 </ul>
               </p>
               <p>
                 Prix total HT :
               </p>
             </div>
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
