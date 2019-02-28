  <?php
session_start();
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
        <h3>Le bodyy</h3>
        <a href="#" class="btn btn-large">Petit boutton vert</a> </div>
      </div>
    </section>
    <!-- Get a quote section -->

    <?php include "includehtml/footer.html"; ?>
  </body>
  </html>
