<?php
namespace App;

use \PDO;

/**
* Navbar
*/
class Navbar
{
  private $backOffice;
  public function __construct($backOffice)
  {
    $this->backOffice=$backOffice;
  }
  public function getBackOffice() {return $this->backOffice;}

  public function navbar()
  {
    $bdd = new Database('rip');
    $backOffice = $this->getBackOffice();
    if(isset($_SESSION['id'])){
      $session = new Session($_SESSION['id']);
      $id = $session->getId();
      $query=$bdd->getPDO()->prepare('SELECT isAdmin
        FROM users WHERE id = :id');
        $query->bindValue(':id',$_SESSION['id']);
        $query->execute();
        $data=$query->fetch();



        if($data['isAdmin'] == 1){
          if ($backOffice == 1){
            include('../navbar/NavbarBackOffice.php');
          }elseif ($backOffice == 2) {
            include('../../navbar/NavbarBackOfficeUsers.php');
          }elseif ($backOffice == 3){
            include('navbar/navbarReservation.php');
          }else{
            include('navbar/navbarAdmin.php');
          }
        }elseif($backOffice !=0 && $backOffice != 3){
          header('Location:http://localhost/-WEB-R.I.P-Project/notConnect.php');
        }elseif($backOffice==3){
          include('navbar/navbarReservation.php');
        }else{
          include('navbar/navbarCustomer.php');
        }
      }elseif($backOffice !=0){
        header('Location:http://localhost/-WEB-R.I.P-Project/notConnect.php');
      }else{
        include('navbar/navbar.php');
      }
    }

  }

  ?>
