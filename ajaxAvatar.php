<?php

require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');
session_start();


if(isset($_FILES["file"]["type"]))
{
  $validextensions = array("jpeg", "jpg", "png");
  $temporary = explode(".", $_FILES["file"]["name"]);
  $file_extension = end($temporary);


  if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
  ) && ($_FILES["file"]["size"] < 1000000)//Approx. 1Mb files can be uploaded.
  && in_array($file_extension, $validextensions)) {
    if ($_FILES["file"]["error"] > 0)
    {
      echo "Return Code: " . $_FILES["file"]["error"];
    }
    else
    {
      $path = $_FILES['file']['name'];
      $ext = pathinfo($path, PATHINFO_EXTENSION);
      $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
      $targetPath = "images/avatar/"."rip".$_SESSION["id"]."avatar.".$ext; // Target path where file is to be stored


      if (file_exists($targetPath)) {
        unlink($targetPath);
      }

        move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file

        $req=$bdd->getPDO()->prepare('UPDATE users SET avatar=:avatar WHERE id=:id');
        $req->bindValue(':id', $_SESSION["id"]);
        $req->bindValue(':avatar', "rip".$_SESSION["id"]."avatar.".$ext);
        $req->execute();
        $req->closeCursor();

        echo $targetPath;
    }
  }
  else
  {
    echo "<span id='invalid'>***Invalid file Size or Type***<span>";
  }
}else{
  echo "<span>No image<span>";
}
?>
