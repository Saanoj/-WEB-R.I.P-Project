
$(document).ready(function(){
	$(".editlink").on("click", function(e){
	  e.preventDefault();
		var dataset = $(this).prev(".datainfo");
		var savebtn = $(this).next(".savebtn");
		var theid   = dataset.attr("id");
		var newid   = theid+"-form";
		var currval = dataset.text();
		var idProfil = document.getElementById("idProfil").innerHTML;	
					
		dataset.empty();

		if (theid == 'birthday') {
			$('<input type="date" name="'+newid+'" id="'+newid+'" value="'+currval+'" class="hlite">').appendTo(dataset);

		}
		if( theid == 'gender') {
			
			$('<select  name="'+newid+'" id="'+newid+'" class="hlite"> <option value="Man">Homme </option><option value="Woman">Femme </option> </select>').appendTo(dataset);
			
		 }
		 		if (theid != 'gender' && theid != 'birthday' )
		 {
		
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
		
		updateProfil(newval,newid,idProfil);
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

function updateProfil(newval,newid,idProfil) {
	var request = new XMLHttpRequest();
	request.onreadystatechange = function(){
	  if(request.status == 200 && request.readyState == 4){
		
	  }
	};
	var data = 'newval=' + newval+ '&newid=' + newid + '&idProfil='+idProfil.innerHTML ;
	console.log("data = " + data);
	request.open('POST', 'updateProfil.php');
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
	request.send(data);
	return false;
  }
  
  
  
