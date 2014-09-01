<?php 

session_start();

// If user is logged in, redirect to homepage
if (isset($_SESSION['login']) && $_SESSION['login'] === '1') 
{
  header("Location: /dashboard/index");
}
else{ 

include 'functions.php';

////////////
// listener for the reset password button
////////////
if(isset($_POST['reset_pass'])) 
{
  $result = checkEmail($_POST['email']);
  if ($result['status'])
  {
    // email exists -- send email to user
    sendPasswordEmail($result['userID']);
    $_SESSION['validemail'] = true;
    header("Location: /dashboard/login");
  } 
  else 
  {
    // email is not valid
    $_SESSION['validemail'] = false;
    header("Location: /dashboard/login");
  }
} 
else if(isset($_POST['login'])) 
{
  // need to escape characters
  $username = $_POST['username'];
  $password = $_POST['password'];
  $con = mysqli_connect('localhost','root','Tw0sof+9Ly','scalabrinedb');
      
  $query = "SELECT `Username`, `Password`, `Email`, `OrgID`, `admin` FROM `user` WHERE `Username`='$username'";

  if($stmt = mysqli_prepare($con, $query))
  {
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $db_username, $db_password, $db_email, $db_orgID, $db_admin);

    mysqli_stmt_fetch($stmt);

    if(strcmp($username, $db_username) !== 0)
    {
      //should say something along the lines of .. no username found
      $_SESSION['login'] = "";
      header("HTTP/1.1 403 Forbidden");
      header("Location: /403");
      exit();
    } 

    if(password_verify($password, $db_password))
    {
      $_SESSION['login'] = "1";
      $_SESSION['username'] = $username;
      $_SESSION['email'] = $db_email;
      $_SESSION['orgID'] = $db_orgID;
      $_SESSION['admin'] = $db_admin;

      date_default_timezone_set('America/Los_Angeles');
      $date = new DateTime();
      $_SESSION['time'] = $date->format('Y-m-d H:i:s');

      header("Location: /dashboard/index");
    }
    else
    {
      //incorrect password
      $_SESSION['incorrect_pass'] = true;
      header("Location: /dashboard/login");
    }
  }

  mysqli_close($con);
} 
else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="login">

  <title>scalabrine | login</title>

  <link rel="icon" href="/img/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />  
  <!-- Bootstrap core CSS -->
  <link href="/dashboard/css/bootstrap.min.css" rel="stylesheet">
  <link href="/dashboard/css/bootstrap-reset.css" rel="stylesheet">
  <!--external css-->
  <link href="/dashboard/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="/dashboard/css/style.css" rel="stylesheet">
  <link href="/dashboard/css/style-responsive.css" rel="stylesheet" />

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="login-body">  
  <div class="container">
<?php
  if(isset($_SESSION['incorrect_pass']))
  {
    $_SESSION['incorrect_pass'] = false;
?>
  <div class="alert alert-danger" role="alert">incorrect password.</div>
<?php
  }
  else if(isset($_SESSION['validemail']))
  {
      if($_SESSION['validemail'] === true) {
?>
    <div class="alert alert-info" role="alert">email sent</div>
<?php
      }
     if($_SESSION['validemail'] === false) {
?>
    <div class="alert alert-danger" role="alert">email address not found</div>
<?php
    }
  }

  session_unset();
?>
    <form class="form-signin" method="post">
      <h2 class="form-signin-heading">login</h2>
      <div class="login-wrap">
        <input type="text" class="form-control" name="username" placeholder="User ID" autofocus>
        <input type="password" class="form-control" name="password" placeholder="Password">
        <label class="checkbox">
          <span class="pull-right">
            <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
          </span>
        </label>
            
        <button class="btn btn-lg btn-login btn-block" name="login" type="submit">Sign in</button>
        
        <div class="registration">
          Don't have an account yet?
          <a class="" href="/dashboard/registration">
            Create an account
          </a>
        </div>

      </div>

      <!-- Modal -->
      <div aria-hidden="true" role="dialog" tabindex="-1" id="myModal" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forgot Password ?</h4>
              </div>
            <form method="post">
              <div class="modal-body">
                <p>Enter your e-mail address below to reset your password.</p>
                <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

              </div>
              <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                <button class="btn btn-success" type="submit" name="reset_pass">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->

    </form>
  </div>

  <!-- js placed at the end of the document so the pages load faster -->
  <script src="/dashboard/js/jquery.js"></script>
  <script src="/dashboard/js/bootstrap.min.js"></script>
<?php
  }
}
?>

  </body>
</html>
