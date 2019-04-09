<?php
require_once __DIR__.'/.conf.php';
echo "SSL = ".!extension_loaded('openssl')?"Not Available <br>":"Available <br>";
use PHPMailer\PHPMailer\PHPMailer;
include_once "PHPMailer/PHPMailer.php";
include_once "PHPMailer/Exception.php";
include_once "PHPMailer/SMTP.php";
$mail = new PHPMailer();
define ('GUSER',MAIL);
define ('GPWD',PASS);

$body = "Votre abonnement expire d'ici 1 jours. Si vous voulez continuer a ";
$body .= "profiter de nos différents services, veuillez re souscrire à un abonnement."; 
$body .=  '<br>';
$body .= "Veuillez cliquez";
$body .= " <a href='http://localhost/-WEB-R.I.P-Project/profil.php'>ici</a>";

if (smtpmailer("rideinprideesgi@gmail.com","Renouvellement d'abonnement.",$body) == true)
{
  "Message send ! ";
}
else
{
  "Error ! ";
}



// make a separate file and include this file in that. call this function in that file.

function smtpmailer($to, $subject, $body) {
    global $error;
    $mail = new PHPMailer();  // create a new object
   // $mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true;  // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
    $mail->SMTPAutoTLS = false;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;

    $mail->isHTML(true);
    $mail->Username = GUSER;
    $mail->Password = GPWD;
    $mail->SetFrom("rideinprideesgi@gmail.com", "Ride in Pride");
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