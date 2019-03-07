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
  <style media="screen">
  body { margin-top:20px; }
  .panel-title {display: inline;font-weight: bold;}
  .checkbox.pull-right { margin: 0; }
  .pl-ziro { padding-left: 0px; }
  </style>

  <?php
  include 'includehtml/head.html'; ?>
</head>
<body>
  <?php

  require 'Class/Autoloader.php';
  App\Autoloader::register();
  $bdd = new App\Database('rip');
  $backOffice=0;
  $type = 1;
  $navbar = new App\Navbar($backOffice,$type);
  $navbar->navbar();

  $form = new App\Form(array());

  //recup obj trajet de session
  $trajet = unserialize($_SESSION['trajet']);

  $price = sprintf("%.2f",$_POST["price"]);
  ?>
  <div class="container">
    <div class="row">
      <div class="offset-md-2 col-md-8">
        <div class="card" style="margin:50px 0">
          <!-- Default panel contents -->
          <div class="card-header">
            <h1 class="display-3">Paiement</h1>
            <?php $trajet->showInfosTrajet(); ?>
            <?php echo "<p>Prix du Trajet: ".$price." €</p>" ?>
          </div>

          <form class="card-body" method="POST" action="valideReservationServices.php" >
            <div class="row">
              <div class="col-xs-12 col-md-4">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">
                      Payment Details
                    </h3>
                    <div class="checkbox pull-right">
                      <label>
                        <input type="checkbox" />
                        Remember
                      </label>
                    </div>
                  </div>
                  <div class="panel-body">
                    <form role="form">
                      <div class="form-group">
                        <label for="cardNumber">
                          CARD NUMBER</label>
                          <div class="input-group">
                            <input type="text" class="form-control" id="cardNumber" placeholder="Valid Card Number"
                            required autofocus />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-7 col-md-7">
                            <div class="form-group">
                              <label for="expityMonth">
                                EXPIRY DATE</label>
                                <div class="col-xs-6 col-lg-6 pl-ziro">
                                  <input type="text" class="form-control" id="expityMonth" placeholder="MM" required />
                                </div>
                                <div class="col-xs-6 col-lg-6 pl-ziro">
                                  <input type="text" class="form-control" id="expityYear" placeholder="YY" required /></div>
                                </div>
                              </div>
                              <div class="col-xs-5 col-md-5 pull-right">
                                <div class="form-group">
                                  <label for="cvCode">
                                    CV CODE</label>
                                    <input type="password" class="form-control" id="cvCode" placeholder="CV" required />
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                        <ul class="nav nav-pills nav-stacked">
                          <li class="active"><a href="#"><span class="badge pull-right"><span class="glyphicon glyphicon-euro"></span><?php echo " ".$price ?></span> Paiement Final</a>
                          </li>
                        </ul>
                        <br/>

                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <?php include "includehtml/footer.php" ?>
        </body>
        </html>
