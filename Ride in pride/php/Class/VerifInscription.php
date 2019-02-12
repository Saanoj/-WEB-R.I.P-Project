<?php

$db = new Bdd\Config('rip');
$datas = $db->query('SELECT * FROM users');
var_dump($datas);


?>