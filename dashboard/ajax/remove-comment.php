<?php
session_start();
extract($_POST);

if($_POST['act'] == 'rm-com')
{
  // Connect to the database
  include('../../database.php'); 


echo "<script type='text/javascript'>alert('$name $email $id_post');</script>";
  //insert the comment in the database
  my_update('i', array(&$id_post), "DELETE FROM comments WHERE id=?");

}
?>