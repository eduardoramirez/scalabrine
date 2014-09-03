<?php

$dbName = 'scalabrinedb' ; 
$dbHost = 'localhost' ;
$dbUsername = 'root';
$dbUserPassword = 'Tw0sof+9Ly';

//$con = mysqli_connect('localhost','scala_master','Tw3n+ysof+9ly','scalabrinedb');


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

function my_update($type, $param, $query)
{
  global $con;
  $stmt = $con->prepare($query);
  call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $param));
  $stmt->execute();
  $stmt->close();
}

function my_query($type, $param, $query)
{
  global $con;
  $stmt = $con->prepare($query);
  call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $param));
  $stmt->execute();

  $meta = $stmt->result_metadata(); 
  while ($field = $meta->fetch_field()) 
  { 
    $params[] = &$row[$field->name];
  }

  call_user_func_array(array($stmt, 'bind_result'), $params); 

  while ($stmt->fetch()) { 
    foreach($row as $key => $val) 
    { 
      $result[$key] = $val; 
      echo $key; echo "->"; echo $val; echo " ";
    } 
  } 

  $stmt->close();

  return $result;
}


function my_disconnect()
{
  global $con;
  $con->close();  
}

?>