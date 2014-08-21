<!-- Got the basic framework of the signup mechanism, 
     need to test and find out what db we actually have. It seems
     that rn we are using a "sample" one. Also, need to add html
     to alert user when 1. the username they chose is taken. 
     2. when the password they enter doesnt match the confirm.
     WIP

     - eduardo 
-->

<!DOCTYPE html>
<html>
  <head>
    <title>signup</title>
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300italic,600%7CSource+Code+Pro" rel="stylesheet" />
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" href="css/signup.css" type="text/css">
  </head>

  <body>
    <?php
      session_start();
      if(isset($_POST['signup'])) {
        $con = mysqli_connect('localhost','root','Tw0sof+9Ly','scalabrinedb');
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
          $res = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");

          // Username is free
          if(mysqli_num_rows($res) == 0) 
          {

            $h_password = password_hash($password, PASSWORD_BCRYPT, $options);
            $sql="INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$h_password')";

            mysqli_query($con,$sql);

            $_SESSION['signup'] = "";
            header("Location: /index");
          } 
          else 
          {
            //username is taken
            $_SESSION['username'] = true;
            header("Location: /signup");
          }
        }
        else {
          // passwords didnt match
          $_SESSION['pass'] = true;
          header("Location: /signup");
        }
      }
      else{
    ?>
    <section id="signupBox">
      <?php
        if(isset($_SESSION['username']))
        {
      ?>
            <section id="hero">
               <h4>username is not available.</h4>
            </section>
      <?php
        }
        else if (isset($_SESSION['pass'])) 
        {
      ?>
          <section id="hero">
            <h4>passwords do not match.</h4>
          </section>
      <?php    
        }
      ?>
      <h2>signup</h2>
      <form method="post" class="minimal">
          <label for="username">
              <input type="text" name="username" id="username" placeholder="username"  required="required" />
          </label>
          <label for="email">
              <input type="email" name="email" id="email" placeholder="email"  required="required" />
          </label>
          <label for="password">
              <input type="password" name="password" id="password" placeholder="password"  required="required" />
          </label>
          <label for="confirm_password">
              <input type="password" name="confirm_password" id="confirm_password" placeholder="confirm password"  required="required" />
          </label>
          <button type="submit" class="btn-minimal" name="signup" id="signup">sign up</button>
      </form>
    </section>
    <?php
        }
    ?>
  </body>
</html>