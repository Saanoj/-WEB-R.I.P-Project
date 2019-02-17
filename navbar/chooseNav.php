<?php
namespace App;
use \PDO;

require '../Class/Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');
if(isset($_SESSION['id'])){
      $query=$bdd->getPDO()->prepare('SELECT isAdmin
      FROM users WHERE id = :id');
      $query->bindValue(':id',$_SESSION['id'], PDO::PARAM_STR);
      $query->execute();
      $data=$query->fetch();
      if($data['isAdmin'] == 1){
         include('navbarAdmin.php');
      }else{
        nclude('navbarCustomer.php');
      }
    }
   else{
      include('navbar.php');
    }
?>
