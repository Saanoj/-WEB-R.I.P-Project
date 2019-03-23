<?php 
namespace App;
use \PDO;
session_start();
?>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<?php
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
        ?>
        <div class="alert alert-success" role="alert">
        Votre message a bien été envoyé.
          </div>
          <?php
            header ('Refresh: 2;URL=index.php');

    }else{
        header ('Refresh: 0;URL=index.php');

    }
}

// header('location:index.php?id='.$_SESSION['id']);
        
    
?>
