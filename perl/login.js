$(document).ready(function(){
  $("form#loginform").submit(function() { // loginForm is submitted
    var username = $('#username').attr('value'); // get username
    var password = $('#password').attr('value'); // get password

    $.ajax({
      type: "GET",
      url: "/cgi-bin/login2.pl", // URL of the Perl script
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      // send username and password as parameters to the Perl script
      data: "username=" + username + "&password=" + password,
      // script call was *not* successful
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        // error occure in http request
        alert("HTTP Error occured");
      }, // error 
      // script call was successful 
      // data contains the JSON values returned by the Perl script 
      success: function(data){
        if (data.error){          
          $(".container").prepend("<div class='alert alert-danger' role='alert'>incorrect password.</div>");
        } // if
        else { // login was successful
          alert("it worked!");
          $.post("dashboard.html", {email: data.userid, time: data.now});
          location.href = "/dashboard";
        } //else
      } // success
    }); // ajax

    return false;
  });
});
