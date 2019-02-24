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
    ?>

    <div class="container">
       <div class="row">
         <div class="offset-md-2 col-md-8">
           <div class="card" style="margin:50px 0">
                <!-- Default panel contents -->
                <div class="card-header">
                  <h1 class="display-3">Informations complémentaires au trajet</h1>
                  <form method="POST" action="valideReservationServices.php">

                  <label for="dateDebut">Date de début du trajet : </label>
                  <?php echo $form->input('dateDebut','date'); ?>

                  <label for="heureDebut">Heure de début du trajet</label>
                  <?php echo $form->input('heureDebut','time'); ?>
                </div>

                <div class="card-header">
                  <h1 class="display-3">Choisissez vos services</h1>
                  <p><?php echo "Trajet: ". "<br>".$_SESSION["startTrajet"]. " => ".$_SESSION["endTrajet"] ?></p>
                </div>

                <form class="list-group list-group-flush" method="POST" action="valideReservationServices.php">
                  <?php
                  // Affichage SERVICE DE REPAS ET DE BOISSONS
                    ?>
                    <li class="list-group-item">
                    <div class="dropdown">
    <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">
      <span id="selected">Chose option</span><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li><a href="#">Option 1</a></li>
    <li><a href="#">Option 2</a></li>
    <li><a href="#">Option 3</a></li>
    <li><a href="#">Option 4</a></li>
  </ul>
</div>


                      <label class="switch">
                        <input type="checkbox" class="primary" name="" value="">
                        <span class="slider round"></span>
                      </label>
                    </li>
                <?php


              ?>
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
