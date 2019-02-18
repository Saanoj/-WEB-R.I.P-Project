<?php

namespace App;
use \PDO;


require 'Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');
$id = $_POST['id'];
$newval = $_POST['newval'] ;
$columnName  = $_POST['newid'] ;

/*
ChromePhp::log($id);
ChromePhp::log($newval);
ChromePhp::log($nameRaw);
*/

$req = $bdd->getPDO()->prepare('UPDATE users SET '.$columnName.' = :columnValue WHERE id =:id');
$req->bindValue(':columnValue', $newval);
$req->bindValue(':id', $id);
$req->execute();
$req->closeCursor();
<<<<<<< HEAD




  
=======
echo "string";
//header('location:Profil.php?c fait');
exit;
>>>>>>> 97880055f76ba46b67dea478cb9d3d15894a5434



?>
