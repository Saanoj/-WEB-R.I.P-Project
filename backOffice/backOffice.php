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
  $backOffice=1;
  $type = 0;
  $navbar = new App\Navbar($backOffice,$type);
  $navbar->navbar();

  $Session = new App\Session($_SESSION['id']);
  $Session->isConnect();
  ?>

  <div class="container">
    <div class="" style="margin-bottom: 25%;">
      <h1>Bienvenue sur le back-office</h1>
    </div>
  </div>
  
  <?php include "includehtml/footer.php" ?>
</body>
</html>
