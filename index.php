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
<!--<![endif]-->
<?php include "includehtml/head.html" ?>

<body>
  <!-- header section -->
  <?php

  require 'Class/Autoloader.php';
  App\Autoloader::register();
  $backOffice=0;
  $navbar = new App\Navbar($backOffice);
  $navbar->navbar();

  ?>

  <!-- Get a quote section -->
  <section  class="section quote">
    <div class="container">
      <div class="col-md-8 col-md-offset-2 text-center">
        <h3><?php echo _TITRE_BODY?></h3>
        <a href="#" class="btn btn-large"><?php echo _TITRE_BOUTTON ?></a> </div>
      </div>
    </section>
    <!-- Get a quote section -->

    <?php include "includehtml/footer.php"; ?>
  </body>
  </html>
