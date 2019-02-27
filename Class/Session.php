<?php
namespace App;
use \PDO;

class Session
{

  public function isConnect()
  {
    if(isset($_SESSION['id'])){
      //good
    }else{
      header('Location:http://localhost/-WEB-R.I.P-Project/notConnect.php');
    }
  }
}

 ?>
