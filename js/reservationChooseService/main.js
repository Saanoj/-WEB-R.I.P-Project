$(document).ready(function() {
    // var button = radio.name.split('services');
    let count=0;
     for (i=0;i<100;i++)
     {
       if(document.getElementById("idRestaurant"+i) == "" || document.getElementById("idRestaurant"+i) == null)
       {
       }
       else
       {
         count++;
  
      
           
       }
     }
       if (count == 0)
       {
         var parent = document.getElementById("slider1").parentNode;
         var text = document.createElement("p");
         document.getElementById("slider1").style.visibility="hidden";
         text.innerHTML="Non disponible";
         parent.appendChild(text);
         document.getElementById("slider1");
 
       }
   
 
});

function displayError(input, message) {
  input.style.borderColor = 'red';
  var error = document.createElement('p');
  error.innerHTML = message;
  error.style.color = 'red';
  var parent = input.parentNode;
  parent.appendChild(error);
}

function displayErrorP(input,message,i)
{
  
  input.style.borderColor = 'red';
  var error = document.createElement('p');
  error.setAttribute("class","p_errorDonnee");
  error.setAttribute("id","p_errorDonnee"+i);
  error.innerHTML = message;
  error.style.color = 'red';
  var parent = input.parentNode;
  parent.appendChild(error);
}

function displayErrorDonnees(input,message,id)
{
  input.style.borderColor = 'red';
  var error = document.createElement('p');
  error.setAttribute("class","errorDonnee");
  error.setAttribute("id",id);
  error.innerHTML = message;
  error.style.color = 'red';
  var parent = input.parentNode;
  parent.appendChild(error);
  console.log(error);
}

function clearP(element)
{
  
  var parent = element.parentNode
  var elements = parent.getElementsByClassName('p_errorDonnee');
    for (i=0;i<elements.length;i++)
    {
     let childNode = parent.lastChild;
     parent.removeChild(childNode);
    }
}

function clearPCollaborateurs(element) {
  var parent = element.parentNode
  var elements = parent.getElementsByClassName('collaborateurs_errorDonnee');
    for (i=0;i<elements.length;i++)
    {
     let childNode = parent.lastChild;
     parent.removeChild(childNode);
    }
}

function clearInput(input) {
  input.style.borderColor = '';

  var parent = input.parentNode;
  var elements = parent.getElementsByTagName('p');
  if(elements.length > 0){
    parent.removeChild(elements[0]);
  }
}

function clearInputDonnees(donnees)
{
  var parent = donnees.parentNode
  var elements = document.getElementsByClassName('errorDonnee');
  
    for (i=0;i<elements.length;i++)
    {
     let childNode = parent.lastChild;
     parent.removeChild(childNode);
    }
}

function checkIfErrorMessage(id)
{
  
  var elements  = document.getElementById(id);
  if (elements !== null)
  {
    return true;
  }
  else
  {
    return false;
  }
}

function checkIfErrorMessageP(id)
{
  var elements  = document.getElementById(id);
  if (elements !== null)
  {
    return true;
  }
  else
  {
    return false;
  }
}

function checkIfErrorMessageCollaborateurs(id) {
  
  var elements  = document.getElementById(id);
  console.log(elements)
  if (elements !== null)
  {
    return true;
  }
  else
  {
    return false;
  }
}
function displayErrorMessageInterprete(input,message,j) {
  input.style.borderColor = 'red';
  var error = document.createElement('p');
  error.setAttribute("class","errorDonnee");
  error.setAttribute("id","collaborateurs_errorDonnee"+j);
  error.innerHTML = message;
  error.style.color = 'red';
  var parent = input.parentNode;
  parent.appendChild(error);

}
function displayErrorMessageCoachSportif(input,message,j) {
  input.style.borderColor = 'red';
  var error = document.createElement('p');
  error.setAttribute("class","errorDonnee");
  error.setAttribute("id","collaborateurs_errorDonnee"+j);
  error.innerHTML = message;
  error.style.color = 'red';
  var parent = input.parentNode;
  parent.appendChild(error);

}
function displayErrorMessageCoachCulture(input,message,j) {
  input.style.borderColor = 'red';
  var error = document.createElement('p');
  error.setAttribute("class","errorDonnee");
  error.setAttribute("id","collaborateurs_errorDonnee"+j);
  error.innerHTML = message;
  error.style.color = 'red';
  var parent = input.parentNode;
  parent.appendChild(error);

}

function displayErrorMessageCollaborateurs(input,message,j) {
  input.style.borderColor = 'red';
  var error = document.createElement('p');
  error.setAttribute("class","errorDonnee");
  error.setAttribute("id","collaborateurs_errorDonnee"+j);
  error.innerHTML = message;
  error.style.color = 'red';
  var parent = input.parentNode;
  parent.appendChild(error);

}

function displayErrorMessageBillets(input,message,j)
{
  input.style.borderColor = 'red';
  var error = document.createElement('p');
  error.setAttribute("class","errorDonnee");
  error.setAttribute("id","billets_errorDonnee"+j);
  error.innerHTML = message;
  error.style.color = 'red';
  var parent = input.parentNode;
  parent.appendChild(error);
}

