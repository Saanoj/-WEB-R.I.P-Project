<?php

namespace App;
use \PDO;


require 'Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');
$id = $_POST['id'] 
$newval = $_POST['newval'] ;
$nameRaw  = $_POST['newid'] ;
$req->getPDO()->prepare('UPDATE users SET nameRaw = :nameRaw WHERE id =:id');
$req->bindValue(':nameRaw', $nameRaw);
$req->bindValue(':id', $id);
$req->execute();
$req->closeCursor();




  


?>