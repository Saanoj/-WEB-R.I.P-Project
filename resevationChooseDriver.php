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
    require 'Class/Autoloader.php';
    App\Autoloader::register();
    $bdd = new App\Database('rip');
    $navbar = new App\Navbar();
    $backOffice=0;
    $navbar->navbar($backOffice);

    /*
    if (isset($_POST[""])) {
      // code...
    }
    */
    ?>
    <div class="container">
        <div class="col-md-6">
             <h4>Choisissez votre chauffeur</h4>

            <form class="funkyradio" method="post" action="verifyChauffeur.php">

                <div class="funkyradio-primary">
                    <input type="radio" name="radio" id="radio1" checked/>
                    <label for="radio1">Choisir ce chauffeur statique 1</label>
                </div>
                <div class="funkyradio-primary">
                    <input type="radio" name="radio" id="radio2" checked/>
                    <label for="radio2">Choisir ce chauffeur statique 2</label>
                </div>
            </form>
        </div>
    </div>

    <?php include "includehtml/footer.html" ?>
  </body>
</html>
