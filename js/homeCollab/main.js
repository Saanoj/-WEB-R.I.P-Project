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



	$(document).ready(function(){

		$(".editlink").on("click", function(e){

		  e.preventDefault();
			var dataset = $(this).prev(".datainfo");
			var savebtn = $(this).next(".savebtn");
			var theid   = dataset.attr("id");
			var newid   = theid+"-form";
			var currval = dataset.text();

			dataset.empty();

			$('<input type="text" name="'+newid+'" id="'+newid+'" value="'+currval+'" class="hlite">').appendTo(dataset);
			 }
			$(this).css("display", "none");
			savebtn.css("display", "block");

		});


		$(".savebtn").on("click", function(e){

			e.preventDefault();
			var elink   = $(this).prev(".editlink");
			var dataset = elink.prev(".datainfo");
			var newid   = dataset.attr("id");

			var cinput  = "#"+newid+"-form";
			var einput  = $(cinput);
			var newval  = einput.attr("value");

			updateProfil(newval,newid,idProfil,idEntreprise);
			$(this).css("display", "none");
			einput.remove();

			if (newid == 'birthday') {
				var newConvertDate = convertDate(newval)
				dataset.html(newConvertDate);
				}
				else
				{
			dataset.html(newval);
				}


			elink.css("display", "block");

		});
	});

	function convertDate(dateString){
		var p = dateString.split(/\D/g)
		return [p[2],p[1],p[0] ].join("-")

	}

	function updateProfil(newval,newid,idProfil,idEntreprise) {

		var request = new XMLHttpRequest();
		request.onreadystatechange = function(){
		  if(request.status == 200 && request.readyState == 4){
		  }
		}
			data='newval=' + newval + '&newid=' + newid + '&idProfil=' + idProfil.innerHTML + '&idEntreprise=' + idEntreprise.innerHTML;
			request.open('POST', 'updateProfil.php');
			request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			request.send(data);
			console.log(data)
	  }
