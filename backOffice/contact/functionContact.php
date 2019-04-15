<?php
define('CONF', '../includehtml/config.php');

function backOfficeContact()
{
  include (CONF);



  $query=$bdd->prepare("SELECT * FROM contact");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    ?>
    <tr>
      <form method="POST" action="change.php">

        <input  name="id" type="hidden" value="<?php echo $member["idContact"]?>"/>
        <td><?php echo $member["idContact"]?> </td>
        <td><input name="idClient" type="text" value="<?php echo $member["idClient"]?>"/></td>
        <td><input name="nameClient" type="text" value="<?php echo $member["nameClient"]?>"/></td>
        <td><input name="phoneNumber" type="text" value="<?php echo $member["phoneNumber"]?>"/></td>
        <td><input name="messageContact" type="text" value="<?php echo $member["messageContact"]?>"/></td>
        <td><input name="dateContact" type="text" value="<?php echo $member["dateContact"]?>"/></td>
        <td>

          <button name="edit" type="submit" class="btn btn-warning">
            edit
            <span class="glyphicon glyphicon-edit"></span>
          </button>
        </form>
      </td>
      <form method="POST" action="change.php">
        <td>
          <input  name="id" type="hidden" value=" <?php echo $member["idContact"]; ?> "/>
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
        <td><input name="idClient" type="text"/></td>
        <td><input name="nameClient" type="text"/></td>
        <td><input name="phoneNumber" type="text" /></td>
        <td><input name="messageContact" type="text"/></td>
        <td><input name="dateContact" type="text"/></td>

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

    function edit($id, $idClient, $nameClient, $phoneNumber, $messageContact, $dateContact)
    {
      include (CONF);
      $query = $bdd->prepare("UPDATE contact SET
        idClient = :idClient,
        nameClient = :nameClient,
        phoneNumber = :phoneNumber,
        messageContact = :messageContact,
        dateContact = :dateContact
        WHERE idContact = :id");
        $query->execute([
          "id"=> $id,
          "idClient"=>$idClient,
          "nameClient"=>$nameClient,
          "phoneNumber"=>$phoneNumber,
          "messageContact"=>$messageContact,
          "dateContact"=>$dateContact
        ]);
      }

      function add($idClient, $nameClient, $phoneNumber, $messageContact, $dateContact){
        include (CONF);
        $query = $bdd->prepare("INSERT INTO contact (idClient, nameClient, phoneNumber, messageContact, dateContact) VALUES (:idClient, :nameClient, :phoneNumber, :messageContact, :dateContact)");
        $query->bindValue("idClient",$idClient);
        $query->bindValue("nameClient",$nameClient);
        $query->bindValue("phoneNumber",$phoneNumber);
        $query->bindValue("messageContact",$messageContact);
        $query->bindValue("dateContact",$dateContact);
        $query->execute();
      }

      function drop($id)
      {
        include (CONF);
        $query = $bdd->prepare("DELETE FROM `contact` WHERE idContact = :id");
        $query->execute([
          "id"=>$id,

        ]);

      }
      ?>
