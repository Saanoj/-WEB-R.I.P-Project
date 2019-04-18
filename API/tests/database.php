<?php

require_once __DIR__ . '/../utils/DatabaseManager.php';
require_once __DIR__ . '/../models/Attraction.php';

$db = DatabaseManager::getDatabase();
echo "ok ";

//$affectedRows = $db->exec('INSERT INTO Attraction (name,duration, capacity,min_height) VALUES (?, ?, ?, ?)', ['Space moutain',155,50,112]);

//echo $affectedRows;

$attractions = $db->getALL('SELECT * FROM Attraction WHERE name LIKE ?', ['%mountain%']);
print_r($attractions);

$a = new Attraction( 8, "test", 88, 10, 180);
echo $a;

?>
