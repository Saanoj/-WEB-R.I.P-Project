<?php


session_start();

?>

<!DOCTYPE html>
<html class="no-js">





<?php include "includehtml/head.html" ?>
<script src="js/homeCollab/main.js"></script>
<link rel="stylesheet" type="text/css" href="css/homeCollab/main.css"></link>
<link rel="stylesheet" href="css/profil/style.css">

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

  $collaborateur = $bdd->queryOne('SELECT * FROM collaborateurs WHERE idCollaborateurs='.$_SESSION["id"].'');
  $user = $bdd->queryOne('SELECT * FROM users WHERE id='.$_SESSION["id"].'');

  //var_dump($user);
  //var_dump($collaborateur);
  ?>

    <div class="container bg-light">
      <div class="row">
        <div class="col-md-10 col-md-offset-2">
          <h1 class="page-header">Dashboard Collaborateur: <?php echo $collaborateur["metier"]; ?></h1>
          <div class="row placeholders border p-2 mr-1">
            <div class="col-md-3 placeholder pb-0 ">
              <div class="row">
                <?php if(empty($collaborateur["rating"])){ ?>
                  <div class="jumbotron display-1 mb-0 col-md-10 offset-1">∅</div>
                <?php }else{?>
                  <div class="jumbotron display-1 mb-0 col-md-10 offset-1"><?php echo $collaborateur["rating"] ?></div>
                <?php } ?>
              </div>
              <div class="row">
                <h4 class="h1 mt-0 text-align col-md-10 offset-1 border pb-3">Rating</h4>
              </div>
            </div>
            <div class="col-md-3 placeholder pb-0">
              <div class="row">
                <div class="jumbotron display-1 mb-0 col-md-10 offset-1"><?php echo $collaborateur["ratingNumber"] ?></div>
              </div>
              <div class="row">
                <h4 class="h1 mt-0 text-align col-md-10 offset-1  border">Nombre d'avis sur vous</h4>
              </div>
            </div>
            <div class="col-md-3 placeholder pb-0">
              <div class="row">
                <div class="jumbotron display-1 mb-0 col-md-10 offset-1"><?php echo $collaborateur["heuresTravailees"] ?></div>
              </div>
              <div class="row">
                <h4 class="h1 mt-0 text-align col-md-10 offset-1  border">Nombre d'Heures Travailees</h4>
              </div>
            </div>
            <div class="col-md-3 placeholder pb-0">
              <div class="row">
                <?php if($collaborateur["isOnline"] == 0){ ?>
                  <div id="statusLogo" class="jumbotron display-1 bg-warning text-center mb-0 col-md-10 offset-1">Off</div>
                <?php }else{?>
                  <div id="statusLogo" class="jumbotron display-1 bg-success text-center mb-0 col-md-10 offset-1">On</div>
                <?php } ?>
              </div>
              <div class="row">
                <h4 class="h1 mt-0 text-align col-md-10 offset-1 border pb-3">Statut</h4>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col-md-3 text-center">
          Changer ses infos profil:
        </div>
        <div class="col-md-3 text-center">
          Statut en/hors ligne
        </div>
        <div class="col-md-3 text-center">
          Détruire votre compte
        </div>
        <div class="col-md-3 text-center">
          Trajet
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 text-center">
            <a href="profil.php" class="btn btn-primary col-md-12">Changer ses<br>informations profil</a>
        </div>
        <div class="col-md-3 text-center">

          <?php if($collaborateur["isOnline"] == 0){ ?>
            <button type="button" id="onlineButton" class="btn btn-success col-md-12" onclick="updateCollabStatus(1)">Se mettre<br>en ligne ajax</button>
          <?php }else{?>
            <button type="button" id="onlineButton" class="btn btn-warning col-md-12" onclick="updateCollabStatus(0)">Se mettre<br>hors ligne ajax</button>
          <?php } ?>
        </div>
        <div class="col-md-3 text-center">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-danger  col-md-12" data-toggle="modal" data-target="#exampleModal">
            Désactiver son<br>compte Collaborateur
          </button>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Désactivation du compte Collaborateur</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="h4">Attention,vous allez garder votre comte R.I.P normal. Mais vos informations collaborateur seront gardé. Vous pourrez revenir sur ce compte collaborateur en gardant vos infos actuelle, ou de les supprimer et en saisir de nouvelle si vous revenez vers nous.</div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <a href="verifDesactiverCollab.php" class="btn btn-danger">Désactiver</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 text-center">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-success col-md-12" data-toggle="modal" data-target="#exampleModal">
            Terminer<br>le trajet
          </button>
        </div>
      </div>

      <hr>

      <div class="row m-5">
        <?php
        if($collaborateur["metier"]=="chauffeur"){

        $car=App\Chauffeur::getCar($_SESSION["id"],$bdd);

        echo "<p class='display-4'>Votre voiture: ".$car["carBrand"]." ".$car["carModel"]." ".$car["carColor"]." ".$car["nbPlaces"]." place(s)</p>";
        } ?>

      </div>

      <br>
      <br>
      <h2 class="sub-header">Section title</h2>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Header</th>
              <th>Header</th>
              <th>Header</th>
              <th>Header</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1,001</td>
              <td>Lorem</td>
              <td>ipsum</td>
              <td>dolor</td>
              <td>sit</td>
            </tr>
            <tr>
              <td>1,002</td>
              <td>amet</td>
              <td>consectetur</td>
              <td>adipiscing</td>
              <td>elit</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>Integer</td>
              <td>nec</td>
              <td>odio</td>
              <td>Praesent</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>libero</td>
              <td>Sed</td>
              <td>cursus</td>
              <td>ante</td>
            </tr>
            <tr>
              <td>1,004</td>
              <td>dapibus</td>
              <td>diam</td>
              <td>Sed</td>
              <td>nisi</td>
            </tr>
            <tr>
              <td>1,005</td>
              <td>Nulla</td>
              <td>quis</td>
              <td>sem</td>
              <td>at</td>
            </tr>
            <tr>
              <td>1,006</td>
              <td>nibh</td>
              <td>elementum</td>
              <td>imperdiet</td>
              <td>Duis</td>
            </tr>
            <tr>
              <td>1,007</td>
              <td>sagittis</td>
              <td>ipsum</td>
              <td>Praesent</td>
              <td>mauris</td>
            </tr>
            <tr>
              <td>1,008</td>
              <td>Fusce</td>
              <td>nec</td>
              <td>tellus</td>
              <td>sed</td>
            </tr>
            <tr>
              <td>1,009</td>
              <td>augue</td>
              <td>semper</td>
              <td>porta</td>
              <td>Mauris</td>
            </tr>
            <tr>
              <td>1,010</td>
              <td>massa</td>
              <td>Vestibulum</td>
              <td>lacinia</td>
              <td>arcu</td>
            </tr>
            <tr>
              <td>1,011</td>
              <td>eget</td>
              <td>nulla</td>
              <td>Class</td>
              <td>aptent</td>
            </tr>
            <tr>
              <td>1,012</td>
              <td>taciti</td>
              <td>sociosqu</td>
              <td>ad</td>
              <td>litora</td>
            </tr>
            <tr>
              <td>1,013</td>
              <td>torquent</td>
              <td>per</td>
              <td>conubia</td>
              <td>nostra</td>
            </tr>
            <tr>
              <td>1,014</td>
              <td>per</td>
              <td>inceptos</td>
              <td>himenaeos</td>
              <td>Curabitur</td>
            </tr>
            <tr>
              <td>1,015</td>
              <td>sodales</td>
              <td>ligula</td>
              <td>in</td>
              <td>libero</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>


  <?php include "includehtml/footer.php"; ?>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBceTkjdStb2X5btD_NmC3yNsbXKIjCMc&callback=initMap"async defer></script>

</body>
</html>
