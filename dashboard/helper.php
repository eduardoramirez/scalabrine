<?php

define(PW_SALT,'(+3%_');

function sendEmail($userID)
{
  $con = return mysqli_connect('localhost','root','Tw0sof+9Ly','scalabrinedb');

  $query = "SELECT `username`, `Email`, `Password` FROM `user` WHERE `ID`= ?";

  if($stmt = mysqli_prepare($con, $query))
  {
    mysqli_stmt_bind_param('i', $userID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $db_username, $db_email, $db_password);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+3, date("Y"));
    $expDate = date("Y-m-d H:i:s",$expFormat);

    $key = md5($db_username . '_' . $db_email . rand(0,10000) .$expDate . PW_SALT);

    $query = "INSERT INTO `recoveryemails` (`UserID`,`Key`,`expDate`) VALUES (?,?,?)";
    
    if($stmt = mysqli_prepare($con, $query))
    {
      mysqli_stmt_bind_param('iss', $userID);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);

      $resetlink = "<a href=\"?a=recover&email=" . $key . "&u=" . urlencode(base64_encode($userID)) . "\">http://104.131.195.41:9091/reset.php?a=recover&email=" . $key . "&u=" . urlencode(base64_encode($userID)) . "</a>";;
      
      $message = "Dear $db_username,\r\n";
      $message .= "Please visit the following link to reset your password:\r\n";
      $message .= "-----------------------\r\n";
      $message .= "$resetlink\r\n";
      $message .= "-----------------------\r\n";
      $message .= "Please be sure to copy the entire link into your browser. The link will expire after 3 days for security reasons.\r\n\r\n";
      $message .= "If you did not request this forgotten password email, no action is needed, your password will not be reset as long as the link above is not visited.\r\n\r\n";
      $message .= "Thanks,\r\n";
      $message .= "-- scalabrine";
      $headers .= "From: Scalabrine <scalabrinecse@gmail.com> \n";
      $headers .= "To: $db_email\n";
      $headers .= "X-Mailer: PHP\n"; // mailer
      $headers .= "Return-Path: scalabrinecse@gmail.com\n"; //Return Path for errors
      $subject = "Password Reset";

      @mail($db_email, $subject, $message, $headers);
    }
  }
}


function lookUpEmail($email)
{
  $con = return mysqli_connect('localhost','root','Tw0sof+9Ly','scalabrinedb');

  $error = array('status'=>false,'userID'=>0);
  
  if (isset($email) && trim($email) != '') 
  {
    //email was entered
    if ($SQL = $con->prepare("SELECT `ID` FROM `user` WHERE `Email` = ?"))
    {
      mysqli_stmt_bind_param('s', trim($email));
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $numRows = mysqli_stmt_num_rows($stmt); 
      mysqli_stmt_bind_result($stmt, $db_userID);
      mysqli_stmt_fetch($stmt);
      mysqli_stmt_free_result($stmt);
      mysqli_stmt_close($stmt);

      if ($numRows >= 1) 
      {
        return array('status'=>true,'userID'=>$userID);
      }
    } 
    else { return $error; }
  } 
  else 
  {
    //nothing was entered;
    return $error;
  }
}

?>

