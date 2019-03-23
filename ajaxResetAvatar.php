<?php

require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');
session_start();


$req=$bdd->getPDO()->prepare('UPDATE users SET avatar=:avatar WHERE id=:id');
$req->bindValue(':id', $_SESSION["id"]);
$req->bindValue(':avatar', "ripdefaultavatar.png");
$req->execute();
$req->closeCursor();

echo "Image remise à celle par défault";
?>
