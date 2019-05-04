

$(document).ready(function() {

  $("#searchUser").keyup(function() {

    //console.log("yay");
    $.ajax({    //create an ajax request to display.php
      type: "GET",
      url: "ajaxUsersEntreprise.php?inputText=" + $("#searchUser").val(),
      dataType: "html",   //expect html to be returned
      success: function(response){
        $("#users").empty();
        $("#users").html(response);
      }

    });
  });

});
