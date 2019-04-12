<?php
define('CONF', '../includehtml/config.php');

function backOfficeBillet()
{
  include (CONF);



  $query=$bdd->prepare("SELECT * FROM chambre");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    ?>
    <tr>
      <form method="POST" action="change.php">

        <input  name="id" type="hidden" value="<?php echo $member["idChambre"]?>"/>
        <td><?php echo $member["idChambre"]?> </td>
        <td><input name="typeChambre" type="text" value="<?php echo $member["typeChambre"]?>"/></td>
        <td><input name="idHotel" type="text" value="<?php echo $member["idHotel"]?>"/></td>
        <td><input name="litsDispo" type="text" value="<?php echo $member["litsDispo"]?>"/></td>
        <td><input name="isDispo" type="text" value="<?php echo $member["isDispo"]?>"/></td>
        <td>

          <button name="edit" type="submit" class="btn btn-warning">
            <span class="glyphicon glyphicon-edit"></span>
          </button>
        </form>
      </td>
      <form method="POST" action="change.php">
        <td>
          <input  name="id" type="hidden" value=" <?php echo $member["idChambre"]; ?> "/>
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
        <td><input name="typeChambre" type="text"/></td>
        <td><input name="idHotel" type="text"/></td>
        <td><input name="litsDispo" type="text" /></td>
        <td><input name="isDispo" type="text"/></td>

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

    function edit($id, $typeChambre, $idHotel, $litsDispo, $isDispo)
    {
      include (CONF);
      $query = $bdd->prepare("UPDATE chambre SET
        typeChambre = :typeChambre,
        idHotel = :idHotel,
        litsDispo = :litsDispo,
        isDispo = :isDispo
        WHERE idChambre = :id");
        $query->execute([
          "id"=> $id,
          "typeChambre"=>$typeChambre,
          "idHotel"=>$idHotel,
          "litsDispo"=>$litsDispo,
          "isDispo"=>$isDispo
        ]);
      }

      function add($typeChambre, $idHotel, $litsDispo, $isDispo){
        include (CONF);
        $query = $bdd->prepare("INSERT INTO chambre (typeChambre, idHotel, litsDispo, isDispo) VALUES (:typeChambre,:idHotel,:litsDispo,:isDispo)");
        $query->bindValue("typeChambre",$typeChambre);
        $query->bindValue("idHotel",$idHotel);
        $query->bindValue("litsDispo",$litsDispo);
        $query->bindValue("isDispo",$isDispo);
        $query->execute();
      }

      function drop($id)
      {
        include (CONF);
        $query = $bdd->prepare("DELETE FROM `chambre` WHERE idChambre = :id");
        $query->execute([
          "id"=>$id,

        ]);

      }
      ?>
