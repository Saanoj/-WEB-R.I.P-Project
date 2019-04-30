<?php
define('CONF', '../includehtml/config.php');

function backOfficeHotel()
{
  include (CONF);



  $query=$bdd->prepare("SELECT * FROM hotel");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    ?>
    <tr>
      <form method="POST" action="change.php">

        <input  name="id" type="hidden" value="<?php echo $member["idHotel"]?>"/>
        <td><?php echo $member["idHotel"]?> </td>
        <td><input name="nom" type="text" value="<?php echo $member["nom"]?>"/></td>
        <td><input name="adresseHotel" type="text" value="<?php echo $member["adresseHotel"]?>"/></td>
        <td>
          <button name="edit" type="submit" class="btn btn-warning">
            edit
            <span class="glyphicon glyphicon-edit"></span>
          </button>
        </form>
      </td>
      <form method="POST" action="change.php">
        <td>
          <input  name="id" type="hidden" value=" <?php echo $member["idFacture"]; ?> "/>
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
        <td></td>
        <td><input name="nom" type="text"/></td>
        <td><input name="adresseHotel" type="text" /></td>
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

    function edit($id, $nom, $adresseHotel)
    {
      include (CONF);
      $query = $bdd->prepare("UPDATE hotel SET
        nom = :nom,
        adresseHotel = :adresseHotel
        WHERE idHotel = :id");
        $query->execute([
          "id"=> $id,
          "nom"=>$nom,
          "adresseHotel"=>$adresseHotel
        ]);
      }

      function add($nom, $adresseHotel){
        include (CONF);
        $query = $bdd->prepare("INSERT INTO hotel (nom, adresseHotel)
        VALUES (:nom, :adresseHotel)");
        $query->execute([
          "nom"=>$nom,
          "adresseHotel"=>$adresseHotel
        ]);
      }

      function drop($id)
      {
        include (CONF);
        $query = $bdd->prepare("DELETE FROM `hotel` WHERE idHotel = :id");
        $query->execute([
          "id"=>$id

        ]);

      }
      ?>
