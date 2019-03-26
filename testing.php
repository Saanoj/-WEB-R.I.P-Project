<?php
session_start();

//multilingue
if (!isset($_SESSION['lang'])) {
  $_SESSION['lang'] = "fr";
}
include "multilingue/multilingue.php";
loadLanguageFromSession($_SESSION['lang']);

?>
<!DOCTYPE html>
<html lang="fr">
<head>

  <?php include 'includehtml/head.html'; ?>

</head>
<body>

  <?php
  require 'Class/Autoloader.php';
  App\Autoloader::register();
  $bdd = new App\Database('rip');
  $backOffice=0;
  $type = 0;
  $navbar = new App\Navbar($backOffice,$type);
  $navbar->navbar();
  ?>

<div class="modal" tabindex="1" role="dialog">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Modal title</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <p>Modal body text goes here.</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary">Save changes</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>


  <br>
  <?php include "includehtml/footer.php" ?>
  <script type="text/javascript" src="js/profil/profil.js"></script>
</body>

</html>
