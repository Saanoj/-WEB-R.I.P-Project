<?php

namespace App;
require_once 'Class/Autoloader.php';
Autoloader::register();


function sendMail($to,$subject,$body)
{
  $mail = new Mail($to,$subject,$body);
  $mail->send();
}

 ?>
