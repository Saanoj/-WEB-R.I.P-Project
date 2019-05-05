<?php
session_start();
require_once __DIR__ .'/require_class.php';

$bdd = new App\Database('rip');

$bdd->exec('DELETE FROM trajet WHERE idTrajet = ? ',[$_SESSION["idTrajet"]]);
$bdd->exec('DELETE FROM linkServicetrajet WHERE idTrajet = ? ',[$_SESSION["idTrajet"]]);

unset($_SESSION["idTrajet"]);
unset($_SESSION["trajet"]);

header("location: index.php");
?>
