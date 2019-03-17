<?php
session_start();

//multilingue
if (!isset($_SESSION['lang'])) {
  $_SESSION['lang'] = "fr";
}
include "multilingue/multilingue.php";
loadLanguageFromSession($_SESSION['lang']);
?>

<!doctype html>
<html class="no-js">

<link rel="stylesheet" type="text/css" href="css/choixDriver/main.css">
<script src="js/index/main.js"></script>

<style>

</style>

<?php include "includehtml/head.html" ?>

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

  ?>
  <div class="container">

    <div class="row m-5">
      <div class="col-md-8 offset-2" style="border-radius: 10px; background-color: #2F2E33; padding: 10px;">
          <p class="display-2 text-center text-light">Espace collaborateur:</p>
      </div>
    </div>

    <div class="row m-5">
      <div class="col-md-4 offset-4 text-center" style="border-radius: 10px; background-color: #2F2E33; padding: 10px;">

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
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
    </div>
  </div>


  <?php include "includehtml/footer.php"; ?>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBceTkjdStb2X5btD_NmC3yNsbXKIjCMc&callback=initMap"async defer></script>

</body>
</html>
