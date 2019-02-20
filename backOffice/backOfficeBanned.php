<?php
session_start();
$backOffice=1;
include '../include/config.php';
include '../include/fonction.php'; ?>

<!DOCTYPE html>
<?php include "includehtml/head.html" ?>

      <body>
        <?php
        require '../Class/Autoloader.php';
        App\Autoloader::register();
        $navbar = new App\Navbar();
        $backOffice=1;
        $navbar->navbar($backOffice);?>

      <br>
      <br>
      <div class="container">
        <h1>Banned Guide Table</h1>
        <table class="table">
          <thead>
            <tr>
              <<th scope="col">Mail</th>
              <th scope="col">Nom</th>
              <th scope="col">Prenom</th>
              <th scope="col">Date de naissance</th>
              <th scope="col">Sexe</th>
              <th scope="col">Admin</th>
              <th scope="col">Unban</th>
            </tr>
          </thead>
          <?php showBanned();
          ?>
        </table>
      </div>
    </body>
</html>
