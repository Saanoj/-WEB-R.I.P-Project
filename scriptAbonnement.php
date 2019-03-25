<?php 

require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');

$req = $bdd->getPDO()->prepare("UPDATE users SET first_name = 'Jean' WHERE id=22");
$req->execute();


?>
