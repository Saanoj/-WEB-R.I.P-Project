<?php

$headers  = "From: \"Administration\"<admin@zion.com>\n";;
$headers .= "X-Priority: 1\n";
$headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
$headers .= "Content-Transfer-Encoding: 8bit";

$subject  = 'ATTENTION CONNEXION Administration ZION !';



  $message  = "Bonjour, une connexion sur le compte admin vient d'etre signalé. \n\n";
  $message .= "Si cette persone n'est pas vous, veuillez contacter les autres administrateurs\n";
  $message .= "et changer votre mot de passe";

  $result = mail('byby77330@gmail.com', $subject, $message, $headers);
  var_dump($result);
?>

