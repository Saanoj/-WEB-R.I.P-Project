function deleteAbonnement() {
    var idSession = document.getElementById('idSession').value;
	var request = new XMLHttpRequest();
	request.onreadystatechange = function(){
        if(request.status == 200 && request.readyState == 4){
    }
}    
        data='id=' + idSession;  
		request.open('POST', 'updateProfil.php');
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send(data);
  }

  function deleteEntreprise() {
    var idSession = document.getElementById('idSession').value;
    var idEntreprise = document.getElementById('idEntreprise').value;

	var request = new XMLHttpRequest();
	request.onreadystatechange = function(){
        if(request.status == 200 && request.readyState == 4){
    }
}    
        data='id=' + idSession + '&idEntreprise=' + idEntreprise;
		request.open('POST', 'updateProfil.php');
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
		request.send(data);
  }

  
  
