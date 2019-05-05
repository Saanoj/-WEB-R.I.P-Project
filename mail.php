<?php

namespace App;
require_once __DIR__ . '/require_class.php';



function sendMail($to,$subject,$body)
{
  $mail = new Mail($to,$subject,$body);
  $mail->send();
}

 ?>
