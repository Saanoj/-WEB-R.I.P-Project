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
    ?>
   <div class="container">
      <div class="row">
        <div class="offset-md-3 col-md-6">
          <div class="card" style="margin:50px 0">
             <!-- Default panel contents -->
             <div class="card-header">
               <h1 class="display-3">Choisissez votre chauffeur</h1>
               <p><?php echo "idTrajet: ".$_SESSION["idTrajet"]."<br>Trajet: ". "<br>".$_SESSION["startTrajet"]. " => ".$_SESSION["endTrajet"] ?></p>
             </div>
            <form class="funkyradio list-group list-group-flush" method="post" action="verifyChauffeur.php">
              <?php
              // Affichage d'un service
              $chauffeurs = $bdd->getPDO()->prepare('SELECT * FROM collaborateurs WHERE metier="chauffeur"');
              $chauffeurs->execute();
              $i=0;

              while($unChauffeur = $chauffeurs->fetch())
              {
              $chauffeur = new App\Collaborateur($unChauffeur["idCollaborateurs"],$unChauffeur["email"],$unChauffeur["last_name"],$unChauffeur["first_name"],$unChauffeur["metier"],$unChauffeur["prixCollaborateur"],$unChauffeur["dateEmbauche"],$unChauffeur["ville"],$unChauffeur["heuresTravailees"]);
              ?>
              <li class="list-group-item">
                <?php echo $i?>
                <h3><?php echo $chauffeur->getFirst_name()." ".$chauffeur->getLast_name();?></h3>
                <h6>idService: <?php echo $chauffeur->getIdCollaborateur(); ?> Prix: <?php $chauffeur->getPrixCollaborateur()." / Km  // AJOUTER SYSTEME PHOTO + SYSTEME ETOILES" ?></h6>
                <h4>Infos: </h4>
                <ul>
                  <li><?php echo "Ville d'operation: ".$chauffeur->getVille(); ?></li>
                  <li><?php echo "Heures Travailées: ".$chauffeur->getHeuresTravailees(); ?></li>
                  <li><?php echo "Date d'embauche: ".$chauffeur->getDateEmbauche(); ?></li>
                </ul>
                <div class="funkyradio-primary col-md-6 center-block">
                    <input type="radio" name="radio" id="radio<?php echo $i ?>" checked/>
                    <label for="radio<?php echo $i ?>">Choisir ce chauffeur</label>
                </div>
              </li>
              <?php
              $i++;
              }
              ?>
              <li class="list-group-item">
                <div class="center-block">
                  <?php echo $form->submit(); ?>
                </div>
              </li>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php include "includehtml/footer.html" ?>
  </body>
</html>
