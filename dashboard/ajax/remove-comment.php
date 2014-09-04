<?php
session_start();
extract($_POST);

if($_POST['act'] == 'rm-com')
{
  // Connect to the database
  include('../../database.php'); 

  //insert the comment in the database
  my_update('i', array(&$id_post), "DELETE FROM comments WHERE id=?");
  my_update('i', array(&$id_post), "DELETE FROM ratings WHERE id_post=?");
}
?>