<?php
<<<<<<< HEAD


$bdd = new PDO('mysql:host=localhost;dbname=rip', 'root', '');

if(isset($_SESSION['id'])){
      $query=$bdd->prepare('SELECT isAdmin
      FROM users WHERE id = :id');
      $query->bindValue(':id',$_SESSION['id']);
=======
namespace App;
use \PDO;

require '../Class/Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');
if(isset($_SESSION['id'])){
      $query=$bdd->getPDO()->prepare('SELECT isAdmin
      FROM users WHERE id = :id');
      $query->bindValue(':id',$_SESSION['id'], PDO::PARAM_STR);
>>>>>>> 0a5438c8cddd508fb27cfa0231c86529536092c4
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
