
// This sample uses the Autocomplete widget to help the user select a
// place, then it retrieves the address components associated with that
// place, and then it populates the form fields with those details.
// This sample requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:


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
// Create the autocomplete object, restricting the search predictions to
// geographical location types.

autocomplete = new google.maps.places.Autocomplete(
  document.getElementById('autocomplete'), {
      types: ['geocode'],
      componentRestrictions: {country: "fr"}
  });
// Avoid paying for data that you don't need by restricting the set of
// place fields that are returned to just the address components.

// autocomplete.setFields('address_components');

// When the user selects an address from the drop-down, populate the
// address fields in the form.
autocomplete.addListener('place_changed', fillInAddress);

autocomplete2 = new google.maps.places.Autocomplete(
  document.getElementById('autocomplete2'), {
      types: ['geocode'],
      componentRestrictions: {country: "fr"}
  });
  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  
  // autocomplete.setFields('address_components');
  
  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete2.addListener('place_changed', fillInAddress);
}


function fillInAddress() {
// Get the place details from the autocomplete object.
var place = autocomplete.getPlace();
var place2 = autocomplete2.getPlace();

/*
for (var component in componentForm) {
document.getElementById(component).value = '';
document.getElementById(component).disabled = false;
}
*/

// Get each component of the address from the place details,
// and then fill-in the corresponding field on the form.
for (var i = 0; i < place.address_components.length; i++) {
var addressType = place.address_components[i].types[0];
if (componentForm[addressType]) {
  var val = place.address_components[i][componentForm[addressType]];
  // document.getElementById(addressType).value = val;
}
}
}

function displayError(input, message) {
  input.style.borderColor = 'red';
  var error = document.createElement('p');
  error.innerHTML = message;
  error.style.color = 'red';
  $(error).css({"margin-top" : "45px","margin-left" : "62%","position" :"absolute","font-weight" : "bold"});
  
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


function checkheureDebut(heure)
{
 
   heure = document.getElementById("heureDebut").value;
   var dateDebut = document.getElementById("dateDebut");
   clearInput(dateDebut);

 var res = heure.split(":"); 
  var d = new Date(dateDebut.value);
  var dateNow = new Date();
  d.setHours(res[0]);
  d.setMinutes(res[1]);
if (d.getTime() >= dateNow.getTime())
{
  return true;
}
else
{
  displayError(dateDebut, 'Date invalide');
  return false;
}

}


function checkdateDebut(date) {
  clearInput(dateDebut);


  var heure = document.getElementById("heureDebut").value;
  if (heure !== "" == true) {

  var res = heure.split(":"); 
  var date = new Date(date.value);
  var dateNow = new Date();
  date.setHours(res[0]);
  date.setMinutes(res[1]);
if (date.getTime() >= dateNow.getTime())
{
  return true;
}
else
{
  displayError(dateDebut, 'Date invalide');
  return false;
}
}
}


function checkGlobal(donnees) {

  var dateDebut = checkheureDebut(donnees.dateDebut);
  var heureDebut = checkheureDebut(donnees.heureDebut);

  if (dateDebut && heureDebut) 
  {
    return true;
  }
  else
  {
    return false;
  }
}
 /* SA BUG NEED HELP
function checkStart(autocomplete) {
  clearInput(autocomplete);
  console.log(autocomplete.value)
  if (autocomplete.value !== "" == true) {
    return true
}

else {
  displayError(autocomplete, 'Adresse de départ vide');
  return false;

}
}

function checkEnd(end) {
  clearInput(end);

  if (end.value !== "" == true) {
    return true
  }
  
  else {
    displayError(end, 'Adresse d\'arrivé vide');
    return false;
  
  }
  
}
*/