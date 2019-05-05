<?php
session_start();

/*
if (!isset($_SESSION['lang'])) {
  $_SESSION['lang'] = "fr";
}
include "multilingue/multilingue.php";
loadLanguageFromSession($_SESSION['lang']);
*/
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php

include 'includehtml/head.html';
require_once __DIR__ .'/require_class.php';

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
<?php include "includehtml/footer.php" ?>
</html>
