

function kickEntreprise(id){

  console.log(id);

  $.ajax({    //create an ajax request to display.php
  type: "GET",
  url: "ajaxKickEntreprise.php?idClient=" + id + "&idEntreprise=" + $("#idEntreprise").val(),
  dataType: "html",   //expect html to be returned
  success: function(response){

    document.getElementById("rowId" + id).remove();
    alert(response);
    /*
    if (response == 1) {
      alert("Utilisateur banni de votre entreprise");
      document.getElementById("rowId" + id).remove();
    } else {
      alert("Erreur");
    }
    */

  }
});



}
