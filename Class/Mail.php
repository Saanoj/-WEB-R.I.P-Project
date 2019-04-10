<?php

namespace App;


require_once __DIR__.'/.conf.php';
use PHPMailer\PHPMailer\PHPMailer;
include_once "PHPMailer/PHPMailer.php";
include_once "PHPMailer/Exception.php";
include_once "PHPMailer/SMTP.php";
define ('GUSER',MAIL);
define ('GPWD',PASS);

class Mail
{







  private $to;
  private $subject;
  private $body;

  private $error;




  function __construct(string $to, string $sub, string $body)
  {
    $this->to = $to;
    $this->subject = $sub;
    $this->body = $body;


  }

  public static function createMail (string $to, string $subject, string $body):PHPMailer
  {
    $mail = new PHPMailer();  // create a new object
    $mail->IsSMTP(); // enable SMTP
    //$mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true;  // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
    $mail->SMTPAutoTLS = false;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->Username = GUSER;
    $mail->Password = GPWD;
    $mail->SetFrom("rideinprideesgi@gmail.com", "Ride in Pride");
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    return $mail;
  }
  public function send(): bool
  {
    $mail = Mail::createMail($this->to, $this->subject, $this->body);
    if(!$mail->Send()) {
        $error = 'Mail error: '.$mail->ErrorInfo;
        return false;
    } else {
        $error = 'Message sent!';
        return true;
    }
  }


}
 ?>
