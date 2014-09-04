<?php
session_start();
extract($_POST);

if($_POST['act'] == 'rm-com')
{
  // Connect to the database
  include('../config2.php'); 

$message = "answer";
echo "<script type='text/javascript'>alert('$message');</script>";
  //insert the comment in the database
  mysql_query("DELETE FROM comments WHERE name='$name' and email='$email' and id_post='$id_post')");

}
else{
  $message = "wrong answer";
echo "<script type='text/javascript'>alert('$message');</script>";
}

?>