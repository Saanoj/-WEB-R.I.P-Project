<?php

public function sendMail(string $to, string $subject,string $body):bool
{
  require 'Class/Autoloader.php';
  use App\
  App\Autoloader::register();
  $mail = new Mail($to,$subject,$body);
  if($mail->send()){
    return true;
  }else {
    return false;
  }
}

 ?>
