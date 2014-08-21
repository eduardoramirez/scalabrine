<!DOCTYPE HTML>
<html>
<head>
    <title>login</title>
      <meta charset="utf-8">
      <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300italic,600%7CSource+Code+Pro" rel="stylesheet" />
      <link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
      <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
      <link rel="stylesheet" href="/css/login.css" />
</head>
<body>
<?php
    session_start();
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $con = mysqli_connect('localhost','root','Tw0sof+9Ly','scalabrinedb');
        
        $query = "SELECT username, password FROM users WHERE username='$username'";

        if($stmt = mysqli_prepare($con, $query))
        {
            mysqli_stmt_execute($stmt);

            mysqli_stmt_bind_result($stmt, $db_username, $db_password);

            mysqli_stmt_fetch($stmt);

            if(password_verify($password, $db_password))
            {
                $_SESSION['login'] = "1";
                $_SESSION['username'] = $username;
                header("Location: /index");
            }
            else
            {
                //incorrect password
                $_SESSION['incorrect_pass'] = true;
                header("Location: /index");
            }
        }
        else
        {
            $_SESSION['login'] = "";
            header("HTTP/1.1 403 Forbidden");
            header("Location: /403");
        }
        mysqli_close($con);
    }
    else {
?>
<section id="loginBox">
    <?php
        if(isset($_SESSION['incorrect_pass']))
        {
          $_SESSION['incorrect_pass'] = false;
      ?>
            <section id="hero">
               <h4>incorrect password.</h4>
            </section>
      <?php
        }
        session_unset();
      ?>
    <h2>login</h2>
    <form method="post" class="minimal">
        <label for="username">
            <input type="text" name="username" id="username" placeholder="username"  required="required" />
        </label>
        <label for="password">
            <input type="password" name="password" id="password" placeholder="password"  required="required" />
        </label>
        <button type="submit" class="btn-minimal" name="login">sign in</button>
        <p>Don't have an account? <a href="/login">Sign up here</a></p>
    </form>
</section>
<?php
    }
?>
</body>
</html>
