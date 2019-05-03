<?php

function loadLanguageFromSession($langue,$boNavbar = 0){

  if($langue == "fr"){
      if ($boNavbar == 1) {
        include "../../multilingue/fr.inc";
      } else {
        include "multilingue/fr.inc";
      }

  }else if ($langue == "en"){

      if ($boNavbar == 1) {
        include "../../multilingue/en.inc";
      } else {
        include "multilingue/en.inc";
      }
  }
}

?>
