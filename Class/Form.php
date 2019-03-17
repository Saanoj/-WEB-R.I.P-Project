<?php

namespace App;

use \PDO;
class Form{

    private $data;
    public $surround ='p';
    public function __construct($data = array()) {
        $this->data = $data;


    }
    private function surround($html) {
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }

    public function input($name,$type,$placholder='default') {
       return  $this->surround('<input type="' . $type . '" name="'. $name . '" id="' .$name .'" class="form-control" placeholder="'.$placholder.'" autofocus onblur="check'.$name.'(this)">');

    }
    public function submit(){
        return $this->surround('<input type="submit"   class="btn btn-success" name="submit"  value="Valider">');

    }

    public function inputConnexion($name,$type,$placeholder,$class) {
         return  $this->surround('<input type="' . $type . '" name="'. $name . '" id="' .$name .'" placeholder="' . $placeholder . '"  class="' . $class .'" >');

    }
    public function inputAdresse($type,$name,$id,$class,$placeholder,$required) {
        return  $this->surround('<input type="' . $type . '" name="'. $name . '" id="' .$id .'"class="'.$class. '" placeholder="' . $placeholder . '"  required="'.$required.'" onblur="check'.$name.'(this)">');

   }

    public function submitConnexion (){
        return $this->surround('<button  type="submit"  class="btn btn-success" name="submit"  value="Connexion">Valider</button>');

    }


}




?>
