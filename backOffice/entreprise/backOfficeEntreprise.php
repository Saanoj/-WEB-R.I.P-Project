<?php
session_start();


include 'functionEntreprise.php';
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
    navbarBO("entreprise")?>

    <h1>Entreprise</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Nom</th>
          <th scope="col">Numéro</th>
          <th scope="col">Adresse</th>
          <th scope="col">Siret</th>
          <th scope="col">Id Directeur</th>
          <th scope="col">Nombre de salarié</th>
          <th scope="col">Pays</th>
          <th scope="col">Date</th>
          <th scope="col">Edit/Add</th>
          <th scope="col">Supprimer</th>
        </tr>
      </thead>
      <?php backOfficeEntreprise();
      ?>
    </table>
  </div>
  <?php include "../includehtml/footer.php" ?>
</body>
</html>
