function updateAdmin() {
	var request = new XMLHttpRequest();
	request.onreadystatechange = function(){
	  if(request.status == 200 && request.readyState == 4){

	  }
	};
	//console.log(document);
	var id = document.getElementById("id").value;
	var admin = document.getElementById("admin").value;
	console.log("id: " + id);
	console.log("admin: " + admin);

	var	data='id=' + id + '&admin=' + admin;
	request.open('POST', 'admin.php');
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
	request.send(data);
	return false;
  }
