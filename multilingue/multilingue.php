<?php

function loadLanguageFromSession($langue){
  if($langue == "fr"){
       include "multilingue/fr.inc";
  }else if ($langue == "en"){
      include "multilingue/en.inc";
  }
}

?>
