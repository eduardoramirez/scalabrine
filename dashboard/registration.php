<?php
  session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] === '1') 
{
  header("Location: /dashboard/index");
}
else
{
  if(isset($_POST['signup'])) 
  {
    //$con = mysqli_connect('localhost','scala_master','Tw3n+ysof+9ly','scalabrinedb');
    $con = mysqli_connect('localhost','root','Tw0sof+9Ly','scalabrinedb');
    // need to escape characters
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password']; 

    $options = [
      'cost' => 11,
      'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    ];

    if(strcmp($password, $confirm_password) === 0)
    {
      $res = mysqli_query($con, "SELECT * FROM user WHERE username='$username'");
      $res2 = $res = mysqli_query($con, "SELECT * FROM user WHERE email='$email'");
      
      // Username is free
      if(mysqli_num_rows($res) == 0 && mysqli_num_rows($res2) == 0) 
      {

        $h_password = password_hash($password, PASSWORD_BCRYPT, $options);
        $sql="INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$h_password')";

        mysqli_query($con, $sql);

        $_SESSION['signup'] = "";
        header("Location: /dashboard/index");
      } 
      else 
      {
        //username is taken
        $_SESSION['username'] = true;
        header("Location: /dashboard/registration");
      }
    }
    else 
    {
      // passwords didnt match
      $_SESSION['pass'] = true;
      header("Location: /dashboard/registration");
    }

    mysqli_close($con);
  }

  else
  {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="registration">

  <title>scalabrine | sign up</title>

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
    if(isset($_SESSION['username']))
    {
      $_SESSION['username'] = false;
  ?>
    <div class="alert alert-info" role="alert">username/email already taken</div>    
  <?php
    }
    else if (isset($_SESSION['pass'])) 
    {
      $_SESSION['pass'] = false;
    ?>
    <div class="alert alert-info" role="alert">passwords do not match.</div>   
  <?php    
    }
    session_unset();
  ?>

    <form class="form-signin" method="post">
      <h2 class="form-signin-heading">registration</h2>
      <div class="login-wrap">
        <p> Enter your account details below</p>
        <input type="text" class="form-control" name="username" placeholder="User ID" autofocus>
        <input type="text" class="form-control" name="email" placeholder="Email">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <input type="password" class="form-control" name="confirm_password" placeholder="Re-type Password">

        <button class="btn btn-lg btn-login btn-block" name="signup" type="submit">Submit</button>

        <div class="registration">
          already registered?
          <a class="" href="/dashboard/login">
            login
          </a>
        </div>
      </div>
    </form>

  </div>

  <?php
    }
  }
  ?>
  </body>
</html>
