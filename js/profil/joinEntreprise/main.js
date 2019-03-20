function getNameEntreprise() {

var nameEntreprise = document.querySelectorAll("option:checked");

var nameEntreprise = nameEntreprise[0].value
return nameEntreprise;
}
$(document).change(function() {
    var name = getNameEntreprise();

        $.ajax({    //create an ajax request to display.php
            type: "GET",
            url: "updateEntreprise.php?name="+name,
            dataType: "html",   //expect html to be returned
            success: function(response){
                $("#responsecontainer").html(response);           
                var res = response.split(":");
                var nbSalarie = document.getElementById('nbSalarie')
                nbSalarie.innerHTML = res[2];
                nbSalarie.value = res[2];

                var numEntreprise = document.getElementById('numEntreprise')
                numEntreprise.innerHTML = res[3];
                numEntreprise.value = res[3];

                var adresse = document.getElementById('adresse')
                adresse.innerHTML = res[1];
                adresse.value = res[1];

                var  numSiret = 
                document.getElementById('numSiret')
                numSiret.innerHTML = res[4];
                numSiret.value = res[4];

                var  pays = 
                document.getElementById('pays')
                pays.innerHTML = res[5];
                pays.value = res[5];
            }
    });
});
