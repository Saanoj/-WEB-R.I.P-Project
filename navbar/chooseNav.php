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
      $query=$bdd->prepare('SELECT isAdmin
      FROM USER WHERE id = :id');
      $query->bindValue(':id',$_SESSION['id'], PDO::PARAM_STR);
>>>>>>> faba875b73e192ec3963a804f1f383813391e774
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
