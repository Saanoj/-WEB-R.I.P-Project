<?php
session_start();


include 'functionTrajet.php';
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

  <div class="jumbotron m-5 p-5 table-responsive">
    <?php include_once '../includehtml/navbarBO.php';
    navbarBO("restaurant")?>

    <h1>Link service abbonement</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Id du client</th>
          <th scope="col">Id du chauffeur</th>
          <th scope="col">Heure de début</th>
          <th scope="col">Heure de fin</th>
          <th scope="col">Date de réservation</th>
          <th scope="col">Distance</th>
          <th scope="col">Prix</th>
          <th scope="col">Debut</th>
          <th scope="col">Fin</th>
          <th scope="col">Duration</th>
          <th scope="col">Status du trajet</th>
          <th scope="col">Status du chauffeur</th>
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
