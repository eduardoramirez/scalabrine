<?php

require('../database.php');

define('PW_SALT','(+3%_');

function sendPasswordEmail($userID)
{
  $data = my_query('i', array(&$userID), "SELECT Username, Email FROM user WHERE ID = ? LIMIT 1");
  $uname = $data['Username'];
  $email = $data['Email'];

  $expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+3, date("Y"));
  $expDate = date("Y-m-d H:i:s",$expFormat);
  $key = md5($uname . '_' . $email . rand(0,10000) .$expDate . PW_SALT);

  my_update('iss', array(&$userID, &$key, &$expDate), "INSERT INTO `recoveryemails` (`UserID`,`Key`,`expDate`) VALUES (?,?,?)");

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
  $headers .= "X-Mailer: PHP\n"; // mailer
  $subject = "Reset Password";
  @mail($email,$subject,$message,$headers);
}

function checkEmail($email)
{
  $error = array('status'=>false,'userID'=>0);
  if (isset($email) && trim($email) != '') 
  {
    //email was entered
    $email = trim($email);
    $data = my_query('s', array(&$email), "SELECT ID FROM user WHERE Email=? LIMIT 1");

    $numRows = getNumRows('s', array(&$email), "SELECT ID FROM user WHERE Email=? LIMIT 1");

    if ($numRows >= 1) return array('status'=>true,'userID'=>$data['ID']);
    else { return $error; }
  } else {
    //nothing was entered;
    return $error;
  }
}

function checkEmailKey($key,$userID)
{
  $curDate = date("Y-m-d H:i:s");

  $sql = "SELECT `UserID` FROM `recoveryemails` WHERE `Key` = ? AND `UserID` = ? AND `expDate` >= ?";
  $data = my_query('sis', array(&$key, &$userID, &$curDate), $sql);
  $numRows = getNumRows('sis', array(&$key, &$userID, &$curDate), $sql);

  if ($numRows > 0 && $data['UserID'] != '')
  {
    return array('status'=>true,'userID'=>$data['UserID']);
  }
  
  return false;
}

function updateUserPassword($userID, $password, $key)
{
  $options = [
    'cost' => 11,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
  ]; 

  $h_password = password_hash($password, PASSWORD_BCRYPT, $options);
  echo $userID;

  my_update('si', array(&$h_password, &$userID), "UPDATE user SET Password = ? WHERE ID = ?");

  my_update('s', array(&$key), "DELETE FROM `recoveryemails` WHERE `Key` = ?");
}
?>