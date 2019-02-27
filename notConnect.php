<?php
session_start();
require 'Class/Autoloader.php';
App\Autoloader::register();
$navbar = new App\Navbar();
$backOffice=0;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php

include 'includehtml/head.html';
$navbar->navbar($backOffice);?>
<body>
  <div class="container">
    <br>
    <br>
    <h1 class="text-center">Connectez-vous ou demandez l'autorisation d'acceder a la page</h1>
    <br>
    <br>
    <br>
  </div>
</body>
<?php include "includehtml/footer.html" ?>
</html>
