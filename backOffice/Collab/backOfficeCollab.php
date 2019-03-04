<?php
session_start();


include '../../include/config.php';
include '../../include/fonctionCollab.php';
?>

<!DOCTYPE html>
<html>
<?php include "includehtml/head.html" ?>

<body>

  <?php
  require '../../Class/Autoloader.php';
  App\Autoloader::register();
  $backOffice=3;
  $type = 0 ;
  $navbar = new App\Navbar($backOffice, $type);
  $navbar->navbar();
  $Session = new App\Session($_SESSION['id']);
  $Session->isConnect();
  ?>

  <div>
    <h1>Table comptes</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Mail</th>
          <th scope="col">Nom</th>
          <th scope="col">Prenom</th>
          <th scope="col">Profession</th>
          <th scope="col">Prix </th>
          <th scope="col">Date d'embauche</th>
          <th scope="col">Ville</th>
          <th scope="col">Nombre d'heure</th>
          <th scope="col">Edit</th>
        </tr>
      </thead>
      <?php backOfficeCollab();
      ?>
    </table>
  </div>
  <?php include "../includehtml/footer.php" ?>
</body>
</html>
