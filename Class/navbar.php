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
              }else{
               include('navbar/navbarAdmin.php');
               }
            }else{
              include('navbar/navbarCustomer.php');
            }
          }
         else{
            include('navbar/navbar.php');
          }
    }

  }

?>
