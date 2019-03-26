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
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/main_styles.css">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/responsive.css">
  <link rel="stylesheet" type="text/css" href="css/contact/main.css">


  <?php
  include 'includehtml/head.html'; ?>
</head>
<body>
  <?php
  require 'Class/Autoloader.php';
  App\Autoloader::register();
  $bdd = new App\Database('rip');
  $backOffice=0;
  $type = 0;
  $navbar = new App\Navbar($backOffice,$type);
  $navbar->navbar();
  ?>

  <div class="super_container">

    <!-- Home -->

    <div class="home">


    <div class="container contact-form">
            <div class="contact-image">
                <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
            </div>
            <form method="post" action="verifContact.php" method="post" onsubmit="return checkGlobal(this)">
                <h3>Laissez nous un message ! </h3>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="nameClient" id="name" class="form-control" placeholder="Votre nom *" onblur="checkfirstName(this)" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Votre email *" value="<?= $_SESSION["email"]; ?>" readonly="readonly" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="phoneNumber" id="phone" class="form-control" placeholder="Votre numéro de téléphone *" onblur="Verifier_Numero_Telephone(this)" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btnContact" value="Envoyez un message" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="messageContact" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
                        </div>
                    </div>
                </div>
            </form>

      <!-- Home Slider -->
      <div class="home_slider_container">


</div>

      </div>





      <!-- Intro -->

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
                        <div class="intro_title">Course sécurisé</div>
                        <div class="intro_subtitle"><p>Nous prenons très au sérieux le confort de nos clients.</p></div>
                      </div>
                    </div>
                  </div>

                  <!-- Deuxieme element -->
                  <div class="col-lg-4 intro_col">
                    <div class="intro_item d-flex flex-row align-items-end justify-content-start">
                      <div class="intro_icon"><img src="images/shopping-cart.svg" alt=""></div>
                      <div class="intro_content">
                        <div class="intro_title">Courses les moins chers</div>
                        <div class="intro_subtitle"><p>Prix les plus abordables grâce à notre algorithme qui calcul le meilleur itinéraire.</p></div>
                      </div>
                    </div>
                  </div>

                  <!-- Trosième element-->
                  <div class="col-lg-4 intro_col">
                    <div class="intro_item d-flex flex-row align-items-end justify-content-start">
                      <div class="intro_icon"><img src="images/support.svg" alt=""></div>
                      <div class="intro_content">
                        <div class="intro_title">Services </div>
                        <div class="intro_subtitle"><p>En plus de notre course, nous proposons des services qui améliorent votre c.</p></div>
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
    <script src="js/contact/main.js"></script>


  </body>
  </html>
