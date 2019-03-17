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
      <div class="col-md-4 offset-4 text-center" style="border-radius: 10px; background-color: #2F2E33; padding: 10px;">
          <p class="btn btn-info display-4" >Salut a toi<br>nouvevau collaborateur !</p>
      </div>
    </div>
  </div>


  <?php include "includehtml/footer.php"; ?>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBceTkjdStb2X5btD_NmC3yNsbXKIjCMc&callback=initMap"async defer></script>

</body>
</html>
