<?php


use PHPMailer\PHPMailer\PHPMailer;
include_once "PHPMailer/PHPMailer.php";
include_once "PHPMailer/Exception.php";
include_once "PHPMailer/SMTP.php";
/*
$mail = new PHPMailer();

$mail->Host = "ssl://smtp.gmail.com";
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Username = "Welovezhuli77";
$mail->Password = "Welovezhuli77";
$mail->SMTPSecure = "ssl"; //tls
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
*/

define ('GUSER','TonMail');
define ('GPWD','tonMDP');

smtpmailer("hallierarthur@gmail.com","hallierarthur@gmail.com","Arthur","Test","Body");


// make a separate file and include this file in that. call this function in that file.

function smtpmailer($to, $from, $from_name, $subject, $body) { 
    global $error;
    $mail = new PHPMailer();  // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true;  // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
    $mail->SMTPAutoTLS = false;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;

    $mail->Username = GUSER;  
    $mail->Password = GPWD;           
    $mail->SetFrom($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    if(!$mail->Send()) {
        $error = 'Mail error: '.$mail->ErrorInfo; 
        return false;
    } else {
        $error = 'Message sent!';
        return true;
    }
}

 ?>
