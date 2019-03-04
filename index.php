<?php
session_start();

//multilingue
if (!isset($_SESSION['lang'])) {
  $_SESSION['lang'] = "fr";
}
include "multilingue/multilingue.php";
loadLanguageFromSession($_SESSION['lang']);
?>

<!doctype html>
<html class="no-js">

<link rel="stylesheet" type="text/css" href="css/choixDriver/main.css">
<?php include "includehtml/head.html" ?>

<body>
  <!-- header section -->
  <?php

  require 'Class/Autoloader.php';
  App\Autoloader::register();
  $bdd = new App\Database('rip');
  $backOffice=0;
  $type = 0;
  $navbar = new App\Navbar($backOffice,$type);
  $navbar->navbar();

  ?>

  <!-- Get a quote section -->
  <section  class="section quote">
    <div class="container">
      <div class="col-md-8 col-md-offset-2 text-center">
        <h3><?php echo _TITRE_BODY?></h3>
        <a href="#" class="btn btn-large"><?php echo _TITRE_BOUTTON ?></a> </div>
      </div>
    </section>

    <!-- Get a quote section -->
    <div class="container p-1" style="border-radius: 10px; background-color: #2F2E33">
      <br>
      <div class="row mt-md-1">
        <div class="col-md-4 blue col-md-offset-4 text-center">
          <div class="list-group-item" style="background-color: #D5D6D2;">
            <h3 class="display-4">Nos 3 meilleurs chauffeurs</h3>
          </div>
        </div>
      </div>
      <br>
      <div class="container">
        <div class="row">

        <!-- Affichage des meilleurs chauffeurs -->
        <?php
        // Affichage d'un service
        $chauffeurs = $bdd->queryPrepareForWhile('SELECT * FROM collaborateurs WHERE metier="chauffeur" ORDER BY rating DESC LIMIT 3',$bdd);
        $driverNumber = $bdd->queryOne('SELECT COUNT(*) AS count FROM collaborateurs WHERE metier="chauffeur"',$bdd);

        $i=1;

        while($unChauffeur = $chauffeurs->fetch())
        {
          $car=App\Chauffeur::getCar($unChauffeur["idCollaborateurs"],$bdd);
          $chauffeur = new App\Chauffeur($unChauffeur["idCollaborateurs"],$unChauffeur["email"],$unChauffeur["last_name"],$unChauffeur["first_name"],$unChauffeur["metier"],$unChauffeur["prixCollaborateur"],
          $unChauffeur["dateEmbauche"],$unChauffeur["ville"],$unChauffeur["heuresTravailees"],$unChauffeur["rating"],$unChauffeur["ratingNumber"],$car["carId"],$car["carBrand"],$car["carModel"],$car["carColor"],$car["nbPlaces"]);
          ?>
          <div class="col-md-4">
            <div class="list-group-item" style="background-color: #D5D6D2;">
              <?php //echo $i?>
              <h3><?php echo $chauffeur->getFirst_name()." ".$chauffeur->getLast_name();?></h3>
              <h6>Rang du chaffeur: <?php echo $i." / ".$driverNumber["count"]; ?></h6>
              <h6>ID: <?php echo $chauffeur->getIdCollaborateur(); ?> | Prix: <?php echo $chauffeur->getPrixCollaborateur()."€ / Km | Note: ".$chauffeur->getRating()."/5 sur ".$chauffeur->getRatingNumber()." votes" ?></h6>
              <!-- Button trigger modal -->
              <div class="center-block">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $i ?>">
                  Infos chauffeur
                </button>
              </div>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $i ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel<?php echo $i ?>"><?php echo $chauffeur->getFirst_name()." ".$chauffeur->getLast_name();?></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
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
                            <li><?php echo "Places : ".$chauffeur->getCarSeats(); ?></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
      $i++;
      }
      ?>
    </div>
    <!-- Get a quote section -->
    <section  class="section quote">
      <div class="container">
        <div class="col-md-8 col-md-offset-2 text-center">
          <h3><?php echo "Je suis dans l'accueil de R.I.P, <br> le truc fait de la merde au dessus :cry:" ?></h3>
          <a href="#" class="btn btn-large"><?php echo _TITRE_BOUTTON ?></a> </div>
        </div>
      </section>


  <br>
  <?php include "includehtml/footer.php"; ?>
</body>
</html>
