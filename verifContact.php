<?php 
namespace App;
use \PDO;
session_start();
?>

<?php
require_once __DIR__ .'/require_class.php';

$bdd = new Database('rip');

Contact::insertContact($bdd);
envoiMail($_POST['nameClient'],$_POST['email'],$_POST['messageContact']);




function envoiMail($name,$email,$message)
{
    $EmailTo = "tutur.77@hotmail.fr";
    $Subject = "New Message Received";
     
    // prepare email body text
    $Body = "Name: ";
    $Body .= $name;
    $Body .= "\n";
     
    $Body .= "Email: ";
    $Body .= $email;
    $Body .= "\n";
     
    $Body .= "Message: ";
    $Body .= $message;
    $Body .= "\n";
     
    // send email
    $success = mail($EmailTo, $Subject, $Body, "From:".$email);
     
    // redirect to success page
    if ($success){

            header ('location:index.php');

    }else{
        header ('location:index.php');

    }
}

// header('location:index.php?id='.$_SESSION['id']);
        
    
?>
