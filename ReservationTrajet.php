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
  <title>Reservation de trajets</title>
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
  <script src="js/popper.min.js"></script>

  <?php

  include 'includehtml/head.html';
  require 'Class/Autoloader.php';
  App\Autoloader::register();
  $backOffice=0;
  $type = 0;
  $navbar = new App\Navbar($backOffice,$type);
  $navbar->navbar();
  $Session = new App\Session($_SESSION['id']);
  $Session->isConnect();
  $form = new App\Form();

  //avoir l'objet membre pour check son adresse pour le boutton d'autocomplétion
  if(isset($_SESSION["user"]) && !empty($_SESSION["user"])){
    $membre = unserialize($_SESSION["user"]);
  }
  ?>
  <script type="text/javascript">
  function autoFillStart(home) {
    $('.start').val(home);
    $('.end').val("");
  }
  function autoFillEnd(home) {
    $('.end').val(home);
    $('.start').val("");
  }
  </script>
</head>
<body>
  <div class="">
    <!-- Home -->
    <div class="">
      <!-- Home Slider -->
      <div class="">
      </div>
      <!-- Recherche -->
      <div class="container mt-5 mb-5">

        <div class="row">
          <div class="display-3 text-white bg-secondary col-md-6 offset-3 rounded-top text-center">
            <?php echo _TITRE_RESERVATION_TRAJET ?>
          </div>
        </div>
        <div class="row pt-4 pb-4 bg-secondary rounded">
          <!-- boutton d'autocomplétion de depart depuis son adresse -->
          <?php if (!empty($membre->getAddress())) { ?>
          <div class="col-md-2">

            <button class="glyphicon glyphicon-home btn btn-dark col-md-12 mt-1" style="height: 25px;" href="#" onClick="autoFillStart('<?php echo $membre->getAddress()." ".$membre->getZipCode();?>'); return false;">Start</button>
            <button class="glyphicon glyphicon-home btn btn-dark col-md-12 mt-1" style="height: 25px;" href="#" onClick="autoFillEnd('<?php echo $membre->getAddress()." ".$membre->getZipCode();?>'); return false;">End</button>
          </div>
        <?php }else{ ?>
            <div class="col-md-1">

            </div>
        <?php } ?>

          <form action="valideReservation.php" method="post" class=" d-flex flex-lg-row flex-column align-items-start justify-content-lg-between justify-content-start" id="home_search_form" onsubmit="return checkGlobal(this)">
            <input type="text" name="start"  id="autocomplete" class="col-md-4 search_input search_input_1 m-2 start" placeholder="<?php echo _ADRESSE_DEPART_RESERVATION ?>" required="required"  onblur="checkStart(this)">

            <input type="text" name="end"  id="autocomplete2" class="col-md-4 search_input search_input_2 m-2 end" placeholder="<?php echo _ADRESSE_ARRIVEE_RESERVATION ?>" required="required" onblur="checkEnd(this)">
            <!--<input type="number" name="price"  id="price" class="search_input search_input_4" placeholder="Budget" required="required">-->
            <div class="col-md-3">
              <label for="dateDebut"><?php echo _DATE_DEBUT_RESERVATION_TRAJET ?></label>
              <?php echo $form->input('dateDebut','date'); ?>
            </div>
            <div class="col-md-2 offset-1">
              <label for="heureDebut"><?php echo _HEURE_DEBUT_RESERVATION_TRAJET ?></label>
              <?php echo $form->input('heureDebut','time'); ?>
            </div>

            <button type="submit" class="glyphicon glyphicon-search btn btn-dark col-md-1 ml-5 p-3 mt-4" name="submit">

           <!--  <button class="home_search_button col-md-2 m-2"><?php echo _BOUTTON_RESERVATION_TRAJET ?></button> !-->

          </form>
        </div>
      </div>
      <!-- Intro -->
      <div class="row">


        <div class="intro">
          <div class="container">
            <div class="row">
              <div class="col">
                <div class="intro_container">
                  <div class="row">

                    <!-- Premier element -->
                    <div class="col-lg-4 intro_col">
                      <div class="intro_item d-flex flex-row align-items-end justify-content-start">
                        <div class="intro_icon"><img src="images/shield.svg" alt=""></div>
                        <div class="intro_content">
                          <div class="intro_title"><?php echo _TITRE_INFO1_RESERVATION ?></div>
                          <div class="intro_subtitle"><p><?php echo _INFO1_RESERVATION ?></p></div>
                        </div>
                      </div>
                    </div>

                    <!-- Deuxieme element -->
                    <div class="col-lg-4 intro_col">
                      <div class="intro_item d-flex flex-row align-items-end justify-content-start">
                        <div class="intro_icon"><img src="images/shopping-cart.svg" alt=""></div>
                        <div class="intro_content">
                          <div class="intro_title"><?php echo _TITRE_INFO2_RESERVATION ?></div>
                          <div class="intro_subtitle"><p><?php echo _INFO2_RESERVATION ?></p></div>
                        </div>
                      </div>
                    </div>

                    <!-- Trosième element-->
                    <div class="col-lg-4 intro_col">
                      <div class="intro_item d-flex flex-row align-items-end justify-content-start">
                        <div class="intro_icon"><img src="images/support.svg" alt=""></div>
                        <div class="intro_content">
                          <div class="intro_title"><?php echo _TITRE_INFO3_RESERVATION ?></div>
                          <div class="intro_subtitle"><p><?php echo _INFO3_RESERVATION ?></p></div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <?php include "includehtml/footer.php" ?>

    <script src="js/ReservationTrajet/main.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyUEYzEivgVQJxxot06Z6ZsqfbIR4p_wU&libraries=places&callback=initAutocomplete"
    async defer></script>


  </body>
  </html>
