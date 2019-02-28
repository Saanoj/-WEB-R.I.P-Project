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
    $backOffice=0;
    $navbar = new App\Navbar($backOffice);
    $navbar->navbar();
    $form =new App\Form(array());


    $form = new App\Form(array());
    $abo = App\Abonnement::createAbonnement($bdd);
    ?>

    <div class="container">
       <div class="row">
         <div class="offset-md-3 col-md-6">
           <div class="card" style="margin:50px 0">
                <!-- Default panel contents -->
                <div class="card-header">
                  <h1 class="display-3">Récapitulatif de l'abonnement</h1>
                </div>

                <div>
                <ul>
                <li><?php

                ?></li>
                <li>b</li>


                </ul>
                </div>




            </div>
          </div>
        </div>
      </div>

    <?php include "includehtml/footer.html" ?>
  </body>
</html>
