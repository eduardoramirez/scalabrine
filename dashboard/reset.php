<?php
session_start();
/*if (isset($_SESSION['login'] && $_SESSION['login'] === '1')) 
{
  header("Location: /dashboard/index");
}
else
*/


function checkEmailKey($key,$userID)
{
    $con = mysqli_connect('localhost','root','Tw0sof+9Ly','scalabrinedb');
    $curDate = date("Y-m-d H:i:s");
    if ($SQL = $con->prepare("SELECT `UserID` FROM `recoveryemails` WHERE `Key` = ? AND `UserID` = ? AND `expDate` >= ?"))
    {
        $SQL->bind_param('sis',$key,$userID,$curDate);
        $SQL->execute();
        $SQL->store_result();
        $numRows = $SQL->num_rows();
        $SQL->bind_result($userID);
        $SQL->fetch();
        $SQL->close();
        if ($numRows > 0 && $userID != '')
        {
            return array('status'=>true,'userID'=>$userID);
        }
    }
    return false;
}
 
function updateUserPassword($userID,$password)
{
    $con = mysqli_connect('localhost','root','Tw0sof+9Ly','scalabrinedb');
    if ($SQL = $con->prepare("UPDATE `user` SET `Password` = ? WHERE `ID` = ?"))
    {  
        $options = [
          'cost' => 11,
          'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ]; 
        $password = password_hash($password, PASSWORD_BCRYPT, $options);

        $SQL->bind_param('si',$password,$userID);
        $SQL->execute();
        $SQL->close();
        $SQL = $con->prepare("DELETE FROM `recoveryemails` WHERE `Key` = ?");
        $SQL->bind_param('s',$key);
        $SQL->execute();
    }
}



if (isset($_GET['a']) && $_GET['a'] == 'recover' && $_GET['email'] != "") 
{
  $result = checkEmailKey($_GET['email'],urldecode(base64_decode($_GET['u'])));
  if ($result == false)
  {
    // key does not match our key.. bad key
  } 
  elseif ($result['status'] == true) 
  {
    // key is kewl
    $securityUser = $result['userID'];

    if(isset($_POST['reset'])) {
      // need to escape characters
      $password = $_POST['password'];
      $confirm_password = $_POST['confirm_password'];
      
      // userid was empty and or key was empty
      if ($securityUser =='' || $_POST['key'] == '') header("location: /login");
      
      if (strcmp($password,$confirm_password) !== 0 || trim($password) === '')
      {
        $_SESSION['pass_match'] = true;
        header("Location: /dashboard/reset");
      } 
      else 
      {
        // user 
        updateUserPassword($securityUser, $password, $_GET['email']);

        // let user know it was successful and redirect to login
        header("Location: /dashboard/login");
      }
        
    }
  }
}
else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="login">

  <title>scalabrine | reset password</title>

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
  if(isset($_SESSION['pass_match']))
  {
    $_SESSION['pass_match'] = false;
?>
  <div class="alert alert-danger" role="alert">passwords do not match.</div>
<?php
  }
  session_unset();
?>
    <form class="form-signin" method="post">
      <h2 class="form-signin-heading">reset password</h2>
      <div class="login-wrap">
        <input type="password" class="form-control" name="password" placeholder="Password" autofocus />
        <input type="password" class="form-control" name="confirm_password" placeholder="Re-type Password" />

        <button class="btn btn-lg btn-login btn-block" name="reset" type="submit">reset</button>
        
      </div>

    </form>
  </div>

  <!-- js placed at the end of the document so the pages load faster -->
  <script src="/dashboard/js/jquery.js"></script>
  <script src="/dashboard/js/bootstrap.min.js"></script>
<?php
  }
?>

  </body>
</html>





