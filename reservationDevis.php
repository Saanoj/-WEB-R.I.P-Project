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
    session_start();

    require 'Class/Autoloader.php';
    App\Autoloader::register();
    $bdd = new App\Database('rip');
    $navbar = new App\Navbar();
    $backOffice=0;
    $navbar->navbar($backOffice);

    $form = new App\Form(array());

    /*
    if (isset($_POST[""])) {
      // code...
    }
    */
    $_SESSION["idTrajet"]=25;
    ?>
   <div class="container">
      <div class="row">
        <div class="offset-md-2 col-md-8">
          <div class="card" style="margin:50px 0">
             <!-- Default panel contents -->
             <div class="card-header">
               <h1 class="display-3">Devis</h1>
               <p><?php echo "idTrajet: ".$_SESSION["idTrajet"]."<br>Trajet: ". "<br>".$_SESSION["startTrajet"]. " => ".$_SESSION["endTrajet"] ?></p>
             </div>

             <div class="list-group list-group-flush">
               <h3 class="display-5 center-block">Services choisi</h3>
               <p>
               <?php
               //$idServices = $bdd->query('SELECT idService FROM linkServicetrajet WHERE idTrajet='.$_SESSION["idTrajet"].'');
               $idServices = $bdd->getPDO()->prepare('SELECT idService FROM linkServicetrajet WHERE idTrajet='.$_SESSION["idTrajet"].'');
               $idServices->execute();

               while($unIdService = $idServices->fetch())
               {
                 $service = $bdd->query('SELECT * FROM services WHERE idService='.$unIdService["idService"].'');
                 $service=$service[0];
                 //var_dump($service);
              ?>
                <?php echo $service["nomService"]; ?>

               <?php
               } ?>
               </p>
             </div>

             <div class="list-group list-group-flush">
               <h3 class="display-5 center-block">Votre chauffeur</h3>
               <p>
               <?php
               //$idServices = $bdd->query('SELECT idService FROM linkServicetrajet WHERE idTrajet='.$_SESSION["idTrajet"].'');
               $idChauffeur= $bdd->queryOne('SELECT idChauffeur FROM trajet WHERE idTrajet='.$_SESSION["idTrajet"].'');


               $unChauffeur= $bdd->queryOne('SELECT * FROM collaborateurs WHERE idCollaborateurs='.$idChauffeur["idChauffeur"].'');
               var_dump($unChauffeur);
               $car=App\Chauffeur::getCar($unChauffeur["idCollaborateurs"],$bdd);

               $chauffeur = new App\Chauffeur($unChauffeur["idCollaborateurs"],$unChauffeur["email"],$unChauffeur["last_name"],$unChauffeur["first_name"],$unChauffeur["metier"],$unChauffeur["prixCollaborateur"],
                                             $unChauffeur["dateEmbauche"],$unChauffeur["ville"],$unChauffeur["heuresTravailees"],$car["carId"],$car["carBrand"],$car["carModel"],$car["carColor"]);
               ?>

                <?php echo $idChauffeur["nomService"]; ?>
                <li class="list-group-item">
                  <?php //echo $i?>
                  <h3><?php echo $chauffeur->getFirst_name()." ".$chauffeur->getLast_name();?></h3>
                  <h6>id du Chauffeur: <?php echo $chauffeur->getIdCollaborateur(); ?> Prix: <?php $chauffeur->getPrixCollaborateur()." / Km  // AJOUTER SYSTEME PHOTO + SYSTEME ETOILES" ?></h6>
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

                  <div class="funkyradio-primary col-md-6 center-block">
                      <input type="radio" name="idChauffeur" id="radio<?php echo $i ?>" value="<?php echo $chauffeur->getIdCollaborateur() ?>" checked/>
                      <label for="radio<?php echo $i ?>">Choisir ce chauffeur</label>
                  </div>
                </li>


               </p>
             </div>

          </div>
        </div>
      </div>
    </div>

    <?php include "includehtml/footer.html" ?>
  </body>
</html>
