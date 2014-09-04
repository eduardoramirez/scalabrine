<?php 
$rating_tableName     = 'ratings';
$rating_unitwidth     = 15;
$rating_dbname        = 'scalabrinedb';
$units=5;
function connect(){
	$host="localhost";
 $uname="root";
 $pass="Tw0sof+9Ly";
 $rating_dbname        = 'scalabrinedb';

$con = mysql_connect($host,$uname,$pass);

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($rating_dbname, $con);}


