<?php
define('CONF', '../includehtml/config.php');

function backOfficeRemuneration()
{
  include (CONF);



  $query=$bdd->prepare("SELECT * FROM remuneration");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    ?>
    <tr>
      <form method="POST" action="change.php">

        <input  name="id" type="hidden" value="<?php echo $member["idRemuneration"]?>"/>
        <td><?php echo $member["idRemuneration"]?> </td>
        <td><input name="idCollab" type="text" value="<?php echo $member["idCollab"]?>"/></td>
        <td><input name="idTrajet" type="text" value="<?php echo $member["idTrajet"]?>"/></td>
        <td><input name="Price" type="text" value="<?php echo $member["Price"]?>"/></td>
        <td>
          <button name="edit" type="submit" class="btn btn-warning">
            edit
            <span class="glyphicon glyphicon-edit"></span>
          </button>
        </form>
      </td>
      <form method="POST" action="change.php">
        <td>
          <input  name="id" type="hidden" value=" <?php echo $member["idRemuneration"]; ?> "/>
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
        <td><input name="idCollab" type="text"/></td>
        <td><input name="idTrajet" type="text"/></td>
        <td><input name="Price" type="text" /></td>
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

    function edit($id, $idCollab, $idTrajet, $Price)
    {
      include (CONF);
      $query = $bdd->prepare("UPDATE remuneration SET
        idCollab = :idCollab,
        idTrajet = :idTrajet,
        prixPriceServices = :Price
        WHERE idRemuneration = :id");
        $query->execute([
          "id"=> $id,
          "idCollab"=>$idCollab,
          "prixTrajet"=>$prixTrajet,
          "Price"=>$Price
        ]);
      }

      function add($idCollab, $idTrajet, $Price){
        include (CONF);
        $query = $bdd->prepare("INSERT INTO remuneration (idCollab, idTrajet, prixServices)
        VALUES (:idCollab, :prixTrajet, :prixServices)");
        $query->bindValue("idCollab",$idCollab);
        $query->bindValue("idTrajet",$idTrajet);
        $query->bindValue("Price",$Price);
        $query->execute();
      }

      function drop($id)
      {
        include (CONF);
        $query = $bdd->prepare("DELETE FROM `remuneration` WHERE idRemuneration = :id");
        $query->execute([
          "id"=>$id

        ]);

      }
      ?>
