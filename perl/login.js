$(document).ready(function(){
  $("form#loginform").submit(function() { // loginForm is submitted
    var username = $('#username').attr('value'); // get username
    var password = $('#password').attr('value'); // get password

    $.ajax({
      type: "GET",
      url: "http://104.131.195.41:9093/cgi-bin", // URL of the Perl script
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      // send username and password as parameters to the Perl script
      data: "username=" + username + "&password=" + password,
      // script call was *not* successful
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        // error occure in http request
         alert("something went wrong!");

          $('div#loginResult').text("responseText: " + XMLHttpRequest.responseText 
            + ", textStatus: " + textStatus 
            + ", errorThrown: " + errorThrown);
          $('div#loginResult').addClass("error")
      }, // error 
      // script call was successful 
      // data contains the JSON values returned by the Perl script 
      success: function(data){
        if (data.error){
          alert("some error!");
          $('div#loginResult').text("data.error: " + data.error);
          $('div#loginResult').addClass("error");
        // show what kind of error the user received (wrong username -- wrong pass)
        } // if
        else { // login was successful
          // move the user to the dashboard
          alert("it worked!");
          $('form#loginForm').hide();
            $('div#loginResult').text("data.success: " + data.success 
              + ", data.userid: " + data.userid);
            $('div#loginResult').addClass("success");
        } //else
      } // success
    }); // ajax

    return false;
  });
});