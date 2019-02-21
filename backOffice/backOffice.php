<?php
session_start();
include '../include/config.php';
include '../include/fonction.php';
?>

<!DOCTYPE html>
<html>
<?php include "includehtml/head.html" ?>

<body>

  <?php
  require '../Class/Autoloader.php';
  App\Autoloader::register();
  $navbar = new App\Navbar();
  $backOffice=1;
  $navbar->navbar($backOffice);
  ?>

  <div class="container">
    <h1>Bienvenue sur le Back Office</h1>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
  </div>
  <?php include "includehtml/footer.html" ?>
</body>
</html>
