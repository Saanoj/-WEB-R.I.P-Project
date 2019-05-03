<?php
namespace App;

use \PDO;

/**
* Navbar
*/
class Navbar
{

  private $type;
  private $where;

  public function __construct($type)
  {
    $this->type=$type;
  }
  public function getType() {return $this->type;}

  public function navbar()
  {
    $bdd = new Database('rip');

    $type = $this->type;

    if(isset($_SESSION['id'])){
      $session = new Session($_SESSION['id']);
      $id = $session->getId();
      $query=$bdd->getPDO()->prepare('SELECT isAdmin
        FROM users WHERE id = :id');
        $query->bindValue(':id',$_SESSION['id']);
        $query->execute();
        $data=$query->fetch();
        $where = "normal";

      if($data['isAdmin'] == 1){
          if ($type == 2){
            $where = "backOffice";

          } else if ($type == 3) {
            $where = "reservation";
          } else {
            $where = "admin";
          }
        }elseif($type == 2){
          header('Location:http://localhost/R.I.P-Project/notConnect.php');
        }elseif($type==3){
          $where = "reservation";
        }else{
          $where = "customer";
        }
      }elseif($type == 2){
        header('Location:http://localhost/R.I.P-Project/notConnect.php');
      }else{
        $where = "normal";
      }
      echo"<script>console.log('".$where."')</script>";
      $this->showNav($where);
    }

    private function showNav(string $where)
    {

      //multilingue
      if (!isset($_SESSION['lang'])) {
        $_SESSION['lang'] = "fr";
      }
      require_once "multilingue/multilingue.php";
      loadLanguageFromSession($_SESSION['lang']);


      ?>
      <style media="screen">
        body {
          /*margin-top: -10px;*/
        }
      </style>
      <header class="header" style="/*background-color: #2F2E33">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="header_content d-flex flex-row align-items-center justify-content-start">
                <div class="header_content_inner d-flex flex-row align-items-end justify-content-start">
                  <div class="logo"><a href="index.php"><?php echo _NAVBAR_INDEX ?></a></div>
                  <nav class="main_nav">
                    <ul class="d-flex flex-row align-items-start justify-content-start">

                      <?php if ($where == "reservation") {?>
                        <li><a href="annulerReservation.php"><?php echo _NAVBAR_ANNULER_RESERVATION ?></a></li>
                      <?php }else{

                        if ($where == "customer" ||$where == "admin" ||$where == "backOffice" ) {
                          if($where == "admin" || $where == "customer"){
                            ?>
                            <li><a href="index.php"><?php echo _NAVBAR_ACCUEIL ?></a></li>
                            <?php if ($where == "admin") { ?>
                              <li><a href="backOffice/Users/backOfficeUsers.php"><?php echo _NAVBAR_BACK_OFFICE ?></a></li>
                            <?php } ?>
                            <li><a href="profil.php"><?php echo _NAVBAR_PROFIL ?></a></li>
                            <li><a href="contact.php"><?php echo _NAVBAR_CONTACT ?></a></li>
                          <?php }else{?>
                            <li><a href="../../index.php"><?php echo _NAVBAR_ACCUEIL ?></a></li>
                            <li><a href="../../profil.php"><?php echo _NAVBAR_PROFIL ?></a></li>
                            <li><a href="../../deconnexion.php"><?php echo _NAVBAR_DECO ?></a></li>
                          <?php } ?>
                        <?php }?>

                        <?php // si il est connecter ou pas
                        if ($where == "normal"){ ?>
                          <li><a href="index.php"><?php echo _NAVBAR_ACCUEIL ?></a></li>
                          <li><a href="inscription.php"><?php echo _NAVBAR_INSCRIPTION ?></a></li>
                          <li><a href="connexion.php"><?php echo _NAVBAR_CONNEXION ?></a></li>
                          <li><a href="contact.php"><?php echo _NAVBAR_CONTACT ?></a></li>
                        <?php }else{ ?>
                          <li><a href="deconnexion.php"><?php echo _NAVBAR_DECO ?></a></li>
                        <?php } ?>
                      <?php } ?>
                    </ul>
                  </nav>



                  <!-- Hamburger -->

                  <div class="hamburger ml-auto">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

      </header>
      <div style="height: 150px; background-color: #2F2E33">

      </div>

      <?php
    }

  }

  ?>
