function checkfirstName(firstName) {
    clearInput(firstName); //voir en bas
    if (firstName.value.length  < 3 || firstName.value.length > 30)
    {
      displayError(firstName, 'Votre prenom doit contenir entre 3 et 30 caractères'); //voir en bas
      return false;
    }
    else {
      return true;
    }
  }


  function Verifier_Numero_Telephone(phone)
  
{
    clearInput(phone);
	// Definition du motif a matcher
	var regex = new RegExp(/^(01|02|03|04|05|06|08)[0-9]{8}/gi);
	
	// Test sur le motif
	if(regex.test(phone.value))
	{
        return true;
    }
	  else
	{
        displayError(phone, 'Numéro de téléphone invalide'); //voir en bas
		return false;
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
    var name =checkfirstName(donnees.name);
    var phone =Verifier_Numero_Telephone(donnees.phone);
    

      
    if(name && phone)
    {
     
        return true;
    }
      
    else
     {
        return false;
       
     }
   
  }