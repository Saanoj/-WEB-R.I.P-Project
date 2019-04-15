<?php
require('smsenvoi.php');


$smsenvoi=new smsenvoi();
$smsenvoi->debug=true;

//Passage d'un appel :
$smsenvoi->sendCALL('+33xxxxxxx','Bonjour voici un test');



//Obtention des crédits restants :
$credits=$smsenvoi->checkCredits();

//Les crédits call['PHONE'] correspondent aux crédits vers les lignes fixes
//Les crédits call['MOBILEPHONE'] correspondent aux crédits vers les lignes mobiles


?>