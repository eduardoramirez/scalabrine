<?php
session_start();
extract($_POST);

if($_POST['act'] == 'rm-com')
{
  // Connect to the database
  include('../config2.php'); 


echo "<script type='text/javascript'>alert('$name $email $id_post');</script>";
  //insert the comment in the database
  mysql_query("DELETE FROM comments WHERE name='$name' and email='$email' and id_post='$id_post')");

}
?>