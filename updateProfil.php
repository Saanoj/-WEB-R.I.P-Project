<?php


require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');
$id = $_POST['id'];
$newval = $_POST['newval'] ;
$columnName  = $_POST['newid'] ;


$req = $bdd->getPDO()->prepare('UPDATE users SET '.$columnName.' = :columnValue WHERE id =:id');
$req->bindValue(':columnValue', $newval);
$req->bindValue(':id', $id);
$req->execute();
$req->closeCursor();


exit;



?>
