<?php
include('../config.php');

if(isset($_SESSION['id'])){
      $query=$bdd->prepare('SELECT isAdmin
      FROM users WHERE id = :id');
      $query->bindValue(':id',$_SESSION['id']);
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
