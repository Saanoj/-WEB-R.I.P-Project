<?php
session_start();


include 'functionRestaurants.php';
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
          <th scope="col">Id du trajet</th>
          <th scope="col">Id du service</th>
          <th scope="col">Id annexe</th>
          <th scope="col">Quantite</th>
          <th scope="col">Statut</th>
          <th scope="col">Date de début</th>
          <th scope="col">Date de fin</th>
          <th scope="col">Edit/Add</th>
          <th scope="col">Supprimer</th>
        </tr>
      </thead>
      <?php backOfficeRestaurants();
      ?>
    </table>
  </div>
  <?php include "../includehtml/footer.php" ?>
</body>
</html>
