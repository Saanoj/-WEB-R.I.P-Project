<?php
session_start();

include '../include/config.php';
include '../include/fonction.php';
?>

<!DOCTYPE html>
<html>
<?php include "includehtml/head.html" ?>
<body>
  <script type="text/javascript" src="../js/backOffice/backOfficeAjax.js"></script>
  <?php
  require '../Class/Autoloader.php';
  App\Autoloader::register();
  $backOffice=1;
  $navbar = new App\Navbar($backOffice);
  $navbar->navbar();
  $Session = new App\Session($_SESSION['id']);
  $Session->isConnect();
  ?>

  <div class="container">
    <h1>Bienvenue sur le back-office</h1>
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
  <?php include "includehtml/footer.php" ?>
</body>
</html>
