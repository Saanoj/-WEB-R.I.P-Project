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

          }else{
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
      ?>
      <header class="header">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="header_content d-flex flex-row align-items-center justify-content-start">
                <div class="header_content_inner d-flex flex-row align-items-end justify-content-start">
                  <div class="logo"><a href="index2.php">Ride in Pride</a></div>
                  <nav class="main_nav">
                    <ul class="d-flex flex-row align-items-start justify-content-start">

                      <?php if ($where == "reservation") {?>
                        <li><a href="annulerReservation.php">Annuler la reservation</a></li>
                      <?php }else{

                        if ($where == "customer" ||$where == "admin" ||$where == "backOffice" ) {
                          if($where == "admin" || $where == "customer"){
                            ?>
                            <li><a href="index2.php">Accueil</a></li>
                            <?php if ($where == "admin") { ?>
                              <li><a href="backOffice/Users/backOfficeUsers.php">Back Office</a></li>
                            <?php } ?>
                            <li><a href="profil.php">Profil</a></li>
                            <li><a href="contact.php">Contactez nous</a></li>
                          <?php }else{?>
                            <li><a href="../../index2.php">Accueil</a></li>
                            <li><a href="../../profil.php">Profil</a></li>
                            <li><a href="../../deconnexion.php">Deconnexion</a></li>
                          <?php } ?>
                        <?php }?>

                        <?php // si il est connecter ou pas
                        if ($where == "normal"){ ?>
                          <li><a href="index.php">Accueil</a></li>
                          <li><a href="inscription.php">Inscription</a></li>
                          <li><a href="connexion.php">Connexion</a></li>
                          <li><a href="contact.php">Contactez nous</a></li>
                        <?php }else{ ?>
                          <li><a href="deconnexion.php">Deconnextion</a></li>
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
