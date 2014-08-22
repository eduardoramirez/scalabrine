$(document).ready(function(){
  $("form#signupBox").submit(function() { // loginForm is submitted
    var username = $('#username').attr('value'); // get username
    var email = $('#email').attr('value'); // get email
    var password = $('#password').attr('value'); // get password
    var con_password = $('#confirm_password').attr('value'); // get conpassword

    $.ajax({
      type: "GET",
      url: "/cgi-bin/signup.pl", // URL of the Perl script
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      // send username and password as parameters to the Perl script
      data: "username=" + username + "&email=" + email + "&password=" + password + "&confirm_password=" + con_password,
      // script call was *not* successful
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