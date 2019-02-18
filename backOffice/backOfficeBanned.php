<?php
session_start();
include '../include/config.php';
include '../include/fonction.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- PAGE settings -->
  <link rel="icon" href="https://templates.pingendo.com/assets/Pingendo_favicon.ico">
  <title>Lift me up</title>
  <meta name="description" content="Wireframe design of an album page by Pingendo">
  <meta name="keywords" content="Pingendo bootstrap example template wireframe album ">
  <meta name="author" content="Pingendo">
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="../CSS/flat.css" type="text/css">
</head>

      <body>
      <?php
        if(isset($_SESSION['mail'])){
          $query=$bdd->prepare('SELECT admin, pseudo
          FROM USER WHERE mail = :mail');
          $query->bindValue(':mail',$_SESSION['mail'], PDO::PARAM_STR);
          $query->execute();
          $data=$query->fetch();
          if($data['admin'] == 1){
             include('../Navbar/NavbarBackOffice.php');
          }
        else{
          header("Location:../index.php");
        }
      }
      else {
        header("Location:../index.php");
      }

      ?>

      <br>
      <br>
      <div class="container">
        <h1>Banned Guide Table</h1>
        <table class="table">
          <thead>
            <tr>
              <<th scope="col">Mail</th>
              <th scope="col">Nom</th>
              <th scope="col">Prenom</th>
              <th scope="col">Date de naissance</th>
              <th scope="col">Sexe</th>
              <th scope="col">Admin</th>
              <th scope="col">Ban</th>
            </tr>
          </thead>
          <?php showBanned();
          ?>
        </table>
      </div>
    </body>
</html>
