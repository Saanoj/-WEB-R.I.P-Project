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


function checkHeureFinSportif(heure)
{
    clearInput(heure);

    hStart = document.getElementById("startCoachSportif").value
    hStart = hStart.split(":")
    var dateStart = new Date()
    dateStart.setHours(hStart[0])
    dateStart.setMinutes(hStart[1])

    heures = heure.value;
    heures = heures.split(":")
    var dateEnd = new Date()
    dateEnd.setHours(heures[0])
    dateEnd.setMinutes(heures[1])


    if (dateEnd.getTime() >= dateStart.getTime())

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
  

    hStart = document.getElementById("startInterprete").value
    hStart = hStart.split(":")
    var dateStart = new Date()
    dateStart.setHours(hStart[0])
    dateStart.setMinutes(hStart[1])

    heures = heure.value;
    heures = heures.split(":")
    console.log(heure);
    var dateEnd = new Date()
    dateEnd.setHours(heures[0])
    dateEnd.setMinutes(heures[1])
    if (dateEnd.getTime() >= dateStart.getTime() && dateEnd.getTime() < dateStart.getTime() + 28800000)
{
  return true;
}
else
{
  displayError(heure, '');
  return false;
}
}

function checkHeureDebutInterprete(heure) {
  clearInput(heure);
  var hourTrajet = document.getElementById("hour").innerHTML
  hourTrajet = hourTrajet.split(" ")
  hourTrajet = hourTrajet[1]
  hourTrajet = hourTrajet.split(":")

  var dateTrajet = new Date()
  dateTrajet.setHours(hourTrajet[0])
  dateTrajet.setMinutes(hourTrajet[1])

  var hStart = document.getElementById("startInterprete").value
  hStart = hStart.split(":")
  var dateStart = new Date()
  dateStart.setHours(hStart[0])


  console.log( dateTrajet.getTime())

  if (dateStart.getTime() > dateTrajet.getTime() )
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

  hStart = document.getElementById("startCoachCulture").value
  hStart = hStart.split(":")
  var dateStart = new Date()
  dateStart.setHours(hStart[0])
  dateStart.setMinutes(hStart[1])

  heures = heure.value;
  heures = heures.split(":")
 
  var dateEnd = new Date()

  dateEnd.setHours(heures[0])
  dateEnd.setMinutes(heures[1])


  if (dateEnd.getTime() >= dateStart.getTime())

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

console.log(interprete)
console.log(sportif)
console.log(culture)

if (interprete && sportif && culture && interpreteDebut)
{
  return true;
}
else {
  return false;
}
}
