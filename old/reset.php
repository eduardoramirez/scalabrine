<!DOCTYPE HTML>
<html>
<head>
    <title>reset password</title>
      <meta charset="utf-8">
      <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300italic,600%7CSource+Code+Pro" rel="stylesheet" />
      <link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
      <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
      <link rel="stylesheet" href="/css/reset.css" />
</head>
<body>
<?php
    include 'emaillib.php';
    include "phpmailer/class.phpmailer.php";
    session_start();
    if(isset($_POST['reset'])) {
        // need to escape characters
        $reset_email = $_POST['email'];
        $con = mysqli_connect('localhost','root','Tw0sof+9Ly','scalabrinedb');
        
        $query = "SELECT username, email FROM users WHERE email='$reset_email'";

        if($stmt = mysqli_prepare($con, $query))
        {
            mysqli_stmt_execute($stmt);

            mysqli_stmt_bind_result($stmt, $db_username, $db_email);

            mysqli_stmt_fetch($stmt);

            if(strcmp($reset_email, $db_email) === 0)
            {
                $mail = new PHPMailer(); // create a new object
                $mail->IsSMTP(); // enable SMTP
                $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true; // authentication enabled
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465;
                $mail->IsHTML(true);
                $mail->Username = SMTP_UNAME;
                $mail->Password = SMTP_PWORD;
                $mail->SetFrom(SMTP_UNAME);
                $mail->Subject = "Recover your password";
                $mail->Body = "Recover you password blah blah";
                $mail->AddAddress($reset_email);
                if(!$mail->Send()){
                    // error occured
                }
                else{
                    // message sent
                }
            } 
            else
            {
                // no mail exist 
            }
        }

        mysqli_close($con);
    }
    else {
?>
<section id="emailBox">
    <?php
        if(isset($_SESSION['no_email']))
        {
          $_SESSION['no_email'] = false;
      ?>
            <section id="hero">
               <h4>email does not exist.</h4>
            </section>
      <?php
        }
        session_unset();
      ?>
    <h2>reset password</h2>
    <form method="post" class="minimal">
        <label for="email">
            <input type="email" name="email" id="email" placeholder="email"  required="required" />
        </label>
        <button type="submit" class="btn-minimal" name="reset">reset password</button>
    </form>
</section>
<?php
    }
?>
</body>
</html>
