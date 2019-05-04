<?php

require_once __DIR__ . '/Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');
session_start();



$res = $bdd->exec('INSERT INTO notifentreprise (idEntreprise,idClient,state) VALUES (?,?,?)',[$_GET["idEntreprise"], $_GET['idClient'], 0]);

echo $res;

 ?>
