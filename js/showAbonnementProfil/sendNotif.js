

function sendNotifEntreprise(id){

  console.log(id);
  console.log($("#idEntreprise").val());


  $.ajax({    //create an ajax request to display.php
  type: "GET",
  url: "ajaxUsersSendEntrepriseNotification.php?idClient=" + id + "&idEntreprise=" + $("#idEntreprise").val(),
  dataType: "html",   //expect html to be returned
  success: function(response){
    if (response == 1) {
      alert("Notification bien envoyé");
      document.getElementById("rowId" + id).remove();
    } else {
      alert("Error while sending notification");
    }

  }
});


}
