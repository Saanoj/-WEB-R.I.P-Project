<?php
define('CONF', '../includehtml/config.php');

function backOfficeDevis()
{
  include (CONF);



  $query=$bdd->prepare("SELECT * FROM devis");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    ?>
    <tr>
      <form method="POST" action="change.php">

        <input  name="id" type="hidden" value="<?php echo $member["idDevis"]?>"/>
        <td><?php echo $member["idDevis"]?> </td>
        <td><input name="isValide" type="text" value="<?php echo $member["isValide"]?>"/></td>
        <td><input name="prixTrajet" type="text" value="<?php echo $member["prixTrajet"]?>"/></td>
        <td><input name="prixServices" type="text" value="<?php echo $member["prixServices"]?>"/></td>
        <td>
          <button name="edit" type="submit" class="btn btn-warning">
            edit
            <span class="glyphicon glyphicon-edit"></span>
          </button>
        </form>
      </td>
      <form method="POST" action="change.php">
        <td>
          <input  name="id" type="hidden" value=" <?php echo $member["idDevis"]; ?> "/>
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
        <td><input name="isValide" type="text"/></td>
        <td><input name="prixTrajet" type="text"/></td>
        <td><input name="prixServices" type="text" /></td>
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

    function edit($id, $isValide, $prixTrajet, $prixServices)
    {
      include (CONF);
      $query = $bdd->prepare("UPDATE devis SET
        isValide = :isValide,
        prixTrajet = :prixTrajet,
        prixServices = :prixServices
        WHERE idDevis = :id");
        $query->execute([
          "id"=> $id,
          "isValide"=>$isValide,
          "prixTrajet"=>$prixTrajet,
          "prixServices"=>$prixServices
        ]);
      }

      function add($isValide, $prixTrajet, $prixServices){
        include (CONF);
        $query = $bdd->prepare("INSERT INTO devis (isValide, prixTrajet, prixServices) VALUES (:isValide, :prixTrajet, :prixServices)");
        $query->bindValue("isValide",$isValide);
        $query->bindValue("prixTrajet",$prixTrajet);
        $query->bindValue("prixServices",$prixServices);
        $query->execute();
      }

      function drop($id)
      {
        include (CONF);
        $query = $bdd->prepare("DELETE FROM `contact` WHERE idDevis = :id");
        $query->execute([
          "id"=>$id,

        ]);

      }
      ?>
