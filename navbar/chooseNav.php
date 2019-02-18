<?php
namespace App;
use \PDO;

require 'Class/Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');
if(isset($_SESSION['id'])){
      $query=$bdd->prepare('SELECT isAdmin
      FROM USER WHERE id = :id');
      $query->bindValue(':id',$_SESSION['id'], PDO::PARAM_STR);
      $query->execute();
      $data=$query->fetch();
      if($data['isAdmin'] == 1){
         include('Navbar/NavbarAdmin.php');
         include('navbarAdmin.php');
      }else{
        include('navbarCustomer.php');
      }
    }
   else{
      include('Navbar/Navbar.php');
      include('navbar.php');
    }

 ?>
?>
