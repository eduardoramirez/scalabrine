<!DOCTYPE HTML>
<html>
<head>
    <title>login</title>
    <meta charset="UTF-8">
      <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300italic,600%7CSource+Code+Pro" rel="stylesheet" />
      <link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
      <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<?php
    session_start();
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $con = mysqli_connect('localhost','root','Tw0sof+9Ly','sample');
        $result = mysqli_query($con, "SELECT * FROM `users` WHERE username='$username' AND password='$password'");
        if(mysqli_num_rows($result) == 0) {
            $_SESSION['login'] = "";
            header("HTTP/1.1 403 Forbidden");
            header("Location: /403.html");
        }
        else {
            $_SESSION['login'] = "1";
            header("Location: /index.php");
        }
    }
    else {
?>
<section id="loginBox">
    <h2>login</h2>
    <form method="post" class="minimal">
        <label for="username">
            <input type="text" name="username" id="username" placeholder="username" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{4,20}$" required="required" />
        </label>
        <label for="password">
            <input type="password" name="password" id="password" placeholder="password"  required="required" />
        </label>
        <button type="submit" class="btn-minimal" name="login">sign in</button>
    </form>
</section>
<?php
    }
?>
</body>
</html>

</body> 