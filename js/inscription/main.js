

function checkemail(email) {
    clearInput(email);
    var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/; // chaine limitée par /^ chaine $/ | {2,} == 2 ou plus | {2,4} == entre 2 et 4 | \ devant le point pour enlever le "spécial" du caractère
    if(!regex.test(email.value))
    {
      displayError(email, 'votre email n\'est pas valide');
      return false;
    }
    else
    {
       return true;
    }
  }

  
function checkfirstName(first_name) {
    clearInput(first_name); //voir en bas
    if (first_name.value.length  < 3 || first_name.value.length > 30)
    {
      displayError(first_name, 'Votre prenom doit contenir entre 3 et 30 caractères'); //voir en bas
      return false;
    }
    else {
      return true;
    }
  }

    
function checklastName(last_name) {
    clearInput(last_name); //voir en bas
    if (last_name.value.length  < 3 || last_name.value.length > 30)
    {
      displayError(last_name, 'Votre nom doit contenir entre 3 et 30 caractères'); //voir en bas
      return false;
    }
    else {
      return true;
    }
  }

  function checkpassword(password){
  
    clearInput(password);
    var regex = /(?=.*[0-9])[A-Z]|(?=.*[A-Z])[0-9]/; // chaine limitée par /^ chaine $/ | {2,} == 2 ou plus | {2,4} == entre 2 et 4 | \ devant le point pour enlever le "spécial" du caractère
    if(!regex.test(password.value))
    {
      displayError(password, 'votre mot de passe est invalide');
      return false;
    }
    else
    {
       return true;
    }
  }

  function checkconfirmPassword(confirmPassword) {
    clearInput(confirmPassword);

    var p = document.getElementById("password");
    console.log(p.value)
    console.log(confirmPassword.value)
    if (confirmPassword.value == p.value) {
   
        return true;
    }
    else {
        displayError(confirmPassword, 'Mot de passe non identique');
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
    var email =checkemail(donnees.email);
    var first_name =checkfirstName(donnees.first_name);
    var last_name =checklastName(donnees.last_name);
    var password =checkpassword(donnees.password);
    var confirmPassword =checkconfirmPassword(donnees.confirmPassword);

  
    if(email && first_name && last_name && password && confirmPassword)
    {
        return true;
    }
      
    else
     {
        return false;
         header('location:inscription.php?error=Formulaire_invalide');
       
     }
   
  }
  