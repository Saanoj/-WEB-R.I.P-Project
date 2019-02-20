

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

    
function checklastName(lastName) {
    clearInput(lastName); //voir en bas
    if (lastName.value.length  < 3 || lastName.value.length > 30)
    {
      displayError(lastName, 'Votre nom doit contenir entre 3 et 30 caractères'); //voir en bas
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

    if (confirmPassword.value == p.value) {
   
        return true;
    }
    else {
        displayError(confirmPassword, 'Mot de passe non identique');
        return false;
     
    }
    

  }

  function checkbirthday(birthday) {
    clearInput(birthday);

    var b = document.getElementById("birthday");
    alert(b);

    var d=new Date(b);
  alert(d.getTime() + " milliseconds since 1970/01/01");
  return true;

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
    var firstName =checkfirstName(donnees.firstName);
    var lastName =checklastName(donnees.lastName);
    var password =checkpassword(donnees.password);
    var confirmPassword =checkconfirmPassword(donnees.confirmPassword);
    var checkbirthday =checkconfirmPassword(donnees.checkbirthday);
    console.log(email);
    console.log(firstName);
    console.log(lastName);
    console.log(confirmPassword);
    console.log(checkbirthday);
      
    if(email && firstName && lastName && password && confirmPassword && checkbirthday)
    {
     
        return true;
    }
      
    else
     {
        return false;
       
     }
   
  }
  