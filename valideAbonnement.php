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
  <title>Reservation de services</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Ride in pride">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/main_styles.css">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/responsive.css">


  <?php include 'includehtml/head.html'; ?>

  <link rel="stylesheet" type="text/css" href="css/choixService/main.css">

  </head>
  <body>
    <?php

    require_once __DIR__ .'/require_class.php';

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

    <?php include "includehtml/footer.php" ?>
  </body>
</html>
