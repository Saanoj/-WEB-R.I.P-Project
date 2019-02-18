<?php




function chiffer ($password){
  $salage='SuP4rS4aL4g3';
  return hash('md5',$salage.$password);
}

//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------

function backOffice(){
  include ("config.php");



  $query=$bdd->prepare("SELECT id, email, last_name, first_name, birthday, gender, isAdmin, isBanned FROM USERS WHERE isBanned = 0");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    echo'
    <tr>
        <form method="POST" action="edit.php">
          <td><input name="mail" type="text" value="'.$member["email"].'"/></td>
          <td><input name="pseudo" type="text" value="'.$member["last_name"].'"/></td>
          <td><input name="pseudo" type="text" value="'.$member["last_name"].'"/></td>
          <td><input name="birthday" type="text" value="'.$member["birthday"].'"/></td>
          <td><input name="gender" type="text" value="'.$member["gender"].'"/></td>
          <td>
          <button type="submit" class="btn btn-blue">
            <span class="glyphicon glyphicon-edit"></span>
          </button>
          </form>
          </td>
        ';
        //bouton student
        if ($member["isAdmin"] == 1){
        echo '
        <td>
          <form method="POST" action="admin.php">
            <input  name="id" type="hidden" value="'.$member["id"].'"/>
            <button name="admin" type="submit" value="1" class="btn btn-success"></button>
          </form>
        </td>';
        }
        else {
          echo '
          <td>
            <form method="POST" action="admin.php">
              <input  name="id" type="hidden" value="'.$member["id"].'"/>
              <button name="admin" type="submit" value="0" class="btn btn-danger"></button>
            </form>
          </td>';
        }
        //bouton de ban
      echo'
      <td>
        <form method="GET" action="ban.php">
          <input  name="id" type="hidden" value="'.$member["id"].'"/>
          <button type="submit" class="btn btn-danger">
          </button>
        </form>
      </td>
    </tr>
    ';

  }
}


//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------
function showBanned(){
  include ("config.php");
  $query=$bdd->prepare("SELECT id, email, last_name, first_name, birthday, gender, isAdmin, isBanned FROM USERS WHERE isBanned = 1");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    echo'
    <tr>
    <td><input name="mail" type="text" value="'.$member["email"].'"/></td>
    <td><input name="pseudo" type="text" value="'.$member["last_name"].'"/></td>
    <td><input name="pseudo" type="text" value="'.$member["last_name"].'"/></td>
    <td><input name="birthday" type="text" value="'.$member["birthday"].'"/></td>
    <td><input name="gender" type="text" value="'.$member["gender"].'"/></td>
    ';
    if ($member["isAdmin"] == 1){
    echo '
    <td>
      <form method="POST" action="student.php">
        <input  name="mail" type="hidden" value="'.$member["id"].'"/>
        <button name="student" type="submit" value="1" class="btn btn-success"></button>
      </form>
    </td>';
    }
    else {
      echo '
      <td>
        <form method="POST" action="student.php">
          <input  name="mail" type="hidden" value="'.$member["id"].'"/>
          <button name="student" type="submit" value="0" class="btn btn-danger"></button>
        </form>
      </td>';
    }

    echo'
    <td>
      <form method="GET" action="unban.php">
        <input  name="mail" type="hidden" value="'.$member["Mail"].'"/>
        <button type="submit" class="btn btn-danger">
          <span class=""></span>
        </button>
      </form>
    </td>
  </tr>
  ';
  }
}

//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------
function ban($id){
  include ("config.php");
  $query = $bdd->prepare("UPDATE USERS SET isBanned = 1 WHERE id =:id");
  $query->execute(["id"=>$id]);
}

//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------

function unban($id){
  include ("config.php");
  $query = $bdd->prepare("UPDATE USERS SET isBanned = 0 WHERE id = :id");
  $query->execute(["id"=>$id]);
}
//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------

function edit($mail, $pseudo1, $birthday, $gender){
  include ("config.php");
  $query = $bdd->prepare("UPDATE USER SET mail = :mail, pseudo = :pseudo, birthday = :birthday, gender = :gender WHERE mail = :mail");
  $query->execute([
                  "mail"=>$mail,
                  "pseudo"=>$pseudo1,
                  "birthday"=>$birthday,
                  "gender"=>$gender
                  ]);
}

//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------
function admin($id, $admin){
  include ("config.php");
  if($admin == 0){
    $query = $bdd->prepare("UPDATE USERS SET isAdmin = 1 WHERE id =:id");
    $query->execute(["id"=>$id]);

  }elseif($admin == 1){
    $query = $bdd->prepare("UPDATE USERS SET isAdmin = 0 WHERE id =:id");
    $query->execute(["id"=>$id]);
  }
}

//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------
function pay($idpro,$montant){
  include ("config.php");

  $query=$bdd->prepare("SELECT * FROM PROJET WHERE id = $id");
  $query->execute();
  $donnees = $query->fetch();

  $montant = $montant+ $donnees['stat'];
  echo "<script> console.log('".$id."')</script>";
  $query = $bdd->prepare("UPDATE PROJET SET stat = :montant  WHERE id = $idpro");
  $query->execute(["montant"=>$montant]);
}


//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------

