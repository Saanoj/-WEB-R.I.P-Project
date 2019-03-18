function checknameEntreprise(nameEntreprise) {
    clearInput(nameEntreprise); //voir en bas
    if (nameEntreprise.value.length  < 5 || nameEntreprise.value.length > 50)
    {
      displayError(nameEntreprise, 'Le nom d\'entreprise doit contenir entre 5 et 50 caractères'); //voir en bas
      return false;
    }
    else {
      return true;
    }
  }

function checknumEntreprise(numEntreprise)
{
    clearInput(numEntreprise); //voir en bas
	// Definition du motif a matcher
	var regex = new RegExp(/^(01|02|03|04|05|06|08)[0-9]{8}/gi);
	console.log(numEntreprise.value)
	// Test sur le motif
	if(regex.test(numEntreprise.value))
{
    return true;
}
else
{
    displayError(numEntreprise, 'Le numéro de téléphone est inccorect'); //voir en bas
      return false;
}
	
}
  
function checknbSalarie(nbSalarie) {
    clearInput(nbSalarie); //voir en bas
    if (nbSalarie.value  < 0 || nbSalarie.value > 30000 ||nbSalarie.value.length == 0)
    {
      displayError(nbSalarie, 'Nombre incorrect de salariés'); //voir en bas
      return false;
    }
    else {
      return true;
    }
  }
  function checkpays(pays) {
    clearInput(pays); //voir en bas
    if (pays.value === "Selectionner votre pays")
     {
        displayError(pays, 'Veuillez selectionner un pays'); //voir en bas
        return false
     }
     else
     {
         return true;
     }
  }
  function checknumSiret(numSiret) {
    clearInput(numSiret); //voir en bas
    
        if (numSiret.value.length != 14 || isNaN(numSiret.value))
        {
            displayError(numSiret, 'Le numéro SIRET est incorrect'); //voir en bas
            return false;
        }
        else
        {
            return true;
        }

  }

  function checkadresse(adresse)
  {
      clearInput(adresse);
    if (adresse.value.length == 0) {
        displayError(adresse, 'Adresse incomplète'); //voir en bas
        return false;
    } 
    else 
    {
        return true;
    }
  }

function displayError(input, message) {
    input.style.borderColor = 'red';
    var error = document.createElement('p');
    error.innerHTML = message;
    error.style.color = 'red';
    var parent = input.parentNode;
    parent.appendChild(error);
  }

  function clearInput(input) {
    input.style.borderColor = '';
  
    var parent = input.parentNode;
    var elements = parent.getElementsByTagName('p');
    if(elements.length > 0){
      parent.removeChild(elements[0]);
    }
  }

  function checkGlobal(donnees) {
    var nameEntreprise =checknameEntreprise(donnees.nameEntreprise);
    var numEntreprise =checknumEntreprise(donnees.numEntreprise);
    var numSiret =checknumSiret(donnees.numSiret);
    var nbSalarie =checknbSalarie(donnees.nbSalarie);
    var adresse =checkadresse(donnees.adresse);
    var pays =checkpays(donnees.pays);

;
      
    if(nameEntreprise && numEntreprise && numSiret && nbSalarie && adresse && pays)
    {
     
        return true;
    }
      
    else
     {
        return false;
       
     }
   
  }

  var placeSearch, autocomplete;

var componentForm = {
street_number: 'short_name',
route: 'long_name',
locality: 'long_name',
administrative_area_level_1: 'short_name',
country: 'long_name',
postal_code: 'short_name'
};

function initAutocomplete() {


autocomplete = new google.maps.places.Autocomplete(
  document.getElementById('adresse'), {
      types: ['geocode'],
      componentRestrictions: {country: "fr"}
  });

autocomplete.addListener('place_changed', fillInAddress);

}


function fillInAddress() {
// Get the place details from the autocomplete object.
var place = autocomplete.getPlace();


for (var i = 0; i < place.address_components.length; i++) {
var addressType = place.address_components[i].types[0];
if (componentForm[addressType]) {
  var val = place.address_components[i][componentForm[addressType]];

}
}
}

