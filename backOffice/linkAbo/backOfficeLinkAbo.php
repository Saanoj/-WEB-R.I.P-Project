<?php
session_start();


include 'functionLinkAbo.php';
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
    navbarBO("linkAbo")?>

    <h1>Factures</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Id de l'abonnement</th>
          <th scope="col">Id du Client</th>
          <th scope="col">Id de l'entreprise</th>
          <th scope="col">Date de début</th>
          <th scope="col">Date de fin</th>
          <th scope="col">Edit/Add</th>
          <th scope="col">Supprimer</th>
        </tr>
      </thead>
      <?php backOfficeLinkAbo();
      ?>
    </table>
  </div>
  <?php include "../includehtml/footer.php" ?>
</body>
</html>
