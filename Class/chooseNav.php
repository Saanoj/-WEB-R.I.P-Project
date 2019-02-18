<?php
namespace App;
use \PDO;


require 'Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');

if(isset($_SESSION['id'])){
      $query=$bdd->getPDO()->prepare('SELECT isAdmin
      FROM users WHERE id = :id');
      $query->bindValue(':id',$_SESSION['id']);
      $query->execute();
      $data=$query->fetch();
      if($data['isAdmin'] == 1){
         include('navbar/navbarAdmin.php');
      }else{
        include('navbar/navbarCustomer.php');
      }
    }
   else{
      include('navbar/navbar.php');
    }
?>
