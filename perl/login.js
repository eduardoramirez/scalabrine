$(document).ready(function(){
  $("form#loginBox").submit(function() { // loginForm is submitted
    var username = $('#username').attr('value'); // get username
    var password = $('#password').attr('value'); // get password

    $.ajax({
      type: "GET",
      url: "/cgi-bin/login.pl", // URL of the Perl script
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      // send username and password as parameters to the Perl script
      data: "username=" + username + "&password=" + password,
      // script call was *not* successful
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        // error occure in http request
         alert("something went wrong!")
      }, // error 
      // script call was successful 
      // data contains the JSON values returned by the Perl script 
      success: function(data){
        if (data.error){
          alert("some error!");
        // show what kind of error the user received (wrong username -- wrong pass)
        } // if
        else { // login was successful
          // move the user to the dashboard
          alert("it worked!")
        } //else
      } // success
    }); // ajax

    return false;
  });
});