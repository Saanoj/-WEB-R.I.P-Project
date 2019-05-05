<?php
session_start();


include 'functionDevis.php';
?>

<!DOCTYPE html>
<html>
<?php include "../includehtml/head.html" ?>

<body>

  <?php
  require __DIR__ . '../../../require_class.php';

  $type = 2 ;
  $navbar = new App\Navbar($type);
  $navbar->navbar();
  $Session = new App\Session($_SESSION['id']);
  $Session->isConnect();
  ?>

  <div class="jumbotron m-5 p-5 table-responsive">
    <?php include_once '../includehtml/navbarBO.php';
    navbarBO("devis")?>

    <h1>Devis</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">id du Trajet</th>
          <th scope="col">Prix du Trajet</th>
          <th scope="col">Prix des Services</th>
          <th scope="col">Prix total</th>
          <th scope="col">Date de la Devis</th>
          <th scope="col">Edit/Add</th>
          <th scope="col">Supprimer</th>
        </tr>
      </thead>
      <?php backOfficeDevis();
      ?>
    </table>
  </div>
  <?php include "../includehtml/footer.php" ?>
</body>
</html>
