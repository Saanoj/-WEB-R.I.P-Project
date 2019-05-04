
function acceptInvite(idEntreprise,idClient){

  var datas = "idClient=" + idClient + "&idEntreprise=" + idEntreprise + "&mode" + 1;

	$.ajax({    //create an ajax request to display.php
  type: "POST",
  url: "ajaxInviteAccept.php",
  dataType: "html",   //expect html to be returned
  data: datas ,
  success: function(response){
    alert(response);
		if (response == 1) {
			alert("vous avez bien accepter l'invitation");
		}
    document.getElementById("inviteID" + idEntreprise).remove();
  }
});
}

function refuseInvite(idEntreprise,idClient){

  var datas = "idClient=" + idClient + "&idEntreprise=" + idEntreprise + "&mode" + 1;

	$.ajax({    //create an ajax request to display.php
  type: "POST",
  url: "ajaxInviteRefuse.php",
  dataType: "html",   //expect html to be returned
  data: datas ,
  success: function(response){
    alert(response);
		if (response == 2) {
			alert("vous avez bien refusé l'invitation");
		}
		document.getElementById("inviteID" + idEntreprise).remove();
  }
});
}
