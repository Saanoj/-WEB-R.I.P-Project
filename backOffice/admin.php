<?php
include '../include/fonction.php';
include ("../include/config.php");

$id=$_POST["id"];
$admin=$_POST["admin"];
echo $id;
echo $admin;

if($admin == 0){
  $query = $bdd->prepare("UPDATE USERS SET isAdmin = 1 WHERE id =:id");
  $query->execute(["id"=>$id]);

}elseif($admin == 1){
  $query = $bdd->prepare("UPDATE USERS SET isAdmin = 0 WHERE id =:id");
  $query->execute(["id"=>$id]);
}

//admin($id,$admin);
//header("location: backOffice.php");
