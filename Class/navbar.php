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
        if($type !=0){
          if($type == 1){
            $where = "reservation";
          }
        }elseif($data['isAdmin'] == 1){
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
          $where = "costomer";
        }
      }elseif($type == 2){
        header('Location:http://localhost/R.I.P-Project/notConnect.php');
      }else{
        $where = "normal";
      }
      $this->showNav($where);
    }

    public function showNav(string $where)
    {
      echo '<header class="header">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="header_content d-flex flex-row align-items-center justify-content-start">
                <div class="header_content_inner d-flex flex-row align-items-end justify-content-start">
                  <div class="logo"><a href="index.php">Ride in Pride</a></div>
                  <nav class="main_nav">
                    <ul class="d-flex flex-row align-items-start justify-content-start">
                      <li class="active"><a href="index.html">Accueil</a></li>
                      <li><a href="#">Services</a></li>
                      <li><a href="contact.html">Contactez nous</a></li>
                      <li><a href="inscription.php">Inscription</a></li>
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

      </header>';
    }

  }

  ?>
