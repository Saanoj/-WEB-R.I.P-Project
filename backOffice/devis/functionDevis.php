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
        <td><input name="idTrajet" type="text" value="<?php echo $member["idTrajet"]?>"/></td>
        <td><input name="prixTrajet" type="text" value="<?php echo $member["prixTrajet"]?>"/></td>
        <td><input name="prixService" type="text" value="<?php echo $member["prixService"]?>"/></td>
        <td><input name="prixTotal" type="text" value="<?php echo $member["prixTotal"]?>"/></td>
        <td><input name="dateDevis" type="text" value="<?php echo $member["dateDevis"]?>"/></td>
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
        <td><input name="idTrajet" type="text"/></td>
        <td><input name="prixTrajet" type="text"/></td>
        <td><input name="prixService" type="text" /></td>
        <td><input name="prixTotal" type="text" /></td>
        <td><input name="dateDevis" type="text" /></td>
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

    function edit($id, $idTrajet, $prixTrajet, $prixService, $prixTotal, $dateDevis)
    {
      include (CONF);
      $query = $bdd->prepare("UPDATE devis SET
        idTrajet = :idTrajet,
        prixTrajet = :prixTrajet,
        prixService = :prixService,
        prixTotal = :prixTotal,
        dateDevis = :dateDevis
        WHERE idDevis = :id");
        $query->execute([
          "id"=> $id,
          "idTrajet"=>$idTrajet,
          "prixTrajet"=>$prixTrajet,
          "prixService"=>$prixTrajet,
          "prixTotal"=>$prixService,
          "dateDevis"=>$dateDevis
        ]);
      }

      function add($idTrajet, $prixTrajet, $prixService, $prixTotal, $dateDevis){
        include (CONF);
        $query = $bdd->prepare("INSERT INTO devis (idTrajet, prixTrajet, prixService, prixTotal, dateDevis)
        VALUES (:idTrajet, :prixTrajet, :prixService, :prixTotal, :dateDevis)");
        $query->execute([
          "idTrajet"=>$idTrajet,
          "prixTrajet"=>$prixTrajet,
          "prixService"=>$prixService,
          "prixTotal"=>$prixTotal,
          "dateDevis"=>$dateDevis
        ]);
      }

      function drop($id)
      {
        include (CONF);
        $query = $bdd->prepare("DELETE FROM `devis` WHERE idDevis = :id");
        $query->execute([
          "id"=>$id

        ]);

      }
      ?>