function projet(){
  include ("config.php");


  $query=$bdd->prepare("SELECT * FROM projet WHERE end = 0");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $projet){
    echo'
    <tr>
        <td>'.$projet["id"].'</td>
        <form method="POST" action="editProjet.php">
          <input name="id" type="hidden" value="'.$projet["id"].'"/>
          <td><input name="title" type="text" value="'.$projet["Title"].'"/></td>
          <td><input name="descc" type="text" value="'.$projet["Descc"].'"/></td>
          <td><input name="but" type="text" value="'.$projet["But"].'"/></td>
          <td><input name="stat" type="text" value="'.$projet["stat"].'"/></td>
          <td><input name="idEtudiant" type="text" value="'.$projet["idEtudiant"].'"/></td>
          <td>
          <button type="submit" class="btn btn-blue">
            <span class="glyphicon glyphicon-edit"></span>
          </button>
          </form>
          </td>
        ';
        //bouton student
        if ($projet["end"] == 1){
        echo '
        <td>
          <form method="POST" action="end.php">
            <input  name="id" type="hidden" value="'.$projet["id"].'"/>
            <button name="end" type="submit" value="1" class="btn btn-success"></button>
          </form>
        </td>';
        }
        else {
          echo '
          <td>
            <form method="POST" action="end.php">
              <input  name="id" type="hidden" value="'.$projet["id"].'"/>
              <button name="end" type="submit" value="0" class="btn"></button>
            </form>
          </td>';
        }
        //bouton de ban
      echo'
    </tr>
    ';

  }
}

//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------

function projetEnd(){
  include ("config.php");


  $query=$bdd->prepare("SELECT * FROM projet WHERE end = 1");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $projet){
    echo'
    <tr>
        <td>'.$projet["id"].'</td>
        <form method="POST" action="editProjet.php">
          <input name="id" type="hidden" value="'.$projet["id"].'"/>
          <td><input name="title" type="text" value="'.$projet["Title"].'"/></td>
          <td><input name="descc" type="text" value="'.$projet["Descc"].'"/></td>
          <td><input name="but" type="text" value="'.$projet["But"].'"/></td>
          <td><input name="stat" type="text" value="'.$projet["stat"].'"/></td>
          <td><input name="idEtudiant" type="text" value="'.$projet["idEtudiant"].'"/></td>
          <td>
          <button type="submit" class="btn btn-blue">
            <span class="glyphicon glyphicon-edit"></span>
          </button>
          </form>
          </td>
        ';
        //bouton student
        if ($projet["end"] == 1){
        echo '
        <td>
          <form method="POST" action="end.php">
            <input  name="id" type="hidden" value="'.$projet["id"].'"/>
            <button name="end" type="submit" value="1" class="btn btn-success"></button>
          </form>
        </td>';
        }
        else {
          echo '
          <td>
            <form method="POST" action="end.php">
              <input  name="id" type="hidden" value="'.$projet["id"].'"/>
              <button name="end" type="submit" value="0" class="btn"></button>
            </form>
          </td>';
        }
        //bouton de ban
      echo'
    </tr>
    ';

  }
}
//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------

function editProjet($id1, $title, $descc, $but, $stat, $idEtudiant){
  include ("config.php");
  $query = $bdd->prepare("UPDATE PROJET SET title = :title, descc = :descc, but = :but, stat = :stat, idEtudiant = :idEtudiant WHERE id = :id");
  $query->execute([
                  "title"=>$title,
                  "descc"=>$descc,
                  "but"=>$but,
                  "stat"=>$stat,
                  "idEtudiant"=>$idEtudiant,
                  "id"=>$id1
                  ]);
}

//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------
function end1($id1, $end){
  include ("config.php");

  if($end == 0){
    $query = $bdd->prepare("UPDATE PROJET SET  end = 1 WHERE id =:id");
    $query->execute(["id"=>$id1]);
    header("location: backOfficeProjet.php");

  }elseif($end == 1){
    $query = $bdd->prepare("UPDATE PROJET SET end = 0 WHERE id =:id");
    $query->execute(["id"=>$id1]);
    header("location: backOfficeProjetEnd.php");
  }
}

//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------

function contributeur(){
  include ("config.php");



  $query=$bdd->prepare("SELECT * FROM contributeur");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $contri){


    echo'
    <tr>

          <td>'.$contri["id"].'</td>'
          ;
          $idEtudiant=$contri['idEtudiant'];
          $query=$bdd->prepare("SELECT Pseudo FROM user where id = :id ");
          $query->execute(["id"=>$idEtudiant]);
          $query->execute();
          $result = $query->fetch();
          echo '<td>'.$result['Pseudo'].'</td>';



          $idProjet=$contri['idProjet'];
          $query=$bdd->prepare("SELECT * FROM projet where id = :id ");
          $query->execute(["id"=>$idProjet]);
          $query->execute();

          $projet = $query->fetch();
          echo '<td>'.$projet["Title"].'</td>';




          echo '

          <td>'.$contri["montant"].'</td>
          <td>
          <form method="GET" action="drop.php">
            <input  name="id" type="hidden" value="'.$contri["id"].'"/>
            <input  name="idpro" type="hidden" value="'.$projet["id"].'"/>
            <input  name="montant" type="hidden" value="'.$contri["montant"].'"/>
            <button type="submit" class="btn btn-danger">
              <span class="glyphicon glyphicon-remove-circle"></span>
            </button>
          </form>
          </td>
          ';
        //bouton de ban
      echo'
    </tr>
    ';

  }
}

//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------
function drop($idcontri,$idpro,$montant){
  include ("config.php");

  $query=$bdd->prepare("SELECT * FROM projet where id = :id ");
  $query->execute(["id"=>$idpro]);
  $query->execute();
  $projet = $query->fetch();
  $stat = $projet['stat'];

  $newstat = $stat - $montant ;

  echo $newstat;
  $query = $bdd->prepare("UPDATE PROJET SET stat = :montant WHERE id = $idpro");
  $query->execute(["montant"=>$newstat]);


  $query = $bdd->prepare("DELETE FROM contributeur WHERE id =:id");
  $query->execute(["id"=>$idcontri]);


}
 ?>
