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
function checkGlobal(donnees)

{
var interprete = checkHeureFinInterprete(donnees.heure);
var interpreteDebut = checkHeureDebutInterprete(donnees.heure);
var sportif = checkHeureFinSportif(donnees.heure);
var culture = checkHeureFinCulture(donnees.heure);



if (interprete && sportif && culture && interpreteDebut)
{
  return true;
}
else {
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


function checkHeureDebutInterprete(heure) {
  clearInput(heure);
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
  

 
   

   console.log(dateStartTrajet)
   console.log(dateEndTrajet)
   console.log(dateStartInterprete)
   console.log(dateEndtInterprete)


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

