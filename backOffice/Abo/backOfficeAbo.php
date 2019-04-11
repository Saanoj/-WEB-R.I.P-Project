<?php
session_start();


include '../../include/config.php';
include '../../include/fonctionAbo.php';
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

  <div class="table-responsive">
    <h1>Table comptes</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Client</th>
          <th scope="col">Date du début</th>
          <th scope="col">Date de fin</th>
          <th scope="col">Type</th>
          <th scope="col">Engagement</th>
          <th scope="col">Edit/Add</th>
          <th scope="col">Supprimer</th>
        </tr>
      </thead>
      <?php backOfficeAbo();
      ?>
    </table>
  </div>
  <?php include "../includehtml/footer.php" ?>
</body>
</html>
