<?php
session_start();


include '../../include/config.php';
include '../../include/fonction.php';
?>

<!DOCTYPE html>
<html>
<?php include "../includehtml/head.html" ?>


<body>

  <?php
  require '../../Class/Autoloader.php';
  App\Autoloader::register();
  $type =2;
  $navbar = new App\Navbar($type);
  $navbar->navbar();
  $Session = new App\Session($_SESSION['id']);
  $Session->isConnect();
  ?>

  <div class="jumbotron m-5 p-5">

    <?php include_once '../includehtml/navbarBO.php';
    navbarBO("users")?>


    <h1 class="display-1">Table Utilisateurs</h1>
    <div class="col-md-4 border border-rounded">
      <div class="display-4">Recherche d'un utilisateur:</div>
      <input type="text" name="" value="" placeholder="Cherchez un utilisateur" id='inputUsers'>
    </div>
    <table class="table" id=users>
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
      <?php backOfficeUser(); ?>
    </table>
  </div>
  <script type="text/javascript" src="../includehtml/mainUsers.js"></script>
  <?php include "../includehtml/footer.php" ?>
</body>
</html>
