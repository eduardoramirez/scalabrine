<?php
function sendPasswordEmail($userID)
{
  $con = mysqli_connect('localhost','root','Tw0sof+9Ly','scalabrinedb');
  if ($SQL = $con->prepare("SELECT `Username`,`Email`,`Password` FROM `user` WHERE `ID` = ? LIMIT 1"))
  {
    $SQL->bind_param('i',$userID);
    $SQL->execute();
    $SQL->store_result();
    $SQL->bind_result($uname,$email,$pword);
    $SQL->fetch();
    $SQL->close();
    $expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+3, date("Y"));
    $expDate = date("Y-m-d H:i:s",$expFormat);
    $key = md5($uname . '_' . $email . rand(0,10000) .$expDate . PW_SALT);
    if ($SQL = $con->prepare("INSERT INTO `recoveryemails` (`UserID`,`Key`,`expDate`) VALUES (?,?,?)"))
    {
      $SQL->bind_param('iss',$userID,$key,$expDate);
      $SQL->execute();
      $SQL->close();
      $passwordLink = "http://104.131.195.41:9091/dashboard/reset?a=recover&email=" . $key . "&u=" . urlencode(base64_encode($userID));
      $message = "Dear $uname,\r\n\r\n";
      $message .= "Please visit the following link to reset your password:\r\n";
      $message .= "-----------------------\r\n";
      $message .= "$passwordLink\r\n";
      $message .= "-----------------------\r\n\r\n";
      $message .= "Please be sure to copy the entire link into your browser. The link will expire after 3 days for security reasons.\r\n\r\n";
      $message .= "If you did not request this forgotten password email, no action is needed, your password will not be reset as long as the link above is not visited.\r\n\r\n\r\n";
      $message .= "Thanks,\r\n\r\n";
      $message .= "-- scalabrine";
      $headers .= "From: Scalabrine <scalabrinecse@gmail.com> \n";
      $headers .= "To: $db_email\n";
      $headers .= "X-Mailer: PHP\n"; // mailer
      $subject = "Reset Password";
      @mail($email,$subject,$message,$headers);
    }
  }
}

function checkEmail($email)
{
  $con = mysqli_connect('localhost','root','Tw0sof+9Ly','scalabrinedb');
  $error = array('status'=>false,'userID'=>0);
  if (isset($email) && trim($email) != '') 
  {
    //email was entered
    if ($SQL = $con->prepare("SELECT `ID` FROM `user` WHERE `Email` = ? LIMIT 1"))
    {
      $SQL->bind_param('s',trim($email));
      $SQL->execute();
      $SQL->store_result();
      $numRows = $SQL->num_rows();
      $SQL->bind_result($userID);
      $SQL->fetch();
      $SQL->close();
      if ($numRows >= 1) return array('status'=>true,'userID'=>$userID);
    } else { return $error; }
  } else {
      //nothing was entered;
      return $error;
  }
}s
?>