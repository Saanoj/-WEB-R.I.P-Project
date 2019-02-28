<?php
session_start();
include '../../include/config.php';
include '../../include/fonction.php';
?>

<!DOCTYPE html>
<html>
<?php include "includehtml/head.html" ?>

<body>

  <?php
  require '../../Class/Autoloader.php';
  App\Autoloader::register();
  $navbar = new App\Navbar();
  $backOffice=2;
  $navbar->navbar($backOffice);
  $Session = new App\Session($_SESSION['id']);
  $Session->isConnect();
  ?>

  <div>
    <h1> Costumer Table</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Mail</th>
          <th scope="col">Nom</th>
          <th scope="col">Prenom</th>
          <th scope="col">Date de naissance</th>
          <th scope="col">Sexe</th>
          <th scope="col">Edit</th>
          <th scope="col">Admin</th>
          <th scope="col">Ban</th>
        </tr>
      </thead>
      <?php backOffice();
      ?>
    </table>
  </div>
  <?php include "../includehtml/footer.html" ?>
</body>
</html>
