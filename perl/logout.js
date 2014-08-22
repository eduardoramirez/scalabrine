$(document).ready(function(){
  $("button#logoutbutt").submit(function() { // loginForm is submitted
    $.ajax({
      type: "GET",
      url: "/cgi-bin/logout.pl", // URL of the Perl script
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        // error occure in http request
      }, // error 
      // script call was successful 
      // data contains the JSON values returned by the Perl script 
      success: function(data){
        // show what kind of error the user received (wrong username -- wrong pass)
        } // if
        else { // login was successful
          // move the user to the dashboard
        } //else
      } // success
    }); // ajax

    return false;
  });
});