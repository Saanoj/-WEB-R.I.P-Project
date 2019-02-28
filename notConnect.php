<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php

include 'includehtml/head.html';
require 'Class/Autoloader.php';
App\Autoloader::register();
$backOffice=0;
$navbar = new App\Navbar($backOffice);
$navbar->navbar();?>
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
