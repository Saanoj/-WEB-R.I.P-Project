<?php
define('CONF', '../includehtml/config.php');
function backOfficeAbo()
{
  include (CONF);



  $query=$bdd->prepare("SELECT * FROM abonnement");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    echo'
    <tr>
        <form method="POST" action="edit.php">

          <input  name="id" type="hidden" value="'.$member["idAbonnement"].'"/>
          <td>'.$member["idAbonnement"].'</td>
          <td><input name="typeAbonnement" type="text" value="'.$member["typeAbonnement"].'"/></td>
          <td><input name="isEngagement" type="text" value="'.$member["isEngagement"].'"/></td>
          <td>

          <button type="submit" class="btn btn-warning">
            <span class="glyphicon glyphicon-edit"></span>
          </button>
          </form>
          </td>
          <form method="POST" action="drop.php">
          <td>
          <input  name="id" type="hidden" value="'.$member["idAbonnement"].'"/>
          <button type="submit" class="btn btn-danger">
            Delete
            <span class="glyphicon glyphicon"></span>
          </button>
          </td>
          </form>
        ';


  }
  echo'
  <tr>
      <form method="POST" action="add.php">
      <input  name="id" type="hidden"/>
      <td></td>
      <td><input name="typeAbonnement" type="text"/></td>
      <td><input name="isEngagement" type="text"/></td>

        <td>

        <button type="submit" class="btn btn-success">
          Add
          <span class="glyphicon glyphicon"></span>
        </button>
        </form>
        </td>
      ';
}
function edit($id,$typeAbonnement, $isEngagement){
  include (CONF);
  $query = $bdd->prepare("UPDATE abonnement SET
    typeAbonnement = :typeAbonnement,
    isEngagement = :isEngagement
    WHERE idAbonnement = :id");
  $query->execute([
                  "id"=> $id,
                  "typeAbonnement"=>$typeAbonnement,
                  "isEngagement"=>$isEngagement
                  ]);
}
function add($typeAbonnement, $isEngagement){
  include (CONF);
  $query = $bdd->prepare("INSERT INTO abonnement (typeAbonnement, isEngagement) VALUES
    (
      :typeAbonnement,
      :isEngagement
  )
    ");
  $query->execute([
    "typeAbonnement"=>$typeAbonnement,
    "isEngagement"=>$isEngagement
                  ]);
}

function drop($id)
{
  include (CONF);
  $query = $bdd->prepare("DELETE FROM `abonnement` WHERE idAbonnement = :id");
  $query->execute([
                  "id"=>$id,

                  ]);

}
 ?>
