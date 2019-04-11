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
  $backOffice=2;
  $type =0;
  $navbar = new App\Navbar($backOffice,$type);
  $navbar->navbar();
  $Session = new App\Session($_SESSION['id']);
  $Session->isConnect();
  ?>
  
  <br>
  <br>
  <div class="jumbotron m-5 p-5">
    <h1 class="display-1">Table Utilisateurs Bannis</h1>
    <div class="col-md-4 border border-rounded">
      <div class="display-4">Recherche d'un utilisateur:</div>
      <input type="text" name="" value="" placeholder="Cherchez un utilisateur" id='inputBannedUsers'>
    </div>
    <table class="table" id=users>
      <thead>
        <tr>
          <th scope="col">Mail</th>
          <th scope="col">Nom</th>
          <th scope="col">Prenom</th>
          <th scope="col">Date de naissance</th>
          <th scope="col">Sexe</th>
          <th scope="col">Admin</th>
          <th scope="col">unBan</th>
        </tr>
      </thead>
      <?php showBannedUser();
      ?>
    </table>
  </div>
  <?php include "../includehtml/footer.php" ?>
</body>
</html>
