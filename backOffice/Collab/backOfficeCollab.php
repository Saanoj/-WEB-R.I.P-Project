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
    <h1>Table collaborateurs</h1>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Mail</th>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col">Profession</th>
            <th scope="col">Description</th>
            <th scope="col">Prix </th>
            <th scope="col">Date d'embauche</th>
            <th scope="col">Ville</th>
            <th scope="col">Nombre d'heure</th>
            <th scope="col">Note</th>
            <th scope="col">Nombre de placement</th>
            <th scope="col">Edit/Add</th>
            <th scope="col">Supprimer</th>
          </tr>
        </thead>
        <?php backOfficeCollab();
        ?>
      </table>
    </table>
  </div>
  <?php include "../includehtml/footer.php" ?>
</body>
</html>