function checkHeureDebutSportif(heure) 
{
  clearInput(heure);
  var array = new Array;
  var arrayCoachSportif = new Array;
  nbCoachSportif = heure.id.split("endCoachSportif");
  var dateStartTrajet = new Date();
  var dateEndTrajet = new Date();
  var dateStartCoachSportif = new Date();
  var dateEndCoachSportif = new Date();
  // Date du trajet
  array = checkIfSameDay(document.getElementById("heureTrajetDebut"),document.getElementById("heureTrajetFin"));

  dateStartTrajet = array[0];
  dateEndTrajet = array[1];


  // Heure début de l'interprete
  heureDebutCoachSportif = heure.value;
  heureDebutCoachSportif = heureDebutCoachSportif.split(":")
  dateStartCoachSportif.setHours(heureDebutCoachSportif[0])
  dateStartCoachSportif.setMinutes(heureDebutCoachSportif[1]);

  // Heure fin de l'interprete
  heureFinCoachSportif = heure.value;
  heureFinCoachSportif = heureFinCoachSportif.split(":")
  dateEndCoachSportif.setHours(heureFinCoachSportif[0])
  dateEndCoachSportif.setMinutes(heureFinCoachSportif[1])

  if (dateStartCoachSportif.getHours() >= dateStartTrajet.getHours() &&  dateStartCoachSportif.getHours() <= dateEndTrajet.getHours() &&  
  dateEndCoachSportif.getHours() >= dateStartTrajet.getHours() &&  dateEndCoachSportif.getHours() <= dateEndTrajet.getHours() && dateEndCoachSportif.getHours() >= dateStartCoachSportif.getHours())
    {

    }
    else {
      if (dateStartCoachSportif.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateStartCoachSportif.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
      {
        dateStartCoachSportif.setDate(dateStartCoachSportif.getDate()+1);

      }
      if (dateEndCoachSportif.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateEndCoachSportif.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
      {
        dateEndCoachSportif.setDate(dateEndCoachSportif.getDate()+1);
    
      }
    }


  if (dateStartCoachSportif.getTime() >= dateStartTrajet.getTime() && 
  dateStartCoachSportif.getTime() <= dateEndTrajet.getTime() && 
  dateEndCoachSportif.getTime() >= dateStartCoachSportif.getTime() && 
  dateEndCoachSportif.getTime() <= dateEndTrajet.getTime() && 
  dateEndCoachSportif.getTime() >= dateStartCoachSportif.getTime())
  {
    return true;
  }
  else 
  {
    displayError(heure, '');
    return false;
  }
}

function checkHeureFinSportif(heure)
{
  clearInput(heure);
  var array = new Array;
  nbCoachSportif = heure.id.split("endCoachSportif");
  var dateStartTrajet = new Date();
  var dateEndTrajet = new Date();
  var dateStartCoachSportif = new Date();
  var dateEndCoachSportif = new Date();
  // Date du trajet
  array = checkIfSameDay(document.getElementById("heureTrajetDebut"),document.getElementById("heureTrajetFin"));

  dateStartTrajet = array[0];
  dateEndTrajet = array[1];


  // Heure début de l'interprete
  heureDebutInterprete = document.getElementById("startCoachSportif"+nbCoachSportif[1]).value;
  heureDebutInterprete = heureDebutInterprete.split(":")
  dateStartCoachSportif.setHours(heureDebutInterprete[0])
  dateStartCoachSportif.setMinutes(heureDebutInterprete[1]);

  // Heure fin de l'interprete
  heureFinInterprete = heure.value;
  heureFinInterprete = heureFinInterprete.split(":")
  dateEndCoachSportif.setHours(heureFinInterprete[0])
  dateEndCoachSportif.setMinutes(heureFinInterprete[1])

  if (dateStartCoachSportif.getHours() >= dateStartTrajet.getHours() &&  dateStartCoachSportif.getHours() <= dateEndTrajet.getHours() &&  
  dateEndCoachSportif.getHours() >= dateStartTrajet.getHours() &&  dateEndCoachSportif.getHours() <= dateEndTrajet.getHours() && dateEndCoachSportif.getHours() >= dateStartCoachSportif.getHours())
    {

    }
    else {
      if (dateStartCoachSportif.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateStartCoachSportif.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
      {
        dateStartCoachSportif.setDate(dateStartCoachSportif.getDate()+1);

      }
      if (dateEndCoachSportif.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateEndCoachSportif.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
      {
        dateEndCoachSportif.setDate(dateEndCoachSportif.getDate()+1);
    
      }
    }
    
  


   if (dateStartCoachSportif.getTime() >= dateStartTrajet.getTime() && 
   dateStartCoachSportif.getTime() <= dateEndTrajet.getTime() && 
   dateEndCoachSportif.getTime() >= dateStartCoachSportif.getTime() && 
   dateEndCoachSportif.getTime() <= dateEndTrajet.getTime() && 
   dateEndCoachSportif.getTime() >= dateStartCoachSportif.getTime())
  {
    return true;
  }
  else 
  {
    displayError(heure, '');
    return false;
  }
}

function checkHeureDebutCulture(heure)
{
  clearInput(heure);
  var array = new Array;
  var arrayCoachSportif = new Array;
  nbCoachCulture = heure.id.split("endCoachCulture");
  var dateStartTrajet = new Date();
  var dateEndTrajet = new Date();
  var dateStartCoachCulture = new Date();
  var dateEndCoachCulture = new Date();
  // Date du trajet
  array = checkIfSameDay(document.getElementById("heureTrajetDebut"),document.getElementById("heureTrajetFin"));

  dateStartTrajet = array[0];
  dateEndTrajet = array[1];


  // Heure début de l'interprete
  heureDebutCoachCulture = heure.value;
  heureDebutCoachCulture = heureDebutCoachCulture.split(":")
  dateStartCoachCulture.setHours(heureDebutCoachCulture[0])
  dateStartCoachCulture.setMinutes(heureDebutCoachCulture[1]);

  // Heure fin de l'interprete
  heureFinCoachCulture = heure.value;
  heureFinCoachCulture = heureFinCoachCulture.split(":")
  dateEndCoachCulture.setHours(heureFinCoachCulture[0])
  dateEndCoachCulture.setMinutes(heureFinCoachCulture[1])

  if (dateStartCoachCulture.getHours() >= dateStartTrajet.getHours() &&  dateStartCoachCulture.getHours() <= dateEndTrajet.getHours() &&  
  dateEndCoachCulture.getHours() >= dateStartTrajet.getHours() &&  dateEndCoachCulture.getHours() <= dateEndTrajet.getHours() && dateEndCoachCulture.getHours() >= dateStartCoachCulture.getHours())
    {

    }
    else {
      if (dateStartCoachCulture.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateStartCoachCulture.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
      {
        dateStartCoachCulture.setDate(dateStartCoachCulture.getDate()+1);

      }
      if (dateEndCoachCulture.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateEndCoachCulture.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
      {
        dateEndCoachCulture.setDate(dateEndCoachCulture.getDate()+1);
    
      }
    }


  if (dateStartCoachCulture.getTime() >= dateStartTrajet.getTime() && 
  dateStartCoachCulture.getTime() <= dateEndTrajet.getTime() && 
  dateEndCoachCulture.getTime() >= dateStartCoachCulture.getTime() && 
  dateEndCoachCulture.getTime() <= dateEndTrajet.getTime() && 
  dateEndCoachCulture.getTime() >= dateStartCoachCulture.getTime())
  {
    return true;
  }
  else 
  {
    displayError(heure, '');
    return false;
  }
}

function checkHeureFinCulture(heure)
{
  clearInput(heure);
  var array = new Array;
  nbCoachCulture = heure.id.split("endCoachCulture");
  var dateStartTrajet = new Date();
  var dateEndTrajet = new Date();
  var dateStartCoachCulture = new Date();
  var dateEndCoachCulture = new Date();
  // Date du trajet
  array = checkIfSameDay(document.getElementById("heureTrajetDebut"),document.getElementById("heureTrajetFin"));

  dateStartTrajet = array[0];
  dateEndTrajet = array[1];


  // Heure début de l'interprete
  heureDebutCulture = document.getElementById("startCoachCulture"+nbCoachCulture[1]).value;
  heureDebutCulture = heureDebutCulture.split(":")
  dateStartCoachCulture.setHours(heureDebutCulture[0])
  dateStartCoachCulture.setMinutes(heureDebutCulture[1]);

  // Heure fin de l'interprete
  heureFinCulture = heure.value;
  heureFinCulture = heureFinCulture.split(":")
  dateEndCoachCulture.setHours(heureFinCulture[0])
  dateEndCoachCulture.setMinutes(heureFinCulture[1])

  if (dateStartCoachCulture.getHours() >= dateStartTrajet.getHours() &&  dateStartCoachCulture.getHours() <= dateEndTrajet.getHours() &&  
  dateEndCoachCulture.getHours() >= dateStartTrajet.getHours() &&  dateEndCoachCulture.getHours() <= dateEndTrajet.getHours() && dateEndCoachCulture.getHours() >= dateStartCoachCulture.getHours())
    {

    }
    else {
      if (dateStartCoachCulture.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateStartCoachCulture.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
      {
        dateStartCoachCulture.setDate(dateStartCoachCulture.getDate()+1);

      }
      if (dateEndCoachCulture.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateEndCoachCulture.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
      {
        dateEndCoachCulture.setDate(dateEndCoachCulture.getDate()+1);
    
      }
    }
    
  


   if (dateStartCoachCulture.getTime() >= dateStartTrajet.getTime() && 
   dateStartCoachCulture.getTime() <= dateEndTrajet.getTime() && 
   dateEndCoachCulture.getTime() >= dateStartCoachCulture.getTime() && 
   dateEndCoachCulture.getTime() <= dateEndTrajet.getTime() && 
   dateEndCoachCulture.getTime() >= dateStartCoachCulture.getTime())
  {
    return true;
  }
  else 
  {
    displayError(heure, '');
    return false;
  }
}

function checkRadioInterprete(radio)
{
  var button = radio.name.split('idInterprete');
  if(radio.checked == true){
    document.getElementById("buttonHours"+button[1]).style.visibility="visible";
  }
else{
  document.getElementById("buttonHours"+button[1]).style.visibility="hidden";
}
}

function checkRadioCoachSportifs(radio)
{
  var button = radio.name.split('idCoachSportif');
  if(radio.checked == true){
    document.getElementById("buttonHours"+button[1]).style.visibility="visible";
  }
else{
  document.getElementById("buttonHours"+button[1]).style.visibility="hidden";
}
}

function checkRadioCoachCulture(radio)
{
  var button = radio.name.split('idCoachCulture');
  if(radio.checked == true){
    document.getElementById("buttonHours"+button[1]).style.visibility="visible";
  }
else{
  document.getElementById("buttonHours"+button[1]).style.visibility="hidden";
}
}

function checkRadioBillet(radio)
{
    var button = radio.name.split('idBillet');
    var quantites = document.getElementById("quantites8["+button[1]+"]");
  if(radio.checked == true && quantites.value > 0 && quantites.value <=5){
    document.getElementById("buttonHours"+button[1]).style.visibility="visible";
  }
else{
  document.getElementById("buttonHours"+button[1]).style.visibility="hidden";
}
}

function checkRadioHotel(radio)
{
  var button = radio.name.split('idHotel');
  button = button[1].split('[');
  idHotel = button[0];
  console.log(idHotel)
  idChambre = button[1].split(']');
  idChambre = idChambre[0]
  console.log(idChambre)
    if (radio.checked == true)
    {
      document.getElementById("buttonHoursHotel"+idHotel+"["+idChambre+"]").style.visibility="visible"
    }
    else
    {
      document.getElementById("buttonHoursHotel"+idHotel+"["+idChambre+"]").style.visibility="hidden"
    }
}



function checkInput(radio)
{
  var button = radio.name.split('services');
  

  if(radio.checked == true){
    document.getElementById("services"+button[1]).style.visibility="visible";

  }
else{
  document.getElementById("services"+button[1]).style.visibility="hidden";

}
}

function checkHeureFinBillet(heure) {

  clearInput(heure);
  //clearPCollaborateurs(heure);
  var array = new Array;
  nbInterprete = heure.id.split("endBillet");
  var dateStartTrajet = new Date();
  var dateEndTrajet = new Date();
  var dateStartInterprete = new Date();
  var dateEndtInterprete = new Date();
  // Date du trajet
  array = checkIfSameDay(document.getElementById("heureTrajetDebut"),document.getElementById("heureTrajetFin"));

  dateStartTrajet = array[0];
  dateEndTrajet = array[1];


  // Heure début de l'interprete
  heureDebutInterprete = heure.value;
  heureDebutInterprete = heureDebutInterprete.split(":")
  dateStartInterprete.setHours(heureDebutInterprete[0])
  dateStartInterprete.setMinutes(heureDebutInterprete[1]);

  // Heure fin de l'interprete
  heureFinInterprete = heure.value;
  heureFinInterprete = heureFinInterprete.split(":")
  dateEndtInterprete.setHours(heureFinInterprete[0])
  dateEndtInterprete.setMinutes(heureFinInterprete[1])

   if (dateStartInterprete.getHours() >= dateStartTrajet.getHours() &&  dateStartInterprete.getHours() <= dateEndTrajet.getHours() &&  
    dateEndtInterprete.getHours() >= dateStartTrajet.getHours() &&  dateEndtInterprete.getHours() <= dateEndTrajet.getHours() && dateEndtInterprete.getHours() >= dateStartInterprete.getHours())
    {

    }
    else {
      if (dateStartInterprete.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateStartInterprete.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
      {
        dateStartInterprete.setDate(dateStartInterprete.getDate()+1);

      }
      if (dateEndtInterprete.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateEndtInterprete.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
      {
        dateEndtInterprete.setDate(dateEndtInterprete.getDate()+1);
    
      }
    }
 
  if (dateStartInterprete.getTime() >= dateStartTrajet.getTime() && 
  dateStartInterprete.getTime() <= dateEndTrajet.getTime() && 
  dateEndtInterprete.getTime() >= dateStartInterprete.getTime() && 
  dateEndtInterprete.getTime() <= dateEndTrajet.getTime() && 
  dateEndtInterprete.getTime() >= dateStartInterprete.getTime())
  {
    return true;
  }
  else 
  {
    displayError(heure, '');
    return false;
  }

}

function checkHeureFinHotel(heure) {

  clearInput(heure);
  //clearPCollaborateurs(heure);
  var array = new Array;
  nbInterprete = heure.id.split("endHotel");
  var dateStartTrajet = new Date();
  var dateEndTrajet = new Date();
  var dateStartInterprete = new Date();
  var dateEndtInterprete = new Date();
  // Date du trajet
  array = checkIfSameDay(document.getElementById("heureTrajetDebut"),document.getElementById("heureTrajetFin"));

  dateStartTrajet = array[0];
  dateEndTrajet = array[1];


  // Heure début de l'interprete
  heureDebutInterprete = heure.value;
  heureDebutInterprete = heureDebutInterprete.split(":")
  dateStartInterprete.setHours(heureDebutInterprete[0])
  dateStartInterprete.setMinutes(heureDebutInterprete[1]);

  // Heure fin de l'interprete
  heureFinInterprete = heure.value;
  heureFinInterprete = heureFinInterprete.split(":")
  dateEndtInterprete.setHours(heureFinInterprete[0])
  dateEndtInterprete.setMinutes(heureFinInterprete[1])

   if (dateStartInterprete.getHours() >= dateStartTrajet.getHours() &&  dateStartInterprete.getHours() <= dateEndTrajet.getHours() &&  
    dateEndtInterprete.getHours() >= dateStartTrajet.getHours() &&  dateEndtInterprete.getHours() <= dateEndTrajet.getHours() && dateEndtInterprete.getHours() >= dateStartInterprete.getHours())
    {

    }
    else {
      if (dateStartInterprete.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateStartInterprete.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
      {
        dateStartInterprete.setDate(dateStartInterprete.getDate()+1);

      }
      if (dateEndtInterprete.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateEndtInterprete.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
      {
        dateEndtInterprete.setDate(dateEndtInterprete.getDate()+1);
    
      }
    }
 
  if (dateStartInterprete.getTime() >= dateStartTrajet.getTime() && 
  dateStartInterprete.getTime() <= dateEndTrajet.getTime() && 
  dateEndtInterprete.getTime() >= dateStartInterprete.getTime() && 
  dateEndtInterprete.getTime() <= dateEndTrajet.getTime() && 
  dateEndtInterprete.getTime() >= dateStartInterprete.getTime())
  {
    return true;
  }
  else 
  {
    displayError(heure, '');
    return false;
  }

}

function checkQuantiteBillet(billet) {
  clearP(billet);
  clearInput(billet);
 if (billet.value >= 0 && billet.value <= 5)
 {
 
 
 }
 else
 {
  //clearP(billet);
  displayError(billet,' ');
 // clearInput(ordinateur);
 }
}

function checkHeureDebutInterprete(heure) {
  clearInput(heure);
  clearPCollaborateurs(heure);
  var array = new Array;
  nbInterprete = heure.id.split("endInterprete");
  var dateStartTrajet = new Date();
  var dateEndTrajet = new Date();
  var dateStartInterprete = new Date();
  var dateEndtInterprete = new Date();
  // Date du trajet
  array = checkIfSameDay(document.getElementById("heureTrajetDebut"),document.getElementById("heureTrajetFin"));

  dateStartTrajet = array[0];
  dateEndTrajet = array[1];


  // Heure début de l'interprete
  heureDebutInterprete = heure.value;
  heureDebutInterprete = heureDebutInterprete.split(":")
  dateStartInterprete.setHours(heureDebutInterprete[0])
  dateStartInterprete.setMinutes(heureDebutInterprete[1]);

  // Heure fin de l'interprete
  heureFinInterprete = heure.value;
  heureFinInterprete = heureFinInterprete.split(":")
  dateEndtInterprete.setHours(heureFinInterprete[0])
  dateEndtInterprete.setMinutes(heureFinInterprete[1])

   if (dateStartInterprete.getHours() >= dateStartTrajet.getHours() &&  dateStartInterprete.getHours() <= dateEndTrajet.getHours() &&  
    dateEndtInterprete.getHours() >= dateStartTrajet.getHours() &&  dateEndtInterprete.getHours() <= dateEndTrajet.getHours() && dateEndtInterprete.getHours() >= dateStartInterprete.getHours())
    {

    }
    else {
      if (dateStartInterprete.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateStartInterprete.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
      {
        dateStartInterprete.setDate(dateStartInterprete.getDate()+1);

      }
      if (dateEndtInterprete.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateEndtInterprete.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
      {
        dateEndtInterprete.setDate(dateEndtInterprete.getDate()+1);
    
      }
    }
 
  if (dateStartInterprete.getTime() >= dateStartTrajet.getTime() && 
  dateStartInterprete.getTime() <= dateEndTrajet.getTime() && 
  dateEndtInterprete.getTime() >= dateStartInterprete.getTime() && 
  dateEndtInterprete.getTime() <= dateEndTrajet.getTime() && 
  dateEndtInterprete.getTime() >= dateStartInterprete.getTime())
  {
    return true;
  }
  else 
  {
    displayError(heure, '');
    return false;
  }
  
  
} 

function checkHeureFinInterprete(heure)
{
  clearInput(heure);
  clearPCollaborateurs(heure);
  var array = new Array;
  var arrayInterprete = new Array;
  nbInterprete = heure.id.split("endInterprete");
  var dateStartTrajet = new Date();
  var dateEndTrajet = new Date();
  var dateStartInterprete = new Date();
  var dateEndtInterprete = new Date();
  // Date du trajet
  array = checkIfSameDay(document.getElementById("heureTrajetDebut"),document.getElementById("heureTrajetFin"));

  dateStartTrajet = array[0];
  dateEndTrajet = array[1];


  // Heure début de l'interprete
  heureDebutInterprete = document.getElementById("startInterprete"+nbInterprete[1]).value;
  heureDebutInterprete = heureDebutInterprete.split(":")
  dateStartInterprete.setHours(heureDebutInterprete[0])
  dateStartInterprete.setMinutes(heureDebutInterprete[1]);

  // Heure fin de l'interprete
  heureFinInterprete = heure.value;
  heureFinInterprete = heureFinInterprete.split(":")
  dateEndtInterprete.setHours(heureFinInterprete[0])
  dateEndtInterprete.setMinutes(heureFinInterprete[1])



  if (dateStartInterprete.getHours() >= dateStartTrajet.getHours() &&  dateStartInterprete.getHours() <= dateEndTrajet.getHours() &&  
  dateEndtInterprete.getHours() >= dateStartTrajet.getHours() &&  dateEndtInterprete.getHours() <= dateEndTrajet.getHours() && dateEndtInterprete.getHours() >= dateStartInterprete.getHours())
  {

  }
  else {
    if (dateStartInterprete.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateStartInterprete.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
    {
      dateStartInterprete.setDate(dateStartInterprete.getDate()+1);

    }
    if (dateEndtInterprete.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateEndtInterprete.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
    {
      dateEndtInterprete.setDate(dateEndtInterprete.getDate()+1);
  
    }
  }
  
   if (dateStartInterprete.getTime() >= dateStartTrajet.getTime() && 
   dateStartInterprete.getTime() <= dateEndTrajet.getTime() && 
   dateEndtInterprete.getTime() >= dateStartInterprete.getTime() && 
   dateEndtInterprete.getTime() <= dateEndTrajet.getTime() && 
   dateEndtInterprete.getTime() >= dateStartInterprete.getTime())
  {
    return true;
  }
  else 
  {
    displayError(heure, '');
    return false;
  }
  

}

function checkQuantiteOrdinateur(ordinateur) {
  var idService = ordinateur.name;
  idService = idService.split("[");
  idService = idService[1].split("]");
  idService = idService[0]
  if (idService >= 2 && idService <=6) {
  if (ordinateur.value >= 1 && ordinateur.value <= 10 && ordinateur.value !== '')
  {  
    
    checkOrdinateur(ordinateur);
    return true;

  }
  if (ordinateur.value == 0 || ordinateur.value === '')
  {
    clearInput(ordinateur);
    checkOrdinateur(ordinateur);
  }

  else{
   
    displayError(ordinateur, '');
    removeAllOrdinateur(ordinateur);
    return false;
  }
}
else if (idService >= 15 && idService <=16)
{
  if (ordinateur.value >= 1 && ordinateur.value <= 2 && ordinateur.value !== '')
  {  
    
    checkOrdinateur(ordinateur);
    return true;

  }
  if (ordinateur.value == 0 || ordinateur.value === '')
  {
    clearInput(ordinateur);
    checkOrdinateur(ordinateur);
  }
 
  else{
   
    displayError(ordinateur, '');
    removeAllOrdinateur(ordinateur);
    return false;
  }
}
else if (idService >= 18 && idService <=19 || idService == 9)
{
  if (ordinateur.value >= 1 && ordinateur.value <= 4 && ordinateur.value !== '')
  {  
    
    checkOrdinateur(ordinateur);
    return true;

  }
  if (ordinateur.value == 0 || ordinateur.value === '')
  {
    clearInput(ordinateur);
    checkOrdinateur(ordinateur);
  }

  else{
   
    displayError(ordinateur, '');
    removeAllOrdinateur(ordinateur);
    return false;
  }
}

}

function removeAllOrdinateur(ordinateur) {
  
  var parent = ordinateur.parentNode; 
  let childrenInput = parent.getElementsByTagName('row');
  
  let size =  childrenInput.length

  for (i=0;i<=size;i++)
  {
    let childNode = parent.lastChild;
    parent.removeChild(childNode);
  }

}

function checkOrdinateur(ordinateur) {
  var idService = ordinateur.name;
  idService = idService.split("[");
  idService = idService[1].split("]");
  idService = idService[0]

  var parent = ordinateur.parentNode;
  var children = parent.getElementsByClassName('clear');
 if (children.length > ordinateur.value*4)
 {
  clearP(ordinateur);
  clearInput(ordinateur);
  removeDateOrdinateur(ordinateur,parent);
 }
 else
 {
  clearP(ordinateur);
  clearInput(ordinateur);
  addDateOrdinateur(ordinateur,parent,idService);
 }
}

function removeDateOrdinateur(ordinateur,parent)
{
 
  let childrenInput = parent.getElementsByTagName('row');
  
  let size =  childrenInput.length - ordinateur.value

  for (i=0;i<size;i++)
  {
    let childNode = parent.lastChild;
    parent.removeChild(childNode);
  }

}

function addDateOrdinateur(ordinateur,parent,idService)
  {
    let size=0;
    parent = ordinateur.parentNode;
    let children = parent.getElementsByClassName('clear');
    if (children.length === 0)
    {
     size = ordinateur.value - children.length;
     sizeChildren = children.length
     for (i=0;i<size;i++)
     {
    
    var br = document.createElement("br");
   let row = document.createElement("row");
   let startFinText = document.createElement("input");
    let startDebutText = document.createElement("input"); 
    let startDebut = document.createElement('input');
    let startEnd = document.createElement('input');

    startDebut.setAttribute("type","time");
    startDebut.setAttribute("class","clear");
    startDebut.setAttribute("onblur","checkHeureDebutOrdinateur(this)");
    if (idService >=2 && idService <=4) {
      startDebut.setAttribute("id","ordinateurStart["+idService+"]"+(i+(sizeChildren/4)));
      startDebut.setAttribute("name","ordinateurStart"+idService+"_"+(i+(sizeChildren/4)));
    }
      else if (idService == 5)
      {
       startDebut.setAttribute("id","tabletteStart["+idService+"]"+(i+(sizeChildren/4)));
       startDebut.setAttribute("name","tabletteStart"+idService+"_"+(i+(sizeChildren/4)));
 
      }
      else if (idService == 6)
      {
       startDebut.setAttribute("id","audioGuidesStart["+idService+"]"+(i+(sizeChildren/4)));
       startDebut.setAttribute("name","audioGuidesStart"+idService+"_"+(i+(sizeChildren/4)));
      }     
      else if (idService == 15)
      {
       startDebut.setAttribute("id","transportAnimalStart["+idService+"]"+(i+(sizeChildren/4)));
       startDebut.setAttribute("name","transportAnimalStart"+idService+"_"+(i+(sizeChildren/4)));
      } 
      else if (idService == 16)
      {
       startDebut.setAttribute("id","transportVeteniraireStart["+idService+"]"+(i+(sizeChildren/4)));
       startDebut.setAttribute("name","transportVeteniraireStart"+idService+"_"+(i+(sizeChildren/4)));
       
      } 
      else if (idService == 18)
      {
       startDebut.setAttribute("id","menuJourStart["+idService+"]"+(i+(sizeChildren/4)));
       startDebut.setAttribute("name","menuJourStart"+idService+"_"+(i+(sizeChildren/4)));
      }
      else if (idService == 19)
      {
       startDebut.setAttribute("id","menuGastronomiqueStart["+idService+"]"+(i+(sizeChildren/4)));
       startDebut.setAttribute("name","menuGastronomiqueStart"+idService+"_"+(i+(sizeChildren/4)));
      }
      
     startDebutText.setAttribute("type","text");
     startDebutText.setAttribute("class","clear");
     startDebutText.setAttribute("value","Date de début");
     startDebutText.setAttribute("disabled","disabled");
     
     startFinText.setAttribute("type","text");
     startFinText.setAttribute("class","clear");
     startFinText.setAttribute("value","Date de fin");
     startFinText.setAttribute("disabled","disabled");
     
     startEnd.setAttribute("type","time");
     startEnd.setAttribute("class","clear");
     startEnd.setAttribute("onblur","checkHeureFinOrdinateur(this)");
     if (idService >=2 && idService <=4) {
      startEnd.setAttribute("id","ordinateurEnd["+idService+"]"+(i+(sizeChildren/4)));
      startEnd.setAttribute("name","ordinateurEnd"+idService+"_"+(i+(sizeChildren/4)));


    }
      else if (idService == 5)
      {
        startEnd.setAttribute("id","tabletteEnd["+idService+"]"+(i+(sizeChildren/4)));
        startEnd.setAttribute("name","tabletteEnd"+idService+"_"+(i+(sizeChildren/4)));

 
      }
      else if (idService == 6)
      {
        startEnd.setAttribute("id","audioGuidesEnd["+idService+"]"+(i+(sizeChildren/4)));
        startEnd.setAttribute("name","audioGuidesEnd"+idService+"_"+(i+(sizeChildren/4)));

      }

      else if (idService == 15)
      {
        startEnd.setAttribute("id","transportAnimalEnd["+idService+"]"+(i+(sizeChildren/4)));
        startEnd.setAttribute("name","transportAnimalEnd"+idService+"_"+(i+(sizeChildren/4)));

      } 
      else if (idService == 16)
      {
        startEnd.setAttribute("id","transportVeteniraireEnd["+idService+"]"+(i+(sizeChildren/4)));
        startEnd.setAttribute("name","transportVeteniraireEnd"+idService+"_"+(i+(sizeChildren/4)));

      } 
      else if (idService == 18)
      {
        startEnd.setAttribute("id","menuJourEnd["+idService+"]"+(i+(sizeChildren/4)));
        startEnd.setAttribute("name","menuJourEnd"+idService+"_"+(i+(sizeChildren/4)));

      }
      else if (idService == 19)
      {
        startEnd.setAttribute("id","menuGastronomiqueEnd["+idService+"]"+(i+(sizeChildren/4)));
        startEnd.setAttribute("name","menuGastronomiqueEnd"+idService+"_"+(i+(sizeChildren/4)));
      }
     
     parent.appendChild(row);
     row.appendChild(startDebutText);
     row.appendChild(startDebut);
     row.appendChild(startFinText);
     row.appendChild(startEnd);
     row.appendChild(br);
     }
    }
    else
    {
     size = ordinateur.value*4 - children.length;
     sizeChildren = children.length;
     for (i=0;i<size/4;i++)
     {
      
      var br = document.createElement("br");
      let startDebut = document.createElement('input');
      let row = document.createElement("row");
      let startEnd = document.createElement('input');
      let startDebutText = document.createElement("input"); 
      let startFinText = document.createElement("input");

     startDebut.setAttribute("type","time");
     startDebut.setAttribute("class","clear");
     if (idService >=2 && idService <=4) {
     startDebut.setAttribute("id","ordinateurStart["+idService+"]"+(i+(sizeChildren/4)));
     startDebut.setAttribute("name","ordinateurStart"+idService+"_"+(i+(sizeChildren/4)));

     }
     else if (idService == 5)
     {
      startDebut.setAttribute("id","tabletteStart["+idService+"]"+(i+(sizeChildren/4)));
      startDebut.setAttribute("name","tabletteStart"+idService+"_"+(i+(sizeChildren/4)));


     }
     else if (idService == 6)
     {
      startDebut.setAttribute("id","audioGuidesStart["+idService+"]"+(i+(sizeChildren/4)));
      startDebut.setAttribute("name","audioGuidesStart"+idService+"_"+(i+(sizeChildren/4)));

     }
     else if (idService == 15)
     {
      startDebut.setAttribute("id","transportAnimalStart["+idService+"]"+(i+(sizeChildren/4)));
      startDebut.setAttribute("name","transportAnimalStart"+idService+"_"+(i+(sizeChildren/4)));

     } 
     else if (idService == 16)
     {
      startDebut.setAttribute("id","transportVeteniraireStart["+idService+"]"+(i+(sizeChildren/4)));
      startDebut.setAttribute("name","transportVeteniraireStart"+idService+"_"+(i+(sizeChildren/4)));

     } 
     else if (idService == 18)
     {
      startDebut.setAttribute("id","menuJourStart["+idService+"]"+(i+(sizeChildren/4)));
      startDebut.setAttribute("name","menuJourStart"+idService+"_"+(i+(sizeChildren/4)));

     }
     else if (idService == 19)
     {
      startDebut.setAttribute("id","menuGastronomiqueStart["+idService+"]"+(i+(sizeChildren/4)));
      startDebut.setAttribute("name","menuGastronomiqueStart"+idService+"_"+(i+(sizeChildren/4)));

     }
     startDebutText.setAttribute("type","text");
     startDebutText.setAttribute("class","clear");
     startDebutText.setAttribute("value","Date de début");
     startDebutText.setAttribute("disabled","disabled");

     startFinText.setAttribute("type","text");
     startFinText.setAttribute("class","clear");
     startFinText.setAttribute("value","Date de fin");
     startFinText.setAttribute("disabled","disabled");

     startEnd.setAttribute("type","time");
     startEnd.setAttribute("class","clear");
     if (idService >=2 && idService <=4) {
      startEnd.setAttribute("id","ordinateurEnd["+idService+"]"+(i+(sizeChildren/4)));
      startEnd.setAttribute("name","ordinateurEnd"+idService+"_"+(i+(sizeChildren/4)));

    }
      else if (idService == 5)
      {
        startEnd.setAttribute("id","tabletteEnd["+idService+"]"+(i+(sizeChildren/4)));
        startEnd.setAttribute("name","tabletteEnd"+idService+"_"+(i+(sizeChildren/4)));

 
      }
      else if (idService == 6)
      {
        startEnd.setAttribute("id","audioGuidesEnd["+idService+"]"+(i+(sizeChildren/4)));
        startEnd.setAttribute("name","audioGuidesEnd"+idService+"_"+(i+(sizeChildren/4)));

      }

      else if (idService == 15)
      {
        startEnd.setAttribute("id","transportAnimalEnd["+idService+"]"+(i+(sizeChildren/4)));
        startEnd.setAttribute("name","transportAnimalEnd"+idService+"_"+(i+(sizeChildren/4)));

      } 
      else if (idService == 16)
      {
        startEnd.setAttribute("id","transportVeteniraireEnd["+idService+"]"+(i+(sizeChildren/4)));
        startEnd.setAttribute("name","transportVeteniraireEnd"+idService+"_"+(i+(sizeChildren/4)));

      } 
      else if (idService == 18)
      {
        startEnd.setAttribute("id","menuJourEnd["+idService+"]"+(i+(sizeChildren/4)));
        startEnd.setAttribute("name","menuJourEnd"+idService+"_"+(i+(sizeChildren/4)));

      }
      else if (idService == 19)
      {
        startEnd.setAttribute("id","menuGastronomiqueEnd["+idService+"]"+(i+(sizeChildren/4)));
        startEnd.setAttribute("name","menuGastronomiqueEnd"+idService+"_"+(i+(sizeChildren/4)));

      }

  
     parent.appendChild(row);
     row.appendChild(startDebutText);
     row.appendChild(startDebut);
     row.appendChild(startFinText);
     row.appendChild(startEnd);
     row.appendChild(br);
     }
    }
 
}

function checkIfSameDay(dateDebut,dateFin) {

  var array = new Array;
  hStart = dateDebut.value
  hStart = hStart.split(":")
  var dateStart = new Date()
  dateStart.setHours(hStart[0])
  dateStart.setMinutes(hStart[1])

  dateFin = dateFin.value;
  dateFin = dateFin.split(":")
  var dateEnd = new Date()
  dateEnd.setHours(dateFin[0])
  dateEnd.setMinutes(dateFin[1])

  
  if (dateEnd.getTime() < dateStart.getTime())
  {
    dateEnd.setDate(dateEnd.getDate()+1);
  }
  array.push(dateStart,dateEnd);
  return array;
  
}

function checkHeureDebutOrdinateur(heure)
{
  clearInput(heure);
  var array = new Array;
  var arrayInterprete = new Array;
  var nbService=-1;
  nbInterprete = heure.id.split("endInterprete");
  var service = heure.id;
  service = service.split("[");
  var idService = service[1].split("]");
  idService = idService[0]
  nbService = service[1].split("]");
  nbService = nbService[1];
  var dateStartTrajet = new Date();
  var dateEndTrajet = new Date();
  var dateStartInterprete = new Date();
  var dateEndtInterprete = new Date();
  var parent = heure.parentNode;
  //console.log(parent)
  // Date du trajet
  array = checkIfSameDay(document.getElementById("heureTrajetDebut"),document.getElementById("heureTrajetFin"));

  dateStartTrajet = array[0];
  dateEndTrajet = array[1];

  // Heure début de l'interprete
  nameService = heure.id.split("["+idService+"]"+nbService);
  nameService = nameService[0].split("End");
  nameService = nameService[0];
  //console.log(nameService);
  //console.log(nameService+"Start["+idService+"]"+nbService);
  heureDebutInterprete = heure.value;
  heureDebutInterprete = heureDebutInterprete.split(":")
  dateStartInterprete.setHours(heureDebutInterprete[0])
  dateStartInterprete.setMinutes(heureDebutInterprete[1]);

  // Heure fin de l'interprete
  heureFinInterprete = heure.value;
  heureFinInterprete = heureFinInterprete.split(":")
  dateEndtInterprete.setHours(heureFinInterprete[0])
  dateEndtInterprete.setMinutes(heureFinInterprete[1])



  if (dateStartInterprete.getHours() >= dateStartTrajet.getHours() &&  dateStartInterprete.getHours() <= dateEndTrajet.getHours() &&  
  dateEndtInterprete.getHours() >= dateStartTrajet.getHours() &&  dateEndtInterprete.getHours() <= dateEndTrajet.getHours() && dateEndtInterprete.getHours() >= dateStartInterprete.getHours())
  {

  }
  else {
    if (dateStartInterprete.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateStartInterprete.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
    {
      dateStartInterprete.setDate(dateStartInterprete.getDate()+1);

    }
    if (dateEndtInterprete.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateEndtInterprete.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
    {
      dateEndtInterprete.setDate(dateEndtInterprete.getDate()+1);
  
    }
  }
  

 
   

  //  console.log(dateStartTrajet)
  //  console.log(dateEndTrajet)
  //  console.log(dateStartInterprete)
  //  console.log(dateEndtInterprete)


   if (dateStartInterprete.getTime() >= dateStartTrajet.getTime() && 
   dateStartInterprete.getTime() <= dateEndTrajet.getTime() && 
   dateEndtInterprete.getTime() >= dateStartInterprete.getTime() && 
   dateEndtInterprete.getTime() <= dateEndTrajet.getTime() && 
   dateEndtInterprete.getTime() >= dateStartInterprete.getTime())
  {
    return true;
  }
  else 
  {
    displayError(heure, '');
    return false;
  }
}

function checkHeureFinOrdinateur(heure) 
{
  clearInput(heure);
  console.log(heure)
  var array = new Array;
  var arrayInterprete = new Array;
  var nbService=-1;
  nbInterprete = heure.id.split("endInterprete");
  var service = heure.id;
  service = service.split("[");
 
  var idService = service[1].split("]");
  idService = idService[0]
  nbService = service[1].split("]");
  nbService = nbService[1];
  var dateStartTrajet = new Date();
  var dateEndTrajet = new Date();
  var dateStartInterprete = new Date();
  var dateEndtInterprete = new Date();
  var parent = heure.parentNode;
  // Date du trajet
  array = checkIfSameDay(document.getElementById("heureTrajetDebut"),document.getElementById("heureTrajetFin"));

  dateStartTrajet = array[0];
  dateEndTrajet = array[1];

  // Heure début de l'interprete
  nameService = heure.id.split("["+idService+"]"+nbService);
  nameService = nameService[0].split("End");
  nameService = nameService[0];
  //console.log(nameService);
  //console.log(nameService+"Start["+idService+"]"+nbService);
  heureDebutInterprete = document.getElementById(nameService+"Start["+idService+"]"+nbService).value;
  heureDebutInterprete = heureDebutInterprete.split(":")
  dateStartInterprete.setHours(heureDebutInterprete[0])
  dateStartInterprete.setMinutes(heureDebutInterprete[1]);

  // Heure fin de l'interprete
  heureFinInterprete = heure.value;
  heureFinInterprete = heureFinInterprete.split(":")
  dateEndtInterprete.setHours(heureFinInterprete[0])
  dateEndtInterprete.setMinutes(heureFinInterprete[1])



  if (dateStartInterprete.getHours() >= dateStartTrajet.getHours() &&  dateStartInterprete.getHours() <= dateEndTrajet.getHours() &&  
  dateEndtInterprete.getHours() >= dateStartTrajet.getHours() &&  dateEndtInterprete.getHours() <= dateEndTrajet.getHours() && dateEndtInterprete.getHours() >= dateStartInterprete.getHours())
  {

  }
  else {
    if (dateStartInterprete.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateStartInterprete.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
    {
      dateStartInterprete.setDate(dateStartInterprete.getDate()+1);

    }
    if (dateEndtInterprete.getHours() + dateStartTrajet.getHours() >= dateStartTrajet.getHours() && dateEndtInterprete.getHours() + dateStartTrajet.getHours() <= dateStartTrajet.getHours() + dateEndTrajet.getHours())
    {
      dateEndtInterprete.setDate(dateEndtInterprete.getDate()+1);
  
    }
  }
  

 
   

  //  console.log(dateStartTrajet)
  //  console.log(dateEndTrajet)
  //  console.log(dateStartInterprete)
  //  console.log(dateEndtInterprete)


   if (dateStartInterprete.getTime() >= dateStartTrajet.getTime() && 
   dateStartInterprete.getTime() <= dateEndTrajet.getTime() && 
   dateEndtInterprete.getTime() >= dateStartInterprete.getTime() && 
   dateEndtInterprete.getTime() <= dateEndTrajet.getTime() && 
   dateEndtInterprete.getTime() >= dateStartInterprete.getTime())
  {
    return true;
  }
  else 
  {
    displayError(heure, '');
    return false;
  }
  
}

function checkheure(button)
{
  if (button.id >= 2 && button.id <=6 || button.id <=9 || button.id == 15 ||button.id == 16 || button.id==18 ||button.id == 19) {
  
  button.removeAttribute("data-dismiss");
  var count=0;
  firstChild = parent[1]
  form = document.getElementById("form"+button.id);
  parent = form.childNodes;
  for (i=5;i<parent.length;i++)
  {
    
    child = parent[i];
    child = child.childNodes;
    for (j=0;j<5;j++)
    {
      if (j==1 || j==3)
      {
        style = child[j].getAttributeNode("style");
        if (style != null)
        {
        
          if (child[j].getAttributeNode("style").value !== "" || child[j].value === "")
          {
   
            count++;
          }
        }
        else
        {
          if (child[j].value === "")
          {
            count++;
          }
        }
       
      }
    }
   
  }
  if ( parent[1].value === "")
  {
   button.setAttribute("data-dismiss","modal");
  }
 if (count == 0 && parent[1].value !== "")
 {
  style = parent[1].getAttributeNode("style");
  if (style != null)
  {
    if (parent[1].getAttributeNode("style").value === "" && parent[1].value !== "")
    {
      button.setAttribute("data-dismiss","modal");
      return true;
    }
  }
  else
  {
      button.setAttribute("data-dismiss","modal");
      return true;
  }
 }

 
 else
 {
   return false
 }
}
else
 {
  button.setAttribute("data-dismiss","modal");
   return true;
 }
}

function checkGlobal(donnees)

{
  clearInputDonnees(donnees);
  var countError=0;
    // On check les interprete, les coach sportif et les coach culture s'il possède des erreurs dans les dates 
    // On fait la meme chose pour les billets touristiques et les hotels.
  var countCollab=0;
  var arrayCollab = new Array();
  var interprete ="Interprete";
  var coachSportif = "CoachSportif";
  var coachCulture = "CoachCulture"
  var billet = "Billet"
  var hotel = "Hotel"
  var start = "start"
  var end = "end";
  var countBillet = 0;
  var arrayCollab = new Array;
  var billet = "Billet"
  var idBillet = 8
  var hotel = "Hotel"
  var idHotel = 9
  var arrayHotel = new Array;

  for (j=0;j<100;j++)
  {
    if (document.getElementById(start+interprete+j) !== null && document.getElementById(end+interprete+j) !== null)
    {
      var inputStart = document.getElementById(start+interprete+j);
      var inputEnd = document.getElementById(end+interprete+j);
      if (inputStart.style.borderColor !== '' || inputEnd.style.borderColor !== '')
      {
        if (checkIfErrorMessageCollaborateurs("collaborateurs_errorDonnee"+j) == false && document.getElementById(j).checked === true)
          {
             displayErrorMessageInterprete(inputStart,"Erreur ! ",j);
          }
      countCollab++;
      arrayCollab.push(j);
      }
    }
    else if (document.getElementById(start+coachSportif+j) !== null && document.getElementById(end+coachSportif+j) !== null)
    {
      var inputStart = document.getElementById(start+coachSportif+j);
      var inputEnd = document.getElementById(end+coachSportif+j);
      if (inputStart.style.borderColor !== '' || inputEnd.style.borderColor !== '')
      {
        if (checkIfErrorMessageCollaborateurs("collaborateurs_errorDonnee"+j) == false && document.getElementById(j).checked === true)
          {
             displayErrorMessageCoachSportif(inputStart,"Erreur ! ",j);
          }
      countCollab++;
      arrayCollab.push(j);
      }
    }
    else if (document.getElementById(start+coachCulture+j) !== null && document.getElementById(end+coachCulture+j) !== null)
    {
      var inputStart = document.getElementById(start+coachCulture+j);
      var inputEnd = document.getElementById(end+coachCulture+j);
      if (inputStart.style.borderColor !== '' || inputEnd.style.borderColor !== '')
      {
        if (checkIfErrorMessageCollaborateurs("collaborateurs_errorDonnee"+j) == false && document.getElementById(j).checked === true)
          {
             displayErrorMessageCoachCulture(inputStart,"Erreur ! ",j);
          }
      countCollab++;
      arrayCollab.push(j);
      }
    }
  
    else if (document.getElementById("startBillet"+j) !== null)
    {
      var inputStart = document.getElementById("startBillet"+j);
      if (inputStart.style.borderColor !== '')
      {
        //if (checkIfErrorMessageCollaborateurs("billets_errorDonnee"+j) == false)
        //{
        //     displayErrorMessageBillets(inputStart,"Erreur ! ",j);
        //  }
      countCollab++;
      arrayCollab.push(j);
      }
    }
   
      for (k=0;k<30;k++)
      {
       // console.log(document.getElementById("startHotel"+j+"["+k+"]"))
        if ( document.getElementById("startHotel"+j+"["+k+"]") !== null)
        {
        var inputStart = document.getElementById("startHotel"+j+"["+k+"]");
        if (inputStart.style.borderColor !== '')
        {
        countCollab++;
        arrayCollab.push(j);
        arrayHotel.push(k);
        }
      }
    }
 
    
   
   
  }



  if (countCollab >0)
  {
 
    for (var i = 0; i < arrayCollab.length; i++) {
      //element = arrayCollab[i].id.split("quantites");
      element = arrayCollab[i];
      var inputStartInterprete = document.getElementById("startInterprete"+element);
      var inputStartCoachSportif = document.getElementById("startCoachSportif"+element);
      var inputStartCoachCulture = document.getElementById("startCoachCulture"+element);
      var inputStartBillet = document.getElementById("startBillet"+element);



      if (inputStartInterprete !== null)
      {
        inputStart = inputStartInterprete;
      }
      else if (inputStartCoachSportif !== null)
      {
        inputStart = inputStartCoachSportif;
      }
      else if (inputStartCoachCulture !== null)
      {
        inputStart = inputStartCoachCulture;
      }
      else if (inputStartBillet !== null)
      {
        inputStart = inputStartBillet;
      }
      if (inputStart === null)
       {
      for (var l = 0; l < arrayHotel.length; l++) {
        element2 = arrayHotel[l];
          if ( document.getElementById("startHotel"+element+"["+element2+"]") !== null)
          {
             inputStart = document.getElementById("startHotel"+element+"["+element2+"]");
          }
      }
    }
    
      //console.log(inputStart);
      var name = inputStart.id.split("start");
      name2 = name[1].split(element);
      name = name2[0]
      console.log(name) // Ok
      if (name == "Interprete")
      {

        var button = document.getElementById("11").parentNode;  
        button = button.childNodes
        button = button[1]
        if(checkIfErrorMessage("interpreteError") == false && buttonChecked(button) == true && buttonChecked(document.getElementById(element).checked) ==true)
        {
          
          displayErrorDonnees(donnees,"Erreur de date au niveau des interprètes","interpreteError");
          countError++;
        }
    }
    else if (name == "CoachSportif")
    {
      var button = document.getElementById("12").parentNode;  
      button = button.childNodes
      button = button[1]
      if(checkIfErrorMessage("coachSportifError") == false && buttonChecked(button) == true)
      {
        
        displayErrorDonnees(donnees,"Erreur de date au niveau des coach sportifs","coachSportifError");
        countError++;
      }
    }
    else if (name == "CoachCulture")
    {
      var button = document.getElementById("13").parentNode;  
      button = button.childNodes
      button = button[1]
      if(checkIfErrorMessage("CoachCultureError") == false && buttonChecked(button) == true)
      {
        
        displayErrorDonnees(donnees,"Erreur de date au niveau des coach cultures","CoachCultureError");
        countError++;
        
      }
    }
    else if (name == "Billet")
    {
     

      var button = document.getElementById("idBillet"+element);  
      if(checkIfErrorMessage("BilletError") == false && buttonChecked(button) == true)
      {
        
        displayErrorDonnees(donnees,"Erreur de date au niveau des billets touristiques","BilletError");
        countError++;
        
      }
    }
    else if (name == "Hotel")
    {
      //console.log(inputStart);
      var split = inputStart.id.split("startHotel");
      split = split[1].split("[");
      idHotel = split[0]
      idChambre = split[1].split("]");
      idChambre = idChambre[0];

      var button = document.getElementById("idHotel"+idHotel+"["+idChambre+"]");  
      if(checkIfErrorMessage("HotelError") == false && buttonChecked(button) == true)
      {
        
        displayErrorDonnees(donnees,"Erreur de date au niveau des hôtels","HotelError");
        countError++;
        
      }
    }

    }

  }

  var array = new Array();
  var count=0;
  for (i=0;i<200;i++)
  {
    
    if (document.getElementById("quantites"+i))
    {

      element = document.getElementById("quantites"+i);      
      if (element.style.borderColor !== '')
      {
        if (checkIfErrorMessageP("p_errorDonnee"+i) == false)
        {
       displayErrorP(element,"Erreur ! ",i);
        }
        count++;
        array.push(element);
      }
      
    }
  }
  if (count >0)
  {
    for (var i = 0; i < array.length; i++) {
      element = array[i].id.split("quantites");
      element = element[1];
     
      var button = document.getElementById("slider"+element).parentNode;  
      button = button.childNodes
      button = button[1]
      if (element >= 2 && element <=6)
      {
    
        if(checkIfErrorMessage("appareils") == false && buttonChecked(button) == true)
        {
      
          displayErrorDonnees(donnees,"Erreur de quantité dans la section : Locations appareils numériques.","appareils");
          countError++;
        }
     
        
      }
     
      if (element == 9)
      {
        if(checkIfErrorMessage("visites") == false && buttonChecked(button) == true)
        {
          displayErrorDonnees(donnees,"Erreur de quantité dans la section : Préparations de visites touristiques.","visites");
          countError++;
        
        }
      }
      
      if (element == 15 || element == 16)
      {
        if(checkIfErrorMessage("pets") == false && buttonChecked(button) == true)
        {
          displayErrorDonnees(donnees,"Erreur de quantité dans la section : Pets Sittings.","pets");
          countError++;
      
        }
      }
      if (element == 18 || element == 19)
      {
        if(checkIfErrorMessage("boissons") == false && buttonChecked(button) == true)
        {
          displayErrorDonnees(donnees,"Erreur de quantité dans la section : Services de repas et de boissons.","boissons");
          countError++;
        }
      }
    }
  }



  for (i=0;i<100;i++)
  {
    // pour les billets
    if (document.getElementById("quantites"+idBillet+"["+i+"]"))
    {
      element = document.getElementById("quantites"+idBillet+"["+i+"]");  
     // clearPCollaborateurs(element);
          
      if (element.style.borderColor !== '')
      {
        if (checkIfErrorMessageP("p_errorDonnee"+i) == false)
        {
       displayErrorP(element,"Erreur ! ",i);
        }
        countBillet++;
        array.push(element);
      }
    }   
  }
 

  if (countBillet >0)
  {
    for (var i = 0; i < array.length; i++) {
      element = array[i].id.split("quantites");
      element = element[1];
      element = element.split("[");
      element = element[0];
     
      var button = document.getElementById("slider"+element).parentNode;  
      button = button.childNodes
      button = button[1]
      
      if (element == 8  || element == 7)
      {
        
        if(checkIfErrorMessage("visites") == false && buttonChecked(button) == true)
        {
          displayErrorDonnees(donnees,"Erreur de quantité dans la section : Préparations de visites touristiques.","visites");
          
        
        }
     
        
      }
  
    }

  }



  if (countError > 0)
  {
    return false;
  }
  else
  {
    return false;
     //return true;
  }


}

function buttonChecked(button)
{
  if (button.checked == true)
      {
        return true;
      }
      else
      {
        return false;
      }
}









