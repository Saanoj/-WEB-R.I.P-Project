$(document).ready(function() {

  $("#inputUsers").keyup(function() {
      //console.log("yay");
      $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "getUsersFromTextAJAX.php?inputText=" + $("#inputUsers").val() + "&isBanned=0" ,
        dataType: "html",   //expect html to be returned
        success: function(response){
            $("#users").empty();
            $("#users").html(response);
            //alert(response);
            console.log("yay");
        }

      });
    });

    $("#inputBannedUsers").keyup(function() {
        //console.log("yay");
        $.ajax({    //create an ajax request to display.php
          type: "GET",
          url: "getUsersFromTextAJAX.php?inputText=" + $("#inputBannedUsers").val() + "&isBanned=1" ,
          dataType: "html",   //expect html to be returned
          success: function(response){
              $("#users").empty();
              $("#users").html(response);
              //alert(response);
              console.log("yay");
          }

        });
      });
  });
