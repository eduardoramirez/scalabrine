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
                  alert("womps");
      }, // error 
      // script call was successful 
      // data contains the JSON values returned by the Perl script 
      success: function(data){
        if (data.error){          alert("didnt worked!");
         // add this <div class="alert alert-danger" role="alert">incorrect password.</div>
          //wrong password
        } // if
        else { // login was successful
          // move the user to the dashboard
          alert("it worked!");
          $('form#loginform').hide();
            $('div#loginResult').text("data.time: " + data.time
              + ", data.userid: " + data.userid);
            //location.href = "/index"
        } //else
      } // success
    }); // ajax

    return false;
  });
});
