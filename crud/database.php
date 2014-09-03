<?php

$dbName = 'scalabrinedb' ; 
$dbHost = 'localhost' ;
$dbUsername = 'root';
$dbUserPassword = 'Tw0sof+9Ly';
	
$con  = mysqli_connect($dbHost,$dbUsername,$dbUserPassword,$dbName);

function getNumRows($type, $param, $query)
{
  $SQL = $con->prepare($query);
  call_user_func_array(array($SQL, "bind_param"), array_merge(array($type), $param));
  $SQL->execute();
  $SQL->store_result();
  $numRows = $SQL->num_rows();
  $SQL->close();

  return $numRows;
}

/*function my_query($type, $param, $query)
{
  $SQL = $con->prepare($query);
  call_user_func_array(array($SQL, "bind_param"), array_merge(array($type), $param));
  $SQL->execute();
  $SQL->store_result();
  $results = $SQL->fetch_assoc();
  $SQL->free();
  $SQL->close();

  return $results;
}*/

?>