<?php

  require 'Class/Autoloader.php';
  App\Autoloader::register();
  $mail = new App\Mail($_POST['to'],$_POST['subject'],$_POST['body']);
  $mail->send();

 ?>
