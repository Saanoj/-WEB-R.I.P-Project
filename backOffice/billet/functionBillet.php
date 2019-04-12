<?php
define('CONF', '../includehtml/config.php');

function backOfficeBillet()
{
  include (CONF);



  $query=$bdd->prepare("SELECT * FROM billettourisme");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    ?>
    <tr>
      <form method="POST" action="change.php">

        <input  name="id" type="hidden" value="<?php echo $member["idBillet"]?>"/>
        <td><?php echo $member["idBillet"]?> </td>
        <td><input name="nom" type="text" value="<?php echo $member["nom"]?>"/></td>
        <td><input name="isValide" type="text" value="<?php echo $member["isValide"]?>"/></td>
        <td><input name="villeBillet" type="text" value="<?php echo $member["villeBillet"]?>"/></td>
        <td><input name="prix" type="text" value="<?php echo $member["prix"]?>"/></td>
        <td>

          <button name="edit" type="submit" class="btn btn-warning">
            <span class="glyphicon glyphicon-edit"></span>
          </button>
        </form>
      </td>
      <form method="POST" action="change.php">
        <td>
          <input  name="id" type="hidden" value=" <?php echo $member["idBillet"]; ?> "/>
          <button  name = "drop" type="submit" class="btn btn-danger">
            Delete
            <span class="glyphicon glyphicon"></span>
          </button>
        </td>
      </form>
    </tr>
      <?php


    }

    ?>

    <tr>
      <form method="POST" action="change.php">
        <input  name="id" type="hidden"/>
        <td></td>
        <td><input name="nom" type="text"/></td>
        <td><input name="isValide" type="text"/></td>
        <td><input name="villeBillet" type="text" /></td>
        <td><input name="prix" type="text"/></td>

        <td>

          <button name="add" type="submit" class="btn btn-success">
            Add
            <span class="glyphicon glyphicon"></span>
          </button>
        </form>
      </td>
    </tr>

      <?php

    }

    function edit($id, $nom, $isValide, $villeBillet, $prix)
    {
      include (CONF);
      $query = $bdd->prepare("UPDATE billettourisme SET
        nom = :nom,
        isValide = :isValide,
        villeBillet = :villeBillet,
        prix = :prix
        WHERE idBillet = :id");
        $query->execute([
          "id"=> $id,
          "nom"=>$nom,
          "isValide"=>$isValide,
          "villeBillet"=>$villeBillet,
          "prix"=>$prix
        ]);
      }

      function add($nom, $isValide, $villeBillet, $prix){
        include (CONF);
        $query = $bdd->prepare("INSERT INTO billettourisme (nom, isValide, villeBillet, prix) VALUES (:nom,:isValide,:villeBillet,:prix)");
        $query->bindValue("nom",$nom);
        $query->bindValue("isValide",$isValide);
        $query->bindValue("villeBillet",$villeBillet);
        $query->bindValue("prix",$prix);
        $query->execute();
      }

      function drop($id)
      {
        include (CONF);
        $query = $bdd->prepare("DELETE FROM `billettourisme` WHERE idBillet = :id");
        $query->execute([
          "id"=>$id,

        ]);

      }
      ?>
