<?php

$dbName = 'scalabrinedb' ; 
$dbHost = 'localhost' ;
$dbUsername = 'root';
$dbUserPassword = 'Tw0sof+9Ly';
	
$con  = new mysqli($dbHost,$dbUsername,$dbUserPassword,$dbName);

function getNumRows($type, $param, $query)
{
  global $con;
  $stmt = $con->prepare($query);
  call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $param));
  $stmt->execute();
  $stmt->store_result();
  $numRows = $stmt->num_rows();
  $stmt->close();

  return $numRows;
}

function my_query($type, $param, $query)
{
  global $con;
  $stmt = $con->prepare($query);
  call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $param));
  $stmt->execute();
  $stmt->bind_result($col1);
  //$result = $stmt->get_result();
  //$db_results = $result->fetch_array(MYSQLI_ASSOC);
  $stmt->fetch();
  $stmt->close();

  return $db_results;
}

?>