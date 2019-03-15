<?php 
namespace App;
use \PDO;
session_start();


require 'Class/Autoloader.php';
Autoloader::register();
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
       echo "success";
    }else{
        echo "invalid";
    }
}

// header('location:index.php?id='.$_SESSION['id']);
        
    
?>
