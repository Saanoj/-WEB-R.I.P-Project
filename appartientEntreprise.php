<?php 
namespace App;
use \PDO;
session_start();
require_once __DIR__ .'/require_class.php';
$bdd = new Database('rip');

if ($_GET['isValide'] == 0)
{
header('location:abonnement.php');
} 
if ($_GET['isValide'] == 1)
{
header('location:abonnement.php');
} 
