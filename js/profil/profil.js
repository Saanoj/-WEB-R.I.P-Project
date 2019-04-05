
$(document).ready(function(){
	$(".editlink").on("click", function(e){

		e.preventDefault();
		var dataset = $(this).prev(".datainfo");
		var savebtn = $(this).next(".savebtn");
		var theid   = dataset.attr("id");
		var newid   = theid+"-form";
		var currval = dataset.text();
		var idProfil = document.getElementById("idProfil").innerHTML;
		var idEntreprise = document.getElementById("idEntreprise");

		// var idEntreprise = document.getElementById("idEntreprise").innerHTML;
	//	console.log(idEntreprise);



		dataset.empty();

		if (theid == 'birthday') {
			$('<input type="date" name="'+newid+'" id="'+newid+'" value="'+currval+'" class="hlite">').appendTo(dataset);

		}
		if( theid == 'gender') {

			$('<select  name="'+newid+'" id="'+newid+'" class="hlite"> <option value="Homme">Homme </option><option value="Femme">Femme </option> </select>').appendTo(dataset);

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
	  var datasets = $(this).prevAll(".datainfo");
	  datasets.each(function(){
		var newid   = $(this).attr("id");
		var einput  = $("#"+newid+"-form");
		var newval  = einput.val();
		

	
		einput.remove();
		if (newid == 'birthday') {
			var newConvertDate = convertDate(newval)
			$(this).html(newConvertDate);
			}
			else
			{
				$(this).html(newval);
			}


		

		update(newval,newid,idProfil,idEntreprise);

	  });
  
	  $(this).css("display", "none");
	  elink.css("display", "block");
	});
  });

function convertDate(dateString){
	var p = dateString.split(/\D/g)
	return [p[2],p[1],p[0] ].join("-")

}

function update(newval,newid,idProfil,idEntreprise)
{
	datas='newval=' + newval + '&newid=' + newid + '&idProfil=' + idProfil.innerHTML + '&idEntreprise='+ idEntreprise.innerHTML;

	$.ajax({
        url: "updateProfil.php",
        type: "post",
        data: datas ,
        success: function (response) {
		   // you will get response from your php page (what you echo or print)  

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });
}

$('#myModal2').on('show', function() {
	$('#myModal').css('opacity', .5);
	$('#myModal').unbind();
});
$('#myModal2').on('hidden', function() {
	$('#myModal').css('opacity', 1);
	$('#myModal').removeData("modal").modal({});
});
