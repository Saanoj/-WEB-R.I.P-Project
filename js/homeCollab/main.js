function updateCollabStatus(isOnline) {
	var request = new XMLHttpRequest();
	request.onreadystatechange = function(){
	  if(request.status == 200 && request.readyState == 4){
        var button = document.getElementById('onlineButton');
        var statusLogo = document.getElementById('statusLogo');
        console.log("click");
        if (isOnline==0) {
          $("#onlineButton").html("Se mettre<br>en ligne");
          $('#onlineButton').removeAttr('onclick');
          button.setAttribute("onclick", "updateCollabStatus(1)");

          $('#onlineButton').removeAttr('class');
          button.setAttribute("class", "btn btn-success col-md-12");

          $('#statusLogo').html('Off');
          $('#statusLogo').removeAttr('class');
          statusLogo.setAttribute("class", "jumbotron display-1 bg-warning text-center");

        }else{
          $("#onlineButton").html("Se mettre<br>hors ligne");
          $('#onlineButton').removeAttr('onclick');
          button.setAttribute("onclick", "updateCollabStatus(0)");

          $('#onlineButton').removeAttr('class');
          button.setAttribute("class", "btn btn-warning col-md-12");

          $('#statusLogo').html('On');
          $('#statusLogo').removeAttr('class');
          statusLogo.setAttribute("class", "jumbotron display-1 bg-success text-center");

        }
	  }
	};
	data='isOnline=' + isOnline;
	request.open('POST', 'updateCollabStatus.php');
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
	request.send(data);
	console.log(data);
	return false;
  }
