<?php
//require_once 'config.php';
require("../database.php");

if($_POST['act'] == 'rate'){
	//search if the user(ip) has already gave a note
	$ip = $_SERVER["REMOTE_ADDR"];
	$therate = sanitize($_POST['rate']);
	$thepost = sanitize($_POST['post_id']);

	$data = my_query('i', array(&$thepost), "SELECT * FROM ratings WHERE id_post=?");

	if(@count($data) == 0 )
	{
		$param = array(&$thepost, &$ip, &$therate);
		my_update('isi', "INSERT INTO ratings (id_post, ip, rate) VALUES (?,?,?)");
	}
	else{
		my_update('ii', array(&$therate, &$thepost), "UPDATE ratings SET rate=? WHERE id_post=?");
	}
} 
?>
