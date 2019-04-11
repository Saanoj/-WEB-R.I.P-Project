<?php
session_start();


include '../../include/config.php';
include '../../include/fonctionTrajet.php';
?>

<!DOCTYPE html>
<html>
<?php include "../includehtml/head.html" ?>

<body>

  <?php
  require '../../Class/Autoloader.php';
  App\Autoloader::register();
  $type = 2 ;
  $navbar = new App\Navbar($type);
  $navbar->navbar();
  $Session = new App\Session($_SESSION['id']);
  $Session->isConnect();
  ?>

  <div>
    <h1>Table comptes</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Client</th>
          <th scope="col">Chauffeur</th>
          <th scope="col">Heure du début</th>
          <th scope="col">Heure de fin </th>
          <th scope="col">Date</th>
          <th scope="col">Distance</th>
          <th scope="col">Prix</th>
          <th scope="col">Debut</th>
          <th scope="col">Fin</th>
          <th scope="col">Edit/Add</th>
          <th scope="col">Supprimer</th>
        </tr>
      </thead>
      <?php backOfficeTrajet();
      ?>
    </table>
  </div>
  <?php include "../includehtml/footer.php" ?>
</body>
</html>
