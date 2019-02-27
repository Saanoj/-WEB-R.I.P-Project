<?php
namespace App;

use \PDO;

/**
 * Navbar
 */
class Navbar
{

  public function navbar($backOffice)
  {

      $bdd = new Database('rip');
      if(isset($_SESSION['id'])){
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
              }
              else{
               include('navbar/navbarAdmin.php');
               }
            }elseif($backOffice !=0){
              header('Location:http://localhost/-WEB-R.I.P-Project/notConnect.php');
            }
            else{
              include('navbar/navbarCustomer.php');
            }
          }
          elseif($backOffice !=0){
            header('Location:http://localhost/-WEB-R.I.P-Project/notConnect.php');
          }else{
            include('navbar/navbar.php');
          }
    }

  }

?>
