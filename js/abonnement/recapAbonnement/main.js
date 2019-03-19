function displayError(input, message) {
    input.style.borderColor = 'green';
    var error = document.createElement('p');
    error.innerHTML = message;
    error.style.color = 'green';
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


    var test = document.getElementById('success');
          displayError(test, 'Votre abonnement est maintenant actif !');
          
          
          setTimeout("window.location='index.php'",6000); // delai en millisecondes
      
            
       
