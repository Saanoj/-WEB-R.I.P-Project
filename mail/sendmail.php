<?php
echo "SSL = ".!extension_loaded('openssl')?"Not Available <br>":"Available <br>";
use PHPMailer\PHPMailer\PHPMailer;
include_once "PHPMailer/PHPMailer.php";
include_once "PHPMailer/Exception.php";
include_once "PHPMailer/SMTP.php";
$mail = new PHPMailer();

$mail->Host = "ssl://smtp.gmail.com";
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Username = MAIL;
$mail->Password = PASS;
$mail->SMTPSecure = "ssl"; //tls;
$mail->Port = 465; //587

$mail->addAddress("jonasnizard@gmail.com");
$mail->setFrom("jonasnizard@gmail.com");
$mail->Subject = "hello there";
$mail->isHTML(true);
$mail->Body = "heloooooooo";

try {
  $mail->send();
} catch (\Exception $e) {
  echo $e;
}



if ($mail->send()){
  echo "Je l'ai envoyez maitre, Igor";
}else {

  echo $mail->ErrorInfo;
}

 ?>
