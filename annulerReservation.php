<?php
session_start();
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');

$bdd->exec('DELETE FROM trajet WHERE idTrajet = ? ',[$_SESSION["idTrajet"]]);
$bdd->exec('DELETE FROM linkServicetrajet WHERE idTrajet = ? ',[$_SESSION["idTrajet"]]);

unset($_SESSION["idTrajet"]);
unset($_SESSION["trajet"]);

header("location: index.php");
?>
