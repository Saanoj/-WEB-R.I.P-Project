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
<script src="js/index/main.js"></script>


<?php include "includehtml/head.html" ?>

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

  ?>
  <br>
  <div class="col-md-6 offset-3" id="map"></div>


  <!-- Get a quote section -->
  <div class="section">
    <div class="container">
      <div class="col-md-8 offset-2 text-center">
        <h3 class="h3"><?php echo _TITRE_BODY?></h3>
        <a href="#" class="btn btn-success"><?php echo _TITRE_BOUTTON ?></a>
      </div>
    </div>
  </div>

  <!-- Get a quote section -->
  <div class="container" style="border-radius: 10px; background-color: #2F2E33; padding: 10px;">
    <br>
    <div class="row mt-md-1">
      <div class="col-md-8 offset-2 text-center">
        <div class="list-group-item" style="background-color: #D5D6D2;">
          <h3 class="display-4">Nos 3 meilleurs chauffeurs</h3>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-1">

      </div>
      <?php
      // Affichage d'un service
      $chauffeurs = $bdd->queryPrepareForWhile('SELECT * FROM collaborateurs WHERE metier="chauffeur" ORDER BY rating DESC LIMIT 3',$bdd);
      $i=0;

      while($unChauffeur = $chauffeurs->fetch())
      {
        $car=App\Chauffeur::getCar($unChauffeur["idCollaborateurs"],$bdd);
        $chauffeur = new App\Chauffeur($unChauffeur["idCollaborateurs"],$unChauffeur["email"],$unChauffeur["last_name"],$unChauffeur["first_name"],$unChauffeur["metier"],$unChauffeur["prixCollaborateur"],
        $unChauffeur["dateEmbauche"],$unChauffeur["ville"],$unChauffeur["heuresTravailees"],$unChauffeur["rating"],$unChauffeur["ratingNumber"],$unChauffeur["description"],$car["carId"],$car["carBrand"],$car["carModel"],$car["carColor"],$car["nbPlaces"]);
        ?>
        <div class="col-md-3" style="border-radius: 10px; background-color: #D5D6D2;margin: 10px;padding: 10px;">

          <div class="container">
            <div class="">
              <h3 class="center-block"><?php echo $chauffeur->getFirst_name()." ".$chauffeur->getLast_name();?></h3>
              <h6>ID: <?php echo $chauffeur->getIdCollaborateur(); ?> | Prix: <?php echo $chauffeur->getPrixCollaborateur()."€ / Km | Note: ".$chauffeur->getRating()."/5 sur ".$chauffeur->getRatingNumber()." votes" ?></h6>
            </div>
            <div class="">
              <!-- Button trigger modal -->
              <div class="">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal<?php echo $i ?>">Infos</button>
              </div>
            </div>
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
                    <div class="col-md-4">
                      <h4>Infos: </h4>
                      <ul>
                        <li><?php echo "Ville d'operation: ".$chauffeur->getVille(); ?></li>
                        <li><?php echo "Heures Travailées: ".$chauffeur->getHeuresTravailees(); ?></li>
                        <li><?php echo "Date d'embauche: ".$chauffeur->getDateEmbauche(); ?></li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h4>Véhicule: </h4>
                      <ul>
                        <li><?php echo "Marque: ".$chauffeur->getCarBrand(); ?></li>
                        <li><?php echo "Modèle: ".$chauffeur->getCarModel(); ?></li>
                        <li><?php echo "Couleur: ".$chauffeur->getCarColor(); ?></li>
                        <li><?php echo "Places: ".$chauffeur->getCarSeats(); ?></li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h4>Description: </h4>
                      <p><?php echo $chauffeur->getDescription(); ?></p>
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
        <?php
        $i++;
      }
      ?>
    </div>
  </div>
  <?php if (isset($_SESSION["id"])) { ?>
  <div class="row m-5" id="join">
    <?php $isAdmin = $bdd->queryOne('SELECT * FROM users WHERE id='.$_SESSION["id"].''); ?>
    <div class="col-md-6 offset-3" style="border-radius: 10px; background-color: #2F2E33; padding: 10px;">
      <div class="col-md-8 blue offset-2 text-center">
        <?php if(isset($_SESSION["id"]) && !empty($_SESSION["id"]) && $isAdmin["isAdmin"]==0 ){ ?>
        <a class="btn btn-info display-4" href="inscriptionCollab.php">Joindre en tant<br>que collaborateur</a>
        <?php }else if($isAdmin["isAdmin"] !=0 ){ ?>
          <button class="btn btn-danger">Vous etes Admin, vous ne<br>pouvez pas devenir  collaborateur</button>
        <?php }else{ ?>
          <a class="btn btn-info display-4" href="inscription.php">Inscrivez vous pour nous<br>joindre en tant que collaborateur</a>
        <?php } ?>
      </div>
    </div>
  </div>
<?php }else{ ?>
  <br>
<?php } ?>

  <?php include "includehtml/footer.php"; ?>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBceTkjdStb2X5btD_NmC3yNsbXKIjCMc&callback=initMap"async defer></script>

</body>
</html>
