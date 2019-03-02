<?php
session_start();
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');

$bdd->queryPrepareForWhile('DELETE FROM linkServicetrajet WHERE idTrajet='.$_SESSION["idTrajet"].'',$bdd);
$bdd->queryPrepareForWhile('DELETE FROM trajet WHERE idTrajet='.$_SESSION["idTrajet"].'',$bdd);
unset($_SESSION["idTrajet"]);

header("location: index.php");
?>
