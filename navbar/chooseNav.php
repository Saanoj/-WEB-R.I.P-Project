<?php
require 'Class/Autoloader.php';
$bdd = new Database('rip');
if(isset($_SESSION['id'])){
      $query=$bdd->prepare('SELECT isAdmin
      FROM USER WHERE id = :id');
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
