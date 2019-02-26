<!DOCTYPE html>
<html lang="fr">
  <head>
  <title>Reservation de services</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Ride in pride">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/bootstrap4/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/main_styles.css">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/responsive.css">

  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/reservationChooseService/main.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

  <?php include 'includehtml/head.html'; ?>

  <link rel="stylesheet" type="text/css" href="css/choixService/main.css">

  </head>
  <body>
    <?php
    session_start();
    require 'Class/Autoloader.php';
    App\Autoloader::register();
    $bdd = new App\Database('rip');
    $navbar = new App\Navbar();
    $backOffice=0;
    $form =new App\Form(array());
    $navbar->navbar($backOffice);

    $form = new App\Form(array());

    //recup obj trajet de session
    $trajet = unserialize($_SESSION['trajet']);
    ?>

    <div class="container">
       <div class="row">
         <div class="offset-md-2 col-md-8">
           <div class="card" style="margin:50px 0">
                <!-- Default panel contents -->

                <div class="card-header">
                  <h1 class="display-3">Choisissez vos services</h1>
                  <?php $trajet->showInfosTrajet(); ?>
                </div>

                <form class="list-group list-group-flush container" method="POST" action="valideReservationServices.php">


                  <div class="container col-md-12">


                  <?php
                  // Affichage d'un service
                  $services = $bdd->getPDO()->prepare('SELECT * FROM services');
                  $services->execute();
                  $i=0;
                  while($unService = $services->fetch())
                  {
                    $service = new App\Service($unService["idService"],$unService["nomService"],$unService["description"],$unService["prixService"]);
                    ?>
                    <li class="list-group-item col-md-8 row">
                      <h3 class="col-md-6"><?php echo $service->getNomService(); ?></h3>
                      <h6 class="col-md-2">idService: <?php echo $service->getIdService()."<br>"; ?> Prix: <?php echo $service->getPrixService()." €"; ?></h6>
                      <div class="col-md-2">
                        <label class="">Description:</label>
                        <?php echo $service->getDescription(); ?>
                      </div>

                      <label class="switch col-md-2">
                        <input type="checkbox" class="primary" name="services[<?php $i ?>]" value="<?php echo $service->getIdService(); ?>">
                        <span class="slider round"></span>
                      </label>
                    </li>
                <?php
                $i++;
              }
              ?>
              </div>
                <br>
                <div class="center-block">
                  <?php echo $form->submit(); ?>
                </div>
                </form>
            </div>
          </div>
        </div>
      </div>

    <?php include "includehtml/footer.html" ?>
  </body>
</html>
