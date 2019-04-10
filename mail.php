<?php

namespace App;
require 'Class/Autoloader.php';
Autoloader::register();
echo "hello";
function sendMail($to,$subject,$body)
{

  $mail = new Mail($to,$subject,$body);
  $mail->send();
}

 ?>
