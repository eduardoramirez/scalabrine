<?php
define(PW_SALT,'(+3%_');

$con = mysqli_connect('localhost','root','Tw0sof+9Ly','scalabrinedb');

function checkEmail($email)
{
    echo "in function"
    $error = array('status'=>false,'userID'=>0);
    if (isset($email) && trim($email) != '') {
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
}

function sendPasswordEmail($userID)
{
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
            $passwordLink = "<a href=\"?a=recover&email=" . $key . "&u=" . urlencode(base64_encode($userID)) . "\">http://104.131.195.41:9091/forgotPass.php?a=recover&email=" . $key . "&u=" . urlencode(base64_encode($userID)) . "</a>";
            $message = "Dear $uname,\r\n";
            $message .= "Please visit the following link to reset your password:\r\n";
            $message .= "-----------------------\r\n";
            $message .= "$passwordLink\r\n";
            $message .= "-----------------------\r\n";
            $message .= "Please be sure to copy the entire link into your browser. The link will expire after 3 days for security reasons.\r\n\r\n";
            $message .= "If you did not request this forgotten password email, no action is needed, your password will not be reset as long as the link above is not visited.\r\n\r\n";
            $message .= "Thanks,\r\n";
            $message .= "-- scalabrine";
            $headers .= "From: Scalabrine <scalabrinecse@gmail.com> \n";
            $headers .= "To-Sender: \n";
            $headers .= "X-Mailer: PHP\n"; // mailer
            $headers .= "Reply-To: scalabrinecse@gmail.com\n"; // Reply address
            $headers .= "Return-Path: scalabrinecse@gmail.com\n"; //Return Path for errors
            $headers .= "Content-Type: text/html; charset=iso-8859-1"; //Enc-type
            $subject = "Reset Password";
            @mail($email,$subject,$message,$headers);
            return str_replace("\r\n","<br/ >",$message);
        }
    }
}

function checkEmailKey($key,$userID)
{
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