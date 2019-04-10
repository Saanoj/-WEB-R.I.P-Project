<?php

  require 'Class/Autoloader.php';
  App\Autoloader::register();
  $mail = new App\Mail('jonasnizard@gmail.com','Abo','Renouvelle tous stp ');
  $mail->send();

 ?>
