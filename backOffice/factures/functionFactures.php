<?php
define('CONF', '../includehtml/config.php');

function backOfficeEntreprise()
{
  include (CONF);



  $query=$bdd->prepare("SELECT * FROM entreprise");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    ?>
    <tr>
      <form method="POST" action="change.php">

        <input  name="id" type="hidden" value="<?php echo $member["idEntreprise"]?>"/>
        <td><?php echo $member["idEntreprise"]?> </td>
        <td><input name="nameEntreprise" type="text" value="<?php echo $member["nameEntreprise"]?>"/></td>
        <td><input name="numEntreprise" type="text" value="<?php echo $member["numEntreprise"]?>"/></td>
        <td><input name="adresse" type="text" value="<?php echo $member["adresse"]?>"/></td>
        <td><input name="numSiret" type="text" value="<?php echo $member["numSiret"]?>"/></td>
        <td><input name="idDirecteur" type="text" value="<?php echo $member["idDirecteur"]?>"/></td>
        <td><input name="nbSalarie" type="text" value="<?php echo $member["nbSalarie"]?>"/></td>
        <td><input name="pays" type="text" value="<?php echo $member["pays"]?>"/></td>
        <td>
          <button name="edit" type="submit" class="btn btn-warning">
            edit
            <span class="glyphicon glyphicon-edit"></span>
          </button>
        </form>
      </td>
      <form method="POST" action="change.php">
        <td>
          <input  name="id" type="hidden" value=" <?php echo $member["idEntreprise"]; ?> "/>
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
        <td><input name="nameEntreprise" type="text"/></td>
        <td><input name="numEntreprise" type="text"/></td>
        <td><input name="adresse" type="text" /></td>
        <td><input name="numSiret" type="text" /></td>
        <td><input name="idDirecteur" type="text" /></td>
        <td><input name="nbSalarie" type="text" /></td>
        <td><input name="pays" type="text" /></td>
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

    function edit($id, $nameEntreprise, $numEntreprise, $adresse, $numSiret, $idDirecteur, $nbSalarie, $pays)
    {
      include (CONF);
      $query = $bdd->prepare("UPDATE entreprise SET
        nameEntreprise = :nameEntreprise,
        numEntreprise = :numEntreprise,
        adresse = :adresse,
        numSiret = :numSiret,
        idDirecteur = :idDirecteur,
        nbSalarie = :nbSalarie,
        pays = :pays
        WHERE idEntreprise = :id");
        $query->execute([
          "id"=> $id,
          "nameEntreprise"=>$nameEntreprise,
          "numEntreprise"=>$numEntreprise,
          "adresse"=>$adresse,
          "numSiret"=>$numSiret,
          "idDirecteur"=>$idDirecteur,
          "nbSalarie"=>$nbSalarie,
          "pays"=>$pays
        ]);
      }

      function add($nameEntreprise, $numEntreprise, $adresse, $numSiret, $idDirecteur, $nbSalarie, $pays){
        include (CONF);
        $query = $bdd->prepare("INSERT INTO entreprise (nameEntreprise, numEntreprise, adresse, numSiret, idDirecteur, nbSalarie, pays) VALUES (:nameEntreprise, :numEntreprise, :adresse, :numSiret, :idDirecteur, :nbSalarie, :pays)");
        $query->execute([
          "nameEntreprise"=>$nameEntreprise,
          "numEntreprise"=>$numEntreprise,
          "adresse"=>$adresse,
          "numSiret"=>$numSiret,
          "idDirecteur"=>$idDirecteur,
          "nbSalarie"=>$nbSalarie,
          "pays"=>$pays
        ]);
      }

      function drop($id)
      {
        include (CONF);
        $query = $bdd->prepare("DELETE FROM `entreprise` WHERE idEntreprise = :id");
        $query->execute([
          "id"=>$id

        ]);

      }
      ?>
